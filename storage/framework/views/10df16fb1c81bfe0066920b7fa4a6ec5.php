

<?php $__env->startSection('content'); ?>
<style>
    body{
                background-image: url(<?php echo e(asset('drugbg.jpg')); ?> );
                background-size: cover;      
            }
</style>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-capsule me-2"></i> Add Drug Stock
                    </h4>
                    <a href="<?php echo e(route('drugstocks.index')); ?>" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('drugstocks.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="drugName" placeholder="Drug Name" required>
                            <label for="drugName"><i class="bi bi-capsule me-1"></i> Drug Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="category" class="form-control" id="category" placeholder="Category" required>
                            <label for="category"><i class="bi bi-tags me-1"></i> Category</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity" required>
                            <label for="quantity"><i class="bi bi-123 me-1"></i> Quantity</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="price" class="form-control" id="price" placeholder="Price" step="0.01" required>
                            <label for="price"><i class="bi bi-currency-dollar me-1"></i> Price</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="date" name="expiry_date" class="form-control" id="expiry_date" required>
                            <label for="expiry_date"><i class="bi bi-calendar-event me-1"></i> Expiry Date</label>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-circle me-1"></i> Save Drug Stock
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/drugstocks/create.blade.php ENDPATH**/ ?>