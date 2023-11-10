@extends('layouts.app', ['page' => __('User '), 'pageSlug' => 'users', 'showCollapse' => 'show'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">TABEL USER</h4>
                            <p class="card-category">data master</p>
                            <div class="text-left">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modal-tambah">New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead class=" text-primary">
                                        <th>No</th>
                                        <th>NAMA USER</th>
                                        <th>EMAIL</th>
                                        <th>AKSI</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($user as $no => $user_all)
                                            <tr>
                                                <td>
                                                    {{ ++$no }}
                                                </td>
                                                <td>
                                                    {{ $user_all->name }}
                                                </td>
                                                <td>
                                                    {{ $user_all->email }}
                                                </td>
                                                <td>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#modalform{{ $user_all->id }} "><i
                                                            class="fa fa-edit"></i></a>
                                                    <a href="#" type="button" title="payment method"
                                                        class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modaldelete{{ $user_all->id }} "><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>
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
    <div class="col-md-4">
        <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Tambah Data User</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('user.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"
                                                style="color: black"></i></span>
                                    </div>
                                    <input style="color: black" class="form-control" placeholder="Nama" type="text"
                                        name="nama" id="nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"
                                                style="color: black"></i></span>
                                    </div>
                                    <input style="color: black" class="form-control" placeholder="Email" type="text"
                                        name="email" id="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key" style="color: black"></i></span>
                                    </div>
                                    <input style="color: black" class="form-control" placeholder="Password" type="password"
                                        name="password" id="password">
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="formSubmit" type="submit" class="btn btn-primary"
                                    onclick="swal ( 'Berhasil','User Telah Ditambahkan','success')">Tambah</button>
                                <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal buat edit data --}}
    @foreach ($user as $user_all)
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $user_all->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalform" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Edit Data User</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ route('user.update', [$user_all->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input value="{{ $user_all->name }}" style="color: black" class="form-control"
                                            placeholder="Name" type="text" name="name" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input value="{{ $user_all->email }}"class="form-control" style="color: black"
                                            placeholder="Email" type="text" name="email" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"
                                                    style="color: black"></i></span>
                                        </div>
                                        <input class="form-control" style="color: black" value="password"
                                            placeholder="Password" type="password" name="password" id="password">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','User Telah Berhasil di Edit','success')">Edit</button>
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
    @foreach ($user as $user_all)
        <div class="modal fade" id="modaldelete{{ $user_all->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modaldelete" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Hapus User ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('user.destroy', [$user_all->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="row">
                                        <button type="button" class="col-md-4 btn btn-secondary text-center"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" title="Hapus" class="col-md-3 btn btn-danger text-center"
                                            onclick="swal ( 'Berhasil','User Telah Dihapus','warning')">Ya</button>
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
                ]
            });

        });
    </script>
@endsection
