@extends('layouts.admin')

@section('content')
    <div class="container card card-primary p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1>

                Custom CSS

            </h1>

            <a href="{{ route('admin.custom-css.create') }}" class="btn btn-success">

                Add CSS

            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>CSS Preview</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($customCss as $css)
                        <tr>

                            <td>

                                {{ $css->id }}

                            </td>

                            <td>

                                <pre style="white-space: pre-wrap;">{{ Str::limit($css->content_css, 300) }}</pre>

                            </td>

                            <td>

                                <a href="{{ route('admin.custom-css.edit', $css->id) }}" class="btn btn-primary btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('admin.custom-css.destroy', $css->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete CSS?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                No CSS Found

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection
