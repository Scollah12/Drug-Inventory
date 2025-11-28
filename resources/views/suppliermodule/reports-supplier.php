<?php
include 'config.php';

$suppliers = mysqli_query($conn, "SELECT sup_id, name FROM suppliers");
$filter = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sup_id = mysqli_real_escape_string($conn, $_POST['sup_id']);
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $filter = "WHERE p.sup_id = '$sup_id' AND p.purchase_date BETWEEN '$start' AND '$end'";
}

$query = "SELECT p.*, s.name FROM purchases p JOIN suppliers s ON p.sup_id = s.sup_id $filter ORDER BY p.purchase_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Supplier Reports</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Supplier Purchase Reports</h2>
<form method="POST">
    <label>Supplier:</label>
    <select name="sup_id">
        <?php while($s = mysqli_fetch_assoc($suppliers)) { ?>
            <option value="<?= $s['sup_id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
        <?php } ?>
    </select>
    <label>Start Date:</label>
    <input type="date" name="start_date" required>
    <label>End Date:</label>
    <input type="date" name="end_date" required>
    <button type="submit">Generate</button>
</form>

<?php if ($filter): ?>
<table>
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price/Unit</th>
            <th>Total</th>
            <th>Purchase Date</th>
            <th>Supplier</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total = 0;
        while($row = mysqli_fetch_assoc($result)) { 
            $line_total = $row['price'] * $row['quantity'];
            $total += $line_total;
        ?>
        <tr>
            <td><?= htmlspecialchars($row['item_name']) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>$<?= number_format($row['price'], 2) ?></td>
            <td>$<?= number_format($line_total, 2) ?></td>
            <td><?= $row['purchase_date'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<p><strong>Total Purchase Cost:</strong> $<?= number_format($total, 2) ?></p>
<?php endif; ?>

</body>
</html>