
<?php
class Controllerbillreadinglimit extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('bill/reading');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('bill', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('bill/readinglimit', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		if (isset($this->error['warning'])) {
			// die("jki");
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['reading_limit'])) {
			$data['error_reading_limit'] = $this->error['reading_limit'];
		} else {
			$data['error_reading_limit'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('bill/readinglimit', 'user_token=' . $this->session->data['user_token'], true)
		);

		if (isset($this->session->data['success'])) {
			// die($this->session->data['success']);
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			// die("bhole");
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('bill/readinglimit', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('setting/store', 'user_token=' . $this->session->data['user_token'], true);

		$data['user_token'] = $this->session->data['user_token'];
		
		if (isset($this->request->post['bill_reading_limit'])) {
			//  die("koo");
			$data['bill_reading_limit'] = $this->request->post['bill_reading_limit'];
		} else {
			$data['bill_reading_limit'] = $this->config->get('bill_reading_limit');

		}
		// print_r(($data));die;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('bill/settingform', $data));
	}

	protected function validate() {
		// die("jki");
		if (!$this->user->hasPermission('modify', 'bill/readinglimit')) {
			// die("jki");
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['bill_reading_limit']) {
			//  die("kiii");
			$this->error['reading_limit'] = $this->language->get('error_reading_limit');
		}

		


		
         // print_r($this->error);die;
		return !$this->error;
	}
	
	
}