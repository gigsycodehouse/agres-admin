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
                        <div class="card-body">
                            <form action="{{route('item.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="text" id="firstname" name="firstname" />
                                <input type="text" id="lastname" name="lastname" />
                                <div class="dropzone" id="myDropzone"></div>
                                <button type="submit" id="submit-all"> upload </button>
                            </form>
                        </div>
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
        }
    }
</script>
@endpush
