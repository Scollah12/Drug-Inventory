<?php
include "config.php";
if (isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    $rating = $_POST['rating'];
    $sup_id = 'SUP' . strtoupper(bin2hex(random_bytes(3)));
    $insert_sql = "INSERT INTO suppliers (sup_id, company_name, address, phone_number, email_address, rating)
                                        VALUES ('$sup_id', '$company_name', '$address', '$phone_number', '$email_address', '$rating')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "<script>
                alert('Supplier added successfully!\\nPlease note the Supplier ID: $sup_id');
                window.location.href = 'supplier-view.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Error adding supplier: {$conn->error}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Supplier | Supplier Management System</title>
    <meta name="description" content="Add new supplier to the system">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #3f37c9;
            --text-dark: #2b2d42;
            --text-light: #8d99ae;
            --background-light: #f8f9fa;
            --white: #ffffff;
            --success-color: #4bb543;
            --error-color: #ff3333;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .form-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2.5rem;
            width: 100%;
            max-width: 640px;
            transition: var(--transition);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #dfe7f1;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: var(--background-light);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .required-field::after {
            content: " *";
            color: var(--error-color);
        }

        .btn {
            display: inline-block;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: var(--border-radius);
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            width: 100%;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            text-align: center;
            width: 100%;
        }

        .back-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .back-link i {
            margin-right: 0.5rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-error {
            background-color: rgba(255, 51, 51, 0.1);
            border-left: 4px solid var(--error-color);
            color: var(--error-color);
        }

        .rating-hint {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
            }
            
            body {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .form-header h2 {
                font-size: 1.5rem;
            }
            
            .form-control {
                padding: 0.65rem 0.9rem;
            }
            
            .btn {
                padding: 0.65rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Add New Supplier</h2>
            <p>Fill in the details below to register a new supplier</p>
        </div>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="supplier-add.php" autocomplete="off">
            <div class="form-group">
                <label for="company_name" class="required-field">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control" 
                        required placeholder="e.g. ABC Corporation">
            </div>
            
            <div class="form-group">
                <label for="address" class="required-field">Address</label>
                <input type="text" name="address" id="address" class="form-control" 
                        required placeholder="Enter full address">
            </div>
            
            <div class="form-group">
                <label for="phone_number" class="required-field">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number" class="form-control" 
                        required placeholder="e.g. 60123456789" pattern="[0-9]{10,15}">
            </div>
            
            <div class="form-group">
                <label for="email_address" class="required-field">Email Address</label>
                <input type="email" name="email_address" id="email_address" class="form-control" 
                        required placeholder="e.g. contact@company.com">
            </div>
            
            <div class="form-group">
                <label for="rating" class="required-field">Supplier Rating</label>
                <input type="number" name="rating" id="rating" class="form-control" 
                        min="1" max="5" required placeholder="1-5">
                <p class="rating-hint">1 = Lowest, 5 = Highest</p>
            </div>
            
            <button type="submit" name="submit" class="btn btn-block">
                <i class="fas fa-plus-circle"></i> Add Supplier
            </button>
        </form>

        <a href="supplier-view.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Supplier List
        </a>
    </div>

    <script>
        // Form validation enhancements
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            
            form.addEventListener('submit', function(e) {
                // Client-side validation
                const rating = document.getElementById('rating').value;
                if (rating < 1 || rating > 5) {
                    alert('Please enter a rating between 1 and 5');
                    e.preventDefault();
                    return false;
                }
                
                return true;
            });
            
            // Input formatting for phone number
            const phoneInput = document.getElementById('phone_number');
            phoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
</body>
</html>
