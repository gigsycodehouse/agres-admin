@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Address for User <b>{{$member->name}}</b></h1>
                    <a class="btn btn-primary mt-3" href="{{route('member_address.create', $member->id)}}">Add New
                        Address</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Member Address</a></li>
                        <li class="breadcrumb-item active">show</li>
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
                                        <th>Recipient's Name</th>
                                        <th>Recipient's Phone</th>
                                        <th>Full Address</th>
                                        <th>Province</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>Postal Code</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member->address as $address)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$address->name ?? '-'}}</td>
                                        <td>{{$address->phone ?? '-'}}</td>
                                        <td>{{$address->address ?? '-'}}</td>
                                        <td>{{$address->province->nm_propinsi ?? '-'}}</td>
                                        <td>{{$address->city->nm_kota ?? '-'}}</td>
                                        <td>{{$address->district->nm_kecamatan ?? '-'}}</td>
                                        <td>{{$address->postal_code ?? '-'}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning"
                                                href="{{route('member_address.edit', ['member_id' => $member->id, 'address_id'=>$address->id])}}">Edit</a>
                                            <a class="btn btn-danger" onclick="destroy({{$address->id}})">Delete</a>
                                            <form method="POST" id="formdelete-{{$address->id}}"
                                                action="{{route("member_address.destroy",['member_id' => $member->id, 'address_id'=>$address->id])}}">
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
