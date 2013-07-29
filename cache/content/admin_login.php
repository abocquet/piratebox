<article class="centered">

	<?php 
		if(isset($_GET['message']))
		{
			echo "<p>" . $_GET['message'] . "</p>" ;
		}
	?>

	<form action="admin.php" method="post">

		<label for="password">Mot de passe : </label>
		<input name="password" id="password" type="password">
		
		<input type="submit" value="Connection">
	</form>
</article>