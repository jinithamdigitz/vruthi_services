@extends('layouts.admin')

@section('title', 'Project Details - ' . $project->name)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
        <div class="my-2">
            <h1 class="h3 mb-1 text-gray-800">Project Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="my-2">
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    <!-- Project Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-info-circle mr-2"></i>Project Information
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column - Image -->
                <div class="col-md-4 text-center mb-4">
                    @if($project->image)
                    <img src="{{ asset($project->image) }}" 
                         alt="{{ $project->name }}"
                         class="img-fluid rounded shadow-sm"
                         style="max-height: 250px; width: auto;">
                    @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center p-5">
                        <i class="fas fa-image fa-4x text-secondary"></i>
                    </div>
                    @endif
                </div>

                <!-- Right Column - Details -->
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Project ID</th>
                            <td><span class="badge badge-primary p-2">#{{ $project->id }}</span></td>
                        </tr>
                        <tr>
                            <th>Project Name</th>
                            <td><strong class="text-primary">{{ $project->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>
                                @if($project->category)
                                <div class="d-flex align-items-center">
                                    @if($project->category->image)
                                    <img src="{{ asset($project->category->image) }}" 
                                         alt="{{ $project->category->name }}"
                                         class="rounded mr-2"
                                         width="30" height="30"
                                         style="object-fit: cover;">
                                    @endif
                                    <span>{{ $project->category->name }}</span>
                                </div>
                                @else
                                <span class="text-muted">No category assigned</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Experience Required</th>
                            <td>
                                @if($project->experience)
                                <span class="badge badge-success p-2">
                                    <i class="fas fa-clock mr-1"></i> {{ $project->experience }}
                                </span>
                                @else
                                <span class="text-muted">Not specified</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Skills</th>
                            <td>
                                @php
                                    $skills = is_array($project->skills) 
                                        ? $project->skills 
                                        : explode(',', $project->skills ?? '');
                                    $skills = array_filter(array_map('trim', $skills));
                                @endphp
                                
                                @if(count($skills) > 0)
                                    <div class="d-flex flex-wrap">
                                        @foreach($skills as $skill)
                                        <span class="badge badge-info p-2 mr-2 mb-2">
                                            {{ $skill }}
                                        </span>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">Total: {{ count($skills) }} skills</small>
                                @else
                                    <span class="text-muted">No skills listed</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created Date</th>
                            <td>
                                <i class="fas fa-calendar-alt text-primary mr-1"></i>
                                {{ $project->created_at->format('d M, Y') }} at 
                                {{ $project->created_at->format('h:i A') }}
                                <br>
                                <small class="text-muted">{{ $project->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>
                                <i class="fas fa-history text-warning mr-1"></i>
                                {{ $project->updated_at->format('d M, Y') }} at 
                                {{ $project->updated_at->format('h:i A') }}
                                <br>
                                <small class="text-muted">{{ $project->updated_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Description Section -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h6 class="mb-0 font-weight-bold text-primary">
                                <i class="fas fa-file-alt mr-2"></i>Description
                            </h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-0" style="white-space: pre-line;">{{ $project->description }}</p>
                            <hr>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Description length: {{ strlen($project->description) }} characters
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Images Section -->
    @if($project->images && $project->images->count() > 0)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-images mr-2"></i>Project Gallery
                <span class="badge badge-primary ml-2">{{ $project->images->count() }} images</span>
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($project->images as $image)
                <div class="col-md-3 col-sm-4 col-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="{{ asset($image->image) }}" 
                                 alt="Gallery Image {{ $loop->iteration }}"
                                 class="card-img-top img-fluid rounded"
                                 style="height: 200px; object-fit: cover; cursor: pointer;"
                                 onclick="showImageModal('{{ asset($image->image) }}', '{{ $project->name }} - Image {{ $loop->iteration }}')">
                            <div class="overlay-icon position-absolute" 
                                 style="bottom: 10px; right: 10px; background: rgba(0,0,0,0.6); border-radius: 50%; padding: 5px 8px;">
                                <i class="fas fa-search-plus text-white small"></i>
                            </div>
                        </div>
                        <div class="card-body p-2 text-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt"></i> 
                                {{ $image->created_at->format('d M Y') }}
                            </small>
                            <br>
                            <button type="button" 
                                    class="btn btn-sm btn-outline-danger mt-1"
                                    onclick="confirmDeleteImage({{ $image->id }}, '{{ $image->image }}')">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-images mr-2"></i>Project Gallery
            </h6>
        </div>
        <div class="card-body text-center py-5">
            <i class="fas fa-images fa-3x text-muted mb-3"></i>
            <p class="text-muted mb-0">No gallery images available for this project.</p>
            <small class="text-muted">Add images when editing the project</small>
        </div>
    </div>
    @endif

    <!-- Related Projects (Optional) -->
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-project-diagram mr-2"></i> Related Projects (Same Category)
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($relatedProjects as $related)
                <div class="col-md-3 mb-3">
                    <div class="card h-100 border-left-primary">
                        <div class="card-body text-center">
                            @if($related->image)
                            <img src="{{ asset($related->image) }}" 
                                 alt="{{ $related->name }}"
                                 class="img-fluid rounded mb-2"
                                 style="max-height: 60px;">
                            @endif
                            <h6 class="card-title text-primary font-weight-bold small">
                                {{ Str::limit($related->name, 30) }}
                            </h6>
                            <a href="{{ route('admin.projects.show',$project->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                View
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Section -->
    <div class="card shadow mb-4 border-left-danger">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-danger mb-1">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
                    </h6>
                    <p class="small text-muted mb-0">Once you delete a project, there is no going back. All gallery images will also be deleted.</p>
                </div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash mr-2"></i> Delete Project
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal for Fullscreen View -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="imageModalTitle">
                    <i class="fas fa-image mr-2"></i>Gallery Image
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" alt="Full Size Image" class="img-fluid" style="max-height: 80vh; width: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Image Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Delete Gallery Image
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to delete this gallery image?</p>
                <div class="text-center mb-3">
                    <img id="deleteImagePreview" src="" alt="Image to delete" class="img-thumbnail" style="max-height: 150px;">
                </div>
                <p class="text-danger text-center mb-0">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    This action cannot be undone!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form id="deleteImageForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete Image
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Project Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Confirm Delete
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    @if($project->image)
                    <img src="{{ asset($project->image) }}" 
                         alt="{{ $project->name }}"
                         class="img-thumbnail"
                         style="max-height: 100px;">
                    @endif
                </div>
                <p class="text-center">Are you sure you want to delete this project?</p>
                <div class="alert alert-warning text-center">
                    <strong>{{ $project->name }}</strong>
                    <br>
                    <small>Category: {{ $project->category->name ?? 'Uncategorized' }}</small>
                    @if($project->images->count() > 0)
                    <br>
                    <small class="text-danger">
                        <i class="fas fa-images"></i> This will also delete {{ $project->images->count() }} gallery image(s)
                    </small>
                    @endif
                </div>
                <p class="text-danger text-center mb-0">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    This action cannot be undone!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete Project
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<style>
    .table th {
        width: 200px;
        background-color: #f8f9fc;
        vertical-align: middle;
    }
    .table td {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.85rem;
    }
    .border-left-primary {
        border-left: 4px solid #4e73df !important;
    }
    .border-left-danger {
        border-left: 4px solid #e74a3b !important;
    }
    .gallery-image {
        transition: transform 0.3s ease;
    }
    .gallery-image:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .overlay-icon {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .position-relative:hover .overlay-icon {
        opacity: 1;
    }
</style>

<script>
    $(function () {
        // Auto-hide alerts after 5 seconds
        $('.alert').delay(5000).fadeOut(500);
    });

    // Show image in fullscreen modal
    function showImageModal(imageUrl, title) {
        $('#imageModalTitle').text(title);
        $('#modalImage').attr('src', imageUrl);
        $('#imageModal').modal('show');
    }

    // Confirm delete image
    function confirmDeleteImage(imageId, imageUrl) {
        $('#deleteImagePreview').attr('src', imageUrl);
        $('#deleteImageForm').attr('action', '{{ route("admin.projects.destroy", $project->id) }}/' + imageId);
        $('#deleteImageModal').modal('show');
    }
</script>
