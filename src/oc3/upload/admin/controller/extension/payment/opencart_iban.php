<?php
class ControllerExtensionPaymentOpencartIban extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/opencart_iban');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_opencart_iban', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/opencart_iban', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/opencart_iban', 'user_token=' . $this->session->data['user_token'], true);
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['error_iban'] = isset($this->error['iban']) ? $this->error['iban'] : '';
		$data['error_code'] = isset($this->error['code']) ? $this->error['code'] : '';
		$data['error_client_key'] = isset($this->error['client_key']) ? $this->error['client_key'] : '';
		$data['error_client_name'] = isset($this->error['client_name']) ? $this->error['client_name'] : '';

		$data['payment_opencart_iban_iban'] = isset($this->request->post['payment_opencart_iban_iban']) ? $this->request->post['payment_opencart_iban_iban'] : $this->config->get('payment_opencart_iban_iban');
		$data['payment_opencart_iban_code'] = isset($this->request->post['payment_opencart_iban_code']) ? $this->request->post['payment_opencart_iban_code'] : $this->config->get('payment_opencart_iban_code');
		$data['payment_opencart_iban_client_key'] = isset($this->request->post['payment_opencart_iban_client_key']) ? $this->request->post['payment_opencart_iban_client_key'] : $this->config->get('payment_opencart_iban_client_key');
		$data['payment_opencart_iban_client_name'] = isset($this->request->post['payment_opencart_iban_client_name']) ? $this->request->post['payment_opencart_iban_client_name'] : $this->config->get('payment_opencart_iban_client_name');

		// Purpose templates (per language)
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['payment_opencart_iban_purpose'] = array();

		foreach ($data['languages'] as $language) {
			$language_id = (int)$language['language_id'];
			$key = 'payment_opencart_iban_purpose_' . $language_id;

			if (isset($this->request->post[$key])) {
				$value = $this->request->post[$key];
			} else {
				$value = (string)$this->config->get($key);
			}

			$value = trim($value);

			if ($value === '') {
				if (!empty($language['code']) && $language['code'] === 'uk-ua') {
					$value = 'Оплата за замовлення №{order_id}';
				} else {
					$value = 'Payment for order #{order_id}';
				}
			}

			$data['payment_opencart_iban_purpose'][$language_id] = $value;
		}

		// Order Status
		if (isset($this->request->post['payment_opencart_iban_order_status_id'])) {
			$data['payment_opencart_iban_order_status_id'] = $this->request->post['payment_opencart_iban_order_status_id'];
		} else {
			$data['payment_opencart_iban_order_status_id'] = $this->config->get('payment_opencart_iban_order_status_id') ?: $this->config->get('config_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		// Autoclient
		if (isset($this->request->post['payment_opencart_iban_autoclient'])) {
			$data['payment_opencart_iban_autoclient'] = $this->request->post['payment_opencart_iban_autoclient'];
		} else {
			$data['payment_opencart_iban_autoclient'] = $this->config->get('payment_opencart_iban_autoclient');
		}

		if (isset($this->request->post['payment_opencart_iban_paid_order_status_id'])) {
			$data['payment_opencart_iban_paid_order_status_id'] = $this->request->post['payment_opencart_iban_paid_order_status_id'];
		} else {
			$data['payment_opencart_iban_paid_order_status_id'] = (int)($this->config->get('payment_opencart_iban_paid_order_status_id') ?: 5);
		}

		// Callback URL for autoclient
		$data['callback_url'] = HTTPS_CATALOG . 'index.php?route=extension/payment/opencart_iban/callback';

		// Status
		if (isset($this->request->post['payment_opencart_iban_status'])) {
			$data['payment_opencart_iban_status'] = $this->request->post['payment_opencart_iban_status'];
		} else {
			$data['payment_opencart_iban_status'] = $this->config->get('payment_opencart_iban_status') ?? 1;
		}

		// Sort Order
		if (isset($this->request->post['payment_opencart_iban_sort_order'])) {
			$data['payment_opencart_iban_sort_order'] = $this->request->post['payment_opencart_iban_sort_order'];
		} else {
			$data['payment_opencart_iban_sort_order'] = $this->config->get('payment_opencart_iban_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/opencart_iban', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/opencart_iban')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!isset($this->request->post['payment_opencart_iban_iban']) || trim($this->request->post['payment_opencart_iban_iban']) === '') {
			$this->error['iban'] = $this->language->get('error_iban');
		} else {
			$iban = strtoupper(preg_replace('/\\s+/', '', (string)$this->request->post['payment_opencart_iban_iban']));
			$this->request->post['payment_opencart_iban_iban'] = $iban;

			if (!preg_match('/^UA\\d{27}$/', $iban)) {
				$this->error['iban'] = $this->language->get('error_iban_format');
			} elseif ($this->ibanMod97($iban) !== 1) {
				$this->error['iban'] = $this->language->get('error_iban_checksum');
			}
		}

		if (!isset($this->request->post['payment_opencart_iban_code']) || trim($this->request->post['payment_opencart_iban_code']) === '') {
			$this->error['code'] = $this->language->get('error_code');
		} else {
			$code = preg_replace('/\\s+/', '', (string)$this->request->post['payment_opencart_iban_code']);
			$this->request->post['payment_opencart_iban_code'] = $code;

			$length = strlen($code);

			if (!ctype_digit($code) || ($length !== 8 && $length !== 10)) {
				$this->error['code'] = $this->language->get('error_code_format');
			}
		}

		if (!isset($this->request->post['payment_opencart_iban_client_key']) || trim($this->request->post['payment_opencart_iban_client_key']) === '') {
			$this->error['client_key'] = $this->language->get('error_client_key');
		} else {
			$this->request->post['payment_opencart_iban_client_key'] = trim((string)$this->request->post['payment_opencart_iban_client_key']);
		}

		if (!isset($this->request->post['payment_opencart_iban_client_name']) || trim($this->request->post['payment_opencart_iban_client_name']) === '') {
			$this->error['client_name'] = $this->language->get('error_client_name');
		} else {
			$this->request->post['payment_opencart_iban_client_name'] = trim((string)$this->request->post['payment_opencart_iban_client_name']);
		}

		return !$this->error;
	}

	private function ibanMod97($iban) {
		$iban = strtoupper((string)$iban);
		$rearranged = substr($iban, 4) . substr($iban, 0, 4);

		$numeric = '';
		$rearranged_length = strlen($rearranged);

		for ($i = 0; $i < $rearranged_length; $i++) {
			$char = $rearranged[$i];

			if ($char >= 'A' && $char <= 'Z') {
				$numeric .= (string)(ord($char) - 55);
			} else {
				$numeric .= $char;
			}
		}

		$remainder = 0;
		$numeric_length = strlen($numeric);

		for ($i = 0; $i < $numeric_length; $i++) {
			$remainder = ($remainder * 10 + (int)$numeric[$i]) % 97;
		}

		return $remainder;
	}
}
