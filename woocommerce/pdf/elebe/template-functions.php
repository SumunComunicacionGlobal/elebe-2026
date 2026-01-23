<?php
/**
 * Use this file for all your template filters and actions.
 * Requires WooCommerce PDF Invoices & Packing Slips 1.4.13 or higher
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'wpo_wcpdf_before_document', 'pdf_invoice_forzar_idioma', 10, 2 );
function pdf_invoice_forzar_idioma($type, $order) {
	do_action( 'wpml_switch_language', 'de' );
}


// add_action( 'wpo_wcpdf_after_document', 'pdf_invoice_recuperar_idioma', 10, 2 );
function pdf_invoice_recuperar_idioma($type, $order) {

}