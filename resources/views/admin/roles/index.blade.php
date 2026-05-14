@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Roles</h1>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Add Role</a>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Edit </th>
            <th>Assign Routes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td id="role-name-display-{{ $role->id }}" >{{ $role->name }}</td>

            <!-- Inline edit column -->
          
              <td>
                <input type="text" id="role-name-input-{{ $role->id }}" value="{{ $role->name }}" class="form-control form-control-sm d-none">
                <button class="btn btn-sm btn-primary" id="edit-btn-{{ $role->id }}" onclick="enableEdit({{ $role->id }})">Edit</button>
                <button class="btn btn-sm btn-success d-none" id="save-btn-{{ $role->id }}" onclick="saveRoleName({{ $role->id }})">Save</button>
            </td>
            <td>
                <a href="{{ route('admin.roles.edit_routes', $role->id) }}" class="btn btn-sm btn-warning">
                    Edit Routes
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
function enableEdit(roleId) {
    document.getElementById(`role-name-display-${roleId}`).classList.add('d-none');
    document.getElementById(`role-name-input-${roleId}`).classList.remove('d-none');
    document.getElementById(`edit-btn-${roleId}`).classList.add('d-none');
    document.getElementById(`save-btn-${roleId}`).classList.remove('d-none');
}

function saveRoleName(roleId) {
    const name = document.getElementById(`role-name-input-${roleId}`).value;

    fetch(`/admin/roles/${roleId}/update-name`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ name })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`role-name-display-${roleId}`).textContent = name;
            alert(data.message);
        } else {
            alert('Update failed!');
        }
        document.getElementById(`role-name-display-${roleId}`).classList.remove('d-none');
        document.getElementById(`role-name-input-${roleId}`).classList.add('d-none');
        document.getElementById(`edit-btn-${roleId}`).classList.remove('d-none');
        document.getElementById(`save-btn-${roleId}`).classList.add('d-none');
    })
    .catch(error => console.error(error));
}
</script>

</div>
@endsection
