@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url({{ asset('drugrequest.jpg') }});
        background-size: cover;
    }
</style>

<div class="container py-4">
    <a href="{{ route('pharmacist.dashboard') }}" class="btn btn-danger mb-3">
        <i class="bi bi-box-arrow-left"></i> Go Back
    </a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">📦 Drug Requests Management</h2>
    </div>

<div class="container">
    

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
    <tr>
        <th>Request ID</th>
        <th>Medicine Name</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>User ID</th>
        <th>User Role</th>
        <th>Requested By</th>
        <th>Requested At</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @forelse($requests as $request)
        <tr>
            <td>{{ $request->id }}</td>
            <td>{{ $request->medicine->medicine_name }}</td>
            <td>{{ $request->quantity }}</td>
            <td>{{ ucfirst($request->status) }}</td>
            <td>{{ $request->user->id }}</td>
            <td>{{ $request->user->role }}</td>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <form action="{{ route('pharmacist.requests.updateStatus', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                </form>
                <form action="{{ route('pharmacist.requests.updateStatus', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="declined">
                    <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center">No requests found.</td>
        </tr>
    @endforelse
</tbody>

    </table>
</div>



        @if($requests instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="card-footer">
                {{ $requests->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
