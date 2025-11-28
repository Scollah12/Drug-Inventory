

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #3f37c9;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --white: #ffffff;
            --sidebar-width: 280px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark);
            line-height: 1.6;
            transition: var(--transition);
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-light) 100%);
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
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: var(--transition);
        }

        .sidebar a:hover, .sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left: 3px solid var(--white);
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
            color: var(--primary);
            font-weight: 700;
            font-size: 1.8rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        /* Card Styles */
        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
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
            background-color: rgba(67, 97, 238, 0.05);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            gap: 0.5rem;
        }

        .btn i {
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: var(--success);
            color: var(--white);
        }

        .btn-success:hover {
            background-color: #3ab7d8;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #e5177a;
            transform: translateY(-2px);
        }

        .btn-warning {
            background-color: var(--warning);
            color: var(--white);
        }

        .btn-warning:hover {
            background-color: #e68a1a;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 0.35rem 0.65rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .badge-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        body.dark-mode .card,
        body.dark-mode table {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        body.dark-mode th {
            background-color: #2d3748;
        }

        body.dark-mode td {
            border-bottom: 1px solid #2d3748;
        }

        body.dark-mode tr:hover td {
            background-color: rgba(47, 69, 126, 0.3);
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

            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 1rem;
            }

            .btn {
                width: 100%;
            }

            .header-actions {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-box-open"></i> <span>Supplier System</span></h3>
        </div>
        <a href="<?php echo e(route('view.medicine')); ?>"><i class="fas fa-boxes"></i> <span>Inventory</span></a>
        <a href="purchase-make.php" class="active"><i class="fas fa-cart-plus"></i> <span>New Order</span></a>
        <a href="<?php echo e(route('suppliers.index')); ?>"><i class="fas fa-truck"></i> <span>Suppliers</span></a>
        <a href="<?php echo e(route('purchases.index')); ?>"><i class="fas fa-receipt"></i> <span>Purchases</span></a>
        <a href="<?php echo e(route('purchase.report')); ?>"><i class="fas fa-chart-bar"></i> <span>Reports</span></a>
    </div>


    <div class="header">
        <h1><?php echo e($supplier ? 'Filtered' : 'All'); ?> Pending Orders</h1>
        <div class="header-actions">
            <button class="btn btn-primary" id="toggleDarkMode">
                <i class="fas fa-moon"></i> <span>Dark Mode</span>
            </button>
            <?php if($supplier): ?>
                <button class="btn btn-warning" onclick="window.location.href='<?php echo e(route('pending.orders', ['sup_id' => $supplier->sup_id])); ?>'">
                    <i class="fas fa-list"></i> <span>View Completed Orders for this Supplier</span>
                </button>
            <?php else: ?>
                <button class="btn btn-warning" onclick="window.location.href='<?php echo e(route('pending.orders')); ?>'">
                    <i class="fas fa-list"></i> <span>View All Completed Orders</span>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $statusClass = match(strtolower($order->status)) {
                                'pending' => 'badge-pending',
                                'processing' => 'badge-processing',
                                'completed' => 'badge-completed',
                                'cancelled' => 'badge-cancelled',
                                default => '',
                            };
                        ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->item_name); ?></td>
                            <td><?php echo e($order->quantity); ?></td>
                            <td>$<?php echo e(number_format($order->price, 2)); ?></td>
                            <td><?php echo e($order->company_name); ?></td>
                            <td><span class="badge <?php echo e($statusClass); ?>"><?php echo e(ucfirst($order->status)); ?></span></td>
                       
          <td>
            <button @click="completeOrder(order.id)" class="btn btn-success btn-sm">
              <i class="fas fa-check-circle"></i> Complete
            </button>
            <button @click="cancelOrder(order.id)" class="btn btn-danger btn-sm">
              <i class="fas fa-times-circle"></i> Cancel
            </button>
          </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Dark mode toggle
        $('#toggleDarkMode').click(function() {
            $('body').toggleClass('dark-mode');
            const isDark = $('body').hasClass('dark-mode');
            $(this).html(
                isDark 
                    ? '<i class="fas fa-sun"></i> <span>Light Mode</span>'
                    : '<i class="fas fa-moon"></i> <span>Dark Mode</span>'
            );
            
            // Store preference in localStorage
            localStorage.setItem('darkMode', isDark);
        });

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            $('body').addClass('dark-mode');
            $('#toggleDarkMode').html('<i class="fas fa-sun"></i> <span>Light Mode</span>');
        }

        // Complete order button
 $('.complete-btn').click(function() {
    const orderId = $(this).data('id');
    const hasSupplier = $(this).closest('tr').find('td:nth-child(5)').text().trim() !== 'No Supplier';
    
    // Confirm completion with different messages based on supplier status
    const confirmMessage = hasSupplier 
        ? 'Are you sure you want to mark this order as completed?'
        : 'WARNING: This order has no supplier assigned. Are you sure you want to mark it as completed?';
    
    if (confirm(confirmMessage)) {
        // Show loading indicator
        $(this).html('<i class="fas fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
        
        $.post('complete-order.php', { order_id: orderId })
            .done(function(response) {
                if (response.startsWith('Error')) {
                    // Show error message with details
                    alert(response);
                } else {
                    // Success - reload after short delay
                    setTimeout(() => location.reload(), 500);
                }
            })
            .fail(function(xhr, status, error) {
                // Detailed error message
                alert(`Error completing order: ${error}\n\nPlease check the console for details.`);
                console.error('Order completion error:', status, error, xhr.responseText);
            })
            .always(function() {
                // Reset button state
                $('.complete-btn[data-id="'+orderId+'"]')
                    .html('<i class="fas fa-check"></i> Complete')
                    .prop('disabled', false);
            });
    }
});

        // Cancel order button

        $('.cancel-btn').click(function() {
            const orderId = $(this).data('id');
            if (confirm('Are you sure you want to cancel this order?')) {
                $.post('cancel-order.php', { order_id: orderId })
                    .done(function(response) {
                        alert(response);
                        location.reload();
                    })
                    .fail(function() {
                        alert('Error canceling order. Please try again.');
                    });
            }
        });
    });
    </script>
</body>
</html><?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/suppliermodule/order-view.blade.php ENDPATH**/ ?>