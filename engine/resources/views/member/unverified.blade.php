@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Members</h1>
                    <a class="btn btn-primary mt-3" href="{{route('member.create')}}">Add New Member</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Member</li>
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
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$member->name}}</td>
                                        <td>{{$member->phone}}</td>
                                        <td>{{$member->email}}</td>
                                        <td class="text-center">
                                            <a class="nav-link dropdown-toggle btn btn-primary" style="display: unset" data-toggle="dropdown" href="#">
                                                Menu <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" tabindex="-1"
                                                    href="{{route('member.edit', $member->id)}}">Edit</a>
                                                <a class="dropdown-item" tabindex="-1" href="#"
                                                    onclick="destroy({{$member->id}})">Delete</a>
                                                <form method="POST" action="{{route("member.verify",$member->id)}}">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Verify</button>
                                                </form>
                                            </div>
                                            {{-- <form method="POST" action="{{route("member.verify",$member->id)}}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Verify</button>
                                            </form>
                                            <a class="btn btn-warning"
                                                href="{{route('member.edit', $member->id)}}">Edit</a>
                                            <a class="btn btn-danger" onclick="destroy({{$member->id}})">Delete</a> --}}
                                            <form method="POST" id="formdelete-{{$member->id}}"
                                                action="{{route("member.destroy",$member->id)}}">
                                                @csrf
                                                @method("delete")
                                            </form>
                                        </td>
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
