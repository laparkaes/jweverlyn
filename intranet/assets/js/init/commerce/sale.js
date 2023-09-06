let b_url = "commerce/sale/";

function calculate_change(){
	var total = parseFloat($("#total").val());
	var received =  parseFloat($("#received_txt").val());
	if (isNaN(received) || received <= 0) received = total;
	
	var change = received - total;
	if (change < 0) change = 0;
	
	$("#received_txt").val(nf(received));
	$("#received").val(received);
	
	$("#change_txt").val(nf(change));
	$("#change").val(change);
}

function calculate_amount(){
	var total = 0;
	$($(".prod_row")).each(function(index, element){
		if ($(element).find(".product_json").length > 0 && $(element).find(".stocks_json").length > 0){
			var data = JSON.parse($(element).find(".product_json").html());
			var stocks = JSON.parse($(element).find(".stocks_json").html());
			var option_id = $(element).find(".option_id").val();
			var qty = $(element).find(".ip_qty").val();
			if (qty < 1) qty = 1;
			else if (qty > parseInt(stocks[option_id])){
				qty = stocks[option_id];
				swal("warning", "Disponibilidad: " + qty);
			}
			$(element).find(".ip_qty").val(qty);
			
			var subtotal = qty * data.price;
			$(element).find(".subtotal").html("S/. " + nf(subtotal));
			total = total + subtotal;	
		}
	});
	
	$("#total, #received").val(total);
	$("#total_txt, #received_txt").val(nf(total));
	
	$("#change_txt").val(nf(0));
	$("#change").val(0);
}

var row_num = 1;
function add_product(dom){
	ajax_simple({product_id: $(dom).val()}, b_url + "load_product").done(function(res) {
		/* add doms to row */
		$("#tb_product_list").append('<tr class="prod_row align-middle" id="prod_' + row_num + '"><th class="num" scope="row">' + ($(".prod_row").length + 1) + '</th><td class="product">' + res.product.product + '<div class="product_json d-none">' + JSON.stringify(res.product) + '</div></td><td class="price text-nowrap">S/. ' + nf(res.product.price) + '</td><td class="options"></td><td class="qty"><input type="number" class="form-control ip_qty" value="1" min="1" style="width: 100px;"></td><td class="subtotal text-nowrap text-end">' + nf(res.product.price) + '</td><td class="text-end"><button type="button" class="btn btn-outline-danger btn-sm border-0 btn_delete_prod"><i class="bi bi-x-lg"></i></button></td></tr>');
		
		let row_id = "#prod_" + row_num;
		if (res.options.length > 0){
			$(row_id).find(".options").html('<select class="form-select option_id" name="option_id" style="width: 150px;"></select>');
			
			var stocks = {};
			var dom_select = $(row_id).find(".option_id");
			$(res.options).each(function(index, element){
				$(dom_select).append('<option value="' + element.option_id + '">' + element.option + ' (' + element.stock + ')</option>');
				stocks[element.option_id] = element.stock;
			});
			$(row_id).find(".options").append('<div class="stocks_json d-none">' + JSON.stringify(stocks) + '</div>');
		}else{
			$(row_id).find(".options").html('<span class="text-nowrap text-danger">No stock</span>');
			$(row_id).find(".qty").html('');
			$(row_id).find(".subtotal").html('');
		}
		
		/* add events */
		$(row_id).find(".ip_qty").on('change',(function(e) {
			calculate_amount();
		}));
		
		$(row_id).find(".option_id").on('change',(function(e) {
			$(this).closest("tr").find(".ip_qty").val(1);
			calculate_amount();
		}));
		
		$(row_id).find(".btn_delete_prod").on('click',(function(e) {
			$(row_id).remove();
			$($(".prod_row")).each(function(index, element){
				$(this).find(".num").html(index + 1);
			});
			calculate_amount();
		}));
		
		/* close modal */
		$("#md_add_product").modal("hide");
		row_num++;
		
		/* calculate amount */
		calculate_amount();
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

$("#received_txt").on('change',(function(e) {
	calculate_change();
}));

$("#btn_search_product").on('click',(function(e) {
	search_product($("#keyword").val());
}));

$("#keyword").on('keyup',(function(e) {
	if (e.key === "Enter") search_product($("#keyword").val());
}));

$("#doc_type").on('change',(function(e) {
	if ($("#doc_type option:selected").val() == 1){
		$("#doc_number").prop("disabled", true);
		$("#btn_search_person").prop("disabled", true);
		$("#client_name").prop("disabled", true);
	}else{
		$("#doc_number").prop("disabled", false);
		$("#btn_search_person").prop("disabled", false);
		$("#client_name").prop("disabled", false);
	}
}));

$("#btn_search_person").on('click',(function(e) {
	ajax_simple({doc_type: $("#doc_type").val(), doc_number: $("#doc_number").val()}, b_url + "search_person").done(function(res) {
		swal(res.type, res.msg);
		if (res.type == "success"){
			
		}
	});
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