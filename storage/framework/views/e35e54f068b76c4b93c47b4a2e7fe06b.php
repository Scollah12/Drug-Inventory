

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Medicine</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .header {
      background-color: #e6e6e6;
      width: 1000px;
      border-radius: 1rem;
      margin-left: 12%;
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
  <source src="<?php echo e(asset('inventoryvideos/delete1.mp4')); ?>" type="video/mp4">
</video>

<div class="main-content">
  <nav class="navbar bg-body-tertiary" aria-label="Light offcanvas navbar">
    <div class="container-fluid">
      <a class="navbar-brand" ><img src="<?php echo e(asset('logo.jpg')); ?>" alt="logo" style="height: 25px;"> Dons_Medicos</a>
      <span class="navbar-text text-muted fw-bold" style="font-size: 1rem;">"Efficiency In Every Prescription"</span>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel"><img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo" style="height: 25px;"> Dons_Medicos</h5>
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

  <div class="container mt-5">
    <div class="header">
      <h2 class="text-center mb-4">Delete Medicine</h2>
    </div>

    <form method="POST" action="<?php echo e(route('delete_medicine')); ?>" class="row g-3 mb-4">
    <?php echo csrf_field(); ?>
    <div class="col-md-8">
        <input type="text" name="search_term" class="form-control" placeholder="Enter medicine name or ID" value="<?php echo e(old('search_term')); ?>">
    </div>
    <div class="col-md-4 d-flex gap-2">
        <button type="submit" name="search" class="btn btn-primary w-50">Search</button>
        <button type="submit" name="view_all" class="btn btn-secondary w-50" value="1">View All</button>
    </div>
</form>


<?php if($search_result): ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Expiry Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $search_result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($medicine->medicine_id); ?></td>
                <td><?php echo e($medicine->medicine_name); ?></td>
                <td><?php echo e($medicine->quantity); ?></td>
                <td><?php echo e($medicine->expiry_date); ?></td>
                <td>
                <form method="POST" action="<?php echo e(route('delete_medicine')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="delete_id" value="<?php echo e($medicine->medicine_id); ?>">
    <button type="submit" name="delete" value="1" class="btn btn-danger btn-sm">Delete</button>
</form>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No medicines found.</p>
<?php endif; ?>


  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/druginventorymodule/delete_medicine.blade.php ENDPATH**/ ?>