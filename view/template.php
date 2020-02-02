<!-- TEMPLATE -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  
  <link rel="stylesheet" href="./public/css/style.css" />
  <link rel="stylesheet" href="./public/css/mdb.min.css">
  <link rel="stylesheet" href="./public/css/backToTop.css" />

  <!-- SCRIPTS -->
  <script src="./public/js/app.js"/>
  <title> <?= $title ?> </title>
</head>

<body>
  <div id="global">
    <header>
      <?php require ("header.php") ?>
    </header>
    <div id="contenu"> 
      <?= $contenu ?>  
    </div>
    <a id="back-to-top" href="#" class="btn btn-blue-gradient btn-lg back-to-top"role="button"><i class="fas fa-chevron-up"></i></a>
    <footer id="piedBlog">
      <?php require "footer.php" ?>
    </footer>
  </div> 
</body>
</html>