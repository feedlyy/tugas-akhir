@extends('Admin.templateAdmin')

@section('isi')
    <!-- About Me Box -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('acara.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list acara</span></a>
        </div>
        <div class="box-header with-border" style="margin-top: 3%;">
            <h3 class="box-title">{{ ucwords($acara->nama_event) }}</h3>
        </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>ID Acara</dt>
                    <dd class="show">{{ $acara->id_acara }}</dd>
                    <dt>Start Date</dt>
                    <dd class="show">{{ $acara->start_date }}</dd>
                    <dt>End Date</dt>
                    <dd class="show">{{ $acara->end_date }}</dd>
                    <dt>Gedung</dt>
                    <dd class="show">{{ $acara->id_gedung }}</dd>
                    <dt>Ruangan</dt>
                    <dd class="show">{{ $acara->nama_ruangan }}</dd>
                    @if($tampungEmail2 != null)
                        <dt>Staf Fakultas</dt>
                        <dd class="show">{{ implode(', ', $tampungEmail2) }}</dd>
                    @endif
                    @if($tampungEmail3 != null)
                        <dt>Staf Departemen</dt>
                        <dd class="show">{{ implode(', ', $tampungEmail3) }}</dd>
                    @endif
                    @if($tampungEmail4 != null)
                        <dt>Staf Prodi</dt>
                        <dd class="show">{{ implode(', ', $tampungEmail4) }}</dd>
                    @endif
                    @if($tampungEmail1 != null)
                        <dt>Tamu Undangan</dt>
                        <dd class="show">{{ implode(', ', $tampungEmail1) }}</dd>
                    @endif
                    <dt>Penanggung Jawab</dt>
                    <dd class="show">Admin {{ $acara->penanggung_jawab }}</dd>
                </dl>
            </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection