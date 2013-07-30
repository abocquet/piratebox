$(function() {

	var toogleView = function()
	{
		var that = $(this) ;
		var parent = that.parent();
		var nom = that.text();

		//Si la categorie n'a pas été chargée ou pas rafrachie depuis plus d'une heure, on la rafraichis
		if(categories[nom] == undefined ||  new Date().getTime() - categories[nom] > 3600000) 
		{
			$.ajax({
				type: "GET",
				url: "stockage/" + nom + ".xml",
				dataType: "xml",
				success: function(xml) {
			 		
			 		parent.find("dt").remove();
					categories[nom] = new Date().getTime();

					var fichiers = $("<ul>");
					parent.append(
						$("<dt>").append(
							fichiers
						).attr("id", "open")
					);

					$(xml).find("f").each(function(index){

						fichiers.append(
							$("<li>").append(
								$("<h4>").text(
									$(this).attr("n")
								)
							)
						);

					});

				}
			});	
		}

		var open = $("#open");
		
		var dt = parent.find("dt");
		if(dt.attr("id") != "open")
		{
			dt.attr("id","open").toggle();
		}

		open.removeAttr("id").hide();

	}

	var categories = {};

	var container = $("<ul>");
	$("section").append($("<article id='file_list'>").append(container));

	$.ajax({

	    type: "GET",
		url: "stockage/categories.xml",
		dataType: "xml",
		success: function(xml) {
	 
			$(xml).find("categorie").each(function(index){

				var nom = $(this).text() ;
				// categories[nom] = new Date().getTime() ;

				$(container).append($("<dl>").append($("<dd>").append($("<h4>").text(nom)).click(toogleView)));

			});

		}
	});

});