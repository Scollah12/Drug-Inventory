@extends('layouts.app')

@section('content')
<style>
    body{
                background-image: url({{ asset('adddrug.jpg') }} );
                background-size: cover;
                 
                
            }
   .glass-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      color: #fff;
   }

   .table thead {
      background-color: rgba(0, 123, 255, 0.2);
      color: white;
   }

   .table tbody tr:hover {
      background-color: rgba(255, 255, 255, 0.05);
      transition: 0.3s ease;
   }

   .btn {
      border-radius: 50px;
   }

   .expired {
      background-color: rgba(220, 53, 69, 0.7);
      color: white;
      padding: 4px 8px;
      border-radius: 10px;
   }

   .low-stock {
      background-color: rgba(255, 193, 7, 0.7);
      color: black;
      padding: 4px 8px;
      border-radius: 10px;
   }
</style>

<div class="container glass-container mt-4">
<a href="{{ route('pharmacist.dashboard') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle me-1"></i> Go Back
        </a>
   <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0">💊 Drug Stock Inventory</h2>
      
   </div>

   @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
   @endif

   <div class="table-responsive">
      <table class="table table-hover table-bordered text-white">
         <thead>
            <tr>
   <th>Name</th>
   <th>Category</th>
   <th>Quantity</th>
   <th>Price</th>
   <th>Expiry Date</th>
   
            </tr>
         </thead>
         <tbody>
            @foreach($stocks as $stock)
   <tr>
   <td>{{ $stock->name }}</td>
   <td>{{ $stock->category }}</td>
   <td>
      {{ $stock->quantity }}
      @if($stock->quantity <= 10)
         <span class="low-stock ms-2">Low</span>
      @endif
   </td>
   <td>₹ {{ number_format($stock->price, 2) }}</td>
   <td>
      {{ $stock->expiry_date }}
      @if(\Carbon\Carbon::parse($stock->expiry_date)->isPast())
         <span class="expired ms-2">Expired</span>
      @endif
   </td>
  
   </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
