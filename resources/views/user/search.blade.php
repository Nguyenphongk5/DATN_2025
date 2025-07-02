@extends('layouts.user')

@section('content')
    <section class="py-4">
        <div class="container-fluid">

            <h2 class="text-center mb-4">Kết quả tìm kiếm cho: <span class="text-primary">{{ $keywords }}</span></h2>
            <!-- Hiển thị sản phẩm tìm kiếm -->
            @if (count($products) == 0)
                <div class="alert alert-warning text-center">
                    Không tìm thấy sản phẩm nào phù hợp với từ khóa "<strong>{{ $keywords }}</strong>".
                </div>
            @else
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4" style="width: 25%">
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
                </div>
            @endif


            <!-- Phân trang -->
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
