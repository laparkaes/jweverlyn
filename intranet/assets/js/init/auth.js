$("#form_login_validation").submit(function(e) {
	e.preventDefault();
	ajax_form(this, "auth/login_validation").done(function(res) {
		set_msgs("#form_login_validation", res.msgs);
		if (res.type == "success") window.location.href = "./dashboard";
	});
});