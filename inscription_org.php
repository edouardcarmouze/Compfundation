<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel = "stylesheet" href="inscription.css" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="script.js"></script>
        
        <title>CompFundation</title>
    </head>

    <body>
            <header>
                <div id="titre_princiapl">
                    <div id="logo">
                        <img src="logo.png" class="Logo" alt="Logo CompFundation" />
                            <div id="titre">   
                                <h1> CompFundation </h1>
                                <h2> Vous ne serez jamais seul </h2>
                            </div>
                    </div> 
                </div>
            </header>

           <div id="cssmenu">
                <ul>
                    <li><a href="index.html"><i class="fa fa-home fa-fw"></i>&nbsp; Acceuil</a></li>
                    <li class="active"><a href=''>Inscription</a>
                        <ul>
                            <li><a href="inscription_org.php">Organisme</a></li>
                            <li><a href="inscription_int.php">Intervenant</a>
                        </ul>
                    </li>
                    <li><a href="recherche.php"><i class="fa fa-search fa-fw"></i>&nbsp; Recherche</a></li>
                    <li><a href="contact.php"><i class="fa fa-envelope fa-fw"></i>&nbsp; Contact</a></li>
                </ul>
            </div>
            
            <section>
				<div id="corp">

					<br/>

					<h1>Organisme</h1>

						<fieldset><legend>Inscription :</legend>
				
						<div id="corp">
						<form method="post">
							<div id="organisme">
							<label for="nom">Nom de l'organisme :</label><input type="text" name="o_nom"> <br/><br/>
							<label for="mail">Adresse mail :</label><input type="text" name="o_mail"><br/><br/>
							<label for="tel">Téléphone : </label><input type="text" name="o_tel"><br/><br/>
							<label for="cp">Code postal : </label><input type="text" name="o_cp"><br/><br/>
							<label for="ville">Ville : </label><input type="text" name="o_ville"><br/><br/>
							<h2>Fiche contact :</h2><br/>
							<label for="nom">Nom :</label><input type="text" name="c_nom"> <br/><br/>
							<label for="prenom">Prénom : </label><input type="text" name="c_prenom"><br/><br/>
							<label for="mail">Adresse mail :</label><input type="text" name="c_mail"><br/><br/>
							<label for="tel">Téléphone : </label><input type="text" name="c_tel"><br/><br/>					
							</div>
							<?php
								$dbConn=mysqli_connect ('localhost','root','1123');
								mysqli_select_db ($dbConn,'projet');
								if (isset($_POST["o_nom"])&&isset($_POST["o_mail"])&&isset($_POST["o_tel"])&&isset($_POST["o_cp"])&&isset($_POST["o_ville"])&&isset($_POST["c_prenom"])&&isset($_POST["c_nom"])&&isset($_POST["c_mail"])&&isset($_POST["c_tel"])){
									$o_nom=$_POST['o_nom'];
									$o_mail=$_POST['o_mail'];
									$o_tel=$_POST['o_tel'];
									$o_cp=$_POST['o_cp'];
									$o_ville=$_POST['o_ville'];
									$c_prenom=$_POST['c_prenom'];
									$c_nom=$_POST['c_nom'];
									$c_mail=$_POST['c_mail'];
									$c_tel=$_POST['c_tel'];
									//Mettre les données dans la table organisation
									$SQLQuery1 = "INSERT INTO organisme(org_nom,org_email,org_telephone,org_codepostal,org_ville) VALUES('".$o_nom."','".$o_mail."','".$o_tel."','".$o_cp."','".$o_ville."')";
									mysqli_query($dbConn,$SQLQuery1);
									//Mettre les données dans la table contact
									$SQLQuery2 = "INSERT INTO contact(ctc_nom,ctc_prenom,ctc_email,ctc_telephone,ctc_idorganisme) VALUES('".$c_nom."','".$c_prenom."','".$c_mail."','".$c_tel."',LAST_INSERT_ID())";
									mysqli_query($dbConn,$SQLQuery2);
									mysqli_close($dbConn);
								}
							?>

								<span onclick="alert('Merci !');"><a href=""><input name="valider" type="submit" value="Valider"></a></span>
							</form>
				</div>
			</section>

			<br/>
			
            <footer>
                    <ul class="footer_texte">
                        <center><li><a href="">Copyright - Tout droit réservé</li>
                        <li><a href="">Mentions Légales</li>
                    </ul>
            </footer>
    </body>
</html>