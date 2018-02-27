@extends('Admin.templateAdmin')

@section('isi')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
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
            <h3 class="box-title">Tambah Ruangan</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('ruangan.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list ruangan</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('ruangan.store') }}">
            {{ csrf_field() }}

            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID Ruangan</label>
                    <input type="text" name="id_ruangan" class="form-control" id="" placeholder="" value="{{ old('id_ruangan') }}" autofocus required>
                </div>
                <div class="form-group">
                        <label>ID Gedung</label>
                            <select class="form-control select2" style="width: 100%;" name="selectgedung">
                                @foreach($ruangan as $ruang)
                                <option selected="selected">{{ $ruang->id_gedung }}</option>
                                @endforeach
                            </select>
                </div>
                <div class="form-group">
                    {{--<label for="exampleInputEmail1">Nama Ruangan</label>--}}
                    <input type="hidden" name="nama_ruangan" class="form-control" id="" placeholder="">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="box" style="margin-top: 5%;">
        <div class="box-header">
            <h2 class="box-title">List Nama Gedung</h2>
        </div>
        <div class="box-body">
            <!-- Select multiple-->
            <div class="form-group">
                <label>ID beserta nama gedung</label>
                <select multiple class="form-control">
                    @foreach($ruangan as $data)
                        <option>{{ $data->id_gedung }} - {{ $data->nama_gedung }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

@endsection


