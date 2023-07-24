@extends('layouts.admin.master', ['title' => 'Admin - Permission'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar Permission" url="{{ route('admin.permission.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Perizinan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $i => $permission)
                            <tr>
                                <td>{{ $i + $permissions->firstItem() }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <x-button-modal id="{{ $permission->id }}" title="Ubah Data" />
                                        <x-modal id="{{ $permission->id }}" title="Ubah Data">
                                          <form action="{{ route('admin.permission.update', $permission->id) }}"
                                          method="POST">
                                            @csrf
                                            @method('PUT')
                                              <x-input title="Nama Permission" name="name" type="text"
                                              placeholder="Masukan Nama Permission" value="{{ $permission->name }}" />
                                              <x-button-save title="Simpan" />
                                          </form>
                                        </x-modal>
                                    <x-button-delete id="{{ $permission->id }}" title="Hapus Data"
                                        url="{{ route('admin.permission.destroy', $permission->id) }}" />
                                      </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $permissions->links(("pagination::bootstrap-4")) }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf
                <x-card title="Tambah Permission" class="card-body">
                    <x-input title="Nama permission" name="name" type="text" placeholder="Masukan Nama permission"
                        value="{{ old('name') }}" />
                    <x-button-save title="Simpan" />
                </x-card>
            </form>
        </div>
    </x-container>
@endsection