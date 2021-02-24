@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit {{$member->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
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
                        <form role="form" method="POST"
                            action="{{route('member_address.update', ['member_id'=>$member->id,'address_id'=>$address->id])}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Recipient's Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter nama penerima" value="{{$address->name}}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Recipient's Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Enter nama penerima" value="{{$address->phone}}">
                                    @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Full Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        placeholder="Enter address" value="{{$address->address}}">
                                    @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="province_id">Province</label>
                                    <select class="form-control select2" name="province_id" id="province_id">
                                        <option value="1">1</option>
                                    </select>
                                    @error('province_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <input type="city_id" name="city_id" class="form-control" id="city_id"
                                        placeholder="city_id" value="{{old('city_id')}}">
                                    @error('city_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <input type="district_id" name="district_id" class="form-control" id="district_id"
                                        placeholder="district_id">
                                    @error('district_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="postal_code" name="postal_code" class="form-control" id="postal_code"
                                        placeholder="postal_code">
                                    @error('postal_code')
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
</script>
@endpush
