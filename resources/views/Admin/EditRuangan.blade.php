@extends('Admin.templateAdmin')

@section('isi')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Ruangan</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('ruangan.update', $ruangan->id_ruangan) }}">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="box-body">
                {{--<div class="form-group">--}}
                    {{--<label>ID Gedung</label>--}}
                    {{--<select class="form-control select2" style="width: 100%;" name="selectgedung">--}}
                        {{--@foreach($gedung as $data)--}}
                            {{--<option selected="selected">{{ $ruangan->id_gedung }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Gedung</label>
                    <input type="text" name="ruangan" class="form-control" id="" placeholder="" value="{{ $ruangan->nama_ruangan }}">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection