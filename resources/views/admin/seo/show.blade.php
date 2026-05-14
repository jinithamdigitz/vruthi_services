@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>SEO Details: {{ $seoParameter->route_name }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px;">Route/Page</th>
                    <td>{{ $seoParameter->route_name }}</td>
                </tr>
                <tr>
                    <th>Meta Title</th>
                    <td>{{ $seoParameter->meta_title ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Meta Description</th>
                    <td>{{ $seoParameter->meta_description ?? '—' }}</td>
                </tr>
                <tr>
                    <th>OG Image</th>
                    <td>
                        @if($seoParameter->og_image)
                            <img src="{{ asset('storage/' . $seoParameter->og_image) }}" 
                                 style="max-width: 300px;">
                        @else
                            No image
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Created</th>
                    <td>{{ $seoParameter->created_at->format('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <th>Last Updated</th>
                    <td>{{ $seoParameter->updated_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('admin.seo.edit', $seoParameter->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection