@extends('layouts.master')
@section('main_content')
@push('css')
<style>
    .width-200 {
        min-width: 200px;
    }

    .width-100 {
        min-width: 100px;
    }
</style>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                    <a class="btn btn-primary mt-3" href="{{route('item.create')}}">Add New Product</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">

                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>End Discount Date</th>
                                        <th>Stock</th>
                                        <th>Spesification</th>
                                        <th>Sub Category</th>
                                        <th>Category</th>
                                        <th>Total Review</th>
                                        <th>Short Description</th>
                                        <th>Long Description</th>
                                        <th>Image</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="width-100"><a href="{{route('item.show', $item->id)}}">{{$item->name}}</a></td>
                                        <td class="width-100">{{$item->price}}</td>
                                        <td class="width-100">{{$item->discount_price}}</td>
                                        <td class="width-100">{{$item->end_deal}}</td>
                                        <td class="width-100"><a href="#" data-toggle="modal" class="modal_stock"
                                                data-item_id="{{$item->id}}" data-current_stock="{{$item->stock}}"
                                                data-target="#update_stock">{{$item->stock}}</a></td>
                                        <td class="width-200">
                                            <ul>
                                                @foreach (json_decode($item->spesification) as $k => $v)
                                                <li>{{$k}} : {{$v}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="width-100">{{$item->sub_category->name}}</td>
                                        <td class="width-100">{{$item->category->name}}</td>
                                        <td class="width-100"><a href="{{route('item.review', $item->id)}}">{{$item->review_count}}</a></td>
                                        <td class="width-100">{{$item->description}}</td>
                                        <td class="width-200">{{$item->long_desc->long_description ?? '-'}}</td>
                                        <td class="width-200">
                                            <div id="imagecarousel">
                                                @foreach ($item->image as $image)
                                                <img src="{{asset($image->img_path.'thumbnail-'.$image->img_name)}}" alt="">
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="text-center width-200">
                                            <a class="btn btn-warning" href="{{route('item.edit', $item->id)}}">Edit</a>
                                            <a class="btn btn-danger" onclick="destroy({{$item->id}})">Delete</a>
                                            <form method="POST" id="formdelete-{{$item->id}}"
                                                action="{{route("item.destroy",$item->id)}}">
                                                @csrf
                                                @method("delete")
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="update_stock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="form_update_stock">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" name="stock" class="form-control" id="stock" placeholder="Product stock"
                            value="">
                        @error('stock')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    // $(document).ready(function(){
    //   $('#imagecarousel').slick({
    //     dots: false,
    //     autoplay: true,
    //     autoplaySpeed: 2000,
    //   });
    // });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $( document ).ready(function() {
        $('.table').DataTable({
            "autoWidth": false,
            "scrollX": true
        });
    });
    function destroy(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value == true) {
                $("#formdelete-" + id).submit();
            }
        })
    }
    $('.modal_stock').click(function(){
        var item_id = $(this).data('item_id')
        var stock = $(this).data('current_stock')
        var url = `{{url('/')}}/item/`+item_id+`/update_stock`
        $('#form_update_stock').attr('action','').attr('action', url)
        $('#stock').val('').val(stock)
    })
</script>

@if ($message = Session::get('success'))
<script>
    Toast.fire({
        icon: 'success',
        title: '  {{ $message }}'
    })
</script>
@endif
@endpush
