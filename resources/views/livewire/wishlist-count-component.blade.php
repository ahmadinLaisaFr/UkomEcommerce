<div class="wrap-icon-section wishlist">
    <a href="{{ route('products.wishlist') }}" class="link-direction">
        <i class="fa fa-heart" aria-hidden="true"></i>
        <div class="left-info">
            @if (Cart::instance('wishlist')->content()->count() > 0)
            <span class="index">{{ Cart::instance('wishlist')->content()->count() }} item</span>
            @endif
            <span class="title">WISHLIST</span>
        </div>
    </a>
</div>
