@extends('layouts.admin')

@section('title', 'Edit Member')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Member: {{ $member->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.members.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        id="name" name="name" value="{{ old('name', $member->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" 
                                        id="designation" name="designation" value="{{ old('designation', $member->designation) }}">
                                    @error('designation')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug (Leave empty for auto-generate)</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                        id="slug" name="slug" value="{{ old('slug', $member->slug) }}" placeholder="custom-slug">
                                    <small class="text-muted">If left empty, slug will be automatically generated from the name</small>
                                    @error('slug')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    @if($member->image && file_exists(public_path($member->image)))
                                        <div class="mb-2">
                                            <img src="{{ asset($member->image) }}" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                                        id="image" name="image" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                    @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

    <div class="d-flex justify-content-between align-items-center mb-2">

        <label for="description" class="mb-0">
            Description
        </label>

        <div class="form-check">

            <input type="checkbox"
                   name="show_html"
                   value="1"
                   class="form-check-input"
                   id="show_html"
                   {{ old('show_html', $member->show_html ?? 0) ? 'checked' : '' }}>

            <label class="form-check-label" for="show_html">
                Enable CKEditor
            </label>

        </div>

    </div>

    <textarea class="form-control @error('description') is-invalid @enderror"
              id="description"
              name="description"
              rows="8">{{ old('description', $member->description) }}</textarea>

    @error('description')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror

</div>

                        <div class="form-group">
                            <label for="keyword">Keywords (SEO)</label>
                            <textarea class="form-control @error('keyword') is-invalid @enderror" 
                                id="keyword" name="keyword" rows="3" placeholder="Enter keywords separated by commas">{{ old('keyword', $member->keyword) }}</textarea>
                            @error('keyword')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Member</button>
                        <a href="{{ route('admin.members.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const checkbox = document.getElementById('show_html');
    const textarea = document.getElementById('description');

    let editorInstance = null;

    function enableEditor() {

        if (!editorInstance) {

            ClassicEditor
                .create(textarea)
                .then(editor => {

                    editorInstance = editor;

                })
                .catch(error => {

                    console.error(error);

                });
        }
    }

    function disableEditor() {

        if (editorInstance) {

            let content = editorInstance.getData();

            let plainText = content
                .replace(/<[^>]*>/g, '')
                .replace(/&nbsp;/g, ' ')
                .replace(/<\/p>/gi, '\n')
                .replace(/<br\s*\/?>/gi, '\n')
                .trim();

            editorInstance.destroy()

                .then(() => {

                    editorInstance = null;

                    textarea.value = plainText;

                });
        }
    }

    // AUTO LOAD FROM DATABASE VALUE
    if (checkbox.checked) {

        enableEditor();

    }

    checkbox.addEventListener('change', function () {

        if (this.checked) {

            enableEditor();

        } else {

            disableEditor();

        }

    });

});

</script>