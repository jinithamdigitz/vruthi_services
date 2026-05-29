@extends('layouts.admin')

@section('content')

<div class="container card card-primary p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>

            Custom Javascript

        </h1>

        <a href="{{ route('admin.custom-javascript.create') }}"
           class="btn btn-success">

            Add Javascript

        </a>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Javascript Preview</th>

                    <th width="180">

                        Action

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($customJavascript as $js)

                    <tr>

                        <td>

                            {{ $js->id }}

                        </td>

                        <td>

                            <pre style="white-space: pre-wrap;">{{ Str::limit($js->content_script, 300) }}</pre>

                        </td>

                        <td>

                            <a href="{{ route('admin.custom-javascript.edit', $js->id) }}"
                               class="btn btn-primary btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.custom-javascript.destroy', $js->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Javascript?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No Javascript Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection