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
				replace(/\W/gi, "").replace(/(.{4})/g, "$1 ").trim();
		});
	});

	$("input#cvv").on("input", function() {
		$(this).val(function (index, value) {
			return value.replace(/[^0-9]/g, "").replace(/\W/gi, "").trim();
		});
	});

	/** CART */
	$("button.add-to-cart").click(function() {
		let input = $(this).parent().siblings(".product-price").find(".add-quantity");
		let quantity = parseInt(input.val());
		let max = parseInt(input.attr("max"));
		if (insertProduct(productId($(this)), quantity, max))
			toggleAnimation($(this), "clicked", 3000);
		input.val(1);
	});

	$("button.remove-from-cart").click(function() {
		removeProduct(productId($(this)));
		location.reload();
	});

	$("input.update-quantity").each(function() {
		let prev = parseInt($(this).val());
		let max = parseInt($(this).attr("max"));
		$(this).change(function() {
			let quantity = parseInt($(this).val());
			if (insertProduct(productId($(this)), quantity, max, true))
				location.reload();
			else
				$(this).val(prev);
		});
	});

	$("button#empty-cart").click(function() {
		deleteCookie(userId());
		location.reload();
	});

	/** OTHERS */
	$("span.clear-filter").click(function() {
		let category = $(this).parent().prop("id").replace("filter", "search");
		$("#"+category).find("input[type=checkbox]").each(function() {
			$(this).prop("checked", false);
		});
		$("#"+category).find("input[type=range]").val("200");
		$("form#search-f").submit();
	});

	$("input.availability").each(function() {
		let input = $(this);
		let prev = input.val();
		input.change(function() {
			$.ajax({
				type: "post",
				url:  "index.php?action=catalogo&mode=availability",
				data: JSON.stringify({
					id: input.parents(".product-data").attr("id"),
					availability: input.val()
				}),
				contentType: "application/json; charset=utf-8",
				error: function(response) {
					input.val(prev);
				},
				success: function() {
					displayMessage("Modifica effettuata");
				}
			});
		});
	});

	$('#confirm-delete').on("show.bs.modal", function(e) {
		$("#delete-id").val(e.relatedTarget.id);
	});

	setCounter();
});

/** CART */
function removeProduct(productId) {
	let cart = getProducts(userId());
	cart = cart.filter(e => e["productId"] != productId);
	setCookie(userId(), JSON.stringify({ "products" : cart }), 1);
}

function insertProduct(product, quantity, max, update = false) {
	let pass = false;
	let cart = getProducts(userId());
	let index = cart.findIndex(e => e["productId"] == product);
	let cart_quantity = index > -1 && update ? cart[index]["quantity"] : 0;
	if (quantity + cart_quantity > max) {
		displayMessage("Disponibilità massima: " + max, true);
	} else if (quantity < 1) {
		displayMessage("Inserire una quantità valida", true);
	} else if (countProducts(cart) + quantity - cart_quantity <= 100) {
		if (index < 0)
			cart.push({ "productId": product, "quantity": quantity });
		else if (update)
			cart[index]["quantity"] = quantity;
		else
			cart[index]["quantity"] += quantity;
		pass = true;
	} else {
		displayMessage("Puoi inserire massimo 100 prodotti nel carrello", true);
	}
	if (pass) {
		setCookie(userId(), JSON.stringify({ "products" : cart }), 1);
		setCounter();
	}
	return pass;
}

function countProducts(cart) {
	let counter = 0;
	cart.forEach(e => counter += parseInt(e["quantity"]));
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

/** COOKIES */
function setCookie(name, value, days) {
	const d = new Date((new Date).getTime + (days * 86400000));
	document.cookie = `${name}=${value}; expires=${d.toUTCString()}; path=/`;
}

function deleteCookie(name) {
	document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

/** ANIMATIONS */
function toggleAnimation(object, name, timeout) {
	object.addClass(name);
	setTimeout(function() {
		object.removeClass(name);
	}, timeout);
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

/** UTILITY FUNCTIONS */
function userId() {
	return $("span#user-id").text();
}

function productId(element) {
	return element.parents(".product-data").attr("id");
}

function displayMessage(message, isError = false) {
	let c = isError ? "danger" : "success";
	let prompt = `<div class="fade-me"><div class="alert alert-${c}">${message}</div></div>`;
	$("main").prepend(prompt);
	setTimeout(() => $("div.fade-me").slideUp(200), 3000);
}