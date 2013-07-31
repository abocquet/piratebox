<?php

	if(isset($_FILES['file']))
	{
		$error = '' ;
		$filename = $_FILES['file']['name'];

		if(isset($_POST['categorie']) && isset($_POST['nom']) && isset($_POST['commentaire']) && isset($_POST['type']) && isset($_FILES['file']) && $_FILES['file']['error'] == 0)
		{
			//on effectue le traitement des entrées
			
				$categorie = trim(htmlspecialchars($_POST['categorie'])) ;
					//$categorie = preg_replace('#\s+/#i', '_', $categorie) ;
					if($categorie == 'categories') {
					$categorie = 'Categories' ;
				}
		
				$commentaire = htmlspecialchars($_POST['commentaire']) ;
				$extention = preg_replace("#.+(\.[a-zA-Z0-9]{1,12}$)#", "$1", $_FILES['file']['name']) ;
				
				$typeArray = array(

					"Texte",
					"Vidéo",
					"Photo",
					"Musique"

				);

				$n = (int)$_POST['type'];
				if($n > count($typeArray)){ $n = 0 ;}

				$type = $typeArray[$n];

				$nom = trim(htmlspecialchars($_POST['nom'])) ;
				
				if($nom == "") 
				{
					$nom = $_FILES['file']['name'] ;
				} 
				else 
				{
					if(!preg_match("#" . $extention . "$#", $_POST['nom']))
			        {
				        $nom .= $extention ;
			        }
			    }
			    
				$cheminCategorie = 'bibliotheque/' . $categorie . '.xml' ;
			
			if(!file_exists('bibliotheque/fichiers/' . $nom))
			{
				//Si la categorie n'existe pas on la crée
				if(!file_exists($cheminCategorie)) {

					$newCategorie = fopen($cheminCategorie, 'a+');
					
					fputs($newCategorie, '<?xml version="1.0" encoding="UTF-8"?>
					<a></a>') ;
					
					fclose($newCategorie) ; 
				
					$xml = simplexml_load_file('bibliotheque/categories.xml');
		            
		                $categorie = $xml->addChild('categorie', $categorie) ;
		            
		                //On écrit le XML complet dans le fichier
		                $XMLFile = fopen("bibliotheque/categories.xml", "r+") ;
		                ftruncate($XMLFile, 0) ;
		                fputs($XMLFile, $xml->asXML()) ;
		                fclose($XMLFile) ;
		        
		        }
		                
		        //puis on va enregistrer l'arivée du fichier fichier dans le xml
		        
		        	$xml = simplexml_load_file($cheminCategorie);
		            
		                $newFile = $xml->addChild('f') ;
		                $newFile->addAttribute('n', $nom) ;
		                $newFile->addAttribute('c', $commentaire) ;
		                $newFile->addAttribute('t', $type) ;
		                $newFile->addAttribute('s', $_FILES['file']['size']) ;
		                $newFile->addAttribute('d', date('j/n/Y G:i')) ;
		            
		                //On écrit le XML complet dans le fichier
		                $XMLFile = fopen($cheminCategorie, "r+") ;
		                ftruncate($XMLFile, 0) ;
		                fputs($XMLFile, $xml->asXML()) ;
		                fclose($XMLFile) ;

		        
		        //et enfin sauvegarder le fichier         
				
					move_uploaded_file($_FILES['file']['tmp_name'], 'bibliotheque/fichiers/' . basename($nom));
			}
			else
			{
				$error = 'le fichier existe déjà' ;
			}
		}
		else
		{
			$error = 'les paramètres ne correspondent pas' ;
		}

		echo "<script>window.top.window.showResult('" . $filename . "','" . $error . "');</script>";
	}

?>