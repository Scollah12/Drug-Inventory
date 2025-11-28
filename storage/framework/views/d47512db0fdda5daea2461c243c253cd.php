

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Expiring & Expired Medicines</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .header {
      background-color: #f5f5f5;
      border-radius: 1rem;
      padding: 1rem;
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
  <source src="inventoryvideos/loss.mp4" type="video/mp4">
</video>
<div class="main-content">
<nav class="navbar bg-body-tertiary" aria-label="Light offcanvas navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.html"><img src="logo.jpg" alt="logo" style="height: 25px;">Dons_Medicos</a>
    <span class="navbar-text text-muted fw-bold" style="font-size: 1rem;">"Efficiency In Every Prescription"</span>
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
          <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('inventory.dashboard')); ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('medicine.create')); ?>">Add Medicine</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo e(route('view.medicine')); ?>">View Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('medicine.update')); ?>">Update Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('medicines.expiry')); ?>">Expiring/Expired Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('delete_medicine')); ?>">Delete Medicine</a></li>
          <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('anomaly.report')); ?>">Anomally Report</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>


<div class="container mt-4">
<div class="text-center">
  <h2 class="mb-4">Expiring Medicines</h2>

  <form action="<?php echo e(route('medicines.expiry.filter')); ?>" method="POST" class="mb-4 d-inline-block">
    <?php echo csrf_field(); ?>
    <div class="d-flex justify-content-center gap-2 flex-wrap">
      <button type="submit" name="view_all" class="btn btn-primary">View All </button>
      <button type="submit" name="view_expiring" class="btn btn-warning"> Expiring Soon</button>
      <button type="submit" name="view_expired" class="btn btn-danger"> Expired</button>
    </div>
  </form>
</div>


  <?php if(isset($expiringMeds) && $expiringMeds->count() > 0): ?>
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
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $expiringMeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $rowClass = $med->expiry_date < $today ? 'table-danger' : 'table-warning';
            ?>
            <tr class="<?php echo e($rowClass); ?>">
              <td><?php echo e($med->medicine_id); ?></td>
              <td><?php echo e($med->medicine_name); ?></td>
              <td><?php echo e($med->location); ?></td>
              <td><?php echo e($med->price); ?></td>
              <td><?php echo e($med->quantity); ?></td>
              <td><?php echo e($med->category); ?></td>
              <td><?php echo e($med->expiry_date->format('Y-m-d')); ?></td>
              <td>
                <?php if($med->expiry_date < $today): ?>
                  <span class="text-danger fw-bold">Expired</span>
                <?php else: ?>
                  <span class="text-dark">Expiring Soon</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  <?php elseif(request()->isMethod('post')): ?>
    <div class="alert alert-info text-center">
      No medicines found for the selected filter.
    </div>
  <?php endif; ?>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/druginventorymodule/expiring.blade.php ENDPATH**/ ?>