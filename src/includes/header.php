<!DOCTYPE html>

<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Decentralized Insurance</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/mystyle.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/spa.css">
    <!-- <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script> -->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>

    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.8/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.7.8/dist/umd/index.min.js">
    </script>
    </script>
    <script type="module" src="js/convertAPI.js"></script>
    <script type="module" src="js/convertAPIClaim.js"></script>
    <script src="js/spa.js"></script>





    <!-- Font Awesome -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->


    </script>
    <script src="https://kit.fontawesome.com/28c758b0c9.js" crossorigin="anonymous"></script>
    <!-- MDB -->






</head>
<!-- body -->

<body class="main-layout">
    <!-- header -->
    <header>
        <div class="head_top">
            <div class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a onclick="homeNav()"><img src="images/logo.png" alt="#"
                                                class="pointcursor" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark ">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarsExample04" aria-controls="navbarsExample04"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a onclick="homeNav()" class="nav-link pointcursor">HOME</a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="userLoginOut();logOutNav()" id="buttonText2"
                                                class="nav-link pointcursor">LOG IN</a>
                                        </li>
                                        <li class="nav-item text-warning h2">
                                            This is only a test project for my Master's Thesis.
                                        </li>
                                    </ul>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>