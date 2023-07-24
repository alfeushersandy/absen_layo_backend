@extends('layouts.admin.master', ['title' => 'Admin - Jenis Absen'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Jenis Absen" url="{{ route('admin.jenisabsen.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Absen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenisabsen as $i => $absen)
                            <tr>
                                <td>{{ $i + $jenisabsen->firstItem() }}</td>
                                <td>{{ $absen->nama_abs }}</td>
                                <td>
                                    <x-button-modal id="{{ $absen->id }}" title="Ubah Data" />
                                        <x-modal id="{{ $absen->id }}" title="Ubah Data">
                                          <form action="{{ route('admin.jenisabsen.update', $absen->id) }}"
                                          method="POST">
                                            @csrf
                                            @method('PUT')
                                              <x-input title="Nama Absen" name="nama_abs" type="text"
                                              placeholder="Masukan Nama Absen" value="{{ $absen->nama_abs }}" />
                                              <x-button-save title="Simpan" />
                                          </form>
                                        </x-modal>
                                    <x-button-delete id="{{ $absen->id }}" title="Hapus Data"
                                        url="{{ route('admin.jenisabsen.destroy', $absen->id) }}" />
                                      </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $jenisabsen->links(("pagination::bootstrap-4")) }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <form action="{{ route('admin.jenisabsen.store') }}" method="POST">
                @csrf
                <x-card title="Tambah Jenis Absen" class="card-body">
                    <x-input title="Nama Absen" name="nama_abs" type="text" placeholder="Masukan Nama Absen"
                        value="{{ old('nama_abs') }}" />
                    <x-button-save title="Simpan" />
                </x-card>
            </form>
        </div>
    </x-container>
@endsection