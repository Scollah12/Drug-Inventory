

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
       
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-image: url('add_user.webp'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.1); 
            border-radius: 15px;
            padding: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            width: 400px;
            max-width: 100%;
            text-align: center;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
            font-weight: 600;
        }

        input, select, button {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        input, select {
            background-color: rgba(255, 255, 255, 0.2);
            color: black;
        }

        input::placeholder, select::placeholder {
            color: #ddd;
        }

        button {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0046ad;
        }

        .popup {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1000;
        }

        .popup button {
            background-color:rgb(17, 140, 198);
            margin-top: 10px;
        }

        .tooltip {
            font-size: 12px;
            color: #ddd;
        }
    </style>
</head>
<div>


    <div class="container">
        <h2>Add New User</h2>
        <form method="POST" action="<?php echo e(route('add_user.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="text" name="name" placeholder="Name" required>
            <div class="tooltip">Enter the user's full name.</div>

            <input type="email" name="email" placeholder="Email" required>
            <div class="tooltip">Enter a valid email address.</div>

            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="Admin">Admin</option>
                <option value="Pharmacist">Pharmacist</option>
                <option value="Supplier">Supplier</option>
                <option value="Inventory Manager">Inventory Manager</option>
                <option value="User">User</option>
            </select>
            <div class="tooltip">Choose the role for the user.</div>

            <button type="submit">Register User</button>
        </form>
    </div>

    <?php if(isset($user_id) && isset($password)): ?>
       
        <div class="popup" id="popup">
            <p>User ID: <?php echo e($user_id); ?><br>Password: <?php echo e($password); ?></p>
            <button onclick="closePopup()">Close</button>
        </div>
        <script>
           
            document.getElementById('popup').style.display = 'block';
            function closePopup() {
                document.getElementById('popup').style.display = 'none';
            }
        </script>
    <?php endif; ?>

    <div>
    <form action="<?php echo e(route('admin.dashboard')); ?>">
    <?php echo csrf_field(); ?>
    <button type="submit" style="background-color: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
        Go Back
    </button>
</form>
        </div>
</body>
</html>
<?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/add_user.blade.php ENDPATH**/ ?>