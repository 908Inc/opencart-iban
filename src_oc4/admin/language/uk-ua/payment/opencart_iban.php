<?php
// Heading
$_['heading_title']      = 'Рахунок IBAN (Opendatabot)';

// Text
$_['text_extension']     = 'Розширення';
$_['text_success']       = 'Успішно: Ви змінили налаштування оплати через рахунок IBAN (Opendatabot)!';
$_['text_edit']          = 'Редагування: Рахунок IBAN (Opendatabot)';

// Entry
$_['entry_iban']         = 'IBAN';
$_['entry_code']         = 'РНОКПП / ЄДРПОУ';
$_['entry_client_key']   = 'API ключ';
$_['entry_client_name']  = 'Назва клієнта';
$_['entry_purpose']      = 'Призначення платежу';
$_['entry_order_status'] = 'Статус замовлення';
$_['entry_status']       = 'Статус';
$_['entry_sort_order']   = 'Порядок сортування';

// Help
$_['help_client_key']    = 'Ключ, який було отримано для QR IBAN (x-client-key).';
$_['help_client_name']   = 'Назва клієнта, яка була вказана при отриманні ключа QR IBAN (x-client-name).';
$_['help_purpose']       = 'Використовуйте плейсхолдер {order_id}. Якщо його немає — номер замовлення буде додано автоматично.';

// Error
$_['error_permission']   = 'Попередження: У вас немає прав для зміни цього способу оплати!';
$_['error_iban']         = 'Потрібно вказати IBAN!';
$_['error_iban_format']   = 'Будь ласка, вкажіть коректний український IBAN (UA + 27 цифр).';
$_['error_iban_checksum'] = 'Будь ласка, вкажіть коректний IBAN (контрольна сума невірна).';
$_['error_code']         = 'Потрібно вказати РНОКПП / ЄДРПОУ!';
$_['error_code_format']   = 'Будь ласка, вкажіть коректний код (8 або 10 цифр).';
$_['error_client_key']    = 'Потрібно вказати API ключ!';
$_['error_client_name']   = 'Потрібно вказати назву клієнта!';
