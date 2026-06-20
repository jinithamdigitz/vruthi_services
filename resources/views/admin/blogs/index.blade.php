@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blogs</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Blogs</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Success!</strong> {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Blog Management</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Blog
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="blogsTable">
                    <thead>
                        <tr>
                            <th width="5%">Order</th>
                            <th width="30%">Title</th>
                            <th width="30%">Image</th>
                            <th width="25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-blogs">
                        @forelse ($blogs as $index => $blog)
                            <tr class="sortable-row" data-id="{{ $blog->id }}">
                                <td>
                                    <span class="order-number">{{ $index + 1 }}</span>
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>
                                    @if ($blog->image)
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                            style="height: 50px; width: auto;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No blogs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        $("#sortable-blogs").sortable({
            update: function() {
                let order = [];
                $("#sortable-blogs tr").each(function(index) {
                    order.push($(this).data('id'));
                    $(this).find('.order-number').text(index + 1);
                });

                $.ajax({
                    url: "{{ route('admin.blogs.update-order') }}",
                    type: 'POST',
                    data: {
                        order: order,
                        _token: "{{ csrf_token() }}"
                    }
                });
            }
        });
    });
</script>

@endsection
