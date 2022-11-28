<div>
    <div class="">
        <div class="container p-5">
            <div class="border-b-2 border-red-500 p-5">
                <h1 class="text-3xl font-bold text-gray-800">My Account</h1>
            </div>
            <div class="mx-auto text-center w-fit my-16">
                <div class="h-64 w-64 bg-gray-300 rounded-full"></div>
                <h2 class="text-2xl  mt-2">{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->email }}</p>
            </div>

            {{-- overview --}}
            <div>
                <div class="border-b-2 border-gray-200 p-5">
                    {{-- title --}}
                    <h2 class="text-2xl font-semibold text-gray-800">Overview</h2>
                </div>
                <div class="grid md:grid-cols-4 gap-10 my-16">
                    {{-- cart --}}
                    <a href="{{ route('products.cart') }}">
                        <div class="bg-yellow-500 hover:bg-yellow-600 rounded-2xl p-5 text-white flex items-center justify-between">
                            <div>
                                <h1 class="font-bold text-4xl">Your Cart</h1>
                                <span><i class="text-[60px] fa fa-cart-plus"></i></span>
                            </div>
                            <span class="mr-16">
                                <p class="text-[70px] text-center">{{ Cart::instance('cart')->count() }}</p>
                                <p class="text-[20px] text-center">items</p>
                            </span>
                        </div>
                    </a>
                    {{-- wishlist --}}
                    <a href="{{ route('products.wishlist') }}">
                        <div class="bg-purple-500 hover:bg-purple-600 transform rounded-2xl p-5 text-white flex items-center justify-between">
                            <div>
                                <h1 class="font-bold text-4xl">Wishlist</h1>
                                <span><i class="text-[60px] fa fa-heart"></i></span>
                            </div>
                            <span class="mr-16">
                                <p class="text-[70px] text-center">{{ Cart::instance('wishlist')->count() }}</p>
                                <p class="text-[20px] text-center">items</p>
                            </span>
                        </div>
                    </a>
                    {{-- Ordered --}}
                    <a href="{{ route('user.orders') }}">
                        <div class="bg-teal-500 hover:bg-teal-600 transform rounded-2xl p-5 text-white flex items-center justify-between">
                            <div>
                                <h1 class="font-bold text-4xl">Order</h1>
                                <span><i class="text-[60px] fa fa-shopping-bag"></i></span>
                            </div>
                            <span class="mr-16">
                                <p class="text-[70px] text-center">{{ ($orders_count != null) ? $orders_count : '0' }}</p>
                                <p class="text-[20px] text-center">Orders</p>
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Latest Order --}}
            <div>
                <div class="border-b-2 border-gray-200 p-5">
                    {{-- title --}}
                    <h2 class="text-2xl font-semibold text-gray-800">Latest Order</h2>
                </div>
                <div class="bg-slate-100 container md:rounded-b-lg">
                    <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto md:overflow-visible">
                        @if(session()->has('success'))
                        <div class="bg-green-500 p-5 rounded-lg items-center">
                            <p class="text-3xl text-white inline-block">{{ session()->get('success') }}</p>
                            <a href="#" wire:click.prevent="dismissAlert('success')" class="text-white text-3xl inline-block hover:text-slate-500 pull-right">&times;</a>
                        </div>
                        @endif
                        @if(session()->has('failed'))
                        <div class="bg-red-500 p-5 rounded-lg items-center">
                            <p class="text-3xl text-white inline-block">{{ session()->get('failed') }}</p>
                            <a href="#" wire:click.prevent="dismissAlert('failed')" class="text-white text-3xl inline-block hover:text-slate-500 pull-right">&times;</a>
                        </div>
                        @endif
                
                        <table class="table text-xl mt-10">
                            <thead class="bg-gray-500 text-white">
                                <tr>
                                    <th class="text-center">Order Id</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Delivery Charge</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Complete Name</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Postal Code</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="text-center">
                                        <td>{{ $order->id }}</td>
                                        <td>${{ $order->subtotal }}</td>
                                        <td>${{ $order->discount }}</td>
                                        <td>${{ $order->tax }}</td>
                                        <td>${{ $order->delivery_charge }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>{{ $order->complete_name }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->post_code }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td class="flex flex-col md:flex-row md:space-x-5">
                                            <div class="w-fit mx-auto">
                                                <a href="{{ route('user.order.detail', ['orderr' => $order->id]) }}" title="Order Details"><i class="fa fa-bars text-3xl"></i></a>
                                            </div>
                                            
                                            <div class="dropdown w-fit mx-auto">
                                                <button type="button" data-toggle="dropdown">
                                                    <span class="fa fa-times text-3xl"></span>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu -left-[140px]">
                                                    <li><a href="#" wire:click.prevent="updateStatus({{$order->id}},'canceled')" onclick="return confirm('Are you sure you want to cancel?') || event.stopImmediatePropagation()">Cancel</a></li>
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
