let b_url = "commerce/sale/";

function add_product(dom){
	ajax_simple({product_id: $(dom).val()}, b_url + "load_product").done(function(res) {
		console.log(res);
		let pid = res.product.product_id;
		
		$("#tb_product_list").append('<tr class="prod_row" id="prod_' + pid + '"><th scope="row">' + ($(".prod_row").length + 1) + '</th><td class="product">' + res.product.product + '</td><td class="text-nowrap price">' + res.product.price_txt + '</td><td class="options"></td><td class="qty"><input type="number" class="form-control qty" value="1" style="max-width: 100px;"></td><td class="text-nowrap subtotal">' + res.product.price_txt + '</td><td><button type="button" class="btn btn-outline-danger btn-sm border-0" id="btn_delete_prod_' + pid + '" value="' + pid + '"><i class="bi bi-x-lg"></i></button></td></tr>');
		
		let dom_id = "#prod_" + pid;
		if (res.options.length > 0){
			$(dom_id + " .options").html('<select class="form-select" name="category_id" id="sl_options_' + res.product.product_id + '"></select>');
			//JSON.stringify(res.options)
		}else{
			$(dom_id + " .options").html('<span class="text-nowrap text-danger">No stock</span>');
			$(dom_id + " .qty").html('');
			$(dom_id + " .subtotal").html('');
		}
		
	});
}

function search_product(keyword){
	ajax_simple({keyword: keyword}, b_url + "search_product").done(function(res) {
		$("#search_result").html("");
		if (res.type == "success"){
			$(res.products).each(function(index, element) {
				$("#search_result").append('<button class="list-group-item list-group-item-action btn_add_product" value="' + element.product_id + '"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1 me-3">' + element.product + '</h5><small class="text-nowrap">S/. ' + element.price + '</small></div><p class="mb-1">' + element.category + '</p><small>' + element.code + '</small></button>');
			});
			
			$(".btn_add_product").on('click',(function(e) {
				add_product(this);
			}));
		}else $("#search_result").html(res.msg);
	});
}

$("#btn_search_product").on('click',(function(e) {
	search_product($("#keyword").val());
}));

$("#keyword").on('keyup',(function(e) {
	if (e.key === "Enter") search_product($("#keyword").val());
}));


////////////////////////////////////////////////////////////////////
/* Category start */
$("#form_add_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "add_category", "add_category").done(function(res) {
		set_msgs("#form_add_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url + "register");
	});
});

$("#form_delete_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "delete_category", "delete_category").done(function(res) {
		set_msgs("#form_delete_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url + "register");
	});
});

$("#form_move_category").submit(function(e) {
	e.preventDefault();
	ajax_form_warning(this, b_url + "move_category", "move_category").done(function(res) {
		set_msgs("#form_move_category", res.msgs);
		swal_redirection(res.type, res.msg, base_url + b_url + "register");
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
function set_option_events(){
	$(".btn_edit_option").on('click',(function(e) {
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
			$("#md_add_option").modal("hide");
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
			$("#md_edit_option").modal("hide");
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
	ajax_form_warning(this, b_url + "add_image", "add_image").done(function(res) {
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