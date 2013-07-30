<?php

	function createCache()
	{
		require("cache/content_list.php");
		require("_config.php");

		//Création de la nav bar
		$navbar = "<ul>" ;

		$c = count($contentList);
		for($i = 0 ; $i < $c ; $i++) {

			if(!isset($contentList[$i]["extention"]))
			{
				$contentList[$i]["extention"] =  ".html" ;
			}

			$navbar .= "<li><a href='" . $contentList[$i]["path"] . $contentList[$i]["extention"] . "'>" . $contentList[$i]["name"] . "</a></li> ";
		}

		$navbar .= "</ul>";

		//création du cache statique

		for($i = 0 ; $i < $c ; $i++) {

			ob_start();

			include("cache/snippets/header.php");

			//Si la page doit être enregistrée en php, le contenu dynamique n'est pas mis en cache
			if($contentList[$i]["extention"] == ".php")
			{
				echo file_get_contents("cache/content/" . $contentList[$i]["path"] . ".php");
			}
			else
			{
				include("cache/content/" . $contentList[$i]["path"] . ".php");
			}

			include("cache/snippets/ender.php");

			file_put_contents($contentList[$i]["path"] . $contentList[$i]["extention"], ob_get_clean()) ;
		}
	}

	createCache();

?>