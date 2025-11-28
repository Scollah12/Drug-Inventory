

<!DOCTYPE html>
<html>
<head>
    <title>Anomaly Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #e6e6e6;
            width: 1000px;
            border-radius: 1rem;
            margin-left: 12%;
        }
    </style>
</head>
<body>
<nav class="navbar bg-body-tertiary mb-5" aria-label="Light offcanvas navbar">
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
  
 <div class="container mt-5">
        <h2 class="mb-4 text-center">Anomaly Report</h2>

        <?php if($alerts->count() > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Medicine ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($medicine->medicine_id); ?></td>
                            <td><?php echo e($medicine->medicine_name); ?></td>
                            <td><?php echo e($medicine->quantity); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($medicine->expiry_date)->format('Y-m-d')); ?></td>
                            <td>
                                <?php if($medicine->quantity < 100): ?>
                                    <span class="badge bg-warning">Low Stock</span>
                                <?php endif; ?>
                                <?php if(\Carbon\Carbon::parse($medicine->expiry_date)->isPast()): ?>
                                    <span class="badge bg-danger">Expired</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-success text-center">
                No anomalies detected. All medicines are within safe limits.
            </div>
        <?php endif; ?>
    </div>

    <a href="<?php echo e(route('clear.log')); ?>" class="btn btn-danger mt-4">Clear Anomaly Log</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

<?php if(session('cleared')): ?>
    <p>The log was successfully cleared!</p>
<?php endif; ?>


</body>
</html><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/druginventorymodule/anomally_report.blade.php ENDPATH**/ ?>