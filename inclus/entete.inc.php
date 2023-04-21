<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Voiture Du Lac</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css?<?php echo rand(10000,99999)?>">
  <link rel="stylesheet" href="css/monStyle.css?<?php echo rand(10000,99999)?>">
  <link rel="icon" type="image/x-icon" href="images/logo.png">
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">

    <!-- SIDEBAR -->
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <a href="index.php" class="img logo rounded-circle mb-5" style="background-image: url(images/logo.jpg);"></a>
        <ul class="list-unstyled components mb-5">
          <li class="active"><a href="index.php"><?php echo $json['header_home'] ?></a></li>
          <li><a href="voitures.php"><?php echo $json['header_cars'] ?></a></li>
          <li><a href="services.php"><?php echo $json['header_services'] ?></a></li>
          <li><a href="tarifs.php"><?php echo $json['header_prices'] ?></a></li>
          <li><a href="rejoindre.php"><?php echo $json['header_contact'] ?></a></li>
        </ul>
        <br><br><br>
        <div class="footer">
          <p>Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> <?php echo $json['header_copyright'] ?>
            <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
        </div>

      </div>
    </nav>

    <!-- PAGE PRINCIPALE -->
    <div id="content" class="p-4 p-md-5">

      <!-- NAVBAR -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
          </button>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item active"><a class="nav-link" href="reservation.php">
                  <?php echo $json['header_book'] ?>
                </a></li>
              <li class="nav-item"><a class="nav-link" href="connexion.php"><?php echo $json['header_login'] ?></a></li>
              <li class="nav-item"><a class="nav-link" href="?lang=fr"><?php echo $json['header_fr_btn'] ?></a></li>
              <li class="nav-item"><a class="nav-link" href="?lang=en"><?php echo $json['header_en_btn'] ?></a></li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- PAGE -->