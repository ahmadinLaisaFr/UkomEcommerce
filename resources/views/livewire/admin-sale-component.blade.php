<div>
    @if (isset($tes))
    @dd($tes)
    @endif
    <div>
        <div>
            <div class="bg-slate-200 container mt-3 md:rounded-t-lg p-5 border-b-2 border-slate-500 items-center">
                <h1 class="text-3xl font-semibold inline-block float-left p-3">Manage Sale</h1>
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
                            <label for="sale_date" class="md:text-right">Sale Date</label>
                            <div class="">
                                <input type="text" name="date" class="h-20 w-full md:w-2/4 text-2xl rounded-xl border-2 border-red-400" placeholder="yyyy/mm/dd h:m:s" wire:model="sale_date" id="sale_date">
                            </div>
                        </div>
                        <div class="flex flex-col md:grid md:grid-cols-2 md:items-center md:gap-x-10">
                            <label for="sale_status" class="md:text-right">Status</label>
                            <select name="sale_date" id="sale_date" wire:model="sale_status" class="h-20 w-full md:w-2/4 text-2xl rounded-xl border-2 border-red-400">
                                <option value="1">Active</option>
                                <option value="0">inactive</option>
                            </select>
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
        $(function(){
            $("#sale_date").datetimepicker({
                format : 'y/m/d H:i:s',
            }).on('change', function(ev){
                let data = $('#sale_date').val()
                @this.set('sale_date', data)
            })
        })
    </script>
@endpush