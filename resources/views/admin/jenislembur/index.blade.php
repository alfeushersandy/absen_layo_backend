@extends('layouts.admin.master', ['title' => 'Admin - Jenis Izin'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Jenis lembur" url="{{ route('admin.jenislembur.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lembur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenislembur as $i => $lembur)
                            <tr>
                                <td>{{ $i + $jenislembur->firstItem() }}</td>
                                <td>{{ $lembur->jenis_lembur }}</td>
                                <td>
                                    <x-button-modal id="{{ $lembur->id }}" title="Ubah Data" />
                                        <x-modal id="{{ $lembur->id }}" title="Ubah Data">
                                          <form action="{{ route('admin.jenislembur.update', $lembur->id) }}"
                                          method="POST">
                                            @csrf
                                            @method('PUT')
                                              <x-input title="Jenis Lembur" name="jenis_lembur" type="text"
                                              placeholder="Masukan Jenis Lembur" value="{{ $lembur->jenis_lembur }}" />
                                              <x-button-save title="Simpan" />
                                          </form>
                                        </x-modal>
                                    <x-button-delete id="{{ $lembur->id }}" title="Hapus Data"
                                        url="{{ route('admin.jenislembur.destroy', $lembur->id) }}" />
                                      </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $jenislembur->links(("pagination::bootstrap-4")) }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <form action="{{ route('admin.jenislembur.store') }}" method="POST">
                @csrf
                <x-card title="Tambah Jenis Lembur" class="card-body">
                    <x-input title="Jenis Lembur" name="jenis_lembur" type="text" placeholder="Masukan Jenis Lembur"
                        value="{{ old('jenis_lembur') }}" />
                    <x-button-save title="Simpan" />
                </x-card>
            </form>
        </div>
    </x-container>
@endsection