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
                            <li class="item-link"><a href="{{ route('admin.product') }}" class="link">Product</a></li>
                            <li class="item-link"><span>Add Product</span></li>
                        </ul>
                    </div>
                    <div class="md:m-10 overflow-x-auto">
                        <form wire:submit.prevent="save" method="post" class="items-center" enctype="multipart/form-data">
                            @csrf
                            <div class="md:space-y-5">
                                <div class="text-center">
                                    @error('name') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                    @error('slug') <span class="text-red-500 text-center inline">{{ $message }}</span> <br> @enderror
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="categoryId" class="md:text-right">Product Category</label>
                                    <div class="sort-item product-per-page">
                                        <select name="" class="use-chosen h-20 w-full md:w-2/4 text-2xl rounded-xl border-2 border-red-400" wire:model="category_id">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center  md:gap-x-10">
                                    <label for="name" class="md:text-right">Product Name</label>
                                    <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Category Name" type="text" wire:model='name' wire:keyup="generateSlug" id="name">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="slug" class="md:text-right">Product Slug</label>
                                    <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Category Slug" type="text" wire:model='slug' id="slug">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="short_desc" class="md:text-right">Short Description</label>
                                    <textarea class=" md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Short Description" id="short_desc" wire:model="shortDesc"></textarea>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="description" class="md:text-right">Product Description</label>
                                    <textarea class=" md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Description" id="description" wire:model="desc"></textarea>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="reg_price" class="md:text-right">Regular Price</label>
                                    <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Regular Price" type="number" id="regularPrice" wire:model="regular_price">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="sale_price" class="md:text-right">Sale Price</label>
                                    <input class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Sale Price" type="number" id="salePrice" wire:model="sale_price">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label class="md:text-right">SKU</label>
                                    <input class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="SKU" type="text"  id="sku" wire:model="sku">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="sale_price" class="md:text-right">Stock</label>
                                    <select required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" name="stock" id="stock" wire:model="stock">
                                        <option value="Instock">In Stock</option>
                                        <option value="Out Of Stock">Out of Stock</option>
                                    </select>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="featured" class="md:text-right">Featured</label>
                                    <select required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" name="featured" id="featured"  wire:model="featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="quantity" class="md:text-right">Product Image</label>
                                    <input required type="file" id="image" wire:model="image">
                                </div>
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <div class="md:text-right"></div>
                                    @if ($image)
                                    <div class="my-10">
                                        <img class="" src="{{ $image->temporaryUrl() }}"6 alt="" height="250" width="250">
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                                    <label for="quantity" class="md:text-right">Quantity</label>
                                    <input required class="h-20 md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="Quantity" type="number" id="salePrice" wire:model="quantity">
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