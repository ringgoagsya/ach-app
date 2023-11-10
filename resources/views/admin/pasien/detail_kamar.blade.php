@extends('layouts.app', ['page' => __('kamars'), 'pageSlug' => 'kamars', 'showCollapse' => 'show'])

@section('content')
@section('title')
    {{ __('AC') }}
@endsection
<!-- Page content -->
<style>
    /* Ganti warna teks menjadi abu-abu atau warna yang Anda inginkan */
    input[disabled] {
        color: rgb(8, 2, 22);
        /* Ubah ini sesuai keinginan Anda */
    }

    .form-control {
        color: white;
        /* Ubah warna teks sesuai keinginan Anda */
    }
</style>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h3 class="mb-0">Detail Kamar SPH</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <div>
                            <div>
                                <div class="body">
                                    <form role="form" method="post"
                                        action="{{ route('kamar_detail.edit', [$kamar->id_kamar]) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <div>
                                                <label for="example-text-input" class="form-control-label">ID
                                                    KAMAR</label>
                                                <input disabled class="form-control" placeholder="ID Kamar"
                                                    type="text" value="{{ $kamar->id_kamar }}" name="id_kamar"
                                                    id="id_kamar">
                                                <input class="form-control" placeholder="ID Kamar" type="hidden"
                                                    value="{{ $kamar->id_kamar }}" name="id_kamar" id="id_kamar">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="example-text-input"
                                                    class="form-control-label">Lantai</label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->lantai_kamar }}" name="lantai_kamar"
                                                    id="lantai_kamar">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="example-text-input"
                                                    class="form-control-label">Ruangan</label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->ruangan_kamar }}" name="ruangan_kamar"
                                                    id="ruangan_kamar">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="example-text-input" class="form-control-label">Keterangan
                                                    Kamar</label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->keterangan }}" name="keterangan" id="keterangan">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="example-text-input" class="form-control-label">Panjang Kamar
                                                </label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->panjang_kamar }}" name="panjang_kamar"
                                                    id="panjang_kamar">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="example-text-input" class="form-control-label">Lebar
                                                    Kamar</label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->lebar_kamar }}" name="lebar_kamar"
                                                    id="lebar_kamar">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="example-text-input" class="form-control-label">Tinggi
                                                    Kamar</label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->tinggi_kamar }}" name="tinggi_kamar"
                                                    id="tinggi_kamar">

                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label for="example-text-input" class="form-control-label">Panjang
                                                    Ventilasi
                                                </label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->panjang_ventilasi }}" name="panjang_ventilasi"
                                                    id="panjang_ventilasi">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="example-text-input" class="form-control-label">Lebar
                                                    Ventilasi</label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->lebar_ventilasi }}" name="lebar_ventilasi"
                                                    id="lebar_ventilasi">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            @php
                                                $nilai_ukur = 0;
                                                $volume_kamar_sph = $kamar->panjang_kamar * $kamar->lebar_kamar * $kamar->tinggi_kamar;
                                                $cmh = $kamar->volume_udara * $kamar->panjang_ventilasi * $kamar->lebar_ventilasi;
                                                $cmh_kali_60 = $cmh * 60;
                                                $nilai_ukur = $cmh_kali_60 / $volume_kamar_sph;
                                            @endphp
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Volume
                                                    Udara
                                                </label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->volume_udara }}" name="volume_udara"
                                                    id="volume_udara">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">CMH
                                                    Kamar</label>
                                                <input disabled class="form-control" placeholder="0" type="text"
                                                    value="{{ $cmh }}" name="cmh_kamar" id="cmh_kamar">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Nilai
                                                    ACH</label>
                                                <input disabled class="form-control" placeholder="0" type="text"
                                                    value="{{ number_format($nilai_ukur, 2) }}" name="nilai_ukur"
                                                    id="nilai_ukur">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Standar
                                                    ACH</label>
                                                <input class="form-control" placeholder="0" type="text"
                                                    value="{{ $kamar->standart }}" name="standart" id="standart">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Status
                                                    ACH</label>
                                                @if ($nilai_ukur > $kamar->standart)
                                                    <span class="badge badge-success badge-pill">OK</span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">DANGER</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button id="formSubmit" type="submit" class="btn btn-primary"
                                                onclick="swal ( 'Berhasil','Kamar {{ $kamar->id_kamar }} Telah Berhasil di Edit','info')">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('modals')
@endsection
@section('script')
@endsection
