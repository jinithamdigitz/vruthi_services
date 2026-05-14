 @extends('layouts.main')


@section('content')

<div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
            <div class="container-fluid page-header-inner py-8">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Warranty Registration</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Warranty Registration</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
<section id="contact" class="contact section">
<div class="container">
    <h2>Warranty Registration</h2><br/>

  

   <form action="#" class="php-email-form" method="POST">
    @csrf
    <div class="col-md-12 mb-3">
        <label for="product_val" class="form-label">Select Product</label>
        <select name="product_val" class="form-control" id="product_val">
            <option value="">-- Select Product --</option>
            @foreach ($products as $value)
                <option value="{{ $value->id }}">{{ $value->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <label for="product_id" class="form-label">Product ID</label>
        <input type="text" name="product_id" id="product_id" class="form-control" placeholder="Product Id" required readonly>
    </div>

    <div class="col-md-12 mb-3">
        <label for="serial_number" class="form-label">Serial Number</label>
        <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Serial Number" required>
    </div>

    <div class="col-md-12 mb-3">
        <label for="vehicle_number" class="form-label">Vehicle Number</label>
        <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" placeholder="Vehicle Number" required>
    </div>

    <div class="col-md-12 mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" required>
    </div>

    <div class="col-md-12 mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea name="address" id="address" class="form-control" placeholder="Address" required></textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label for="expiry_date" class="form-label">Purchase Date / To Date</label>
        <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
    </div>

    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>



</div>
</section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // When product changes, set product id
        $('#product_val').on('change', function () {
            $('#product_id').val($(this).val());
        });

        // On page load, if a product is already selected, fill product id
        if ($('#product_val').val()) {
            $('#product_id').val($('#product_val').val());
        }
    });
</script>