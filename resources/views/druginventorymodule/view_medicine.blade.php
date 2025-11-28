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
    <source src="{{ asset('inventoryvideos/pharmacist.mp4') }}" type="video/mp4">
  </video>

  <div class="main-content">
    <nav class="navbar bg-body-tertiary" aria-label="Light offcanvas navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('dashboard') }}">
          <img src="{{ asset('logo.jpg') }}" alt="logo" style="height: 25px;"> Dons_Medicos
        </a>
        <span class="navbar-text text-muted fw-bold" style="font-size: 1rem;">"Efficiency In Every Prescription"</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel">
              <img src="{{ asset('logo.jpg') }}" alt="logo" style="height: 25px;"> Dons_Medicos
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item"><a class="nav-link active" href="{{ route('inventory.dashboard') }}">Dashboard</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('medicine.create') }}">Add Medicine</a></li>
              <li class="nav-item"><a class="nav-link active" href="{{ route('view.medicine') }}">View Medicine</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('medicine.update') }}">Update Medicine</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('medicines.expiry') }}">Expiring/Expired Medicine</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('delete_medicine') }}">Delete Medicine</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('anomaly.report') }}">Anomally Report</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <div class="container mt-5">
      <div class="header">
        <h2 class="text-center mb-4">View Medicine</h2>
      </div>

      
      <form method="POST" action="{{ route('view.medicine') }}" class="row g-3 mb-4">
        @csrf
        <div class="col-md-8">
          <input type="text" name="search_term" class="form-control" placeholder="Enter medicine name or ID">
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button type="submit" name="search" class="btn btn-primary w-50">Search</button>
          <button type="submit" name="view_all" class="btn btn-secondary w-50">View All</button>
        </div>
      </form>

      
      @if ($medicines->isNotEmpty())
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
              </tr>
            </thead>
            <tbody>
              @foreach ($medicines as $medicine)
                <tr>
                  <td>{{ $medicine->medicine_id }}</td>
                  <td>{{ $medicine->medicine_name }}</td>
                  <td>{{ $medicine->location }}</td>
                  <td>{{ $medicine->price }}</td>
                  <td>{{ $medicine->quantity }}</td>
                  <td>{{ $medicine->category }}</td>
                  <td>{{ $medicine->expiry_date }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @elseif (request()->isMethod('post'))
        <div class="alert alert-warning">No medicine found.</div>
      @endif
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
