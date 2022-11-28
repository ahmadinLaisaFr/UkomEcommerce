<div>
    <div>
        <div>
            <div>
                <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                    <h1 class="text-3xl font-semibold inline-block float-left p-3">Insert New Slider</h1>
                </div>
                <div class=" container md:rounded-b-lg">
                    <div class="wrap-breadcrumb md:ml-7">
                        <ul>
                            <li class="item-link"><a href="{{ route('admin.sliders') }}" class="link">Manage Slider</a></li>
                            <li class="item-link"><span>Update Slider</span></li>
                        </ul>
                    </div>
                    <div class="md:m-10 overflow-x-auto">
                        <form wire:submit.prevent="save" method="post" class="items-center" enctype="multipart/form-data">
                            @csrf
                            <div class="md:space-y-5">
                                <div class="text-center">
                                    @error('title') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                    @error('subtitle') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                    @error('price') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                    @error('status') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                    @error('link') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                    @error('image') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="title" class="md:text-right">Slide Title</label>
                                    <input class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Slide Title" type="text" wire:model='title' id="title">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="subtitle" class="md:text-right">Slide Subtitle</label>
                                    <input class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Slide Subtitle" type="text" wire:model='subtitle' id="subtitle">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="price" class="md:text-right">Price</label>
                                    <input class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Price" type="number" id="price" wire:model="price">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="link" class="md:text-right">Slide Link</label>
                                    <input class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Slide Link" type="text" id="link" wire:model="link">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="status" class="md:text-right">Slider Status</label>
                                    <select class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" name="status" id="status"  wire:model="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="quantity" class="md:text-right">Slider Image</label>
                                    <input type="file" id="image" wire:model="newImage">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <div class="md:text-right"></div>
                                    @if (isset($newImage) && $newImage != null)
                                    <div class="my-10">
                                        <img class="rounded-3xl" src="{{ $newImage->temporaryUrl() }}" alt="" height="250" width="250">
                                    </div>
                                    @else
                                    <div class="my-10">
                                        <img class="rounded-3xl" src="{{ asset('assets/images/sliders') }}/{{ $image }}" alt="" height="250" width="250">
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
