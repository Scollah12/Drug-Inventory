<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Medicine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .video-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            object-fit: fill;
            z-index: -1;
            pointer-events: none;
        }

        .main-content {
            position: relative;
            z-index: 1;
        }

        .header {
            background-color: #e6e6e6;
            width: 1000px;
            border-radius: 1rem;
            margin-left: 12%;
        }
    </style>
</head>
<body>
   <video autoplay muted loop class="video-bg">
    <source src="{{ asset('inventoryvideos/rotating_pills.mp4') }}" type="video/mp4">
</video>

<div class="main-content">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{ asset('logo.jpg') }}" alt="logo" style="height: 25px;">Dons_Medicos</a>
            <span class="navbar-text text-muted fw-bold">"Efficiency In Every Prescription"</span>
         <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel"><img src="images/logo.png" alt="logo" style="height: 25px;">Dons_Medicos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item"><a class="nav-link active" href="{{ route('inventory.dashboard') }}">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('medicine.create') }}">Add Medicine</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('view.medicine') }}">View Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('medicine.update') }}">Update Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('medicines.expiry') }}">Expiring/Expired Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('delete_medicine') }}">Delete Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('anomaly.report') }}">Anomally Report</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

    <div class="container mt-5">
        <div class="header">
            <h2 class="text-center mb-4">Update Medicine</h2>
        </div>

        <form method="POST" class="row g-3 mb-4" action="{{ route('medicine.update') }}">
            @csrf
            <div class="col-md-8">
                <input type="text" name="search_term" class="form-control" placeholder="Enter medicine name or ID">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" name="search" class="btn btn-primary w-50">Search</button>
                <button type="submit" name="view_all" class="btn btn-secondary w-50">View All</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(isset($medicines) && count($medicines) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $med)
                    <tr>
                        <td>{{ $med->medicine_id }}</td>
                        <td>{{ $med->medicine_name }}</td>
                        <td>{{ $med->location }}</td>
                        <td>{{ $med->price }}</td>
                        <td>{{ $med->quantity }}</td>
                        <td>{{ $med->category }}</td>
                        <td>{{ $med->expiry_date }}</td>
                        <td>
                            <form method="POST" action="{{ route('medicine.doUpdate') }}" onsubmit="return confirm('Are you sure you want to update this medicine?');">
                                @csrf
                                <input type="hidden" name="update_id" value="{{ $med->medicine_id }}">
                                <input type="text" name="medicine_name" value="{{ $med->medicine_name }}" class="form-control mb-1" placeholder="Medicine Name">
                                <input type="text" name="location" value="{{ $med->location }}" class="form-control mb-1" placeholder="Location">
                                <input type="number" name="price" value="{{ $med->price }}" class="form-control mb-1" placeholder="Price">
                                <input type="number" name="quantity" value="{{ $med->quantity }}" class="form-control mb-1" placeholder="Quantity">
                                <input type="text" name="category" value="{{ $med->category }}" class="form-control mb-1" placeholder="Category">
                                <input type="date" name="expiry_date" value="{{ $med->expiry_date }}" class="form-control mb-1">
                                <button type="submit" class="btn btn-success btn-sm mt-2">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @elseif(request()->isMethod('post'))
            <div class="alert alert-warning">No medicine found.</div>
        @endif
    </div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
