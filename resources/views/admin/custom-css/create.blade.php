@extends('layouts.admin')

@section('content')

<div class="container card card-primary p-4">

    <h1 class="mb-4">

        Create Custom CSS

    </h1>

    <form action="{{ route('admin.custom-css.store') }}"
          method="POST">

        @csrf

        <!-- Custom CSS -->
        <div class="mb-3">

            <label class="form-label">

                Custom CSS

            </label>

            <textarea name="content_css"
                      class="form-control"
                      rows="20"
                      placeholder="Write custom css here...">{{ old('content_css') }}</textarea>

            @error('content_css')

                <small class="text-danger">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <!-- Buttons -->
        <button class="btn btn-success">

            Save CSS

        </button>

        <a href="{{ route('admin.custom-css.index') }}"
           class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection