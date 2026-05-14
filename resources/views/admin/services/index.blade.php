@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>Services</h1>

        <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">
            Add Service
        </a>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Text 1</th>
                    <th>Text 2</th>
                    <th>Text 3</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($services as $service)
                    <tr>

                        <td>
                            @if ($service->image)
                                <img src="{{ asset('uploads/services/'.$service->image) }}" width="80">
                            @else
                                No Image
                            @endif
                        </td>

                        <td>
                            {{ $service->title }}
                        </td>

                        <td>
                            {{ $service->description ?? 'No description' }}
                        </td>

                        <td>
                            {{ $service->text1 ?? '-' }}
                        </td>

                        <td>
                            {{ $service->text2 ?? '-' }}
                        </td>

                        <td>
                            {{ $service->text3 ?? '-' }}
                        </td>

                        <td>

                            <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-info btn-sm">Show</a>

                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">Delete</button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7">No Services Found</td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $services->links() }}

    </div>
@endsection