$(document).ready(() => {
	var quan_field = $(".quantity-field");

	//* QUANTITY BOX
	$(".quantity-btn").click(function (e) {
		const stock_amount = parseInt($(".stock-amount").text());

		if (
			$(this).attr("id") == "increment-btn" &&
			quan_field.val() < stock_amount
		) {
			quan_field.get(0).value++;
		} else if ($(this).attr("id") == "decrement-btn" && quan_field.val() > 1) {
			quan_field.get(0).value--;
		}
	});

	//* RATING STAR
	function changeStarColor(current_rating) {
		let rating = current_rating;

		for (let i = 1; i <= rating; i++) {
			$(`.star-${i}`).addClass("fa");
		}

		for (let i = rating + 1; i <= 5; i++) {
			$(`.star-${i}`).removeClass("fa");
		}

		$(".rate-text > span").html(selected_rating);
	}

	var selected_rating = 0;
	var selected_color = "black";

	//* IF USER HOVER ON RATING STAR
	$(".fa-star").hover(
		function () {
			$(".fa").css({
				color: "black",
			});

			let currentRate = parseInt($(this).data("rate"));
			changeStarColor(currentRate);

			$(".rate-text > span").html(currentRate);
		},
		function () {
			if (selected_rating == 0) {
				$(".fa-star").removeClass("fa");
				$(".rate-text > span").html("0");
			} else {
				changeStarColor(selected_rating);
			}
			if (selected_color == "pink") {
				$(".fa").css({
					color: "#E69A8DFF",
				});
			}
		}
	);

	//* IF USER CLICK ON RATING STAR
	$(".fa-star").click(function () {
		let product_id = parseInt($("#product_id").val());
		$(".rating-message").slideUp();

		if (user_id == "none") {
			//~ CHECK USER LOGIN STATUS
			window.location.replace(base_url + "login");
		} else if (
			$(this).hasClass("fa") &&
			selected_rating == $(this).data("rate")
		) {
			//* IF USER WISH TO REMOVE RATING

			$(".fa-star").removeClass("fa");
			$(".rate-text > span").html("0");

			selected_rating = 0;
			selected_color = "black";
			$(".far").css({
				color: "black",
			});

			$(".rating-message").slideUp();

			$.ajax({
				type: "POST",
				url: "removeRating",
				data: {
					user_id: user_id,
					product_id: product_id,
				},
				dataType: "text",
				cache: false,
				success: function (data) {
					$(".rating-message").html(
						'<p class="rating-success">' + data + "</p>"
					);
					$(".rating-message").slideDown();
				},
			});
		} else {
			//* IF USER WISH TO RATE OR CHANGE RATING
			let currentRate = parseInt($(this).data("rate"));

			changeStarColor(currentRate);

			$(".rate-text > span").html(currentRate);
			$(".fa").css({
				color: "#E69A8DFF",
			});

			$.ajax({
				type: "POST",
				url: "submitRating",
				data: {
					currentRate: currentRate,
					user_id: user_id,
					product_id: product_id,
				},
				dataType: "text",
				cache: false,
				success: function (data) {
					$(".rating-message").html(
						'<p class="rating-success">' + data + "</p>"
					);

					$(".rating-message").slideDown();
				},
			});

			selected_rating = currentRate;
			selected_color = "pink";
		}
	});

	$(".add-cart").click(function (e) {
		e.preventDefault();

		if (user_id == "none") {
			//~ CHECK USER LOGIN STATUS
			window.location.replace(base_url + "login");
		} else {
			var form = $(".product_details_form");

			$.ajax({
				type: "POST",
				url: base_url + "cart_control/add_to_cart",
				data: form.serialize(), // serializes the form's elements.
				success: function (data) {
					if (data == "add_successful") {
						$(".cart-message").html("PRODUCT ADDED TO CART, GO CHECK IT OUT!");
						$(".cart-link").html("GO TO CART");
						openModal();
					} else if (data == "update_successful") {
						$(".cart-message").html(
							"PRODUCT QUANTITY HAS BEEN UPDATED, GO CHECK IT OUT!"
						);
						$(".cart-link").html("GO TO CART");
						openModal();
					} else if (data == "more_than_stock_amount") {
						$(".cart-message").html(
							"TOTAL QUANTITY OF PRODUCT IN CART CANNOT BE MORE THAN STOCK AMOUNT"
						);
						$(".cart-message").addClass("alert");
						$(".cart-link").html("GO TO CART");
						openModal();
					} else {
						$(".cart-message").html(
							"OOPS! SOMTHING HAPPENED UPDATING YOUR CART"
						);
						$(".cart-message").addClass("alert");
						openModal();
					}
				},
			});
		}
	});

	//* DISPLAY THE EXISTING RATING
	if (typeof existing_rating == "undefined") {
		return false;
	} else if (existing_rating !== "none") {
		changeStarColor(existing_rating);
		selected_rating = existing_rating;
		$(".fa").css({
			color: "#E69A8DFF",
		});
		selected_color = "pink";
	}

	//* OPEN MODAL FUNCTION
	var openModal = function () {
		$(".modal").css("display", "flex");
	};
});
