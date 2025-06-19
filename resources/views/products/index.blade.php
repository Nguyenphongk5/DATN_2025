<form method="GET" action="{{ route('products.index') }}">
    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm" value="{{ request('search') }}">

    <select name="category">
        <option value="">Chọn danh mục</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <input type="number" name="min_price" placeholder="Giá tối thiểu" value="{{ request('min_price') }}">
    <input type="number" name="max_price" placeholder="Giá tối đa" value="{{ request('max_price') }}">

    <select name="sort_by">
        <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
        <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
        <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
    </select>

    <button type="submit">Tìm kiếm</button>
</form>

<h2>Danh sách sản phẩm</h2>
@if($products->isEmpty())
    <p>Không tìm thấy sản phẩm nào.</p>
@else
    <div>
        @foreach($products as $product)
            <div>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>{{ number_format($product->price, 0, ',', '.') }} VND</p>
            </div>
        @endforeach
    </div>

    <!-- Phân trang -->
    <div>
        {{ $products->links() }}
    </div>
@endif
