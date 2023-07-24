@extends('layouts.admin.master', ['title' => 'Tambah Karyawan'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card title="Tambah Karyawan" class="card-body">
                <form action="{{ route('admin.karyawans.update', $karyawan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <x-input title="NIK" name="nik_karyawan" type="text" placeholder="Masukan NIK Karyawan"
                                value="{{ $karyawan->nik_karyawan }}" />
                        </div>
                        <div class="col-6">
                            <x-input title="Nama" name="nama" type="text" placeholder="Masukan Nama Karyawan"
                                value="{{ $karyawan->nama }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <x-input title="Tanggal Join" name="tanggal_join" type="date" placeholder=""
                                value="{{ $karyawan->tanggal_join }}" />
                        </div>
                        <div class="col-6">
                            <x-select title="Departemen" name="departemen_id">
                                <option value="" selected>Pilih Departemen</option>
                                @foreach ($dept as $departemen)
                                    <option value="{{ $departemen->id }}" @selected($karyawan->departemen_id == $departemen->id)>
                                        {{ $departemen->nama_dept }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-select title="User Approve" name="user_approve">
                                <option value="" selected>Pilih User Approve</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected($karyawan->user_appr == $user->id)>
                                        {{$user->nik}} - {{ $user->karyawan->nama }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <a href="{{ route('admin.karyawans.index') }}" class="btn btn-danger">
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