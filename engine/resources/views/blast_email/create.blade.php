@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Send New Blast</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">blast email</a></li>
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
                        <form role="form" method="POST" action="{{route('blast_email.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea type="text" name="message" class="form-control"
                                        id="message">{{old('name')}}</textarea>
                                    @error('message')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="member_email">Member Email</label>
                                    <p>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="pickallmember" name="chooseall">
                                            <label for="pickallmember">
                                                Choose All Member
                                            </label>
                                        </div>
                                    </p>
                                    <select class="form-control select2" multiple name="member_email[]" id="member_email">
                                        @foreach ($members as $member)
                                        <option value="{{$member->email}}">{{$member->name}} - {{$member->email}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('member_email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
      theme: 'bootstrap4'
    })
    $('#pickallmember').change(function(){
        if ($('#pickallmember').is(":checked")){
            $("select").val('').change();
            $('#member_email').attr('disabled','disabled')
        } else {
            $('#member_email').removeAttr('disabled')
        }
    })
</script>
@endpush
