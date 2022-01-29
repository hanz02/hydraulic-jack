$(document).ready(() => {
	var to_remove_btn = null;

	//* DROP DOWN MENU SHOWS
	$(".default-option").click(function () {
		$(this).parent().toggleClass("active");
	});

	//* DROP DOWN MENU CLOSE ON CLICKING OPTIONS
	$(".alt-option li").click(function () {
		var currentStatus = $(this)
			.parent()
			.closest(".option-menu")
			.find(".default-option .option_text")
			.text(); //* IN LOWERCASE

		var chosedOption = $(this).find(".option_text").text().toLowerCase();

		if (currentStatus == chosedOption) {
			//* STATUS CHOSEN IS THE SAME (NO NEED TO UPDATE STATUS)

			$(this).parent().closest(".option-menu").removeClass("active");
			return;
		} else {
			//* UPDATE PRODUCT STATUS HERE
			$(".update_alert").fadeOut(100);

			$.ajax({
				type: "POST",
				url: base_url + "admin/products_control/updateProductStatus",
				cache: false,
				context: this,
				async: false,

				data: {
					status: chosedOption,
					product_id: $(this)
						.parent()
						.closest("form")
						.find("input.product_id")
						.val(),
				},
				dataType: "text",
				success: function (data) {
					if (data == true) {
						const currentOpt = $(this).html();

						$(this)
							.parent()
							.closest(".option-menu")
							.find(".default-option li")
							.html(currentOpt);
						$(this).find("input").attr("name", "status_selected");
						$(this).parent().closest(".option-menu").removeClass("active");

						$(".update_alert").fadeIn(100);
						$("html, body").animate({ scrollTop: 0 }, "fast");
					} else {
						$(".update_alert .text").html("ERROR UPDATING PRODUCT");
						$(".update_alert").addClass("error");

						$(this).parent().closest(".option-menu").removeClass("active");
					}
				},
			});
		}
	});

	$(".update_alert .fas").click(function () {
		$(".update_alert").removeClass("error");
		$(".update_alert").fadeOut(100);
	});

	// //* REMOVE PRODUCTS
	$(".remove_product_btn").click(function () {
		to_remove_btn = $(this);
		$("#confirm_delete.modal").css("display", "flex");
		$("#confirm_delete.modal .confirm-message").html(
			"ARE YOU SURE YOU WANT TO DELETE THE PRODUCT? PRODUCT DELETED MIGHT NOT BE RECOVERABLE"
		);
	});

	$(".modal .confirm-modal .modal-btn button").click(function () {
		if ($.trim($(this).text()) == "CANCEL") {
			$(".modal").fadeOut(100);
		} else if ($.trim($(this).text()) != "CANCEL" && to_remove_btn != null) {
			$.ajax({
				type: "POST",
				url: "Products_control/removeProducts",
				async: false,
				data: {
					p_id: to_remove_btn
						.parent()
						.closest(".product_contain")
						.find("input.product_id")
						.val(),
				},
				dataType: "text",
				success: function (data) {
					if (data == true) {
						to_remove_btn.parent().closest(".individual_product_form").remove();
						$(".modal").fadeOut(100);
						$(".update_alert .text").html("PRODUCT REMOVED");
						$(".update_alert").fadeIn(100);
					} else {
						$(".update_alert .text").html("ERROR UPDATING PRODUCT");
						$(".update_alert").addClass("error");
						$(this).parent().closest(".option-menu").removeClass("active");
					}
				},
			});
		}
	});

	//* VIEW PRODUCT SPEC
	$(".product_name a").click(function () {
		$(this).parent().closest("form").submit();
	});

	$(".edit_product_btn").click(function () {
		$(this).parent().closest("form").submit();
	});

	//* EDIT INDIVIDUAL PRODUCTS
	$(".edit_btn").click(function () {
		var my_parent = $(this).parent().closest(".editable_group");

		my_parent.find(".editable").addClass("active");
		my_parent.find(".editable_text").addClass("hide");

		$(this).addClass("hide");
		my_parent.find(".cancel_btn").addClass("active");
		$(".cancel_all_btn").addClass("active");
	});

	$(".cancel_btn").click(function () {
		var my_parent = $(this).parent().closest(".editable_group");
		var currentValue = my_parent.find(".editable_text").text();

		my_parent.find(".editable").val(currentValue);

		my_parent.find(".editable").removeClass("active");
		my_parent.find(".editable_text").removeClass("hide");

		my_parent.find(".cancel_btn").removeClass("active");
		my_parent.find(".edit_btn").removeClass("hide");
	});

	$(".edit_all_btn").click(function () {
		$(".editable").addClass("active");
		$(".editable_text").addClass("hide");

		$(".edit_btn").addClass("hide");
		$(".cancel_btn").addClass("active");
	});

	$(".update_btn").click(function (e) {
		e.preventDefault();
		var spec_form = $(".product_spec_form").serialize();

		$.ajax({
			type: "POST",
			url: base_url + "admin/products_control/update_product_spec",
			context: this,
			cache: false,

			data: spec_form + "&AddInventory=1",
			dataType: "text",
			success: function (data) {
				if (data == true) {
					$(".editable_text").each(function () {
						var editableText = $(this);
						$(".editable").each(function () {
							if (editableText.parent().is($(this).parent())) {
								editableText.text($(this).val());
							}
						});
					});

					$(".editable").removeClass("active");
					$(".editable_text").removeClass("hide");

					$(".cancel_btn").removeClass("active");
					$(".edit_btn").removeClass("hide");

					$(".update_alert").fadeIn(100);
					$("html, body").animate({ scrollTop: 0 }, "fast");
				} else {
					$(".update_alert .text").html("ERROR UPDATING PRODUCT");
					$(".update_alert").addClass("error");

					$(this).parent().closest(".option-menu").removeClass("active");
				}
			},
		});
	});

	$(".close-btn").click(function () {
		$(".modal").fadeOut(100);
	});

	
});
