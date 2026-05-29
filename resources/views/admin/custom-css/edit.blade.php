@extends('layouts.admin')

@section('content')

<div class="container card card-primary p-4">

    <h1 class="mb-4">

        Edit Custom CSS

    </h1>

    <form action="{{ route('admin.custom-css.update', $customCss->id) }}"
          method="POST">

        @csrf

        @method('PUT')

        <!-- Custom CSS -->
        <div class="mb-3">

            <label class="form-label">

                Custom CSS

            </label>

            <textarea name="content_css"
                      class="form-control"
                      rows="20"
                      placeholder="Write custom css here...">{{ old('content_css', $customCss->content_css) }}</textarea>

            @error('content_css')

                <small class="text-danger">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <!-- Buttons -->
        <button class="btn btn-primary">

            Update CSS

        </button>

        <a href="{{ route('admin.custom-css.index') }}"
           class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection