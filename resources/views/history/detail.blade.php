@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">

    <div class="col-md-12">
      <a href="{{ url('history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
      
    </div>

    <div class="col-md-12" mt-2>

    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat Pemesanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
  </ol>
</nav> 
</div> 

<div class="col-md-12">

  <div class="card">
       <div class="card-body">

        <h3>Pemesanan Sukses </h3>
        <h5>Pesanan anda Telah Sukses Silahkan Transfer <br> di Rekening <strong>BANK MANDIRI NO REK : 3424-5678-9756</strong>
          dengan nominal : <strong>Rp. {{ number_format($pesanan->kode+$pesanan->jumlah_harga) }}</strong></h5>
         
       </div>
    
  </div>
  

    <div class="card mt-2">

      <div class="card-header">

        
        
    
      <div class="card-body">
         <h3><i class="fa fa-shopping-cart"></i>Detail Pemesanan</h3>

         @if(!empty($pesanan))

         <p align="right">Tanggal Pesan : {{  $pesanan->tanggal  }}</p>
         <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Makanan</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total Harga</th>
            
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach($pesanan_details as $pesanan_detail)
          <tr>
            <td>{{ $no++ }}</td>
            <td>
            <img src="{{ url('uploads') }}/{{ $pesanan_detail->makanan->gambar }}" width="130" alt="...">

             </td>
            <td>{{ $pesanan_detail->makanan->nama_makanan }}</td>
            <td>{{ $pesanan_detail->jumlah }} Makanan</td>
            <td align="right">Rp. {{ number_format($pesanan_detail->makanan->harga) }}</td>

            <td align="right">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
           
          </tr>
          @endforeach

         

            <tr>
              <td colspan="5" align="right"><strong>Total harga :</strong></td>
              <td align="right"><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
            

                
          </tr>
            <tr>
              <td colspan="5" align="right"><strong>Kode Unik :</strong></td>
              <td align="right"><strong>Rp. {{ number_format($pesanan->kode) }}</strong></td>
            

                
          </tr>
           <tr>
              <td colspan="5" align="right"><strong>Total biaya Transfer :</strong></td>
              <td align="right"><strong>Rp. {{ number_format($pesanan->kode+$pesanan->jumlah_harga) }}</strong></td>
              

                
          </tr>

        </tbody>
         
      </table>
      @endif


        
      </div>
      
    </div>
  

    
  </div>
  
</div>
</div> 
 </div>
@endsection
