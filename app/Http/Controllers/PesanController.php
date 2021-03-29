<?php

namespace App\Http\Controllers;
use App\Makanan;
use App\Pesanan;
use App\User;
use App\PesananDetail;
use Auth;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesanController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
    	$makanan = Makanan::where('id', $id)->first();

    	return view('pesan.index', compact('makanan'));
    }

    public function pesan(Request $request, $id)
    
    {

        	$makanan = Makanan::where('id', $id)->first();
            $tanggal = Carbon::now();
                                
        //validasi apakah melebihi stok

            if ($request->jumlah_pesan > $makanan->stok) {
              return redirect('pesan/'.$id);
            }


       //cek validasi
       $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();   



        //simpan ke database pesanan

       if (empty($cek_pesanan))
        {
         
       $pesanan = new Pesanan;
       $pesanan->user_id = Auth::user()->id;
       $pesanan->tanggal = $tanggal;
       $pesanan->status = 0;
       $pesanan->jumlah_harga = 0;
       $pesanan->kode = mt_rand(100, 999); 
       $pesanan->save();

          
       }

      

      

        //simpan ke database pesanan detail

       $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

       //cek pesanan detail

      $cek_pesanan_detail = PesananDetail::where('makanan_id', $makanan->id)->where('pesanan_id', $pesanan_baru->id)->first();

       if(empty($cek_pesanan_detail))

       {
         
       $pesanan_detail = new PesananDetail;
       $pesanan_detail->makanan_id = $makanan->id;
       $pesanan_detail->pesanan_id = $pesanan_baru->id;
       $pesanan_detail->jumlah = $request->jumlah_pesan;
       $pesanan_detail->jumlah_harga = $makanan->harga*$request->jumlah_pesan;
       $pesanan_detail->save();

       }else

       {
          $pesanan_detail = PesananDetail::where('makanan_id', $makanan->id)->where('pesanan_id', $pesanan_baru->id)->first();
          
       $pesanan_detail->jumlah =  $pesanan_detail->jumlah+$request->jumlah_pesan;

       //harga sekarang
       $harga_pesanan_detail_baru = $makanan->harga*$request->jumlah_pesan;
       $pesanan_detail->jumlah_harga =  $pesanan_detail->jumlah_harga+ $harga_pesanan_detail_baru;
       $pesanan_detail->update();


       }

       //jumlah total

       $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
       $pesanan->jumlah_harga =  $pesanan->jumlah_harga+$makanan->harga*$request->jumlah_pesan;
       $pesanan->update();

    
         alert()->success('PESANAN  SUDAH SIAP', 'SUKSES');

         return redirect('check-out');

    }

        public function check_out()
        {
           $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
           $pesanan_details = [];
           if(!empty($pesanan))

           {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get(); 

           }
           

           return view('pesan.check_out', compact('pesanan', 'pesanan_details'));
        }

        public function delete($id)
        {
           $pesanan_detail = pesananDetail::where('id', $id)->first();


           $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
           $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
           $pesanan->update();


           $pesanan_detail->delete();

             alert()->error('PESANAN SUKSES DI HAPUS', 'HAPUS');

             return redirect('check-out');


        }

        public function konfirmasi()
        {

          $user = User::where('id', Auth::user()->id)->first();

           if (empty($user->alamat))
            {
              alert()->error('SILAHKAN LENGKAPI INDENTITAS ANDA', 'ERROR');

             return redirect('profile'); 
           }

           
           if (empty($user->nohp))
            {
              alert()->error('SILAHKAN LENGKAPI INDENTITAS ANDA', 'ERROR');

             return redirect('profile'); 
           }




           $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
           $pesanan_id = $pesanan->id;
           $pesanan->status = 1; 
           $pesanan->update();

           $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
           foreach ($pesanan_details as $pesanan_detail) {
             $makanan = Makanan::where('id', $pesanan_detail->makanan_id)->first();
             $makanan->stok = $makanan->stok-$pesanan_detail->jumlah;
             $makanan->update();
           }

            alert()->success('PESANAN SUKSES DI CHECK OUT LANJUT PEMBAYARAN', 'SUKSES');

             return redirect('history/'.$pesanan_id);

        }
    
    }



   
    

