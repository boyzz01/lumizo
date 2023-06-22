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
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Catalog Properti</h5>
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
                                                        <label for="jenis_catalog">Jenis Perumahan</label>
                                                        <select class="form-control" id="jenis_catalog"
                                                            name="jenis_catalog_id">
                                                            @foreach ($jenisCatalogs as $jenisCatalog)
                                                                <option value="{{ $jenisCatalog->id }}">
                                                                    {{ $jenisCatalog->nama }}</option>
                                                            @endforeach
                                                        </select>
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
                                                <th>Jenis Perumahan</th>
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
                                                    <td>{!! $d->deskripsi !!}</td>
                                                    <td>
                                                        @if ($d->jenis_catalog_id == 6)
                                                            Laztia Land Binjai
                                                        @elseif ($d->jenis_catalog_id == 7)
                                                            Zevira Residence
                                                        @elseif ($d->jenis_catalog_id == 8)
                                                            Pesona Khayangan Delitua
                                                        @else
                                                            {{-- Tambahkan logika untuk nilai lainnya di sini --}}
                                                        @endif
                                                    </td>


                                                    <td nowrap="nowrap">


                                                        <form action="{{ route('lunnizom.destroy', $d->id) }}"
                                                            method="POST">
                                                            <a href="javascript:;"
                                                                class="btn btn-sm btn-info btn-icon edit_btn"
                                                                id="{{ $d->id }}" title=" Edit Data">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                            {{-- <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                                data-toggle="modal" data-target="#editModal"
                                                                data-sponsor-image="{{ asset('storage/' . $sponsor->image) }}">Edit</button> --}}

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
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form id="form2" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="editNama">Nama Produk</label>
                                            <input type="text" class="form-control" id="editNama" name="nama"
                                                placeholder="Masukkan nama produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editHarga">Harga Produk</label>
                                            <input type="text" class="form-control" id="editHarga" name="harga"
                                                placeholder="Masukkan harga produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDeskripsi">Deskripsi</label>
                                            <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="editJenisCatalog">Jenis Perumahan</label>
                                            <select class="form-control" id="editJenisCatalog" name="jenis_catalog_id"
                                                required>
                                                @foreach ($jenisCatalogs as $jenisCatalog)
                                                    <option value="{{ $jenisCatalog->id }}">{{ $jenisCatalog->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="dropzone dropzone-default dropzone-primary dz-clickable"
                                                id="editTeszone">
                                                <div class="dropzone-msg dz-message needsclick">
                                                    <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                                    <span class="dropzone-msg-desc">Upload up to 5 files</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                    <button type="Submit" name="Submit" id="editButton"
                                        class="btn btn-primary">Simpan</button>
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
                            var url = '{{ route('lunnizom.edit', ':id') }}';
                            url = url.replace(':id', sponsorId);

                            // Mengambil data sponsor berdasarkan ID menggunakan AJAX
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(response) {
                                    // Mengisi nilai pada form edit
                                    $('#form2').attr('action', '{{ route('lunnizom.update', ':id') }}'
                                        .replace(':id', sponsorId));
                                    $('#editNama').val(response.nama);
                                    $('#editHarga').val(response.harga);

                                    var cleanedData = response.deskripsi.replace(/<br\s*[\/]?>/gi, '');
                                    $('#editDeskripsi').val(cleanedData);
                                    console.log(cleanedData)
                                    $('#editJenisCatalog').val(response.jenis_catalog_id);

                                    $.ajax({
                                        url: '{{ route('catalog.fotos', ':id') }}'.replace(':id',
                                            response.id),
                                        type: 'GET',
                                        success: function(fotoResponse) {
                                            // Inisialisasi Dropzone dan tampilkan foto-foto yang sudah ada
                                            initDropzone(fotoResponse.fotos);
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(xhr.responseText);
                                        }
                                    });

                                    $('#editModal').modal('show');
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        });
                    });
                    $(function() {

                        const form1 = document.querySelector('#form1');
                        const submitButton = document.querySelector('#submitButton');

                        var fileInput = document.createElement("input");
                        fileInput.type = "file";
                        fileInput.name = "fotos[]";
                        fileInput.multiple = true;
                        form1.appendChild(fileInput);

                        var fotoList = [];

                        submitButton.addEventListener('click', function(event) {
                            event.preventDefault(); // mencegah form disubmit secara otomatis
                            // // cek apakah setiap file yang dipilih telah diunggah
                            var dataTransfer = new DataTransfer();
                            if (fotoList.length > 0) {
                                // submit form secara manual

                                fotoList.forEach(function(file) {
                                    dataTransfer.items.add(file);
                                });
                                fileInput.files = dataTransfer.files;
                                form1.submit();
                            } else {
                                alert('Harap pilih file terlebih dahulu');
                            }
                        });




                        var myDropzone = new Dropzone("#teszone", {
                            url: "{{ route('catalog.storeFoto') }}",
                            maxFilesize: 5, // MB
                            maxFiles: 5,
                            acceptedFiles: ".jpg,.jpeg,.png,.gif",
                            dictDefaultMessage: "Drag and drop foto here or click to upload",
                            dictRemoveFile: "Remove",
                            addRemoveLinks: true,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },

                            init: function() {
                                this.on("addedfile", function(file) {
                                    // tambahkan file ke dalam variabel fotos
                                    fotoList.push(file);
                                });
                                this.on("queuecomplete", function() {

                                });
                                this.on("success", function(file, response) {

                                });
                                this.on("removedfile", function(file) {
                                    // hapus file dari dalam variabel fotos
                                    var index = fotoList.indexOf(file);
                                    if (index !== -1) {
                                        fotoList.splice(index, 1);
                                    }
                                });


                            }
                        });





                    })

                    function initDropzone(fotos) {
                        var myEditDropzone = new Dropzone("#editTeszone", {
                            url: "{{ route('catalog.storeFoto') }}",
                            maxFilesize: 5, // MB
                            maxFiles: 5,
                            acceptedFiles: ".jpg,.jpeg,.png,.gif",
                            dictDefaultMessage: "Drag and drop foto here or click to upload",
                            dictRemoveFile: "Remove",
                            addRemoveLinks: true,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },

                            init: function() {
                                var fileInput2 = document.createElement("input");
                                fileInput2.type = "file";
                                fileInput2.name = "fotos[]";
                                fileInput2.multiple = true;
                                form2.appendChild(fileInput2);

                                var fotoList2 = [];


                                var submitButton2 = document.querySelector('#editButton');

                                submitButton2.addEventListener('click', function(event) {
                                    event.preventDefault();
                                    var dataTransfer = new DataTransfer();
                                    if (fotoList2.length > 0) {
                                        fotoList2.forEach(function(file) {
                                            if (file.id) {

                                            } else {
                                                dataTransfer.items.add(file);
                                            }

                                        });
                                        fileInput2.files = dataTransfer.files;
                                        form2.submit();
                                    } else {
                                        alert('Harap pilih file terlebih dahulu');
                                    }
                                });

                                this.on("addedfile", function(file) {
                                    console.log("added" + file)
                                    fotoList2.push(file);

                                });
                                this.on("removedfile", function(file) {
                                    var index = fotoList2.indexOf(file);
                                    if (index !== -1) {
                                        fotoList2.splice(index, 1);
                                    }

                                    if (file.id) {
                                        deleteFoto(file.id)
                                    }

                                });

                                // Tampilkan foto dari database
                                for (var i = 0; i < fotos.length; i++) {
                                    var foto = fotos[i];
                                    var mockFile = {
                                        id: foto.id,
                                        name: foto.name,
                                        size: foto.size,
                                        dataURL: "{{ asset('storage/catalog/') }}" + "/" + foto.path
                                    };
                                    this.emit("addedfile", mockFile);
                                    this.emit("thumbnail", mockFile, mockFile.dataURL);
                                    this.emit("complete", mockFile);
                                }



                            },

                        });
                    }

                    function deleteFoto(id) {
                        // Tampilkan konfirmasi sebelum menghapus
                        var confirmDelete = confirm("Apakah Anda yakin ingin menghapus foto ini?");

                        if (confirmDelete) {
                            // Panggil fungsi delete pada controller untuk menghapus foto dari database
                            $.ajax({
                                url: "{{ route('catalog.destroy', ':id') }}".replace(':id', id),
                                type: "DELETE",
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    console.log("Foto deleted");
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    }
                </script>
            @endsection
