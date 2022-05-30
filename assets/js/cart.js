$(document).ready(() => {
	var quantity_value = 0;

	var calcTotalItem = function () {
		quantity_value = 0;
		$(".quantity .quantity-field").each(function () {
			if ($(this).val() != "OUT OF STOCK" && $(this).is("input")) {
				quantity_value += parseInt($(this).val());
			} else if ($(this).is("span") && $(this).html() != "OUT OF STOCK") {
				quantity_value += parseInt($(this).html());
			}
		});

		$(".item-count .value").html(quantity_value);
	};

	var calcSubTotal = function () {
		var subtotal_value = 0;

		$(".quantity-field").each(function () {
			if ($(this).val() != "OUT OF STOCK" && $(this).is("input")) {
				var quantity = $(this).val();
				var price = $(this).parent().closest(".cart-item").find("#price").val();
			} else if ($(this).is("span") && $(this).html() != "OUT OF STOCK") {
				var quantity = parseInt($(this).html());
				var price = parseFloat(
					$(this).parent().closest(".item").find(".price-field").html()
				);
			}

			subtotal_value += price * quantity;
		});

		$(".subtotal .value").html(subtotal_value.toFixed(2));
	};

	var calcGrandTotal = function () {
		var grandtotal_value = parseFloat($(".subtotal .value").text());

		$(".total .value").html(grandtotal_value.toFixed(2));
	};

	calcTotalItem();
	calcSubTotal();
	calcGrandTotal();

	//* REMOVE CART ITEM
	$(".remove-product").click(function (e) {
		e.preventDefault();
		var currentElement = $(this);
		$.ajax({
			type: "POST",
			url: "cart_control/remove_cart_product",
			data: {
				product_id: $(this).find(".product_id").val(),
			},
			dataType: "text",
			cache: false,
			success: function (data) {
				if (data == true) {
					currentElement
						.parent()
						.closest(".cart-product-form")
						.fadeOut(function () {
							this.remove();

							calcTotalItem();
							calcSubTotal();
							calcGrandTotal();

							console.log(quantity_value);

							if (quantity_value <= 0) {
								window.location.replace(base_url + "cart");
							}
						});
				} else {
					return false;
				}
			},
		});
	});

	//* DESIGN FOR TOTAL CALCULATION BOTTOM banner
	var banner_height = $(".total-banner").outerHeight();
	$(".cart-products").css("padding-bottom", banner_height);

	//* INCREMENT CART ITEM
	$(".increment-btn").click(function (e) {
		var current_element = $(this);
		current_element.parent().closest(".cart-item").find(".alert").slideUp();

		var product_id_input = $(this)
			.parent()
			.closest(".cart-item")
			.find(".product_id")
			.val();

		var cart_id = $(this).parent().closest(".cart-item").find(".cart_id").val();
		var quantity = $(this).siblings(".quantity-field");
		var stock_amount = $(this)
			.parent()
			.closest(".cart-item")
			.find(".stock-amount");

		if (parseInt(quantity.val()) < parseInt(stock_amount.val())) {
			$.ajax({
				type: "POST",
				url: "cart_control/increment_cart_product",
				data: {
					cart_id: cart_id,
					quantity: quantity.val(),
					product_id: product_id_input,
				},
				dataType: "text",
				cache: false,
				success: function (data) {
					if (data != false) {
						quantity.val(data);

						calcTotalItem();
						calcSubTotal();
						calcGrandTotal();
					} else {
						current_element
							.parent()
							.closest(".cart-item")
							.find(".alert .alert-msg")
							.text("ERROR UPDATING CART");

						current_element
							.parent()
							.closest(".cart-item")
							.find(".alert")
							.slideDown();
					}
				},
			});
		} else {
			current_element
				.parent()
				.closest(".cart-item")
				.find(".alert .alert-msg")
				.text("MAXIMUM QUANTITY REACHED");

			current_element.parent().closest(".cart-item").find(".alert").slideDown();
		}
	});

	//* DECREMENT CART ITEM
	$(".decrement-btn").click(function (e) {
		var current_element = $(this);
		current_element.parent().closest(".cart-item").find(".alert").slideUp();

		var product_id_input = $(this)
			.parent()
			.closest(".cart-item")
			.find(".product_id")
			.val();

		var cart_id = $(this).parent().closest(".cart-item").find(".cart_id").val();
		var quantity = $(this).siblings(".quantity-field");

		if (parseInt(quantity.val()) > 1) {
			$.ajax({
				type: "POST",
				url: "cart_control/decrement_cart_product",
				data: {
					cart_id: cart_id,
					quantity: quantity.val(),
					product_id: product_id_input,
				},
				dataType: "text",
				cache: false,
				success: function (data) {
					if (data != false) {
						quantity.val(data);
						calcTotalItem();
						calcSubTotal();
						calcGrandTotal();
					} else {
						current_element
							.parent()
							.closest(".cart-item")
							.find(".alert .alert-msg")
							.text("ERROR UPDATING CART");

						current_element
							.parent()
							.closest(".cart-item")
							.find(".alert")
							.slideDown();
					}
				},
			});
		}
	});

	// * CLOSE BUTTON
	$(".close-btn").click(function () {
		$(this).parent().closest("form").find(".alert").slideUp();
	});

	// *CHECK CART STOCK
	var check_cart_stock = function () {
		$.ajax({
			url: "cart_control/check_cart_stock",
			cache: false,
			success: function (data) {
				if (data == true) {
					return true;
				} else {
					return false;
				}
			},
		});
	};

	//* CHECKOUT BUTTON
	$(".checkout-btn").click(function () {
		if (check_cart_stock() == true) {
		} else {
			window.location.href = base_url + "cart_control/checkout_cart";
		}
	});

	//* PLACE ORDER BUTTON
	$(".place-order-btn").click(function (e) {
		e.preventDefault();

		if (!$(".email-field").val()) {
			$(this)
				.parent()
				.closest(".checkout-form")
				.find(".email .alert .alert-msg")
				.text("EMAIL CANNOT BE EMPTY");

			$(this)
				.parent()
				.closest(".checkout-form")
				.find(".email .alert")
				.slideDown();
		} else if (!$(".term-cond input").is(":checked")) {
			e.preventDefault();

			$(this)
				.parent()
				.closest(".checkout-form")
				.find(".term-cond .alert .alert-msg")
				.text("PLEASE AGREE TO OUR TERM AND CONDITIONS BEFORE PROCEED");

			$(this)
				.parent()
				.closest(".checkout-form")
				.find(".term-cond .alert")
				.slideDown();
		} else {
			$.ajax({
				type: "POST",
				url: base_url + "user_control/validate_email",
				cache: false,
				context: this,
				data: {
					email: $(".email-field").val(),
				},
				dataType: "text",
				success: function (data) {
					if (data == true) {
						if (check_cart_stock() == true) {
						} else {
							$(this).parent().closest(".checkout-form").submit();
						}
					} else {
						$(this)
							.parent()
							.closest(".checkout-form")
							.find(".email .alert .alert-msg")
							.text("INVALID EMAIL");

						$(this)
							.parent()
							.closest(".checkout-form")
							.find(".email .alert")
							.slideDown();
					}
				},
			});
		}
	});
});
