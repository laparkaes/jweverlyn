$("#ip_ruc").on('keyup',(function(e) {
	$("#ip_company").val("");
	$("#ip_tel").val("");
	$("#ip_email").val("");
	$("#ip_address").val("");
	$("#sl_department").val("");
	$("#sl_province").val("");
	$("#sl_district").val("");
}));

$("#btn_search_company").on('click',(function(e) {
	ajax_simple({ruc: $("#ip_ruc").val()}, "setting/company/search").done(function(res) {
		if (res.type == "success"){
			$("#ip_company").val(res.company.razon_social.trim());
			$("#ip_address").val(res.company.direccion.trim());
			$("#sl_department").val(res.company.department_id);
			$("#sl_province").val(res.company.province_id);
			$("#sl_district").val(res.company.district_id);
		}else swal(res.type, res.msg);
	});
}));

$("#form_save_company_info").submit(function(e) {
	e.preventDefault();
	ajax_form(this, "setting/company/save_company_info").done(function(res) {
		set_msgs("#form_save_company_info", res.msgs);
		swal(res.type, res.msg);
		if (res.type == "success") $("#ip_sunat_ruc").val($("#ip_ruc").val());
	});
});




//end here

/* Category start */
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
/* Category end */

/* Product start */
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
/* Product end */

/* Option start */
function set_option_events(){
	$(".btn_edit_option").on('click',(function(e) {
		ajax_simple({option_id: $(this).val()}, "product/load_option").done(function(res) {
			if (res.type == "success"){
				$("#form_update_option input[name=option_id]").val(res.option.option_id);
				$("#form_update_option input[name=option]").val(res.option.option);
				$("#form_update_option input[name=stock]").val(res.option.stock);
			}else swal(res.type, res.msg);
		});
	}));

	$(".btn_delete_option").on('click',(function(e) {
		ajax_simple_warning({option_id: $(this).val()}, "product/delete_option", "delete_option").done(function(res) {
			swal(res.type, res.msg);
			if (res.type == "success") update_stock(res.options, res.stock);
		});
	}));
}

function update_stock(options, stock){
	$("#num_stock").html(stock);
	$("#tbody_options").html("");
	$(options).each(function(index, element) {
		$("#tbody_options").append('<tr><th scope="row">' + (index + 1) + '</th><td>' + element.option + '</td><td>' + element.stock + '</td><td class="text-end"><button type="button" class="btn btn-outline-primary btn-sm border-0 btn_edit_option" data-bs-toggle="modal" data-bs-target="#md_edit_option" value="' + element.option_id + '"><i class="bi bi-pencil-fill"></i></button><button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_option" value="' + element.option_id + '"><i class="bi bi-x-lg"></i></button></td></tr>');
	});
	set_option_events();
}

$("#form_add_option").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/add_option", "add_option").done(function(res) {
		set_msgs("#form_add_option", res.msgs);
		swal(res.type, res.msg);
		if (res.type == "success"){
			update_stock(res.options, res.stock);
			reset_form("#form_add_option");
			$("#md_add_option").modal("hide");
		}
	});
});

$("#form_update_option").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/update_option", "update_option").done(function(res) {
		set_msgs("#form_update_option", res.msgs);
		swal(res.type, res.msg);
		if (res.type == "success"){
			update_stock(res.options, res.stock);
			reset_form("#form_update_option");
			$("#md_edit_option").modal("hide");
		}
	});
});

set_option_events();
/* Option end */

/* Image start */
function set_image_events(){
	$(".btn_edit_image").on('click',(function(e) {
		ajax_simple_warning({image_id: $(this).val()}, "product/set_main_image", "set_main_image").done(function(res) {
			swal(res.type, res.msg);
			if (res.type == "success") $("#main_image").prop("src", res.image);
		});
	}));
	
	$(".btn_delete_image").on('click',(function(e) {
		ajax_simple_warning({image_id: $(this).val()}, "product/delete_image", "delete_image").done(function(res) {
			swal(res.type, res.msg);
			if (res.type == "success") update_image(res.images);
		});
	}));
}

function update_image(imgs){
	$("#tbody_images").html("");
	$(imgs).each(function(index, element) {
		$("#tbody_images").append('<tr><th scope="row">' + (index + 1) + '</th><td><img src="' + element.thumb + '" alt="Thumb" style="max-height: 80px;"></td><td>' + element.image_path + '</td><td class="text-end"><button type="button" class="btn btn-outline-primary btn-sm border-0 btn_edit_image" value="' + element.image_id + '"><i class="bi bi-image"></i></button><button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_image" value="' + element.image_id + '"><i class="bi bi-x-lg"></i></button></td></tr>');
	});
	set_image_events();
}

$("#form_add_image").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, "product/add_image", "add_image").done(function(res) {
		set_msgs("#form_add_image", res.msgs);
		swal(res.type, res.msg);
		if (res.type == "success"){
			update_image(res.images);
			reset_form("#form_add_image");
			$("#md_add_image").modal("hide");
		}
	});
});

set_image_events();
/* Image end */