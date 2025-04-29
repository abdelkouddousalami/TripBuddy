@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Owner Dashboard</h1>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Messages</h4>
                </div>
                <div class="card-body">
                    @if($messages->count() > 0)
                        <div class="list-group">
                            @foreach($messages->whereNull('parent_id') as $message)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $message->subject }}</h5>
                                        <small>{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $message->message }}</p>
                                    <small>From: {{ $message->sender->name }} - Regarding: {{ $message->hotel->name }}</small>
                                    
                                    @foreach($messages->where('parent_id', $message->id) as $reply)
                                        <div class="ms-4 mt-3 p-3 bg-light rounded">
                                            <div class="d-flex w-100 justify-content-between">
                                                <small class="fw-bold">{{ $reply->sender->name }}</small>
                                                <small>{{ $reply->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0">{{ $reply->message }}</p>
                                        </div>
                                    @endforeach

                                    <div class="mt-3">
                                        <form action="{{ route('messages.reply', $message) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" name="message" class="form-control" placeholder="Type your reply..." required>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-reply"></i> Reply
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center mb-0">No messages yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Your Properties</h4>
                </div>
                <div class="card-body">
                    @if($hotels->count() > 0)
                        <div class="list-group">
                            @foreach($hotels as $hotel)
                                <a href="{{ route('hotels.show', $hotel) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $hotel->name }}</h6>
                                        <small>{{ $hotel->city }}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-plus"></i> Add New Property
                            </a>
                        </div>
                    @else
                        <p class="text-center mb-3">No properties yet.</p>
                        <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-plus"></i> Add Your First Property
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #2c5a27;
    --primary-color-rgb: 44, 90, 39;
    --secondary-color: #4a7856;
}

.card {
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.card-header {
    background-color: white;
    border-bottom: 2px solid #f8f9fa;
}

.list-group-item {
    border: none;
    border-bottom: 1px solid #f8f9fa;
    margin-bottom: 1rem;
    padding: 1rem;
}

.list-group-item:last-child {
    border-bottom: none;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
}

.input-group .form-control {
    border-right: none;
}

.input-group .btn {
    border-left: none;
    padding-left: 1rem;
    padding-right: 1rem;
}
</style>
@endsection