<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel = "stylesheet" href="contact.css" />       
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

                <br>

                <h1>Contactez-nous</h1>
				
                        <?php
							// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
							$destinataire = 'remi.darocha@hotmail.fr';
							  
							// copie ? (envoie une copie au visiteur)
							$copie = 'oui';
							  
							// Action du formulaire (si votre page a des paramètres dans l'URL)
							// si cette page est index.php?page=contact alors mettez index.php?page=contact
							// sinon, laissez vide
							$form_action = '';
							
							// Messages de confirmation du mail
							$message_envoye = "Votre message nous est bien parvenu !";
							$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";
							
							// Message d'erreur du formulaire
							$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";
							
							/*
								********************************************************************************************
								FIN DE LA CONFIGURATION
								********************************************************************************************
							*/
							
							/*
							 * cette fonction sert à nettoyer et enregistrer un texte
							 */
							function Rec($text)
							{
								$text = htmlspecialchars(trim($text), ENT_QUOTES);
								if (1 === get_magic_quotes_gpc())
								{
									$text = stripslashes($text);
								}
							  
								$text = nl2br($text);
								return $text;
							};
							
							/*
							 * Cette fonction sert à vérifier la syntaxe d'un email
							 */
							function IsEmail($email)
							{
								$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
								return (($value === 0) || ($value === false)) ? false : true;
							}
							  
							// formulaire envoyé, on récupère tous les champs.
							$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
							$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
							$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
							$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
							  
							// On va vérifier les variables et l'email ...
							$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
							$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin
							  
							if (isset($_POST['envoi']))
							{
								if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
								{
									// les 4 variables sont remplies, on génère puis envoie le mail
									$headers  = 'From:'.$nom.' <'.$email.'>' . "\r\n";
									//$headers .= 'Reply-To: '.$email. "\r\n" ;
									//$headers .= 'X-Mailer:PHP/'.phpversion();
							  
									// envoyer une copie au visiteur ?
									if ($copie == 'oui')
									{
										$cible = $destinataire.','.$email;
									}
									else
									{
										$cible = $destinataire;
									};
							  
									// Remplacement de certains caractères spéciaux
									$message = str_replace("&#039;","'",$message);
									$message = str_replace("&#8217;","'",$message);
									$message = str_replace("&quot;",'"',$message);
									$message = str_replace('&lt;br&gt;','',$message);
									$message = str_replace('&lt;br /&gt;','',$message);
									$message = str_replace("&lt;","&lt;",$message);
									$message = str_replace("&gt;","&gt;",$message);
									$message = str_replace("&amp;","&",$message);
							  
									// Envoi du mail
									if (mail($cible, $objet, $message, $headers))
									{
										echo '<p>'.$message_envoye.'</p>';
									}
									else
									{
										echo '<p>'.$message_non_envoye.'</p>';
									};
								}
								else
								{
									// une des 3 variables (ou plus) est vide ...
									echo '<p>'.$message_formulaire_invalide.'</p>';
									$err_formulaire = true;
								};
							}; // fin du if (!isset($_POST['envoi']))
							  
							if (($err_formulaire) || (!isset($_POST['envoi'])))
							{
								// afficher le formulaire
								echo '
								<form id="contact" method="post" action="'.$form_action.'">
								<fieldset><legend>Vos coordonnées :</legend>
									<p><label for="nom">Nom :</label><input type="text" id="nom" name="nom" value="'.stripslashes($nom).'" tabindex="1" /></p>
									<p><label for="email">Email :</label><input type="text" id="email" name="email" value="'.stripslashes($email).'" tabindex="2" /></p>
								</fieldset>
							  
								<br/>

								<fieldset><legend>Votre message :</legend>
									<p><label for="objet">Objet :</label><input type="text" id="objet" name="objet" value="'.stripslashes($objet).'" tabindex="3" /></p>
									<p><label for="message">Message :</label><textarea id="message" name="message" tabindex="4" cols="30" rows="8">'.stripslashes($message).'</textarea></p>
								</fieldset>
							  
								<br/>

								<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer le formulaire !" /></div>
								</form>';
							};
							?>
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