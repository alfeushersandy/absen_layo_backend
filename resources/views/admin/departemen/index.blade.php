@extends('layouts.admin.master', ['title' => 'Admin - Departemen'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Departemen" url="{{ route('admin.departemen.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Departemen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departemens as $i => $departemen)
                            <tr>
                                <td>{{ $i + $departemens->firstItem() }}</td>
                                <td>{{ $departemen->nama_dept }}</td>
                                <td>
                                    <x-button-modal id="{{ $departemen->id }}" title="Ubah Data" />
                                        <x-modal id="{{ $departemen->id }}" title="Ubah Data">
                                          <form action="{{ route('admin.departemen.update', $departemen->id) }}"
                                          method="POST">
                                            @csrf
                                            @method('PUT')
                                              <x-input title="Nama Departemen" name="nama_dept" type="text"
                                              placeholder="Masukan Nama Departemen" value="{{ $departemen->nama_dept }}" />
                                              <x-button-save title="Simpan" />
                                          </form>
                                        </x-modal>
                                        <x-button-delete id="{{ $departemen->id }}" title="Hapus Data"
                                            url="{{ route('admin.departemen.destroy', $departemen->id) }}" />
                                      </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $departemens->links(("pagination::bootstrap-4")) }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <form action="{{ route('admin.departemen.store') }}" method="POST">
                @csrf
                <x-card title="Tambah Departemen" class="card-body">
                    <x-input title="Nama Departemen" name="nama_dept" type="text" placeholder="Masukan Nama departemen"
                        value="{{ old('name') }}" />
                    <x-button-save title="Simpan" />
                </x-card>
            </form>
        </div>
    </x-container>
@endsection