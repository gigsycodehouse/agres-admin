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
                    <h1>Review Product {{$item->name}}</h1>
                    {{-- <a class="btn btn-primary mt-3" href="{{route('item.create')}}">Add New Product</a> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Review</li>
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
                                        <th>Rating</th>
                                        <th>Review</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->review as $review)
                                    <tr>
                                        <td style="max-width: 100px !important">{{$loop->iteration}}</td>
                                        <td>{{$review->rating}}</a></td>
                                        <td>{{$review->review}}</td>
                                        {{-- <td class="text-center">
                                            <a class="btn btn-warning" href="{{route('item.edit', $item->id)}}">Edit</a>
                                        <a class="btn btn-danger" onclick="destroy({{$item->id}})">Delete</a>
                                        <form method="POST" id="formdelete-{{$item->id}}"
                                            action="{{route("item.destroy",$item->id)}}">
                                            @csrf
                                            @method("delete")
                                        </form>
                                        </td> --}}
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
