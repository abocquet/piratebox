var $status = $("<div>").appendTo($("article")), $form = $("form");

$form.submit(function(){ 
	$(this).hide();
	$status.append($("<p>").text("Envoi en cours"));
 });

$form.find(":file").change(function(){
	$form.find("#nom").val(this.files[0].name);
});


//On ajoute les catégories ainsi que la possibilité de les ajouter
var $select = $form.find("select#categorie");

$opt = $("<optgroup>").attr("label", "Categories").appendTo($select);

$.ajax({
	type: 'GET',
	url: 'bibliotheque/categories.xml',
	timeout: 3000,
	success: function(data) {

		var i = 0 ;
		$(data).find("bibliotheque").children().each(function(){

			var nom = $(this).text();
			$opt.append($("<option>").val(nom).text(nom));
			i++;

		});

		if(i == 0){ addDefaultCategory() ;}

		putAddButton();

	},
	error: function(){ addDefaultCategory() ; putAddButton(); }
});

var addDefaultCategory = function(){
	$opt.append($("<option>").val("Autre").text("Autre"));
}

function putAddButton(){
	$select.prepend(
		$("<option>").val("ajouter").text("Ajouter une catégorie")
	).change(function(){

		if($(this).children().first().prop('selected'))
		{
			var nom = prompt("Entrez le nomde la catégorie à créer");

			if(nom != "")
			{
				$opt.append($("<option>").val(nom).text(nom));
			}

			$opt.children().last().prop('selected', true);
		}

	});

	$opt.children().last().prop('selected', true);
}

//Pour aafficher le résultat de l'upload de fichier
function showResult(filename, error)
{
	var message ;
	if(error != '')
	{
		message = "Erreur, le fichier " + filename + " n'a pu être envoyer car " + error + "."; 
	}
	else
	{
		message = "Le fichier " + filename + " a été envoyé avec succès."
	}

	$status.find("p").text(message);
	
	$status.append(
		$("<input>").attr("type", "button").val("Recommencer").click(function(){

			$form.show();
			$form.children("input")
				.not(':button, :submit, :reset, :hidden')
				.val('');

			$status.empty();

		})
	)

}
