@extends('Admin.templateAdmin')

@section('isi')

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Ruangan</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ url('admin/ruangan') }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <div class="form-group">
                        <label>ID Gedung</label>

                            <select class="form-control select2" style="width: 100%;" name="selectgedung">
                                @foreach($ruangan as $ruang)
                                <option selected="selected">{{ $ruang->id_gedung }}</option>
                                @endforeach
                            </select>


                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" id="" placeholder="">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection


