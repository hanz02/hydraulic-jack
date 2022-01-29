$(document).ready(() => {
	//* WHEN USER CLICK ON RPODUCT NAME ( WE BRING HIM TO THE PRODUCT SPEC PAGE )
	$(document).on("click", ".product_name", function (e) {
		e.preventDefault();
		var product_id = $(this)
			.parent()
			.closest(".product_info")
			.find("input.product_id")
			.val();
		window.location =
			"products_control/view_product_spec?product_id=" + product_id;
	});
	
	//* DROP DOWN MENU SHOWS
	$(".default-option").click(function () {
		$(this).parent().toggleClass("active");
	});

	$(".alt-option li").click(function () {
		var currentStatus = $(this)
			.parent()
			.closest(".option-menu")
			.find(".default-option .option_text")
			.text(); //* IN LOWERCASE

		var chosedOption = $(this).find(".option_text").text();

		if (currentStatus == chosedOption) {
			//* STATUS CHOSEN IS THE SAME (NO NEED TO UPDATE STATUS)

			$(this).parent().closest(".option-menu").removeClass("active");
			return;
		} else {
			//* UPDATE PRODUCT STATUS HERE
			$.ajax({
				type: "GET",
				url: base_url + "admin/payment_control/filterLatest",
				cache: false,
				context: this,
				data: {
					option: $(this).find("input").val(),
				},
				success: function (data) {
					if (data != true) {
						const currentOpt = $(this).html();

						$(this)
							.parent()
							.closest(".option-menu")
							.find(".default-option li")
							.html(currentOpt);
						$(this).find("input").attr("name", "filter_selected");
						$(this).parent().closest(".option-menu").removeClass("active");

						$(".result").html(data);
					} else {
						alert("error filtering product, please try again later");
					}
				},
			});
		}
	});
});
