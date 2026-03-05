<?php
namespace Opencart\Catalog\Model\Extension\OpencartIban\Payment;

/**
 * Class OpencartIban
 *
 * Can be called from $this->load->model('extension/opencart_iban/payment/opencart_iban');
 *
 * @package Opencart\Catalog\Model\Extension\OpencartIban\Payment
 */
class OpencartIban extends \Opencart\System\Engine\Model {
	/**
	 * Get Methods
	 *
	 * @param array<string, mixed> $address array of data
	 *
	 * @return array<string, mixed>
	 */
	public function getMethods(array $address = []): array {
		$this->load->language('extension/opencart_iban/payment/opencart_iban');

		$iban = preg_replace('/\s+/', '', (string)$this->config->get('payment_opencart_iban_iban'));
		$code = preg_replace('/\s+/', '', (string)$this->config->get('payment_opencart_iban_code'));
		$client_key = trim((string)$this->config->get('payment_opencart_iban_x_client_key'));
		$client_name = trim((string)$this->config->get('payment_opencart_iban_x_client_name'));

		$currency = $this->session->data['currency'] ?? $this->config->get('config_currency');

		$status = (bool)$this->config->get('payment_opencart_iban_status');

		$unavailable_reason = '';
		if ($this->cart->hasSubscription()) {
			$status = false;
		}

		if ($iban === '' || $code === '' || $client_key === '' || $client_name === '') {
			$status = false;
			if ($this->config->get('payment_opencart_iban_status')) {
				$unavailable_reason = $this->language->get('error_config_keys');
			}
		}

		if (strtoupper((string)$currency) !== 'UAH') {
			$status = false;
			if ($unavailable_reason === '' && $this->config->get('payment_opencart_iban_status')) {
				$unavailable_reason = $this->language->get('error_currency');
			}
		}

		$method_data = [];

		if ($status) {
			$option_data['opencart_iban'] = [
				'code' => 'opencart_iban.opencart_iban',
				'name' => $this->language->get('text_payment_option')
			];

			$method_data = [
				'code'       => 'opencart_iban',
				'name'       => $this->language->get('heading_title'),
				'option'     => $option_data,
				'sort_order' => $this->config->get('payment_opencart_iban_sort_order')
			];
		} elseif ($unavailable_reason !== '') {
			// Extension is enabled but not available (e.g. wrong currency or missing config).
			// Return method with error so checkout shows a clear message instead of "No Payment options".
			$method_data = [
				'code'       => 'opencart_iban',
				'name'       => $this->language->get('heading_title'),
				'option'     => [],
				'error'      => $unavailable_reason,
				'sort_order' => $this->config->get('payment_opencart_iban_sort_order')
			];
		}

		return $method_data;
	}
}
