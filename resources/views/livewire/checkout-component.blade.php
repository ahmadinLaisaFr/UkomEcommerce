<main id="main" class="main-site">
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/shop" class="link">home</a></li>
                <li class="item-link"><span>checkout</span></li>
            </ul>
        </div>
        <div class="main-content-area">
            <form  wire:submit.prevent="placeOrder">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Billing Information</h3>
                            @if (Session::has('failed'))
                            <div class="alert alert-danger">
                                {{ Session::get('failed') }}
                            </div>
                            @endif
                            <div>
                                <p class="row-in-form">
                                    <label for="add">Complete Name</label>
                                    <input id="add" type="text" name="complete_name" value="" wire:model="complete_name" placeholder="Complete Name">
                                    @error('complete_name') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Phone number<span>*</span></label>
                                    <input id="phone" type="number" name="phone" value="" wire:model="phone_number" placeholder="10 digits format">
                                    @error('phone_number') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Address</label>
                                    <input id="add" type="text" name="address" value="" wire:model="address" placeholder="Address">
                                    @error('address') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Email Address</label>
                                    <input id="add" type="text" name="email" value="" wire:model="email" placeholder="Email Address">
                                    @error('email') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Country<span>*</span></label>
                                    <select name="country" id="country" wire:model="country" wire:change="calculateDeliveryCharge" class="w-full h-[43px] border-gray-200 py-[2px] px-[20px] text-[13px]">
                                        <option value="">Choose Country</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="North Vietnam">North Vietnam</option>
                                    </select>
                                    @error('country') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Postcode / ZIP:</label>
                                    <input id="zip-code" type="number" name="post-code" value="" wire:model="post_code" placeholder="Your postal code">
                                    @error('post_code') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="city">Town / City<span>*</span></label>
                                    <input id="city" type="text" name="city" wire:model="city" placeholder="City name">
                                    @error('city') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form fill-wife">
                                    <label class="checkbox-field">
                                        <input name="ship_diff" id="different-add" value="1" wire:model="ship_diff" type="checkbox">
                                        <span>Ship to a different address?</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($ship_diff == 1)
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Ship Address</h3>
                            <div>
                                <p class="row-in-form">
                                    <label for="add">Complete Name</label>
                                    <input id="s_add" type="text" name="add" value="" wire:model="s_complete_name" placeholder="Complete Name">
                                    @error('s_complete_name') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Phone number<span>*</span></label>
                                    <input id="s_phone" type="number" name="phone" value="" wire:model="s_phone_number" placeholder="10 digits format">
                                    @error('s_phone_number') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Address</label>
                                    <input id="s_add" type="text" name="add" value="" wire:model="s_address" placeholder="Shipping Address">
                                    @error('s_address') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Email Address</label>
                                    <input id="s_add" type="text" name="add" value="" wire:model="s_email" placeholder="Shipping Email Address">
                                    @error('s_email') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Country<span>*</span></label>
                                    <input id="s_country" type="text" name="country" value="" wire:model="s_country" placeholder="United States">
                                    @error('s_country') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Postcode / ZIP:</label>
                                    <input id="s_zip-code" type="number" name="zip-code" value="" wire:model="s_post_code" placeholder="Your postal code">
                                    @error('s_post_code') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="city">Town / City<span>*</span></label>
                                    <input id="s_city" type="text" name="city" value="" wire:model="s_city" placeholder="City name">
                                    @error('s_city') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                </p>
                            </div>
                        </div>    
                    </div>
                </div>
                @endif
    
                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Payment Method</h4>
                        {{-- jika  metode pembayaran sama dengan card, maka tampilkan form detail card --}}
                        @if ($pay_method == 'card')
                        {{-- card section --}}
                        <div class="wrap-address-billing">
                            @if (Session::has('stripe_error'))
                            <div class="alert alert-danger">
                                {{ Session::get('stripe_error') }}
                            </div>
                            @endif
                            <p class="row-in-form">
                                <label for="card_no">Card Number : </label>
                                <input id="card_no" type="text" name="card_no" wire:model="card_no" placeholder="card number">
                                @error('card_no') <span class="text-red-500 block">{{ $message }}</span>@enderror
                            </p>
                            <p class="row-in-form">
                                <label for="exp_month">Expiry Month : </label>
                                <input id="exp_month" type="text" name="exp_month" wire:model="exp_month" placeholder="MM">
                                @error('exp_month') <span class="text-red-500 block">{{ $message }}</span>@enderror
                            </p>
                            <p class="row-in-form">
                                <label for="exp_year">Expiry Year : <span>*</span></label>
                                <input id="exp_year" type="text" name="exp_year" wire:model="exp_year" placeholder="YYYY">
                                @error('exp_year') <span class="text-red-500 block">{{ $message }}</span>@enderror
                            </p>
                            <p class="row-in-form">
                                <label for="cvc">CVC : <span>*</span></label>
                                <input id="cvc" type="password" name="cvc" wire:model="cvc" placeholder="CVC">
                                @error('cvc') <span class="text-red-500 block">{{ $message }}</span>@enderror
                            </p>
                        </div>
                        @endif

                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-bank" wire:model="pay_method" value="cod" type="radio">
                                <span>Cash On Delivery</span>
                                <span class="payment-desc">Pay when package is arrived</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-paypal" wire:model="pay_method" value="card" type="radio">
                                <span>Card</span>
                                <span class="payment-desc">You can pay with your credit</span>
                                <span class="payment-desc">card if you don't have a paypal account</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-paypal" wire:model="pay_method" value="paypal" type="radio">
                                <span>Paypal</span>
                                <span class="payment-desc">You can pay with your credit</span>
                                <span class="payment-desc">card if you don't have a paypal account</span>
                            </label>
                            @error('pay_method') <span class="text-red-500 block">{{ $message }}</span>@enderror
                        </div>
                        
                    @if (Session()->has('checkout'))
                    <p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">${{ ($deliveryCharge != null) ? Session('checkout')['total'] + $deliveryCharge : Session('checkout')['total'] }}</span></p>
                    @endif

                    <button type="submit" class="btn btn-medium">Place order now</button>
                </div>
                <div class="summary-item delivery-charge">
                    <h4 class="title-box f-title">Delivery</h4>
                    <p class="row-in-form">
                        <label class="text-[14px]" for="country">Select Expedition</label>
                        <select name="country" id="country" wire:model="expedition" class="w-full h-[43px] border-gray-200 py-[2px] px-[20px] text-[13px]" wire:change="calculateDeliveryCharge">
                            <option value="">Choose Expedition</option>
                            @foreach ($expeditions as $e)
                                <option value="{{ $e->slug }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
                        @error('expedition') <span class="text-red-500 block">{{ $message }}</span>@enderror
                    </p>
                    @if($expedition != null)
                    <div class="mt-5">
                        <span class="text-[14px] block">Selected Expedition</span>
                        <div>
                            <img src="{{ asset("assets/images/expeditions/$expedition.png") }}" alt="Fedex" class="w-[120px] inline-block">
                            <div class="inline-block text-[18px]">
                                <h4>{{ App\Models\Expedition::where('slug', $expedition)->first()->name }}</h4>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- <p class="summary-info"><span class="title">Flat Rate</span></p> --}}
                    <p class="summary-info grand-total"><span>Total Charge</span> <span class="grand-total-price">${{ $deliveryCharge }}</span></p>
                </div>
            </form>
        </div>

        </div><!--end main content area-->
    </div><!--end container-->
</main>
