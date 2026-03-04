<?php
// Heading
$_['heading_title']        = 'Безготівковий розрахунок';

// Text (option label in payment method list — avoid duplicate with heading)
$_['text_payment_option']  = 'Оплата за IBAN без комісії';

// Text
$_['text_redirecting']     = 'Перенаправляємо на сторінку рахунку…';
$_['text_redirect_notice'] = 'Якщо перенаправлення не відбулося автоматично — натисніть кнопку нижче.';
$_['text_purpose']         = 'Оплата за замовлення №%s';
$_['text_payment_comment'] = 'Користувача перенаправлено на рахунок IBAN (Opendatabot).';

// Button
$_['button_pay']           = '₴ Сплатити за IBAN';
$_['button_continue']      = 'Повернутися до оформлення';

// Text (errors)
$_['text_request_failed']  = 'Помилка запиту. Кошик не змінено.';

// Error
$_['error_order']          = 'Замовлення не знайдено. Спробуйте ще раз.';
$_['error_payment_method'] = 'Спосіб оплати змінено. Спробуйте ще раз.';
$_['error_config']         = 'Спосіб оплати не налаштовано.';
$_['error_config_keys']    = 'У налаштуваннях оплати (Розширення → Оплата → Opendatabot IBAN) потрібно вказати x-client-key та x-client-name. Кошик не змінено.';
$_['error_currency']       = 'Цей спосіб оплати доступний лише для UAH.';
$_['error_invoice_failed'] = 'Не вдалося створити рахунок. Кошик не змінено. Спробуйте ще раз або зверніться до магазину.';
