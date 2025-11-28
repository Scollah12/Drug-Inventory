

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Directory | InventoryPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #e0e7ff;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --white: #ffffff;
            --sidebar-width: 250px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 2rem 0;
            color: var(--white);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-header h3 {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-header h3 i {
            font-size: 1.5rem;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            margin: 0.5rem 0;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: var(--transition);
        }

        .sidebar a:hover, .sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left: 3px solid var(--success);
        }

        .sidebar a i {
            margin-right: 0.8rem;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content Styles */
        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header h1 {
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 1.8rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        /* Flash Message Styles */
        .flash-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .flash-success {
            background-color: rgba(76, 201, 240, 0.2);
            border-left: 4px solid var(--success);
            color: var(--success);
        }

        .flash-danger {
            background-color: rgba(247, 37, 133, 0.2);
            border-left: 4px solid var(--danger);
            color: var(--danger);
        }

        .close-flash {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Search and Add Container */
        .action-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-form {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-grow: 1;
            max-width: 500px;
        }

        .search-input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: var(--white);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            gap: 0.5rem;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn i {
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .btn-success {
            background-color: var(--success);
            color: var(--white);
        }

        .btn-success:hover {
            background-color: #3aa8d8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 201, 240, 0.2);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #e5177b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(247, 37, 133, 0.2);
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            margin-bottom: 2rem;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 1rem;
        }

        .supplier-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            position: sticky;
            top: 0;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: var(--primary-light);
        }

        .rating {
            display: inline-flex;
            gap: 2px;
        }

        .rating-star {
            color: var(--warning);
        }

        .empty-star {
            color: #ddd;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border-radius: 6px;
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            color: var(--gray);
        }

        .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--primary);
        }

        .action-btn.delete:hover {
            color: var(--danger);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                overflow: hidden;
            }

            .sidebar-header h3 span, 
            .sidebar a span {
                display: none;
            }

            .sidebar a {
                justify-content: center;
                padding: 0.8rem;
            }

            .sidebar a i {
                margin-right: 0;
                font-size: 1.3rem;
            }

            .content {
                margin-left: 80px;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-form {
                width: 100%;
                max-width: 100%;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 1rem;
            }

            th, td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.3rem;
            }
            .action-btn {
    margin-right: 8px;
    text-decoration: none;
    font-size: 18px;
}
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-boxes"></i> <span>Supplier Dept</span></h3>
        </div>
        <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        <a href="<?php echo e(route('view.medicine')); ?>"><i class="fas fa-warehouse"></i> <span>Inventory</span></a>
        <a href="<?php echo e(route('suppliers.index')); ?>" class="active"><i class="fas fa-truck"></i> <span>Suppliers</span></a>
        <a href="purchase-make.php"><i class="fas fa-cart-plus"></i> <span>New Purchase</span></a>
        <a href="<?php echo e(route('purchases.index')); ?>"><i class="fas fa-receipt"></i> <span>Purchases</span></a>
        <a href="<?php echo e(route('pending.orders')); ?>"><i class="fas fa-clipboard-list"></i> <span>Orders</span></a>
        <a href="<?php echo e(route('login.custom')); ?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
    </div>

    <div class="content">
        <div class="header">
            <h1><i class="fas fa-truck"></i> Supplier Directory</h1>
        </div>

       

    <?php if(session('flash_message')): ?>
        <div class="flash-message flash-<?php echo e(session('flash_message.type')); ?>">
            <span><?php echo e(session('flash_message.message')); ?></span>
            <button class="close-flash" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    <?php endif; ?>

    
    <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex align-items-center w-100 gap-2">
        <!-- Search Form -->
        <form method="GET" action="<?php echo e(route('suppliers.index')); ?>" class="d-flex flex-grow-1 gap-2">
            <input type="text" name="search" value="<?php echo e($search); ?>" class="form-control form-control-lg" placeholder="Search Suppliers...">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <!-- Add Supplier Button -->
        <a href="" class="btn btn-success btn-lg">
            <i class="fas fa-plus-circle"></i> Add Supplier
        </a>
    </div>
</div>


    <div class="table-container">
        <table class="supplier-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($supplier->sup_id); ?></td>
                    <td><?php echo e($supplier->company_name); ?></td>
                    <td><?php echo e($supplier->address); ?></td>
                    <td><?php echo e($supplier->phone_number); ?></td>
                    <td><?php echo e($supplier->email_address); ?></td>
                    <td>
                        <div class="rating">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo e($i <= $supplier->rating ? 'rating-star' : 'empty-star'); ?>"></i>
                            <?php endfor; ?>
                        </div>
                    </td>
                    <td>
                       <div class="d-flex gap-2">
    <!-- View Link -->
    <a href="" class="action-btn text-primary" title="View Details">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Edit Link -->
    <a href="<?php echo e(route('supplier.edit')); ?> method='POST'" class="action-btn text-warning" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Delete Link -->
    <a href="#" class="action-btn text-danger" title="Delete"
       onclick="event.preventDefault(); if(confirm('Delete this supplier?')) document.getElementById('delete-form-<?php echo e($supplier->sup_id); ?>').submit();">
        <i class="fas fa-trash-alt"></i>
    </a>

    <!-- Hidden Delete Form -->
    <form id="delete-form-<?php echo e($supplier->sup_id); ?>" action="<?php echo e(route('suppliers.destroy', $supplier->sup_id)); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>
</div>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7">No suppliers found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


    <script>
        // Close flash message
        document.querySelector('.close-flash')?.addEventListener('click', function() {
            this.closest('.flash-message').style.opacity = '0';
            setTimeout(() => {
                this.closest('.flash-message').remove();
            }, 300);
        });

        // Auto-hide flash message after 5 seconds
        const flashMessage = document.querySelector('.flash-message');
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.opacity = '0';
                setTimeout(() => {
                    flashMessage.remove();
                }, 300);
            }, 5000);
        }
    </script>
</body>
</html>
<?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/suppliermodule/supplier-view.blade.php ENDPATH**/ ?>