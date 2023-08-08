@extends('layouts.admin.master', ['title' => 'Master Karyawan'])

@section('content')
    <x-container>
        <div class="col-12">
            @can('karyawan.create')
                <a href="{{ route('admin.karyawans.create') }}" class="btn btn-dark mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                        <line x1="9" y1="12" x2="15" y2="12"></line>
                        <line x1="12" y1="9" x2="12" y2="15"></line>
                    </svg>
                    Tambah Data Karyawan
                </a>
            @endcan
            <x-card-action title="Daftar Karyawan" url="{{ route('admin.karyawans.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Departemen</th>
                            <th>Section</th>
                            <th>Jabatan</th>
                            <th>Aproval</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $i => $karyawan)
                            <tr>
                                <td>{{ $i + $karyawans->firstItem() }}</td>
                                <td>{{ $karyawan->nik_karyawan }}</td>
                                <td>{{ $karyawan->nama }}</td>
                                <td>{{ $karyawan->departemen->nama_dept }}</td>
                                <td>{{ $karyawan->section}}</td>
                                <td>{{ $karyawan->jabatan}}</td>
                                <td>{{ $karyawan->user ? $karyawan->user->nik . " | " .  $karyawan->user->karyawan->nama : '' }}</td>
                                <td>
                                        @can('karyawan.edit')
                                        <a href="{{ route('admin.karyawans.edit', $karyawan->id) }}"
                                            class="btn btn-info btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                </path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                            Ubah Data
                                        </a>
                                    @endcan
                                    @can('karyawan.delete')
                                        <x-button-delete id="{{ $karyawan->id }}" title="Hapus Data"
                                            url="{{ route('admin.karyawans.destroy', $karyawan->id) }}" />  
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $karyawans->links('vendor.pagination.bootstrap-5') }}</div>
        </div>
    </x-container>
@endsection