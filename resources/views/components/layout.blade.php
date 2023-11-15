<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{$title}}</title>
  <link rel="shortcut icon" href="logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="style.css">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="antialiased">
  <div class="container-fluid shadow-lg bg-light header">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">
            <a class="navbar-brand text-white px-3" href="/" style="background-color: #089207;"> <strong>FOCUS54 </strong>
            </a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="">Site Officiel </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Documentation </a>
                </li>
              </ul>
              <form class="d-flex" role="search">
                <img src="logo.png" width="100px" class="shadow-lg p-3 bg-body rounded" alt="" srcset="">
              </form>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- ####  CONTENU DE LA PAGE-->

  {{$slot}}

  <!-- END CONTENT -->


  <!-- ======= Footer ======= -->
  <div class="container-fluid bg-light shadow-lg py-3 footer fixed-bottom">
    <div class="row">
      <div class="col-md-12">
        <p class="text-dark text-center">© Copyright 2023 - Développé par <strong style="font-style: italic;">HSMC</strong> </p>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</html>