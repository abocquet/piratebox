<?php
	
	require "_config.php" ;
	require "_makeCache.php" ;
	require "_bbCode.php" ;
	session_start();

	if(!isset($_SESSION['isAuth']))
	{
		$_SESSION['isAuth'] = false ;
	}

	if((!isset($_POST['password']) || $_POST['password'] != $config["password"]) && $_SESSION['isAuth'] == false)
	{

		header("Location: admin_login.php?badwolf=1");
	}
	else
	{
		$_SESSION['isAuth'] = true ;	
		if(isset($_POST["h1"]) && isset($_POST["h2"]) && isset($_POST["chPassword"]) && isset($_POST["confChPassword"]) && isset($_POST['welcome_text']))
		{

			$_SESSION["errors"] = array() ;

			//On gère tout d'abord les mots de passe
			if($_POST["chPassword"] != $_POST["confChPassword"])
			{
				$_SESSION["errors"]["password"] = "Les mots de passe ne correspondent pas" ;
			}
			else if(empty($_POST["confChPassword"]) || empty($_POST["chPassword"]))
			{
				$_SESSION["errors"]["password"] = "Vous devez renseigner un mot de passe" ;	
			}

			if(count($_SESSION['errors']) == 0)
			{

				if(!empty($_POST["h1"]))
				{
					$config['h1'] = htmlspecialchars($_POST['h1']);
				}

				$config['h2'] = htmlspecialchars($_POST['h2']);
				$config['password'] = htmlspecialchars($_POST['chPassword']);

				//puis on s'occupe du bbcode
				$config['welcome_text'] = makeItHTML($_POST["welcome_text"]);

				//Après avoir changé les préférences, on les persiste

				$parametres = "<?php" . PHP_EOL ;		
				
				foreach($config as $cle => $valeur)
				{
					if($valeur != "true" && $valeur != "false") { $valeur = "'". $valeur . "'" ; } ;
					$parametres .= '$config[\'' . $cle .'\'] = ' . $valeur .' ; ' . PHP_EOL ;
				}		
				
				$parametres .= "?>" . PHP_EOL ;

				file_put_contents('_config.php', $parametres);

				createCache();
				$_SESSION["isAuth"] = false;
				header("Location: index.html");
				return 0 ;
			}

		}

		//Sinon, on affiche le formulaire et tout le tremblement
	?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>Configuration de la piratebox</title>
	</head>
	<body>
	
		<header>
			<input type="text" class="h1" placeholder="Nom de la piratebox" value='<?php echo $config["h1"] ; ?>'>
			<input type="text" class="h2" placeholder="Courte présentation" value='<?php echo $config["h2"] ; ?>'>
		</header>
		<section>

			<article>
				<form action="admin.php" method="post">
					
					<input type="hidden" name="h1" id="h1" value='<?php echo $config["h1"] ; ?>'/>
					<input type="hidden" name="h2" id="h2" value='<?php echo $config["h2"] ; ?>'/>
					
					<h3>Page d'accueil</h3>
					
					<textarea name="welcome_text" cols="50" rows="5"><?php echo makeItBB($config["welcome_text"]) ; ?></textarea>
					<?php writeBBInstructions() ; ?>

					<hr/>

					<h3>Changer le mot de passe</h3>

					<?php

						if(isset($_SESSION["errors"]["password"]))
						{
							echo "<p>" . $_SESSION["errors"]["password"] . "</p>" ;
						}	

					?>			

					<label for="chPassword">Mot de passe : </label><br>
					<input type="password" id="chPassword" value='<?php echo $config["password"] ; ?>'name="chPassword">

					<br/>

					<label for="confChPassword">Confirmation du mot de passe : </label><br>
					<input type="password" id="confChPassword" value='<?php echo $config["password"] ; ?>' name="confChPassword">

					<hr/>

					<div class="centered">
						
						<input type="submit" class="alert" value="Enregistrer les modifications"/>
						<!-- <input type="button" value="Ne pas enregistrer les modifications"/> -->
						<a href="./" class="button">Ne pas enregistrer les modifications</a>

					</div>
					
				</form>
			</article>
		</section>

		<script src="js/jquery.min.js"></script>
		<script>
			var h1 = $(".h1") ;

			h1.keyup(function(){
				$("#h1").val(h1.val());
			})

			var h2 = $(".h2") ;

			h2.keyup(function(){
				$("#h2").val(h2.val());
			})

		</script>
	
	</body>
</html>

			<?php
		
		$_SESSION['errors'] = array();
	}
?>