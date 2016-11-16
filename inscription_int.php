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

					<h1>Intervenants</h1>
						<fieldset><legend>Inscription :</legend>

						<br/>	
				
							<form method="post">
							<div id="intervenant">
								<label for="nom">Nom : </label><input type="text" name="i_nom"> <br/><br/>
								<label for="prenom">Prénom : </label><input type="text" name="i_prenom"><br/><br/>
								<label for="mail">Adresse mail : </label><input type="text" name="i_mail"><br/><br/>
								<label for="tel">Telephone : </label><input type="text" name="i_tel"><br/><br/>
								<label for="fax">Fax : </label><input type="text" name="i_fax"><br/><br/>
							   <label for="domaine">Domaine :</label>
							   <select name="id_dom" id="domaine">
								   <option value="1">Informatique technologique</option>
								   <option value="2">Internet et le multimédia</option>
								   <option value="3">Informatique de gestion</option>
								   <option value="4">Télécommunications et réseaux</option>
								</select>
								<br/><br/>
								<label for="niveau">Niveau : </label>
							   <select name="id_niv" type="text" id="le_nom">
								   <option value="1">Débutant</option>
								   <option value="2">Amateur</option>
								   <option value="3">Confirmé</option>
								   <option value="4">Professionnel</option>
								</select>						
							</div>
							<?php
								$dbConn=mysqli_connect ('localhost','root','1123');
								mysqli_select_db ($dbConn,'projet');
								if (isset($_POST["i_nom"])&&isset($_POST["i_prenom"])&&isset($_POST["i_mail"])&&isset($_POST["i_tel"])&&isset($_POST["i_fax"])&&isset($_POST["id_niv"])&&isset($_POST["id_dom"])){
									$i_nom=$_POST['i_nom'];
									$i_prenom=$_POST['i_prenom'];
									$i_mail=$_POST['i_mail'];
									$i_tel=$_POST['i_tel'];
									$i_fax=$_POST['i_fax'];
									$id_dom=$_POST['id_dom'];
									$id_niv=$_POST['id_niv'];
									//Mettre les données dans la table INTERVENANT
									$SQLQuery1 = "INSERT INTO intervenant(int_nom,int_prenom,int_email,int_telephone,int_fax) VALUES('".$i_nom."','".$i_prenom."','".$i_mail."','".$i_tel."','".$i_fax."')";
									mysqli_query($dbConn,$SQLQuery1);
									//Mettre les données dans la table estcompetent
									$SQLQuery2 = "INSERT INTO estcompetent(comp_iddomaine,comp_idniveau,comp_idintervenant) VALUES('".$id_dom."','".$id_niv."',LAST_INSERT_ID())";
									mysqli_query($dbConn,$SQLQuery2);
									mysqli_close($dbConn);
								}
							?>
							<span onclick="alert('Merci !');"><a href=""><input name="valider" type="submit" value="Valider"></a></span>
						</form>
					</fieldset>
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