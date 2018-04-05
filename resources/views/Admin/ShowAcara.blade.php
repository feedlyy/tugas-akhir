@extends('Admin.templateAdmin')

@section('isi')
    <!-- About Me Box -->
    <div class="box box-primary">
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('acara.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list acara</span></a>
        </div>
        <div class="box-header with-border" style="margin-top: 3%;">
            <h3 class="box-title">{{ ucwords($acara->nama_event) }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-user margin-r-5"></i> ID Acara</strong>

            <p class="text-muted">
                {{ $acara->id_acara }}
            </p>

            <hr>

            <strong><i class="fa fa-hourglass-start margin-r-5"></i>Start DateTime</strong>

            <p class="text-muted">
                {{ $acara->start_date }}
            </p>

            <hr>

            <strong><i class="fa fa-hourglass-end margin-r-5"></i>End DateTime</strong>

            <p class="text-muted">
                {{ $acara->end_date }}
            </p>

            <hr>

            <strong><i class="fa fa-building margin-r-5"></i>ID Gedung</strong>

            <p class="text-muted">
                {{ $acara->id_gedung }}
            </p>

            <hr>

            <strong><i class="fa fa-building-o margin-r-5"></i>Nama Ruangan</strong>

            <p class="text-muted">
                {{ $acara->nama_ruangan }}
            </p>

            <hr>

            <strong><i class="fa fa-users margin-r-5"></i>Tamu Undangan</strong>

            <p class="text-muted">
                {{--{{ $query }}--}}
                {{ implode(', ', $tampungEmail) }}
            </p>

            <hr>

            <strong><i class="fa fa-user-plus margin-r-5"></i>Penanggung Jawab</strong>

            <p class="text-muted">{{ array_first($tampung) }}</p>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection