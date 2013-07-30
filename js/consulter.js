$(function() {

	var toogleInfos = function()
	{
		var that = $(this) ;
		var parent = that.parent();

		var detailed = $("#detailed");
		
		var details = parent.children("div");
		if(details.attr("id") != "detailed")
		{
			details.attr("id","detailed").toggle();
		}

		detailed.removeAttr("id").hide();
	}

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
								).click(toogleInfos),

								$("<div>").append(
									$("<ul>").append(
										$("<li>").text("Type : " + $(this).attr("t")),
										$("<li>").text("Taille : " + $(this).attr("s") + " octets"),
										$("<li>").text("Date de dépot : " + $(this).attr("d"))
									),
									$("<p>").append(
										$("<span>").addClass("title").html("Description: <br/>"),
										$(this).attr("c")
									),
									$("<div>").addClass("centered").append(
										$("<a>").attr("href", "stockage/fichiers/" + $(this).attr("n")).attr("target", "_blank").addClass("button").text("Télécharger " + $(this).attr("n"))
									)
								).hide()
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
				$(container).append($("<dl>").append($("<dd>").append($("<h4>").text(nom)).click(toogleView)));

			});

		}
	});

});