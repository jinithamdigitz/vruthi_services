@extends('layouts.admin')

@section('title', 'Portfolios')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1><i class="fas fa-briefcase"></i> Portfolios</h1>
    <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Portfolio
    </a>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Portfolio Items</h3>
        <div class="card-tools">
            <form method="GET" action="{{ route('admin.portfolios.index') }}">
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search by title or location" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="10%">Image</th>
                    <th width="20%">Title</th>
                    <th width="15%">Category</th>
                    <th width="15%">Location</th>
                    <th width="20%">Slug</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($portfolios as $portfolio)
                <tr>
                    <td>{{ $portfolio->id }}</td>
                    <td>
                        @if($portfolio->image)
                        <img src="{{ asset($portfolio->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                        @else
                        <span class="badge badge-secondary">No Image</span>
                        @endif
                    </td>
                    <td><strong>{{ $portfolio->title }}</strong></td>
                    <td>
                        <span class="badge badge-info">{{ $portfolio->category->name ?? 'N/A' }}</span>
                    </td>
                    <td>
                        @if($portfolio->location)
                        <i class="fas fa-map-marker-alt text-danger"></i> {{ $portfolio->location }}
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td><code>{{ $portfolio->slug }}</code></td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.portfolios.show', $portfolio) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No portfolios found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $portfolios->links() }}
    </div>
</div>
@stop