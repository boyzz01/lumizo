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
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Data Voucher</h5>
                            </div>

                        </div>
                    </div>
                    <div>
                        @include('alert')
                    </div>
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->

                        <div class="container">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{ route('vouchers.store') }}" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">
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
                                                        <label>Nama voucher
                                                            <span class="text-danger"></span></label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Gambar
                                                            <span class="text-danger"></span></label>
                                                        <input type="file" class="form-control-file" id="photo"
                                                            name="photo">
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="Submit" name="Submit"
                                                    class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>


                            <div class="card card-custom">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">List voucher
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
                                                <th>Status</th>

                                                <th>Aksi</th>


                                            </tr>
                                        </thead>
                                        <tbody>


                                            @php
                                                $nomor = 1;
                                            @endphp
                                            @foreach ($vouchers as $d)
                                                <tr id="tr{{ $d->id }}">
                                                    <td style=" width:5%">{{ $nomor }}</td>
                                                    <td><img src="{{ asset('storage/voucher/' . $d->image) }}"
                                                            height="50">
                                                    </td>
                                                    <td>{{ $d->nama }}</td>

                                                    <td>
                                                        @if ($d->isactive == 1)
                                                            Aktif
                                                        @else
                                                            Nonaktif
                                                        @endif
                                                    </td>

                                                    <td nowrap="nowrap">
                                                        <form action="{{ route('vouchers.destroy', $d->id) }}"
                                                            method="POST">
                                                            <a href="javascript:;"
                                                                class="btn btn-sm btn-info btn-icon edit_btn"
                                                                id="{{ $d->id }}" title=" Edit Data">
                                                                <i class="la la-edit"></i>
                                                            </a>


                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger btn-icon"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure want to delete this data?')"><i
                                                                    class="la la-trash">
                                                                </i>
                                                            </button>
                                                        </form>
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
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <form action="" method="POST" id="editForm" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Sponsor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="editName">Nama Voucher</label>
                                        <input type="text" class="form-control" id="editName" name="name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editPhoto">Gambar</label>
                                        <input type="file" class="form-control-file" id="editPhoto" name="photo">
                                    </div>
                                    <div class="form-group">
                                        <label for="editIsActive">Status</label>
                                        <select class="form-control" id="editIsActive" name="isactive">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endsection
            @section('scripts')
                <script>
                    $(document).ready(function() {
                        // Menangkap event klik tombol edit
                        $('.edit_btn').click(function() {
                            var sponsorId = $(this).attr('id');
                            var url = '{{ route('vouchers.edit', ':id') }}';
                            url = url.replace(':id', sponsorId);

                            // Mengambil data sponsor berdasarkan ID menggunakan AJAX
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(response) {
                                    // Mengisi nilai pada form edit

                                    $('#editForm').attr('action', '{{ route('vouchers.update', ':id') }}'
                                        .replace(':id', sponsorId));
                                    $('#editName').val(response.nama);
                                    var isActiveValue = response
                                        .isactive; // Assuming the response contains the correct "isactive" value
                                    var isActiveText = isActiveValue == 1 ? 'Aktif' : 'Nonaktif';

                                    $('#editIsActive').val(isActiveValue);
                                    $('#editModal').modal('show');


                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        });
                    });
                </script>
            @endsection
