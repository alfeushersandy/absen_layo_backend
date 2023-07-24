@extends('layouts.admin.master', ['title' => 'Daftar Izin'])

@section('content')
    <x-container>
        <div>
            <x-button-modal id="" title="Input Ijin" class="mb-3 btn-warning"/>
                <x-modal id="" title="Input Ijin/Cuti">
                  <form action=" {{ route('admin.absens.store') }} "
                  method="POST">
                    @csrf
                    <x-select title="Karyawan" name="id_kary">
                        <option value="" selected>Pilih Karyawan</option>
                        @foreach ($karyawan as $kar)
                            <option value="{{ $kar->id }}" @selected(old('karyawan_id') == $kar->id)>
                                {{ $kar->nik_karyawan }} - {{ $kar->nama }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-select title="Jenis Izin" name="abs_id" data-live-search="true">
                        <option value="" selected>Pilih Jenis Izin</option>
                        @foreach ($absen as $abs)
                            <option value="{{ $abs->id }}" @selected(old('abs_id') == $abs->id)>
                                {{ $abs->nama_abs }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input title="Tanggal Ijin" name="tanggal_awal" type="date" placeholder="Masukan tanggal awal ijin"
                    value=""/>
                    <x-input title="Sampai Dengan" name="tanggal_akhir" type="date" placeholder="Masukan tanggal akhir ijin"
                    value="" />
                    <x-textarea title="Keterangan" name="keterangan" placeholder="Masukan keterangan" />
                    <x-button-save title="Simpan" />
                  </form>
                </x-modal>
            <x-card-action title="Daftar Ijin" url="{{ route('admin.absens.index') }}">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Ijin</th>
                            <th>Tgl Ijin</th>
                            <th>Sampai dengan</th>
                            <th>Jumlah Hari</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izin as $i => $ijin)
                            <tr>
                                <td>{{$i + $izin->firstItem()}}</td>
                                <td>{{$ijin->karyawan[0]->nik_karyawan}}</td>
                                <td>{{$ijin->karyawan[0]->nama}}</td>
                                <td>{{$ijin->jenisAbsen[0]->nama_abs}}</td>
                                <td>{{$ijin->tanggal_awal}}</td>
                                <td>{{$ijin->tanggal_akhir}}</td>
                                <td>{{$ijin->jumlah_hari}}</td>
                                <td>{{$ijin->status}}</td>
                                <td>{{$ijin->keterangan}}</td>
                                <td>
                                    @if ($ijin->status == "Submitted")
                                    @can('absen.approve')
                                    <a href="{{route('admin.absens.approve', $ijin->id)}}" class="btn btn-success btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-ipad-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v8"></path>
                                            <path d="M9 18h2"></path>
                                            <path d="M15 19l2 2l4 -4"></path>
                                         </svg>
                                         Approve
                                    </a> 
                                    <a href="{{route('admin.absens.approve', $ijin->id)}}" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-ipad-horizontal-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M13.5 20h-8.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7"></path>
                                            <path d="M22 22l-5 -5"></path>
                                            <path d="M17 22l5 -5"></path>
                                            <path d="M9 17h4"></path>
                                         </svg>
                                         Reject
                                    </a>                                          
                                    @endcan
                                    @else
                                    <a href="{{route('admin.absens.approve', $ijin->id)}}" class="btn btn-info btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                            <path d="M21 21l-6 -6"></path>
                                            <path d="M7 10l2 2l4 -4"></path>
                                         </svg>
                                         Verify
                                    </a>   
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card-action>
        </div>
    </x-container>
@endsection