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
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div>
                            @include('alert')
                        </div>
                        <div class="container">

                            <div class="card card-custom">
                                <div class="card-header flex-wrap py-5">
                                    <div class="card-title">
                                        <h3 class="card-label">List User
                                            <span class="text-muted pt-2 font-size-sm d-block"></span>
                                        </h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <!--begin::Dropdown-->

                                        <!--end::Dropdown-->
                                        <!--begin::Button-->

                                        <!--end::Button-->

                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--begin: Datatable-->
                                    <table class="table table-bordered table-checkable" id="kt_datatable2">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No Hp</th>

                                                <th>Aksi</th>


                                            </tr>
                                        </thead>
                                        <tbody>


                                            @php
                                                $nomor = 1;
                                            @endphp
                                            @foreach ($user as $d)
                                                <tr id="tr{{ $d->id }}">
                                                    <td style=" width:5%">{{ $nomor }}</td>

                                                    <td>{{ $d->nama }}</td>
                                                    <td>{{ $d->email }}</td>
                                                    <td>{{ $d->nohp }}</td>

                                                    <td nowrap="nowrap">


                                                        <a href="javascript:;" class="btn btn-sm btn-info btn-icon edit_btn"
                                                            id="{{ $d->id }}" title=" Edit Data">
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
