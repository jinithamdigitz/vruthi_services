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

                <p>
                    <strong>Slug :</strong>
                    {{ $service->slug }}
                </p>

                @if ($service->image)
                    <img src="{{ asset($service->image) }}" width="200" alt="{{ $service->title }}">
                @endif

                <h3>
                    {{ $service->title }}
                </h3>

                <p>
                    <strong>Keyword :</strong>
                    {{ $service->keyword ?? '-' }}
                </p>

                <p>
                    <strong>Description / Body :</strong><br>
                    {!! $service->body ?? '-' !!}
                </p>

            </div>
        </div>

        <br>

        <a href="{{ route('services.index') }}" class="btn btn-primary">
            Back
        </a>

    </div>
@endsection