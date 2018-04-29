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
                        button: "OK",
                    });
                })
            </script>
        @endforeach
    @endif


    <!-- general form elements -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Departemen</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('departemen.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list departemen</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('departemen.update', $departemen->id_departemen) }}">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Id Departemen</label>
                    <input type="text" name="id_departemen" class="form-control" id="" placeholder="" value="{{ $departemen->id_departemen }}">
                </div>
            </div>
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Nama Departemen</label>
                    <input type="text" name="nama_departemen" class="form-control" id="" placeholder="" value="{{ $departemen->nama_departemen }}">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>

@endsection