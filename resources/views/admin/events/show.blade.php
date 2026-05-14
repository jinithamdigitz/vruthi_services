@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>View Event</h1>

    <div class="card">
        <div class="card-header">
            <strong>{{ $event->name }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Created Date:</strong> {{ $event->created_date }}</p>
            <p><strong>Description:</strong><br>{!! nl2br(e($event->description)) !!}</p>

         @if($event->image)
    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Main Image" style="max-width:200px;">
@endif

@if($event->multipleImages && $event->multipleImages->count())
    <h5>Event Gallery</h5>
    <div class="row">
        @foreach($event->multipleImages as $image)
            <div class="col-md-2 mb-2">
                <img src="{{ asset('storage/' . $image->name) }}" class="img-thumbnail" alt="Extra Image" style="width:100px; height:100px;">
            </div>
        @endforeach
    </div>
@endif


            @if($event->multipleImages && $event->multipleImages->count())
                <h5>Event Gallery</h5>
                <div class="row">
                    @foreach($event->multipleImages as $image)
                        <div class="col-md-2 mb-2">
                            <img src="{{ asset('storage/' . $image->name) }}" class="img-thumbnail" alt="Extra Image" style="width:100px; height:100px;">
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
