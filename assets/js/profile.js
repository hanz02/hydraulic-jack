$(document).ready(() => {
	var profileImgForm = $("#profile-img-form");
	var profileImgfileInput = $("#profileImgFileInput");
	var profileImgButton = $("#profileUploadButton");
	var profileImg = $(".profile-img > img");

	$(".profile-img").mouseover(function () {
		profileImgButton.addClass("active");
		$(".profile-img-contain span").addClass("active");
		$(".profile-img-contain").addClass("active");
		$(".bg-container").addClass("active");
	});

	$(".profile-img").mouseleave(function () {
		profileImgButton.removeClass("active");
		$(".profile-img-contain span").removeClass("active");
		$(".profile-img-contain").removeClass("active");
		$(".bg-container").removeClass("active");
	});

	//* USER UPLOAD PROFILE IMAGE
	profileImgButton.click(function () {
		profileImgfileInput.trigger("click");
	});

	profileImgfileInput.change(function () {
		const imgFile = profileImgfileInput;

		if (imgFile) {
			profileImgForm.submit();
		}
	});

	profileImgForm.submit(function (e) {
		e.preventDefault();

		$.ajax({
			url: base_url + "profile_control/changeProfileImg",
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function (data) {
				if (data == "INVALID FILE UPLOAD") {
					alert(data);
				} else if (data != false) {
					profileImg.attr("src", base_url + "assets/img/profile_img/" + data);
					$(".profile-btn img").attr(
						"src",
						base_url + "assets/img/profile_img/" + data
					);
					$(".profile-btn").removeClass("default");
				} else {
					alert("UPLOAD UNSUCCESSFUL, PLEASE TRY AGAIN");
				}
			},
		});
	});

	//* UPLOAD BACKGROUD IMAGE
	var bgImgForm = $("#profile-bg-form");
	var bgfileInput = $("#bgFileInput");
	var bgButton = $("#bgUploadButton");
	var bg = $(".bg-container");

	bgButton.click(function () {
		bgfileInput.trigger("click");
	});

	bgfileInput.change(function () {
		const imgFile = bgfileInput;

		if (imgFile) {
			bgImgForm.submit();
		}
	});

	bgImgForm.submit(function (e) {
		e.preventDefault();

		$.ajax({
			url: base_url + "profile_control/changeBgImg",
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function (data) {
				if (data == "INVALID FILE UPLOAD") {
					alert(data);
				} else if (data != false) {
					bg.css("display", "none");
					var bgimage = new Image();
					bgimage.src = base_url + "/assets/img/bg_img/" + data;
					$(bgimage).on("load", function () {
						bg.css(
							"background-image",
							"url(" + base_url + "/assets/img/bg_img/" + data + ")"
						);
						bg.fadeIn(2000);
					});
				} else {
					alert("UPLOAD UNSUCCESSFUL, PLEASE TRY AGAIN");
				}
			},
		});
	});

	//* LOAD BACKGROUD IMAGE
	$.ajax({
		url: base_url + "profile_control/loadBgUser",
		type: "get",
		cache: false,
		success: function (data) {
			if (data != false) {
				var bg_data = JSON.parse(data);

				if (bg_data.bg_state == "1") {
					bg.css("display", "none");
					var bgimage = new Image();
					bgimage.src = base_url + "/assets/img/bg_img/" + bg_data.bg_img;
					$(bgimage).on("load", function () {
						bg.css(
							"background-image",
							"url(" + base_url + "/assets/img/bg_img/" + bg_data.bg_img + ")"
						);
						bg.fadeIn(2000);
					});
				} else {
					bg.css("background-image", "url(" + base_url + bg_data.bg_img + ")");
					bg.fadeIn(2000);
				}
			} else {
				alert("Error loading backgroung image");
			}
		},
	});
});
