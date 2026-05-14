@extends('layouts.admin')

@section('content')

<h3 class="mb-3">Products List</h3>

<a href="{{ route('admin.ourproduct.create') }}" class="btn btn-success mb-3">Add Product</a>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Main Image</th>
<th>Title</th>
<th>Link</th>
<th>Gallery</th>
<th>Action</th>
</tr>

@foreach($products as $row)

<tr>
<td>{{ $row->id }}</td>

<td>
<img src="{{ asset($row->image) }}" width="70">
</td>

<td>{{ $row->title }}</td>
<td><a target="_blank" href="{{ route('dynamic.slug',$row->slug) }}">Link </a></td>
<td>{{ $row->images->count() }} Images</td>

<td>

<a href="{{ route('admin.ourproduct.show',$row->id) }}" class="btn btn-info btn-sm">View</a>

<a href="{{ route('admin.ourproduct.edit',$row->id) }}" class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('admin.ourproduct.destroy',$row->id) }}" method="POST" style="display:inline-block">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">Delete</button>
</form>

</td>
</tr>

@endforeach

</table>

{{ $products->links() }}

@endsection