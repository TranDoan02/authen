<div class="card product-card h-100">
    <a href="{{ route('products.show', $product->slug) }}">
        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}" 
             class="card-img-top product-image" alt="{{ $product->name }}">
    </a>
    <div class="card-body p-2">
        <h6 class="card-title small mb-2" style="min-height: 40px;">{{ Str::limit($product->name, 50) }}</h6>
        <div class="mb-2">
            @if($product->sale_price)
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="product-price small">{{ number_format($product->sale_price) }}đ</span>
                    <span class="product-sale-price small">{{ number_format($product->price) }}đ</span>
                </div>
                <span class="product-discount small">-{{ $product->discount_percent }}%</span>
            @else
                <span class="product-price small">{{ number_format($product->price) }}đ</span>
            @endif
        </div>
        <div class="mb-2">
            @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= $product->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 10px;"></i>
            @endfor
            <small class="text-muted">({{ $product->rating_count }})</small>
        </div>
        <div class="mb-2">
            <small class="text-muted">
                <i class="fas fa-truck me-1"></i>Miễn phí vận chuyển
            </small>
        </div>
        <button type="button" class="btn btn-primary btn-sm w-100 add-to-cart-btn" data-product-id="{{ $product->id }}">
            <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
        </button>
    </div>
</div>

