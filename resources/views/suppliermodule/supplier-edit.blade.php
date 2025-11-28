
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --primary-hover: #2980b9;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --border-radius: 0.375rem;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            color: #495057;
            line-height: 1.6;
        }
        
        .container-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 700px;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.25rem;
            border-bottom: none;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
        }
        
        .alert {
            border-radius: var(--border-radius);
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background-color: rgba(46, 204, 113, 0.1);
            border-left: 4px solid var(--success-color);
            color: var(--success-color);
        }
        
        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--danger-color);
            color: var(--danger-color);
        }
        
        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .rating-stars {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .rating-stars input[type="radio"] {
            display: none;
        }
        
        .rating-stars label {
            font-size: 1.5rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .rating-stars input[type="radio"]:checked ~ label {
            color: #ffc107;
        }
        
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #ffc107;
        }
    </style>
</head>
<body>
 

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white">
            <h4>Edit Supplier</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('supplier.update') }}" method="POST">
                @csrf
                <input type="hidden" name="sup_id" value="{{ $supplier->sup_id }}">

                <div class="mb-3">
                    <label for="sup_name" class="form-label">Supplier Name</label>
                    <input type="text" name="sup_name" class="form-control" value="{{ old('sup_name', $supplier->sup_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="sup_contact" class="form-label">Contact Number</label>
                    <input type="text" name="sup_contact" class="form-control" value="{{ old('sup_contact', $supplier->sup_contact) }}" required>
                </div>

                <div class="mb-3">
                    <label for="sup_email" class="form-label">Email</label>
                    <input type="email" name="sup_email" class="form-control" value="{{ old('sup_email', $supplier->sup_email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="sup_address" class="form-label">Address</label>
                    <textarea name="sup_address" class="form-control" rows="3" required>{{ old('sup_address', $supplier->sup_address) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>




@push('scripts')
<script>
    // Phone number formatting
    document.getElementById('phone_number')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^\d]/g, '');
    });
</script>
@endpush

</body>
</html>