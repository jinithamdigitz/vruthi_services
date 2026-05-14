@extends('layouts.admin')

@section('content')

<h3 class="mb-3">Enquiries List</h3>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Search Form --}}
<form method="GET" action="{{ route('admin.enquiry.index') }}" class="mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <input type="text" name="name" class="form-control" 
                   placeholder="Search by name..." 
                   value="{{ request('name') }}">
        </div>
        
        <div class="col-md-3">
            <input type="text" name="contact_number" class="form-control" 
                   placeholder="Search by contact number..." 
                   value="{{ request('contact_number') }}">
        </div>
        
        <div class="col-md-3">
            <input type="text" name="location" class="form-control" 
                   placeholder="Search by location..." 
                   value="{{ request('location') }}">
        </div>
        
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.enquiry.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($enquiries as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->location }}</td>
            <td>{{ $row->contact_number }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->message }}</td>
            <td>{{ $row->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
{{ $enquiries->appends(request()->query())->links() }}

@endsection