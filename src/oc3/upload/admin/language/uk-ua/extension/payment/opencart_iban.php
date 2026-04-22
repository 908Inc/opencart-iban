<?php
// Heading
$_['heading_title'] = 'IBAN рахунок (Opendatabot)';

// Text
$_['text_extension'] = 'Розширення';
$_['text_success'] = 'Успішно: Ви змінили налаштування оплати IBAN рахунком!';
$_['text_edit'] = 'Налаштування IBAN рахунку (Opendatabot)';

// Tabs
$_['tab_general'] = 'Основні';
$_['tab_autoclient'] = 'Автоклієнт';

// Entry
$_['entry_iban'] = 'IBAN';
$_['entry_code'] = 'РНОКПП/ЄДРПОУ';
$_['entry_client_key'] = 'API ключ';
$_['help_client_key'] = 'Ключ, який було отримано для QR IBAN (x-client-key)';
$_['entry_client_name'] = 'Назва клієнта';
$_['help_client_name'] = 'Назва клієнта, яка була вказана при отриманні ключа QR IBAN (x-client-name)';
$_['entry_purpose'] = 'Призначення платежу';
$_['help_purpose'] = 'Використовуйте плейсхолдер {order_id} (наприклад, "Оплата за замовлення №{order_id}"). Якщо його немає — номер замовлення буде додано в кінці.';
$_['entry_order_status'] = 'Статус замовлення';
$_['entry_autoclient'] = 'Автоклієнт';
$_['help_autoclient'] = 'Увімкніть, якщо у вас налаштований Автоклієнт на iban.opendatabot.ua. Покупець потрапить на сторінку очікування оплати, а система автоматично зафіксує платіж через банківський полінг.';
$_['entry_paid_order_status'] = 'Статус замовлення (оплачено)';
$_['help_paid_order_status'] = 'Статус замовлення після підтвердження оплати через callback автоклієнта.';
$_['entry_callback_url'] = 'Callback URL';
$_['help_callback_url'] = 'Вкажіть цю адресу як Callback URL у налаштуваннях Автоклієнта на iban.opendatabot.ua.';
$_['entry_status'] = 'Статус';
$_['entry_sort_order'] = 'Порядок сортування';

// Error
$_['error_permission'] = 'У вас немає прав для зміни цього методу оплати!';
$_['error_iban'] = 'Потрібно вказати IBAN!';
$_['error_iban_format'] = 'Будь ласка, вкажіть коректний український IBAN (UA + 27 цифр).';
$_['error_iban_checksum'] = 'Будь ласка, вкажіть коректний IBAN (контрольна сума невірна).';
$_['error_code'] = 'Потрібно вказати ІПН/ЄДРПОУ!';
$_['error_code_format'] = 'Будь ласка, вкажіть коректний код (8 або 10 цифр).';
$_['error_client_key'] = 'Потрібно вказати API ключ!';
$_['error_client_name'] = 'Потрібно вказати назву клієнта!';
