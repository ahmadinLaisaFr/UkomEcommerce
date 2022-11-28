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
            <h1 class="text-3xl font-semibold inline-block float-left p-3">All sliders</h1>
            <a href="{{ route('admin.add.slider')}}" class="p-3 bg-red-500 text-white text-2xl inline-block float-right rounded-lg hover:text-slate-200 hover:bg-red-700" >Add New Slider</a>
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
                            <th class="text-center items-center">Slide Id</th>
                            <th class="text-center items-center">Slide Image</th>
                            <th class="text-center items-center">Title</th>
                            <th class="text-center items-center">Subtitle</th>
                            <th class="text-center items-center">Price</th>
                            <th class="text-center items-center">Status</th>
                            <th class="text-center items-center">Link</th>
                            <th class="text-center items-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center items-center">
                        @if(isset($sliders) && count($sliders) > 0)
                        @foreach ($sliders as $slider)
                            @php
                            $status = '';
                            if ($slider->status == 1) {
                                $status = 'active';
                            }else {
                                $status = 'inactive';
                            }
                            @endphp
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td><img class="img-responsive mx-auto rounded-2xl" src="{{ asset('assets/images/sliders') }}/{{ $slider->image }}" width="120" alt="{{ $slider->name }}"></td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->subtitle }}</td>
                                <td>{{ $slider->price }}</td>
                                <td>{{ $status }}</td>
                                <td>{{ $slider->link }}</td>
                                <td>
                                    <a href="{{ route('admin.update.slider', ['slider' => $slider->id]) }}" title="Update"><i class="fa fa-pencil text-3xl"></i></a>
                                    <a href="#" wire:click.prevent="delete({{ $slider->id }})" title="Delete"><i class="fa fa-trash text-3xl"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center text-3xl">There is no data . . .</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="">
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


