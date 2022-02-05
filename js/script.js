$(document).ready(function() {

	$("button#expand-menu").click(() => $("ul#menu").slideToggle(200));
	$("button#search-button").click(() => $("aside#sidenav").width("100%"));
	$("button#close-search").click(() => $("aside#sidenav").width("0"));

	setTimeout(() => $("div.fade-me").slideUp(200), 3000);

	$("input#slider").on("input", function() {
		$("span#search-value").html($(this).val());
	});

	$("h2.header").click(function() {
		$(this).find("a")[0].click();
	});

	$("button.add-to-cart").click(function() {
		let input = $(this).parent().siblings().find("input.add-qty");
		let qty = input.val();
		input.val(1);
		updateCart($(this).attr("id"), qty, $("span#user-id").text(), false);
		toggleAnimation($(this), "clicked", 3000);
	});

	$("button.remove-from-cart").click(function() {
		updateCart($(this).attr("id"), 0, userId());
		location.reload();
	});

	$("input.remove-qty").on("change", function() {
		let input = $(this).val();
		updateCart($(this).attr("id"), input, userId());
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

	$("span.clear-filter").click(function() {
		let category = $(this).parent().prop("id").replace("filter", "search");
		$("#"+category).find("input[type=checkbox]").each(function() {
			$(this).prop("checked", false);
		});
		$("#"+category).find("input[type=range]").val("200");
		$("form#search-f").submit();
	});

	setCounter();

});

function updateCart(productId, quantity, user, remove = true) {
	let cart = getCookie(user);
	productId = "prod-" + productId.split("-")[1];
	if (remove)
		cart = cart.filter(e => { return e != productId });
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