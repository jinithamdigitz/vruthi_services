@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>View Program</h1>

  <div class="card">
    <div class="card-header">
      <strong>{{ $program->title }}</strong>
    </div>
    <div class="card-body">
      <p><strong>Created Date:</strong> {{ $program->created_date }}</p>
      <p><strong>Description:</strong><br>{!! nl2br(e($program->description)) !!}</p>

      {{-- Main image --}}
      @if($program->image)
      <p>
      <h5> Image:</h5>



      </p>
      @endif

      {{-- Extra images gallery --}}
      @if($program->multipleImages && $program->multipleImages->count())
      <h5>Extra Images:</h5>
      <div class="row">
        @foreach($program->multipleImages as $image)
        <div class="col-md-2 mb-2">
          <img src="{{ asset('storage/' . $image->name) }}" alt="Extra Image" class="img-thumbnail" style="height:100px; width:100px;">
        </div>
        @endforeach
      </div>
      @endif

      <p><strong>Video ID:</strong> {{ $program->video_id }}</p>
      <p><strong>Start Date:</strong> {{ $program->start_date }}</p>
      <p><strong>End Date:</strong> {{ $program->end_date }}</p>
    </div>
  </div>

  <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection