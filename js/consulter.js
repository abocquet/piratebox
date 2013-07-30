$(function() {

	var toogleView = function()
	{
		var that = $(this) ;
		var nom = that.text();

		if(categories[nom] != true)
		{
			console.log(nom);
			$.ajax({
				type: "GET",
				url: "stockage/" + nom + ".xml",
				dataType: "xml",
				success: function(xml) {
			 
					categories[nom] = true ;

					$(xml).find("f").each(function(index){

						console.log(this)

					});

				}
			});	
		}
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

				var nom =$(this).text() ;
				categories[nom] = false ;

				$(container).append($("<dl>").append($("<dd>").append($("<h4>").text(nom)).click(toogleView)));

			});

		}
	});

});