<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
   body {
    background-image: url('{{ asset('user_dashboard.webp') }}');
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}

    .card-glass, .form-glass, .activity-glass, .chart-glass {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 15px;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: white;
      padding: 20px;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
      transition: 0.3s;
    }
    .navbar {
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    .bg-light, .navbar-light {
      background-color: rgba(255, 255, 255, 0.5) !important;
      backdrop-filter: blur(10px);
    }
    .form-control, .btn, .form-select {
      background-color: rgba(255, 255, 255, 0.3) !important;
      border: 1px solid rgba(255, 255, 255, 0.5);
      color: black;
    }
    .form-control:focus, .form-select:focus {
      background-color: rgba(255, 255, 255, 0.5) !important;
      border-color: #00bfff;
    }
  </style>
</head>

<body>


<div class="d-flex justify-content-between align-items-center p-3 bg-light">

  <a href="{{ route('login.custom') }}" class="btn btn-danger mb-3">
        <i class="bi bi-box-arrow-left"></i> Log Out
    </a>

  
  <div class="d-flex align-items-center">
    <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; font-size: 20px;">
      U
    </div>
    <span class="ms-2 text-dark"><p>Welcome back</p>
</span>
  </div>
</div>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item mx-3">
        <a class="nav-link active" href="#home">Home</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="#my-requests">My Requests</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="#activity">Activity</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="#notification">Notifications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#profileModal" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a>
      </li>
    </ul>
  </div>
</nav>

<div id="home" class="container my-5">
  <div class="row g-4">
  
    <div class="col-md-3">
      <div class="card card-hover card-glass text-center">
        <div class="card-body">
          <h5 class="card-title">Available Drug Details</h5>
          <p class="card-text">View all drug names, stock, expiry, and more.</p>
          <a href="{{ route('view.medicine') }}" class="btn btn-outline-light">Go to Inventory</a>
        </div>
      </div>
    </div>

   
    <div class="col-md-3">
      <div class="card card-hover card-glass text-center">
        <div class="card-body">
          <h5 class="card-title">Drug Requests</h5>
          <h1 class="text-warning">{{ $pending }}</h1>
          <p class="card-text">Pending drug requests.</p>
        </div>
      </div>
    </div>

   
    <div class="col-md-3">
      <div class="card card-hover card-glass text-center">
        <div class="card-body">
          <h5 class="card-title">Approved Drugs</h5>
          <h1 class="text-success">{{ $approved }}</h1>
          <p class="card-text">Approved drug requests.</p>
        </div>
      </div>
    </div>

   
    <div class="col-md-3">
      <div class="card card-hover card-glass text-center">
        <div class="card-body">
          <h5 class="card-title">Declined Drugs</h5>
          <h1 class="text-danger">{{ $declined }}</h1>
          <p class="card-text">Declined drug requests.</p>
        </div>
      </div>
    </div>

  </div>
</div>



<div class="container">
    <h2>Request Medicine</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('drugrequests.store') }}">
    @csrf

    
    <div class="mb-3">
        <label for="medicine_id" class="form-label">Select Medicine</label>
        <select name="medicine_id" id="medicine_id" class="form-control @error('medicine_id') is-invalid @enderror" required>
            <option value="">-- Choose Medicine --</option>
            @foreach($medicines as $medicine)
                <option value="{{ $medicine->id }}" {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                    {{ $medicine->medicine_name }} (Available: {{ $medicine->quantity }}) - ${{ $medicine->price }}
                </option>
            @endforeach
        </select>
        @error('medicine_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

   
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" id="quantity" min="1" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required>
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    
    <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
    <input type="hidden" name="user_role" value="{{ auth()->user()->user_role }}">
    <input type="hidden" name="requested_by" value="{{ auth()->user()->name }}">
    <input type="hidden" name="status" value="Pending">

    <button type="submit" class="btn btn-primary">Submit Request</button>
</form>

</div>




<div id="activity" class="container my-5">
  <h3 class="text-center mb-4">Recent Activity</h3>
  <div class="activity-glass">
    <ul class="list-group">
      @foreach ($recentActivity as $activity)
        <li class="list-group-item">
          <strong>Drug: {{ $activity->medicine->medicine_name }}</strong>
          <p>Status: <span class="badge {{ $activity->status == 'approved' ? 'bg-success' : ($activity->status == 'declined' ? 'bg-danger' : 'bg-warning') }}">{{ ucfirst($activity->status) }}</span></p>
        </li>
      @endforeach
    </ul>
  </div>
</div>


<div id="notification" class="container my-5">
    <h3 class="text-center mb-4">Notifications</h3>

    @if($notifications->isEmpty())
        <div class="alert alert-info">
            No new notifications at the moment.
        </div>
    @else
        @foreach($notifications as $note)
            <div class="alert alert-secondary mb-3">
                <strong>Date:</strong> {{ $note->created_at->format('d M Y, h:i A') }}<br>

                @if($note->login_id && $note->generated_password)
                    <strong>Login ID:</strong> {{ $note->login_id }}<br>
                    <strong>Password:</strong> {{ $note->generated_password }}<br>
                @endif

                @if($note->message)
                    <strong>Message:</strong> {{ $note->message }}<br>
                @endif

                <small><em>Role: {{ $note->role }}</em></small>
            </div>
        @endforeach
    @endif
</div>


<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profile Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item">Username: Username</li>
          <li class="list-group-item">User ID: 0</li>
          <li class="list-group-item">Email: user@example.com</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
