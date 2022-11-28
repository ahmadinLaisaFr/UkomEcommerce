<div>
    <div>
        <div>
            <div>
                <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                    <h1 class="text-3xl font-semibold inline-block float-left p-3">Insert New Product</h1>
                </div>
                <div class=" container md:rounded-b-lg">
                    <div class="wrap-breadcrumb md:ml-7">
                        <ul>
                            <li class="item-link"><a href="{{ route('admin.coupons') }}" class="link">Coupons</a></li>
                            <li class="item-link"><span>Add New Coupons</span></li>
                        </ul>
                    </div>
                    <div class="md:m-10 overflow-x-auto">
                        <form wire:submit.prevent="save" method="post" class="items-center">
                            @csrf
                            <div class="md:space-y-5">
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="name" class="md:text-right">Coupon  Code</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Coupon Code" type="text" wire:model='code' id="coupon_code">
                                        @error('code') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="name" class="md:text-right">Coupon  Type</label>
                                    <div>
                                        <select class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" wire:model="type" name="coupon_type" id="coupon_type">
                                            <option value="">Select Type</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                        @error('type') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="name" class="md:text-right">Coupon Value</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Coupon Value" type="number" wire:model='value' id="coupon_value">
                                        @error('value') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="name" class="md:text-right">Coupon Cart Value</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Coupon Cart Value" type="number" wire:model='cart_value' id="coupon_cart_value">
                                        @error('cart_value') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="name" class="md:text-right">Expire Date</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Expire Date" type="text" wire:model='expire_date' id="expire_date">
                                        @error('expire_date') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                
                                <div class="md:flex md:justify-center mt-5">
                                    <button class="p-5 px-7 bg-red-500 text-white rounded-lg mt-3" type="submit" id="btn-submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function () {
        $("#expire_date").datetimepicker({
            timepicker : false, 
            format : 'Y-m-d',
        }).on('change', function(ev){
            let data = $('#expire_date').val()
            @this.set('expire_date', data)
        })
    });
</script>
@endpush