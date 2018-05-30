@extends('Admin.templateAdmin')

@section('isi')
    <!-- About Me Box -->
    <div class="box" style="background-color: #ffffff; border-top: #ffffff !important;">
        <div class="box-header">
            <a class="fa fa-arrow-left" href="{{ route('acara.index') }}"><span style="font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif; font-size: small;">&nbspKembali ke list acara</span></a>
        </div>
        <div class="box-header with-border" style="margin-top: 3%;">
            <h3 class="box-title">{{ ucwords($detail->getSummary()) }}</h3>
        </div>
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>Waktu Mulai</dt>
                    <dd class="show"><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($acara->start_date)->formatLocalized('%A, %d %B %Y %H:%M')?></dd>
                    <dt>Waktu Berakhir</dt>
                    <dd class="show"><?php setlocale(LC_TIME, 'Indonesian'); echo \Illuminate\Support\Carbon::parse($acara->end_date)->formatLocalized('%A, %d %B %Y %H:%M')?></dd>
                    <dt>Tempat</dt>
                    <dd class="show">{{ $detail->getLocation() }}</dd>
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
                    {{--<dt>Response Undangan</dt>
                        <dd class="show">{{ implode(', ', $tampungResponse) }}</dd>--}}
                </dl>
            </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection