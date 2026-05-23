@extends('layouts.admin')

@section('title', 'View Portfolio - ' . $portfolio->title)

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1><i class="fas fa-briefcase"></i> View Portfolio</h1>
    <div>
        <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> Portfolio Details
                </h3>
                <div class="card-tools">
                    <span class="badge badge-primary">ID: {{ $portfolio->id }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Title:</strong></label>
                            <p class="text-muted">{{ $portfolio->title }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Slug:</strong></label>
                            <p class="text-muted"><code>{{ $portfolio->slug }}</code></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Category:</strong></label>
                            <p>
                                <span class="badge badge-info">{{ $portfolio->category->name ?? 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Location:</strong></label>
                            <p class="text-muted">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                                {{ $portfolio->location ?: 'Not specified' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Created At:</strong></label>
                            <p class="text-muted">
                                <i class="fas fa-calendar"></i> {{ $portfolio->created_at->format('F d, Y h:i A') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Updated At:</strong></label>
                            <p class="text-muted">
                                <i class="fas fa-clock"></i> {{ $portfolio->updated_at->format('F d, Y h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-align-left"></i> Description
                </h3>
            </div>
            <div class="card-body">
                <div class="portfolio-body">
                    {!! nl2br(e($portfolio->body)) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-image"></i> Portfolio Image
                </h3>
            </div>
            <div class="card-body text-center">
                @if($portfolio->image)
                <img src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}"
                    class="img-fluid img-thumbnail mb-3" style="max-height: 300px; width: auto;">
                <div class="mt-2">
                    <a href="{{ asset($portfolio->image) }}" target="_blank" class="btn btn-sm btn-info">
                        <i class="fas fa-external-link-alt"></i> View Full Size
                    </a>
                </div>
                @else
                <div class="text-center p-5">
                    <i class="fas fa-image fa-4x text-muted mb-3"></i>
                    <p class="text-muted">No image uploaded</p>
                </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line"></i> Quick Stats
                </h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Total Portfolios in this Category</span>
                        <span class="info-box-number text-center mb-0">
                            {{ $portfolio->category->portfolios->count() ?? 0 }}
                        </span>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label><strong>SEO Keywords:</strong></label>
                    <div class="mt-2">
                        @if($portfolio->keywords)
                        @foreach(explode(',', $portfolio->keywords) as $keyword)
                        <span class="badge badge-secondary mr-1">{{ trim($keyword) }}</span>
                        @endforeach
                        @else
                        <p class="text-muted">No keywords specified</p>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="text-center">
                    <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this portfolio?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Delete Portfolio
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .portfolio-body {
        line-height: 1.8;
        font-size: 14px;
    }

    .portfolio-body p {
        margin-bottom: 15px;
    }

    .info-box {
        margin-bottom: 0;
    }

    .badge {
        font-size: 12px;
        padding: 5px 10px;
    }
</style>
@stop

@section('js')
<script>
    console.log('Portfolio details page loaded');
</script>
@stop