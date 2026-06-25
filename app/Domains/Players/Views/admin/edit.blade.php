@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Edit Player</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.players.update', $player->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $player->name) }}" class="form-control">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $player->email) }}" class="form-control">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" id="position" name="position" value="{{ old('position', $player->position) }}" class="form-control">
            @error('position')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="team" class="form-label">Team</label>
            <input type="text" id="team" name="team" value="{{ old('team', $player->team) }}" class="form-control">
            @error('team')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Player</button>
            <a href="{{ route('admin.players.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
