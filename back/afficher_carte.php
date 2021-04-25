<?php 


    require_once "../../Controller/carteC.php";
    $db=config::getConnexion();
    $result=$db->query('SELECT * FROM carte');
    $carteC =  new carteC();
    if (isset($_GET['search'])&& !empty($_GET['search']))
    {
        $result=$db->query('SELECT * FROM carte WHERE numero like \'%'.$_GET['search'].'%\'');
        
    }else
    {
        $result=$db->query('SELECT * FROM carte');
    }

    if (isset($_GET['delete']))
    {

        $id =$_GET['delete'];
        
        $res=$carteC->supprimerCarte($id);
        if ($res)
        {
            header("Location: afficher_carte.php?success=Suppression executée avec succès");
        }
       else 
       {
        header("Location: afficher_carte.php?error=Echec");
       }
       
    }

    if (isset($_GET['tri'])) {
        if ($_GET['tri']=="numero") {
          $tri="numero";
          $result=$carteC->affichercartetri($tri);
        }
          else
          {
              $tri="Date_activation";
             $result=$carteC->affichercartetri($tri);
            
          }
        
          
    }
    ?>
                
                <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
 
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>table carte fidélité</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="Assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="Assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="Assets/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="Assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="Assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="Assets/css/style.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="Assets/img/JD&Co3.png">
    <link rel="shortcut icon" href="Assets/img/mostache.png">

    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
<?php include_once 'include/header.php'; ?>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5">Ines Kouki</h1>
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
                        <li><a href="#">Ajouter une catégorie</a></li>
                        <li><a href="#">Ajouter un produit</a></li>
                        <li><a href="ajouter_carte.php">Ajouter une carte de fidélité</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Tables</a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Produits</a></li>
                        <li><a href="afficher_client.php">Client</a></li>
                        <li><a href="afficher_carte.php">Carte Fidélité</a></li>
                    </ul>
                </li>
                <li>
                    <a href="login.php"> <i class="icon-logout"></i>Page de connexion </a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <!-- Page Header-->
            <div class="page-header no-margin-bottom">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Affichage table cartes fidélité</h2>
                </div>
            </div>
            <!-- Breadcrumb-->
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
                    <li class="breadcrumb-item active">Carte fidélité</li>
                </ul>
            </div>
            <section>
                <div class="container">
                <button  class="btn btn-info mr-2" onclick="window.print()" style="position: relative; left: 750px "><i class="fa fa-print" aria-hidden="true"></i></i> Imprimer</button>
                    <div class="title"><strong>Liste des cartes fidélité</strong></div>
                   
                    <div class="col-lg-6 text-lg-right">
            

                </div>
                    </br>
                    <form action="" method = 'GET'>
                    <div class="form-group">
                    <div class="input-group">
                            <div class="input-group-prepend">
                            <button class="btn btn-info btn-xs" value="Chercher"> <i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                            </div>
                             <td> <select name="tri" class="form-control" >
                             <option value="" disabled selected>Trier par</option>
                            <option >numero</option>
                            <option>Date activation</option>

                            
                          </select></td> 
                          
                          
                        <td>
                            
                        </div>
                        </br>
                        <div class="input-group">
                        
                            <div class="input-group-prepend">
                            <button class="btn btn-danger btn-xs" value="Chercher"><i class="fa fa-search" ></i> Chercher</button>
                            </div>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Chercher une carte">
                            
                        </div>
                    </form>
                    </br>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Numéro</th>
                                    <th>Date d'activation</th>
                                    <th>Date d'expiration</th>
                                    <th>Nombre de points</th>
                                    <th>Id client</th>
                                </tr>
                            </thead>


                            <tbody id="tableau">
                            <?php while ($row = $result->fetch()) { 
                                    ?>
                        <tr>

                                       
                            <td> <?php echo $row['Identifiant']; ?></td>
                            <td> <?php echo $row['numero']; ?></td>
                            <td><?php echo $row['Date_activation']; ?></td>
                            <td><?php echo $row['Date_expiration']; ?></td>
                            <td><?php echo $row['nbptn']; ?></td>
                            <td><?php echo $row['idclient']; ?></td>
                          
                        <td>  
                        <a href="modifier_carte.php?edit=<?php echo $row['Identifiant']; ?>&edit2=<?php echo $row['Date_activation']; ?>&edit3=<?php echo $row['Date_expiration']; ?>&edit4=<?php echo $row['nbptn']; ?>&edit5=<?php echo $row['idclient']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Modifier</a> </td>
                       <td> <a href="afficher_carte.php?delete=<?php echo $row['idclient']; ?>" class="btn btn-danger btn-xs"><i class ="fa fa-trash-o"> </i> Supprimer</a> </td>
                        </tr>
                                        
										<?php
										}
										?>

                            </tbody>
                        </table>
                    </div>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            load_data();

                            function load_data(str) {
                                $.ajax({
                                    url: "Theme.php",
                                    method: "post",
                                    data: {
                                        str: str
                                    },
                                    success: function(data) {
                                        $('#tableau').html(data);
                                    }
                                });
                            }

                            $('#rech').keyup(function() {
                                var recherche = $(this).val();
                                if (recherche != '') {
                                    load_data(recherche);
                                } else {
                                    load_data();
                                }
                            });
                        });
                    </script>

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
    <script src="Assets/vendor/jquery/jquery.min.js"></script>
    <script src="Assets/vendor/popper.js/umd/popper.min.js">
    </script>
    <script src="Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="Assets/vendor/jquery.cookie/jquery.cookie.js">
    </script>
    <script src="Assets/vendor/chart.js/Chart.min.js"></script>
    <script src="Assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="Assets/js/front.js"></script>
</body>

</html>

</html>
