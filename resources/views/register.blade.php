<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $tab }} | Perpustakaan SMA NU AL MA'RUF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container mt-4">
        <div class="row justify-content-center rounded">
            <div class="col-md-5">

                <main class="form-signin w-200 m-auto">
                <center><img class="mb-4" src="/assets/images/logo.png" alt="Logo" width="100" height="100"></center>
                <h1 class="h3 mb-3 fw-bold" style="color: white;">Registration Form</h1>
                
                <form action="/register" method="post">
                    @csrf
                    <div class="form-floating">
                    <input type="text" name="username" class="form-control @error('name')is-invalid @enderror" id="floatingInput" placeholder="Username" required value="{{old('username')}}">
                    <label for="floatingInput">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" id="floatingPassword" placeholder="Password" required value="{{old('password')}}">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" id="floatingInput" placeholder="Nama" required value="{{old('name')}}">
                    <label for="floatingInput">Nama</label>
                    @error('name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="text" name="phone" class="form-control @error('phone')is-invalid @enderror" id="floatingInput" placeholder="HP" required value="{{old('phone')}}">
                    <label for="floatingInput">HP</label>
                    @error('phone')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-floating">
                    <input type="text" name="address" class="form-control @error('address')is-invalid @enderror" id="floatingInput" placeholder="Alamat" required value="{{old('address')}}">
                    <label for="floatingInput">Alamat</label>
                    @error('address')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="btn-container">
                        <button class="btn btn-primary w-50 py-2" type="submit">Register</button>
                    </div>
                </form>
                <small style="color: white;">Already have an account? <a href="/" class="">Login</a></small>
                </main>

            </div>
        </div>
    </div>

    <style>
    .btn-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px; /* Jarak antara tombol dan elemen lainnya */
    }

    body{
        height: 100vh; /* Mengatur tinggi body 100% dari tinggi viewport */
        margin: 0; /* Menghapus margin default dari body */
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('/assets/images/background.jpeg'); /* Ganti '/path/to/your/image.jpg' dengan path gambar background Anda */
        background-size: cover; /* Mengatur gambar background agar menutupi seluruh area body */
        background-position: center; /* Mengatur posisi gambar background ke tengah */
    }

    .form-signin{
        border-top: 50%;
        padding: 20px;
        backdrop-filter: blur(20px);
    }

    form div{
        margin-bottom: 20px;
    }
</style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
