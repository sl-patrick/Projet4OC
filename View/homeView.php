<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <nav class="col navbar navbar-expand bg-dark">
        <a class="navbar-brand text-light" href="index.php">Jean Forteroche</a>
        <ul class="navbar-nav nav-pills">
            <li class="nav-item">
                <a class="nav-link text-light" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="index.php">Épisodes</a>
            </li>
        </ul>
        </nav>
    </div>
</div>
<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container-fluid pb-2">
        <div class="row">
            <div class="col-12 jumbotron">
                <h1 class="text-center">Billet simple pour l'Alaska</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-around">
            <div class="card col-3">
                <figure class="figure card-img-top ">
                    <img src="" alt="" class="img-fluid">
                </figure>
                <div class="card-body">
                    <h4 class="card-title">Lorem1</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus mollitia beatae dignissimos, eum deleniti, totam numquam officiis dicta error, vero nesciunt recusandae? Incidunt, eius vero aliquam illo laboriosam quo expedita.
                    </p>
                    <p class="card-text">

                    </p>
                    <a href="#" class="btn bg-dark text-light">Lire la suite</a>
                </div>  
            </div>
            <div class="col-3 card">
                <figure class="figure card-img-top ">
                    <img src="" alt="" class="img-fluid">
                </figure>
                <div class="card-body">
                    <h4 class="card-title">Lorem2</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus mollitia beatae dignissimos, eum deleniti, totam numquam officiis dicta error, vero nesciunt recusandae? Incidunt, eius vero aliquam illo laboriosam quo expedita.
                    </p>
                    <a href="#" class="btn bg-dark text-light">Lire la suite</a>
                </div>  
            </div>
            <div class="col-3 card">
                <figure class="figure card-img-top ">
                    <img src="" alt="" class="img-fluid">
                </figure>
                <div class="card-body">
                    <h4 class="card-title">Lorem3</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus mollitia beatae dignissimos, eum deleniti, totam numquam officiis dicta error, vero nesciunt recusandae? Incidunt, eius vero aliquam illo laboriosam quo expedita.
                    </p>
                    <a href="#" class="btn bg-dark text-light">Lire la suite</a>
                </div>  
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>


<?php ob_start(); ?>
<div class="container-fluid fixed-bottom bg-dark">
    <div class="row">
        <nav class="col navbar navbar-expand bg-dark">
            <p class=" text-light">Lorem, ipsum.</p>
        </nav>
    </div>
</div>
<?php $footer = ob_get_clean(); ?>








<?php require('template.php'); ?>

