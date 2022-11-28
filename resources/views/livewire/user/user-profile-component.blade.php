<div>
    {{-- @dd($user) --}}
    <div class="">
        <div class="container p-5">
            <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                <h1 class="text-3xl font-semibold inline-block float-left p-3">My Profile</h1>
                <a href="{{ route('user.update.profile', ['profile' => $user->id])}}" class="p-3 bg-red-500 text-white text-2xl inline-block float-right rounded-lg hover:text-slate-200 hover:bg-red-700" >Edit Profile  <i class="fa fa-pencil" aria-hidden="true"></i></a>
            </div>
            {{-- <div class="border-b-2 border-red-500 p-5">
                <h1 class="text-3xl font-bold text-gray-800 inline-block float-left">My Profile</h1>
                <a href="{{ route('admin.add.coupon')}}" class="p-3 bg-red-500 text-white text-2xl inline-block float-right rounded-lg hover:text-slate-200 hover:bg-red-700" >Edit Profile</a>
            </div> --}}
            {{-- personal info --}}
            <div class="p-5">
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
            </div>
            <div class="mx-auto text-center w-full my-16">
                {{-- image --}}
                <div class="h-64 w-64 mx-auto bg-gray-300 rounded-full">
                    @if($user->profile->image != null)
                    <img class="rounded-full object-cover h-64 w-64" src="{{ asset('assets/images/profile_picture') }}/{{ $user->profile->image }}" alt="">
                    @else
                    <img class="rounded-full" src="{{ asset('assets/images/profile_picture/default.jpg') }}" alt="">
                    @endif
                </div>

                <div class="my-10 space-y-10 w-fit mx-auto">
                    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                        <div>
                            <p class="text-left font-bold">Name</p>
                        </div>
                        <div>
                            <p class="text-left">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                        
                        <div>
                            <p class="text-left font-bold">Email</p>
                        </div>
                        <div>
                            <p class="text-left">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                        
                        <div>
                            <p class="text-left font-bold">Phone Number</p>
                        </div>
                        <div>
                            <p class="text-left">{{ ($profile->phone_number) ? $profile->phone_number : 'not set' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                        
                        <div>
                            <p class="text-left font-bold">Address</p>
                        </div>
                        <div>
                            <p class="text-left">{{ ($profile->address) ? $profile->address : 'not set' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                        
                        <div>
                            <p class="text-left font-bold">City</p>
                        </div>
                        <div>
                            <p class="text-left">{{ ($profile->city) ? $profile->city : 'not set' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                        
                        <div>
                            <p class="text-left font-bold">Country</p>
                        </div>
                        <div>
                            <p class="text-left">{{ ($profile->country) ? $profile->country : 'not set' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                        
                        <div>
                            <p class="text-left font-bold">Post Code</p>
                        </div>
                        <div>
                            <p class="text-left">{{ ($profile->post_code) ? $profile->post_code : 'not set' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
