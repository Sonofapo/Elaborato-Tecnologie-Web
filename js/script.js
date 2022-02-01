$(document).ready(function() {

	$("button#expand-menu").click(function() {
		$("ul#menu").slideToggle(200);	
	});

	$("button#search-button").click(openNav);

	$("button#close-search").click(closeNav);

	setTimeout(() => { 
		$("div.fade-me").slideUp(200); 
	}, 3000);

	$("input#slider").on("input", function() {
		$("span#search-value").html($(this).val());
	});

	$("button.add-to-cart").click(function() {
		addToCart($(this).attr("id"), $("span#user-id").text());
	});
	
	$("button.remove-from-cart").click(function() {
		removeFromCart($(this).attr("id"), $("span#user-id").text());
	});

});

function openNav() {
	document.getElementById("sidenav").style.width = "100%";
	document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	$("ul#menu").slideUp(200);
}

function closeNav() {
	document.getElementById("sidenav").style.width = "0";
	document.body.style.backgroundColor = "rgba(0,0,0,0)";
}

function addToCart(productId, cname) {
	let cart = getCookie(cname);
	cart = cart ? JSON.parse(cart) : [];
	cart.push(productId);
	setCookie(cname, JSON.stringify(cart), 1);
}

function removeFromCart(productId, cname) {
	let cart = getCookie(cname);
	cart = cart ? JSON.parse(cart) : [];
	cart = cart.filter(function(e) { return e !== productId }); // remove from array
	deleteCookie(cname);
	setCookie(cname, JSON.stringify(cart), 1);
}

function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2)
		return parts.pop().split(";").shift();
	return "";
}

function setCookie(name, value, exp) {
	const d = new Date();
	d.setTime(d.getTime() + (exp*24*60*60*1000));
	document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
	location.reload();
}

function deleteCookie(name) {
	document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}