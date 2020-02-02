<!-- EN TETE -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,900|Ubuntu" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
  <!--CCS Stylsheet-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/style.css">
  <link rel="stylesheet" href="./public/css/mdb.min.css">
  <!--Font Awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="./public/js/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <link rel="icon" type="image/png" href="./public/images/img0.png">

</head>

<body>
  <section id="title">
    <!-- Nav Bar -->
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="navbar-brand" href="./index.php"><h2>QCM Live</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="./index.php?action=pageUtilisation1"><h3>Utilisation</h3></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./index.php?action=pageDeveloppeurs"><h3>Les Développeurs</h3></a>
            </li>
            <li class="nav-item">
              <?php
              if(isset($_SESSION['profil'])){
                echo '<a href="./model/finSession.php"> <button type="button"  class="btn btn-dark btn-lg download-button" ><i class="fas fa-address-card"></i></i> Se Deconnecter</button></a>';
              }else{
                echo '<a href="./index.php?action=login&type_utilisateur="> <button type="button"  class="btn btn-dark btn-lg download-button" ><i class="fas fa-address-card"></i></i> Se Connecter</button></a>';


              }?>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </section>
</body>
</html>