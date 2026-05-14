@extends('layouts.admin')

@section('content')
    <div class="container">

        <h2>Scrap Request Details</h2>

        <a href="{{ route('admin.scrap_requests.index') }}" class="btn btn-secondary mb-3">
            Back
        </a>


        <table class="table table-bordered">

            <tr>
                <th>Name</th>
                <td>{{ $request->full_name }}</td>
            </tr>

            <tr>
                <th>Phone</th>
                <td>{{ $request->phone }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $request->email }}</td>
            </tr>

            <tr>
                <th>Location</th>
                <td>{{ $request->location }}</td>
            </tr>

            <tr>
                <th>Scrap Type</th>
                <td>{{ implode(', ', json_decode($request->scrap_type)) }}</td>
            </tr>

            <tr>
                <th>Details</th>
                <td>{{ $request->details }}</td>
            </tr>

            <tr>
                <th>Date</th>
                <td>{{ $request->created_at }}</td>
            </tr>

        </table>

    </div>
@endsection
