@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Form Submissions</h3>
                    <div class="card-tools">
                        <form action="{{ route('admin.contact.index') }}" method="GET" class="form-inline">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="search" class="form-control float-right" 
                                       placeholder="Search by name, email, phone" 
                                       value="{{ request('search') }}">
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
                    <table class="table table-hover text-nowrap" style="width:100%;">
                        <colgroup>
                            <col style="width:5%">
                            <col style="width:12%">
                            <col style="width:18%">
                            <col style="width:12%">
                            <col style="width:15%">
                            <col style="width:10%">
                            <col style="width:8%">
                            <col style="width:20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name/Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Service</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($submissions as $submission)
                            @php
                            // Service mapping array
                            $services = [
                                'signage' => 'Signage & Boards',
                                'graphics' => 'Graphics & Printing',
                                'glass_films' => 'Glass Films & Decals',
                                'laser_cutting' => 'Laser Cutting Services',
                                'channel_bending' => 'Channel Bending',
                                'liquid_acrylic' => 'Liquid Acrylic Works',
                                'lamination' => 'Lamination Services',
                                'other' => 'Other Services'
                            ];
                            
                            // City mapping
                            $cities = [
                                'thiruvananthapuram' => 'Thiruvananthapuram',
                                'kollam' => 'Kollam',
                                'pathanamthitta' => 'Pathanamthitta',
                                'alappuzha' => 'Alappuzha',
                                'kottayam' => 'Kottayam',
                                'idukki' => 'Idukki',
                                'ernakulam' => 'Ernakulam/Kochi',
                                'thrissur' => 'Thrissur',
                                'palakkad' => 'Palakkad',
                                'malappuram' => 'Malappuram',
                                'kozhikode' => 'Kozhikode',
                                'wayanad' => 'Wayanad',
                                'kannur' => 'Kannur',
                                'kasaragod' => 'Kasaragod'
                            ];
                            
                            $service_display = $services[$submission->service_interest] ?? ucfirst(str_replace('_', ' ', $submission->service_interest));
                            $city_display = $cities[$submission->city] ?? ucfirst($submission->city);
                            @endphp
                            <tr>
                                <td>#{{ $submission->id }}</td>
                                <td>
                                    <strong>{{ $submission->full_name }}</strong>
                                    @if($submission->company)
                                        <br><small class="text-muted">{{ $submission->company }}</small>
                                    @endif
                                </td>
                                <td style="word-break: break-all;">
                                    <a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a>
                                </td>
                                <td>
                                    <a href="tel:{{ $submission->phone }}">{{ $submission->phone }}</a>
                                </td>
                                <td>
                                    <span style="display:inline-block; padding:3px 7px; background-color:#17a2b8; color:white; border-radius:4px; font-size:12px; font-weight:bold; white-space: nowrap;">
                                        {{ $service_display }}
                                    </span>
                                </td>
                                <td>{{ $city_display }}</td>
                                <td>{{ $submission->created_at->format('d M Y') }}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('admin.contact.show', $submission->id) }}" 
                                       style="display:inline-block; padding:3px 10px; background-color:#17a2b8; color:white; text-decoration:none; border-radius:3px; font-size:12px; margin-right:5px;">
                                        View
                                    </a>
                                    <form action="{{ route('admin.contact.destroy', $submission->id) }}" 
                                          method="POST" 
                                          style="display:inline-block;"
                                          onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding:3px 10px; background-color:#dc3545; color:white; border:none; border-radius:3px; font-size:12px; cursor:pointer;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align:center; padding:20px;">
                                    <p style="color:#6c757d; margin:0;">No submissions found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $submissions->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection