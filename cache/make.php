<?php

	function createCache()
	{
		require("content_list.php");
		print_r($contentList);

		//Création de la nav bar
		$navHTML = "<ul>" ;

		$c = count($contentList);
		for($i = 0 ; $i < $c ; $i++) {

				$navHTML .= "<li><a href='" . $contentList[$i]["path"] . "'>" . $contentList[$i]["name"] . "</a></li>";
		}

		$navHTML .= "</ul>";

		//Création du header 

		$header = file_get_contents("snippets/header.html");
		$header = preg_replace('#\{\{nav\}\}#isU', $navHTML, $header);

		//Création du ender

		$ender = file_get_contents("snippets/ender.html");

		//création du cache statique

		for($i = 0 ; $i < $c ; $i++) {

			if($contentList[$i]["cachable"])
			{
				$path = "../" ;
				if(isset$contentList[$i]["folder"]) { $path .= isset$contentList[$i]["folder"] ; } 
				$path .=  $contentList[$i]["path"] ;

				file_put_contents($path, $header . file_get_contents("content/" . $contentList[$i]["path"]) . $ender) ;
			}
		}

		echo "ok";
	}

	createCache();

?>