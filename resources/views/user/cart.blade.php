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
                                <th><input type="checkbox" id="select-all"></th>
                                <th class="text-uppercase text-muted">Product</th>
                                <th class="text-uppercase text-muted">Quantity</th>
                                <th class="text-uppercase text-muted">Subtotal</th>
                                <th></th>
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
                                    <td>
                                        <input type="checkbox" class="item-checkbox" value="{{ $item->id }}" data-subtotal="{{ $subtotal }}">
                                    </td>
                                    <td scope="row" class="py-4">
                                        <div class="cart-info d-flex flex-wrap align-items-center mb-4">
                                            <div class="col-lg-3">
                                                <img src="{{ asset('storage/'.$image) }}" alt="{{ $name }}" class="img-fluid">
                                            </div>
                                            <div class="col-lg-9 ps-3">
                                                <h5><a href="#" class="text-decoration-none">{{ $name }}</a></h5>
                                                @if ($variant)
                                                    <p class="small text-muted">Size: {{ $variant->size }} | Màu: {{ $variant->color_name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity" class="form-control text-center" value="{{ $item->quantity }}" min="1" style="width: 80px;">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm ms-2">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td class="py-4">
                                        <span class="text-dark">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</span>
                                    </td>
                                    <td class="py-4">
                                        <a href="{{ route('cart.remove', $item->id) }}">
                                            <svg width="24" height="24"><use xlink:href="#trash"></use></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Giỏ hàng trống</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="col-md-4">
                <div class="cart-totals bg-grey py-5">
                    <h4 class="text-dark pb-4">Cart Total</h4>
                    <div class="total-price pb-5">
                        <table class="table text-uppercase">
                            <tbody>
                                <tr class="subtotal pt-2 pb-2 border-top border-bottom">
                                    <th>Subtotal</th>
                                    <td>
                                        <span id="subtotal-amount" class="text-dark ps-5">
                                            {{ number_format($total, 0, ',', '.') }} VNĐ
                                        </span>
                                    </td>
                                </tr>
                                <tr class="order-total pt-2 pb-2 border-bottom">
                                    <th>Total</th>
                                    <td>
                                        <span id="total-amount" class="text-dark ps-5">
                                            {{ number_format($total, 0, ',', '.') }} VNĐ
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="button-wrap row g-2">
                        <div class="col-md-12">
                            <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                                <input type="hidden" name="selected_items" id="selected-items">
                                <button type="submit" class="btn btn-primary w-100 mt-3" id="checkout-button">
                                    Đặt hàng (Chỉ các sản phẩm đã chọn)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const selectAll = document.getElementById('select-all');
    const checkoutBtn = document.getElementById('checkout-button');
    const subtotalEl = document.getElementById('subtotal-amount');
    const totalEl = document.getElementById('total-amount');

    function updateTotal() {
        let total = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.dataset.subtotal);
            }
        });

        subtotalEl.textContent = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
        totalEl.textContent = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';

        checkoutBtn.classList.toggle('disabled', total === 0);
        checkoutBtn.style.pointerEvents = total === 0 ? 'none' : 'auto';
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateTotal();
        });
    }

    updateTotal();
</script>

<script>
    document.getElementById('checkout-form').addEventListener('submit', function (e) {
        const selected = [];
        document.querySelectorAll('.item-checkbox:checked').forEach(cb => {
            selected.push(cb.value);
        });

        if (selected.length === 0) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất một sản phẩm để đặt hàng.');
            return;
        }

        document.getElementById('selected-items').value = selected.join(',');
    });
</script>

@endsection
