@extends('layouts.auth.master', ['title' => 'Login - Layo - absen'])

@section('content')
    <div class="py-15">
        <img src="{{asset('layo.png')}}" alt="">
    </div>
    <form class="card card-md border-0 rounded-3" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="card-body">
            <h3 class="text-center mb-3 font-weight-medium">
                Login
            </h3>
            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control @error('nik') is-invalid @enderror"
                placeholder="masukan nik anda" name="nik" maxlength="5" pattern="\d*">
                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Kata Sandi</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="masukan kata sandi anda" name="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
        </div>
    </form>
@endsection