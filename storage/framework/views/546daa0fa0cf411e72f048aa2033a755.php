<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dons_Medicos | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('<?php echo e(asset('pharmacybg.jpg')); ?>') no-repeat center center;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container-box {
            width: 800px;
            height: 500px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            color: #fff;
        }

        .brand-header {
            text-align: center;
            padding: 10px;
        }

        .brand-header img {
            height: 40px;
            margin-bottom: 5px;
        }

        .form-wrapper {
            display: flex;
            width: 200%;
            height: 100%;
            transition: transform 0.6s ease-in-out;
        }

        .form-section {
            width: 50%;
            padding: 30px;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            margin-bottom: 15px;
        }

        .form-control::placeholder {
            color: #eee;
        }

        .form-select option {
            color: #000;
        }

        .btn-primary, .btn-success {
            border: none;
            backdrop-filter: blur(10px);
            width: 100%;
        }

        .btn-primary {
            background: rgba(0,123,255,0.7);
        }

        .btn-success {
            background: rgba(40,167,69,0.7);
        }

        .animated-error {
            color: #ff4d4d;
            animation: fadeIn 0.6s ease-in-out;
            text-align: center;
        }

        .switch-link {
            text-align: center;
            margin-top: 15px;
            cursor: pointer;
            color: #00f;
            font-weight: bold;
        }

        a {
            color: #fff;
            font-size: 0.9em;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container-box">
        <div class="brand-header">
            <img src="<?php echo e(asset('logo.jpg')); ?>" alt="Logo">
            <h2>Dons_Medicos</h2>
            <p>Efficiency In Every Prescription</p>
        </div>

        <?php if(session('error')): ?>
            <div class="animated-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="form-wrapper" id="formWrapper">
           
            <div class="form-section">
                <form method="POST" action="<?php echo e(route('login.custom')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="login_id" placeholder="Login ID" required class="form-control">
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                    <select name="role" class="form-select" required>
                        <option value="">Select Role</option>
                         <option value="admin">admin</option>
                        <option value="Pharmacist">Pharmacist</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Inventory manager">Inventory Manager</option>
                        <option value="user">User</option>
                    </select>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="<?php echo e(route('password.request')); ?>">Forgot Password?</a>
                    </div>
                    <div class="switch-link" onclick="toggleForm()">Admin? Register here</div>
                </form>
            </div>

           
            <div class="form-section">
                <form method="POST" action="<?php echo e(route('register.custom')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="name" class="form-control" placeholder="Admin Name" required>
                    <input type="email" name="email" class="form-control" placeholder="Admin Email" required>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <input type="text" name="role" class="form-control" value="admin" readonly>
                    <button type="submit" class="btn btn-success">Register as Admin</button>
                    <div class="switch-link" onclick="toggleForm()">Back to Login</div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            const wrapper = document.getElementById('formWrapper');
            wrapper.style.transform = wrapper.style.transform === 'translateX(-50%)'
                ? 'translateX(0%)' : 'translateX(-50%)';
        }
    </script>
</body>
</html>
<?php /**PATH C:\Users\Scollah\Desktop\Drug-Inventory-Management\resources\views/auth/login.blade.php ENDPATH**/ ?>