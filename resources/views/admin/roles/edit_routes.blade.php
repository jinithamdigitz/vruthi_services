@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Assign Routes to Role: {{ $role->name }}</h1>
    <form action="{{ route('admin.roles.update_routes', $role->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            @foreach($allRoutes as $route)
                <div class="form-check">
                    <input type="checkbox" name="routes[]" value="{{ $route }}"
                        class="form-check-input"
                        {{ in_array($route, $assignedRoutes) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $route }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Save Routes</button>
    </form>
</div>
@endsection