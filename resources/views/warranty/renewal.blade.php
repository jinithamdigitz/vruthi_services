@extends('layouts.main')
 

@section('content')
<div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
            <div class="container-fluid page-header-inner py-8">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Warranty Renewal</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Warranty Renewal</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>



<div class="container">
    <h2>Warranty Renewal</h2><br/>
   <form action="{{ route('warranty.renewal') }}" method="GET">
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





 @if($searched)
    @if($results->isNotEmpty())
    <div class="row">
        @foreach($results as $warranty)
            <div class="col-md-6">
                <div class="card mb-3 shadow">
                    <div class="card-body">
                        <h5>{{ $warranty->product_name ?? 'Product' }}</h5>
                        <p><b>Serial:</b> {{ $warranty->serial_number }}</p>
                        <p><b>Barcode:</b> {{ $warranty->barcode }}</p>
                        <p><b>Phone:</b> {{ $warranty->phone_number }}</p>
                        <p><b>Vehicle:</b> {{ $warranty->vehicle_number }}</p>
                        <p><b>Warranty Upto:</b> {{ $warranty->warranty_reg_upto ?? 'Not Set' }}</p>

                        {{-- Extend Warranty button --}}
                        <button type="button" class="btn btn-success extend-btn" data-id="{{ $warranty->id }}">
                            Extend Warranty
                        </button>

                        {{-- Extend form (hidden by default) --}}
                        <form method="POST" 
                              action="{{ route('warranty.extend.submit', $warranty->id) }}" 
                              class="mt-3 extend-form" 
                              id="extend-form-{{ $warranty->id }}" 
                              style="display: none;">
                            @csrf
                            <label>Warranty Upto</label>
                            <input type="date" 
                                   name="warranty_reg_upto" 
                                   class="form-control mb-2" 
                                   value="{{ old('warranty_reg_upto', $warranty->warranty_reg_upto) }}">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
@endif
</div>
@endsection	
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $(".extend-btn").on("click", function () {
        let id = $(this).data("id");
        $("#extend-form-" + id).slideToggle(); // toggle show/hide with animation
    });
});
</script>
