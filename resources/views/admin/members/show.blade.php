@extends('layouts.admin')

@section('title', 'Member Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Member Details: {{ $member->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.members.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            @if($member->image && file_exists(public_path($member->image)))
                                <img src="{{ asset($member->image) }}" width="150" height="150" style="object-fit: cover; border-radius: 50%;">
                            @else
                                <img src="https://ui-avatars.com/api/?background=70132E&color=fff&size=150&name={{ urlencode($member->name) }}" width="150" height="150" style="border-radius: 50%;">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">ID</th>
                                    <td>{{ $member->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $member->name }}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>{{ $member->designation ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td><code>{{ $member->slug }}</code></td>
                                </tr>
                                <tr>
                                    <th>Keywords</th>
                                    <td>{{ $member->keyword ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $member->created_at->format('F j, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $member->updated_at->format('F j, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $member->description ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection