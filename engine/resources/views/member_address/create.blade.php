@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Address for member <b>{{$member->name}}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Member Address</a></li>
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
                        <form role="form" method="POST" action="{{route('member_address.store', $member->id)}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Recipient's Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter nama penerima" value="{{old('name')}}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Recipient's Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Enter nama penerima" value="{{old('phone')}}">
                                    @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Full Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        placeholder="Enter address" value="{{old('address')}}">
                                    @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="province_id">Province</label>
                                    <select class="form-control select2" name="province_id" id="province_id">
                                        <option disabled selected>select province</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->nm_propinsi}}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" name="province_id" class="form-control" id="province_id" placeholder="province_id" value="{{old('province_id')}}">
                                    --}}
                                    @error('province_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="city_id">City</label>
                                    <select class="form-control select2" name="city_id" id="city_id">
                                    </select>
                                    @error('city_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select class="form-control select2" name="district_id" id="district_id">
                                    </select>
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
      theme: 'bootstrap4'
    })

    $('#province_id').change(function(){
        var province_id = $('#province_id').find(":selected").val();
        $.ajax({
            url: `{{url('/')}}/get/`+province_id+`/cities`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'get',
            success: function (data){
                $('#city_id').empty()
                $.each(data, function(index, val){
                    $('#city_id').append(`<option value="`+val.id+`">`+val.type+` `+val.nm_kota+`</option>`)
                })
                $("#city_id").change();
            }
        })
    })

    $('#city_id').change(function(){
        var city_id = $('#city_id').find(":selected").val();
        $.ajax({
            url: `{{url('/')}}/get/`+city_id+`/districts`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'get',
            success: function (data){
                $('#district_id').empty()
                $.each(data, function(index, val){
                    $('#district_id').append(`<option value="`+val.id+`">`+val.nm_kecamatan+`</option>`)
                })
            }
        })
    })
</script>
@endpush
