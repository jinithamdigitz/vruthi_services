@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>Scrap Requests</h1>


        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif



        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Full Name</th>

                    <th>Phone</th>

                    <th>Email</th>

                    <th>Location</th>

                    <th>Scrap Type</th>

                    <th>Details</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>


                @forelse($requests as $request)
                    <tr>

                        <td>

                            {{ $request->id }}

                        </td>


                        <td>

                            {{ $request->full_name }}

                        </td>


                        <td>

                            {{ $request->phone }}

                        </td>


                        <td>

                            {{ $request->email ?? 'N/A' }}

                        </td>


                        <td>

                            {{ $request->location }}

                        </td>


                        <td>

                            {{ implode(', ', json_decode($request->scrap_type)) }}

                        </td>


                        <td>

                            {{ $request->details ?? 'No Details' }}

                        </td>



                        <td>

                            <form action="{{ route('admin.scrap_requests.destroy', $request->id) }}" method="POST"
                                style="display:inline">

                                @csrf

                                @method('DELETE')

                                <a href="{{ route('admin.scrap_requests.show', $request->id) }}" class="btn btn-info btn-sm">

                                    View

                                </a>

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure to delete this request?')">

                                    Delete

                                </button>

                            </form>

                        </td>


                    </tr>


                @empty

                    <tr>

                        <td colspan="8">

                            No Scrap Requests Found

                        </td>

                    </tr>
                @endforelse


            </tbody>

        </table>


    </div>
@endsection
