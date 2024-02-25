<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tab }} | Perpustakaan SMA NU AL MA'RUF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">    
        <div class="row justify-content-center rounded">
            <div class="col-md-5">
        
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('status'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            
                <main class="form-signin w-200 m-auto">
                
                    <center><img class="mb-4" src="/assets/images/logo.png" alt="Logo" width="100" height="100"></center>
                    <h1 class="h3 mb-3 fw-bold" style="color: white;">Please Sign In</h1>
                
                    <form action="/login" method="post">
                        @csrf
                
                        <div class="form-floating">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                        <label for="floatingInput"> Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                
                        <div class="btn-container">
                            <button class="btn btn-primary w-50 py-2" type="submit">Sign in</button>
                        </div>  
                    </form>
                    <small style="color: white;">Not registered? <a href="/register" class="">Register Now</a></small>
                </main>
            </div>
        </div>
    </div>
        
</body>

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>