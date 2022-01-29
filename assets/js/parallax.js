$(document).ready(() => {
	var bgimage = new Image();
	bgimage.src = base_url + "/assets/img/Corridor.jpg";
	$(bgimage).on("load", function () {
		$(".parallax_bg").css(
			"background-image",
			"url(" + base_url + "/assets/img/Corridor.jpg )"
		);
		$(".parallax_bg").fadeIn(700);
		parallax();
	});

	$(window).scroll(function () {
		parallax();
	});

	var parallax = function () {
		if ($(window).width() > 800) {
			var scrollBottom =
				$(document).height() - $(window).height() - $(window).scrollTop();
			var wScroll = $(window).scrollTop();
			$(".parallax_bg").css({
				"background-position-x": -10 + -wScroll / 4 + "px",
				"background-size": 110 + wScroll / 100 + "%",
			});

			if (wScroll < 1000) {
				$("#first.parallax_img").css(
					"background-position",
					"center " + -wScroll * 0.25 + "px"
				);
			}
			if (wScroll < 2000) {
				$("#second.parallax_img").css(
					"background-position",
					"center " + (scrollBottom - 1000) * 0.25 + "px"
				);
			}
		} else {
			$(".parallax_bg").css({
				"background-position-x": "center",
				"background-size": "cover",
			});

			$("#first.parallax_img").css("background-position", "center");

			$("#second.parallax_img").css("background-position", "center");
		}
	};

	$(window).resize(function () {
		if ($(window).width() > 800) {
			var scrollBottom =
				$(document).height() - $(window).height() - $(window).scrollTop();
			var wScroll = $(window).scrollTop();
			$(".parallax_bg").css({
				"background-position-x": -10 + -wScroll / 4 + "px",
				"background-size": 110 + wScroll / 100 + "%",
			});

			if (wScroll < 1000) {
				$("#first.parallax_img").css(
					"background-position",
					"center " + -wScroll * 0.25 + "px"
				);
			}
			if (wScroll < 2000) {
				$("#second.parallax_img").css(
					"background-position",
					"center " + (scrollBottom - 1000) * 0.25 + "px"
				);
			}
		} else {
			$(".parallax_bg").css({
				"background-position-x": "center",
				"background-size": "cover",
			});

			$("#first.parallax_img").css("background-position", "center");

			$("#second.parallax_img").css("background-position", "center");
		}
	});
});
