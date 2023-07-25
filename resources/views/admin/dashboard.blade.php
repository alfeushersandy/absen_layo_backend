@extends('layouts.admin.master', ['title' => 'Dashboard'])

@section('content')
    <x-container>
        @can('dashboard.izin')
            <p>Ijin</p>
            <div class="col-6 col-lg-3">
                <x-widget title="Request" subtitle="{{ $request }}" class="bg-azure">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category-2" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 4h6v6h-6z"></path>
                        <path d="M4 14h6v6h-6z"></path>
                        <circle cx="17" cy="17" r="3"></circle>
                        <circle cx="7" cy="7" r="3"></circle>
                    </svg>
                </x-widget>
            </div>
            <div class="col-6 col-lg-3">
                <x-widget title="Pending" subtitle="{{ $pending }}" class="bg-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 6l0 -3"></path>
                        <path d="M16.25 7.75l2.15 -2.15"></path>
                        <path d="M18 12l3 0"></path>
                        <path d="M16.25 16.25l2.15 2.15"></path>
                        <path d="M12 18l0 3"></path>
                        <path d="M7.75 16.25l-2.15 2.15"></path>
                        <path d="M6 12l-3 0"></path>
                        <path d="M7.75 7.75l-2.15 -2.15"></path>
                    </svg>
                </x-widget>
            </div>
            <div class="col-6 col-lg-3">
                <x-widget title="Approved" subtitle="{{ $approve }}" class="bg-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                </x-widget>
            </div>
            <div class="col-6 col-lg-3">
                <x-widget title="Rejected" subtitle="{{ $reject }}" class="bg-red">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18 6l-12 12"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </x-widget>
            </div>
        @endcan
        @can('dashboard.absen')
            <p>Absen</p>
            <div class="col-6 col-lg-3">
                <x-widget title="Request" subtitle="" class="bg-azure">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category-2" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 4h6v6h-6z"></path>
                        <path d="M4 14h6v6h-6z"></path>
                        <circle cx="17" cy="17" r="3"></circle>
                        <circle cx="7" cy="7" r="3"></circle>
                    </svg>
                </x-widget>
            </div>
            <div class="col-6 col-lg-3">
                <x-widget title="Pending" subtitle="" class="bg-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 6l0 -3"></path>
                        <path d="M16.25 7.75l2.15 -2.15"></path>
                        <path d="M18 12l3 0"></path>
                        <path d="M16.25 16.25l2.15 2.15"></path>
                        <path d="M12 18l0 3"></path>
                        <path d="M7.75 16.25l-2.15 2.15"></path>
                        <path d="M6 12l-3 0"></path>
                        <path d="M7.75 7.75l-2.15 -2.15"></path>
                    </svg>
                </x-widget>
            </div>
            <div class="col-6 col-lg-3">
                <x-widget title="Approved" subtitle="" class="bg-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                </x-widget>
            </div>
            <div class="col-6 col-lg-3">
                <x-widget title="Rejected" subtitle="" class="bg-red">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18 6l-12 12"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </x-widget>
            </div>            
        @endcan
        <p>Lembur</p>
        <div class="col-6 col-lg-3">
            <x-widget title="Request" subtitle="" class="bg-azure">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category-2" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 4h6v6h-6z"></path>
                    <path d="M4 14h6v6h-6z"></path>
                    <circle cx="17" cy="17" r="3"></circle>
                    <circle cx="7" cy="7" r="3"></circle>
                </svg>
            </x-widget>
        </div>
        <div class="col-6 col-lg-3">
            <x-widget title="Pending" subtitle="" class="bg-info">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 6l0 -3"></path>
                    <path d="M16.25 7.75l2.15 -2.15"></path>
                    <path d="M18 12l3 0"></path>
                    <path d="M16.25 16.25l2.15 2.15"></path>
                    <path d="M12 18l0 3"></path>
                    <path d="M7.75 16.25l-2.15 2.15"></path>
                    <path d="M6 12l-3 0"></path>
                    <path d="M7.75 7.75l-2.15 -2.15"></path>
                 </svg>
            </x-widget>
        </div>
        <div class="col-6 col-lg-3">
            <x-widget title="Approved" subtitle="" class="bg-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                 </svg>
            </x-widget>
        </div>
        <div class="col-6 col-lg-3">
            <x-widget title="Rejected" subtitle="" class="bg-red">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M18 6l-12 12"></path>
                    <path d="M6 6l12 12"></path>
                 </svg>
            </x-widget>
        </div>
    </x-container>
@endsection