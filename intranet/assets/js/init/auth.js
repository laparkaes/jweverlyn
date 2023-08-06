$("#form_login_validation").submit(function(e) {
	e.preventDefault();
	ajax_form(this, "auth/login_validation").done(function(res) {
		swal("success", res);
		//swal(res.type, res.msg);
		//if (res.type == "success") set_product_update_form(false);
	});
});