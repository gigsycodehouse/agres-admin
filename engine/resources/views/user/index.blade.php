@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                    <a class="btn btn-primary mt-3" href="{{route('user.create')}}">Add New User</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">User</li>
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
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>email</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="updateStatus({{$user->id}})" id="status-{{$user->id}}"
                                                    @if($user->status == 1) checked @endif>
                                                <label class="custom-control-label"
                                                    for="status-{{$user->id}}">@if($user->status == 1) Active @else Not
                                                    Active @endif</label>
                                            </div>
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role->name ?? '-'}}</td>
                                        <td class="text-center">
                                            @if ($user->role_id == 1)
                                            <a class="btn btn-primary" onclick="updateRole({{$user->id}}, 2)"
                                                href="#">Make as sub Admin</a>
                                            @else
                                            <a class="btn btn-primary" onclick="updateRole({{$user->id}}, 1)"
                                                href="#">Make as Admin</a>
                                            @endif
                                            <a class="btn btn-warning" href="{{route('user.edit', $user->id)}}">Edit</a>
                                            <a class="btn btn-danger" onclick="destroy({{$user->id}})">Delete</a>
                                            <form method="POST" id="formdelete-{{$user->id}}"
                                                action="{{route("user.destroy",$user->id)}}">
                                                @csrf
                                                @method("delete")
                                            </form>
                                            <form method="POST" id="formupdate-{{$user->id}}"
                                                action="{{route("user.updaterole",$user->id)}}">
                                                @csrf
                                                <input type="hidden" name="role_id" id="role_id-{{$user->id}}">
                                            </form>
                                            <form method="POST" id="formstatus-{{$user->id}}"
                                                action="{{route("user.updatestatus",$user->id)}}">
                                                @csrf
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
    function updateRole(id, role_id) {
        $('#role_id-'+id).val(role_id)
        $('#formupdate-'+id).submit()
    }
    function updateStatus(id) {
        console.log('masuk')
        $('#formstatus-'+id).submit()
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
