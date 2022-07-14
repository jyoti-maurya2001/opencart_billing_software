<?php
class Modelbillroom extends Model {
	public function addrooms($data) {
		// print_r($data);die;
			$query= $this->db->query("INSERT  INTO ".DB_PREFIX. "room SET room_number='". $this->db->escape($data['room_number'])."',first_name='".$this->db->escape($data['first_name']) ."',last_name='".$this->db->escape($data['last_name'])."',telephone ='".$this->db->escape($data['telephone']) ."',address='".$this->db->escape($data['address'])."',image='".$this->db->escape($data['image'])."'");

		   return $query->row;
	}

	public function editrooms($room_id, $data) {
		// print_r($data);die;
		//   die("UPDATE " . DB_PREFIX . "room SET room_number = '" . $this->db->escape($data['room_number']) . "', first_name = '" . $this->db->escape($data['first_name']) . "',last_name = '" . $this->db->escape($data['last_name']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', address = '" . $this->db->escape($data['address']) . "' WHERE room_id = '" . (int)$room_id ."'");
		$this->db->query("UPDATE " . DB_PREFIX . "room SET room_number = '" . $this->db->escape($data['room_number']) . "', first_name = '" . $this->db->escape($data['first_name']) . "',last_name = '" . $this->db->escape($data['last_name']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', address = '" . $this->db->escape($data['address']). "', image = '" . $this->db->escape($data['image']) . "' WHERE room_id = '" . (int)$room_id ."'");
		
	}

	public function copyrooms($room_id) {
		//  die($room_id);
		 $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "room WHERE room_id = '" . (int)$room_id . "'");
		//  die("SELECT DISTINCT * FROM " . DB_PREFIX . "room WHERE room_id = '" . (int)$room_id . "'");
        $data=array();

		foreach($query->rows as $room_data){

			$data[]=array(

				'room_id'        =>$room_data['room_id'],
				'room_number'    =>$room_data['room_number'],
				'first_name'     =>$room_data['first_name'],
				'last_name'      =>$room_data['last_name'],
				'telephone'      =>$room_data['telephone'],
				'address'        =>$room_data['address']

			);

			$this->adddata($data);
		}
		
	}

	public function adddata($data) {
		//  print_r($data);die;
		// $this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW(), date_modified = NOW()");
		foreach( $data as $value){
			$query= $this->db->query("INSERT  INTO ".DB_PREFIX. "room SET room_number='". $this->db->escape($value['room_number']) ."',first_name='".$this->db->escape($value['first_name']) ."',last_name='".$this->db->escape($value['last_name']) ."',telephone ='".$this->db->escape($value['telephone'])."',address='".$this->db->escape($value['address'])."'");
		    return $query;
		}	
	}

	public function allrooms($room_id) {
		//  die("SELECT  DISTINCT * FROM  ".DB_PREFIX. "room  WHERE room_id ='".(int)$room_id."'");
		$query = $this->db->query("SELECT  DISTINCT * FROM  ".DB_PREFIX. "room  WHERE room_id ='".(int)$room_id."'");
		return $query->row;
	}

	public function billinfo($room_id){
		// print_r($room_id);die;
		//  die("SELECT * FROM  ".DB_PREFIX. "room r  LEFT JOIN " .DB_PREFIX."bill b on r.room_number = b.room_number WHERE r.room_id ='".(int)$room_id."'");
		$query =$this->db->query("SELECT max(bill_id) as bill_id  FROM  ".DB_PREFIX. "room r  LEFT JOIN " .DB_PREFIX."bill b on r.room_number = b.room_number WHERE r.room_id ='".(int)$room_id."'");
		$data=array();
		foreach($query->rows as $room_data){
			$data[]=array(
				'bill_id'        => $room_data['bill_id'],
			);
		}
		// SELECT value FROM `oc_setting` where code='bill';
		foreach( $data as $value){
			$q= $this->db->query("SELECT * FROM  ".DB_PREFIX. "room r  LEFT JOIN " .DB_PREFIX."bill b on r.room_number = b.room_number WHERE b.bill_id ='".$this->db->escape($value['bill_id'])."'");
			 return $q->row;
		}		
    }
	
	public function deleteroom($room_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "room WHERE room_id = '" . (int)$room_id . "'");
		
	}

	public function deleterooms($room_id) {
		// die($room_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "room WHERE room_id = '" . (int)$room_id . "'");
	
	}

	public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getrooms($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "room   WHERE sort_order = '" . 0 . "'";

		if (!empty($data['filter_room_number'])) {
			$sql .= " AND room_number LIKE '" . $this->db->escape($data['filter_room_number']) . "%'";
		}

		if (!empty($data['filter_first_name'])) {
			$sql .= " AND first_name LIKE '" . $this->db->escape($data['filter_first_name']) . "%'";
		}

		if (!empty($data['filter_last_name'])) {
			$sql .= " AND last_name LIKE '" . $this->db->escape($data['filter_last_name']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$sql .= " AND telephone LIKE '" . $this->db->escape($data['filter_telephone']) . "%'";
		}
		if (!empty($data['filter_address'])) {
			$sql .= " AND address LIKE '" . $this->db->escape($data['filter_address']) . "%'";
		}

		$sql .= " GROUP BY room_id";

		$sort_data = array(
			'room_id',
			'room_number',
			'first_name',
			'last_name',
			'telephone',
			'address',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY room_number";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			// die($sql);
		}
      
		$query = $this->db->query($sql);
		// print_r($query);die;

		return $query->rows;
	}


	public function getProductOptionValue($product_id, $product_option_value_id) {
		$query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");

		return $query->rows;
	}

	public function getProductSpecials($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");

		return $query->rows;
	}

	public function getProductRewards($product_id) {
		$product_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $product_reward_data;
	}

	public function getProductDownloads($product_id) {
		$product_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_download_data[] = $result['download_id'];
		}

		return $product_download_data;
	}

	public function getProductStores($product_id) {
		$product_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}

		return $product_store_data;
	}
	
	public function getProductSeoUrls($product_id) {
		$product_seo_url_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
		}

		return $product_seo_url_data;
	}
	
	public function getProductLayouts($product_id) {
		$product_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $product_layout_data;
	}

	public function getProductRelated($product_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}

		return $product_related_data;
	}

	public function getRecurrings($product_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = '" . (int)$product_id . "'");

		return $query->rows;
	}

	public function getTotalrooms($data = array()) {
		//  die("hii");
		$sql = "SELECT COUNT(DISTINCT room_id) AS total FROM " . DB_PREFIX . "room ";

		$sql .= " WHERE sort_order = '" . 0 . "'";
		//print_r($sql);die;

		if (!empty($data['filter_room_number'])) {
			$sql .= " AND room_number LIKE '" . $this->db->escape($data['filter_room_number']) . "%'";
		}

		if (!empty($data['filter_first_name'])) {
			$sql .= " AND first_name LIKE '" . $this->db->escape($data['filter_first_name']) . "%'";
		}

		if (!empty($data['filter_last_name'])) {
			$sql .= " AND last_name LIKE '" . $this->db->escape($data['filter_last_name']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$sql .= " AND telephone LIKE '" . $this->db->escape($data['filter_telephone']) . "%'";
		}

		if (!empty($data['filter_address'])) {
			$sql .= " AND address LIKE '" . $this->db->escape($data['filter_address']) . "%'";
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalProductsByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByProfileId($recurring_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_recurring WHERE recurring_id = '" . (int)$recurring_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
