<?php
include 'config.php';
session_start();
var_dump($_GET); // See what is being passed

// Validate and fetch supplier ID
if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

    if ($supplier_id === false) {
        $_SESSION['flash_message'] = [
            'type' => 'danger',
            'message' => 'Invalid supplier ID.'
        ];
        header('Location: supplier-view.php');
        exit;
    }

    // Prepare and execute query
    $sql = "SELECT sup_id, company_name, address, phone_number, email_address, rating
        FROM suppliers
        WHERE sup_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " );
    }

    $stmt->bind_param("s", $supplier_id);

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if (!$result) {
        die("Get result failed: " . $stmt->error);
    }

    if ($result->num_rows === 1) {
        $supplier = $result->fetch_assoc();
    } else {
        $_SESSION['flash_message'] = [
            'type' => 'danger',
            'message' => 'Supplier not found.'
        ];
        header('Location: supplier-view.php');
        exit;
    }

    $stmt->close();
} else {
    $_SESSION['flash_message'] = [
        'type' => 'danger',
        'message' => 'Invalid request. Supplier ID not provided.'
    ];
    header('Location: supplier-view.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Details | InventoryPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --primary-light: #e0e7ff;
            --secondary: #6c757d;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --white: #ffffff;
            --sidebar-width: 250px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --card-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.1);
            --card-radius: 16px;
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
            box-shadow: var(--card-shadow);
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
            font-size: 1.3rem;
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

        .sidebar a:hover,
        .sidebar a.active {
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
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .header h1 i {
            color: var(--primary);
        }

        /* Supplier Card */
        .supplier-card {
            background: var(--white);
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .supplier-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--success));
        }

        .supplier-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .supplier-title {
            flex: 1;
        }

        .supplier-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .supplier-id {
            font-size: 0.9rem;
            color: var(--gray);
            background: var(--light);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            display: inline-block;
        }

        .supplier-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .rating-stars {
            color: var(--warning);
            font-size: 1.3rem;
            letter-spacing: 2px;
        }

        .rating-text {
            font-size: 0.9rem;
            color: var(--gray);
        }

        /* Details Grid */
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .detail-group {
            background: var(--light);
            padding: 1.5rem;
            border-radius: 12px;
            transition: var(--transition);
        }

        .detail-group:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .detail-label {
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: var(--dark);
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .detail-value a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }

        .detail-value a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Notes Section */
        .notes-section {
            margin-top: 2rem;
            background: var(--light);
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        .notes-label {
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notes-content {
            color: var(--dark);
            line-height: 1.7;
            white-space: pre-line;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }

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
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background-color: var(--gray);
            color: var(--white);
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #e3174a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(247, 37, 133, 0.2);
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--card-radius);
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Timeline */
        .timeline {
            margin-top: 2rem;
        }

        .timeline-item {
            display: flex;
            margin-bottom: 1.5rem;
            position: relative;
            padding-left: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 2px;
            height: 100%;
            background: var(--primary-light);
        }

        .timeline-dot {
            position: absolute;
            left: -6px;
            top: 0;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--primary);
            z-index: 1;
        }

        .timeline-content {
            flex: 1;
            background: var(--white);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .timeline-date {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }

        .timeline-text {
            color: var(--dark);
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

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .supplier-header {
                flex-direction: column;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .supplier-card {
            animation: fadeIn 0.6s ease-out;
        }

        .detail-group {
            animation: fadeIn 0.6s ease-out;
            animation-fill-mode: both;
        }

        .detail-group:nth-child(1) { animation-delay: 0.1s; }
        .detail-group:nth-child(2) { animation-delay: 0.2s; }
        .detail-group:nth-child(3) { animation-delay: 0.3s; }
        .detail-group:nth-child(4) { animation-delay: 0.4s; }
        .detail-group:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-boxes"></i> <span>InventoryPro</span></h3>
        </div>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        <a href="inventory-view.php"><i class="fas fa-warehouse"></i> <span>Inventory</span></a>
        <a href="supplier-view.php" class="active"><i class="fas fa-truck"></i> <span>Suppliers</span></a>
        <a href="purchase-make.php"><i class="fas fa-cart-plus"></i> <span>New Purchase</span></a>
        <a href="purchase-view.php"><i class="fas fa-receipt"></i> <span>Purchases</span></a>
        <a href="order-view.php"><i class="fas fa-clipboard-list"></i> <span>Orders</span></a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
    </div>

    <div class="content">
        <div class="header">
            <h1><i class="fas fa-truck"></i> Supplier Details</h1>
            <div class="header-actions">
                <a href="supplier-view.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Suppliers
                </a>
            </div>
        </div>

        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="flash-message flash-<?= htmlspecialchars($_SESSION['flash_message']['type']) ?>">
                <span><?= htmlspecialchars($_SESSION['flash_message']['message']) ?></span>
                <button class="close-flash">&times;</button>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

        <?php if (isset($supplier)): ?>
        <div class="supplier-card">
            <div class="supplier-header">
                <div class="supplier-title">
                    <h2 class="supplier-name"><?= htmlspecialchars($supplier['company_name']) ?></h2>
                    <span class="supplier-id">ID: <?= htmlspecialchars($supplier['sup_id']) ?></span>
                    
                    <div class="supplier-rating">
                        <div class="rating-stars">
                            <?php for ($i = 0; $i < $supplier['rating']; $i++): ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                            <?php for ($i = $supplier['rating']; $i < 5; $i++): ?>
                                <i class="far fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="rating-text"><?= htmlspecialchars($supplier['rating']) ?>/5 rating</span>
                    </div>
                </div>
            </div>

            <div class="details-grid">
                <div class="detail-group">
                    <div class="detail-label">Contact Information</div>
                    <div class="detail-value">
                        <?php if (!empty($supplier['contact_person'])): ?>
                            <div><i class="fas fa-user"></i> <?= htmlspecialchars($supplier['contact_person']) ?></div>
                        <?php endif; ?>
                        <div><i class="fas fa-phone"></i> <?= htmlspecialchars($supplier['phone_number']) ?></div>
                        <div><i class="fas fa-envelope"></i> <?= htmlspecialchars($supplier['email_address']) ?></div>
                        <?php if (!empty($supplier['website'])): ?>
                            <div><i class="fas fa-globe"></i> <a href="<?= htmlspecialchars($supplier['website']) ?>" target="_blank"><?= htmlspecialchars($supplier['website']) ?></a></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">Address</div>
                    <div class="detail-value">
                        <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($supplier['address']) ?>
                    </div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">Supplier Since</div>
                    <div class="detail-value">
                        <i class="fas fa-calendar-alt"></i> <?= !empty($supplier['date_added']) ? date('F j, Y', strtotime($supplier['date_added'])) : '01-05-2024' ?>
                    </div>
                </div>
            </div>

            <?php if (!empty($supplier['notes'])): ?>
            <div class="notes-section">
                <div class="notes-label">
                    <i class="fas fa-sticky-note"></i> Additional Notes
                </div>
                <div class="notes-content">
                    <?= nl2br(htmlspecialchars($supplier['notes'])) ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="action-buttons">
                <a href="supplier-edit.php?id=<?= htmlspecialchars($supplier['sup_id']) ?>" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Supplier
                </a>
            </div>
        </div>
        <?php else: ?>
            <div class="supplier-card">
                <p class="text-danger">No supplier details found.</p>
            </div>
        <?php endif; ?>
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