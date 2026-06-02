@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Contact Enquiries
        </h3>
    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Project Type</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th width="120">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($submissions as $submission)

                    <tr>

                        <td>
                            {{ $submission->id }}
                        </td>

                        <td>
                            {{ $submission->name }}
                        </td>

                        <td>
                            <a href="mailto:{{ $submission->email }}">
                                {{ $submission->email }}
                            </a>
                        </td>

                        <td>
                            {{ $submission->phone ?? '-' }}
                        </td>

                        <td>
                            {{ $submission->project_type ?? '-' }}
                        </td>

                        <td style="max-width:300px; white-space:normal;">
                            {{ $submission->message }}
                        </td>

                        <td>
                            @if($submission->is_read)
                                <span class="badge badge-success">
                                    Read
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Unread
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $submission->created_at->format('d M Y h:i A') }}
                        </td>

                        <td>

                            <form action="{{ route('admin.contacts.destroy', $submission->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this enquiry?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9" class="text-center">
                            No enquiries found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">
        {{ $submissions->links() }}
    </div>

</div>

</div>

@endsection
