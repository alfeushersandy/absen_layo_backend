@extends('layouts.admin.master', ['title' => 'Daftar Izin'])

@section('content')
    <x-container>
        <div>
            @can('absen.upload')
                <x-button-modal id="import1" title="Import File" class="mb-3"/>
                        <x-modal id="import1" title="Import File">
                        <form action="{{ route('admin.check.import') }}"
                        method="POST" enctype="multipart/form-data">
                            @csrf
                            <x-input title="Import File" name="file" type="file"
                            placeholder="" value=""/>
                            <x-button-save title="Upload" />
                        </form>
                        </x-modal>
            @endcan
            <x-card-action title="Daftar Check Clock" url="">
                @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @elseif($message =  Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @endif
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Scan 1</th>
                            <th>Scan 2</th>
                            <th>Scan 3</th>
                            <th>Scan 4</th>
                            <th>Scan 5</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($check as $i => $item)
                            <tr>
                                <td>{{$i + $check->firstItem()}}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tanggal))}}</td>
                                <td>{{$item->nik}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->scan_1}}</td>
                                <td>{{$item->scan_2}}</td>
                                <td>{{$item->scan_3}}</td>
                                <td>{{$item->scan_4}}</td>
                                <td>{{$item->scan_5}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td>aksi</td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $check->links('vendor.pagination.bootstrap-5') }}
                </div>
            </x-card-action>
        </div>
    </x-container>
@endsection