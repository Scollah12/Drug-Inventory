@extends('layouts.app')

@section('content')
<style>
     body{
                background-image: url({{ asset('pharmacybg.jpg') }} );
                background-size: cover;
                 
                
            }
            .dashboard-card {
background: rgba(255, 255, 255, 0.1);
 backdrop-filter: blur(10px);
 -webkit-backdrop-filter: blur(10px);
 border-radius: 1rem;
border: 1px solid rgba(255, 255, 255, 0.2);
 box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
 transition: transform 0.3s ease, box-shadow 0.3s ease;
}


 .dashboard-card:hover {
 transform: scale(1.03);
box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

 .icon-circle {
 width: 80px;
 height: 80px;
 display: flex;
 align-items: center;
 justify-content: center;
 margin: 0 auto 1rem;
 border-radius: 50%;
 background: linear-gradient(135deg, #0d6efd, #0dcaf0);
 color: #fff;
 font-size: 2rem;
 }

 .icon-circle.green {
 background: linear-gradient(135deg, #198754, #20c997);
 }

 .dashboard-header {
   background: rgba(255, 255, 255, 0.1);
   backdrop-filter: blur(12px);
   -webkit-backdrop-filter: blur(12px);
   color: white;
   padding: 2rem;
   border-radius: 1rem;
   text-align: center;
   margin-bottom: 2rem;
   border: 1px solid rgba(255, 255, 255, 0.2);
   box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
   animation: fadeIn 1s ease-in-out;
}


 .animated-title {
 animation: fadeIn 1s ease-in-out;
 }

 @keyframes fadeIn {
 from {
  opacity: 0;
  transform: translateY(-10px);
 }
 to {
  opacity: 1;
  transform: translateY(0);
 }
 }

 .stat-box {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 1rem;
  padding: 1.5rem;
  text-align: center;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.stat-box:hover {
  transform: translateY(-5px);
  background: rgba(255, 255, 255, 0.15);
}


 .stat-icon {
 font-size: 1.8rem;
 color: #0d6efd;
 }
</style>

<a href="{{ route('admin.dashboard') }}" class="btn btn-danger mb-3">
        <i class="bi bi-box-arrow-left"></i> Log Out
    </a>

<div class="container">
 <div class="dashboard-header">
 <h2 class="animated-title mb-0">Welcome, Pharmacist</h2>
 <p class="mb-0">Manage your drug inventory and requests efficiently.</p>
 </div>

 <div class="row text-center mb-4 g-3">
 <div class="col-md-4">
  <div class="stat-box">
   <div class="stat-icon"><i class="fas fa-boxes"></i></div>
   <h5 class="mt-2">Total Drugs</h5>
   <h3>{{ $totalDrugs }}</h3> 
  </div>
 </div>

 <div class="col-md-4">
  <div class="stat-box">
   <div class="stat-icon text-success"><i class="fas fa-file-alt"></i></div>
   <h5 class="mt-2">Pending Requests</h5>
   <h3>{{ $pendingRequests }}</h3>
  </div>
 </div>

 <div class="col-md-4">
  <div class="stat-box">
   <div class="stat-icon text-danger"><i class="fas fa-truck-loading"></i></div>
   <h5 class="mt-2">Out of Stock</h5>
   <h3>{{ $outOfStock }}</h3>
  </div>
 </div>
</div>


 
 <div class="row g-4">
 <div class="col-md-6">
  <div class="card dashboard-card text-center p-4">
  <div class="icon-circle">
   <i class="fas fa-pills"></i>
  </div>
  <h4 class="fw-bold">Drug Stock</h4>
  <p class="text-muted">Manage and view available drug stock in the pharmacy.</p>
  <a href="{{ route('view.medicine') }}" class="btn btn-outline-primary">
   <i class="fas fa-eye me-1"></i> View Stock
  </a>
  </div>
 </div>

 <div class="col-md-6">
  <div class="card dashboard-card text-center p-4">
  <div class="icon-circle green">
   <i class="fas fa-file-medical"></i>
  </div>
  <h4 class="fw-bold">Drug Requests</h4>
  <p class="text-muted">View and manage incoming drug requests from doctors.</p>
  <a href="{{ route('drugrequests.index') }}" class="btn btn-outline-success">
   <i class="fas fa-tasks me-1"></i> View Requests
  </a>
  </div>
 </div>
</div>
</div>
@endsection
