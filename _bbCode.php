<?php

	function makeItHTML($texte)
	{
		$texte = htmlentities($texte);
		$texte = nl2br($texte);

		$texte = preg_replace('#\[g\](.+)\[/g\]#isU', '<strong>$1</strong>', $texte);
		$texte = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $texte);
		$texte = preg_replace('#\[s\](.+)\[/s\]#isU', '<span class="u">$1</span>', $texte);
		$texte = preg_replace('#\[t\](.+)\[/t\]#isU', '<h3>$1</h3>', $texte);

		return $texte ;
	}

	function makeItBB($texte)
	{
		$texte = preg_replace('#\<br /\>#isU', '', $texte);		

		$texte = preg_replace('#\<strong\>(.+)\</strong\>#isU', '[g]$1\[g]', $texte);
		$texte = preg_replace('#\<em\>(.+)\</em\>#isU', '[i]$1\[i]<', $texte);
		$texte = preg_replace('#\<span class="u"\>(.+)\</span\>#isU', '[s]$1\[s]', $texte);
		$texte = preg_replace('#\<h3\>(.+)\<\/h3\>#isU', '[t]$1[t]', $texte);

		return $texte ;
	}

	function writeBBInstructions()
	{
		echo "<p>Vous pouvez mettre les mots entre</p>
		<ul>
			<li>[g] et [/g] pour les mettres en gras</li>
			<li>[s] et [/s] pour les mettres en souligné</li>
			<li>[i] et [/i] pour les mettres en italique</li>
			<li>[t] et [/t] pour mettre un titre</li>
		</ul>" ;
	}

?>
