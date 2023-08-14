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
///////////////////////////////
$(".btn_delete_role").on('click',(function(e) {
	ajax_simple_warning({role_id: $(this).val()}, "authentication/role/delete_role", "delete_role").done(function(res) {
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
