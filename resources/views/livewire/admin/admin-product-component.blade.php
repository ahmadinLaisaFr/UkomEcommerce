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
            <h1 class="text-3xl font-semibold inline-block float-left p-3">All Products</h1>
            <a href="{{ route('admin.add.category')}}" class="p-3 bg-red-500 text-white text-2xl inline-block float-right rounded-lg hover:text-slate-200 hover:bg-red-700" >Add New</a>
        </div>
        <div class="bg-slate-100 container md:rounded-b-lg">
            <div class="mt-5 md:m-10 md:mt-4 overflow-x-auto">
                
                @if(session()->has('success'))
                <div class="bg-green-500 p-5 rounded-lg">
                    <p class="text-3xl text-white">{{ session()->get('success') }}</p>
                </div>
                @endif
                @if(session()->has('failed'))
                <div class="bg-red-500 p-5 rounded-lg">
                    <p class="text-3xl text-white">{{ session()->get('failed') }}</p>
                </div>
                @endif

                <table class="table text-2xl mt-10">
                    <thead class="bg-gray-500 text-white">
                        <tr>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Slug</th>
                            <th>Short Desc</th>
                            <th>Description</th>
                            <th>Regular Price</th>
                            <th>Stock Status</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @php
                            $stockStatus = '';
                            if ($product->quantity > 0) {
                                $stockStatus = 'Instock';
                            }else {
                                $stockStatus = 'Out Of Stock';
                            }
                            @endphp
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>{{ substr($product->short_desc, -60) }}</td>
                                <td>{{ substr($product->desc, -50) }}</td>
                                <td>{{ $product->regular_price }}</td>
                                <td>{{ $stockStatus }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td><img src="{{ asset('assets/images/products') }}/{{ $product->image }}" width="65" height="65" alt="{{ $product->name }}"></td>
                                <td>
                                    <a href="{{ route('admin.update.category', ['category' => $product->slug]) }}" title="Update"><i class="fa fa-pencil text-3xl"></i></a>
                                    <a href="#" wire:click.prevent="delete('{{ $product->slug }}')" title="Delete"><i class="fa fa-trash text-3xl"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

