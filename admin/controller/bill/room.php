<?php
class Controllerbillroom extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('bill/room');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/room');

		$this->getList();
	}

	public function addroom() {
		//  die("hii");
		$this->load->language('bill/room');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/room');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			// print_r($this->request->post);die;
			$this->model_bill_room->addrooms($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_room_id'])) {
				//  die("hii");
				$url .= '&filter_room_id=' . $this->request->get['filter_room_id'];	
			}
	
			if (isset($this->request->get['filter_room_number'])) {
				$url .= '&filter_room_number =' . $this->request->get['filter_room_number'];
			}
	
			if (isset($this->request->get['filter_first_name'])) {
				$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_last_name'])) {
				$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_telephone'])) {
				$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
			} 
	
			if (isset($this->request->get['filter_address'])) {
				$url .= '&filter_address=' .urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
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

			$this->response->redirect($this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function editroom() {
		// die("lll");
		$this->load->language('bill/room');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/room');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateedit()) {
			//  die("lll");
			$this->model_bill_room->editrooms($this->request->get['room_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_room_id'])) {
				$url .= '&filter_room_id=' . $this->request->get['filter_room_id'];
			}
	
			if (isset($this->request->get['filter_room_number'])) {
				$url .= '&filter_room_number=' . $this->request->get['filter_room_number'];
			}
	
			if (isset($this->request->get['filter_first_name'])) {
				$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_last_name'])) {
				$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_telephone'])) {
				$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
			}
	
			if (isset($this->request->get['filter_address'])) {
				$url .= '&filter_address=' . urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
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

			$this->response->redirect($this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function singledelete() {
		//  die("kkk");
		$this->load->language('bill/room');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/room');
		$room_id=$this->request->get['room_id'];
		// die($room_id);

		$this->model_bill_room->deleteroom($room_id);
	
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_room_id'])) {
				// die("hii");
				$url .= '&filter_room_id=' . $this->request->get['filter_room_id'];
				
			}
	
			if (isset($this->request->get['filter_room_number'])) {
				$url .= '&filter_room_number =' . $this->request->get['filter_room_number'];
			}
	
			if (isset($this->request->get['filter_first_name'])) {
				$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_last_name'])) {
				$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_telephone'])) {
				$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
			}
	
			if (isset($this->request->get['filter_address'])) {
				$url .= '&filter_address=' .urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
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

			$this->response->redirect($this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true));
		

		$this->getList();
	}

	public function delete() {
		//   die("kkk");
		$this->load->language('bill/room');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/room');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			foreach ($this->request->post['selected'] as $room_id) {
			    //  print_r($room_id);die;
				  $this->model_bill_room->deleterooms($room_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_room_id'])) {
				$url .= '&filter_room_id=' . $this->request->get['filter_room_id'];
			}
	
			if (isset($this->request->get['filter_room_number'])) {
				$url .= '&filter_room_number=' . $this->request->get['filter_room_number'];
			}
	
			if (isset($this->request->get['filter_first_name'])) {
				$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_last_name'])) {
				$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_telephone'])) {
				$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
			}
	
			if (isset($this->request->get['filter_address'])) {
				$url .= '&filter_address=' . urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
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

			$this->response->redirect($this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function copyroom() {
		//  die("die");
		$this->load->language('bill/room');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('bill/room');

		if (isset($this->request->post['selected']) ) {
			foreach ($this->request->post['selected'] as $room_id) {
				//  die($room_id);
				$this->model_bill_room->copyrooms($room_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_room_id'])) {
				$url .= '&filter_room_id=' . $this->request->get['filter_room_id'];
			}
	
			if (isset($this->request->get['filter_room_number'])) {
				$url .= '&filter_room_number=' . $this->request->get['filter_room_number'];
			}
	
			if (isset($this->request->get['filter_first_name'])) {
				$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_last_name'])) {
				$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
			}
	
			if (isset($this->request->get['filter_telephone'])) {
				$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
			}
	
			if (isset($this->request->get['filter_address'])) {
				$url .= '&filter_address=' . urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
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

			$this->response->redirect($this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}

	public function invoice() {

		$this->load->language('bill/room');

		$data['title'] = $this->language->get('text_invoice');

		$this->load->model('bill/room');
 
		 $data['bills'] = array();
		 $room_id[] = array();

		if (isset($this->request->post['selected']) ) {
			foreach ($this->request->post['selected'] as $room_id) {
				$bills[]=$room_id;
			}
		}

		foreach ($bills as $room_id) {

			    $bill_info = $this->model_bill_room->billinfo($room_id);

			    $data['text_bill'] = sprintf($this->language->get('text_bill'), $room_id);

				if ($bill_info) {
					$data['bills'][] = array(
					'bill_id'             => $bill_info['bill_id'],
					'room_number'         => $bill_info['room_number'],
					'first_name'          => $bill_info['first_name'],
					'last_name'           => $bill_info['last_name'],
					'start_date'          => $bill_info['start_date'],
					'last_date'           => $bill_info['last_date'],
					'start_reading'       => $bill_info['start_reading'],
					'last_reading'        => $bill_info['last_reading'],
					'total_reading'       => $bill_info['total_reading'],
					'total_bill'          => $bill_info['total_bill'],
					'remark'              => $bill_info['remark'],
					);
				} 
				else{
					$bill_info['bill_id'] =0;
				}
		}
			//  print_R($data['bills']);die;
	
		 $this->response->setOutput($this->load->view('bill/roombill_invoice', $data));
   }


	protected function getList() {

		if (isset($this->request->get['filter_room_number'])) {
			// die("hii");
			$filter_room_number = $this->request->get['filter_room_number'];
		} else {
			$filter_room_number = '';
		}

		if (isset($this->request->get['filter_first_name'])) {
			$filter_first_name = $this->request->get['filter_first_name'];
		} else {
			$filter_first_name= '';
		}

		if (isset($this->request->get['filter_last_name'])) {
			$filter_last_name = $this->request->get['filter_last_name'];
		} else {
			$filter_last_name = '';
		}

		if (isset($this->request->get['filter_telephone'])) {
			$filter_telephone = $this->request->get['filter_telephone'];
		} else {
			$filter_telephone = '';
		}

		if (isset($this->request->get['filter_address'])) {
			$filter_address= $this->request->get['filter_address'];
		} else {
			$filter_address = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'room_number';
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

		$url = '';

		if (isset($this->request->get['filter_room_number'])) {
			$url .= '&filter_room_number =' . $this->request->get['filter_room_number'];
		}

		if (isset($this->request->get['filter_first_name'])) {
			$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_last_name'])) {
			$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_telephone'])) {
			$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
		}

		if (isset($this->request->get['filter_address'])) {
			$url .= '&filter_address=' .urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
			//  die($url);
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
			// die($url);
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
			'href' => $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('bill/room/addroom', 'user_token=' . $this->session->data['user_token'] . $url, true);
	    $data['invoice'] = $this->url->link('bill/room/invoice', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['copy'] = $this->url->link('bill/room/copyroom', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('bill/room/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['rooms'] = array();

		$filter_data = array(
			'filter_room_number'	  => $filter_room_number,
			'filter_first_name'	      => $filter_first_name,
			'filter_last_name'	      => $filter_last_name,
			'filter_telephone'        => $filter_telephone,
			'filter_address'          => $filter_address,
			'sort'                    => $sort,
			'order'                   => $order,
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);

		// $this->load->model('bill/room');
		// print_r($filter_data);die;

		$room_total = $this->model_bill_room->getTotalrooms($filter_data);

		$results = $this->model_bill_room->getrooms($filter_data);
		// print_r($results);die;

           foreach($results as $result){
			$data['rooms'][] = array(
				'room_id'            => $result['room_id'],
				'room_number'        => $result['room_number'],
				'first_name'         => $result['first_name'],
				'last_name'          => $result['last_name'],
				'telephone'          => $result['telephone'],
				'address'            => $result['address'],
				'bill'               => $this->url->link('bill/bill', 'user_token=' . $this->session->data['user_token'] . '&room_number=' . $result['room_number'], true),
				'editroom'           => $this->url->link('bill/room/editroom', 'user_token=' . $this->session->data['user_token'] . '&room_id=' . $result['room_id'] . $url, true),
			    'singledelete'       => $this->url->link('bill/room/singledelete', 'user_token='. $this->session->data['user_token'] . '&room_id=' . $result['room_id'] . $url, true),
			);
		}
		// print_r($data);die;

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			// die("hii");
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
			// die("hii");
			// print_r($this->request->post['selected']);die;
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			// die("bye");
			$data['selected'] = array();
		}

		$url = '';


		if (isset($this->request->get['filter_room_number'])) {
			$url .= '&filter_room_number=' . $this->request->get['filter_room_number'];
		}

		if (isset($this->request->get['filter_first_name'])) {
			$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_last_name'])) {
			$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_telephone'])) {
			$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
		}

		if (isset($this->request->get['filter_address'])) {
			$url .= '&filter_address=' . urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_room_id'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . '&sort=room_id' . $url, true);
		$data['sort_room_number'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . '&sort=room_number' . $url, true);
		$data['sort_first_name'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . '&sort=first_name' . $url, true);
		$data['sort_last_name'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . '&sort=last_name' . $url, true);
		$data['sort_telephone'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . '&sort=telephone' . $url, true);
		$data['sort_address'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . '&sort=address' . $url, true);
		$data['sort_order'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_room_number'])) {
			$url .= '&filter_room_number=' . $this->request->get['filter_room_number'];
		}

		if (isset($this->request->get['filter_first_name'])) {
			$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_last_name'])) {
			$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_telephone'])) {
			$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
		}

		if (isset($this->request->get['filter_address'])) {
			$url .= '&filter_address=' . urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
		}


		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
	    //   print_r($this->config->get('config_reading_limit'));die;
		$pagination->total = $room_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($room_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($room_total - $this->config->get('config_limit_admin'))) ? $room_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $room_total, ceil($room_total / $this->config->get('config_limit_admin')));

		// print_R($data['results']);die;
		$data['filter_room_number']    = $filter_room_number;
		$data['filter_first_name']     = $filter_first_name;
		$data['filter_last_name']      = $filter_last_name;
		$data['filter_telephone']      = $filter_telephone;
		$data['filter_address']        = $filter_address;
		$data['sort']                  = $sort;
		$data['order']                 = $order;
		// print_r($data);die;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('bill/room', $data));
	 }
	
	  
	protected function getForm() {
		// die("lll");
		$data['text_form'] = !isset($this->request->get['room_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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

		if (isset($this->error['room_number'])) {
			$data['error_room_number'] = $this->error['room_number'];
		} else {
			$data['error_room_number'] = '';
		}

		if (isset($this->error['first_name'])) {
			$data['error_first_name'] = $this->error['first_name'];
		} else {
			$data['error_first_name'] = '';
		}

		if (isset($this->error['last_name'])) {
			$data['error_last_name'] = $this->error['last_name'];
		} else {
			$data['error_last_name'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['address'])) {
			$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['room_number'])) {
			$url .= '&room_number=' . $this->request->get['room_number'];
		}

		if (isset($this->request->get['filter_room_id'])) {
			$url .= '&filter_room_id=' . $this->request->get['filter_room_id'];
		}

		if (isset($this->request->get['filter_room_number'])) {
			$url .= '&filter_room_number=' . $this->request->get['filter_room_number'];
		}

		if (isset($this->request->get['filter_first_name'])) {
			$url .= '&filter_first_name=' . urlencode(html_entity_decode($this->request->get['filter_first_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_last_name'])) {
			$url .= '&filter_last_name=' . urlencode(html_entity_decode($this->request->get['filter_last_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_telephone'])) {
			$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
		}

		if (isset($this->request->get['filter_address'])) {
			$url .= '&filter_address=' . urlencode(html_entity_decode($this->request->get['filter_address'], ENT_QUOTES, 'UTF-8'));
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
			'href' => $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['room_id'])) {
			$data['action'] = $this->url->link('bill/room/addroom', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('bill/room/editroom', 'user_token=' . $this->session->data['user_token'] . '&room_id=' . $this->request->get['room_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('bill/room', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['room_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$room_info = $this->model_bill_room->allrooms($this->request->get['room_id']);
	    }


		if (isset($this->request->post['room_number'])) {
			$data['room_number'] = $this->request->post['room_number'];
		} elseif (!empty($room_info)) {
			$data['room_number'] = $room_info['room_number'];
		} else {
			$data['room_number'] = '';
		}

		if (isset($this->request->post['first_name'])) {
			// die("kk");
			$data['first_name'] = $this->request->post['first_name'];
		} elseif (!empty($room_info)) {
			// die("kk");
			$data['first_name'] = $room_info['first_name'];
		} else {
			$data['first_name'] = '';
		}

		if (isset($this->request->post['last_name'])) {
			$data['last_name'] = $this->request->post['last_name'];
		} elseif (!empty($room_info)) {
			$data['last_name'] = $room_info['last_name'];
		} else {
			$data['last_name'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($room_info)) {
			$data['telephone'] = $room_info['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (!empty($room_info)) {
			$data['address'] = $room_info['address'];
		} else {
			$data['address'] = '';
		}

		//image
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($room_info)) {
			$data['image'] = $room_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($room_info) && is_file(DIR_IMAGE . $room_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($room_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		// print_r($data);die;
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('bill/roomform', $data));
	}

	protected function validateForm() {
		// die("koo");
		if (!$this->user->hasPermission('modify', 'bill/room')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['room_number']) < 3) || (utf8_strlen($this->request->post['room_number']) > 3)) {
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if(!is_numeric($this->request->post['room_number'])){
			// die("kjo");
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if (!$this->request->post['room_number']) {
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if(!ctype_alpha($this->request->post['first_name'])){
			$this->error['first_name'] = $this->language->get('error_first_name');
		 }

		if ((utf8_strlen($this->request->post['first_name']) < 3) || (utf8_strlen($this->request->post['first_name']) > 256)) {
			$this->error['first_name'] = $this->language->get('error_first_name');
		}

		if (!$this->request->post['first_name']) {
			// die("jii");
			$this->error['first_name'] = $this->language->get('error_first_name');
		}

		if(!ctype_alpha($this->request->post['last_name'])){
			// die("hhjj");
			$this->error['last_name'] = $this->language->get('error_last_name');
		 }

		if ((utf8_strlen($this->request->post['last_name']) < 3) || (utf8_strlen($this->request->post['last_name']) > 256)) {
			$this->error['last_name'] = $this->language->get('error_last_name');
		}

		if (!$this->request->post['last_name']) {
			// die("jii");
			$this->error['last_name'] = $this->language->get('error_last_name');
		}

		if (!$this->request->post['telephone']) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if(!is_numeric($this->request->post['telephone'])){
			// die("kjo");
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 10) || (utf8_strlen($this->request->post['telephone']) > 10)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['address']) < 3) || (utf8_strlen($this->request->post['address']) > 256)) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if (!$this->request->post['address']) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if(ctype_space($this->request->post['address'])){
			$this->error['address']=$this->language->get('error_address');
		}

		if (!preg_match('/^[\p{L} ]+$/u',$this->request->post['address'] )){
			$this->error['address'] = $this->language->get('error_address');
		  }

		  return !$this->error;
	}

	protected function validate() {
		// die("koo");
		if (!$this->user->hasPermission('modify', 'bill/room')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$roomnumber = $this->db->query( "SELECT room_number FROM `oc_room` WHERE room_number =" .  $this->request->post['room_number'])->num_rows;
		
		if( $roomnumber > 0){		
			//  print_R($roomnumber);die;	
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if ((utf8_strlen($this->request->post['room_number']) < 3) || (utf8_strlen($this->request->post['room_number']) > 3)) {
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if(!is_numeric($this->request->post['room_number'])){
			// die("kjo");
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if (!$this->request->post['room_number']) {
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if(!ctype_alpha($this->request->post['first_name'])){
			$this->error['first_name'] = $this->language->get('error_first_name');
		 }

		if ((utf8_strlen($this->request->post['first_name']) < 3) || (utf8_strlen($this->request->post['first_name']) > 256)) {
			$this->error['first_name'] = $this->language->get('error_first_name');
		}

		if (!$this->request->post['first_name']) {
			// die("jii");
			$this->error['first_name'] = $this->language->get('error_first_name');
		}

		if(!ctype_alpha($this->request->post['last_name'])){
			// die("hhjj");
			$this->error['last_name'] = $this->language->get('error_last_name');
		 }

		if ((utf8_strlen($this->request->post['last_name']) < 3) || (utf8_strlen($this->request->post['last_name']) > 256)) {
			$this->error['last_name'] = $this->language->get('error_last_name');
		}

		if (!$this->request->post['last_name']) {
			// die("jii");
			$this->error['last_name'] = $this->language->get('error_last_name');
		}

		if (!$this->request->post['telephone']) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if(!is_numeric($this->request->post['telephone'])){
			// die("kjo");
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 10) || (utf8_strlen($this->request->post['telephone']) > 10)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['address']) < 3) || (utf8_strlen($this->request->post['address']) > 256)) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if (!$this->request->post['address']) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if(ctype_space($this->request->post['address'])){
			$this->error['address']=$this->language->get('error_address');
		}

		if (!preg_match('/^[\p{L} ]+$/u',$this->request->post['address'] )){
			$this->error['address'] = $this->language->get('error_address');
		  }

		  return !$this->error;
	}

	protected function validateedit() {
		// die("koo");
		if (!$this->user->hasPermission('modify', 'bill/room')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		 $rm =$this->db->query("SELECT room_number FROM `oc_room` WHERE room_number =" .  $this->request->post['room_number']);
		//   print_R($rm);die;

		$roomnumber = $this->db->query( "SELECT room_number FROM `oc_room` WHERE room_number =" .  $this->request->post['room_number'])->num_rows;
		// print_R($roomnumber);die;
		if( $roomnumber==1 ){		
			// print_R($roomnumber);die;	
			// die("UPDATE " . DB_PREFIX . "room SET room_number = '" . $this->request->post['room_number']. "', first_name = '" .$this->request->post['first_name'] . "',last_name = '" . $this->request->post['last_name'] . "', telephone = '" . $this->request->post['telephone'] . "', address = '" . $this->request->post['address']. "' WHERE room_id = '" .$this->request->get['room_id'] ."'");
			 $this->db->query("UPDATE " . DB_PREFIX . "room SET room_number = '" . $this->request->post['room_number']. "', first_name = '" .$this->request->post['first_name'] . "',last_name = '" . $this->request->post['last_name'] . "', telephone = '" . $this->request->post['telephone'] . "', address = '" . $this->request->post['address']. "' WHERE room_id = '" .$this->request->get['room_id'] ."'");
			//  $this->error['room_number'] = $this->language->get('error_room_number');
		}
		if($roomnumber>1){		
			//    print_R($roomnumber);die;	
			// die("UPDATE " . DB_PREFIX . "room SET room_number = '" . $this->request->post['room_number']. "', first_name = '" .$this->request->post['first_name'] . "',last_name = '" . $this->request->post['last_name'] . "', telephone = '" . $this->request->post['telephone'] . "', address = '" . $this->request->post['address']. "' WHERE room_id = '" .$this->request->get['room_id'] ."'");
			//  $this->db->query("UPDATE " . DB_PREFIX . "room SET room_number = '" . $this->request->post['room_number']. "', first_name = '" .$this->request->post['first_name'] . "',last_name = '" . $this->request->post['last_name'] . "', telephone = '" . $this->request->post['telephone'] . "', address = '" . $this->request->post['address']. "' WHERE room_id = '" .$this->request->get['room_id'] ."'");
			  $this->error['room_number'] = $this->language->get('error_room_number');
		}

		if ((utf8_strlen($this->request->post['room_number']) < 3) || (utf8_strlen($this->request->post['room_number']) > 3)) {
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if(!is_numeric($this->request->post['room_number'])){
			// die("kjo");
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if (!$this->request->post['room_number']) {
			$this->error['room_number'] = $this->language->get('error_room_number');
		}

		if(!ctype_alpha($this->request->post['first_name'])){
			$this->error['first_name'] = $this->language->get('error_first_name');
		 }

		if ((utf8_strlen($this->request->post['first_name']) < 3) || (utf8_strlen($this->request->post['first_name']) > 256)) {
			$this->error['first_name'] = $this->language->get('error_first_name');
		}

		if (!$this->request->post['first_name']) {
			// die("jii");
			$this->error['first_name'] = $this->language->get('error_first_name');
		}

		if(!ctype_alpha($this->request->post['last_name'])){
			// die("hhjj");
			$this->error['last_name'] = $this->language->get('error_last_name');
		 }

		if ((utf8_strlen($this->request->post['last_name']) < 3) || (utf8_strlen($this->request->post['last_name']) > 256)) {
			$this->error['last_name'] = $this->language->get('error_last_name');
		}

		if (!$this->request->post['last_name']) {
			// die("jii");
			$this->error['last_name'] = $this->language->get('error_last_name');
		}

		if (!$this->request->post['telephone']) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if(!is_numeric($this->request->post['telephone'])){
			// die("kjo");
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 10) || (utf8_strlen($this->request->post['telephone']) > 10)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if ((utf8_strlen($this->request->post['address']) < 3) || (utf8_strlen($this->request->post['address']) > 256)) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if (!$this->request->post['address']) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if(ctype_space($this->request->post['address'])){
			$this->error['address']=$this->language->get('error_address');
		}

		if (!preg_match('/^[\p{L} ]+$/u',$this->request->post['address'] )){
			$this->error['address'] = $this->language->get('error_address');
		  }

		  return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'bill/room')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}

}	
	    
		
		

	// 	foreach ($this->request->post['product_description'] as $language_id => $value) {
	// 		if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
	// 			$this->error['name'][$language_id] = $this->language->get('error_name');
	// 		}

			// if ((utf8_strlen($value['first_name']) < 1) || (utf8_strlen($value['first_name']) > 255)) {
			// 	$this->error['first_name'][$sort_order] = $this->language->get('error_name');
			// }
	// 	}

	// 	if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
	// 		$this->error['model'] = $this->language->get('error_model');
	// 	}

	// 	if ($this->request->post['product_seo_url']) {
	// 		$this->load->model('design/seo_url');

	// 		foreach ($this->request->post['product_seo_url'] as $store_id => $language) {
	// 			foreach ($language as $language_id => $keyword) {
	// 				if (!empty($keyword)) {
	// 					if (count(array_keys($language, $keyword)) > 1) {
	// 						$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_unique');
	// 					}

	// 					$seo_urls = $this->model_design_seo_url->getSeoUrlsByKeyword($keyword);

	// 					foreach ($seo_urls as $seo_url) {
	// 						if (($seo_url['store_id'] == $store_id) && (!isset($this->request->get['product_id']) || (($seo_url['query'] != 'product_id=' . $this->request->get['product_id'])))) {
	// 							$this->error['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');

	// 							break;
	// 						}
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}

	// 	if ($this->error && !isset($this->error['warning'])) {
	// 		$this->error['warning'] = $this->language->get('error_warning');
	// 	}

		

	// protected function validateCopy() {
	// 	if (!$this->user->hasPermission('modify', 'catalog/product')) {
	// 		$this->error['warning'] = $this->language->get('error_permission');
	// 	}

	// 	return !$this->error;
	//  }

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

