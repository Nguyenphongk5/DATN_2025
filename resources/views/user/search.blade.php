@extends('layouts.user')

@section('content')
  <section class="py-4">
    <div class="container-fluid">

      <!-- Hiển thị sản phẩm tìm kiếm -->
      <div class="row">
        @foreach($products as $product)
          <div class="col-md-4">
            <div class="product-item">
              <figure>
                <a href="{{ route('home.show', $product->id) }}" title="{{ $product->name }}">
                  <img src="{{ asset('storage/'.$product->img_thumb) }}" alt="{{ $product->name }}" class="img-fluid">
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

      <!-- Phân trang -->
      <div class="pagination">
        {{ $products->links() }}
      </div>
    </div>
  </section>
@endsection
