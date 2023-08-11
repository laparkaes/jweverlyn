$("#form_add_module").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/access/add_module", "add_module").done(function(res) {
		set_msgs("#form_add_module", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/access/register");
	});
});

$("#form_add_access").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/access/add_access", "add_access").done(function(res) {
		set_msgs("#form_add_access", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/access");
	});
});

$(".btn_delete_module").on('click',(function(e) {
	ajax_simple_warning({module_id: $(this).val()}, "authentication/access/delete_module", "delete_module").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + "authentication/access");
	});
}));

$(".btn_delete_access").on('click',(function(e) {
	ajax_simple_warning({access_id: $(this).val()}, "authentication/access/delete_access", "delete_access").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + "authentication/access");
	});
}));
