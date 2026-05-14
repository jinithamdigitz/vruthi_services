@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>Service Details</h1>

        <div class="card">

            <div class="card-body text-center">

                <p>
                    <strong>ID :</strong>
                    {{ $service->id }}
                </p>

                @if ($service->image)
                    <img src="{{ asset('uploads/services/'.$service->image) }}" width="200">
                @endif

                <h3>
                    {{ $service->title }}
                </h3>

                <p>
                    <strong>Description :</strong><br>
                    {{ $service->description ?? '-' }}
                </p>

                <p>
                    <strong>Text 1 :</strong><br>
                    {{ $service->text1 ?? '-' }}
                </p>

                <p>
                    <strong>Text 2 :</strong><br>
                    {{ $service->text2 ?? '-' }}
                </p>

                <p>
                    <strong>Text 3 :</strong><br>
                    {{ $service->text3 ?? '-' }}
                </p>

            </div>

        </div>

        <br>

        <!-- Gallery Images -->
        <h4>Gallery Images</h4>

        <div class="row">

            @foreach($service->images as $img)

                <div class="col-md-3 mb-3">
                    <img src="{{ asset('uploads/service-gallery/'.$img->image) }}" 
                         class="img-fluid rounded border">
                </div>

            @endforeach

        </div>

        <br>

        <a href="{{ route('admin.services.index') }}" class="btn btn-primary">
            Back
        </a>

    </div>
@endsection