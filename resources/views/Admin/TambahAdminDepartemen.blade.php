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
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Admin Departemen</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('admin.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list admin</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('addDepartemen') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="" placeholder="" value="{{ old('username') }}">
                </div>
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="" placeholder="">
                </div>

                    <div class="form-group empatlima">
                        <label>ID Departemen</label>
                        <select id="departemen" class="form-control select2" style="width: 100%;" name="selectdepartemen">
                            <option disabled selected="selected">Pilih Status</option>
                            @foreach($departemen as $data)
                                <option value="{{ $data->id_departemen }}">{{ $data->nama_departemen }}</option>
                            @endforeach
                        </select>
                    </div>

            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection