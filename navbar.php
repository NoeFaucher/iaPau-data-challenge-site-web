<?php 
include("header.php"); 
 ?>

<div class="banniere">
  <img src="img/iapau_round.png" id="logo"/>
  <h1>IA PAU</h1>
  <p>L'intelligence artificielle vue des Pyrénées</p>
</div>

  <!-- Navbar -->
            
<div class="menu-banniere">
  <a href="index.php">Accueil</a>
  <a href="Challenge.php">Data Challenge</a>
  <a href="Battle.php">Data Battle</a>

				
<?php if (isset($_SESSION["nom"])) { ?>

		<a href="deconnexion.php">Déconnexion</a>

<?php } else { ?>

		<a href="connexion.php">Connexion</a>

<?php } ?>

</div>