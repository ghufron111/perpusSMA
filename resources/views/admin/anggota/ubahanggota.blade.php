@extends('partials.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Data Anggota</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <form method="post" action="/anggota/ubah/{{ $users->id }}" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $users->username }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="{{ $users->password }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="longtext" class="form-control" id="address" name="address" value="{{ $users->address }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">HP</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{ $users->phone }}" pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
            </div>

            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection