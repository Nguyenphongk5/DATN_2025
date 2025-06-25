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
                            <div class="product-item" >
                                <figure>
                                    <a href="{{ route('home.show', $product->id) }}" title="{{ $product->name }}">
                                        <img src="{{ asset('storage/' . $product->img_thumb) }}" alt="{{ $product->name }}"
                                            class="img-fluid">
                                    </a>
                                </figure>
                                <span>{{ $product->name }}</span>
                                <div class="d-flex justify-content-between">
                                    <p><span class="text-dark">${{ number_format($product->price, 2) }}</span></p>
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
