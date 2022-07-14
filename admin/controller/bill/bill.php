<?php
class Controllerbillbill extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('bill/bill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/bill');

		$this->getList();
	}

	public function addbill() {
        //   die("kk");

		if (isset($this->request->get['room_number'])) {
		//   die($this->request->get['room_number']);
			$room_number = $this->request->get['room_number'];
		} else {
			$room_number = '';
		} 

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'bill_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$this->load->language('bill/bill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/bill');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			//  die("jiii");
			
			$this->model_bill_bill->addbills($this->request->post ,$room_number);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['room_number'])) {
				$url .= '&room_number=' . $this->request->get['room_number'];
			}
	
			if (isset($this->request->get['filter_bill_id'])) {
				$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
			}
	
			if (isset($this->request->get['filter_start_date'])) {
				$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
			}
	
			if (isset($this->request->get['filter_last_date'])) {
				$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
			}
	
			if (isset($this->request->get['filter_start_reading'])) {
				$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
			}
	
			if (isset($this->request->get['filter_last_reading'])) {
				$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
			}
	
			if (isset($this->request->get['filter_total_reading'])) {
				$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
			}
	
			if (isset($this->request->get['filter_total_bill'])) {
				$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			//  die($room_number);

			$this->response->redirect($this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function generatebill() {
        //    die("kk");

		if (isset($this->request->get['room_number'])) {
		    //   die($this->request->get['room_number']);
			$room_number = $this->request->get['room_number'];
		} else {
			$room_number = '';
		} 

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'bill_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		//  die("jiii");
		$this->load->language('bill/bill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/bill');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->valid()) {
			//  die("oooooo");
			
			$this->model_bill_bill->billgenerate($this->request->post ,$room_number);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['room_number'])) {
				//    die($this->request->get['room_number']);
				$url.'&room_number='.$this->request->get['room_number'];
			} 
	
			if (isset($this->request->get['filter_bill_id'])) {
				$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
			}
	
			if (isset($this->request->get['filter_start_date'])) {
				$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
			}
	
			if (isset($this->request->get['filter_last_date'])) {
				$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
			}
	
			if (isset($this->request->get['filter_start_reading'])) {
				$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
			}
	
			if (isset($this->request->get['filter_last_reading'])) {
				$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
			}
	
			if (isset($this->request->get['filter_total_reading'])) {
				$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
			}
	
			if (isset($this->request->get['filter_total_bill'])) {
				$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] .'&room_number='.$room_number. $url, true));
		}

		$this->generatebillform();
	}

	public function editbill() {

		if (isset($this->request->get['room_number'])) {
		    // die($this->request->get['room_number']);
			$room_number = $this->request->get['room_number'];
		} else {
			$room_number = '';
		} 

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'bill_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$this->load->language('bill/bill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/bill');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->valid() ) {
			//  print_r($this->request->post);die;

			$this->model_bill_bill->editbills($this->request->get['bill_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['room_number'])) {
				$url .= '&room_number=' . $this->request->get['room_number'];
			 //  print_r($url);die;
		    }

			if (isset($this->request->get['filter_bill_id'])) {
				$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
			}
	
			if (isset($this->request->get['filter_start_date'])) {
				$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
			}
	
			if (isset($this->request->get['filter_last_date'])) {
				$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
			}
	
			if (isset($this->request->get['filter_start_reading'])) {
				$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
			}
	
			if (isset($this->request->get['filter_last_reading'])) {
				$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
			}
	
			if (isset($this->request->get['filter_total_reading'])) {
				$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
			}
	
			if (isset($this->request->get['filter_total_bill'])) {
				$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
			}
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->generatebillForm();
	}

	public function deletesinglebill() {
		$this->load->language('bill/bill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/bill');
		$bill_id=$this->request->get['bill_id'];
		$room_number=$this->request->get['room_number'];
		// die($room_number);

			$this->model_bill_bill->deletebill($bill_id);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
	
			if (isset($this->request->get['filter_bill_id'])) {
				$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
			}
	
			if (isset($this->request->get['filter_start_date'])) {
				$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
			}
	
			if (isset($this->request->get['filter_last_date'])) {
				$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
			}
	
			if (isset($this->request->get['filter_start_reading'])) {
				$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
			}
	
			if (isset($this->request->get['filter_last_reading'])) {
				$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
			}
	
			if (isset($this->request->get['filter_total_reading'])) {
				$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
			}
	
			if (isset($this->request->get['filter_total_bill'])) {
				$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			// die($room_number);

			$this->response->redirect($this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] .'&room_number='.$room_number. $url, true));
		

		$this->getList();
	}

	public function deletebill() {
		//  die("kkk");
		$this->load->language('bill/bill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/bill');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			// die("jiii");
			$room_number=$this->request->get['room_number'];
			// die($room_number);
			foreach ($this->request->post['selected'] as $bill_id)  {
				//  die($room_id);
				$this->model_bill_bill->deletebills($bill_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
	
			if (isset($this->request->get['filter_bill_id'])) {
				$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
			}
	
			if (isset($this->request->get['filter_start_date'])) {
				$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
			}
	
			if (isset($this->request->get['filter_last_date'])) {
				$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
			}
	
			if (isset($this->request->get['filter_start_reading'])) {
				$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
			}
	
			if (isset($this->request->get['filter_last_reading'])) {
				$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
			}
	
			if (isset($this->request->get['filter_total_reading'])) {
				$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
			}
	
			if (isset($this->request->get['filter_total_bill'])) {
				$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'].'&room_number='.$room_number . $url, true));
		}

		$this->getList();
	}

	public function copybill() {
        // die("jii");
		if (isset($this->request->get['room_number'])) {
		    //   die($this->request->get['room_number']);
			$room_number = $this->request->get['room_number'];
		} else {
			$room_number = '';
		} 

		$this->load->language('bill/bill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/bill');

		if (isset($this->request->post['selected']) ) {
			foreach ($this->request->post['selected'] as $bill_id) {
				$this->model_bill_bill->copybills($bill_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_bill_id'])) {
				$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
			}
	
			if (isset($this->request->get['filter_room_number'])) {
				$url .= '&filter_number=' . $this->request->get['filter_room_number'];
				// print_r($url);
			}
	
			if (isset($this->request->get['filter_start_date'])) {
				$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
			}
	
			if (isset($this->request->get['filter_last_date'])) {
				$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
			}
	
			if (isset($this->request->get['filter_start_reading'])) {
				$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
			}
	
			if (isset($this->request->get['filter_last_reading'])) {
				$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
			}
	
			if (isset($this->request->get['filter_total_reading'])) {
				$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
			}
	
			if (isset($this->request->get['filter_total_bill'])) {
				$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
			}	

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'].'&room_number='.$room_number . $url, true));
		}

		$this->getList();
	}
	
	public function printbill() {
		// die("hii");
		$this->load->model('bill/bill');

		if (isset($this->request->get['bill_id'])) {
			$bill_id = $this->request->get['bill_id'];
			// print_r($bill_id);die;
		} else {
			$bill_id = 0;
		}

		if (isset($this->request->get['room_number'])) {
			$room_number = $this->request->get['room_number'];
			// print_r($bill_id);die;
		} else {
			$room_number = 0;
		}

		 $bill_detail = $this->model_bill_bill->billinfo($bill_id);
	   
		if ($bill_detail) {
			$this->load->language('bill/bill');

			$this->document->setTitle($this->language->get('heading_title'));

			$url = '';

			if (isset($this->request->get['room_number'])) {
				$url .= '&room_number=' . $this->request->get['room_number'];
			}
	
			if (isset($this->request->get['filter_start_date'])) {
				$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
			}
	
			if (isset($this->request->get['filter_last_date'])) {
				$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
			}
	
			if (isset($this->request->get['filter_start_reading'])) {
				$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
			}
	
			if (isset($this->request->get['filter_last_reading'])) {
				$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
			}
	
			if (isset($this->request->get['filter_total_reading'])) {
				$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
			}
	
			if (isset($this->request->get['filter_total_bill'])) {
				$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);

			$data['invoice'] = $this->url->link('bill/bill/invoice', 'user_token=' . $this->session->data['user_token'].'&bill_id='.$bill_id.'&room_number='.$room_number, true);
			$data['cancel'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true);

			$data['user_token'] = $this->session->data['user_token'];
			
		    $data['room_number']         = $bill_detail['room_number'];
			$data['first_name']          = $bill_detail['first_name'];
			$data['last_name']           = $bill_detail['last_name'];
			$data['start_date']          = $bill_detail['start_date'];
			$data['last_date']           = $bill_detail['last_date'];
			$data['start_reading']       = $bill_detail['start_reading'];
			$data['last_reading']        = $bill_detail['last_reading'];
			$data['total_reading']       = $bill_detail['total_reading'];
			$data['total_bill']          = $bill_detail['total_bill'];
			$data['remark']              = $bill_detail['remark'];
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('bill/print', $data));
		}
	}


	public function invoice() {

		$this->load->language('bill/bill');

		$data['title'] = $this->language->get('text_invoice');

		$this->load->model('bill/bill');

	     if (isset($this->request->get['bill_id'])) {
			$bills= $this->request->get['bill_id'];
		}
			
			$bill_info = $this->model_bill_bill->billinfo($bills);
			
			$data['text_bill'] = sprintf($this->language->get('text_bill'), $bills);
			
			if ($bill_info) {
				// print_r($bill_info);die;
				if ($bill_info) {
					$data['bill_id']          = $bill_info['bill_id'];
					$data['room_number']      = $bill_info['room_number'];
					$data['first_name']       = $bill_info['first_name'];
					$data['last_name']        = $bill_info['last_name'];
					$data['start_date']       = $bill_info['start_date'];
					$data['last_date']        = $bill_info['last_date'];
					$data['start_reading']    = $bill_info['start_reading'];
					$data['last_reading']     = $bill_info['last_reading'];
					$data['total_reading']    = $bill_info['total_reading'];
					$data['total_bill']       = $bill_info['total_bill'];
					$data['remark']           = $bill_info['remark'];
				} 
				else{
					$data['bill_id'] =0;
				}
		  }
		  
		$this->response->setOutput($this->load->view('bill/bill_invoice', $data));
	}

	protected function getList() {

		if (isset($this->request->get['room_number'])) {
			$room_number = $this->request->get['room_number'];
			//  die($room_number);
		} else {
			$room_number = '';
		} 

		if (isset($this->request->get['filter_start_date'])) {
			// die("hh");
			$filter_start_date = $this->request->get['filter_start_date'];
		} else {
			// die("hh");
			$filter_start_date = '';
		}

		if (isset($this->request->get['filter_last_date'])) {
			$filter_last_date = $this->request->get['filter_last_date'];
		} else {
			$filter_last_date = '';
		}

		if (isset($this->request->get['filter_start_reading'])) {
			$filter_start_reading = $this->request->get['filter_start_reading'];
		} else {
			$filter_start_reading = '';
		}

		if (isset($this->request->get['filter_last_reading'])) {
			$filter_last_reading = $this->request->get['filter_last_reading'];
		} else {
			$filter_last_reading = '';
		}

		if (isset($this->request->get['filter_total_reading'])) {
			$filter_total_reading= $this->request->get['filter_total_reading'];
		} else {
			$filter_total_reading = '';
		}

		if (isset($this->request->get['filter_total_bill'])) {
			$filter_total_bill= $this->request->get['filter_total_bill'];
		} else {
			$filter_total_bill= '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'bill_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['room_number'])) {
			$url .= '&room_number=' . $this->request->get['room_number'];
			//  die($url);
		}

		if (isset($this->request->get['filter_bill_id'])) {
			$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
		}

		if (isset($this->request->get['filter_start_date'])) {
			$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
		}

		if (isset($this->request->get['filter_last_date'])) {
			$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
		}

		if (isset($this->request->get['filter_start_reading'])) {
			$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
		}

		if (isset($this->request->get['filter_last_reading'])) {
			$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
		}

		if (isset($this->request->get['filter_total_reading'])) {
			$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
		}

		if (isset($this->request->get['filter_total_bill'])) {
			$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);
		
		// $bills =$this->model_bill_bill->billid($room_number);
		// foreach ($bills as $bill) {
		// 	$data['bills'][] = array(
		// 		'bill_id'            => $bill['billid']
		// 	);
		// }
	    //  print_r($bills);die;

		$data['add'] = $this->url->link('bill/bill/addbill', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['generatebill'] = $this->url->link('bill/bill/generatebill', 'user_token=' . $this->session->data['user_token'] . $url, true);
	     $data['print'] = $this->url->link('bill/bill/printbill', 'user_token=' . $this->session->data['user_token'] .'&bill_id='.$bill['billid']. $url, true);
		$data['copy'] = $this->url->link('bill/bill/copybill', 'user_token=' . $this->session->data['user_token'] .'&room_number='.$room_number. $url, true);
		$data['delete'] = $this->url->link('bill/bill/deletebill', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['bills'] = array();

		$filter_data = array(
			'room_number'	          => $room_number,
			'filter_start_date'	      => $filter_start_date,
			'filter_last_date'        => $filter_last_date,
			'filter_start_reading'    => $filter_start_reading,
			'filter_last_reading'     => $filter_last_reading,
			'filter_total_reading'    => $filter_total_reading,
			'filter_total_bill'       => $filter_total_bill,
			'sort'                    => $sort,
			'order'                   => $order,
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);
	//    print_r($filter_data);die;

		$room_number=($this->request->get['room_number']);
		//  die($room_number);
		$results =$this->model_bill_bill->billtable($room_number);

		if(isset($room_number) && !empty($room_number)){
			$bill_total = $this->model_bill_bill->getTotalbillslist($room_number,$filter_data);
		    $results = $this->model_bill_bill->getbillslist($room_number,$filter_data);
		}

		elseif(isset($room_number)){
			//   die($room_number);
		    // print_r($filter_data);die;
			$bill_total = $this->model_bill_bill->getTotalbills($filter_data);
		    $results = $this->model_bill_bill->getbills($filter_data);
		}
		
		foreach ($results as $result) {

			$data['bills'][] = array(
				'bill_id'            => $result['bill_id'],
				'room_number'        => $result['room_number'],
				'start_date'         => $result['start_date'],
				'last_date'          => $result['last_date'],
				'start_reading'      => $result['start_reading'],
				'last_reading'       => $result['last_reading'],
				'total_reading'      => $result['total_reading'],
				'total_bill'         => $result['total_bill'],
				'remark'             => $result['remark'],
				'editbill'           => $this->url->link('bill/bill/editbill', 'user_token=' . $this->session->data['user_token'] . '&bill_id=' . $result['bill_id'] . $url, true),
				'deletesinglebill'   => $this->url->link('bill/bill/deletesinglebill', 'user_token=' . $this->session->data['user_token'] . '&bill_id=' . $result['bill_id'] . $url, true),
				'print'              =>$this->url->link('bill/bill/printbill', 'user_token=' . $this->session->data['user_token'] .'&bill_id=' . $result['bill_id']. $url, true)

			);
		}
		// print_r($results);die;
		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['room_number'])) {
			$url .= '&room_number=' . $this->request->get['room_number'];
			// die($url);
		}

		if (isset($this->request->get['filter_bill_id'])) {
			$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
		}

		if (isset($this->request->get['filter_start_date'])) {
			$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
		}

		if (isset($this->request->get['filter_last_date'])) {
			$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
		}

		if (isset($this->request->get['filter_start_reading'])) {
			$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
		}

		if (isset($this->request->get['filter_last_reading'])) {
			$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
		}

		if (isset($this->request->get['filter_total_reading'])) {
			$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
		}

		if (isset($this->request->get['filter_total_bill'])) {
			$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
		}

		if ($order == 'DESC') {
			$url .= '&order=ASC';
		} else {
			$url .= '&order=DESC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
        
		$data['sort_room_number'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=room_number' . $url, true);
		$data['sort_start_date'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=start_date' . $url, true);
		$data['sort_last_date'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=last_date' . $url, true);
		$data['sort_start_reading'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=start_reading' . $url, true);
		$data['sort_last_reading'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=last_reading' . $url, true);
		$data['sort_total_reading'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=total_reading' . $url, true);
		$data['sort_total_bill'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=total_reading' . $url, true);
		$data['sort_remark'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&sort=remark' . $url, true);


		$url = '';

		if (isset($this->request->get['filter_bill_id'])) {
			$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
		}

		if (isset($this->request->get['room_number'])) {
			$url .= '&room_number=' . $this->request->get['room_number'];
			//  die($url);
		}

		if (isset($this->request->get['filter_start_date'])) {
			$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
		}

		if (isset($this->request->get['filter_last_date'])) {
			$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
		}

		if (isset($this->request->get['filter_start_reading'])) {
			$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
		}

		if (isset($this->request->get['filter_last_reading'])) {
			$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
		}

		if (isset($this->request->get['filter_total_reading'])) {
			$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
		}

		if (isset($this->request->get['filter_total_bill'])) {
			$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
	    // print_r(($this->config->get('config_reading_limit')));die;
		
		$pagination->total = $bill_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($bill_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($bill_total - $this->config->get('config_limit_admin'))) ? $bill_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $bill_total, ceil($bill_total / $this->config->get('config_limit_admin')));
      
		$data['room_number']  =$room_number;
		$data['filter_start_date'] = $filter_start_date;
		$data['filter_last_last'] = $filter_last_date;
		$data['filter_start_reading'] = $filter_start_reading;
		$data['filter_last_reading'] = $filter_last_reading;
		$data['filter_total_reading'] = $filter_total_reading;
		$data['filter_total_bill'] = $filter_total_bill;
		$data['sort'] = $sort;
		$data['order'] = $order;
		//   print_r($data);die;
		//  print($data['room_number']);die;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('bill/bill', $data));
	}

	protected function getForm() {
		$data['text_form'] = !isset($this->request->get['bill_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if(isset($this->error['start_date'])){
			$data['error_start_date']=$this->error['start_date'];
		}
		else{
			$data['error_start_date'] ='';
		}

		if(isset($this->error['last_date'])){
			$data['error_last_date']=$this->error['last_date'];
		}
		else{
			$data['error_last_date']='';
		}

		if(isset($this->error['start_reading'])){
			$data['error_start_reading']=$this->error['start_reading'];
		}
		else{
			$data['error_start_reading'] = '';
		}

		if(isset($this->error['last_reading'])){
			$data['error_last_reading']=$this->error['last_reading'];
		}
		else{
			$data['error_last_reading']='';
		}

		if(isset($this->error['remark'])){
			$data['error_remark']=$this->error['remark'];
		}
		else{
			$data['error_remark']='';
		}

		$url = '';

		if (isset($this->request->get['room_number'])) {
			$url .= '&room_number=' . $this->request->get['room_number'];
			//  print_r($url);
		}

		if (isset($this->request->get['filter_bill_id'])) {
			$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
		}

		if (isset($this->request->get['filter_start_date'])) {
			$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
		}

		if (isset($this->request->get['filter_last_date'])) {
			$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
		}

		if (isset($this->request->get['filter_start_reading'])) {
			$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
		}

		if (isset($this->request->get['filter_last_reading'])) {
			$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
		}

		if (isset($this->request->get['filter_total_reading'])) {
			$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
		}

		if (isset($this->request->get['filter_total_bill'])) {
			$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['bill_id'])) {
			$data['action'] = $this->url->link('bill/bill/addbill', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('bill/bill/editbill', 'user_token=' . $this->session->data['user_token'] . '&bill_id=' . $this->request->get['bill_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['bill_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			// die("jii");
			$bill_info = $this->model_bill_bill->allbills($this->request->get['bill_id']);
		}

		if (isset($this->request->post['start_date'])) {
			$data['start_date'] = $this->request->post['start_date'];
		} elseif (!empty($bill_info)) {
			$data['start_date'] = $bill_info['start_date'];
		} else {
			$data['start_date'] = '';
		}

		if (isset($this->request->post['last_date'])) {
			$data['last_date'] = $this->request->post['last_date'];
		} elseif (!empty($bill_info)) {
			$data['last_date'] = $bill_info['last_date'];
		} else {
			$data['last_date'] = '';
		}

		if (isset($this->request->post['start_reading'])) {
			$data['start_reading'] = $this->request->post['start_reading'];
		} elseif (!empty($bill_info)) {
			$data['start_reading'] = $bill_info['start_reading'];
		} else {
			$data['start_reading'] = '';
		}

		if (isset($this->request->post['last_reading'])) {
			$data['last_reading'] = $this->request->post['last_reading'];
		} elseif (!empty($bill_info)) {
			$data['last_reading'] = $bill_info['last_reading'];
		} else {
			$data['last_reading'] = '';
		}

		if (isset($this->request->post['total_reading'])) {
			$data['total_reading'] = $this->request->post['total_reading'];
		} elseif (!empty($bill_info)) {
			$data['total_reading'] = $bill_info['total_reading'];
		} else {
			$data['total_reading'] = '';
		}

		if (isset($this->request->post['total_bill'])) {
			$data['total_bill'] = $this->request->post['total_bill'];
		} elseif (!empty($bill_info)) {
			$data['total_bill'] = $bill_info['total_bill'];
		} else {
			$data['total_bill'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('bill/billform', $data));
	}

	protected function generatebillform() {
		// die("kkk");
		$data['text_form'] = !isset($this->request->get['bill_id']) ? $this->language->get('text_generate') : $this->language->get('text_edit');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if(isset($this->error['last_date'])){
			$data['error_last_date']=$this->error['last_date'];
		}
		else{
			$data['error_last_date']='';
		}

		if(isset($this->error['last_reading'])){
			//  die("pp");
			$data['error_last_reading']=$this->error['last_reading'];
		}
		else{
			$data['error_last_reading']='';
		}

		if(isset($this->error['remark'])){
			//  die("pp");
			$data['error_remark']=$this->error['remark'];
		}
		else{
			$data['error_remark']='';
		}

		$url = '';

		if (isset($this->request->get['room_number'])) {
			$url .= '&room_number=' . $this->request->get['room_number'];
		}

		if (isset($this->request->get['filter_bill_id'])) {
			$url .= '&filter_bill_id=' . $this->request->get['filter_bill_id'];
		}

		if (isset($this->request->get['filter_start_date'])) {
			$url .= '&filter_start_date=' . $this->request->get['filter_start_date'];
		}

		if (isset($this->request->get['filter_last_date'])) {
			$url .= '&filter_last_date=' . $this->request->get['filter_last_date'];
		}

		if (isset($this->request->get['filter_start_reading'])) {
			$url .= '&filter_start_reading=' . $this->request->get['filter_start_reading'];
		}

		if (isset($this->request->get['filter_last_reading'])) {
			$url .= '&filter_last_reading=' . $this->request->get['filter_last_reading'];
		}

		if (isset($this->request->get['filter_total_reading'])) {
			$url .= '&filter_total_reading=' . $this->request->get['filter_total_reading'];
		}

		if (isset($this->request->get['filter_total_bill'])) {
			$url .= '&filter_total_bill=' . $this->request->get['filter_total_bill'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['bill_id'])) {
			//  die($data['action']);
			$data['action'] = $this->url->link('bill/bill/generatebill', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$bill_reading = $this->model_bill_bill->bill_lastreading($this->request->get['bill_id'], $this->request->get['room_number']);

		} else {
			$data['action'] = $this->url->link('bill/bill/editbill', 'user_token=' . $this->session->data['user_token'] . '&bill_id=' . $this->request->get['bill_id'] . $url, true);
		//    die($data['action']);
		}

		$data['cancel'] = $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['bill_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			//  die($this->request->get['bill_id']);
			$bill_info = $this->model_bill_bill->allbills($this->request->get['bill_id']);
		   $bill_reading = $this->model_bill_bill->bill_startreading($this->request->get['bill_id'], $this->request->get['room_number']);

			// print_r($bill_info);die;
		}

		if (isset($this->request->post['start_reading'])) {
			$data['start_reading'] = $this->request->post['start_reading'];
		} elseif (!empty($bill_reading)) {
			    // print_r($bill_reading['start_reading']);die;
			$data['start_reading'] = $bill_reading['start_reading'];
			// print_r($data['start_reading']);die;
		} else {
			$data['start_reading'] = '';
		} 

		if (isset($this->request->post['start_date'])) {
			$data['start_date'] = $this->request->post['start_date'];
		} elseif (!empty($bill_reading)) {
			// print_r($bill_reading['start_date']);die;
			$data['start_date'] = $bill_reading['start_date'];
		} else {
			$data['start_date'] = '';
		}

		if (isset($this->request->post['last_date'])) {
			$data['last_date'] = $this->request->post['last_date'];
		} elseif (!empty($bill_info)) {
			$data['last_date'] = $bill_info['last_date'];
		} else {
			$data['last_date'] = '';
		}

		if (isset($this->request->post['last_reading'])) {
			$data['last_reading'] = $this->request->post['last_reading'];
		} elseif (!empty($bill_info)) {
			$data['last_reading'] = $bill_info['last_reading'];
		} else {
			$data['last_reading'] = '';
		} 

		if (isset($this->request->post['remark'])) {
			$data['remark'] = $this->request->post['remark'];
		} elseif (!empty($bill_info)) {
			$data['remark'] = $bill_info['remark'];
		} else {
			$data['remark'] = '';
		} 
	    //  print_r($data);die;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('bill/generatebillform', $data));
	}

	protected function valid(){
		// die("koo");
		if (!$this->user->hasPermission('modify', 'bill/bill')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if($this->request->post['last_reading'] <= $this->request->post['start_reading']){
			    // die("koohhjj");
		   $this->error['last_reading']=$this->language->get('error_last_reading');
	    }

		if($this->request->post['last_date'] <= $this->request->post['start_date']){
			// die("koohhjj");
	     $this->error['last_date']=$this->language->get('error_last_date');
       }

		if (empty($this->request->post['last_date'])) {
			//  die("pp");
			$this->error['last_date']=$this->language->get('error_last_date');
		}

		if (!$this->request->post['last_reading']) {
			// die("ppm");
			$this->error['last_reading'] = $this->language->get('error_last_reading');
		}

		if(!is_numeric($this->request->post['last_reading'])){
			    // die("kjo");
			$this->error['last_reading'] = $this->language->get('error_last_reading');
		}

		if ((utf8_strlen($this->request->post['remark']) < 3) || (utf8_strlen($this->request->post['remark']) > 256)) {
			$this->error['remark'] = $this->language->get('error_remark');
		}

		if(ctype_space($this->request->post['remark'])){
			$this->error['remark']=$this->language->get('error_remark');
		}

		if (!preg_match('/^[\p{L} ]+$/u',$this->request->post['remark'] )){
			$this->error['remark'] = $this->language->get('error_remark');
		  }

		return !$this->error;
	}


	protected function validateForm() {
		// die("ko");
		if (!$this->user->hasPermission('modify', 'bill/bill')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (empty($this->request->post['start_date'])) {
			//  die("pp");
			$this->error['start_date']=$this->language->get('error_start_date');
		}
		
		if (empty($this->request->post['last_date'])) {
			//  die("pp");
			$this->error['last_date']=$this->language->get('error_last_date');
		}
		
		if($this->request->post['last_date'] <= $this->request->post['start_date']){
			$this->error['last_date']=$this->language->get('error_last_date');
		}

		if (!$this->request->post['start_reading']) {
			$this->error['start_reading'] = $this->language->get('error_start_reading');
		}

		if(!is_numeric($this->request->post['start_reading'])){
			// die("kjo");
			$this->error['start_reading'] = $this->language->get('error_start_reading');
		}

		if (!$this->request->post['last_reading']) {
			// die("ppm");
			$this->error['last_reading'] = $this->language->get('error_last_reading');
		}

		if(!is_numeric($this->request->post['last_reading'])){
			//    die("kjo");
			$this->error['last_reading'] = $this->language->get('error_last_reading');
		}

		if($this->request->post['last_reading'] <= $this->request->post['start_reading']){
			// die("jooo");
			$this->error['last_reading']=$this->language->get('error_last_reading');
		}

		// if (!$this->request->post['remark']) {
		// 	//   die("pp");
		// 	$this->error['remark']=$this->language->get('error_remark');
		// }

		if ((utf8_strlen($this->request->post['remark']) < 3) || (utf8_strlen($this->request->post['remark']) > 256)) {
			$this->error['remark'] = $this->language->get('error_remark');
		}

		if(ctype_space($this->request->post['remark'])){
			$this->error['remark']=$this->language->get('error_remark');
		}

		if (!preg_match('/^[\p{L} ]+$/u',$this->request->post['remark'] )){
			$this->error['remark'] = $this->language->get('error_remark');
		  }

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'bill/bill')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	
	// public function autocomplete() {
	// 	$json = array();

	// 	if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
	// 		$this->load->model('catalog/product');
	// 		$this->load->model('catalog/option');

	// 		if (isset($this->request->get['filter_name'])) {
	// 			$filter_name = $this->request->get['filter_name'];
	// 		} else {
	// 			$filter_name = '';
	// 		}

	// 		if (isset($this->request->get['filter_model'])) {
	// 			$filter_model = $this->request->get['filter_model'];
	// 		} else {
	// 			$filter_model = '';
	// 		}

	// 		if (isset($this->request->get['limit'])) {
	// 			$limit = (int)$this->request->get['limit'];
	// 		} else {
	// 			$limit = 5;
	// 		}

	// 		$filter_data = array(
	// 			'filter_name'  => $filter_name,
	// 			'filter_model' => $filter_model,
	// 			'start'        => 0,
	// 			'limit'        => $limit
	// 		);

	// 		$results = $this->model_catalog_product->getProducts($filter_data);

	// 		foreach ($results as $result) {
	// 			$option_data = array();

	// 			$product_options = $this->model_catalog_product->getProductOptions($result['product_id']);

	// 			foreach ($product_options as $product_option) {
	// 				$option_info = $this->model_catalog_option->getOption($product_option['option_id']);

	// 				if ($option_info) {
	// 					$product_option_value_data = array();

	// 					foreach ($product_option['product_option_value'] as $product_option_value) {
	// 						$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

	// 						if ($option_value_info) {
	// 							$product_option_value_data[] = array(
	// 								'product_option_value_id' => $product_option_value['product_option_value_id'],
	// 								'option_value_id'         => $product_option_value['option_value_id'],
	// 								'name'                    => $option_value_info['name'],
	// 								'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
	// 								'price_prefix'            => $product_option_value['price_prefix']
	// 							);
	// 						}
	// 					}

	// 					$option_data[] = array(
	// 						'product_option_id'    => $product_option['product_option_id'],
	// 						'product_option_value' => $product_option_value_data,
	// 						'option_id'            => $product_option['option_id'],
	// 						'name'                 => $option_info['name'],
	// 						'type'                 => $option_info['type'],
	// 						'value'                => $product_option['value'],
	// 						'required'             => $product_option['required']
	// 					);
	// 				}
	// 			}

	// 			$json[] = array(
	// 				'product_id' => $result['product_id'],
	// 				'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
	// 				'model'      => $result['model'],
	// 				'option'     => $option_data,
	// 				'price'      => $result['price']
	// 			);
	// 		}
	// 	}

	// 	$this->response->addHeader('Content-Type: application/json');
	// 	$this->response->setOutput(json_encode($json));
	// }
}