@extends('layouts.app')

@section('content')
<form action="{{ route('notifications.store') }}" method="POST">
    @csrf
    <label for="user_id">Send to specific user (optional):</label>
    <select name="user_id" class="form-control mb-2">
        <option value="">-- Select User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->user_role }})</option>
        @endforeach
    </select>

    <label for="role">Or send to all users with role (optional):</label>
    <select name="role" class="form-control mb-2">
        <option value="">-- Select Role --</option>
        <option value="User">User</option>
        <option value="Supplier">Supplier</option>
        <option value="Pharmacist">Pharmacist</option>
        <option value="Inventory Manager">Inventory Manager</option>
        
    </select>

    <label for="notification">Notification Message:</label>
    <textarea name="notification" class="form-control mb-3" required></textarea>

    <button type="submit" class="btn btn-primary">Send Notification</button>
</form>
@endsection

        
   