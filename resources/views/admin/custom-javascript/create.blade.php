@extends('layouts.admin')

@section('content')

<div class="container card card-primary p-4">

    <h1 class="mb-4">

        Create Custom Javascript

    </h1>

    <form action="{{ route('admin.custom-javascript.store') }}"
          method="POST">
          
        @csrf

        <!-- Javascript -->
        <div class="mb-3">

            <label class="form-label">

                Custom Javascript

            </label>

            <textarea name="content_script"
                      class="form-control"
                      rows="20"
                      placeholder="Write javascript here...">{{ old('content_script') }}</textarea>

            @error('content_script')

                <small class="text-danger">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <!-- Buttons -->
        <button class="btn btn-success">

            Save Javascript

        </button>

        <a href="{{ route('admin.custom-javascript.index') }}"
           class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection