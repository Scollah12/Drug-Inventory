

<?php $__env->startSection('content'); ?>
<style>
    body{
                background-image: url(<?php echo e(asset('adddrug.jpg')); ?> );
                background-size: cover;
                 
                
            }
   .glass-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      color: #fff;
   }

   .table thead {
      background-color: rgba(0, 123, 255, 0.2);
      color: white;
   }

   .table tbody tr:hover {
      background-color: rgba(255, 255, 255, 0.05);
      transition: 0.3s ease;
   }

   .btn {
      border-radius: 50px;
   }

   .expired {
      background-color: rgba(220, 53, 69, 0.7);
      color: white;
      padding: 4px 8px;
      border-radius: 10px;
   }

   .low-stock {
      background-color: rgba(255, 193, 7, 0.7);
      color: black;
      padding: 4px 8px;
      border-radius: 10px;
   }
</style>

<div class="container glass-container mt-4">
<a href="<?php echo e(route('pharmacist.dashboard')); ?>" class="btn btn-danger">
            <i class="bi bi-plus-circle me-1"></i> Go Back
        </a>
   <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0">💊 Drug Stock Inventory</h2>
      
   </div>

   <?php if(session('success')): ?>
      <div class="alert alert-success"><?php echo e(session('success')); ?></div>
   <?php endif; ?>

   <div class="table-responsive">
      <table class="table table-hover table-bordered text-white">
         <thead>
            <tr>
   <th>Name</th>
   <th>Category</th>
   <th>Quantity</th>
   <th>Price</th>
   <th>Expiry Date</th>
   
            </tr>
         </thead>
         <tbody>
            <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <tr>
   <td><?php echo e($stock->name); ?></td>
   <td><?php echo e($stock->category); ?></td>
   <td>
      <?php echo e($stock->quantity); ?>

      <?php if($stock->quantity <= 10): ?>
         <span class="low-stock ms-2">Low</span>
      <?php endif; ?>
   </td>
   <td>₹ <?php echo e(number_format($stock->price, 2)); ?></td>
   <td>
      <?php echo e($stock->expiry_date); ?>

      <?php if(\Carbon\Carbon::parse($stock->expiry_date)->isPast()): ?>
         <span class="expired ms-2">Expired</span>
      <?php endif; ?>
   </td>
  
   </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </tbody>
      </table>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/drugstocks/index.blade.php ENDPATH**/ ?>