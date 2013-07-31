<article>
	<form id="deposer">
		<input type="file" name="fichier" value="Choisir un fichier">
		<br>

		<input type="text" name="nom" id="nom" />
		<label for="nom">Nom du fichier :</label>
		<br>
		
		
		<select id="type" name="type">
			<option value="1">Video</option>
			<option value="2">Photo</option>
			<option value="3">Musique</option>
		</select>
		<label for="type">Type du fichier :</label>
		<br>

		<select value="" id="categorie" name="categorie">
			<option value="categorie1">categorie1</option>
			<option value="categorie2">categorie2</option>
			<option value="categorie3">categorie3</option>
			<option value="categorie4">categorie4</option>
		</select>
		<label for="categorie">Catégorie :</label>

		<br>
		<input type="button" value="Envoyer">
	</form>
</article>

<script src="js/deposer.js"></script>