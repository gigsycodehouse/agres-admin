@extends('layouts.master')
@section('main_content')
@push('css')
{{-- <link rel="stylesheet" href="{{asset('assets/dropzone/basic.min.css')}}"> --}}
<link rel="stylesheet" href="{{asset('assets/dropzone/dropzone.min.css')}}">
<style>
    .spesification {
        padding: 10px 15px;
        border-radius: 15px;
    }
</style>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
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
                        <form role="form" method="POST" action="{{route('item.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Product Name" value="{{old('name')}}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="text" name="price" class="form-control" id="price"
                                        placeholder="Product price" value="{{old('price')}}">
                                    @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Product stock</label>
                                    <input type="text" name="stock" class="form-control" id="stock"
                                        placeholder="Product stock" value="{{old('stock')}}">
                                    @error('stock')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Short Description</label>
                                    <input type="text" name="description" class="form-control" id="description"
                                        placeholder="Product description" value="{{old('description')}}">
                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control select2" name="category_id" id="category_id">
                                        <option disabled selected>select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id">Sub Category</label>
                                    <select class="form-control select2" name="sub_category_id" id="sub_category_id">
                                    </select>
                                    @error('sub_category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="spesification">Spesification</label>
                                    <div class="row spesification border" id="spesification"></div>
                                    @error('spesification')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="dropzone" id="myDropzone"></div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="submit-all" class="btn btn-primary">Submit</button>
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
<script src="{{asset('assets/dropzone/dropzone.min.js')}}"></script>
{{-- <script src="{{asset('assets/dropzone/dropzone-amd-module.min.js')}}"></script> --}}
<script>
    Dropzone.options.myDropzone= {
        url: 'upload.php',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 5,
        maxFilesize: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            document.getElementById("submit-all").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                dzClosure.processQueue();
            });

            //send all the form data along with the files:
            this.on("sendingmultiple", function(data, xhr, formData) {
                formData.append("firstname", jQuery("#firstname").val());
                formData.append("lastname", jQuery("#lastname").val());
            });

            // $.getJSON('{{url('/')}}/item/get/1/image', function(data) {
            //     $.each(data, function(index, val) {
            //         var file = `{{url('/')}}/`+val.file
            //         var mockFile = {
            //             accepted: true            // required if using 'MaxFiles' option
            //         };
            //         dzClosure.files.push(mockFile);    // add to files array
            //         dzClosure.emit("addedfile", mockFile);
            //         dzClosure.emit("thumbnail", mockFile, file);
            //         dzClosure.emit("complete", mockFile);
            //     });
            // });
        }
    }
</script>
<script>
    $('.select2').select2({
      theme: 'bootstrap4',
    })

    $('#category_id').change(function(){
        var category_id = $('#category_id').find(":selected").val();
        $.ajax({
            url: `{{url('/')}}/get/`+category_id+`/sub_category`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'get',
            success: function (data){
                $('#sub_category_id').empty()
                $.each(data, function(index, val){
                    $('#sub_category_id').append(`<option value="`+val.id+`">`+val.name+`</option>`)
                })
            }
        })

        $.ajax({
            url: `{{url('/')}}/get/`+category_id+`/spesification`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'get',
            success: function (data){
                $('#spesification').empty()
                $.each(JSON.parse(data.spesification), function(index, val){
                    $('#spesification').append(`
                    <div class="col-12 d-inline">
                    <label>`+val+`</label>
                    <input class="form-control" type="text" name="spesification[`+val+`]">
                    </div>
                    `)
                })
            }
        })
    })
</script>
@endpush
