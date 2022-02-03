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
		updateCart($(this).attr("id"), $("span#user-id").text());
		$(this).addClass("clicked");
		setTimeout(function() {
			$("button.add-to-cart").removeClass('clicked');
		}, 3000);
	});

	$("button.remove-from-cart").click(function() {
		updateCart($(this).attr("id"), $("span#user-id").text(), true);
		location.reload();
	});

	$("input.min-today").prop("min", new Date().toISOString().split("T")[0]);

	$("input#pan").on("input", function () {
		$(this).val(function (index, value) {
			return value.replace(/[^0-9]/g, "").
				replace(/\W/gi, '').
				replace(/(.{4})/g, '$1 ').trim();
		});
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

function updateCart(productId, user, remove = false) {
	let cookie = getCookie(user);
	let cart = cookie ? JSON.parse(cookie) : [];
	if (remove) {
		let index = cart.indexOf(productId);
		if (index > -1)
			cart.splice(index, 1);
	} else
		cart.push(productId)
	setCookie(user, JSON.stringify(cart), 1);
}

function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2)
		return parts.pop().split(";").shift();
	return "";
}

function setCookie(name, value, days) {
	const d = new Date((new Date).getTime + (days * 86400000));
	document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
}

function deleteCookie(name) {
	document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}