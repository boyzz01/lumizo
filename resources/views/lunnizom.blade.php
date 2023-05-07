@extends('main')
@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            @include('sidebar')
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('topbar')
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <div class="d-flex align-items-center flex-wrap mr-2">
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Catalog Laztia Land Binjai</h5>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{ route('lunnizom.store') }}" id="form1" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    {{ csrf_field() }}
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">

                                                    <div class="form-group">
                                                        <label for="nama">Nama Produk</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            name="nama" placeholder="Masukkan nama produk">
                                                    </div>
                                                    <input type="hidden" name="jenis_catalog_id" value="6">
                                                    <div class="form-group">
                                                        <label for="harga">Harga Produk</label>
                                                        <input type="text" class="form-control" id="harga"
                                                            name="harga" placeholder="Masukkan harga produk">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Deskripsi</label>
                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                                    </div>



                                                    <div class="form-group">
                                                        <div class="dropzone dropzone-default dropzone-primary dz-clickable"
                                                            id="teszone">


                                                            <div class="dropzone-msg dz-message needsclick">
                                                                <h3 class="dropzone-msg-title">Drop files here or click to
                                                                    upload.</h3>
                                                                <span class="dropzone-msg-desc">Upload up to 5 files</span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="Submit" name="Submit" id="submitButton"
                                                    class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>


                            <div class="card card-custom">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">List Catalog
                                            <span class="text-muted pt-2 font-size-sm d-block"></span>
                                        </h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <!--begin::Dropdown-->

                                        <!--end::Dropdown-->
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-primary" style="margin-right: 20px;"
                                            data-toggle="modal" data-target="#exampleModal">
                                            Tambah Data
                                        </button>
                                        <!--end::Button-->

                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--begin: Datatable-->
                                    <table class="table table-bordered table-checkable" id="kt_datatable2">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>


                                            </tr>
                                        </thead>
                                        <tbody>


                                            @php
                                                $nomor = 1;
                                            @endphp
                                            @foreach ($catalogs as $d)
                                                <tr id="tr{{ $d->id }}">
                                                    <td style=" width:5%">{{ $nomor }}</td>
                                                    <td>
                                                        @foreach ($d->fotos as $foto)
                                                            <img src="{{ asset('storage/catalog/' . $foto->path) }}"
                                                                width="50" height="50">
                                                        @endforeach
                                                    </td>

                                                    <td>{{ $d->nama }}</td>
                                                    <td>{{ $d->harga }}</td>
                                                    <td>{{ $d->deskripsi }}</td>

                                                    <td nowrap="nowrap">


                                                        <a href="javascript:;" class="btn btn-sm btn-info btn-icon edit_btn"
                                                            id="{{ $d->id }}" title=" Edit Data Pasien">
                                                            <i class="la la-edit"></i>
                                                        </a>



                                                        <button type="submit" class="btn btn-sm btn-danger btn-icon"
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure want to delete this data?')"><i
                                                                class="la la-trash">
                                                            </i>
                                                        </button>

                                                    </td>



                                                </tr>

                                                @php
                                                    $nomor++;
                                                @endphp
                                            @endforeach




                                        </tbody>
                                    </table>
                                    <!--end: Datatable-->
                                </div>
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>
                </div>
            @endsection
