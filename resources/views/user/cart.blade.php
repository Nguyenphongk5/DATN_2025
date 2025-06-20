{{-- @extends('layouts.user')
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
                                    <th class="card-title text-uppercase text-muted">Product</th>
                                    <th class="card-title text-uppercase text-muted">Quantity</th>
                                    <th class="card-title text-uppercase text-muted">Subtotal</th>
                                    <th class="card-title text-uppercase text-muted"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts?->items ?? [] as $item)
                                    <tr>
                                        <td class="py-4">
                                            <div class="cart-info d-flex flex-wrap align-items-center mb-4">
                                                <div class="col-lg-3">
                                                    <div class="card-image">
                                                        <img src="{{ asset('images/' . $item->variant->product->img_thumb) }}"
                                                            alt="cloth" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="card-detail ps-3">
                                                        <h5 class="card-title">
                                                            <a href="#"
                                                                class="text-decoration-none">{{ $item->variant->product->name }}</a><br>
                                                            <small>Size: {{ $item->variant->size }} | Color:
                                                                {{ $item->variant->color_name }}</small>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <form action="{{ route('carts.update', $item->id) }}" method="POST"
                                                class="d-flex">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group product-qty w-50">
                                                    <span class="input-group-btn">
                                                        <button type="submit" name="action" value="decrease"
                                                            class="quantity-left-minus btn btn-light btn-number">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#minus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                    <input type="text" name="quantity"
                                                        class="form-control input-number text-center"
                                                        value="{{ $item->quantity }}" readonly>
                                                    <span class="input-group-btn">
                                                        <button type="submit" name="action" value="increase"
                                                            class="quantity-right-plus btn btn-light btn-number">
                                                            <svg width="16" height="16">
                                                                <use xlink:href="#plus"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="py-4">
                                            <div class="total-price">
                                                <span class="money text-dark">
                                                    {{ number_format(($item->variant->price_sale ?? $item->variant->price) * $item->quantity, 0, ',', '.') }}
                                                    đ
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <div class="cart-remove">
                                                <form action="{{ route('carts.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background: none; border: none">
                                                        <svg width="24" height="24">
                                                            <use xlink:href="#trash"></use>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="cart-totals bg-grey py-5">
                        <h4 class="text-dark pb-4">Cart Total</h4>
                        @php
                            $total = $carts->items->sum(
                                fn($item) => ($item->variant->price_sale ?? $item->variant->price) * $item->quantity,
                            );
                        @endphp
                        <div class="total-price pb-5">
                            <table cellspacing="0" class="table text-uppercase">
                                <tbody>
                                    <tr class="subtotal pt-2 pb-2 border-top border-bottom">
                                        <th>Subtotal</th>
                                        <td>{{ number_format($total, 0, ',', '.') }} đ</td>
                                    </tr>
                                    <tr class="order-total pt-2 pb-2 border-bottom">
                                        <th>Total</th>
                                        <td>{{ number_format($total, 0, ',', '.') }} đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="button-wrap row g-2">
                            <div class="col-md-6">
                                <button class="btn btn-dark py-3 px-4 w-100">Update Cart</button>
                            </div>
                            <div class="col-md-6">
                                <a href="" class="btn btn-dark py-3 px-4 w-100">Continue Shopping</a>
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary py-3 px-4 w-100">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection --}}

@extends('layouts.user')
@section('content')
    <section class="py-5 mb-5 bg-light">
        <div class="container-fluid">
            <h1 class="page-title pb-2">Giỏ hàng</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
    </section>

    <section class="py-5">
        <div class="container-fluid">
            <div class="row g-5">
                <div class="col-md-8">
                    <form action="{{ route('carts.update', $carts->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="table-responsive cart">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts?->items ?? [] as $index => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('images/' . $item->variant->product->img_thumb) }}"
                                                        alt="product" width="60" class="me-3">
                                                    <div>
                                                        <strong>{{ $item->variant->product->name }}</strong><br>
                                                        <small>Size: {{ $item->variant->size }} | Màu:
                                                            {{ $item->variant->color_name }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <input type="hidden" name="items[{{ $index }}][id]"
                                                    value="{{ $item->id }}">
                                                <input type="number" name="items[{{ $index }}][quantity]"
                                                    value="{{ $item->quantity }}" min="1" class="form-control w-50">
                                            </td>

                                            <td>
                                                {{ number_format(($item->variant->price_sale ?? $item->variant->price) * $item->quantity, 0, ',', '.') }}
                                                đ
                                            </td>

                                            <td>
                                                <input type="checkbox" name="remove[]" value="{{ $item->id }}"> Xóa
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-dark mt-3">Cập nhật giỏ hàng</button>
                    </form>
                </div>

                <div class="col-md-4">
                    <div class="bg-grey p-4">
                        <h4>Tổng cộng</h4>
                        @php
                            $total = $carts->items->sum(function ($item) {
                                return ($item->variant->price_sale ?? $item->variant->price) * $item->quantity;
                            });
                        @endphp
                        <p class="mt-3">Tổng tiền: <strong>{{ number_format($total, 0, ',', '.') }} đ</strong></p>

                        <a href="#" class="btn btn-primary mt-3 w-100">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
