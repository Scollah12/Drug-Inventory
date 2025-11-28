

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('notifications.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <label for="user_id">Send to specific user (optional):</label>
    <select name="user_id" class="form-control mb-2">
        <option value="">-- Select User --</option>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->user_role); ?>)</option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <label for="role">Or send to all users with role (optional):</label>
    <select name="role" class="form-control mb-2">
        <option value="">-- Select Role --</option>
        <option value="User">User</option>
        <option value="Supplier">Supplier</option>
        <option value="Pharmacist">Pharmacist</option>
        <option value="Inventory Manager">Inventory Manager</option>
        
    </select>

    <label for="notification">Notification Message:</label>
    <textarea name="notification" class="form-control mb-3" required></textarea>

    <button type="submit" class="btn btn-primary">Send Notification</button>
</form>
<?php $__env->stopSection(); ?>

        
   
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/admin/send_notification.blade.php ENDPATH**/ ?>