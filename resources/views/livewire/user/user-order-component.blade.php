<div>
    @php
        $no = 1;
    @endphp
    <style>
        nav svg{
            height : 20px;
        }

        nav .hidden{
            display : block !important;
        }   
    </style>
    <div>
        <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
            <h1 class="text-3xl font-semibold inline-block float-left p-3">All Orders For User : {{ Auth::user()->name }}</h1>
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
