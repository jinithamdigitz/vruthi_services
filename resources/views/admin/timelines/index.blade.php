@extends('layouts.admin')

@section('title', 'Manage Timeline | Admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Manage Timeline</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.timelines.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Timeline Entry
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
                <table class="table table-striped table-hover" id="timelineTable">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Order</th>
                            <th>Year</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th style="width: 12%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($timelines as $timeline)
                            <tr class="timeline-row" data-id="{{ $timeline->id }}">
                                <td>
                                    <i class="fas fa-grip-vertical drag-handle" style="cursor: move;"></i>
                                    {{ $timeline->sort_order }}
                                </td>
                                <td>{{ $timeline->year }}</td>
                                <td>{{ $timeline->title }}</td>
                                <td>{{ $timeline->description }}</td>
                                <td>
                                    <i class="bi {{ $timeline->icon }}"></i> {{ $timeline->icon }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.timelines.edit', $timeline) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.timelines.destroy', $timeline) }}" method="POST" style="display:inline;">
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
                                <td colspan="6" class="text-center">No timeline entries found</td>
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
    const rows = tableBody.querySelectorAll('.timeline-row');

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
        const rows = tableBody.querySelectorAll('.timeline-row');
        const order = Array.from(rows).map(row => row.dataset.id);

        fetch('{{ route("admin.timelines.update-order") }}', {
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
