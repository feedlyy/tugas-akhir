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
            <h3 class="box-title">Tambah Gedung</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('gedung.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list gedung</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('gedung.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID Gedung</label>
                    <input type="text" name="id_gedung" class="form-control" id="" placeholder="" value="{{ old('id_gedung') }}" autofocus required>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Gedung</label>
                    <input type="text" name="gedung" class="form-control" id="" placeholder="" value="{{ old('gedung') }}" autofocus required>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection