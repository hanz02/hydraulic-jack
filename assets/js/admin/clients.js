$(document).ready(() => {
	$(window).on("resize", function () {
		var cw = $(".image_contain").height();
		$(".image_contain").css({ width: cw + "px" });

		if ($(this).width() > 1360) {
			$(".client_info").css({
				"padding-left": $(".image_contain").width() - 80 + "px",
			});
		} else {
			$(".client_info").css({
				"padding-left": 0,
			});
		}
	});

	var cw = $(".image_contain").height();
	$(".image_contain").css({ width: cw + "px" });

	if ($(window).width() > 1360) {
		$(".client_info").css({
			"padding-left": $(".image_contain").width() - 80 + "px",
		});
	}
});
