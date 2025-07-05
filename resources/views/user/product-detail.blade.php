@extends('layouts.user')
@section('content')

<style>
/* Chỉ sửa layout phần ảnh */
.product-image-section {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.main-image-wrapper {
    position: relative;
    width: 100%;
    height: 400px;
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 15px;
}

.main-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.main-image-wrapper:hover img {
    transform: scale(1.05);
}

.thumbnail-wrapper {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
}

.thumbnail-item {
    width: 70px;
    height: 70px;
    border: 2px solid transparent;
    border-radius: 6px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.thumbnail-item.active {
    border-color: #007bff;
    box-shadow: 0 2px 8px rgba(0,123,255,0.3);
}

.thumbnail-item:hover {
    border-color: #007bff;
    transform: translateY(-2px);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@media (max-width: 768px) {
    .main-image-wrapper {
        height: 300px;
    }
    
    .thumbnail-item {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 576px) {
    .main-image-wrapper {
        height: 250px;
    }
    
    .thumbnail-item {
        width: 50px;
        height: 50px;
    }
}
</style>

<section id="selling-product" class="single-product mt-0 mt-md-5">
    <div class="container-fluid">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="product-image-section">
                    <!-- Main Image -->
                    <div class="main-image-wrapper" id="mainImageWrapper">
                        @if($product->img_thumb)
                            <img src="{{ asset('storage/' . $product->img_thumb) }}" 
                                 alt="{{ $product->name }}" 
                                 id="mainImage">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" 
                                 alt="No image available" 
                                 id="mainImage">
                        @endif
                    </div>
                    
                    <!-- Thumbnail Images -->
                    <div class="thumbnail-wrapper" id="thumbnailWrapper">
                        @if($product->img_thumb)
                            <div class="thumbnail-item active" onclick="changeMainImage('{{ asset('storage/' . $product->img_thumb) }}', this)">
                                <img src="{{ asset('storage/' . $product->img_thumb) }}" 
                                     alt="{{ $product->name }}">
                            </div>
                        @endif
                        
                        @if($product->galleries && $product->galleries->count() > 0)
                            @foreach($product->galleries as $gallery)
                                <div class="thumbnail-item" onclick="changeMainImage('{{ asset('storage/' . $gallery->image) }}', this)">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                                         alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="product-info">
                    <div class="element-header">
                        <h2 itemprop="name" class="display-6">{{ $product->name }}</h2>
                        <div class="rating-container d-flex gap-0 align-items-center">
                            <div class="rating" data-rating="1">
                                <svg width="32" height="32" class="text-warning">
                                    <use xlink:href="#star-solid"></use>
                                </svg>
                            </div>
                            <div class="rating" data-rating="2">
                                <svg width="32" height="32" class="text-warning">
                                    <use xlink:href="#star-solid"></use>
                                </svg>
                            </div>
                            <div class="rating" data-rating="3">
                                <svg width="32" height="32" class="text-warning">
                                    <use xlink:href="#star-solid"></use>
                                </svg>
                            </div>
                            <div class="rating" data-rating="4">
                                <svg width="32" height="32" class="text-warning">
                                    <use xlink:href="#star-outline"></use>
                                </svg>
                            </div>
                            <div class="rating" data-rating="5">
                                <svg width="32" height="32" class="text-warning">
                                    <use xlink:href="#star-outline"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="product-price pt-3 pb-3">
                        <strong class="text-primary display-6 fw-bold">{{ number_format($product->price, 0, '', '.') }}
                            VNĐ</strong><del class="ms-2">{{ number_format($product->price_sale, 0, '', '.') }}
                            VNĐ</del>
                    </div>
                    <p>{{ $product->description }}</p>
                    <div class="cart-wrap py-5">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Color --}}
                            <div class="color-options pb-3">
                                <h6 class="item-title text-uppercase text-dark">Color:</h6>
                                @php
                                $colors = $productVariants->pluck('color_name')->unique();
                                @endphp
                                @foreach ($colors as $index => $color)
                                <input type="radio" class="btn-check" name="color_name" id="color-{{ $index }}"
                                    value="{{ $color }}" {{ $loop->first ? 'checked' : '' }}>
                                <label class="btn" for="color-{{ $index }}">
                                    <span class="rounded-circle d-inline-block" style="width: 16px; height: 16px; background-color:
                        {{ optional($productVariants->firstWhere('color_name', $color))->hex_code ?? '#ccc' }};
                        border: 1px solid #ccc;"></span>
                                    {{ $color }}
                                </label>
                                @endforeach
                            </div>

                            {{-- Size --}}
                            <div class="swatch">
                                <h6 class="item-title text-uppercase text-dark">Size:</h6>
                                @php
                                $sizes = $productVariants->pluck('size')->unique();
                                @endphp
                                @foreach ($sizes as $index => $size)
                                <input type="radio" class="btn-check" name="size" id="size-{{ $index }}"
                                    value="{{ $size }}" {{ $loop->first ? 'checked' : '' }}>
                                <label class="btn" for="size-{{ $index }}">{{ $size }}</label>
                                @endforeach
                            </div>

                            {{-- Quantity --}}
                            <div class="product-quantity pt-3">
                                <input type="number" name="quantity" value="1" min="1" max="100"
                                    class="form-control input-number text-center" style="max-width: 150px;">
                            </div>

                            {{-- Action Buttons --}}
                            <div class="qty-button d-flex flex-wrap pt-3">
                                <button type="submit" name="action" value="buy_now"
                                    class="btn btn-primary py-3 px-4 text-uppercase me-3 mt-3">Buy now</button>

                                <button type="submit" name="action" value="add_to_cart"
                                    class="btn btn-dark py-3 px-4 text-uppercase mt-3">Add to cart</button>
                            </div>
                        </form>

                    </div>
                    <div class="meta-product py-2">
                        <div class="meta-item d-flex align-items-baseline">
                            <h6 class="item-title no-margin pe-2">SKU:</h6>
                            <ul class="select-list list-unstyled d-flex">
                                <li data-value="S" class="select-item">{{ $product->slug }}</li>
                            </ul>
                        </div>
                        <div class="meta-item d-flex align-items-baseline">
                            <h6 class="item-title no-margin pe-2">Category:</h6>
                            <ul class="select-list list-unstyled d-flex">
                                <li data-value="S" class="select-item">
                                    <a href="#">{{ $product->category_name }}</a>,
                                </li>
                                <li data-value="S" class="select-item">
                                    <a href="#"> Screen touch</a>,
                                </li>
                            </ul>
                        </div>
                        <div class="meta-item d-flex align-items-baseline">
                            <h6 class="item-title no-margin pe-2">Tags:</h6>
                            <ul class="select-list list-unstyled d-flex">
                                <li data-value="S" class="select-item">
                                    <a href="#">Classic</a>,
                                </li>
                                <li data-value="S" class="select-item">
                                    <a href="#"> Modern</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-info-tabs py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-column flex-md-row align-items-start gap-5">
                <div class="nav flex-row flex-wrap flex-md-column nav-pills me-3 col-lg-3" id="v-pills-tab"
                    role="tablist" aria-orientation="vertical">
                    <button class="nav-link text-start active" id="v-pills-description-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-description" type="button" role="tab"
                        aria-controls="v-pills-description" aria-selected="true">Description</button>
                    <button class="nav-link text-start" id="v-pills-additional-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-additional" type="button" role="tab" aria-controls="v-pills-additional"
                        aria-selected="false">Additional Information</button>
                    <button class="nav-link text-start" id="v-pills-reviews-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-reviews" type="button" role="tab" aria-controls="v-pills-reviews"
                        aria-selected="false">Reviews</button>
                </div>
                <div class="tab-content col-lg-9" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-description" role="tabpanel"
                        aria-labelledby="v-pills-description-tab">
                        <div class="product-description">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-additional" role="tabpanel"
                        aria-labelledby="v-pills-additional-tab">
                        <div class="additional-info">
                            <h4>Additional Information</h4>
                            <p>Additional information about the product will be displayed here.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-reviews" role="tabpanel"
                        aria-labelledby="v-pills-reviews-tab">
                        <div class="reviews">
                            <h4>Customer Reviews</h4>
                            <p>Customer reviews will be displayed here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="related-products" class="product-store position-relative py-5">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex justify-content-between my-5">

                    <h2 class="section-title">Related Products</h2>

                    <div class="d-flex align-items-center">
                        <div class="swiper-buttons">
                            <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                            <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row flex">
            {{-- <div class="col-md-12 flex"> --}}

            <div class="products-carousel swiper ">
                <div class="swiper-wrapper d-flex">
                    @foreach ($products as $product)
                    <div style="width: 25%; margin-right: 30px;">
                        <div class="product-item">
                            {{-- @if ($product->discount > 0) --}}
                            <span class="badge bg-success position-absolute m-3">-30%</span>
                            {{-- @endif --}}
                            <figure>
                                <a href="{{ route('home.show', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="Product Thumbnail"
                                        height="100px">
                                </a>
                            </figure>
                            <p>{{ $product->name }}</p>
                            <div class="d-block justify-content-between">
                                <p><span class=" d-block"
                                        style=" font-weight:800; font-size: large; color: red;">{{ number_format($product->price, 0, '', '.') }}
                                        VNĐ</span>
                                    {{-- @if ($product->discount > 0) --}}
                                    <del>{{ number_format($product->price_sale, 0, '', '.') }} VNĐ</del>
                                    <span class="text-success">-30%</span>
                                    {{-- @endif --}}
                                </p>
                                <span class="d-flex">
                                    {{-- @for ($i = 1; $i <= 5; $i++)
                                                <svg width="18" height="18" class="{{ $i <= $product->rating ? 'text-warning' : 'text-secondary' }}">
                                    <use xlink:href="#star-{{ $i <= $product->rating ? 'solid' : 'outline' }}"></use>
                                    </svg>
                                    @endfor --}}
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    {{-- <div class="swiper-slide">
                        <div class="product-item">
                            <span class="badge bg-success position-absolute m-3">-30%</span>
                            <figure>
                                <a href="single-product.html" title="Product Title">
                                    <img src="images/product-thumb-1.png" alt="Product Thumbnail" class="img-fluid">
                                </a>
                            </figure>
                            <p>Super Shoes</p>
                            <div class="d-flex justify-content-between">
                                <p><span class="text-dark">$18.00</span><del>$23</del><span
                                        class="text-success">-30%</span></p>
                                <span class="d-flex">
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                    <svg width="18" height="18" class="text-warning">
                                        <use xlink:href="#star-solid"></use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="swiper-slide">
                            <div class="product-item">
                                <span class="badge bg-success position-absolute m-3">-30%</span>
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-2.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Leather Brown</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <span class="badge bg-success position-absolute m-3">-30%</span>
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-3.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Trending Shoes Party Wear For Men</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-outline"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-4.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Sports Shoes Training & Gym Shoes For Men</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-5.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Kids Shoes</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-6.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Super Shoes</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-7.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Super Shoes</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-5.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Super Shoes</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-6.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Super Shoes</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure>
                                    <a href="single-product.html" title="Product Title">
                                        <img src="images/product-thumb-7.png" alt="Product Thumbnail" class="img-fluid">
                                    </a>
                                </figure>
                                <p>Super Shoes</p>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">$18.00</span><del>$23</del><span
                                            class="text-success">-30%</span></p>
                                    <span class="d-flex">
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use xlink:href="#star-solid"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div> --}}

                </div>
                {{-- </div> --}}
                <!-- / products-carousel -->

            </div>
        </div>

    </div>
</section>

<script>
// Chỉ xử lý phần ảnh
function changeMainImage(imageSrc, thumbnailElement) {
    // Update main image
    document.getElementById('mainImage').src = imageSrc;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    thumbnailElement.classList.add('active');
}

// Initialize first thumbnail as active if no thumbnails are active
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    if (thumbnails.length > 0 && !document.querySelector('.thumbnail-item.active')) {
        thumbnails[0].classList.add('active');
    }
});
</script>

@endsection
