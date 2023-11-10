@extends('layouts.app', ['page' => __('kamars'), 'pageSlug' => 'kamars', 'showCollapse' => 'show'])
<style>
    .custom-text-color {
        color: rgb(0, 0, 0);
        /* Ganti dengan warna yang Anda inginkan */
    }
</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('success'))
                    <div id="myCard" class="alert alert-success col-md-12" style="margin-left:px">
                        <p style="color: white">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">KAMAR SPH</h4>
                            <div class="text-left">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table">
                                <table class="table table-bordered " id="datatable" style="width:100%">
                                    <thead class="thead thead-bordered">
                                        <tr>
                                            <th style="border-color:inherit;text-align:center; width:5%">No</th>
                                            <th style="border-color:inherit;text-align:center;width:20%">Kamar</th>
                                            <th style="border-color:inherit;text-align:center;width:10%">Volume Kamar</th>
                                            <th style="border-color:inherit;text-align:center;width:10%">Luas Ventilasi</th>
                                            <th style="border-color:inherit;text-align:center;width:10%;">Velocity Udara
                                            </th>
                                            <th
                                                style="border-color:inherit;text-align:center;vertical-align:top; width:10%">
                                                Nilai Ukur</th>
                                            <th style="border-color:inherit;text-align:center;vertical-align:top;width:10%">
                                                Standart
                                            </th>
                                            <th style="border-color:inherit;text-align:center; width:10%">Status</th>
                                            <th style="border-color:inherit;text-align:center;width:15%">Aksi
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


                                                {{-- <td> --}}
                                                @php $CMH = 0; @endphp
                                                @foreach ($trx_volume as $volume)
                                                    @if ($volume->id_kamar == $kamar->id_kamar)
                                                        @php
                                                            $luas_vent = $kamar->panjang_ventilasi * $kamar->lebar_ventilasi;
                                                            $CMH = $volume->volume_udara * $luas_vent;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{-- </td> --}}
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
                                                <td>
                                                    {{ $volume_kamar_sph . ' M' }}<sup>3</sup>
                                                </td>
                                                <td>
                                                    {{ $luas_vent . ' M' }}<sup>2</sup>
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
    @foreach ($master_kamar as $kamar)
        @php
            $volume_udara = 0;
            $standart = 0;
        @endphp
        @foreach ($trx_volume as $volume)
            @if ($volume->id_kamar == $kamar->id_kamar)
                @php
                    $volume_udara = $volume->volume_udara;
                    $standart = $kamar->standart;
                @endphp
            @endif
        @endforeach
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $kamar->id_kamar }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Input Velocity Kamar</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ route('velocity.edit', [$kamar->id_kamar]) }}"
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
                                            value="{{ $kamar->id_kamar }}" type="text" name="id_kamar" id="id_kamar">
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
                    $('#datatable info').addClass('custom-text-color');
                }
            });

        });
        $(document).ready(function() {
            setTimeout(function() {
                $("#myCard").fadeOut(500); // Menghilangkan card dalam 0,5 detik
            }, 6000); // 60.000 milidetik (1 menit)
        });
    </script>
@endsection
