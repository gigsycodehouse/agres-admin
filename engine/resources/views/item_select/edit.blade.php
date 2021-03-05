@extends('layouts.master')
@section('main_content')
@push('css')

@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product Pilihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">edit Product Pilihan</li>
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
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('item_select.update', $itemselect->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="item_id">Product</label>
                                    <select class="form-control select2" name="item_id" id="item_id">
                                        @foreach ($items as $item)
                                        <option value="{{$item->id}}" @if($item->id == $itemselect->item_id) selected
                                            @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('item_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="text" name="discount_price" class="form-control" id="discount_price"
                                        placeholder="Product discount_price" value="{{$itemselect->discount_price}}">
                                    @error('discount_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label for="end_deal">Discount End Date</label>
                                        <div class="input-group date" id="timepicker" data-target-input="nearest"
                                            style="max-width: 200px">
                                            <input type="text" name="end_deal" class="form-control datetimepicker-input"
                                                data-target="#timepicker" value="{{$itemselect->end_deal}}" />
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
