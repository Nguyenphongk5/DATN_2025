@extends('layouts.user')
@section('content')
<section class="py-5 mb-5 bg-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h1 class="page-title pb-2">Cart</h1>
                <nav class="breadcrumb fs-6">
                    <a class="breadcrumb-item nav-link" href="#">Home</a>
                    <a class="breadcrumb-item nav-link" href="#">Pages</a>
                    <span class="breadcrumb-item active" aria-current="page">Cart</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container-fluid">
            <div class="row g-5">
                <div class="col-md-8">

                    <div class="table-responsive cart">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="card-title text-uppercase text-muted">Product</th>
                                    <th scope="col" class="card-title text-uppercase text-muted">Quantity</th>
                                    <th scope="col" class="card-title text-uppercase text-muted">Subtotal</th>
                                    <th scope="col" class="card-title text-uppercase text-muted"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row" class="py-4">
                                        <div class="cart-info d-flex flex-wrap align-items-center mb-4">
                                            <div class="col-lg-3">
                                                <div class="card-image">
                                                    <img src="images/product-thumb-1.png" alt="cloth" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="card-detail ps-3">
                                                    <h5 class="card-title">
                                                        <a href="#" class="text-decoration-none">Product One</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="input-group product-qty w-50">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-left-minus btn btn-light btn-number"
                                                    data-type="minus">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#minus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity"
                                                class="form-control input-number text-center" value="1">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-right-plus btn btn-light btn-number"
                                                    data-type="plus" data-field="">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#plus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="total-price">
                                            <span class="money text-dark">$150.00</span>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="cart-remove">
                                            <a href="#">
                                                <svg width="24" height="24">
                                                    <use xlink:href="#trash"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="py-4">
                                        <div class="cart-info d-flex flex-wrap align-items-center">
                                            <div class="col-lg-3">
                                                <div class="card-image">
                                                    <img src="images/product-thumb-2.png" alt="product"
                                                        class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="card-detail ps-3">
                                                    <h5 class="card-title">
                                                        <a href="#" class="text-decoration-none">Product Two</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="input-group product-qty w-50">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-left-minus btn btn-light btn-number"
                                                    data-type="minus">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#minus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                            <input type="text" id="quantity" name="quantity"
                                                class="form-control input-number text-center" value="1">
                                            <span class="input-group-btn">
                                                <button type="button"
                                                    class="quantity-right-plus btn btn-light btn-number"
                                                    data-type="plus" data-field="">
                                                    <svg width="16" height="16">
                                                        <use xlink:href="#plus"></use>
                                                    </svg>
                                                </button>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="total-price">
                                            <span class="money text-dark">$870.00</span>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="cart-remove">
                                            <a href="#">
                                                <svg width="24" height="24">
                                                    <use xlink:href="#trash"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="cart-totals bg-grey py-5">
                        <h4 class="text-dark pb-4">Cart Total</h4>
                        <div class="total-price pb-5">
                            <table cellspacing="0" class="table text-uppercase">
                                <tbody>
                                    <tr class="subtotal pt-2 pb-2 border-top border-bottom">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal">
                                            <span class="price-amount amount text-dark ps-5">
                                                <bdi>
                                                    <span class="price-currency-symbol">$</span>2,370.00
                                                </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="order-total pt-2 pb-2 border-bottom">
                                        <th>Total</th>
                                        <td data-title="Total">
                                            <span class="price-amount amount text-dark ps-5">
                                                <bdi>
                                                    <span class="price-currency-symbol">$</span>2,370.00</bdi>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="button-wrap row g-2">
                            <div class="col-md-6"><button
                                    class="btn btn-dark py-3 px-4 text-uppercase btn-rounded-none w-100">Update
                                    Cart</button></div>
                            <div class="col-md-6"><button
                                    class="btn btn-dark py-3 px-4 text-uppercase btn-rounded-none w-100">Continue
                                    Shopping</button></div>
                            <div class="col-md-12"><button
                                    class="btn btn-primary py-3 px-4 text-uppercase btn-rounded-none w-100">Proceed to
                                    checkout</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
