<?php
// Heading
$_['heading_title'] = 'Opendatabot IBAN Invoice';

// Text
$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Success: You have modified Opendatabot IBAN Invoice payment details!';
$_['text_edit'] = 'Edit Opendatabot IBAN Invoice';

// Entry
$_['entry_iban'] = 'IBAN';
$_['entry_code'] = 'ІПН або код компанії';
$_['entry_client_key'] = 'API key';
$_['help_client_key'] = 'Key obtained for QR IBAN (x-client-key).';
$_['entry_client_name'] = 'Client name';
$_['help_client_name'] = 'Client name specified when obtaining the QR IBAN key (x-client-name).';
$_['entry_purpose'] = 'Payment purpose';
$_['help_purpose'] = 'Use {order_id} placeholder (e.g. "Payment for order #{order_id}"). If omitted, order ID will be appended.';
$_['entry_order_status'] = 'Order Status';
$_['entry_autoclient'] = 'Autoclient';
$_['help_autoclient'] = 'Enable if you have Autoclient configured on iban.opendatabot.ua. Redirects customer to the payment status page and automatically detects payment via bank polling.';
$_['entry_paid_order_status'] = 'Paid Order Status';
$_['help_paid_order_status'] = 'Order status set when payment is confirmed via autoclient callback.';
$_['help_callback_url'] = 'Set this URL as Callback URL in your Autoclient settings on iban.opendatabot.ua.';
$_['entry_status'] = 'Status';
$_['entry_sort_order'] = 'Sort Order';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify this payment method!';
$_['error_iban'] = 'IBAN is required!';
$_['error_iban_format'] = 'Please enter a valid UA IBAN (UA + 27 digits).';
$_['error_iban_checksum'] = 'Please enter a valid IBAN (checksum is invalid).';
$_['error_code'] = 'Company code is required!';
$_['error_code_format'] = 'Please enter a valid code (8 or 10 digits).';
$_['error_client_key'] = 'API key is required!';
$_['error_client_name'] = 'Client name is required!';
