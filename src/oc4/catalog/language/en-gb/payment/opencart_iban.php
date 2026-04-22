<?php
// Heading
$_['heading_title']        = 'IBAN invoice (Opendatabot)';

// Text (option label in payment method list — avoid duplicate with heading)
$_['text_payment_option']  = 'Pay via IBAN invoice';

// Text
$_['text_redirecting']     = 'Redirecting to the IBAN invoice…';
$_['text_redirect_notice'] = 'If you are not redirected automatically, click the button below.';
$_['text_purpose']         = 'Payment for order #%s';
$_['text_payment_comment'] = 'Customer was redirected to Opendatabot IBAN invoice.';
$_['text_callback_paid']   = 'Payment confirmed via Opendatabot autoclient.';

// Button
$_['button_pay']           = '₴ Pay IBAN invoice';
$_['button_continue']      = 'Return to checkout';

// Text (errors)
$_['text_request_failed']  = 'Request failed. Your cart was not changed.';

// Error
$_['error_order']          = 'Order not found. Please try again.';
$_['error_payment_method'] = 'Payment method was changed. Please try again.';
$_['error_config']         = 'Payment method is not configured.';
$_['error_config_keys']     = 'x-client-key and x-client-name must be set in Extensions → Payments → Opendatabot IBAN. Your cart was not changed.';
$_['error_currency']       = 'This payment method is available only for UAH.';
$_['error_invoice_failed']  = 'Could not create the invoice. Your cart was not changed. Please try again or contact the store.';
