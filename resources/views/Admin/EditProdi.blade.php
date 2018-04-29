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
            <h3 class="box-title">Edit Prodi</h3>
        </div>
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('prodi.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list prodi</span></a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('prodi.update', $prodi->id_prodi) }}">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Id Prodi</label>
                    <input type="text" name="id_prodi" class="form-control" id="" placeholder="" value="{{ $prodi->id_prodi }}">
                </div>


                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Id Departemen</label>
                    <select class="form-control" style="width: 100%;" name="id_departemen">
                        @foreach($tampung as $data)
                            @if($data == $departemen[0]->id_departemen)
                                <option value="{{ $data }}" selected>{{ $data }}</option>
                            @else
                                <option value="{{ $data }}">{{ $data }}</option>
                            @endif
                        @endforeach

                    </select>
                </div>

                <div class="form-group empatlima">
                    <label for="exampleInputEmail1">Nama Prodi</label>
                    <input type="text" name="nama_prodi" class="form-control" id="" placeholder="" value="{{ $prodi->nama_prodi }}">
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>

@endsection