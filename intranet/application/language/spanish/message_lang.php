<?php
$lang['e_check_datas']			= 'Revise los datos ingresados.';
$lang['e_internal_again']		= 'Ocurrió error interno. Intente nuevamente.';
$lang['e_unknown_refresh']		= 'Ocurrió error desconocido. Actualice la página y vuelva a intentar.';
$lang['e_required_field']		= 'Campo requerido.';
$lang['e_finished_session']		= 'Sesión finalizada. Debe ingresar nuevamente.';
$lang['e_integer']				= 'Debe ser un número entero.';
$lang['e_numeric']				= 'Debe ser un número.';
$lang['e_numeric_positive']		= 'Debe ser un número positivo.';
$lang['e_no_result']			= 'No hay resultado de búsqueda.';
$lang['e_enter_keyword']		= 'Ingrese palabra de búsqueda.';
$lang['e_no_zero']				= 'Debe ser mayor que cero.';

//balance excel
$lang['e_balance_type']		= 'Elija tipo de balance.';
$lang['e_balance_period']	= 'Elija plazo de balance.';

//in_outcome
$lang['e_category_include_inout']	= 'No puede eliminar una categoría asignada a un egreso o ingreso.';
$lang['s_add_in_outcome']			= "Datos han sido registrados.";
$lang['s_delete_in_outcome']		= "Registro ha sido eliminado.";

//purchase
$lang['e_product_qty_zero']		= 'La cantidad de producto debe ser mayor a cero.';
$lang['e_cancel_no_stock']		= 'No se puede cancelar la compra debido a la falta de stock de "%product%"';
$lang['s_purchase_insert']		= "Compra ha sido registrada.";
$lang['s_purchase_cancel']		= "Compra ha sido cancelada.";
$lang['s_note_insert']			= "Nota ha sido registrada.";
$lang['s_note_delete']			= "Nota ha sido eliminada.";
$lang['s_file_upload']			= "Archivo ha sido cargado.";
$lang['s_file_delete']			= "Archivo ha sido eliminado.";

//provider
$lang['e_provider_exists']		= 'Proveedor registrado.';
$lang['e_provider_name']		= 'Ingrese nombre del proveedor.';
$lang['s_provider_insert']		= "Proveedor ha sido registrado.";
$lang['s_provider_update']		= "Proveedor ha sido actualizado.";
$lang['s_person_insert']		= "Persona ha sido registrada.";
$lang['s_person_delete']		= "Persona ha sido eliminada.";

//client
$lang['e_client_exists']		= 'Cliente registrado.';
$lang['s_client_insert']		= "Cliente ha sido registrado.";
$lang['s_client_update']		= "Cliente ha sido actualizado.";

//proforma
$lang['s_proforma_insert']		= "Proforma ha sido registrada.";
$lang['s_sale_based_proforma']	= "Nueva venta ha sido generada en base a proforma.";
$lang['s_proforma_update']		= "Proforma ha sido actualizada.";
$lang['s_proforma_void']		= "Proforma ha sido anulada.";

//sale
$lang['e_doc_type_ruc']			= 'Elija RUC.';
$lang['e_doc_number_enter']		= 'Ingrese número de documento.';
$lang['e_select_product']		= 'Elija al menos un producto.';
$lang['e_invalid_payment']		= "Monto de pago inválido.";
$lang['e_no_payment_record']	= "No hay registro de pago. Actualice la página e inténtelo nuevamente.";
$lang['e_unfinished_sale']		= "Venta no finalizada.";
$lang['e_invoice_issued']		= "Existe comprobante emitido.";
$lang['s_sale_insert']			= "Venta ha sido registrada.";
$lang['s_sale_cancel']			= "Venta ha sido anulada.";
$lang['s_payment_insert']		= "Pago ha sido registrado.";
$lang['s_payment_delete']		= "Pago ha sido anulado.";
$lang['s_invoice_issue']		= "Comprobante ha sido emitido.";

//setting - company
$lang['s_save_company_info']	= 'Información de empresa ha sido guardada.';

//product image
$lang['s_image_insert']			= 'Imagen de producto ha sido cargada con éxito.';
$lang['s_image_delete']			= 'Imagen ha sido eliminada.';
$lang['s_set_as_main_img']		= 'Imagen ha sido configuarada como principal.';

//product option
$lang['e_option_select']		= 'Elija una opción.';
$lang['e_duplicate_option']		= 'Opción esta registrada en el sistema.';
$lang['e_no_product_registed']	= 'Producto no registrado.';
$lang['e_product_no_stock']		= 'Stock no disponible.';
$lang['e_product_invalid_option']	= "Opción inválida de ";
$lang['e_option_stock']			= 'No puede elminar una opción con stock.';
$lang['s_option_insert']		= 'Opción de producto ha sido generada con éxito.';
$lang['s_option_update']		= 'Opción ha sido actualizada.';
$lang['s_option_delete']		= 'Opción ha sido eliminada.';

//product
$lang['e_duplicate_code']		= 'Código existente en el sistema.';
$lang['e_product_out_stock']		= 'Producto no disponible.';
$lang['s_product_insert']		= 'Producto ha sido generado con éxito.';
$lang['s_product_update']		= 'Producto ha sido actualizado.';

//product category
$lang['e_category_exists']		= 'Existe nombre de categoría ingresado.';
$lang['e_category_include_products']	= 'No puede eliminar una categoría con productos.';
$lang['e_diff_category']		= 'Elija una categoría diferente.';
$lang['s_category_insert']		= 'Categoría ha sido generada con éxito.';
$lang['s_category_delete']		= 'Categoría ha sido eliminada.';
$lang['s_category_move']		= 'Productos de categoría han sido actualizados.';

//account
$lang['e_admin_exists']			= 'Existe al menos un usuario admin generado.';
$lang['e_username_email']		= 'Ingrese un correo electrónico.';
$lang['e_username_exists']		= 'Existe usuario ingresado.';
$lang['e_username_wrong']		= 'Usuario no registrado.';
$lang['e_password_wrong']		= 'Contraseña incorrecta.';
$lang['e_password_length']		= 'Ingrese al menos 6 letras.';
$lang['e_password_confirm_wrong']		= 'Confirmación incorrecta.';
$lang['e_confirm_deactivate_account']	= 'Confirme desactivación del usuario.';
$lang['e_itself_deactivate_account']	= 'Desactivación por sí mismo no es permitida.';
$lang['e_confirm_activate_account']		= 'Confirme activación del usuario.';
$lang['s_admin_create']			= 'Usuario admin ha sido generado con éxito.';
$lang['s_account_insert']		= 'Usuario ha sido generado con éxito.';
$lang['s_account_update']		= 'Usuario ha sido actualizado con éxito.';
$lang['s_account_deactivate']	= 'Usuario ha sido desactivado con éxito.';

//access
$lang['e_module_exists']		= 'Existe nombre de módulo ingresado.';
$lang['e_module_linked_access']	= 'Existe accesos vinculados con módulo elegido.';
$lang['e_access_exists']		= 'Existe nombre de acceso ingresado.';
$lang['e_code_exists']			= 'Existe código de acceso ingresado.';
$lang['s_module_insert']		= 'Módulo ha sido generado.';
$lang['s_module_delete']		= 'Módulo ha sido eliminado.';
$lang['s_access_insert']		= 'Acceso ha sido generado.';
$lang['s_access_delete']		= 'Acceso ha sido eliminado.';

//role
$lang['e_role_exists']			= 'Existe nombre de rol ingresado.';
$lang['e_role_linked_account']	= 'Existe usuarios vinculados con rol elegido.';
$lang['s_role_insert']			= 'Rol ha sido generado.';
$lang['s_role_delete']			= 'Rol ha sido eliminado.';
$lang['s_role_update']			= 'Rol ha sido actualizado.';
$lang['s_role_access_assigned']	= 'Acceso ha sido asignado al rol.';
$lang['s_role_access_designated']	= 'Acceso ha sido designado al rol.';