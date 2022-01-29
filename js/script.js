$(document).ready(function() {

	$("button#expand-menu").click(function() {
		closeNav();
		$("ul#menu").toggle(200);	
	});

	setTimeout(() => { 
		$("div.fade-me").slideUp(200); 
	}, 3000);

});

function openNav() {
	document.getElementById("sidenav").style.width = "250px";
	document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	$("ul#menu").hide(200);
}

function closeNav() {
	document.getElementById("sidenav").style.width = "0";
	document.body.style.backgroundColor = "rgba(0,0,0,0)";
}