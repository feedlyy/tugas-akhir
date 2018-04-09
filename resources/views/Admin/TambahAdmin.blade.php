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
    @elseif(session()->has('alr_exist'))
        <script>
            $().ready(function (e) {
                swal({
                    title: "Warning!",
                    text: "Data sudah ada",
                    icon: "warning",
                    button: false,
                    timer: 2000
                });
            })
        </script>
    @endif

    <!-- general form elements -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
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
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Admin</label>
                    <input type="text" name="nama_admin" class="form-control" id="" placeholder="" value="{{ old('nama_admin') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="" placeholder="">
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
                    \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
                    \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                <div class="form-group">
                    <label>ID Departemen</label>
                    <select id="departemen" class="form-control select2" style="width: 100%;" name="selectdepartemen">
                        <option disabled selected="selected">Pilih Status</option>
                        @foreach($departemen as $data)
                            @if($data->id_fakultas != null && $data->id_departemen == null && $data->id_prodi == null)
                                <option hidden>{{ $data->id_fakultas }}</option>
                            @else
                            <option value="{{ $data->id_departemen }}">{{ $data->nama_departemen }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
                    \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
                    \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                    <div class="form-group">
                        <label>Pilih Prodi (Jika Tambah Prodi)</label>
                        <select id="prodi" class="form-control select2" style="width: 100%;" name="selectprodi">
                            <option disabled selected="selected">Pilih Prodi</option>
                        </select>
                    </div>
                @elseif(\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
                    \Illuminate\Support\Facades\Auth::user()->id_departemen != null &&
                    \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
                    <div class="form-group">
                        <label>Pilih Prodi</label>
                        <select class="form-control select2" style="width: 100%;" name="selectprodi2">
                            <option disabled selected="selected">Pilih Prodi</option>
                            @foreach($prodi as $data)
                                <option value="{{ $data->id_prodi }}">{{ $data->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script>


            $('#departemen').change(function(){


                var selected_departemen_type = $(this).val();

                $.ajax({
                    url : "/prodi/" + selected_departemen_type,
                    type:'get',
                    dataType: 'json',
                    success: function(response) {


                        //alert(response); // show [object, Object]

                        var $select = $('#prodi');

                        $select.find('option').remove();
                        $.each(response,function(key, value)
                        {
                            $select.append('<option ' + response[key].id_prodi + '>' + response[key].id_prodi + '</option>'); // return empty
                        });
                    }
                });
            });
    </script>
@endsection