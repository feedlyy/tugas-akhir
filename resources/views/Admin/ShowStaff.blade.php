@extends('Admin.templateAdmin')

@section('isi')
    <!-- About Me Box -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('staff.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list staff</span></a>
        </div>
        <div class="box-header with-border" style="margin-top: 3%;">
            <h3 class="box-title">{{ ucwords($staff->nama_staff) }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID Staff</dt>
                <dd class="show">{{ $staff->id_staff }}</dd>
                @if($staff->id_fakultas != null && $staff->id_departemen == null && $staff->id_prodi == null)
                    <dt>ID Fakultas</dt>
                    <dd class="show">{{ $staff->id_fakultas }}</dd>
                @elseif($staff->id_fakultas != null && $staff->id_departemen != null && $staff->id_prodi == null)
                    <dt>ID Fakultas</dt>
                    <dd class="show">{{ $staff->id_fakultas }}</dd>
                    <dt>ID Departemen</dt>
                    <dd class="show">{{ $staff->id_departemen }}</dd>
                @else
                    <dt>ID Fakultas</dt>
                    <dd class="show">{{ $staff->id_fakultas }}</dd>
                    <dt>ID Departemen</dt>
                    <dd class="show">{{ $staff->id_departemen }}</dd>
                    <dt>ID Prodi</dt>
                    <dd class="show">{{ $staff->id_prodi }}</dd>
                @endif
                <dt>NIP</dt>
                <dd class="show">{{ $staff->nip }}</dd>
                <dt>Email</dt>
                <dd class="show">{{ $staff->email }}</dd>
                <dt>Alamat</dt>
                <dd class="show">{{ $staff->alamat }}</dd>
                <dt>No Hp</dt>
                <dd class="show">{{ $staff->no_hp }}</dd>
            </dl>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection