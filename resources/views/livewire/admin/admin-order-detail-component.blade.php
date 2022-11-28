<div>
    {{-- order details --}}
    <div class="my-10">
        <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
            <h1 class="text-3xl font-semibold inline-block float-left p-3">Order Details</h1>
            <a href="{{ route('admin.orders')}}" class="p-3 bg-red-500 text-white text-2xl inline-block float-right rounded-lg hover:text-slate-200 hover:bg-red-700" >All Orders</a>
        </div>
        <div class="bg-slate-100 container md:rounded-b-lg">
            <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">  
                <table class="table text-xl mt-10">
                        <tr>
                            <th>Buyer Name</th>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Order Id</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        @if ($order->expedition_id != null)
                        <tr>
                            <th>Expedition</th>
                            <td>{{ $order->expedition->name }}</td>
                        </tr>
                        @endif
                        @if ($order->delivered_date != null)
                        <tr>
                            <th>Delivery Date</th>
                            <td>{{ $order->delivered_date }}</td>
                        </tr>
                        @elseif ($order->canceled_date != null)
                        <tr>
                            <th>Cancellation Date</th>
                            <td>{{ $order->canceled_date }}</td>
                        </tr>
                        @endif
                </table>
            </div>
        </div>
    </div>

    {{-- ordered items --}}
    {{-- @dd($order->orderItems) --}}
    <div class="my-10">
        <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
            <h1 class="text-3xl font-semibold inline-block float-left p-3">Ordered Items</h1>
        </div>
        <div class="bg-slate-100 container md:rounded-b-lg">
            <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">  
                <h1 class="title-box text-2xl font-bold uppercase">Products</h1>
                <div class="wrap-iten-in-cart">
                    <ul class="products-cart">
                        @foreach ($order->orderItems as $item)
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src="{{ asset('assets/images/products') }}/{{ $item->product->image }}" alt="{{ $item->product->name }}"></figure>
                            </div>
                            <div class="product-name">
                                <a class="link-to-product" href="{{ route('product.details', ['slug' => $item->product->slug]) }}">{{ $item->product->name }}</a>
                            </div>
                            <div class="price-field produtc-price text-center">
                                <h1 class="text-lg md:text-2xl font-bold">
                                    Total Price
                                </h1>
                                <p class="price">${{ $item->price }}</p>
                            </div>
                            <div class="quantity text-center">
                                <h1 class="text-lg md:text-2xl font-bold">
                                    Quantity
                                </h1>
                                <h1 class="text-lg md:text-2xl">
                                    {{ $item->quantity }}
                                </h1>
                            </div>
                            
                            <div class="price-field sub-total text-center">
                                <h1 class="text-lg md:text-2xl font-bold">
                                    Total Price
                                </h1>
                                <p class="price font-medium">${{ $item->price * $item->quantity }}</p>
                            </div>
                        </li>	
                        @endforeach
                    </ul>
                </div>
                <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">
                            Order Summary
                        </h4>
                        <p class="summary-info font-medium text-xl"><span class="title">Subtotal</span><b class="index">${{ $item->order->subtotal }}</b></p>
                        <p class="summary-info font-medium text-xl"><span class="title">Tax</span><b class="index">${{ $item->order->tax }}</b></p>
                        <p class="summary-info font-medium text-xl"><span class="title">Delivery Charge</span><b class="index">${{ $item->order->delivery_charge }}</b></p>
                        <p class="summary-info font-medium text-xl"><span class="title">Total</span><b class="index">${{ $item->order->total }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- billing details --}}
    <div class="my-10">
        <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
            <h1 class="text-3xl font-semibold inline-block float-left p-3">Billing Details</h1>
        </div>
        <div class="bg-slate-100 container md:rounded-b-lg">
            <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">  
                <table class="table text-gray-800 text-xl mt-10">
                        <tr>
                            <th>Complete Name</th>
                            <td>{{ $order->complete_name }}</td>
                            <th>Phone Number</th>
                            <td>{{ $order->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $order->email }}</td>
                            <th>Postal Code</th>
                            <td>{{ $order->post_code }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $order->status }}</td>
                            <th>Order Date</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                </table>
            </div>
        </div>
    </div>

    @if ($shipping != null)
        {{-- shipping items --}}
        <div class="my-10">
            <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                <h1 class="text-3xl font-semibold inline-block float-left p-3">Shipping Items</h1>
            </div>
            <div class="bg-slate-100 container md:rounded-b-lg">
                <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">  
                    <table class="table text-xl mt-10">
                            <tr>
                                <th>Complete Name</th>
                                <td>{{ $shipping->complete_name }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $shipping->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $shipping->email }}</td>
                            </tr>
                            <tr>
                                <th>Postal Code</th>
                                <td>{{ $shipping->post_code }}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{ $shipping->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Expedition</th>
                                <td>{{ $shipping->expedition->name }}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    @endif
    {{-- transaction details --}}
    <div class="my-10">
        <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
            <h1 class="text-3xl font-semibold inline-block float-left p-3">Transaction Details</h1>
        </div>
        <div class="bg-slate-100 container md:rounded-b-lg">
            <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">  
                <table class="table text-xl mt-10">
                    @if ($transaction != null)
                    <tr>
                        <th>Transaction Mode</th>
                        <td>{{ $transaction->mode }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $transaction->status }}</td>
                    </tr>
                    <tr>
                        <th>Transaction Date</th>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                    @else
                    <tr>
                        <th>Transaction Mode</th>
                        <td>NOT SET</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>NOT SET</td>
                    </tr>
                    <tr>
                        <th>Transaction Date</th>
                        <td>NOT SET</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>


