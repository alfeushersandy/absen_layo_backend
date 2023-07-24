@extends('layouts.admin.master', ['title' => 'Tambah Karyawan'])

@section('content')
    <x-container>
        <div class="col-md-8">
            <x-card title="Tambah Ijin/Cuti" class="card-body">
                <form action=" {{ route('admin.absens.store') }} "
                  method="POST">
                    @csrf
                    <x-select title="Karyawan" name="id_kary">
                        <option value="" selected>Pilih Karyawan</option>
                        @foreach ($karyawan as $kar)
                            <option value="{{ $kar->id }}">
                                {{ $kar->nik_karyawan }} - {{ $kar->nama }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-select title="Jenis Izin" name="abs_id" data-live-search="true">
                        <option value="" selected>Pilih Jenis Izin</option>
                        @foreach ($izin as $zin)
                            <option value="{{ $zin->id }}">
                                {{ $zin->nama_abs }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input title="Tanggal Ijin" name="tanggal_awal" type="date" placeholder="Masukan tanggal awal ijin"
                    value=""/>
                    <x-input title="Sampai Dengan" name="tanggal_akhir" type="date" placeholder="Masukan tanggal akhir ijin"
                    value=""/>
                    <x-textarea title="Keterangan" name="keterangan" placeholder="Masukan keterangan" />
                    <a href="{{ route('admin.absens.index') }}" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="11 7 6 12 11 17"></polyline>
                            <polyline points="17 7 12 12 17 17"></polyline>
                        </svg> Kembali
                    </a>
                    <x-button-save title="Simpan" />
                  </form>
            </x-card>
        </div>
    </x-container>
@endsection