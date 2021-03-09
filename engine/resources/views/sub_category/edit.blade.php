@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit {{$sub_category->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Sub Category</a></li>
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
                        <form role="form" method="POST" action="{{route('sub_category.update', $sub_category->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Sub Category Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter name" value="{{$sub_category->name}}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control select2" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if ($category->id ==
                                            $sub_category->category_id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <div>
                                        <img src="{{asset($sub_category->icon)}}" alt="" id="imgreview"
                                            style="max-width: 200px">
                                    </div>
                                    <input type="file" name="icon" class="form-control" id="icon"
                                        value="{{old('name')}}">
                                    @error('icon')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <div>
                                        <img src="{{asset($sub_category->banner)}}" alt="" id="imgreviewbanner"
                                            style="max-width: 200px">
                                    </div>
                                    <input type="file" name="banner" class="form-control" id="banner"
                                        value="{{old('name')}}">
                                    @error('banner')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
    $('.select2').select2({
      theme: 'bootstrap4',
      tags: true
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgreview').attr('src', e.target.result);
                $('#imgreview').css('padding', '15px');
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#icon").change(function() {
        readURL(this);
    });

    function readURLBanner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgreviewbanner').attr('src', e.target.result);
                $('#imgreviewbanner').css('padding', '15px');
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#banner").change(function() {
        readURLBanner(this);
    });
</script>
@endpush
