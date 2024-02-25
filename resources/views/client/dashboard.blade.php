@extends('partials.main')

@section('container')

<div class="container-fluid">
    <div class="row">
        
        <h3 class="text-center" style="background-color: #55595c; color: #ffffff; height: 3rem; padding: 5px; margin-top: 1.5rem;">
        Selamat Datang
        @if (Auth::check())
            {{ Auth::user()->username }}
        @endif
        </h3>

        @if(Auth::check() && Auth::user()->status == 'inactive')
            <div class="alert alert-warning" role="alert">
                Akun Anda sedang tidak aktif. Silakan konfirmasi ke admin perpustakaan.
            </div>
        @endif

    </div>
</div>

@endsection
