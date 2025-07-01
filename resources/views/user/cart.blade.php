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
                            @php $total = 0; @endphp
                          @forelse ($cart?->items ?? [] as $item)

                            @php
                            $variant = $item->productVariant;
                            $product = $variant?->product ?? $item->product;
                            $name = $product?->name ?? 'Sản phẩm không tên';
                            $price = $variant?->price ?? $product?->price ?? 0;
                            $image = $variant?->image ?? $product?->img_thumb ?? 'images/no-image.png';
                            $subtotal = $price * $item->quantity;
                            $total += $subtotal;
                            @endphp
                            <tr>
                                <td scope="row" class="py-4">
                                    <div class="cart-info d-flex flex-wrap align-items-center mb-4">
                                        <div class="col-lg-3">
                                            <div class="card-image">
                                                <img src="{{ asset('storage/'.$image) }}" alt="{{ $name }}" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="card-detail ps-3">
                                                <h5 class="card-title">
                                                    <a href="#" class="text-decoration-none">{{ $name }}</a>
                                                </h5>
                                                @if ($variant)
                                                <p class="mb-0 small text-muted">
                                                    Size: {{ $variant->size }} | Màu: {{ $variant->color_name }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                        class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" class="form-control text-center"
                                            value="{{ $item->quantity }}" min="1" style="width: 80px;">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm ms-2">
                                            Cập nhật
                                        </button>
                                    </form>
                                </td>

                                <td class="py-4">
                                    <div class="total-price">
                                        <span
                                            class="money text-dark">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="cart-remove">
                                        <a href="{{ route('cart.remove', $item->id) }}">
                                            <svg width="24" height="24">
                                                <use xlink:href="#trash"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Giỏ hàng trống</td>
                            </tr>
                            @endforelse
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
                                                <span
                                                    class="price-currency-symbol"></span>{{ number_format($total, 0, ',', '.') }} VNĐ
                                            </bdi>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="order-total pt-2 pb-2 border-bottom">
                                    <th>Total</th>
                                    <td data-title="Total">
                                        <span class="price-amount amount text-dark ps-5">
                                            <bdi>
                                                <span
                                                    class="price-currency-symbol"></span>{{ number_format($total, 0, ',', '.') }} VNĐ</bdi>
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="button-wrap row g-2">

                        <div class="col-md-12">


                            <a href="{{ route('checkout.index') }}"
                                class="btn btn-primary py-3 px-4 text-uppercase btn-rounded-none w-100">
                                Proceed to Checkout
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection
