<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Redaktur</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap @5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Dashboard Reporter</h4>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="text-success">Anda berhasil login sebagai Reporter</h5>
                        <p>Selamat datang di sistem manajemen konten.</p>

                        <!-- Form Logout -->
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg mt-3">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, untuk interaksi lanjut) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap @5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>