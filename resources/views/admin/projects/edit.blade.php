@extends('layouts.admin')

@section('content')
<div class="container card card-primary p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Project</h1>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back to Projects
        </a>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
    <div class="alert alert-danger">
        <h5 class="alert-heading"><i class="fas fa-exclamation-circle mr-2"></i>Please fix the following errors:</h5>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-8">
                <!-- Project Name -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Project Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $project->name) }}" 
                           class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Enter project name"
                           id="name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Category <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-control @error('project_category_id') is-invalid @enderror" 
                                name="project_category_id"
                                id="project_category_id">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('project_category_id', $project->project_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <a href="{{ route('admin.project-categories.create') }}" class="btn btn-outline-primary" target="_blank">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @error('project_category_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-info-circle"></i> Can't find a category? Click the + button to add one.
                    </small>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Description <span class="text-danger">*</span></label>
                    <textarea name="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="8" 
                              placeholder="Describe your project in detail..."
                              id="description">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="text-right mt-1">
                        <small id="charCount" class="text-muted">{{ strlen($project->description ?? '') }} characters</small>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <!-- Project Image -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Project Image</label>
                    
                    <!-- Current Image -->
                    @if($project->image)
                    <div class="mb-3">
                        <div class="border rounded p-2 text-center bg-light">
                            <img src="{{ asset($project->image) }}" 
                                 alt="Current Image" 
                                 class="img-fluid rounded" 
                                 style="max-height: 150px;">
                            <p class="small text-muted mt-2 mb-0">Current Image</p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Upload New Image -->
                    <input type="file" 
                           name="image" 
                           class="form-control @error('image') is-invalid @enderror" 
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                           onchange="previewImage(this)">
                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-info-circle"></i> Accepted formats: JPEG, PNG, JPG, GIF, WEBP. Max size: 2MB
                    </small>

                    <!-- New Image Preview -->
                    <div id="imagePreviewContainer" class="mt-3 text-center" style="display: none;">
                        <h6 class="font-weight-bold">New Image Preview:</h6>
                        <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded border" style="max-height: 150px;">
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="clearNewImage()">
                            <i class="fas fa-times"></i> Remove New Image
                        </button>
                    </div>
                </div>

               <!-- Gallery Images -->
<div class="mb-4">
    <label class="form-label font-weight-bold">Project Gallery Images</label>
    
    <!-- Existing Gallery Images -->
    @if($project->images && $project->images->count() > 0)
    <div class="mb-3">
        <div class="border rounded p-2 bg-light">
            <h6 class="mb-2">Existing Gallery Images:</h6>
            <div class="row">
                @foreach($project->images as $index => $img)
                <div class="col-6 mb-2">
                    <div class="position-relative">
                        <img src="{{ asset($img->image) }}" 
                             class="img-fluid rounded border" 
                             style="height: 80px; width: 100%; object-fit: cover;">
                        <div class="mt-1 text-center">
                            <!-- Use regular checkbox instead of custom checkbox for better compatibility -->
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="remove_gallery[]" 
                                       value="{{ $img->id }}"
                                       id="remove_gallery_{{ $img->id }}">
                                <label class="form-check-label text-danger small" for="remove_gallery_{{ $img->id }}">
                                    <i class="fas fa-trash"></i> Remove
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <small class="text-muted">
                <i class="fas fa-info-circle"></i> Check the box to remove images when updating
            </small>
        </div>
    </div>
    @else
    <div class="alert alert-info py-2">
        <i class="fas fa-info-circle mr-1"></i> No gallery images yet.
    </div>
    @endif
    
    <!-- Add New Gallery Images -->
    <div class="mt-3">
        <label class="form-label font-weight-bold">Add New Gallery Images</label>
        <input type="file" 
               name="images[]" 
               id="gallery"
               multiple
               class="form-control @error('images.*') is-invalid @enderror" 
               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
               onchange="previewMultipleImages(this)">
        @error('images.*')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <small class="text-muted d-block mt-1">
            <i class="fas fa-info-circle"></i> Select multiple images to add to gallery. Max size per image: 2MB
        </small>
    </div>

    <!-- New Gallery Images Preview -->
    <div id="multiImagePreview" class="d-flex flex-wrap mt-2"></div>
</div>

                <!-- Skills -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Skills / Technologies</label>
                    <input type="text" 
                           name="skills" 
                           value="{{ old('skills', $project->skills) }}" 
                           class="form-control @error('skills') is-invalid @enderror" 
                           placeholder="e.g., PHP, Laravel, MySQL, JavaScript, React"
                           id="skills">
                    @error('skills')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-lightbulb"></i> Tip: Separate skills with commas
                    </small>

                    <!-- Skills Preview -->
                    <div class="mt-2">
                        <div id="skillsPreview" class="d-flex flex-wrap">
                            @if($project->skills)
                                @php
                                    $skills = explode(',', $project->skills);
                                @endphp
                                @foreach($skills as $skill)
                                    @if(trim($skill))
                                        <span class="badge mr-2 mb-2">{{ trim($skill) }}</span>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Experience -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Experience Required</label>
                    <input type="text" 
                           name="experience" 
                           value="{{ old('experience', $project->experience) }}" 
                           class="form-control @error('experience') is-invalid @enderror" 
                           placeholder="e.g., 2 years, 6 months, Beginner friendly"
                           id="experience">
                    @error('experience')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Meta Information -->
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold">
                            <i class="fas fa-info-circle mr-2"></i>Meta Information
                        </h6>
                        <p class="mb-2 small">
                            <strong>Created:</strong> {{ $project->created_at->format('d M Y, h:i A') }}
                        </p>
                        <p class="mb-2 small">
                            <strong>Last Updated:</strong> {{ $project->updated_at->diffForHumans() }}
                        </p>
                        <p class="mb-0 small">
                            <strong>Project ID:</strong> #{{ $project->id }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Preview -->
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <i class="fas fa-eye mr-2"></i> Live Preview
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="border rounded p-2">
                            <img id="previewImageDisplay" 
                                 src="{{ $project->image ? asset($project->image) : '#' }}" 
                                 alt="Preview" 
                                 class="img-fluid" 
                                 style="max-height: 100px; {{ $project->image ? '' : 'display: none;' }}">
                            <div id="previewNoImage" class="bg-light p-3" style="{{ $project->image ? 'display: none;' : '' }}">
                                <i class="fas fa-image fa-2x text-muted"></i>
                                <p class="small mb-0">No image</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="border rounded p-3">
                            <h5 class="text-primary" id="previewName">{{ $project->name }}</h5>
                            <p><strong>Category:</strong> <span id="previewCategory">{{ $project->category->name ?? 'Not selected' }}</span></p>
                            <p><strong>Description:</strong> <span id="previewDescription">{{ Str::limit($project->description, 150) }}</span></p>
                            <p><strong>Skills:</strong> <span id="previewSkills">{{ $project->skills ?? 'No skills added' }}</span></p>
                            <p><strong>Experience:</strong> <span id="previewExperience">{{ $project->experience ?? 'Not specified' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-4 d-flex justify-content-between">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                <i class="fas fa-trash mr-1"></i> Delete Project
            </button>
            <div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mr-2">
                    <i class="fas fa-times mr-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Update Project
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Delete Confirmation Modal -->
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
                    @if($project->images && $project->images->count() > 0)
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
                        <i class="fas fa-trash"></i> Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<style>
    .card-primary {
        border-top: 3px solid #007bff;
    }
    .form-label {
        margin-bottom: 0.5rem;
        display: block;
    }
    .input-group-text {
        background-color: #e9ecef;
    }
    #skillsPreview .badge {
        background-color: #007bff;
        color: white;
        padding: 0.5rem 1rem;
        margin: 0.25rem;
        border-radius: 0.25rem;
        display: inline-block;
    }
    #multiImagePreview img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin: 0.25rem;
        border-radius: 0.25rem;
        border: 1px solid #dee2e6;
        transition: transform 0.2s;
    }
    #multiImagePreview img:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    .custom-checkbox .custom-control-label::before {
        border-radius: 0.25rem;
    }
    .custom-checkbox .custom-control-label {
        cursor: pointer;
    }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

<script>
    $(document).ready(function() {
        // Character counter for description
        $('#description').on('keyup', function() {
            var len = $(this).val().length;
            $('#charCount').text(len + ' characters');
        });
        
        // Skills preview
        $('#skills').on('keyup change', function() {
            var skills = $(this).val();
            var skillsArray = skills.split(',').filter(s => s.trim() !== '');
            
            $('#skillsPreview').empty();
            if (skillsArray.length === 0) {
                $('#skillsPreview').html('<span class="text-muted">No skills added</span>');
            } else {
                skillsArray.forEach(function(skill) {
                    $('#skillsPreview').append(
                        '<span class="badge mr-2 mb-2">' + 
                        skill.trim() + 
                        '</span>'
                    );
                });
            }
            
            // Update live preview
            updatePreview();
        });
        
        // Live preview update function
        function updatePreview() {
            $('#previewName').text($('#name').val() || '{{ $project->name }}');
            
            var categoryName = $('select[name="project_category_id"] option:selected').text() || 'Not selected';
            $('#previewCategory').text(categoryName.replace('📷', '').trim());
            
            var desc = $('#description').val();
            $('#previewDescription').text(desc.substring(0, 150) + (desc.length > 150 ? '...' : '') || 'Enter description...');
            
            var skills = $('#skills').val();
            var skillsArray = skills.split(',').filter(s => s.trim() !== '');
            $('#previewSkills').text(skillsArray.join(', ') || 'No skills added');
            
            $('#previewExperience').text($('#experience').val() || 'Not specified');
        }
        
        // Trigger preview on input changes
        $('#name, #description, #experience, select[name="project_category_id"]').on('keyup change', updatePreview);
        $('#skills').on('keyup change', updatePreview);
        
        // Initial preview update
        updatePreview();
    });

    // Single image preview for new image
    function previewImage(input) {
        var previewContainer = document.getElementById('imagePreviewContainer');
        var preview = document.getElementById('imagePreview');
        var previewDisplay = document.getElementById('previewImageDisplay');
        var previewNoImage = document.getElementById('previewNoImage');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                // Update new image preview
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
                
                // Update live preview
                previewDisplay.src = e.target.result;
                previewDisplay.style.display = 'inline-block';
                previewNoImage.style.display = 'none';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearNewImage() {
        var input = document.querySelector('input[name="image"]');
        var previewContainer = document.getElementById('imagePreviewContainer');
        var previewDisplay = document.getElementById('previewImageDisplay');
        var previewNoImage = document.getElementById('previewNoImage');
        
        // Clear input
        input.value = '';
        
        // Hide new image preview
        previewContainer.style.display = 'none';
        
        // Restore original image if exists
        var originalImage = "{{ $project->image ? asset($project->image) : '' }}";
        if (originalImage) {
            previewDisplay.src = originalImage;
            previewDisplay.style.display = 'inline-block';
            previewNoImage.style.display = 'none';
        } else {
            previewDisplay.style.display = 'none';
            previewNoImage.style.display = 'block';
        }
    }

    // Multiple image preview for new gallery images
    function previewMultipleImages(event) {
        var previewContainer = document.getElementById('multiImagePreview');
        var files = event.target.files;
        
        previewContainer.innerHTML = '';
        
        if (files.length > 0) {
            var title = document.createElement('div');
            title.className = 'w-100 mb-2';
            title.innerHTML = '<strong>New Images Preview:</strong>';
            previewContainer.appendChild(title);
            
            for (var i = 0; i < files.length; i++) {
                (function(index) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'New Gallery Image ' + (index + 1);
                        img.title = files[index].name;
                        img.style.cursor = 'pointer';
                        img.onclick = function() {
                            window.open(e.target.result, '_blank');
                        };
                        previewContainer.appendChild(img);
                    }
                    
                    reader.readAsDataURL(files[index]);
                })(i);
            }
        }
    }
</script>
