$(document).ready(() => {
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
			$.ajax({
				type: "GET",
				url: "products_control/filterProduct",
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
						$(".products-area").html(data);
					} else {
						alert("error filtering product, please try again later");
					}
				},
			});
		}
	});
});
