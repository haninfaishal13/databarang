@extends('_layout.main')
@section('title-user')
<title>Welcome</title>
@endsection

@section('content-user')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h4>Daftar Barang</h4>
            </div>
            <div class="col-sm-6">
                <div class="d-flex justify-content-end">
                    Tampilan:
                    <button class="btn btn-primary btn-sm mx-2" id="table">Tabel</button>
                    <button class="btn btn-primary btn-sm" id="icon">Icon</button>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" id="modal-tambah-barang">Tambah Barang</button>
        <div class="mt-3">
            Tampilkan:
            <select id="show_data">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="10">10</option>
            </select>
        </div>
        <section class="mt-3 d-none" id="tb-barang">
            <table class="table table-bordered table-striped text-center d-none d-lg-table">
                <thead>
                    <th style="width: 1%;">No</th>
                    <th>Id</th>
                    <th>Kode barang</th>
                    <th>Nama Barang</th>
                    <th style="width: 30%;">Deskripsi</th>
                    <th style="width: 15%">#</th>
                </thead>
                <tbody id="tb-content">
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6" id="tb-total-entry"></div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end" id="tb-paginate"></div>
                </div>
            </div>
        </section>

        <section class="mt-3" id="icon-barang">
            <div class="row" id="icon-content">
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-end" id="icon-paginate"></div>
                </div>
            </div>
        </section>

    </div>

    @include('barang.modal')
@endsection

@section('scripts-user')
<script src="{{asset('assets/js/barang.js')}}"></script>
@endsection
