@extends('layouts.admin.master', ['title' => 'Admin - Jenis Izin'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Jenis Ijin" url="{{ route('admin.jenisizin.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Ijin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenisizin as $i => $izin)
                            <tr>
                                <td>{{ $i + $jenisizin->firstItem() }}</td>
                                <td>{{ $izin->nama_izin }}</td>
                                <td>
                                    <x-button-modal id="{{ $izin->id }}" title="Ubah Data" />
                                        <x-modal id="{{ $izin->id }}" title="Ubah Data">
                                          <form action="{{ route('admin.jenisizin.update', $izin->id) }}"
                                          method="POST">
                                            @csrf
                                            @method('PUT')
                                              <x-input title="Nama Ijin" name="nama_izin" type="text"
                                              placeholder="Masukan Nama Ijin" value="{{ $izin->nama_izin }}" />
                                              <x-button-save title="Simpan" />
                                          </form>
                                        </x-modal>
                                    <x-button-delete id="{{ $izin->id }}" title="Hapus Data"
                                        url="{{ route('admin.jenisizin.destroy', $izin->id) }}" />
                                      </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $jenisizin->links(("pagination::bootstrap-4")) }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <form action="{{ route('admin.jenisizin.store') }}" method="POST">
                @csrf
                <x-card title="Tambah Jenis Ijin" class="card-body">
                    <x-input title="Nama ijin" name="nama_izin" type="text" placeholder="Masukan Nama Izin"
                        value="{{ old('name_izin') }}" />
                    <x-button-save title="Simpan" />
                </x-card>
            </form>
        </div>
    </x-container>
@endsection