<?php 
    require_once '../../Controller/Type3C.php';
    require_once '../../Model/Type3.php';

    session_start();
    if(isset($_POST["desc_eve"]) && isset($_POST["nom"]) && isset($_POST["directeur"])  && isset($_POST["prix_event"]) && isset($_POST["photo"])) {
      $tp= new event($_POST["desc_eve"],$_POST["nom"],$_POST["directeur"],$_POST["prix_event"],$_POST["photo"]);
      $newtp= new eventC();
      if ($newtp->modifierTypeInst($tp,$_POST['id'])) {
        var_dump($_POST['id']);
      }
      header("Location:tables_event.php");
    }
    
?>


<!DOCTYPE html>
<html>
  <head> 
  <script src="assets/javascript3.js">    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modifier évènement</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="assets/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/img/mostache.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

        <style>

          .form-control {
           height: calc(2.4rem + 2px);
           border: 1px solid #444951;
           background: transparent;
           border-radius: 0;
           color: #979a9f;
           padding: 0.45rem 0.75rem;
          }

          input.form-control:valid {
            border:1px solid #0a0;
          }
          input.form-control:invalid {
            border:1px solid #a00;
          }
          input.form-control:valid + span:before  {
            content: "\f00c";
            font-family: "FontAwesome";
            color:#0a0;
            font-size: 1.5em;
          }	
          input.form-control:invalid + span:before  {
            content: "\f00d";
            font-family: "FontAwesome";
            color:#a00;
            font-size: 1.5em;
          }
        </style>

  </head>
  <body>
  <?php include_once 'include/header.php'; ?>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"> <img src="Assets/img/<?=$_SESSION['image']; ?>" alt="..." class="img-fluid rounded-circle" ></div>
                <div class="title">
                    <h1 class="h5"> <?php echo $_SESSION['name']; ?> </h1>
                    <p>Admin</p>
                </div>
            </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active">
                    <a href="index.php"> <i class="icon-home"></i>Accueil </a>
                </li>
                <!-- <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Graphiques </a></li> -->
                <!-- <li><a href="forms.html"> <i class="icon-padnote"></i>Formulaires </a></li> -->
                <li>
                    <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Informations </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="formType.php">Ajouter une catégorie</a></li>
                        <li><a href="ajouterP.php">Ajouter un produit</a></li>
                        <li><a href="ajouter_carte.php">Ajouter une carte de fidélité</a></li>
                        <li><a href="forms_inf.php">Ajouter influenceur</a></li>
                        <li><a href="forms_spons.php">Ajouter Sponsors</a></li>
                        <li><a href="forms_event.php">Ajouter un evenement</a></li>
                        <li><a href="forms_promo.php">Ajouter promotion</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Tables</a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="themes.php">Categories</a></li>
                        <li><a href="produit.php">Produits</a></li>
                        <li><a href="afficher_client.php">Clients</a></li>
                        <li><a href="afficher_carte.php">Cartes Fidélité</a></li>
                        <li><a href="tables_inf.php">Influenceurs</a></li>
                        <li><a href="tables_spons.php">Sponsors</a></li>
                        <li><a href="tables_event.php">Evenements</a></li>
                        <li><a href="tables_promo.php">Promotions</a></li>
                        <li><a href="afficher_commande.php">Commandes</a></li>

                    </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Affichage evenement</h2>
                </div>
            </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
            <li class="breadcrumb-item active">evenement  </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container">


            <?php
              if (isset($_GET['id'])) {
                $tp2=new eventC();
                $i=$tp2->chercheridTypeInst($_GET['id']); 
            ?>
              
              <!-- Horizontal Form-->
                <div class="block">
                  <div class="title"><strong class="d-block">Modifier evenement</strong></div>
                  <div class="block-body">
                    <form name ="f" class="form-horizontal" method="POST">

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Nom evenement</label>
                          <div class="col-sm-9">
                            <input type="text" name="nom" id="nom" minlength="4" value="<?= $i['nom'] ?>" class="form-control form-control-success" >
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">direcetur evenement</label>
                          <div class="col-sm-9">
                            <input type="text" name="directeur" id="directeur" minlength="4" value="<?= $i['directeur'] ?>" class="form-control form-control-success" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">prix evenement</label>
                          <div class="col-sm-9">
                            <input type="text" name="prix_event" id="prix_event" minlength="1" value="<?= $i['prix_event'] ?>" class="form-control form-control-success" >
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">description d'evenement</label>
                          <div class="col-sm-9">
                            <input type="text" name="desc_eve" id="desc_eve" minlength="10" value="<?= $i['desc_eve'] ?>" class="form-control form-control-success" >
                          </div>
                        </div>


                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label">Photo d'evenement</label>
                          <div class="col-sm-9">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <img src="<?php echo $i['photo'] ?>" width="100" height="100">
                                <input type="file" class="btn btn-primary" name="photo" value="<?php echo $i["photo"] ?>"  id="photo" ></input>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>


                        <div class="form-group row">       
                          <div class="col-sm-9 offset-sm-3">

                          <input type="button" onclick=" fonction(); document.getElementById('id').style.display='block'" value="Save" name="Submit" class="btn btn-primary"> 
                          <input type="hidden" value=<?PHP echo $i['id']; ?> name="id">

                          <div id="id" class="modal">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <form method="POST" action="event.php">
                                <strong>C'est bien !</strong> Tu as modifier la catégorie <?PHP echo $i['nom']?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="clearfix ">
                                  <input type="submit" onclick="document.getElementById('id').style.display='none'" class="btn-primary" value="OK">
                                </div>
                              </form>
                            </div>
                          </div>

                          <script>
                          var modal = document.getElementById('id')
                          window.onclick = function(event) {
                          if (event.target == modal) {
                              modal.style.display = "none";
                          }
                          }
                          </script>


                          </div>
                        </div>
                    </form>
                  </div>
                </div>

              <?php }
                /*else { // Si l'utilisateur essaye d'accéder directement à la page sans passer par showAlbums
                  header("Location:themes.php");
                }*/
              ?>
              
          </div>
        </section>
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2021 &copy; Design by <a href="index.php">Art-ini</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/js/front.js"></script>
  </body>
</html>