<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Medicine</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <style>
    body {
      font-family: Arial, sans-serif;
      
      margin: 0;
      padding: 0;
    }

    .grid-form-container {
      width: 50%;
      margin: 50px auto;
      background-color: #f5f5f5;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .grid-form-container h2 {
      text-align: center;
      background-color: #e0e0e0;
      color: #0b3b63;
      padding: 10px;
      border-radius: 5px;
    }

    .grid-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px 40px ;
      margin-top: 30px;
    }

    .grid-form label {
      align-self: center;
    }

    .grid-form input,
    .grid-form select {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 100%;
    }

    .btn-container {
      grid-column: span 2;
      text-align: center;
    }

    .submit-btn {
      padding: 10px 25px;
      background-color: #0077b6;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .submit-btn:hover {
      background-color: #005f8f;
    }
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
  </style>
</head>
<body>
<video autoplay muted loop class="video-bg">
<source src="{{ asset('inventoryvideos/add_medicine.mp4') }}" type="video/mp4">
  Your browser does not support the video tag.
</video>
<div class="main-content">

<nav class="navbar bg-body-tertiary" aria-label="Light offcanvas navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.html"><img src="{{ asset('logo.jpg') }}" alt="logo"  style="height: 25px;">Dons_Medicos</a>
      <span class="navbar-text text-muted fw-bold" style="font-size: 1rem;">
        "Efficiency In Every Prescription"
      </span>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
        <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel"> <img src="{{ asset('logo.jpg') }}" alt="logo" style="height: 25px;">Dons_Medicos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('inventory.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('medicine.create') }}">Add Medicine</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('view.medicine') }}">View Medicine</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('medicine.update') }}">Update Medicine</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('medicines.expiry') }}">Expiring/Expired Medicine</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('delete_medicine') }}">Delete Medicine</a>
            </li>
            
          </ul>
         
        </div>
      </div>
    </div>
</nav>
  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
  <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
    Medicine added successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php endif; ?>


  <div class="grid-form-container">
    <h2>ADD MEDICINE DETAILS</h2>
    <form action="{{ route('medicine.store') }}" method="POST" class="grid-form">
    @csrf

      <label for="medicine_id">Medicine ID:</label>
      <input type="text" id="medicine_id" name="medicine_id" required>

      
      <label for="medicine_name">Medicine Name:</label>
      <input type="text" id="medicine_name" name="medicine_name" required>

      <label for="location">Location:</label>
      <input type="text" id="location" name="location">
      
      <label for="price">Price:</label>
      <input type="number" id="price" step="0.01" name="price" required>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" required>

      <label for="category">Category:</label>
      <select id="category" name="category" required>
        <option value="Tablet">Tablet</option>
        <option value="Capsule">Capsule</option>
        <option value="Syrup">Syrup</option>
        <option value="Injection">Injection</option>
      </select>
      <label for="expiry_date">Expiry Date:</label>
      <input type="date" id="expiry_date" name="expiry_date" required>


      <div class="btn-container">
        <button type="submit" class="submit-btn">Add Medicine</button>
      </div>
    </form>
  </div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
