@extends('layouts.admin')

@section('title', 'View Category - ' . $portfolioCategory->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-tag"></i> View Category</h1>
        <div>
            <a href="{{ route('admin.portfolio-categories.edit', $portfolioCategory) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.portfolio-categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i> Category Details
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label><strong>ID:</strong></label>
                        <p class="text-muted">{{ $portfolioCategory->id }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Name:</strong></label>
                        <p class="text-muted">{{ $portfolioCategory->name }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Slug:</strong></label>
                        <p class="text-muted"><code>{{ $portfolioCategory->slug }}</code></p>
                    </div>
                    <div class="form-group">
                        <label><strong>Created At:</strong></label>
                        <p class="text-muted">{{ $portfolioCategory->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Updated At:</strong></label>
                        <p class="text-muted">{{ $portfolioCategory->updated_at->format('F d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i> Statistics
                    </h3>
                </div>
                <div class="card-body">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Total Portfolios in this Category</span>
                            <span class="info-box-number text-center mb-0">
                                {{ $portfolioCategory->portfolios->count() }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><strong>SEO Keywords:</strong></label>
                        <div class="mt-2">
                            @if($portfolioCategory->keywords)
                                @foreach(explode(',', $portfolioCategory->keywords) as $keyword)
                                    <span class="badge badge-secondary mr-1">{{ trim($keyword) }}</span>
                                @endforeach
                            @else
                                <p class="text-muted">No keywords specified</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-folder-open"></i> Portfolios in this Category
            </h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portfolioCategory->portfolios as $portfolio)
                    <tr>
                        <td>{{ $portfolio->id }}</td>
                        <td>
                            @if($portfolio->image)
                                <img src="{{ asset($portfolio->image) }}" width="40" height="40" style="object-fit: cover; border-radius: 5px;">
                            @else
                                <i class="fas fa-image fa-2x text-muted"></i>
                            @endif
                        </td>
                        <td>{{ $portfolio->title }}</td>
                        <td>{{ $portfolio->location ?: '-' }}</td>
                        <td>
                            <a href="{{ route('admin.portfolios.show', $portfolio) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No portfolios in this category.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop