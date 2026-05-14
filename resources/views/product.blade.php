{{-- resources/views/home.blade.php --}}
@extends('layouts.main')

@section('hero_title')
Solar Products
@endsection

@section('hero_text')
Explore our high-quality solar panels and solutions
@endsection

@section('content')
<div class="page">



    <!-- PRODUCTS GRID VIEW -->
    <section class="products-grid-section">
        <h2 class="section-title">Our Products</h2>
        
        @if (isset($ourproducts) && $ourproducts->count() > 0)
            <div class="products-grid">
                @foreach ($ourproducts as $product)
                    <div class="product-card">
                        <a href="{{ route('dynamic.slug', $product->slug) }}" class="product-link">
                            
                            <div class="product-image">
                                <img src="{{ !empty($product->image) ? url($product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                                     alt="{{ $product->title }}">
                            </div>

                            <div class="product-info">
                                <h3 class="product-title">{{ $product->title }}</h3>

                                <span class="view-details">View Details →</span>
                            </div>

                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <p>No products found.</p>
            </div>
        @endif
    </section>

</div>
@endsection