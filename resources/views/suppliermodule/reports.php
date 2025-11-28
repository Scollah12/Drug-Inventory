<?php
include 'config.php';

// Fetch total purchases per supplier
$query = "
    SELECT s.company_name, 
           COUNT(p.id) AS total_purchases, 
           SUM(p.quantity * p.price) AS total_cost
    FROM suppliers s
    LEFT JOIN purchases p ON s.sup_id = p.sup_id
    GROUP BY s.sup_id
    ORDER BY total_cost DESC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: #f0f8ff;
            color: #333;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1e3d58;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
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

        button {
            display: block;
            margin: 30px auto 0;
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
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

<div class="container">
    <h2>Purchase Report: Total Purchases per Supplier</h2>

    <table>
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Total Purchases</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['company_name']) ?></td>
                    <td><?= $row['total_purchases'] ?></td>
                    <td><?= number_format($row['total_cost'], 2) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <button onclick="window.location.href='order-view.php'"><i class="fas fa-arrow-left"></i> Back to Orders View</button>
</div>

</body>
</html>
