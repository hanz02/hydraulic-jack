$(document).ready(() => {
	// var profileImgForm = $("#profile-img-form");
	// var profileImgfileInput = $("#profileImgFileInput");
	// var profileImgButton = $("#profileUploadButton");
	// var profileImg = $(".profile-img > img");
	//* fade in profile image on first load
	//* if image loaded from cache, on.('load') will not be triggerd so we directly fade it in
	if ($(".profile-img > img")[0].complete) {
		$(".profile-img > img").fadeIn(350);
		alert("cache load");
	} else {
		$(".profile-img > img").on("load", function () {
			alert("on load");

			$(this).fadeIn(350);
		});
	}

	$("body").on("mouseover", ".profile-img", function () {
		$("#profileUploadButton").addClass("active");
		$(".profile-img-contain span").addClass("active");
		$(".profile-img-contain").addClass("active");
		$(".bg-container").addClass("active");
	});

	$("body").on("mouseleave", ".profile-img", function () {
		$("#profileUploadButton").removeClass("active");
		$(".profile-img-contain span").removeClass("active");
		$(".profile-img-contain").removeClass("active");
		$(".bg-container").removeClass("active");
	});

	//* USER UPLOAD PROFILE IMAGE
	$("body").on("click", "#profileUploadButton", function () {
		$("#profileImgFileInput").trigger("click");
	});

	$("body").on("change", "#profileImgFileInput", function () {
		const imgFile = $("#profileImgFileInput");

		if (imgFile) {
			$("#profile-img-form").submit();
		}
	});

	$("body").on("submit", "#profile-img-form", function (e) {
		e.preventDefault();

		$.ajax({
			url: base_url + "profile_control/changeProfileImg",
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			success: function (data) {
				if (data == "INVALID FILE UPLOAD") {
					alert(data);
				} else if (data != false) {
					let profileImage = new Image();
					profileImage.onload = function () {
						$(".profile-img > img").fadeOut(350, function () {
							console.log("update 3");
							//* update profile image
							$(".profile-img > img").removeClass("default_profile");

							profileImage = $(profileImage).hide();
							$(".profile-img > img").replaceWith(profileImage);
							// .on("load", function () {
							// 	$(".profile-img > img").fadeIn(1000);
							// });

							$(".profile-img > img").fadeIn(1000);
						});
					};
					profileImage.src = base_url + "/assets/img/profile_img/" + data;

					//* update profile image for navbar mini profile as well
					$(".profile-btn > img").attr(
						"src",
						base_url + "assets/img/profile_img/" + data
					);
					$(".profile-btn").removeClass("default");

					// $(".profile-btn").removeClass("default");
				} else {
					alert("UPLOAD UNSUCCESSFUL, PLEASE TRY AGAIN");
				}
			},
		});
	});

	//* UPLOAD BACKGROUD IMAGE
	var bgImgForm = $("#profile-bg-form");
	var bg = $(".bg-container");

	$("body").on("click", `#bgUploadButton`, function () {
		$("#bgFileInput").trigger("click");
	});

	$("body").on("change", "#bgFileInput", function () {
		const imgFile = $("#bgFileInput");

		if (imgFile) {
			bgImgForm.submit();
		}
	});

	$("body").on("submit", "#profile-bg-form", function (e) {
		e.preventDefault();

		$.ajax({
			url: base_url + "profile_control/changeBgImg",
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			success: function (data) {
				if (data == "INVALID FILE UPLOAD") {
					alert(data);
				} else if (data != false) {
					bg.css("display", "none");
					const bgimage = new Image();
					bgimage.onload = function () {
						bg.css(
							"background-image",
							"url(" + base_url + "/assets/img/bg_img/" + data + ")"
						);
						bg.fadeIn(2000);
					};
					bgimage.src = base_url + "/assets/img/bg_img/" + data;
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
					const bgimage = new Image();
					bgimage.onload = function () {
						bg.css(
							"background-image",
							"url(" + base_url + "/assets/img/bg_img/" + bg_data.bg_img + ")"
						);
						bg.fadeIn(2000);
					};
					bgimage.src = base_url + "/assets/img/bg_img/" + bg_data.bg_img;
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
