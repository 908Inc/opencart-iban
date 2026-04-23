<?php
class ModelExtensionPaymentOpencartIban extends Model {
	public function getMethod($address, $total) {
		$this->load->language('extension/payment/opencart_iban');

		$status = (bool)$this->config->get('payment_opencart_iban_status');

		$iban = preg_replace('/\\s+/', '', (string)$this->config->get('payment_opencart_iban_iban'));
		$code = preg_replace('/\\s+/', '', (string)$this->config->get('payment_opencart_iban_code'));
		$client_key = trim((string)$this->config->get('payment_opencart_iban_client_key'));
		$client_name = trim((string)$this->config->get('payment_opencart_iban_client_name'));

		if ($iban === '' || $code === '' || $client_key === '' || $client_name === '') {
			$status = false;
		}

		$currency = isset($this->session->data['currency']) ? (string)$this->session->data['currency'] : (string)$this->config->get('config_currency');

		if (strtoupper($currency) !== 'UAH') {
			$status = false;
		}

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'opencart_iban',
				'title'      => $this->language->get('text_title'),
				'terms'      => '',
				'sort_order' => $this->config->get('payment_opencart_iban_sort_order')
			);
		}

		return $method_data;
	}
}
