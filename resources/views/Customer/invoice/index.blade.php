<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Logged as: <span style="color: #33CEFF" >{{ Auth::user()->name }} </span><box-icon name='user-pin' animation='tada' ></box-icon>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="card">
                        {{-- Alert --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success')}}</strong> 
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="card-header">Invoice Details</div>
                            <table class="table table-striped table-bordered">
                                {{-- <table id="detail" class="table table-striped table-bordered"> --}}
                                <thead>
                                    <tr>
                                        {{-- <th>Customer Name</th> --}}
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Item Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        {{-- <th>Added</th> --}}
                                        <th>Actions</th>
                                        {{-- <th>Total Price</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details as $detail)
                                    <tr>
                                        {{-- <td>Donna Snider</td> --}}
                                        <th scope="row">{{ $details->firstItem()+$loop->index }}</th>
                                        <td>{{ $detail->item_name }}</td>
                                        <td>{{ $detail->item_description }}</td>
                                        <td>{{ $detail->item_quantity }}</td>
                                        <td>{{ $detail->unit_price }}</td>
                                        {{-- <td>{{ $total }}</td> --}}
                                        {{-- <td>{{ $detail->created_at->diffForHumans() }}</td> --}}
                                        <td>
                                            <a href="{{ url('edit/item/'.$detail->id)}}" class="btn btn-info"><i class='bx bx-edit'></i></a>
                                            <a href="{{ url('delete/item/'.$detail->id)}}" class="btn btn-danger"><i class='bx bxs-trash'></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer"> <span style="font-style: italic; color:rgb(18, 62, 44);"> #Invoice_Details </span> {{ $details->links()}}</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Enter Invoice Details</div>
                        <div class="card-body">
                            <form action="{{ route('store.item')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                <label for="itemName">Item Name</label>
                                <input type="text" class="form-control"  name="item_name" id=""  placeholder="Enter Item Name" required><br/>

                                <label for="Itemdesc">Item Description</label>
                                <input type="text" class="form-control"  name="item_description" id=""  placeholder="Description" required> <br/>

                                <label for="Itemdesc">Quantity</label>
                                <input type="text" class="form-control"  name="item_quantity" id=""  placeholder="Quantity" required>
                                
                                <label for="Itemdesc">Unit Price</label>
                                <input type="text" class="form-control"  name="unit_price" id=""  placeholder="Unit Price" required>
                                    {{-- @error('item_name')
                                        <span class="text-danger"> {{ $message }}</span>   
                                    @enderror --}}
                               
                                </div>
                                <button type="submit" class="btn btn-primary">Add Details <i class='bx bxs-file-plus bx-tada' style='color:#ffffff'  ></i></button>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    {{-- Trashed --}}
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Deleted Files
                        <i style="float:right;" class='bx bx-trash' ></i>
                    </div>

                        {{-- here --}}

                        <table class="table table-striped table-bordered">
                            {{-- <table id="detail" class="table table-striped table-bordered"> --}}
                            <thead>
                                <tr>
                                    {{-- <th>Customer Name</th> --}}
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    {{-- <th>Added</th> --}}
                                    <th>Actions</th>
                                    {{-- <th>Total Price</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trashed as $detail)
                                <tr>
                                    {{-- <td>Donna Snider</td> --}}
                                    <th scope="row">{{ $details->firstItem()+$loop->index }}</th>
                                    <td>{{ $detail->item_name }}</td>
                                    <td>{{ $detail->item_description }}</td>
                                    <td>{{ $detail->item_quantity }}</td>
                                    <td>{{ $detail->unit_price }}</td>
                                    {{-- <td>{{ $total }}</td> --}}
                                    {{-- <td>{{ $detail->created_at->diffForHumans() }}</td> --}}
                                    <td>
                                        <a href="{{ url('restore/item/'.$detail->id)}}" class="btn btn-info">Restore</a>
                                        <a href="{{ url('wipe/item/'.$detail->id)}}" class="btn btn-danger"><i class='bx bx-recycle bx-tada' style='color:#ffffff' ></i></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer"> <span style="font-style: italic; color:rgb(255, 0, 0);"> #deletedFiles </span>  
                            {{ $trashed->links()}}
                        </div>

                </div>
            </div>
            {{-- right panel --}}
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
        $('#detail').DataTable();
    });
</script>