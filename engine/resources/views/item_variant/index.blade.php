@extends('layouts.master')
@section('main_content')
@push('css')
<style>
</style>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Varian Product {{$item->name}}</h1>
                    <a class="btn btn-primary mt-3" href="{{route('variant.create', $item->id)}}">Add New Variant</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Varian</li>
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
                                        <th style="max-width: 100px !important">No</th>
                                        <th>Variant</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->variants as $variant)
                                    <tr>
                                        <td style="max-width: 100px !important">{{$loop->iteration}}</td>
                                        <td>{{$variant->variant}}</a></td>
                                        <td>{{$variant->stock}}</td>
                                        <td>{{$variant->price}}</td>
                                        {{-- <td><a href="#" data-toggle="modal" class="modal_stock"
                                                data-variant_id="{{$variant->id}}"
                                        data-current_stock="{{$variant->stock}}"
                                        data-target="#update_stock">{{$variant->stock}}</a></td> --}}
                                        <td class="text-center">
                                            <a class="nav-link dropdown-toggle btn btn-primary" style="display: unset" data-toggle="dropdown"
                                                href="#">Menu<span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" tabindex="-1"
                                                    href="{{route('variant.edit', ['item_id' => $item->id, 'variant_id'=>$variant->id])}}">Edit</a>
                                                <a class="dropdown-item" tabindex="-1" href="#"
                                                    onclick="destroy({{$variant->id}})">Delete</a>
                                            </div>
                                            <form method="POST" id="formdelete-{{$variant->id}}"
                                                action="{{route("variant.destroy",['item_id' => $item->id, 'variant_id'=>$variant->id])}}">
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
<script>
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
        var variant_id = $(this).data('variant_id')
        var stock = $(this).data('current_stock')
        var url = `{{url('/')}}/item/`+variant_id+`/update_stock`
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
