@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Trip</h1>
    <form action="{{ route('trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $trip->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $trip->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $trip->date) }}">
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location', $trip->location) }}">
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Photos (Optional)</label>
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="file" class="form-control @error('photo1') is-invalid @enderror" 
                           name="photo1" accept="image/*">
                    @if($trip->photo1)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $trip->photo1) }}" alt="Current photo 1" class="img-thumbnail" style="height: 100px">
                        </div>
                    @endif
                    @error('photo1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <input type="file" class="form-control @error('photo2') is-invalid @enderror" 
                           name="photo2" accept="image/*">
                    @if($trip->photo2)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $trip->photo2) }}" alt="Current photo 2" class="img-thumbnail" style="height: 100px">
                        </div>
                    @endif
                    @error('photo2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <input type="file" class="form-control @error('photo3') is-invalid @enderror" 
                           name="photo3" accept="image/*">
                    @if($trip->photo3)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $trip->photo3) }}" alt="Current photo 3" class="img-thumbnail" style="height: 100px">
                        </div>
                    @endif
                    @error('photo3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <small class="text-muted">You can upload up to 3 photos (optional). Leave empty to keep current photos. Supported formats: JPEG, PNG, JPG. Max size: 2MB each.</small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Trip</button>
    </form>
</div>
@endsection