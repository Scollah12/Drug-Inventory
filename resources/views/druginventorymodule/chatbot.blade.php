
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Medicine Chatbot</h2>

    <form method="POST" action="{{ route('chatbot.handle') }}">
        @csrf
        <input type="text" name="msg" class="form-control" placeholder="Type: anomalies, low stock, expiring">
        <button type="submit" class="btn btn-primary mt-2">Send</button>
    </form>

    @isset($response)
        <div class="mt-4 alert alert-info">{!! $response !!}</div>
    @endisset
</div>
@endsection
