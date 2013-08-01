<article>
	<iframe id="uploadFrame" style='width: 0px ; height: 0px ; postion: absolute ; top: 0px ; left: 0px ; background-color: white ;'></iframe>

	<h3>Déposer un fichier</h3>

	<form id="deposer" target="uploadFrame" action="action.php" enctype="multipart/form-data" method="post">
		<input type="file" name="file" value="Choisir un fichier">
		<br>

		<input type="text" name="nom" id="nom" />
		<label for="nom">Nom du fichier :</label>
		<br><br>
		
		
		<select id="type" name="type">
			<option value="0">Texte</option>
			<option value="1">Vidéo</option>
			<option value="2">Photo</option>
			<option value="3">Musique</option>
		</select>
		<label for="type">Type du fichier :</label>
		<br><br>

		<select value="" id="categorie" name="categorie">
		</select>
		<label for="categorie">Catégorie :</label>

		<br><br>
		<label for="commentaire">Description du fichier :</label>
		<textarea name="commentaire" id="commentaire" cols="30" rows="6"></textarea>

		<br><br>
		<input type="submit" value="Envoyer">
	</form>

</article>

<script src="js/deposer.js"></script>