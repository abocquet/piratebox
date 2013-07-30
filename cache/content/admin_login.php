<article class="centered">

	<?php 
		if(isset($_GET['badwolf']))
		{
			echo "<p>Vous devez avoir la clé pour entrer. Piraate !</p>" ;
		}
	?>

	<form action="admin.php" method="post">

		<label for="password">Mot de passe : </label>
		<input name="password" id="password" type="password">
		
		<input type="submit" value="Connection">
	</form>
</article>