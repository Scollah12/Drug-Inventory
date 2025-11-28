<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        $orderId = intval($_POST['order_id']);

        // Get order details including supplier info
        $orderResult = mysqli_query($conn, "SELECT * FROM orders WHERE id = $orderId");
        
        if (!$orderResult || mysqli_num_rows($orderResult) == 0) {
            throw new Exception("Order not found.");
        }

        $order = mysqli_fetch_assoc($orderResult);
        $item_name = $order['item_name'];
        $quantity = intval($order['quantity']);
        $price = floatval($order['price']);
        $purchase_date = date('Y-m-d');
        $total_price = $quantity * $price;

        // Directly get the sup_id from the order table (no modification or verification)
        $sup_id = $order['sup_id'];

        // Prepare the INSERT query with the existing sup_id
        $insertQuery = "INSERT INTO purchases (item_name, quantity, price, purchase_date, total_price, sup_id) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "siisis", $item_name, $quantity, $price, $purchase_date, $total_price, $sup_id);

        // Execute the insert query
        if (!mysqli_stmt_execute($insertStmt)) {
            throw new Exception("Failed to insert into purchases: " . mysqli_error($conn));
        }

        // Prepare the UPDATE query for the order status
        $updateQuery = "UPDATE orders SET status = 'completed' WHERE id = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "i", $orderId);

        // Execute the update query
        if (!mysqli_stmt_execute($updateStmt)) {
            throw new Exception("Failed to update order status.");
        }

        // Commit transaction
        mysqli_commit($conn);
        echo "Order marked as completed and added to purchases successfully!";
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
