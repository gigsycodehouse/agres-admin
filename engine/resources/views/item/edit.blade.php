@extends('layouts.master')
@section('main_content')
@push('css')
<link rel="stylesheet" href="{{asset('assets/dropzone/basic.min.css')}}">
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
                    <h1>Edit {{$item->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">edit</li>
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
                        <form role="form" method="POST" action="{{route('item.update', $item->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Sub Category Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter name" value="{{$item->name}}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="text" name="price" class="form-control" id="price"
                                        placeholder="Product price" value="{{$item->price}}">
                                    @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Product stock</label>
                                    <input type="text" name="stock" class="form-control" id="stock"
                                        placeholder="Product stock" value="{{$item->stock}}">
                                    @error('stock')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Short Description</label>
                                    <input type="text" name="description" class="form-control" id="description"
                                        placeholder="Product description" value="{{$item->description}}}">
                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control select2" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if ($category->id == $item->category_id)
                                            selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id">Sub Category</label>
                                    <select class="form-control select2" name="sub_category_id" id="sub_category_id">
                                        @foreach ($sub_categories as $sub_category)
                                        <option value="{{$sub_category->id}}" @if ($sub_category->id ==
                                            $item->sub_category_id)
                                            selected @endif>{{$sub_category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="spesification">Spesification</label>
                                    <div class="row spesification border" id="spesification">
                                        @foreach (json_decode($item->spesification) as $k => $v)
                                        <div class="col-12 d-inline">
                                            <label>{{$k}}</label>
                                            <input class="form-control" type="text" name="spesification[{{$k}}]"
                                                value="{{$v}}">
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('spesification')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="spesification">Image</label>

                                    <input type="hidden" value="{{count($item->image)}}" id="countimage">
                                </div>
                                <div id="images">
                                    @foreach ($item->image as $image)
                                    <div id="imagebox-{{$loop->iteration}}">
                                        <div class="form-inline">
                                            <div class="border rounded mr-2" style="height: 200px; width:200px">
                                                <img id="imgReview-{{$loop->iteration}}"
                                                    src="{{asset($image->img_path.$image->img_name)}}"
                                                    style="width: inherit; height: inherit">
                                            </div>
                                            <div class="border rounded" style="height: 100px; width:100px">
                                                <img id="imgReviewThumb-{{$loop->iteration}}"
                                                    src="{{asset($image->img_path.'thumbnail-'.$image->img_name)}}"
                                                    style="width: inherit; height: inherit">
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="file" name="image[]" class="form-control inputImage"
                                                        data-box_id="{{$loop->iteration}}">
                                                </div>
                                                <div class="col-2">
                                                    <a href="#" data-image_id="{{$image->id}}"
                                                        class="btn btn-danger serverDeleteImage">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    @endforeach
                                </div>
                                <p>
                                    <a href="#" id="addImage" class="btn btn-primary">Add Image</a>
                                </p>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" id="submit-all" class="btn btn-primary float-right">Submit</button>
                                </div>
                        </form>
                        <form method="POST" id="formdelete" action="">
                            @csrf
                            @method("delete")
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
    // var update_url = `{{route('item.update', $item->id)}}`
    // var get_image_url = `{{route('item.get_upload_image', $item->id)}}`
    // Dropzone.options.myDropzone= {
    //     method: "put",
    //     url: update_url,
    //     paramName: "image",
    //     autoProcessQueue: false,
    //     uploadMultiple: true,
    //     parallelUploads: 5,
    //     // maxFiles: 5,
    //     // maxFilesize: 1,
    //     acceptedFiles: 'image/*',
    //     addRemoveLinks: true,
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     init: function() {
    //         dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

    //         // for Dropzone to process the queue (instead of default form behavior):
    //         document.getElementById("submit-all").addEventListener("click", function(e) {
    //             // Make sure that the form isn't actually being sent.
    //             e.preventDefault();
    //             e.stopPropagation();
    //             dzClosure.processQueue();
    //         });

    //         // send all the form data along with the files:
    //         this.on("sendingmultiple", function(data, xhr, formData) {
    //             formData.append("name", $("#name").val());
    //             formData.append("price", $("#price").val());
    //             formData.append("stock", $("#stock").val());
    //             formData.append("description", $("#description").val());
    //             formData.append("category_id", $("#category_id").val());
    //             formData.append("sub_category_id", $("#sub_category_id").val());
    //             $('.spec').each(function(){
    //                 formData.append($(this).attr('name'), $(this).val());
    //             });
    //         });

    //         $.getJSON(get_image_url, function(data) {
    //             $.each(data, function(index, val) {
    //                 var file = `{{url('/')}}/`+val.file
    //                 var mockFile = {
    //                     accepted: true            // required if using 'MaxFiles' option
    //                 };
    //                 dzClosure.files.push(mockFile);    // add to files array
    //                 dzClosure.emit("addedfile", mockFile);
    //                 dzClosure.emit("thumbnail", mockFile, file);
    //                 dzClosure.emit("complete", mockFile);
    //             });
    //         });
    //     }
    // }
</script>
<script>
    $('.select2').select2({
      theme: 'bootstrap4',
      tags: true
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
                var selected = ''
                $.each(data, function(index, val){
                    if (val.id == '{{$item->sub_category_id}}'){
                        selected = 'selected'
                    }
                    $('#sub_category_id').append(`<option value="`+val.id+`" `+selected+`>`+val.name+`</option>`)
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
                    <input class="form-control spec" type="text" name="spesification[`+val+`]">
                    </div>
                    `)
                })
            }
        })
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader()
            console.log(input)
            var id = $(input).data('box_id')
            console.log(id)

            reader.onload = function(e) {
                $('#imgReview-'+id).attr('src', e.target.result).css('padding', '10px')
                $('#imgReviewThumb-'+id).attr('src', e.target.result).css('padding', '10px')
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#images").on("change", ".inputImage", function() {
        readURL(this);
    });

    var i = $('#countimage').val()
    i++
    console.log(i)
    $('#addImage').click(function(e){
        e.preventDefault()
        $('#images').append(
        `
        <div id="imagebox-`+i+`">
        <div class="form-inline">
            <div class="border rounded mr-2" style="height: 200px; width:200px" >
                <img src="" alt="" id="imgReview-`+i+`" style="width: inherit; height: inherit">
            </div>
            <div class="border rounded" style="height: 100px; width:100px">
                <img src="" alt="" id="imgReviewThumb-`+i+`" style="width: inherit; height: inherit">
            </div>
        </div>
        <div class="form-group mt-2">
            <div class="row">
                <div class="col-10">
                    <input type="file" name="image[]" class="form-control inputImage" data-box_id="`+i+`">
                </div>
                <div class="col-2">
                    <a href="#" data-box_id="`+i+`" class="btn btn-danger deleteImage">Delete</a>
                </div>
            </div>
        </div>
        <hr>
        `)
        i++
    })

    $("#images").on("click", ".deleteImage", function(e) {
        e.preventDefault()

        var box_id = $(this).data('box_id')
        $('#imagebox-'+box_id).remove()
    })

    $(".serverDeleteImage").click(function(e) {
        e.preventDefault()
        var image_id = $(this).data('image_id')
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
                action = `{{url('/')}}/item_image/`+image_id
                $("#formdelete").attr('action', action).submit();
            }
        })
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
