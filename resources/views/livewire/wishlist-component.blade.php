<main id="main" class="main-site">
    {{-- @dd(Cart::instance('wishlist')->content()) --}}
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>
        <div class=" main-content-area">

            <div class="wrap-iten-in-cart">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Cart::instance('wishlist')->count() > 0)
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                @foreach (Cart::instance('wishlist')->content() as $item)
                <li class="pr-cart-item">
                    <div class="product-image">
                        <figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->name }}"></figure>
                    </div>
                    <div class="product-name">
                        <a class="link-to-product" href="{{ route('product.details', ['slug' => $item->model->slug]) }}">{{ $item->name }}</a>
                    </div>
                    <div class="price-field produtc-price"><p class="price">${{ $item->price }}</p></div>
                    
                    <div class="quantity text-center">
                        <div>
                            <span class="block my-10"><a class="p-3 hover:bg-red-800 text-white hover:text-gray-200 bg-red-500" href="#" wire:click.prevent="destroy('{{ $item->rowId }}')">Remove</a></span>
                        </div>
                        <div>
                            <a href="#" wire:click.prevent="moveToCart('{{ $item->rowId }}', {{ $item->model->id }}, '{{ $item->model->name }}', {{ $item->model->regular_price }})"><button class="p-3 hover:bg-yellow-800 text-white hover:text-gray-200 bg-yellow-500">Move to cart</button></a>
                        </div>
                    </div>
                </li>	
                @endforeach
                <div class="text-center text-3xl">
                    <span class="block my-10"><a class="p-3 bg-red-500 text-white hover:text-gray-200" href="#" wire:click.prevent="destroyAll">clear wishlist</a></span>
                </div>
                @else
                    <div class="text-center text-3xl">
                        <p>No items wishlisted...</p><span class="block my-10"><a class="p-3 bg-red-500 text-white hover:text-gray-200" href="/shop">shop now</a></span>
                    </div>
                @endif
                </ul>
            </div>

        </div><!--end main content area-->
    </div><!--end container-->

</main>