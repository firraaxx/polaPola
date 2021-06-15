@extends('admin.master')

@section('content')

<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Produk</h1>
    
    {{-- button tambah produk --}}
    <a href="{{route('products.create')}}" class="btn btn-primary my-2">Tambah Produk</a>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name Produk</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Katgeori</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->product_name}}</td>
                            <td>Rp. {{number_format($product->price, 0)}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{implode(', ', $product->categories()->get()->pluck('name')->toArray())}}</td>
                            <td>
                                @if ($product->avatar)
                                <img src="{{asset('storage/'.  $product->avatar)}}" width="70px" alt="">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product->id)}}">
                                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                </a>
                                <a href="{{ route('products.show', $product->id)}}">
                                    <button type="button" class="btn btn-info btn-sm">Detail</button>
                                </a>
                                
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                                    Hapus
                                </button>
                                
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form class="float-left mr-1" action="/products/{{$product->id}}" method="POST">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



@endsection