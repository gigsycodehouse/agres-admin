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
                    <h1>Product {{$item->name}}</h1>
                    <a class="btn btn-primary mt-3" href="{{route('item.edit', $item->id)}}">Edit Product</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">detail</li>
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
                            <div class="row">
                                <div class="col-2">
                                    Name:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->name}}</p>
                                </div>
                                <div class="col-2">
                                    Price:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->price}}</p>
                                </div>
                                <div class="col-2">
                                    Discount Price:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->discount_price}}</p>
                                </div>
                                <div class="col-2">
                                    Discount End Date:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->end_deal}}</p>
                                </div>
                                <div class="col-2">
                                    Stock:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->stock}}</p>
                                </div>
                                <div class="col-2">
                                    Short Descroption:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->description}}</p>
                                </div>
                                <div class="col-2">
                                    Spesification:
                                </div>
                                <div class="col-10">
                                    <p>
                                        <ul>
                                            @foreach (json_decode($item->spesification) as $k => $v)
                                            <li>{{$k}} : {{$v}}</li>
                                            @endforeach
                                        </ul>
                                    </p>
                                </div>
                                <div class="col-2">
                                    Category:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->category->name}}</p>
                                </div>
                                <div class="col-2">
                                    Sub Category:
                                </div>
                                <div class="col-10">
                                    <p>{{$item->sub_category->name}}</p>
                                </div>
                            </div>
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
