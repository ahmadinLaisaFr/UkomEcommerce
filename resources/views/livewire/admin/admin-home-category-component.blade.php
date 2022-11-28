<div>
    <div>
        <div>
            <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                <h1 class="text-3xl font-semibold inline-block float-left p-3">Manage Home Product</h1>
            </div>
            <div class=" container md:rounded-b-lg">
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
                    <form wire:submit.prevent="update" class="md:space-y-5">
                        @csrf
                        <div class="text-center">
                        </div>
                        <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                            <label for="categoryId" class="md:text-right">Home Categories</label>
                            <div class="sort-item product-per-page" wire:ignore>
                                <select name="categories[]" class="select-categories h-20 w-full md:w-2/4 text-2xl rounded-xl border-2 border-red-400" wire:model="selected_categories" multiple="multiple">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                            <label for="product-count" class="md:text-right">Number Of Product</label>
                            <input class="h-20 md:w-2/4 text-2xl rounded-lg border-1 border-slate-400" type="number" wire:model="product_count" id="product-count">
                        </div>
                        <div class="md:flex md:justify-center">
                            <button class="p-5 px-7 bg-red-500 hover:bg-red-800 text-white rounded-lg mt-3" type="submit" id="btn-submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function () {
            $('.select-categories').select2();
            $(document).on('load', function () {
                $('.select-categories').select2();
            });
            $('.select-categories').on('change', function (e) { 
                let data = $('.select-categories').select2("val");
                @this.set('selected_categories', data);
            });
        });
    </script>
@endpush

