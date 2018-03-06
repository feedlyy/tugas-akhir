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
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Ruangan</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('ruangan.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list ruangan</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('ruangan.update', $ruangan->id_ruangan) }}">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" id="" placeholder="" value="{{ $ruangan->id_ruangan }}">
                </div>
            {{--</div><div class="box-body">
                <div class="form-group">
                    --}}{{--<label for="exampleInputEmail1">ID Ruangan</label>--}}{{--
                    <input type="text" name="nama_ruangan" class="form-control" id="" placeholder="" value="{{ $ruangan->nama_ruangan }}">
                </div>
            </div>--}}
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection