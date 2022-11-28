<div>
    <div>
        <div>
            <div>
                <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                    <h1 class="text-3xl font-semibold inline-block float-left p-3">Edit Profile</h1>
                    <a href="{{ route('profile.show')}}" class="p-3 bg-red-500 text-white text-2xl inline-block float-right rounded-lg hover:text-slate-200 hover:bg-red-700" >My Profile</a>
                </div>
                <div class=" container md:rounded-b-lg">
                    <div class="wrap-breadcrumb md:ml-7">
                        <ul>
                            <li class="item-link"><a href="{{ route('profile.show') }}" class="link">profile</a></li>
                            <li class="item-link"><span>Edit Profile</span></li>
                        </ul>
                    </div>
                    <div class="md:m-10 overflow-x-auto">
                        <form wire:submit.prevent="save" method="post" class="items-center" enctype="multipart/form-data">
                            @csrf
                            <div class="md:space-y-5">
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="name" class="md:text-right">Complete Name</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Your name" type="text" wire:model='complete_name' id="name">
                                        @error('complete_name') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="email" class="md:text-right">Email</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Your email" type="email" wire:model='email' id="email">
                                        @error('email') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="pnumber" class="md:text-right">Phone Number</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Phone Number" type="number" wire:model='phone_number' id="pnumber">
                                        @error('phone_number') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="address" class="md:text-right">Address</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Your Address" type="text" wire:model='address' id="address">
                                        @error('address') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="city" class="md:text-right">City</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Your City" type="text" wire:model='city' id="city">
                                        @error('city') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="country" class="md:text-right">Country</label>
                                    <div>
                                        <select class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" wire:model="country" name="country" id="country">
                                            <option value="">Select Country</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="North Vietnam">North Vietnam</option>
                                        </select>
                                        @error('country') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="pcode" class="md:text-right">Post Code</label>
                                    <div>
                                        <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Your Postal Code" type="number" wire:model='post_code' id="pcode">
                                        @error('post_code') <span class="text-red-500 block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="image" class="md:text-right">Profile Picture</label>
                                    <input type="file" id="image" wire:model="new_image">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <div class="md:text-right"></div>
                                    @if (isset($new_image) && $new_image != null)
                                    <div class="my-10">
                                        <img class="" src="{{ $new_image->temporaryUrl() }}" alt="" height="250" width="250">
                                    </div>
                                    @elseif($image != null)
                                    <div class="my-10">
                                        <img class="" src="{{ asset('assets/images/profile_picture') }}/{{ $image }}" alt="" height="250" width="250">
                                    </div>
                                    @endif
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
