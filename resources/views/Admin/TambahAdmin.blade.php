@extends('Admin.templateAdmin')

@section('isi')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{--<li>{{ $error }}</li>--}}
            <script>
                var error = "{{ $error }}";
                $().ready(function (e) {
                    swal({
                        title: "Warning!",
                        text: error,
                        icon: "warning",
                        button: false,
                        timer: 2000
                    });
                })
            </script>
        @endforeach
    @endif

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Admin</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('admin.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list admin</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('admin.store') }}">
            {{ csrf_field() }}
            {{--<div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID Admin</label>
                    <input type="text" name="id_admin" class="form-control" id="" placeholder="">
                </div>
            </div>--}}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Admin</label>
                    <input type="text" name="nama_admin" class="form-control" id="" placeholder="" value="{{ old('nama_admin') }}">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="" placeholder="">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>ID Status</label>
                    @if(\Illuminate\Support\Facades\Auth::user()->id_status == 1)
                    <select class="form-control select2" style="width: 100%;" name="selectstatus">
                        <option disabled selected="selected">Pilih Status</option>
                        @foreach($status as $data)
                            @if($data->id_status == 1)
                                <option disabled>{{ $data->id_status == 1 }}</option>
                            @else
                            <option>{{ $data->id_status }}</option>
                            @endif
                        @endforeach
                    </select>
                    @else
                        <select class="form-control select2" style="width: 100%;" name="selectstatus">
                            <option disabled selected="selected">Pilih Status</option>
                            @foreach($status as $data)
                                @if($data->id_status == 1)
                                    <option disabled>{{ $data->id_status == 1}}</option>
                                    @elseif($data->id_status == 2)
                                    <option disabled>{{ $data->id_status == 2 }}</option>
                                @else
                                <option>{{ $data->id_status }}</option>
                                @endif
                            @endforeach
                        </select>
                    @endif
                    <h6>1 = Fakultas, 2 = Departemen, 3 = Prodi</h6>
                </div>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection