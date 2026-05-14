@extends('layouts.admin')

@section('content')
<div class="container">

    <h1>Projects</h1>

    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary mb-3">
        Add Project
    </a>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Main Image</th>
                <th>Gallery</th>
                <th>Name</th>
                <th>Category</th>
                <th>Skills</th>
                <th>Experience</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($projects as $project)

            @php
                $skills = is_array($project->skills) 
                    ? $project->skills 
                    : explode(',', $project->skills ?? '');

                $skills = array_filter(array_map('trim', $skills));
            @endphp

            <tr>

                <!-- MAIN IMAGE -->
                <td>
                    @if($project->image)
                        <img src="{{ asset($project->image) }}" width="80">
                    @else
                        No Image
                    @endif
                </td>

                <!-- GALLERY -->
                <td>
                    @if($project->images->count() > 0)

                        @foreach($project->images->take(3) as $img)
                            <img src="{{ asset($img->image) }}" width="40" style="margin-right:3px;">
                        @endforeach

                        @if($project->images->count() > 3)
                            <br>
                            <small>+{{ $project->images->count() - 3 }} more</small>
                        @endif

                    @else
                        No Images
                    @endif
                </td>

                <!-- NAME -->
                <td>
                    {{ $project->name }}
                </td>

                <!-- CATEGORY -->
                <td>
                    {{ $project->category->name ?? '-' }}
                </td>

                <!-- SKILLS -->
                <td>
                    @foreach(array_slice($skills, 0, 3) as $skill)
                        <span>{{ $skill }}</span><br>
                    @endforeach
                </td>

                <!-- EXPERIENCE -->
                <td>
                    {{ $project->experience ?? '-' }}
                </td>

                <!-- CREATED -->
                <td>
                    {{ $project->created_at->format('d M Y') }}
                </td>

                <!-- ACTION -->
                <td>

                    <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-info btn-sm">
                        Show
                    </a>

                    <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="8">No Projects Found</td>
            </tr>

            @endforelse

        </tbody>

    </table>

    {{ $projects->links() }}

</div>
@endsection