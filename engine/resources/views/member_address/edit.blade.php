@extends('layouts.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit {{$member->name}} Address</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">member address</a></li>
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
                                        <option disabled>select province</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{$province->id}}" @if ($address->province_id == $province->id) selected @endif>{{$province->name}}</option>
                                        @endforeach
                                    </select>
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
                                    <label for="area_id">Area</label>
                                    <select class="form-control select2" name="area_id" id="area_id">
                                    </select>
                                    @error('area_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="postal_code" name="postal_code" class="form-control" id="postal_code"
                                        placeholder="postal_code" value="{{$address->postal_code}}">
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
                    var selected = ''
                    if (val.id == '{{$address->city_id}}'){
                        selected = 'selected'
                    }
                    $('#city_id').append(`<option value="`+val.id+`" `+selected+`>`+val.name+`</option>`)
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
                    var selected = ''
                    if (val.id == '{{$address->district_id}}'){
                        selected = 'selected'
                    }
                    $('#district_id').append(`<option value="`+val.id+`" `+selected+`>`+val.name+`</option>`)
                })
                $("#district_id").change();
            }
        })
    })

    $('#district_id').change(function(){
        var district_id = $('#district_id').find(":selected").val();
        $.ajax({
            url: `{{url('/')}}/get/`+district_id+`/areas`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'get',
            success: function (data){
                $('#area_id').empty()
                $.each(data, function(index, val){
                    $('#area_id').append(`<option value="`+val.id+`">`+val.name+`</option>`)
                })
            }
        })
    })

    $(document).ready(function() {
        $("#province_id").change();
    });
</script>
@endpush
