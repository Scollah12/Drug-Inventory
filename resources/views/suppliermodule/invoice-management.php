<?php
include 'config.php';

$result = mysqli_query($conn, "
    SELECT i.*, s.company_name AS _name 
    FROM invoices i
    JOIN suppliers s ON i.sup_id = s.sup_id
    ORDER BY i.due_date DESC
");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Invoice & Payment Management</h2>
<table>
    <thead>
        <tr>
            <th>Invoice ID</th>
            <th>Supplier</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['company_name']) ?></td>
            <td>$<?= number_format($row['amount'], 2) ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= ucfirst($row['status']) ?></td>
            <td>
                <?php if ($row['status'] !== 'paid') { ?>
                    <form method="POST" action="mark-paid.php" style="display:inline;">
                        <input type="hidden" name="invoice_id" value="<?= $row['id'] ?>">
                        <button type="submit">Mark as Paid</button>
                    </form>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>