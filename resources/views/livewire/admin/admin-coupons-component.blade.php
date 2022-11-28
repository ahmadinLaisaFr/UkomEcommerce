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
            <h1 class="text-3xl font-semibold inline-block float-left p-3">All Coupons</h1>
            <a href="{{ route('admin.add.coupon')}}" class="p-3 bg-red-500 text-white text-2xl inline-block float-right rounded-lg hover:text-slate-200 hover:bg-red-700" >Add New Coupon</a>
        </div>
        <div class="bg-slate-100 container md:rounded-b-lg">
            <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">
                @if(session()->has('success'))
                <div class="bg-green-500 p-5 rounded-lg items-center">
                    <p class="text-3xl text-white inline-block">{{ session()->get('success') }}</p>
                    <a href="#" wire:click.prevent="dismissAlert('success')" class="text-white text-3xl inline-block hover:text-slate-500 pull-right">&times;</a>
                </div>
                @endif
                @if(session()->has('failed'))
                <div class="bg-green-500 p-5 rounded-lg items-center">
                    <p class="text-3xl text-white inline-block">{{ session()->get('failed') }}</p>
                    <a href="#" wire:click.prevent="dismissAlert('failed')" class="text-white text-3xl inline-block hover:text-slate-500 pull-right">&times;</a>
                </div>
                @endif

                <table class="table text-xl mt-10">
                    <thead class="bg-gray-500 text-white">
                        <tr>
                            <th>Id</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Cart Value</th>
                            <th>Expire Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->type }}</td>
                                @if ($coupon->type == 'fixed')
                                    <td>$ {{ $coupon->value }}</td>
                                @else
                                    <td>{{ $coupon->value }} %</td>
                                @endif
                                <td>{{ $coupon->cart_value }}</td>
                                <td>{{ $coupon->expire_date }}</td>
                                <td>
                                    <a href="{{ route('admin.update.coupon', ['coupon' => $coupon->id]) }}" title="Update"><i class="fa fa-pencil text-3xl"></i></a>
                                    <a href="#" wire:click.prevent="delete('{{ $coupon->id }}')" id="deleteConfirm" onclick="return confirm('Are you sure want to delete?') || event.stopImmediatePropagation()" title="Delete"><i class="fa fa-trash text-3xl"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="">
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


