@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Variant for product <b>{{$item->name}}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Varian Product</a></li>
                        <li class="breadcrumb-item active">add</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('variant.store', $item->id)}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="variant">Variant Name</label>
                                    <input type="text" name="variant" class="form-control" id="variant"
                                        placeholder="Enter variant name" value="{{old('variant')}}">
                                    @error('variant')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="text" name="stock" class="form-control" id="stock"
                                        placeholder="stock variant" value="{{old('stock')}}">
                                    @error('stock')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="price"
                                        placeholder="Enter price" value="{{old('price')}}">
                                    @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="text" name="discount_price" class="form-control" id="discount_price"
                                        placeholder="Enter discount_price" value="{{old('discount_price')}}">
                                    @error('discount_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label for="start_date">Discount Start Date</label>
                                        <div class="input-group date" id="timepicker" data-target-input="nearest"
                                            style="max-width: 200px">
                                            <input type="text" name="start_date"
                                                class="form-control datetimepicker-input" data-target="#timepicker" />
                                            <div class="input-group-append" data-target="#timepicker"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                            </div>
                                        </div>
                                        @error('start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label for="end_deal">Discount End Date</label>
                                        <div class="input-group date" id="timepicker" data-target-input="nearest"
                                            style="max-width: 200px">
                                            <input type="text" name="end_deal" class="form-control datetimepicker-input"
                                                data-target="#timepicker" />
                                            <div class="input-group-append" data-target="#timepicker"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                            </div>
                                        </div>
                                        @error('end_deal')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
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
    $.fn.datetimepicker.Constructor.Default = $.extend({},
        $.fn.datetimepicker.Constructor.Default,
        { icons:{
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-circle-left'
            ,next: 'fas fa-arrow-circle-right',
            today: 'far fa-calendar-check-o',
            clear: 'fas fa-trash',
            close: 'far fa-times' } });
    $('.select2').select2({
      theme: 'bootstrap4',
    })
    $('#timepicker').datetimepicker({
        format: 'DD-MM-YYYY HH:mm'
    })
</script>
@endpush
