@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Catalog Brand Icon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Cms</a></li>
                        <li class="breadcrumb-item active">add Catalog Brand Icon</li>
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
                        <form role="form" method="POST" action="{{route('catalog_brand.store')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control select2" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="icon">Brand Icon</label>
                                    <div>
                                        <img src="" alt="" id="imgreview" style="max-width: 200px">
                                    </div>
                                    <input type="file" name="icon" class="form-control" id="icon"
                                        value="{{old('name')}}">
                                    @error('icon')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="url">Url</label>
                                    <input type="text" name="url" class="form-control" id="url" placeholder="url"
                                        value="{{old('url')}}">
                                    @error('url')
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

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgreview1').attr('src', e.target.result);
                $('#imgreview1').css('padding', '15px');
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#image_responsive").change(function() {
        readURL1(this);
    });
</script>
@endpush
