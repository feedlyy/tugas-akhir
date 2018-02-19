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
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('gedung.store') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Gedung</label>
                    <input type="text" name="gedung" class="form-control" id="" placeholder="">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection