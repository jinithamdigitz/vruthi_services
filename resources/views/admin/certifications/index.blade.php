@extends('layouts.admin')

@section('title', 'Manage Certifications | Admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Manage Certifications</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.certifications.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Certification
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="certificationTable">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Order</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Icon</th>
                            <th style="width: 12%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($certifications as $certification)
                            <tr class="certification-row" data-id="{{ $certification->id }}">
                                <td>
                                    <i class="fas fa-grip-vertical drag-handle" style="cursor: move;"></i>
                                    {{ $certification->sort_order }}
                                </td>
                                <td>{{ $certification->title }}</td>
                                <td>{{ $certification->subtitle }}</td>
                                <td>
                                    <i class="bi {{ $certification->icon }}"></i> {{ $certification->icon }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.certifications.edit', $certification) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.certifications.destroy', $certification) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No certifications found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple drag and drop reordering
    let draggedRow = null;

    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('.certification-row');

    rows.forEach(row => {
        row.draggable = true;
        row.addEventListener('dragstart', handleDragStart);
        row.addEventListener('dragover', handleDragOver);
        row.addEventListener('drop', handleDrop);
        row.addEventListener('dragend', handleDragEnd);
    });

    function handleDragStart(e) {
        draggedRow = this;
        this.style.opacity = '0.5';
    }

    function handleDragOver(e) {
        e.preventDefault();
    }

    function handleDrop(e) {
        e.preventDefault();
        if (draggedRow !== this) {
            tableBody.insertBefore(draggedRow, this);
            updateOrder();
        }
    }

    function handleDragEnd(e) {
        this.style.opacity = '1';
    }

    function updateOrder() {
        const rows = tableBody.querySelectorAll('.certification-row');
        const order = Array.from(rows).map(row => row.dataset.id);

        fetch('{{ route("admin.certifications.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ order: order })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Order updated:', data);
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection
