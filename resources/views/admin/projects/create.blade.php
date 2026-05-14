@extends('layouts.admin')

@section('content')
<div class="container card card-primary p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Create Project</h1>
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

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-8">
                <!-- Project Name -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Project Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Enter project name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Category <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-control @error('project_category_id') is-invalid @enderror" 
                                name="project_category_id">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('project_category_id') == $category->id ? 'selected' : '' }}>
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
                              placeholder="Describe your project in detail...">{{ old('description') }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="text-right mt-1">
                        <small id="charCount" class="text-muted">0 characters</small>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <!-- Project Image -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Project Image</label>
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

                    <!-- Image Preview -->
                    <div id="imagePreviewContainer" class="mt-3 text-center" style="display: none;">
                        <h6 class="font-weight-bold">Preview:</h6>
                        <img id="imagePreview" src="#" alt="Project Image" class="img-fluid rounded border" style="max-height: 150px;">
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="clearImage()">
                            <i class="fas fa-times"></i> Remove
                        </button>
                    </div>
                </div>

                <!-- Gallery Images -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Project Gallery Images</label>
                    <input type="file" 
                           name="images[]" 
                           id="gallery"
                           multiple
                           class="form-control @error('images.*') is-invalid @enderror" 
                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                           onchange="previewMultipleImages(event)">
                    @error('images.*')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-info-circle"></i> Select multiple images
                    </small>

                    <!-- Multiple Image Preview -->
                    <div id="multiImagePreview" class="d-flex flex-wrap mt-2"></div>
                </div>

                <!-- Skills -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Skills / Technologies</label>
                    <input type="text" 
                           name="skills" 
                           value="{{ old('skills') }}" 
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
                            <!-- Skills will appear here -->
                        </div>
                    </div>
                </div>

                <!-- Experience -->
                <div class="mb-4">
                    <label class="form-label font-weight-bold">Experience Required</label>
                    <input type="text" 
                           name="experience" 
                           value="{{ old('experience') }}" 
                           class="form-control @error('experience') is-invalid @enderror" 
                           placeholder="e.g., 2 years, 6 months, Beginner friendly">
                    @error('experience')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
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
                            <img id="previewImageDisplay" src="#" alt="Preview" class="img-fluid" style="max-height: 100px; display: none;">
                            <div id="previewNoImage" class="bg-light p-3">
                                <i class="fas fa-image fa-2x text-muted"></i>
                                <p class="small mb-0">No image</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="border rounded p-3">
                            <h5 class="text-primary" id="previewName">Project Name</h5>
                            <p><strong>Category:</strong> <span id="previewCategory">Not selected</span></p>
                            <p><strong>Description:</strong> <span id="previewDescription">Enter description...</span></p>
                            <p><strong>Skills:</strong> <span id="previewSkills">No skills added</span></p>
                            <p><strong>Experience:</strong> <span id="previewExperience">Not specified</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-4 d-flex justify-content-end">
            <button type="reset" class="btn btn-secondary mr-2">
                <i class="fas fa-undo mr-1"></i> Reset
            </button>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Create Project
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
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
    }
</style>
@endpush

@push('scripts')
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
            skillsArray.forEach(function(skill) {
                $('#skillsPreview').append(
                    '<span class="badge mr-2 mb-2">' + 
                    skill.trim() + 
                    '</span>'
                );
            });
            
            if (skillsArray.length === 0) {
                $('#skillsPreview').html('<span class="text-muted">No skills added</span>');
            }
        });
        
        // Live preview update
        function updatePreview() {
            $('#previewName').text($('#name').val() || 'Project Name');
            
            var categoryName = $('select[name="project_category_id"] option:selected').text() || 'Not selected';
            $('#previewCategory').text(categoryName.replace('📷', '').trim());
            
            var desc = $('#description').val();
            $('#previewDescription').text(desc.substring(0, 150) + (desc.length > 150 ? '...' : '') || 'Enter description...');
            
            var skills = $('#skills').val();
            var skillsArray = skills.split(',').filter(s => s.trim() !== '');
            $('#previewSkills').text(skillsArray.join(', ') || 'No skills added');
            
            $('#previewExperience').text($('#experience').val() || 'Not specified');
        }
        
        $('#name, #description, #experience, select[name="project_category_id"]').on('keyup change', updatePreview);
        $('#skills').on('keyup change', updatePreview);
    });

    // Single image preview
    function previewImage(input) {
        var previewContainer = document.getElementById('imagePreviewContainer');
        var preview = document.getElementById('imagePreview');
        var previewDisplay = document.getElementById('previewImageDisplay');
        var previewNoImage = document.getElementById('previewNoImage');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                // Update main preview
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

    function clearImage() {
        var input = document.querySelector('input[name="image"]');
        var previewContainer = document.getElementById('imagePreviewContainer');
        var previewDisplay = document.getElementById('previewImageDisplay');
        var previewNoImage = document.getElementById('previewNoImage');
        
        // Clear input
        input.value = '';
        
        // Hide previews
        previewContainer.style.display = 'none';
        previewDisplay.style.display = 'none';
        previewNoImage.style.display = 'block';
    }

    // Multiple image preview
    function previewMultipleImages(event) {
        var previewContainer = document.getElementById('multiImagePreview');
        var files = event.target.files;
        
        previewContainer.innerHTML = '';
        
        for (var i = 0; i < files.length; i++) {
            (function(index) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Gallery Image ' + (index + 1);
                    img.title = files[index].name;
                    previewContainer.appendChild(img);
                }
                
                reader.readAsDataURL(files[index]);
            })(i);
        }
    }
</script>
@endpush