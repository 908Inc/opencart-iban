<?php
// Heading
$_['heading_title']      = 'Opendatabot IBAN Invoice';

// Text
$_['text_extension']     = 'Extensions';
$_['text_success']       = 'Success: You have modified Opendatabot IBAN Invoice payment module!';
$_['text_edit']          = 'Edit Opendatabot IBAN Invoice';

// Entry
$_['entry_iban']         = 'IBAN';
$_['entry_code']         = 'Code (EDRPOU / Tax ID)';
$_['entry_x_client_key'] = 'x-client-key';
$_['entry_x_client_name'] = 'x-client-name';
$_['entry_purpose']      = 'Payment purpose';
$_['entry_order_status'] = 'Order Status';
$_['entry_status']       = 'Status';
$_['entry_sort_order']   = 'Sort Order';

// Help
$_['help_x_client_key']  = 'Opendatabot API client key (required for creating invoices).';
$_['help_x_client_name'] = 'Opendatabot API client name (e.g. public or your app name).';
$_['help_purpose']       = 'Use {order_id} placeholder. If omitted, the order ID will be appended automatically.';

// Error
$_['error_permission']   = 'Warning: You do not have permission to modify Opendatabot IBAN Invoice payment module!';
$_['error_iban']         = 'IBAN is required!';
$_['error_iban_format']   = 'Please enter a valid UA IBAN (UA + 27 digits).';
$_['error_iban_checksum'] = 'Please enter a valid IBAN (checksum is invalid).';
$_['error_code']         = 'Code (EDRPOU / Tax ID) is required!';
$_['error_code_format']   = 'Please enter a valid code (8 or 10 digits).';
$_['error_x_client_key']  = 'x-client-key is required!';
$_['error_x_client_name'] = 'x-client-name is required!';
