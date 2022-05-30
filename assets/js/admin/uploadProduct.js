$(document).ready(() => {
	// * ADD PRODUCTS
	var tmpImg = new Image();
	tmpImg.src = $(".uploaded_img").attr("src");

	sizeImage = function (width, height, d_width, d_height) {
		var UploadImgContainer = $(".img_contain");
		var UploadImgContainerMaxWidth = $(".img_contain")
			.css("max-width")
			.replace("px", "");

		if (width > height && width - height > 100) {
			//! image is a landscape (NEED TO MAKE SURE LANDSCAPE IS VISIBLE ENOUGH > 100PX)
			if ($(window).width() < parseInt(UploadImgContainerMaxWidth) + 150) {
				//* WE GOT TO THE VERY SMALL SCREEN, PRIORTIZE ON WIDTH IF SMALLER THAN (650PX) BREAKING SCREEN POINT
				//* image is a landscape (PRIORITIZE ON WIDTH on small screen)
				$(".admin_products #adding_product.modal .img_contain .wrapper").css({
					width: "100%",
					height: "auto",
				});

				$(".admin_products #adding_product.modal .img_contain img").css({
					width: "100%",
					height: "auto",
				});
			} else {
				//* image is a landscape on big screen (PRIORITIZE ON WIDTH)
				$(".admin_products #adding_product.modal .img_contain .wrapper").css({
					width: "100%",
					height: "auto",
				});

				$(".admin_products #adding_product.modal .img_contain img").css({
					width: "100%",
					height: "auto",
				});
			}
		} else if (width < height && height - width > 100) {
			//! image is a potrait (PRIORITIZE ON HEIGHT on big, WIDTH on small)
			if (height / width > 2) {
				//* height of the portrait too long (cannot priortize on width on small screen anymore (OVERFLOWING HEIGHT), MUST PRIORITIZE ON HEIGHT)
				$(".admin_products #adding_product.modal .img_contain .wrapper").css({
					height: "100%",
					width: "auto",
				});

				$(".admin_products #adding_product.modal .img_contain img").css({
					height: "100%",
					width: "auto",
				});
			} else if (
				$(window).width() <
				parseInt(UploadImgContainerMaxWidth) - 100
			) {
				//* WE GOT TO THE VERY SMALL SCREEN, GOTTA PRIORTIZE ON WIDTH AT smaller(400PX) BREAKING SCREEN POINT
				//* image is a potrait ( PRIORITIZE ON WIDTH on small screen)
				$(".admin_products #adding_product.modal .img_contain .wrapper").css({
					width: "100%",
					height: "auto",
				});

				$(".admin_products #adding_product.modal .img_contain img").css({
					width: "100%",
					height: "auto",
				});
			} else {
				//* image is a potrait on Big screen (PRIORITIZE ON HEIGHT)
				$(".admin_products #adding_product.modal .img_contain .wrapper").css({
					height: "100%",
					width: "auto",
				});

				$(".admin_products #adding_product.modal .img_contain img").css({
					height: "100%",
					width: "auto",
				});
			}
		} else {
			//! image is a square (PRIORITIZE ON HEIGHT on big, WIDTH on small)
			if ($(window).width() < parseInt(UploadImgContainerMaxWidth) + 100) {
				// console.log("squeare");
				//* WE GOT TO THE VERY SMALL SCREEN, GOTTA PRIORTIZE ON WIDTH AT smaller(600PX) BREAKING SCREEN POINT
				// alert(UploadImgContainerMaxWidth);
				//* image is a square (FULLY PRIORITIZE ON WIDTH)
				$(".admin_products #adding_product.modal .img_contain .wrapper").css({
					width: "100%",
					height: "auto",
				});

				$(".admin_products #adding_product.modal .img_contain img").css({
					width: "100%",
					height: "auto",
				});
			} else {
				//* image is a square on BIG screen (PRIORITIZE ON HEIGHT)
				$(".admin_products #adding_product.modal .img_contain .wrapper").css({
					height: "100%",
					width: "auto",
				});

				$(".admin_products #adding_product.modal .img_contain img").css({
					height: "100%",
					width: "auto",
				});
			}
		}
	};

	sizeImage(tmpImg.width, tmpImg.height);

	$(window).on("resize", function () {
		sizeImage(tmpImg.width, tmpImg.height);
	});

	//* IF USER CLICK ON "ADD PRODUCT" BUTTON
	$(".add_product").click(function () {
		$("#adding_product.modal").fadeIn(300);

		var $img = $(".uploaded_img");
		$img.on("load", function () {
			var DefaultImg = new Image();
			DefaultImg.src = $(".uploaded_img").attr("src");
			sizeImage(DefaultImg.width, DefaultImg.height);
		});
	});

	//* IF USER CLICK ON "UPLOAD IMAGE" BUTTON
	$(".upload_productImg_btn").click(function () {
		$("#productImgUpload").trigger("click");
	});

	//* IF USER UPLOADED A PHOTO FROM COMPUTER/DEVICES
	$("#productImgUpload").change(function (e) {
		var file = URL.createObjectURL(e.target.files[0]);

		img = new Image();
		var imgwidth = 0;
		var imgheight = 0;

		img.src = file;

		img.onload = function () {
			imgwidth = this.width;
			imgheight = this.height;

			$(".uploaded_img").attr("src", file);
			var $img = $(".uploaded_img");
			$img.on("load", function () {
				tmpImg.src = $(".uploaded_img").attr("src");
				sizeImage(imgwidth, imgheight);
			});
		};
	});

	var check_result = false;
	//* CHANGE PRODUCT STATUS

	var mandatory_fields = $(
		"#adding_product.modal .product_info .form_group .mandatory"
	);
	var stock_amount = $(
		"#adding_product.modal .product_info .form_group input[name='stock_amount']"
	);
	var product_price = $(
		"#adding_product.modal .product_info .form_group input[name='product_price']"
	).val();
	var upload_alert = $("#adding_product.modal .upload_alert");

	$("#adding_product.modal .product_status .alt-option li").click(function () {
		const selectedOpt = $(this).html();
		const defaultOpt = $(this)
			.parent()
			.closest(".product_status")
			.find(".default-option li");
		defaultOpt.html(selectedOpt);
		defaultOpt.find("input").attr("name", "status_selected");
		defaultOpt.parent().find(".option-menu").toggleClass("active");
	});

	//* VERIFY UPLOAD PRODUCT FORM FIELDS
	checkProductUploadFormEmpty = function (fields) {
		fields.each(function () {
			if ($(this).val() == "") {
				return (check_result = false);
			} else {
				check_result = true;
			}
		});
		return check_result;
	};

	checkIntegerInput = function (fields) {
		fields.each(function () {
			if ($(this).val().match(/^\d+$/)) {
				check_result = true;
			} else {
				return (check_result = false);
			}
		});
		return check_result;
	};

	//* WHEN USER SUBMIT AND UPLOAD EVERYTHING FOR A PRODUCT
	$("form.upload_product_form").submit(function (e) {
		e.preventDefault();
		mandatory_fields = $(
			"#adding_product.modal .product_info .form_group .mandatory"
		);
		stock_amount = $(
			"#adding_product.modal .product_info .form_group input[name='stock_amount']"
		);
		product_price = $(
			"#adding_product.modal .product_info .form_group input[name='product_price']"
		).val();

		if (!$("#productImgUpload").val()) {
			upload_alert.fadeOut(100);
			upload_alert
				.find(".text")
				.html("No image uploaded, please upload an image");
			upload_alert.fadeIn(200);
		} else if (checkProductUploadFormEmpty(mandatory_fields) == false) {
			upload_alert.fadeOut(100);
			upload_alert.find(".text").html("Please do not leave the fields empty");
			upload_alert.fadeIn(200);
		} else if (checkIntegerInput(stock_amount) == false) {
			upload_alert.fadeOut(100);
			upload_alert.find(".text").html("Stock amount must be a digit number");
			upload_alert.fadeIn(200);
		} else if ($.isNumeric(product_price) == false) {
			upload_alert.fadeOut(100);
			upload_alert.find(".text").html("Product price must be numeric");
			upload_alert.fadeIn(200);
		} else {
			upload_alert.fadeOut(100);
			upload_alert.find(".text").html("");
			if (product_price[product_price.length - 1] == ".") {
				$(
					"#adding_product.modal .product_info .form_group input[name='product_price']"
				).val(product_price.replace(/.([^.]*)$/, "$1"));
			}

			$.ajax({
				url: base_url + "admin/products_control/uploadProduct",
				type: "post",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: true,
				success: function (data) {
					// alert(data);
					if (data == true) {
						upload_alert.fadeOut(100);
						upload_alert.children("div").css({
							"border-color": "#519d90",
							color: "#519d90",
						});
						upload_alert.find(".text").html("Product uploaded successfully");
						upload_alert.fadeIn(50);
						location.reload();
					} else {
						// alert("UPLOAD UNSUCCESSFUL, PLEASE TRY AGAIN");
						upload_alert.fadeOut(100);
						upload_alert
							.find(".text")
							.html("Upload unsuccessful, please try again");
						upload_alert.fadeIn(200);
					}
				},
			});
		}
	});

	$(document).on({
		ajaxStart: function () {
			upload_alert.fadeOut(100);
			upload_alert.children("div").css({
				"border-color": "#FFE162",
				color: "#FFE162",
			});
			upload_alert.find(".text").html("Uploading Product..");
			upload_alert.fadeIn(50);
		},
		ajaxStop: function () {
			upload_alert.fadeOut(100);
		},
	});

	$("form.upload_product_form .fa-times-circle").click(function () {});
});
