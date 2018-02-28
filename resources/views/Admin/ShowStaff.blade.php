@extends('Admin.templateAdmin')

@section('isi')
    <!-- About Me Box -->
    <div class="box box-primary">
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('staff.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list staff</span></a>
        </div>
        <div class="box-header with-border" style="margin-top: 3%;">
            <h3 class="box-title">{{ ucwords($staff->nama_staff) }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-user margin-r-5"></i> ID Staff</strong>

            <p class="text-muted">
                {{ $staff->id_staff }}
            </p>

            <hr>

            <strong><i class="fa fa-user margin-r-5"></i> ID Status</strong>

            <p class="text-muted">
                {{ $staff->id_status }}
            </p>

            <hr>

            <strong><i class="fa fa-user margin-r-5"></i> NIP</strong>

            <p class="text-muted">
                {{ $staff->nip }}
            </p>

            <hr>

            <strong><i class="fa fa-inbox margin-r-5"></i> Email</strong>

            <p class="text-muted">
                {{ $staff->email }}
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>

            <p class="text-muted">{{ $staff->alamat }}</p>

            <hr>

            <strong><i class="fa fa-phone margin-r-5"></i> Nomor Hp</strong>

            <p class="text-muted">{{ $staff->no_hp }}</p>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection