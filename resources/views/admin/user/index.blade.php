@extends('layouts.admin.master', ['title' => 'Admin - Permission'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card-action title="Daftar User" url="{{ route('admin.permission.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Role</th>
                            <th>Special</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $i => $user)
                            <tr>
                                <td>{{ $i + $users->firstItem() }}</td>
                                <td>{{ $user->nik }}</td>
                                <td>{{ $user->karyawan->nama }}</td>
                                <td>{{ $user->roles[0]->name }}</td>
                                <td>
                                    {{-- <x-button-modal id="{{ $permission->id }}" title="Ubah Data" />
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
                                        url="{{ route('admin.permission.destroy', $permission->id) }}" /> --}}
                                      </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
            <div class="d-flex justify-content-end">{{ $users->links(("pagination::bootstrap-4")) }}</div>
        </div>
        <div class="col-12 col-lg-4">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <x-card title="Tambah User" class="card-body">
                    <x-select title="Karyawan" name="id_kary">
                        <option value="" selected>Pilih karyawan</option>
                        @foreach ($karyawan as $kar)
                            <option value="{{ $kar->id }}" @selected(old('karyawan') == $kar->id)>
                                {{$kar->nik_karyawan}} - {{ $kar->nama }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input title="password" name="password" type="password" placeholder=""
                        value="" />
                    <x-input title="Password Confirmation" name="password_confirmation" type="password" placeholder=""
                    value="" />
                    <x-select title="Roles" name="roles">
                        <option value="" selected>Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('karyawan') == $role->id)>
                               {{ $role->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <div class="mt-3 special-approve" style="display: none">
                        <label class="switch">
                            <input type="checkbox" name="special_approve" value="true">
                            <span class="slider round">Has Special Approve</span>
                        </label>
                    </div>
                    <x-button-save title="Simpan" class="mt-3"/>
                </x-card>
            </form>
        </div>
    </x-container>
@endsection
@push('js')
    <script>
            $('select[name=roles]').on('change', function(event){
                if($('select[name=roles]').val() == 3){
                    $('.special-approve').css("display", "block");
                }else{
                    $('.special-approve').css("display", "none");
                }
            });
    </script>
@endpush