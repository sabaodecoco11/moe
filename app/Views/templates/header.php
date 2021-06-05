<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<?php
$uri = service('uri');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">MOE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (session()->get('isLoggedIn')): ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
                        <a class="nav-link" href="/dashboard">Dashboard Inicial</a>
                    </li>

                    <li class="nav-item <?= ($uri->getSegment(1) == 'consultar-vaga' ? 'active' : null) ?>">
                        <a class="nav-link" href="/consultar-vaga">Consulte as oportunidades</a>
                    </li>
                    <?php if(session()->get('tipoConta') == 'EMPREGADOR') : ?>
                        <li class="nav-item <?= ($uri->getSegment(1) == 'cadastra-vaga' ? 'active' : null) ?>">
                            <a class="nav-link" href="/cadastrar-vaga">Cadastre uma oportunidade</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item <?= ($uri->getSegment(1) == 'profile' ? 'active' : null) ?>">
                        <a class="nav-link" href="/profile">Perfil</a>
                    </li>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
                        <a class="nav-link" href="/">Login</a>
                    </li>
                    <li class="nav-item <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>">
                        <a class="nav-link" href="/register">Cadastro</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>
