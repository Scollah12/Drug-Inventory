<?php
include 'config.php';

// Query to fetch supplier performance data
$result = mysqli_query($conn, "
    SELECT s.sup_id, s.company_name, 
        COUNT(d.id) AS deliveries,
        AVG(CASE WHEN d.on_time = 1 THEN 1 ELSE 0 END) * 100 AS on_time_percentage,
        AVG(r.rating) AS avg_rating
    FROM suppliers s
    LEFT JOIN deliveries d ON s.sup_id = d.sup_id
    LEFT JOIN supplier_ratings r ON s.sup_id = r.sup_id
    GROUP BY s.sup_id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Performance</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f0f8ff;
            color: #333;
        }

        .sidebar {
            position: fixed;
            width: 220px;
            height: 100vh;
            background-color: #1e3d58;
            padding-top: 20px;
            left: 0;
            top: 0;
        }

        .sidebar a {
            display: block;
            color: #eee;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 220px;
            padding: 40px 20px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #1e3d58;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 15px;
        }

        th {
            background-color: #02b6ff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e1f5fe;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            table, th, td {
                font-size: 14px;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="supplier-view.php"><i class="fas fa-truck"></i> Suppliers</a>
        <a href="purchase-make.php"><i class="fas fa-cart-plus"></i>Make Purchase</a>
        <a href="purchase-view.php"><i class="fas fa-history"></i>Purchase History</a>
        <a href="order-view.php"><i class="fas fa-list-alt"></i>View Orders</a>
        <a href="invoice-management.php"><i class="fas fa-file-invoice-dollar"></i> Invoices</a>
         <a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main-content">
    <div class="container">
        <h2>Supplier Performance Monitoring</h2>
        <table>
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Total Deliveries</th>
                    <th>On-Time %</th>
                    <th>Avg. Rating</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['company_name']) ?></td>
                    <td><?= $row['deliveries'] ?></td>
                    <td><?= number_format($row['on_time_percentage'], 1) ?>%</td>
                    <td><?= number_format($row['avg_rating'], 1) ?> / 5</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
