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
		let input = $(this).parent().siblings().find("input.prod-qty");
		let qty = input.val();
		input.val(1);
		updateCart($(this).attr("id"), qty, $("span#user-id").text());
		toggleAnimation($(this), "clicked", 3000);
	});

	$("button.remove-from-cart").click(function() {
		updateCart($(this).attr("id"), 0, userId(), true);
		location.reload();
	});

	$("button#empty-cart").click(function() {
		deleteCookie(userId());
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

	setCounter();

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

function updateCart(productId, quantity, user, remove = false) {
	let cart = getCookie(user);
	if (remove) {
		let index = cart.indexOf(productId);
		if (index > -1)
			cart.splice(index, 1);
	} else
		for (let i = 0; i < quantity; i++)
			cart.push(productId);
	setCookie(user, JSON.stringify(cart), 1);
	setCounter();
}

function getCookie(name) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) {
		let arr = parts.pop().split(";").shift();
		return JSON.parse(arr);
	}
	return [];
}

function setCookie(name, value, days) {
	const d = new Date((new Date).getTime + (days * 86400000));
	document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
}

function setCounter() {
	let cart = getCookie(userId());
	if (cart.length) {
		$("span#cart-counter").text(cart.length);
		$("span#cart-counter").css("opacity", "1");
		toggleAnimation($("span#cart-counter"), "bounce-twice", 2000);
	} else {
		$("span#cart-counter").css("opacity", "0");
	}
}

function userId() {
	return $("span#user-id").text();
}

function deleteCookie(name) {
	document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function toggleAnimation(object, name, timeout) {
	object.addClass(name);
	setTimeout(function() {
		object.removeClass(name);
	}, timeout);
}