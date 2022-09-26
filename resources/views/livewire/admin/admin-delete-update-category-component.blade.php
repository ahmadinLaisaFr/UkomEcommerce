<div>
    <div>
        <div>
            <div>
                <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                    <h1 class="text-3xl font-semibold inline-block float-left p-3">Update Category</h1>
                </div>
                <div class=" container md:rounded-b-lg">
                    <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">
                        <form wire:submit.prevent="update" class="md:space-y-5">
                            @csrf
                            <div class="text-center">
                                @error('name') <span class="text-red-500 text-center inline">{{ $message }}</span> @enderror
                                <br>
                                @error('slug') <span class="text-red-500 text-center inline">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-center">
                                <label for="name" class="mx-5">Category Name</label>
                                <input class="h-20 md:w-1/3 text-2xl rounded-xl border-2 border-red-400" placeholder="Category Name" type="text" wire:model="name" wire:keyup="generateSlug" id="name">
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-center">
                                <input class="h-20 md:w-1/3 text-2xl rounded-xl border-2 md:ml-5 border-red-400" type="hidden" wire:model="slug" id="slug">
                            </div>
                            <div class="md:flex md:justify-center">
                                <button class="p-5 px-7 bg-red-500 text-white rounded-lg mt-3" type="submit" id="btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
