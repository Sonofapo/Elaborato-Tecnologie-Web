$(document).ready(function() {

	/** ANIMATIONS */
	$("button#expand-menu").click(() => {
		$("ul#menu").slideToggle(200);
		$("span#notification-1").toggle();
	});
	$("button#search-button").click(() => $("aside#sidenav").width("100%"));
	$("button#close-search").click(() => $("aside#sidenav").width("0"));

	setTimeout(() => $("div.fade-me").slideUp(200), 3000);

	$("h2.header").click(function() {
		$(this).toggleClass("selected");
	});

	$("li.hover-click").click(function() {
		let checkbox = $(this).find("input[type=checkbox]");
		let value = !checkbox.is(":checked");
		checkbox.prop("checked", value);
		if (value)
			$(this).find("label").addClass("checked");
		else
			$(this).find("label").removeClass("checked");
	});

	$("input[type=checkbox]").each(function() {
		if ($(this).is(":checked"))
			$(this).siblings("label").addClass("checked");
		else
			$(this).siblings("label").removeClass("checked");
	});

	/** INPUT CHECK AND VALIDATION */
	$("input#slider").on("input", function() {
		$("span#search-value").html($(this).val());
	});

	$("input.min-today").prop("min", new Date().toISOString().split("T")[0]);

	$("input#pan").on("input", function () {
		$(this).val(function (index, value) {
			return value.replace(/[^0-9]/g, "").
				replace(/\W/gi, '').
				replace(/(.{4})/g, '$1 ').trim();
		});
	});

	$("input#cvv").on("input", function() {
		$(this).val(function (index, value) {
			return value.replace(/[^0-9]/g, "").
				replace(/\W/gi, '').trim();
		});
	});

	/** CART */
	$("button.add-to-cart").click(function() {
		let input = $(this).parent().siblings().find("input.add-quantity");
		let quantity = input.val();
		if (quantity > 0) {
			if (insertProduct($(this).attr("id"), quantity))
				toggleAnimation($(this), "clicked", 3000);
			else
				displayError("Puoi inserire al massimo 100 oggetti");
		} else
			displayError("Inserire un valore valido");
		input.val(1);
	});

	$("button.remove-from-cart").click(function() {
		removeProduct($(this).attr("id"));
		location.reload();
	});

	$("input.update-quantity").each(function() {
		let prev = $(this).val();
		$(this).change(function() {
			let quantity = $(this).val();
			if (quantity > 0) {
				let name = "prod-" + $(this).attr("id").split("-")[1];
				if (insertProduct(name, Number(quantity) - Number(prev)))
					location.reload();
				else {
					displayError("Puoi inserire al massimo 100 oggetti");
					$(this).val(prev);
				}
			} else {
				displayError("Inserire un valore valido");
				$(this).val(prev);
			}
		});
	});

	$("button#empty-cart").click(function() {
		deleteCookie(userId());
		location.reload();
	});

	setCounter();

	/** OTHERS */
	$("span.clear-filter").click(function() {
		let category = $(this).parent().prop("id").replace("filter", "search");
		$("#"+category).find("input[type=checkbox]").each(function() {
			$(this).prop("checked", false);
		});
		$("#"+category).find("input[type=range]").val("200");
		$("form#search-f").submit();
	});
});

function removeProduct(product) {
	let cart = getProducts(userId());
	cart = cart.filter(e => e["name"] != product);
	setCookie(userId(), JSON.stringify({ "products" : cart }), 1);
}

function insertProduct(product, quantity) {
	let pass = false;
	let cart = getProducts(userId());
	let index = cart.findIndex(e => e["name"] == product);
	quantity = Number(quantity);
	if (index < 0 && countProducts(cart) + quantity <= 100) {
		cart.push({ "name": product, "quantity": quantity });
		pass = true;
	} else if (countProducts(cart) + quantity <= 100) {
		cart[index]["quantity"] += quantity;
		pass = true;
	}
	if (pass) {
		setCookie(userId(), JSON.stringify({ "products" : cart }), 1);
		setCounter();
	}
	return pass;
}

function countProducts(cart) {
	let counter = 0;
	cart.forEach(e => counter += Number(e["quantity"]));
	return counter;
}

function getProducts(userId) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${userId}=`);
	if (parts.length === 2) {
		let arr = parts.pop().split(";").shift();
		return JSON.parse(arr)["products"];
	}
	return [];
}

function setCookie(name, value, days) {
	const d = new Date((new Date).getTime + (days * 86400000));
	document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
}

function setCounter() {
	let cart = getProducts(userId());
	if (countProducts(cart)) {
		$("span#cart-counter").text(countProducts(cart));
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

function displayError(message) {
	let prompt = `<div class="fade-me"><div class="alert alert-danger">${message}</div></div>`;
	$("main").prepend(prompt);
	setTimeout(() => $("div.fade-me").slideUp(200), 3000);
}