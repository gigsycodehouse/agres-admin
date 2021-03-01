@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blast Email</h1>
                    <a class="btn btn-primary mt-3" href="{{route('blast_email.create')}}">Send New Blast</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Blast Email</li>
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
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Message</th>
                                        <th>Total Recipients</th>
                                        <th>Start Send At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blasts as $blast)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><pre>{{$blast->message}}</pre></td>
                                        <td><a href="{{route('blast_email.show', $blast->id)}}">{{$blast->total_recipients}}</a></td>
                                        <td>{{$blast->created_at}}</td>
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
            "responsive": true,
            "autoWidth": false,
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
