//* fade in profile image on first load
//* if image loaded from cache, on.('load') will not be triggerd so we directly fade it in
function loadProfileImage() {
	if ($(".user-profile")[0].complete) {
		$(".loading-gif").fadeOut(1000, function () {
			$(".user-profile").fadeIn(350);
		});
	} else {
		$(".user-profile").on("load", function () {
			$(".loading-gif").fadeOut(1000, function () {
				$(".user-profile").fadeIn(350);
			});
		});
	}
}

function loadBgImage() {
	const bg = $(".bg-container");

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
						bg.fadeIn(1200);
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
}

$(document).ready(() => {
	// var profileImgForm = $("#profile-img-form");
	// var profileImgfileInput = $("#profileImgFileInput");
	// var profileImgButton = $("#profileUploadButton");
	// var profileImg = $(".profile-img > img");

	var bgImgForm = $("#profile-bg-form");
	var bg = $(".bg-container");

	//* fade in and load profile and bg
	loadProfileImage();
	loadBgImage();

	// $("body").on("mouseover", ".profile-image-wrap", function () {
	// 	$("#profileUploadButton").addClass("active");
	// 	$(".profile-img-contain").addClass("active");
	// 	$(".bg-container").addClass("active");
	// 	console.log("heerers");
	// });

	// $("body").on("mouseleave", ".profile-image-wrap", function () {
	// 	$("#profileUploadButton").removeClass("active");
	// 	$(".profile-img-contain").removeClass("active");
	// 	$(".bg-container").removeClass("active");
	// });

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
			beforeSend: function () {
				$(".user-profile").fadeOut(100, () => {
					$(".loading-gif").fadeIn(100);
				});
			},
			success: function (data) {
				if (data == "INVALID FILE UPLOAD") {
					$(".loading-gif").fadeOut(100, () => {
						$(".user-profile").fadeIn(100);
					});
					alert(data);
				} else if (data != false) {
					let profileImage = new Image();
					profileImage.onload = function () {
						$(".loading-gif").fadeOut(350, function () {
							//* update profile image
							$(".user-profile").removeClass("default_profile");

							profileImage = $(profileImage).hide();
							$(profileImage).addClass("user-profile");
							$(".user-profile").replaceWith(profileImage);
							// .on("load", function () {
							// 	$(".profile-img > img").fadeIn(1000);
							// });

							$(".user-profile").fadeIn(1000);
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
						bg.fadeIn(1200);
					};
					bgimage.src = base_url + "/assets/img/bg_img/" + data;
				} else {
					alert("UPLOAD UNSUCCESSFUL, PLEASE TRY AGAIN");
				}
			},
		});
	});
});
