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
                                <td>{{$ijin->karyawan->nik_karyawan}}</td>
                                <td>{{$ijin->karyawan->nama}}</td>
                                <td>{{$ijin->jenisAbsen->nama_abs}}</td>
                                <td>{{$ijin->tanggal_awal}}</td>
                                <td>{{$ijin->tanggal_akhir}}</td>
                                <td>{{$ijin->jumlah_hari}}</td>
                                @if ($ijin->status == "Pending")
                                <td><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-gravatar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5.64 5.632a9 9 0 1 0 6.36 -2.632v7.714"></path>
                                 </svg> Pending </td>
                                @elseif ($ijin->status == "Approved")
                                <td><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-check-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="black" fill="success" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 2c-.218 0 -.432 .002 -.642 .005l-.616 .017l-.299 .013l-.579 .034l-.553 .046c-4.785 .464 -6.732 2.411 -7.196 7.196l-.046 .553l-.034 .579c-.005 .098 -.01 .198 -.013 .299l-.017 .616l-.004 .318l-.001 .324c0 .218 .002 .432 .005 .642l.017 .616l.013 .299l.034 .579l.046 .553c.464 4.785 2.411 6.732 7.196 7.196l.553 .046l.579 .034c.098 .005 .198 .01 .299 .013l.616 .017l.642 .005l.642 -.005l.616 -.017l.299 -.013l.579 -.034l.553 -.046c4.785 -.464 6.732 -2.411 7.196 -7.196l.046 -.553l.034 -.579c.005 -.098 .01 -.198 .013 -.299l.017 -.616l.005 -.642l-.005 -.642l-.017 -.616l-.013 -.299l-.034 -.579l-.046 -.553c-.464 -4.785 -2.411 -6.732 -7.196 -7.196l-.553 -.046l-.579 -.034a28.058 28.058 0 0 0 -.299 -.013l-.616 -.017l-.318 -.004l-.324 -.001zm2.293 7.293a1 1 0 0 1 1.497 1.32l-.083 .094l-4 4a1 1 0 0 1 -1.32 .083l-.094 -.083l-2 -2a1 1 0 0 1 1.32 -1.497l.094 .083l1.293 1.292l3.293 -3.292z" fill="currentColor" stroke-width="0"></path>
                                 </svg> Approved </td>
                                 @else 
                                 <td><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="black" fill="red" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                    <path d="M5.7 5.7l12.6 12.6"></path>
                                 </svg> Rejected </td>
                                @endif
                                <td>{{$ijin->keterangan}}</td>
                                <td width="58px">
                                    @if ($ijin->status == "Pending")
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
                                    <a href="{{route('admin.absens.reject', $ijin->id)}}" class="btn btn-danger btn-sm">
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
                                    @elseif ($ijin->status == "Rejected")
                                    <a href="{{route('admin.absens.approve', $ijin->id)}}" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                            <path d="M21 21l-6 -6"></path>
                                            <path d="M7 10l2 2l4 -4"></path>
                                         </svg>
                                         Verify
                                    </a>   
                                    @else
                                    @hasanyrole('admin|super-admin')
                                    <a href="{{route('admin.absens.approve', $ijin->id)}}" class="btn btn-info btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                            <path d="M21 21l-6 -6"></path>
                                            <path d="M7 10l2 2l4 -4"></path>
                                         </svg>
                                         Verify
                                    </a> 
                                    @endhasanyrole  
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