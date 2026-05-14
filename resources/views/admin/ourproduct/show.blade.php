@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">
    <h3>{{ $product->title }}</h3>

    <a href="{{ route('admin.ourproduct.index') }}" class="btn btn-secondary">
        Back
    </a>
</div>



<!-- Description -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        Product Description
    </div>

    <div class="card-body">
        {!! $product->description !!}
    </div>
</div>



<!-- Main Image -->
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        Main Image
    </div>

    <div class="card-body">
        <img src="{{ asset($product->image) }}" width="220" class="img-thumbnail">
    </div>
</div>



<!-- Gallery Images -->
<div class="card mb-4">
    <div class="card-header bg-info text-white">
        Gallery Images
    </div>

    <div class="card-body">

        @if($product->images->count())

        @foreach($product->images as $img)

        <img src="{{ asset($img->image) }}"
            width="130"
            class="img-thumbnail m-1">

        @endforeach

        @else

        <p class="mb-0">No gallery images found.</p>

        @endif

    </div>
</div>

<div class="card mt-4 mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Brand Slider</h5>
    </div>

    <div class="card-body">

        @if($product->brands->count())

            <div class="row">

                @foreach($product->brands as $brand)

                <div class="col-md-3 mb-4">

                    <div class="border rounded p-3 text-center h-100">

                        <img src="{{ asset($brand->image) }}"
                            class="img-fluid mb-3"
                            style="height:80px; object-fit:contain;">

                        <h6 class="mb-1">
                            {{ $brand->brand_name }}
                        </h6>

                        @if($brand->title)
                        <small class="text-muted d-block mb-2">
                            {{ $brand->title }}
                        </small>
                        @endif

                        <span class="badge bg-{{ $brand->status ? 'success':'danger' }}">
                            {{ $brand->status ? 'Active':'Inactive' }}
                        </span>

                    </div>

                </div>

                @endforeach

            </div>

        @else

            <p class="mb-0">No Brand Slider Added.</p>

        @endif

    </div>
</div>

<!-- Product Sections -->
<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Product Sections
    </div>

    <div class="card-body">

        @if($product->sections->count())

        @foreach($product->sections as $section)

        <div class="border rounded p-3 mb-3">

            <h5 class="mb-2">
                {{ $section->title }}
            </h5>

            <div>
                {!! $section->description !!}
            </div>

        </div>

        @endforeach

        @else

        <p class="mb-0">No sections added.</p>

        @endif

    </div>
</div>

<!-- Product FAQs -->
<div class="card mb-4">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Product FAQs</h5>
    </div>

    <div class="card-body">

        @if($product->faqs->count())

        @foreach($product->faqs as $faq)

        <div class="border rounded p-3 mb-3 bg-light">

            <h5 class="text-primary mb-2">
                Q: {{ $faq->question }}
            </h5>

            <p class="mb-0">
                {{ $faq->answer }}
            </p>

        </div>

        @endforeach

        @else

        <p class="mb-0">No FAQs Added.</p>

        @endif

    </div>
</div>

@endsection