<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="row p-100">
        <div class="col-12">
            <p class="text-yfk fs-48 fw-700">Selamat<br>Datang!</p>
            <p class="text-danger">Masukkan nomor telpon<br>yang telah didaftarkan</p>
        </div>
        <div class="col-12 mt-3">
            <input id="email" type="text" class="form-control" placeholder="Email">
        </div>
        <div class="col-12 mt-3">
            <input id="password" type="password" class="form-control" placeholder="Password">
        </div>
        <div class="col-12 mt-3">
            <button onclick="login()" class="btn btn-yfk w-100">Login</button>
        </div>
        <div class="col-12 mt-3">
            <p class="mb-0 text-danger">Ada kendala silahkan hubungi admin</p>
        </div>
    </div>
</body>

</html>

<script>
    function login() {
        var object = {}

        $("input").each(function(index, value) {
            object[value.id] = $(value).val();
        });

        console.log(object.email);
        console.log(object.password);

        var tokenVal = $('meta[name="csrf-token"]').attr('content');
        var fd = new FormData();

        fd.append("_token", tokenVal);

        $.ajax({
            type: 'POST',
            url: '/login/' + object.email + '/' + object.password,
            data: fd,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            async: false,
            processData: false,
            success: function(response) {
                if (response == 2) {
                    window.location.href = "/home"
                } else {
                    alert("EMAIL ATAU PASSWORD SALAH!");
                }
            },
            error: function(error) {}
        });
    }
</script>