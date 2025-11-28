<?php
include 'config.php';

if (isset($_POST['sup_id'])) {
    $sup_id = mysqli_real_escape_string($conn, $_POST['sup_id']); 

    $query = "SELECT company_name FROM suppliers WHERE sup_id = '$sup_id'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo htmlspecialchars($row['company_name']);
    } else {
        echo "Supplier not found";
    }
} else {
    echo "Invalid request";
}
?>
