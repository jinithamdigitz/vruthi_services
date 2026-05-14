@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ old('name', $user->name) }}" type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="{{ old('email', $user->email) }}" type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                <option value="">Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Password (optional) -->
        <div class="mb-3">
            <label for="password" class="form-label">Password <small class="text-muted">(leave blank to keep current)</small></label>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control" placeholder="Confirm new password">
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection