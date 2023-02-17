<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ITEMS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Item</div>
                            <div class="card-body">
                                <form action="{{ url('update/item/'.$items->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                    <label for="itemName">Item Name</label>
                                    <input type="text" class="form-control"  name="item_name" id=""  placeholder="Enter Item Name" required value="{{ $items->item_name }}"><br/>
    
                                    <label for="Itemdesc">Item Description</label>
                                    <input type="text" class="form-control"  name="item_description" id=""  placeholder="Description" required value="{{ $items->item_description }}"> <br/>
    
                                    <label for="Itemdesc">Quantity</label>
                                    <input type="text" class="form-control"  name="item_quantity" id=""  placeholder="Quantity" required value="{{ $items->item_quantity }}">
                                    
                                    <label for="Itemdesc">Unit Price</label>
                                    <input type="text" class="form-control"  name="unit_price" id=""  placeholder="Unit Price" required value="{{ $items->unit_price }}">
                                        {{-- @error('item_name')
                                            <span class="text-danger"> {{ $message }}</span>   
                                        @enderror --}}
                                   
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class='bx bxs-save bx-tada' style='color:#ffffff' ></i></button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
