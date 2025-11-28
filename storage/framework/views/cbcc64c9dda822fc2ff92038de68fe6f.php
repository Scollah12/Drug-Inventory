

<?php $__env->startSection('content'); ?>
<style>
    body {
        background-image: url(<?php echo e(asset('drugrequest.jpg')); ?>);
        background-size: cover;
    }
</style>

<div class="container py-4">
    <a href="<?php echo e(route('pharmacist.dashboard')); ?>" class="btn btn-danger mb-3">
        <i class="bi bi-box-arrow-left"></i> Go Back
    </a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">📦 Drug Requests Management</h2>
    </div>

<div class="container">
    

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
    <tr>
        <th>Request ID</th>
        <th>Medicine Name</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>User ID</th>
        <th>User Role</th>
        <th>Requested By</th>
        <th>Requested At</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($request->id); ?></td>
            <td><?php echo e($request->medicine->medicine_name); ?></td>
            <td><?php echo e($request->quantity); ?></td>
            <td><?php echo e(ucfirst($request->status)); ?></td>
            <td><?php echo e($request->user->id); ?></td>
            <td><?php echo e($request->user->role); ?></td>
            <td><?php echo e($request->user->name); ?></td>
            <td><?php echo e($request->created_at->format('Y-m-d H:i')); ?></td>
            <td>
                <form action="<?php echo e(route('pharmacist.requests.updateStatus', $request->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                </form>
                <form action="<?php echo e(route('pharmacist.requests.updateStatus', $request->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <input type="hidden" name="status" value="declined">
                    <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                </form>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="9" class="text-center">No requests found.</td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
</div>



        <?php if($requests instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
            <div class="card-footer">
                <?php echo e($requests->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/drugrequests/index.blade.php ENDPATH**/ ?>