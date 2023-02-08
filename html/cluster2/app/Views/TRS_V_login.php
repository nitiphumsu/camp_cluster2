<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Camp Project</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="signin.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <style>
        body {
            background-color: #333F4C;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .container-sm {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }

        .container-sm .form-control {
            border-radius: 20px;
            width: 300px;
        }

        .container-sm .bth_login {
            font-weight: bold;
            font-size: 15px;
            border-radius: 10px;
            width: 100px;
        }
    </style>
</head>

<body class="text-center">
    <div class="container-sm">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-sm-6 " style="background-color: white;padding: 25px; border-radius: 25px; -webkit-box-shadow: 8px 5px 6px 2px rgba(0,0,0,0.71); 
box-shadow: 8px 5px 6px 2px rgba(0,0,0,0.71);">
                    <main class="form-signin d-flex justify-content-center">
                        <form method="post" action="<?php echo base_url() . '/check_login'; ?>" enctype="multipart/form-data">
                            <img class=" mb-2" src="<?php echo base_url() . '/img/logo.png' ?>" width="200" height="200">
                            <div align="center" style="color:#EE3F4C; font-size:50px;"><b>Clicknext</b></div>
                            <div align="center" style="color:#b9b5b4;"><b>Acceleration of growth</b></div><br>
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput"> <i class="fa-solid fa-user"></i> &nbsp;&nbsp;&nbsp; Email</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword"> <i class="fa-solid fa-lock"></i> &nbsp;&nbsp;&nbsp; Password</label>
                            </div>
                            <br>
                            <button class="bth_login btn btn-lg btn-danger" type="submit">LOGIN</button>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>


</html>