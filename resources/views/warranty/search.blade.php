 @extends('layouts.main')


@section('content')
<div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
            <div class="container-fluid page-header-inner py-8">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Search Warranty</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Search Warranty</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


<div class="container">
    <h2>Search Warranty</h2><br/>
   <form action="{{ route('warranty.search.form') }}" method="GET">
    <div class="mb-3">
        <label for="serial_number" class="form-label">Serial Number</label>
        <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Enter Serial Number">
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number">
    </div>

    <div class="mb-3">
        <label for="vehicle_number" class="form-label">Vehicle Number</label>
        <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" placeholder="Enter Vehicle Number">
    </div>

    <div class="mb-3">
        <label for="barcode" class="form-label">Barcode</label>
        <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Enter Barcode">
    </div>

    <button type="submit" class="btn btn-success">Search</button>
</form>

	<br/><br/><br/>

   @if($searched)
    @if($results->isNotEmpty())
        <h4>Search Results</h4>
        <table class="table table-bordered">
            <tr>
                <th>Serial</th>
                <th>Phone</th>
                <th>Vehicle</th>
                <th>Address</th>
                <th>Expiry Date</th>
            </tr>
            @foreach($results as $warranty)
            <tr>
                <td>{{ $warranty->serial_number }}</td>
                <td>{{ $warranty->phone_number }}</td>
                <td>{{ $warranty->vehicle_number }}</td>
                <td>{{ $warranty->address }}</td>
                <td>{{ $warranty->expiry_date }}</td>
            </tr>
            @endforeach
        </table>
    @else
        <p class="text-danger">No results found.</p>
    @endif
@endif

</div>
@endsection	
	
	