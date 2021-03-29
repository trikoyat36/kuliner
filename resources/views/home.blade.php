@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

        <//img src="{{ url('') }}" class="rounded mx-auto d-block" width="350" alt="center">
            
        </div>
       @foreach($makanans as $makanan)
       <div class="col-md-4">
       <div class="card" style="width: 15rem;">
       

  <img class="card-img-top" src="{{ url('uploads') }}/{{ $makanan->gambar }}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{ $makanan->nama_makanan }}</h5>
    <p class="card-text">
 
      <strong>Harga :</strong> Rp. {{ number_format($makanan->harga)}} <br>
       <strong>Jumlah :</strong> {{ $makanan->stok }} <br>
       <hr>
        <strong>keterangan  :</strong> <br>
        {{ $makanan->keterangan }} 

    </p>  
    <a href="{{ url('pesan') }}/{{ $makanan->id }}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>Pesan</a>
    


        </div>

       </div>     

       </div>
       @endforeach

 

    </div>
      
     </div>
  
    
  

  
   

     </div>
    
@endsection




    