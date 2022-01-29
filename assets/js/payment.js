$(document).ready(() => {
	var bank_clicked;

	//* CLICK CHOOSE PAYMENT METHOD
	$(".pay-option-labels .option").click(function () {
		var payment_options = $(".pay-option-labels .option");
		var payment_form = $(".pay-form");
		var _self = $(this);
		_self.addClass("active");

		payment_options.each(function () {
			if ($(this).children("h4").text() != _self.children("h4").text()) {
				$(this).removeClass("active");
			}
		});

		payment_form.each(function () {
			if (_self.attr("id") == $(this).data("pay-form")) {
				$(this).addClass("active");
			} else {
				$(this).removeClass("active");
			}
		});
	});

	//* CLICK CHOOSE ONLINE BANKING
	$(".bank-option").click(function (event) {
		event.stopPropagation();

		var banks = $(".bank-option");
		var _self = $(this);
		_self.addClass("active");
		_self.children(".select-tick").html('<i class="fas fa-check"></i>');

		banks.each(function () {
			if ($(this).attr("id") != _self.attr("id")) {
				$(this).removeClass("active");
				$(this).children(".select-tick").html("");
			}
		});

		bank_clicked = true;
	});

	//* CLICK MAKE PAYMENT ONLINE BANKING
	$(".online-banking-form-wrap .pay-btn").click(function (e) {
		e.preventDefault();

		var banks = $(".bank-option");
		var bank_selected = false;

		banks.each(function () {
			if (!$(this).children(".select-tick").is(":empty")) {
				bank_selected = true;
				$(this).parent().closest("form").submit();
				return false;
			}
		});

		if (bank_selected == false) {
			$(".online-banking-form-wrap .alert").toggle();
		}
	});

	$(document).click(function (e) {
		if (bank_clicked == true) {
			$(".bank-option").removeClass("active");
			$(".bank-option").children(".select-tick").html("");
		}
	});

	// * CLOSE BUTTON
	$(".close-btn").click(function () {
		$(this).parent().closest(".alert").toggle();
	});
});
