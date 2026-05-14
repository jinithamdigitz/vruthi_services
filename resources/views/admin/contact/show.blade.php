@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Submission Details #{{ $submission->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contact.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
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
                            
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 150px;">Full Name:</th>
                                    <td>{{ $submission->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>
                                        <a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>
                                        <a href="tel:{{ $submission->phone }}">{{ $submission->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Company:</th>
                                    <td>{{ $submission->company ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Service Interest:</th>
                                    <td>
                                        <span style="display:inline-block; padding:5px 10px; background-color:#17a2b8; color:white; border-radius:4px; font-weight:bold;">
                                            {{ $service_display }}
                                        </span>
                                        <small class="text-muted ml-2">({{ $submission->service_interest }})</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th>City:</th>
                                    <td>{{ $city_display }}</td>
                                </tr>
                                <tr>
                                    <th>Submitted On:</th>
                                    <td>{{ $submission->created_at->format('F d, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Project Description</h4>
                                </div>
                                <div class="card-body">
                                    <p class="lead">{{ $submission->project_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <form action="{{ route('admin.contact.destroy', $submission->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this submission?');"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete Submission
                                </button>
                            </form>
                            
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection