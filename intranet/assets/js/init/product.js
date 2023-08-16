$("#form_add_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/add_category", "add_category").done(function(res) {
		set_msgs("#form_add_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "product/register");
	});
});

$("#form_delete_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/delete_category", "delete_category").done(function(res) {
		set_msgs("#form_delete_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "product/register");
	});
});

$("#form_move_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/move_category", "move_category").done(function(res) {
		set_msgs("#form_move_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "product/register");
	});
});

$("#form_add_product").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/add", "add_product").done(function(res) {
		set_msgs("#form_add_product", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "product/detail/" + res.product_id);
	});
});

$("#form_update_product").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/update", "update_product").done(function(res) {
		set_msgs("#form_update_product", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "product/detail/" + res.product_id);
	});
});

$("#form_add_option").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/add_option", "add_option").done(function(res) {
		set_msgs("#form_add_option", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "product/detail/" + res.product_id);
	});
});

$("#form_update_option").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/update_option", "update_option").done(function(res) {
		set_msgs("#form_update_option", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "product/detail/" + res.product_id);
	});
});

$("#btn_add_option").on('click',(function(e) {
	$("#form_add_option").submit();
}));

$(".btn_edit_option").on('click',(function(e) {
	ajax_simple({option_id: $(this).val()}, "product/load_option").done(function(res) {
		if (res.type == "success"){
			$("#form_update_option input[name=option_id]").val(res.option.option_id);
			$("#form_update_option input[name=option]").val(res.option.option);
			$("#form_update_option input[name=stock]").val(res.option.stock);
		}else swal(res.type, res.msg);
	});
}));

$("#btn_update_option").on('click',(function(e) {
	$("#form_update_option").submit();
}));

$(".btn_delete_option").on('click',(function(e) {
	ajax_simple_warning({option_id: $(this).val()}, "product/delete_option", "delete_option").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + "product/detail/" + res.product_id);
	});
}));







///////////////////////////////
$("#form_add_role").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/role/add", "add_role").done(function(res) {
		set_msgs("#form_add_role", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/role/edit/" + res.role_id);
	});
});

$("#form_update_role").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "authentication/role/update", "update_role").done(function(res) {
		set_msgs("#form_update_role", res.msgs);
		swal_redirection(res.type, res.msg, base_url + "authentication/role/edit/" + res.role_id);
	});
});

$(".btn_delete_role").on('click',(function(e) {
	ajax_simple_warning({role_id: $(this).val()}, "authentication/role/delete", "delete_role").done(function(res) {
		swal_redirection(res.type, res.msg, base_url + "authentication/role");
	});
}));

$(".btn_assign_access").change(function() {
	var data = {
		role_id: $("#role_id").val(),
		access_id: $(this).val(),
	}
	var is_checked = $(this).is(':checked');
	
	if (is_checked) data.action = "add";
	else data.action = "delete";
	
	ajax_simple(data, "authentication/role/access_control").done(function(res) {
		if (res.type == "success"){
			toastr_(res.type, res.msg);
		}else{
			swal(res.type, res.msg);
			$(".btn_assign_access[value=" + data.access_id + "]").prop("checked", !is_checked);
			console.log(data);
		}
	});
});
