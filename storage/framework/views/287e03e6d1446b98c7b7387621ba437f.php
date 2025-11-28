

<?php $__env->startSection('content'); ?>
<style>
    body {
        background-image: url(<?php echo e(asset('drugbg.jpg')); ?>);
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

<div class="container py-4">
    <h2 class="text-primary mb-4">💊 Request a Drug</h2>

    <form action="<?php echo e(route('drugrequests.store')); ?>" method="POST" class="bg-light p-4 rounded shadow-sm">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Select Drug</label>
            <select name="drugid" class="form-select" required>
                <option value="" disabled selected>-- Choose a Drug --</option>
                <?php $__currentLoopData = $drugstocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->name); ?> (Available: <?php echo e($drug->quantity); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
       

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" min="1" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Submit Request
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/drugrequests/create.blade.php ENDPATH**/ ?>