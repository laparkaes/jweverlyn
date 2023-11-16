let b_url = "stock/product/";

btn_card_control("#btn_category_admin", ".btn_close_cat_admin", "#bl_cat_admin", "success");
btn_card_control("#btn_open_ao", "#btn_close_ao", "#card_add_option", "success");
btn_card_control("#btn_open_ai", "#btn_close_ai", "#card_add_image", "success");


/* Category start */
$("#form_add_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_category", "add_category").done(function(res) {
		set_msgs("#form_add_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url);
	});
});

$("#form_delete_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "delete_category", "delete_category").done(function(res) {
		set_msgs("#form_delete_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url);
	});
});

$("#form_move_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "move_category", "move_category").done(function(res) {
		set_msgs("#form_move_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url);
	});
});
/* Category end */

/* Product start */
$("#form_add_product").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add", "add_product").done(function(res) {
		set_msgs("#form_add_product", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url + "detail/" + res.product_id);
	});
});

$("#form_update_product").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "update", "update_product").done(function(res) {
		set_msgs("#form_update_product", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url + "detail/" + res.product_id);
	});
});
/* Product end */

/* Option start */
$("#btn_close_uo").on('click',(function(e) {
	$("#card_update_option").addClass("d-none");
	$(".btn_open_uo").removeClass("btn-primary");
	$(".btn_open_uo").addClass("btn-outline-primary");
	move_top();
}));

function set_option_events(){
	$(".btn_open_uo").on('click',(function(e) {
		$("#card_update_option").removeClass("d-none");
		$(".btn_open_uo").removeClass("btn-primary");
		$(".btn_open_uo").addClass("btn-outline-primary");
		$(this).removeClass("btn-outline-primary");
		$(this).addClass("btn-primary");
		move_to("#card_update_option");
		
		ajax_simple({option_id: $(this).val()}, b_url + "load_option").done(function(res) {
			if (res.type == "success"){
				$("#form_update_option input[name=option_id]").val(res.option.option_id);
				$("#form_update_option input[name=option]").val(res.option.option);
				$("#form_update_option input[name=stock]").val(res.option.stock);
			}else swal(res.type, res.msg);
		});
	}));

	$(".btn_delete_option").on('click',(function(e) {
		ajax_simple_warning({option_id: $(this).val()}, b_url + "delete_option", "delete_option").done(function(res) {
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
	ajax_form_warning(this, b_url + "add_option", "add_option").done(function(res) {
		set_msgs("#form_add_option", res.msgs);
		swal(res.type, res.msg);
		if (res.type == "success"){
			update_stock(res.options, res.stock);
			reset_form("#form_add_option");
			$("#btn_close_ao").trigger("click");
		}
	});
});

$("#form_update_option").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "update_option", "update_option").done(function(res) {
		set_msgs("#form_update_option", res.msgs);
		swal(res.type, res.msg);
		if (res.type == "success"){
			update_stock(res.options, res.stock);
			reset_form("#form_update_option");
			$("#btn_close_uo").trigger("click");
		}
	});
});

set_option_events();
/* Option end */

/* Image start */
function set_image_events(){
	$(".btn_edit_image").on('click',(function(e) {
		ajax_simple_warning({image_id: $(this).val()}, b_url + "set_main_image", "set_main_image").done(function(res) {
			swal(res.type, res.msg);
			if (res.type == "success") $("#main_image").prop("src", res.image);
		});
	}));
	
	$(".btn_delete_image").on('click',(function(e) {
		ajax_simple_warning({image_id: $(this).val()}, b_url + "delete_image", "delete_image").done(function(res) {
			swal(res.type, res.msg);
			if (res.type == "success"){
				update_image(res.images);
				$("#main_image").prop("src", res.image);
			}
		});
	}));
}

function update_image(imgs){
	$("#tbody_images").html("");
	$(imgs).each(function(index, element) {
		console.log(element);
		$("#tbody_images").append('<tr><th scope="row">' + (index + 1) + '</th><td><img src="' + element.image_path + '" alt="Thumb" style="max-height: 80px;"></td><td>' + element.image_path + '</td><td class="text-end"><button type="button" class="btn btn-outline-primary btn-sm border-0 btn_edit_image" value="' + element.image_id + '"><i class="bi bi-image"></i></button><button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_image" value="' + element.image_id + '"><i class="bi bi-x-lg"></i></button></td></tr>');
	});
	set_image_events();
}

$("#form_add_image").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_image", "add_image").done(function(res) {
		set_msgs("#form_add_image", res.msgs);
		swal(res.type, res.msg);
		if (res.type == "success"){
			update_image(res.images);
			reset_form("#form_add_image");
			$("#btn_close_ai").trigger("click");
			if (res.image != "") $("#main_image").prop("src", res.image);
		}
	});
});

set_image_events();
/* Image end */