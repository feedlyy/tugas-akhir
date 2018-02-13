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

    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif

    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Gedung</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" @if(Auth::user()->id_status==1) action="{{ route('tambahGedung1') }}"
        @elseif(Auth::user()->id_status==2) action="{{ route('tambahGedung2') }}"
              @else action="{{ route('tambahGedung3') }}"
              @endif>
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