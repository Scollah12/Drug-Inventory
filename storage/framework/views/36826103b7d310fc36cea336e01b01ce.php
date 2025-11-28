

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Completed Purchases</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #4cc9f0;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
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
            border-left: 3px solid var(--secondary);
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
            color: var(--primary-dark);
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

        /* Search Bar Styles */
        .search-container {
            margin-bottom: 2rem;
        }

        .search-form {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: var(--transition);
            max-width: 400px;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        /* Supplier Info */
        .supplier-info {
            background: rgba(67, 97, 238, 0.1);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .supplier-info h3 {
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            margin-bottom: 2rem;
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
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            gap: 0.5rem;
            text-decoration: none;
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
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
        }

        .btn-warning {
            background-color: var(--warning);
            color: var(--dark);
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
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

        body.dark-mode .search-input {
            background-color: #2d3748;
            color: #e0e0e0;
            border-color: #4a5568;
        }

        body.dark-mode .supplier-info {
            background-color: rgba(47, 69, 126, 0.3);
        }

        body.dark-mode .supplier-info h3 {
            color: #a0aec0;
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

            .search-form {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-input {
                width: 100%;
                max-width: 100%;
            }

            .btn-group {
                flex-direction: column;
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
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-boxes"></i> <span>Supplier System</span></h3>
        </div>
        <a href="<?php echo e(route('suppliers.index')); ?>"><i class="fas fa-truck"></i> <span>Suppliers</span></a>
        <a href="<?php echo e(route('pending.orders')); ?>" class="active"><i class="fas fa-clipboard-list"></i> <span>Orders</span></a>
    </div>

    
<div class="content">
    <div class="header">
        <h1>Completed Purchases</h1>
    </div>

    <div class="search-container">
        <form method="GET" action="<?php echo e(route('purchases.index')); ?>" class="search-form">
            <input type="text" name="supplier_name" class="search-input" placeholder="Search Supplier..." value="<?php echo e(request('supplier_name')); ?>">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
        </form>
    </div>

    <?php if($supplier_name): ?>
        <div class="supplier-info">
            <h3>Supplier: <?php echo e($supplier_name); ?></h3>
        </div>
    <?php endif; ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Purchase ID</th>
                    <th>Supplier</th>
                    <th>Purchase Date</th>
                    <th>Amount</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($purchase->id); ?></td>
                        <td><?php echo e($purchase->company_name); ?></td>
                        <td><?php echo e($purchase->purchase_date); ?></td>
                        <td><?php echo e($purchase->amount); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4">No purchases found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



            <div class="btn-group">
                <a href="order-view.php" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> <span>Back to Pending Orders</span>
                </a>
                <a href="purchase-make.php" class="btn btn-success">
                    <i class="fas fa-cart-plus"></i> <span>Create New Purchase</span>
                </a>
            </div>
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

        // Autocomplete for supplier name
        $('#supplier_name').on('input', function() {
            var query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: 'autocomplete.php', // Create a new file named autocomplete.php
                    method: "POST",
                    data: {query: query},
                    success: function(data) {
                        $('#suggestions').html(data);
                        $('#suggestions').show();
                    }
                });
            } else {
                $('#suggestions').hide();
                $('#suggestions').html('');
            }
        });

        // Handle suggestion selection
        $(document).on('click', '#suggestions li', function() {
            $('#supplier_name').val($(this).text());
            $('#suggestions').hide();
        });

        // Hide suggestions on click outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#supplier_name').length && !$(e.target).closest('#suggestions').length) {
                $('#suggestions').hide();
            }
        });
    });
    </script>
</body>
</html>
<?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/suppliermodule/purchase-view.blade.php ENDPATH**/ ?>