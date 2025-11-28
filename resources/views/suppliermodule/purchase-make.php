<?php
include 'config.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$suppliers = mysqli_query($conn, "SELECT * FROM suppliers");

if (!$suppliers) {
    die("Error fetching suppliers: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and validate
    $item_name = trim($_POST['item_name']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $sup_id = trim($_POST['sup_id']);

    if (empty($item_name) || empty($sup_id)) {
        echo "<script>alert('Please fill out all fields.');</script>";
    } elseif ($quantity <= 0) {
        echo "<script>alert('Quantity must be a positive number.');</script>";
    } elseif ($price <= 0) {
        echo "<script>alert('Price must be a positive number.');</script>";
    } else {
        // Prepare and execute the insert statement
        $sql = "INSERT INTO orders (item_name, quantity, price, sup_id, status) VALUES (?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sids', $item_name, $quantity, $price, $sup_id);
            if ($stmt->execute()) {
                echo '
                <style>
                    body {
                        margin: 0;
                        font-family: "Inter", sans-serif;
                        background-color: #e0f7fa;
                    }
                    .loading-screen {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background-color: #e0f7fa;
                    }
                    .loader {
                        border: 6px solid #b2ebf2;
                        border-top: 6px solid #0288d1;
                        border-radius: 50%;
                        width: 60px;
                        height: 60px;
                        animation: spin 1s linear infinite;
                        margin-bottom: 20px;
                    }
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    .loading-message {
                        font-size: 20px;
                        font-weight: bold;
                        color: #0288d1;
                    }
                </style>
                <div class="loading-screen">
                    <div class="loader"></div>
                    <div class="loading-message">Placing Order... Please Wait.</div>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "order-view.php?success=true&sup_id=' . $sup_id . '";
                    }, 4000);
                </script>';
                exit;
            } else {
                echo "<script>alert('Error placing order: {$stmt->error}');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing statement: {$conn}');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(135deg, #2196f3 0%, #1e88e5 50%, #1976d2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main {
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
        }

        .main h2 {
            font-size: 26px;
            margin-bottom: 30px;
            color: #fff;
        }

        .input-wrapper {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-wrapper label {
            font-size: 14px;
            color: #f0f0f0;
            margin-bottom: 6px;
            display: block;
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: #1976d2;
            font-size: 15px;
            outline: none;
            transition: background 0.3s;
        }

        input:focus,
        select:focus {
            background: rgba(255, 255, 255, 0.2);
        }

        ::placeholder {
            color: #ddd;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background-color: #fff;
            color: #1976d2;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e3f2fd;
        }

        .back-btn {
            margin-top: 20px;
        }

        .back-btn a {
            color: #fff;
            font-size: 14px;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .back-btn a:hover {
            opacity: 1;
        }

        @media (max-width: 480px) {
            .main {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="main">
    <h2>Place Your Order</h2>
    <form method="POST" action="" id="orderForm">
        <div class="input-wrapper">
            <label for="item_name">Item Name</label>
            <input type="text" name="item_name" id="item_name" required placeholder="e.g. Amoxylin">
        </div>

        <div class="input-wrapper">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" required min="1" step="1" placeholder="e.g. 10">
        </div>

        <div class="input-wrapper">
            <label for="price">Price per Item</label>
            <input type="number" name="price" id="price" required min="0.01" step="0.01" placeholder="e.g. 149.99">
        </div>

        <div class="input-wrapper">
            <label for="sup_id">Select Supplier</label>
            <select name="sup_id" id="sup_id" required>
                <option value="">--Choose Supplier--</option>
                <?php
                if (mysqli_num_rows($suppliers) > 0) {
                    while($row = mysqli_fetch_assoc($suppliers)) {
                        echo "<option value='" . htmlspecialchars($row['sup_id']) . "'>" . htmlspecialchars($row['company_name']) . "</option>";
                    }
                } else {
                    echo "<option>No suppliers found</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit">Submit Order</button>
    </form>

    <div class="back-btn">
        <a href="order-view.php">← Go to Orders</a>
    </div>
</div>

<script>
document.getElementById('orderForm').addEventListener('submit', function(e) {
    const quantity = document.getElementById('quantity').value;
    const price = document.getElementById('price').value;

    if (quantity <= 0 || price <= 0) {
        e.preventDefault();
        alert('Please enter valid values for quantity and price.');
    }
});
</script>

</body>
</html>