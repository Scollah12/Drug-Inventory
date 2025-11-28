@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Notifications</h2>

    @forelse($notifications as $note)
        <div class="alert alert-info mt-3">
            {{ $note->notification }}<br>
            <small>Sent on {{ $note->created_at->format('d M Y, h:i A') }}</small>
        </div>
    @empty
        <p>No notifications yet.</p>
    @endforelse
</div>
@endsection
