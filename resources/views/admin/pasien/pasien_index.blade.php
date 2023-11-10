@extends('layouts.app', ['page' => __('kamars'), 'pageSlug' => 'kamars', 'showCollapse' => 'show'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">TABEL KAMAR</h4>
                            <p class="card-category">data master</p>
                            <div class="text-left">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modal-tambah">New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table">
                                <table class="table table-bordered table-responsive" id="datatable" style="width:100%">
                                    <thead class="thead thead-bordered">
                                        <tr>
                                            <th style="border-color:inherit;text-align:center; width:5%" rowspan="2">No
                                            </th>
                                            <th style="border-color:inherit;text-align:center;width:20%" rowspan="2">
                                                Kamar</th>
                                            <th style="border-color:inherit;text-align:center;vertical-align:top; width:10%"
                                                colspan="3">Dimensi (m)</th>
                                            <th style="border-color:inherit;text-align:center;vertical-align:top; width:10%"
                                                colspan="2">ventilasi (m)</th>
                                            <th style="border-color:inherit;text-align:center;width:10%;" rowspan="2">
                                                Velocity Udara</th>
                                            <th style="border-color:inherit;text-align:center;width:10%" rowspan="2">
                                                Nilai
                                                CMH</th>
                                            <th style="border-color:inherit;text-align:center;vertical-align:top;width:10%"
                                                colspan="2">ACH</th>
                                            <th style="border-color:inherit;text-align:center; width:10%" rowspan="2">
                                                Status</th>
                                            <th rowspan="2" style="border-color:inherit;text-align:center;width:20%">Aksi
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="tg-0lax"
                                                style="border-color:inherit;text-align:center;vertical-align:top;width:4%;">
                                                panjang
                                            </th>
                                            <th class="tg-0lax"
                                                style="border-color:inherit;text-align:center;vertical-align:top;width:3%;">
                                                lebar
                                            </th>
                                            <th class="tg-0lax"
                                                style="border-color:inherit;text-align:center;vertical-align:top;width:3%;">
                                                tinggi
                                            </th>
                                            <th class="tg-0lax"
                                                style="border-color:inherit;text-align:center;vertical-align:top;width:5%;">
                                                panjang
                                            </th>
                                            <th class="tg-0lax"
                                                style="border-color:inherit;text-align:center;vertical-align:top;width:5%;">
                                                lebar
                                            </th>
                                            <th class="tg-0lax"
                                                style="border-color:inherit;text-align:center;vertical-align:top;">Nilai
                                                Ukur</th>
                                            <th class="tg-0lax"
                                                style="border-color:inherit;text-align:center;vertical-align:top;">Standart
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($master_kamar as $kamar)
                                            <tr style="border-color:inherit;text-align:center;">
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $kamar->id_kamar }}
                                                </td>
                                                <td>
                                                    {{ $kamar->panjang_kamar . ' m' }}
                                                </td>
                                                <td>
                                                    {{ $kamar->lebar_kamar . ' m' }}
                                                </td>
                                                <td>
                                                    {{ $kamar->tinggi_kamar . ' m' }}
                                                </td>
                                                <td>
                                                    {{ $kamar->panjang_ventilasi . ' m' }}
                                                </td>
                                                <td>
                                                    {{ $kamar->lebar_ventilasi . ' m' }}
                                                </td>
                                                <td>
                                                    @php $volume_udara = 0; @endphp
                                                    @foreach ($trx_volume as $volume)
                                                        @if ($volume->id_kamar == $kamar->id_kamar)
                                                            @php $volume_udara = $volume->volume_udara; @endphp
                                                        @endif
                                                    @endforeach
                                                    {{ number_format($volume_udara, 2) }}
                                                </td>
                                                <td>
                                                    @php $CMH = 0; @endphp
                                                    @foreach ($trx_volume as $volume)
                                                        @if ($volume->id_kamar == $kamar->id_kamar)
                                                            @php
                                                                $CMH = $volume->volume_udara * $kamar->panjang_ventilasi * $kamar->lebar_ventilasi;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    {{ number_format($CMH, 2) }}
                                                </td>
                                                <td>
                                                    @php
                                                        $nilai_ukur = 0;
                                                        $volume_kamar_sph = $kamar->panjang_kamar * $kamar->lebar_kamar * $kamar->tinggi_kamar;
                                                        $cmh_kali_60 = $CMH * 3600;
                                                    @endphp
                                                    @foreach ($trx_volume as $volume)
                                                        @if ($volume->id_kamar == $kamar->id_kamar)
                                                            @php
                                                                $nilai_ukur = $cmh_kali_60 / $volume_kamar_sph;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    {{ number_format($nilai_ukur, 2) . ' ACH' }}
                                                </td>
                                                <td>
                                                    {{ $kamar->standart }}
                                                </td>
                                                <td>
                                                    @if ($nilai_ukur > $kamar->standart)
                                                        <span class="badge badge-success badge-pill">TRUE</span>
                                                    @else
                                                        <span class="badge badge-danger badge-pill">FALSE</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a style="margin: 2px" href="#" type="button"
                                                        title="input velocity udara" class="btn btn-info btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#modalform{{ $kamar->id_kamar }} "><i
                                                            class="fa fa-edit"></i></a>
                                                    {{-- </td>
                                                <td> --}}

                                                    <a style="margin: 2px"
                                                        href="{{ route('kamar.detail', [$kamar->id_kamar]) }}"
                                                        type="button" title="payment method"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>

                                                    <a style="margin: 2px" href="#" type="button"
                                                        title="input velocity udara" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#modadelete{{ $kamar->id_kamar }} "><i
                                                            class="fa fa-trash"></i></a>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td rowspan="100%" colspan="100%">
                                                    {{ 'Belum Ada Data' }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modals')
    {{-- Modal Buat Tambah Data --}}
    <div class="col-md-10">
        <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Tambah Data Kamar</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('pasien.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group{{ $errors->has('lantai_kamar') ? ' has-danger' : '' }} col-md-4">
                                    <label for="lantai_kamar">Nomor Kamar</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-notes"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="lantai_kamar"
                                            class="form-control{{ $errors->has('lantai_kamar') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nomor Kamar') }}">
                                        @include('alerts.feedback', ['field' => 'lantai_kamar'])
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('ruangan_kamar') ? ' has-danger' : '' }} col-md-4">

                                    <label for="ruangan_kamar">Kelas Kamar</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-paper"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="ruangan_kamar"
                                            class="form-control{{ $errors->has('ruangan_kamar') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Kelas Kamar') }}">
                                        @include('alerts.feedback', ['field' => 'ruangan_kamar'])
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('keterangan') ? ' has-danger' : '' }} col-md-4">
                                    <label for="keterangan">Lantai</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-single-copy-04"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="keterangan"
                                            class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Lantai Kamar') }}">
                                        @include('alerts.feedback', ['field' => 'keterangan'])
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="panjang_kamar">Panjang Kamar</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-minimal-up"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="panjang_kamar" class="form-control" placeholder="Panjang Kamar">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lebar_kamar">Lebar Kamar</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-minimal-right"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="lebar_kamar" class="form-control" placeholder="Lebar Kamar">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tinggi_kamar">Tinggi Kamar</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-minimal-down"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="tinggi_kamar" class="form-control" placeholder="Tinggi Kamar">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="panjang_ventilasi">Panjang Ventilasi</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-minimal-up"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="panjang_ventilasi" class="form-control"
                                            placeholder="Panjang ventilasi">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lebar_ventilasi">Lebar Ventilasi</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-minimal-right"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="lebar_ventilasi" class="form-control" placeholder="Lebar ventilasi">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="standart">Standart ACH</label>
                                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <div class="input-group-text"
                                            style="background-color: white; color:black;border-color:gray">
                                            <i class="tim-icons icon-bulb-63"></i>
                                        </div>
                                        <input type="text" style="background-color: white; color:black;"
                                            name="standart" class="form-control" placeholder="Standart ACH">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="margin-top: -20px;display: grid; place-content: center;">
                                <button type="submit" class="btn btn-primary btn-round btn-lg"
                                    style="align-content: center">{{ __('Tambah') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($master_kamar as $kamar)
        @php
            $volume_udara = 0;
            $standart = 0;
        @endphp
        @foreach ($trx_volume as $volume)
            @if ($volume->id_kamar == $kamar->id_kamar)
                @php
                    $volume_udara = $volume->volume_udara;
                @endphp
            @endif
        @endforeach
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $kamar->id_kamar }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Edit kamar</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ route('kamar.edit', [$kamar->id_kamar]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <label for="id_kamar" class="form-control-label">ID kamar</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input readonly style="background-color: white; color:black;" class="form-control"
                                            value="{{ $kamar->id_kamar }}" type="text" name="id_kamar"
                                            id="id_kamar">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="volume_udara" class="form-control-label">Velocity Udara</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input class="form-control" style="background-color: white; color:black;"
                                            value="{{ $volume_udara }}" type="text" name="volume_udara"
                                            id="volume_udara">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','ID {{ $kamar->id_kamar }} Telah Berhasil Di Edit','success')">Simpan</button>
                                    <button type="button" class="btn btn-danger  ml-auto"
                                        data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Modal Buat Delete --}}
    @foreach ($master_kamar as $kamar)
        <div class="modal fade" id="modaldelete{{ $kamar->id_kamar }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Hapus kamar ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ route('kamar.destroy', [$kamar->id_kamar]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="row ">
                                        <div class="col md-4 mr-auto">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                        <div class="col md-6 mr-auto">
                                            <button type="submit" title="Hapus" class="btn btn-danger"
                                                onclick="swal ( 'Berhasil','Data {{ $kamar->nama_kamar }} Telah Dihapus','warning')">Ya</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            var Datatable = $('#datatable').DataTable({

                buttons: ['print', 'excel'],
                dom: "<'row'<'col-md-3'l><'col-md-5 btn-sm'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                initComplete: function(settings, json) {
                    // Menambahkan kelas CSS ke elemen yang Anda inginkan
                    $('#custom-select').addClass('custom-sel');
                }
            });

        });
    </script>
@endsection
