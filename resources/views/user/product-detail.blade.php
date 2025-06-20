@extends('layouts.user')
@section('content')
    <section id="selling-product" class="single-product mt-0 mt-md-5">
        <div class="container-fluid">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="row flex-column-reverse flex-lg-row">
                        <div class="col-md-12 col-lg-2">
                            <!-- product-thumbnail-slider -->
                            <div class="swiper product-thumbnail-slider">
                                <div class="swiper-wrapper ">
                                    <div class="swiper-slide">
                                        <img src="images/product-thumbnail-1.jpg" alt=""
                                            class="thumb-image img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="images/product-thumbnail-2.jpg" alt=""
                                            class="thumb-image img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="images/product-thumbnail-3.jpg" alt=""
                                            class="thumb-image img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="images/product-thumbnail-4.jpg" alt=""
                                            class="thumb-image img-fluid">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="images/product-thumbnail-5.jpg" alt=""
                                            class="thumb-image img-fluid">
                                    </div>
                                </div>
                            </div>
                            <!-- / product-thumbnail-slider -->
                        </div>
                        <div class="col-md-12 col-lg-10">
                            <!-- product-large-slider -->
                            <div class="swiper product-large-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="image-zoom" data-scale="2.5" data-image="images/product-large-1.jpg">
                                            <img src="images/product-large-1.jpg" alt="product-large" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-zoom" data-scale="2.5" data-image="images/product-large-2.jpg">
                                            <img src="images/product-large-2.jpg" alt="product-large" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-zoom" data-scale="2.5" data-image="images/product-large-3.jpg">
                                            <img src="images/product-large-3.jpg" alt="product-large" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-zoom" data-scale="2.5" data-image="images/product-large-4.jpg">
                                            <img src="images/product-large-4.jpg" alt="product-large" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="image-zoom" data-scale="2.5" data-image="images/product-large-5.jpg">
                                            <img src="images/product-large-5.jpg" alt="product-large" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <!-- / product-large-slider -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product-info">
                        <div class="element-header">
                            <h2 itemprop="name" class="display-6">Men's Casual Shoes</h2>
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
                            <strong class="text-primary display-6 fw-bold">$870.00</strong><del
                                class="ms-2">$940.00</del>
                        </div>
                        <p>Justo, cum feugiat imperdiet nulla molestie ac vulputate scelerisque amet. Bibendum adipiscing
                            platea blandit sit sed quam semper rhoncus. Diam ultrices maecenas consequat eu tortor orci,
                            cras lectus mauris, cras egestas quam venenatis neque.</p>
                        <div class="cart-wrap py-5">
                            <div class="color-options pb-3">
                                <div class="color-toggle" data-option-index="0">
                                    <h6 class="item-title text-uppercase text-dark">Color:</h6>

                                    <input type="radio" class="btn-check" name="options-color" id="option5"
                                        autocomplete="off" checked>
                                    <label class="btn" for="option5">Green</label>

                                    <input type="radio" class="btn-check" name="options-color" id="option6"
                                        autocomplete="off">
                                    <label class="btn" for="option6">Orange</label>

                                    <input type="radio" class="btn-check" name="options-color" id="option7"
                                        autocomplete="off" disabled>
                                    <label class="btn" for="option7">Red</label>

                                    <input type="radio" class="btn-check" name="options-color" id="option8"
                                        autocomplete="off">
                                    <label class="btn" for="option8">Black</label>
                                </div>
                            </div>
                            <div class="swatch" data-option-index="1">
                                <h6 class="item-title text-uppercase text-dark">Size:</h6>
                                <input type="radio" class="btn-check" name="options-size" id="option9"
                                    autocomplete="off" checked>
                                <label class="btn" for="option9">XL</label>

                                <input type="radio" class="btn-check" name="options-size" id="option10"
                                    autocomplete="off">
                                <label class="btn" for="option10">L</label>

                                <input type="radio" class="btn-check" name="options-size" id="option11"
                                    autocomplete="off" disabled>
                                <label class="btn" for="option11">M</label>

                                <input type="radio" class="btn-check" name="options-size" id="option12"
                                    autocomplete="off">
                                <label class="btn" for="option12">S</label>
                            </div>
                            <div class="product-quantity pt-3">
                                <div class="stock-number text-dark"><em>2 in stock</em></div>
                                <div class="stock-button-wrap">

                                    <div class="input-group product-qty" style="max-width: 150px;">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn btn-light btn-number"
                                                data-type="minus" data-field="">
                                                <svg width="16" height="16">
                                                    <use xlink:href="#minus"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <input type="text" id="quantity" name="quantity"
                                            class="form-control input-number text-center" value="1" min="1"
                                            max="100">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-light btn-number"
                                                data-type="plus" data-field="">
                                                <svg width="16" height="16">
                                                    <use xlink:href="#plus"></use>
                                                </svg>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="qty-button d-flex flex-wrap pt-3">
                                        <button type="submit"
                                            class="btn btn-primary py-3 px-4 text-uppercase me-3 mt-3">Buy now</button>
                                        <button type="submit" name="add-to-cart" value="1269"
                                            class="btn btn-dark py-3 px-4 text-uppercase mt-3">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="meta-product py-2">
                            <div class="meta-item d-flex align-items-baseline">
                                <h6 class="item-title no-margin pe-2">SKU:</h6>
                                <ul class="select-list list-unstyled d-flex">
                                    <li data-value="S" class="select-item">1223</li>
                                </ul>
                            </div>
                            <div class="meta-item d-flex align-items-baseline">
                                <h6 class="item-title no-margin pe-2">Category:</h6>
                                <ul class="select-list list-unstyled d-flex">
                                    <li data-value="S" class="select-item">
                                        <a href="#">Watch</a>,
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
                            data-bs-target="#v-pills-additional" type="button" role="tab"
                            aria-controls="v-pills-additional" aria-selected="false">Additional Information</button>
                        <button class="nav-link text-start" id="v-pills-reviews-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-reviews" type="button" role="tab"
                            aria-controls="v-pills-reviews" aria-selected="false">Customer Reviews</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-description" role="tabpanel"
                            aria-labelledby="v-pills-description-tab" tabindex="0">
                            <h5>Product Description</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis
                                eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                                posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris
                                sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh.
                                Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus.</p>
                            <ul style="list-style-type:disc;" class="list-unstyled ps-4">
                                <li>Donec nec justo eget felis facilisis fermentum.</li>
                                <li>Suspendisse urna viverra non, semper suscipit pede.</li>
                                <li>Aliquam porttitor mauris sit amet orci.</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis
                                eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                                posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris
                                sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh.
                                Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. </p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-additional" role="tabpanel"
                            aria-labelledby="v-pills-additional-tab" tabindex="0">
                            <p>It is Comfortable and Best</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                                in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-reviews" role="tabpanel"
                            aria-labelledby="v-pills-reviews-tab" tabindex="0">
                            <div class="review-box d-flex flex-wrap">
                                <div class="col-lg-6 d-flex flex-wrap gap-3">
                                    <div class="col-md-2">
                                        <div class="image-holder">
                                            <img src="images/reviewer-1.jpg" alt="review"
                                                class="img-fluid rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="review-content">
                                            <div class="rating-container d-flex align-items-center">
                                                <div class="rating" data-rating="1">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="2">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="3">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="4">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-outline"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="5">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-outline"></use>
                                                    </svg>
                                                </div>
                                                <span class="rating-count">(3.5)</span>
                                            </div>
                                            <div class="review-header">
                                                <span class="author-name">Tina Johnson</span>
                                                <span class="review-date">– 03/07/2023</span>
                                            </div>
                                            <p>Vitae tortor condimentum lacinia quis vel eros donec ac. Nam at lectus urna
                                                duis convallis convallis</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex flex-wrap gap-3">
                                    <div class="col-md-2">
                                        <div class="image-holder">
                                            <img src="images/reviewer-2.jpg" alt="review"
                                                class="img-fluid rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="review-content">
                                            <div class="rating-container d-flex align-items-center">
                                                <div class="rating" data-rating="1">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="2">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="3">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="4">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-outline"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="5">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-outline"></use>
                                                    </svg>
                                                </div>
                                                <span class="rating-count">(3.5)</span>
                                            </div>
                                            <div class="review-header">
                                                <span class="author-name">Jenny Willis</span>
                                                <span class="review-date">– 03/06/2022</span>
                                            </div>
                                            <p>Vitae tortor condimentum lacinia quis vel eros donec ac. Nam at lectus urna
                                                duis convallis convallis</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-review mt-5">
                                <h3>Add a review</h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <form id="form" class="form-group">

                                    <div class="pb-3">
                                        <div class="review-rating">
                                            <span>Your rating *</span>
                                            <div class="rating-container d-flex align-items-center">
                                                <div class="rating" data-rating="1">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="2">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="3">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="4">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-outline"></use>
                                                    </svg>
                                                </div>
                                                <div class="rating" data-rating="5">
                                                    <svg width="24" height="24" class="text-warning">
                                                        <use xlink:href="#star-outline"></use>
                                                    </svg>
                                                </div>
                                                <span class="rating-count">(3.5)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pb-3">
                                        <input type="file" class="form-control" data-text="Choose your file">
                                    </div>
                                    <div class="pb-3">
                                        <label>Your Review *</label>
                                        <textarea class="form-control" placeholder="Write your review here"></textarea>
                                    </div>
                                    <div class="pb-3">
                                        <label>Your Name *</label>
                                        <input type="text" name="name" placeholder="Write your name here"
                                            class="form-control">
                                    </div>
                                    <div class="pb-3">
                                        <label>Your Email *</label>
                                        <input type="text" name="email" placeholder="Write your email here"
                                            class="form-control">
                                    </div>
                                    <div class="pb-3">
                                        <label>
                                            <input type="checkbox" required="">
                                            <span class="label-body">Save my name, email, and website in this browser for
                                                the next
                                                time.</span>
                                        </label>
                                    </div>
                                    <button type="submit" name="submit"
                                        class="btn btn-dark btn-large text-uppercase w-100">Submit</button>
                                </form>
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

                <div class="products-carousel swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
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
                        </div>

                        <div class="swiper-slide">
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
                        </div>

                    </div>
                    {{-- </div> --}}
                    <!-- / products-carousel -->

                </div>
            </div>

        </div>
    </section>
@endsection
