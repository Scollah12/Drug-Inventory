

<?php $__env->startSection('content'); ?>
<style>
    body{
                background-image: url(<?php echo e(asset('drugbg.jpg')); ?> );
                background-size: cover;      
            }
</style>
<div class="container">
    <h2>Edit Drug Stock</h2>
    
    <form action="<?php echo e(route('drugstocks.update', $stock->id)); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label class="form-label">Drug Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo e($stock->name); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="<?php echo e($stock->category); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="<?php echo e($stock->quantity); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="<?php echo e($stock->price); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" value="<?php echo e($stock->expiry_date); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/drugstocks/edit.blade.php ENDPATH**/ ?>