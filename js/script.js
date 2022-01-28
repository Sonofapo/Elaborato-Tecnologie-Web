$(document).ready(function() {

	$("button#expand-menu").click(function() {
		if ($("ul#menu").css("display") == "none")
			$("ul#menu").show(200);
		else
			$("ul#menu").hide(200);
	});

});