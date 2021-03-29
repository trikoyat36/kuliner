@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">

    <div class="col-md-12">
      <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
      
    </div>



    <div class="col-md-12" mt-2>

    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $makanan->nama_makanan }}</li>
  </ol>
</nav> 




    </div>
    <div class="col-md-12 mt-1">

    <div class="card">


      <div class="card-header">
        <h4>{{ $makanan->nama_makanan }}</h4> 
      
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-6">

           <img src="{{ url('uploads') }}/{{ $makanan->gambar }}" class="rounded mx-auto d-block" width="70%" alt="">
          
        </div>

      <div class="col-md-6">
        
       <h3>{{ $makanan->nama_makanan }}</h3> 
       <table class="table">
        <tbody>
      
         
         <tr>
          <td>HARGA</td>
          <td>:</td>
          <td>Rp. {{ number_format($makanan->harga) }}</td>
        </tr>

        <tr>
          <td>STOK</td>
          <td>:</td>
          <td>{{ number_format($makanan->stok) }}</td>
        </tr>

        
          
        <tr>

        <tr>
          <td>KETERANGAN</td>
          <td>:</td>
          <td>{{ $makanan->keterangan }}</td>
        </tr>

         


        <tr>
          <td>JUMLAH PESAN</td>
          <td>:</td>
          <td>

            <form method="post" action="{{ url('pesan') }}/{{ $makanan->id }}" >

            @csrf
         



           

            <input type="text" name="jumlah_pesan" class="form-control"
            required="">

            <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-shopping-cart"></i> Pesan Sekarang </button>


          </form>
           
          </td>
        </tr>
         
          

       </tbody>
       </table>

      
            </div>
     </div>
      </div>

      </div>
      <textarea name="komentar" class="col-md-6 mt-3" id="komentar-utama" rows="5"></textarea>
      <h3></h3>
      
    </div>
    
</div> 
<div class="">
<button class="btn btn-primary"><i class="fas fa-thumbs-up"></i> Suka</button>
<button class="btn btn-danger"><i class="fas fa-comments"></i> Komentar</button>

    </div>
     

 </div>


 
@endsection

 

