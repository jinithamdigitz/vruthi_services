@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>SEO Parameters for Static Pages</h3>
            <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">Add New SEO</a>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page/Route</th>
                        <th>Meta Title</th>
                        <th>Meta Description</th>
                        <th>OG Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seoParameters as $seo)
                    <tr>
                        <td>{{ $seo->id }}</td>
                        <td>
                            <strong>{{ $seo->route_name }}</strong>
                            @php
                            $routeNames = [
                            '/' => 'Home',
                            '/about' => 'About Us',
                            '/services' => 'Services',
                            '/portfolio' => 'Portfolio',
                            '/blogs' => 'Blogs',
                            '/contact' => 'Contact',
                            '/programs' => 'Programs',
                            '/events' => 'Events',
                            '/projects' => 'Projects',
                            '/facilities' => 'Facilities',
                            ];
                            @endphp
                            <br>
                            <small class="text-muted">{{ $routeNames[$seo->route_name] ?? 'Custom Route' }}</small>
                        </td>
                        <td>{{ $seo->meta_title ?? $seo->title ?? '—' }}</td>
                        <td>{{ Str::limit($seo->meta_description, 50) ?? '—' }}</td>
                        <td>
                            @if($seo->og_image)
                            <img src="{{ asset('storage/' . $seo->og_image) }}" style="max-width: 50px; max-height: 50px;" class="img-thumbnail">
                            @else
                            <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.seo.show', $seo->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.seo.edit', $seo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.seo.destroy', $seo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this SEO parameter?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No SEO parameters found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection