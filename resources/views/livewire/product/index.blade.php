<div class="container">

    {{-- @if ($formVisible)
       @if (! $formUpdate)
           @livewire('product.create')
        @else
            @livewire('product.update')
       @endif
    @endif --}}
    @if ($formVisible)
        @livewire('product.create')
    @endif
    @if ($formUpdate)
        @livewire('product.update')
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product
                    <button wire:click="formToggle" class="btn btn-sm btn-primary">Create</button>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <select wire:model.live="paginate" name="" id="" class="form-control form-control-sm w-auto">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                            <div class="col">
                                <input wire:model.live="search" type="text" class="form-control form-control-sm" placeholder="Search">
                            </div>
                        </div>
                        <hr>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Title</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->index + $products->firstItem() }}</th>
                                    <td>{{ $product->title }}</td>
                                    <td>Rp{{ number_format($product->price,2,",",".") }}</td>
                                    <td>
                                        <button wire:click="updateProduct({{ $product->id }})" class="btn btn-sm btn-info text-white">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>