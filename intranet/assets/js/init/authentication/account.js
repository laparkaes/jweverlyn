$("#form_add_account").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/account/add", "add_account").done(function(res) {
		set_msgs("#form_add_account", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/account/edit/" + res.account_id);
	});
});

$("#form_update_account").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/account/update", "update_account").done(function(res) {
		set_msgs("#form_update_account", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/account/edit/" + res.account_id);
	});
});

$("#form_update_password").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/account/update_password", "update_password").done(function(res) {
		set_msgs("#form_update_password", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/account/edit/" + res.account_id);
	});
});

$("#form_deactivate_account").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/account/deactivate", "deactivate_account").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + "authentication/account/edit/" + res.account_id);
	});
});

$("#form_activate_account").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/account/activate", "activate_account").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + "authentication/account/edit/" + res.account_id);
	});
});