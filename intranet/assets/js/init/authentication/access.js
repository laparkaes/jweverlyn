$("#form_insert_module").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/access/insert_module", "insert_module").done(function(res) {
		set_msgs("#form_insert_module", res.msgs);
		if (res.type == "success") swal_redirection(res.type, res.msg, base_url + "authentication/access/register");
		else swal(res.type, res.msg);
	});
});

$("#form_insert_access").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/access/insert_access", "insert_access").done(function(res) {
		set_msgs("#form_insert_access", res.msgs);
		if (res.type == "success") swal_redirection(res.type, res.msg, base_url + "authentication/access");
		else swal(res.type, res.msg);
	});
});