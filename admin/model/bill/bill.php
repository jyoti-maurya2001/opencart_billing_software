<?php
class Modelbillbill extends Model {
	public function addbills($data,$room_number) {
		// print_r(($this->db->escape($data['last_reading'])-$this->db->escape($data['start_reading']))*$this->config->get('bill_reading_limit'));die;
		$reading=$this->db->escape($data['last_reading'])-$this->db->escape($data['start_reading']);
		$bills=($this->db->escape($data['last_reading']) - $this->db->escape($data['start_reading']))*$this->config->get('bill_reading_limit');
		// print_r($bills);die;
		//   die("INSERT INTO " . DB_PREFIX . "bill SET room_number = '" .$room_number. "', start_date = '" . $this->db->escape($data['start_date']) . "', last_date = '" . $this->db->escape($data['last_date']) . "', start_reading = '" . $this->db->escape($data['start_reading']) . "', last_reading = '" . $this->db->escape($data['last_reading']) . "', total_reading = '" . $reading . "', total_bill = '" . $bills ."', remark = '" . $this->db->escape($data['remark'])."'");
		$query=$this->db->query("INSERT INTO " . DB_PREFIX . "bill SET room_number = '" .$room_number. "', start_date = '" . $this->db->escape($data['start_date']) . "', last_date = '" . $this->db->escape($data['last_date']) . "', start_reading = '" . $this->db->escape($data['start_reading']) . "', last_reading = '" . $this->db->escape($data['last_reading']) . "', total_reading = '" . $reading . "', total_bill = '" . $bills . "', remark = '" . $this->db->escape($data['remark']) ."'" );
		return $query->row;
	}

	public function editbills($bill_id, $data) {
		// die($this->config->get('bill_reading_limit'));
		//  die("UPDATE " . DB_PREFIX . "bill SET start_date = '" . $this->db->escape($data['start_date']) . "', last_date = '" . $this->db->escape($data['last_date']) . "',start_reading = '" . $this->db->escape($data['start_reading']) . "', last_reading = '" . $this->db->escape($data['last_reading']) . "', total_reading = '" . $this->db->escape($data['total_reading']) . "', total_bill = '" . $this->db->escape($data['total_bill'])   . "' WHERE bill_id = '" . (int)$bill_id . "'");
		// $this->db->query("UPDATE " . DB_PREFIX . "bill SET start_date = '" . $this->db->escape($data['start_date']) . "', last_date = '" . $this->db->escape($data['last_date']) . "',start_reading = '" . $this->db->escape($data['start_reading']) . "', last_reading = '" . $this->db->escape($data['last_reading']) . "', total_reading = '" . $this->db->escape($data['total_reading']) . "', total_bill = '" . $this->db->escape($data['total_bill'])   . "' WHERE bill_id = '" . (int)$bill_id . "'");
		$query=$this->db->query("SELECT  DISTINCT * FROM  ".DB_PREFIX. "bill  WHERE bill_id ='".(int)$bill_id."'");
		$mydata=array();
		foreach($query->rows as $bill_data){
			$mydata[]=array(
				'bill_id'             =>$bill_data['bill_id'],
				'room_number'         =>$bill_data['room_number'],
				'start_reading'       =>$bill_data['start_reading'],
				'last_reading'        =>$this->db->escape($data['last_reading']),
				'total_reading'       =>$this->db->escape($data['last_reading']) - $bill_data['start_reading'],
				'total_bill'          =>($this->db->escape($data['last_reading']) - $bill_data['start_reading'])*$this->config->get('bill_reading_limit'),
				'remark'              =>$this->db->escape($data['remark']),
			);
			$this->updatebill($mydata);
		}
		$this->db->query("UPDATE " . DB_PREFIX . "bill SET last_date = '" . $this->db->escape($data['last_date']) . "', last_reading = '" . $this->db->escape($data['last_reading'])  . "', remark = '" . $this->db->escape($data['remark']) ."'where bill_id='".$bill_id."'" );

	}

	public function updatebill($mydata){
		//   print_r($mydata);die;
		foreach($mydata as $value){
			//  die("UPDATE " . DB_PREFIX . "bill SET total_reading = '" . $this->db->escape($value['total_reading']) . "', total_bill = '" . $this->db->escape($value['total_bill']) ."'where bill_id='". $this->db->escape($value['bill_id'])."'" );
			$q=$this->db->query("UPDATE " . DB_PREFIX . "bill SET total_reading = '" . $this->db->escape($value['total_reading']) . "', total_bill = '" . $this->db->escape($value['total_bill']) ."'where bill_id='". $this->db->escape($value['bill_id'])."'"  );
             return $q;
		}
	}

	public function billid($room_number){
		$query=$this->db->query("SELECT max(bill_id) as billid FROM ".DB_PREFIX. "bill  where room_number = ".$room_number);
		return $query->rows;
	}

	public function billinfo($bill_id){
		  $query =$this->db->query("SELECT * FROM  ".DB_PREFIX. "bill b  LEFT JOIN " .DB_PREFIX."room r on r.room_number = b.room_number WHERE b.bill_id ='".(int)$bill_id."'");
		//   print_R($query);die;
		  return $query->row;
	}

	public function allbills($bill_id){
	  //   die("SELECT  DISTINCT * FROM  ".DB_PREFIX. "bill  WHERE bill_id ='".(int)$bill_id."'");	
		$query=$this->db->query("SELECT  DISTINCT * FROM  ".DB_PREFIX. "bill  WHERE bill_id ='".(int)$bill_id."'");
		// foreach($query->rows as $bill_data){
			// $data[]=array(
				// 'room_number'         => $bill_data['room_number']
			// );
			// print_r($bill_data['room_number']);die;
			//  die("SELECT MAX(start_reading)  as max_last_reading FROM ".DB_PREFIX."bill b LEFT JOIN " .DB_PREFIX."room r on r.room_number=b.room_number WHERE r.room_number='".$bill_data['room_number'] . "'ORDER BY b.bill_id  DESC");
			// $this->db->query("SELECT MAX(start_reading) as max_last_reading FROM ".DB_PREFIX."bill b LEFT JOIN " .DB_PREFIX."room r on r.room_number=b.room_number WHERE r.room_number='".$bill_data['room_number'] . "'ORDER BY b.bill_id  DESC"."'");
		// }
		
		// $query=$this->db->query("SELECT max('start_reading') from " .DB_PREFIX. "bill");

		
		return $query->row;

	}

	public function bill_startreading($bill_id,$room_number){
		
		//  $query=$this->db->query("SELECT  DISTINCT * FROM  ".DB_PREFIX. "bill  WHERE bill_id ='".(int)$bill_id."'");
		//   foreach($query->rows as $bill_data){
			//   $data[]=array(
				//   'room_number'         =>$bill_data['room_number']
			//   );
			  // print_r($bill_data['room_number']);die;
			//   die("SELECT MAX(start_reading)  as max_last_reading ,start_date FROM ".DB_PREFIX."bill b LEFT JOIN " .DB_PREFIX."room r on r.room_number=b.room_number WHERE r.room_number='".$room_number . "'ORDER BY b.bill_id  DESC");
			 $q= $this->db->query("SELECT  MAX(start_reading) as start_reading , MAX(start_date) as start_date FROM ".DB_PREFIX."bill b LEFT JOIN " .DB_PREFIX."room r on r.room_number=b.room_number WHERE r.room_number='".$room_number . "'ORDER BY b.bill_id  DESC");
			//  print_r($q);die;
		    return $q->row;
			// }
  
	  }

	  public function bill_lastreading($bill_id,$room_number){
		    //  die("SELECT MAX(last_reading)  as max_last_reading MAX(last_date) as start_date FROM ".DB_PREFIX."bill b LEFT JOIN " .DB_PREFIX."room r on r.room_number=b.room_number WHERE r.room_number='".$room_number . "'ORDER BY b.bill_id  DESC");

		$q= $this->db->query("SELECT  MAX(last_reading) as start_reading, MAX(last_date) as start_date FROM ".DB_PREFIX."bill b LEFT JOIN " .DB_PREFIX."room r on r.room_number=b.room_number WHERE r.room_number='".$room_number . "'ORDER BY b.bill_id  DESC");
         return $q->row;
	  }

	public function copybills($bill_id) {
		
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "bill WHERE bill_id = '" . (int)$bill_id . "'");
		$data=array();
		foreach($query->rows as $bill_data){
			$data[]=array(

				'room_number'         =>$bill_data['room_number'],
				'start_date'          =>$bill_data['start_date'],
				'last_date'           =>$bill_data['last_date'],
				'start_reading'       =>$bill_data['start_reading'],
				'last_reading'        =>$bill_data['last_reading'],
				'total_reading'       =>$bill_data['total_reading'],
				'total_bill'          =>$bill_data['total_bill']
		
			);
			$this->billdata($data);
		}	
	}

	public function billdata($data){
		// print_r($data);die;
		foreach( $data as $value){
			// die("INSERT  INTO ".DB_PREFIX. "bill SET room_number='". $this->db->escape($value['room_number']) ."',start-date='".$this->db->escape($value['start_date']) ."',last_date='".$this->db->escape($value['last_date']) ."',start_reading ='".$this->db->escape($value['start_reading'])."',last_reading='".$this->db->escape($value['last_reading'])."',total_reading='".$this->db->escape($value['total_reading'])."',total_bill='".$this->db->escape($value['total_bill'])."'");
			$query= $this->db->query("INSERT  INTO ".DB_PREFIX. "bill SET room_number='". $this->db->escape($value['room_number']) ."',start_date='".$this->db->escape($value['start_date']) ."',last_date='".$this->db->escape($value['last_date']) ."',start_reading ='".$this->db->escape($value['start_reading'])."',last_reading='".$this->db->escape($value['last_reading'])."',total_reading='".$this->db->escape($value['total_reading'])."',total_bill='".$this->db->escape($value['total_bill'])."'");
		    return $query;
		}

	}

	public function billgenerate($data,$room_number) {
		//   die('$room_number');
		//  die("SELECT DISTINCT * FROM " . DB_PREFIX . "bill WHERE bill_id = " . "(SELECT max(bill_id) FROM ".DB_PREFIX."bill where room_number=$room_number)" );

		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "bill WHERE bill_id = " . "(SELECT max(bill_id) FROM ".DB_PREFIX."bill where room_number=$room_number)" );
		$mydata=array();
		foreach($query->rows as $bill_data){
			//  die($this->db->escape($data['last_date']));
			$mydata[]=array(

				'room_number'         =>$bill_data['room_number'],
				'start_date'          =>$bill_data['last_date'],
				'last_date'           =>$this->db->escape($data['last_date']),
				'start_reading'       =>$bill_data['last_reading'],
				'last_reading'        =>$this->db->escape($data['last_reading']),
				'total_reading'       =>$this->db->escape($data['last_reading']) - $bill_data['last_reading'],
				'total_bill'          =>($this->db->escape($data['last_reading']) - $bill_data['last_reading']) *$this->config->get('bill_reading_limit'),
				'remark'             =>$this->db->escape($data['remark']),
		
			);
			$this->billgenerating($mydata);
		}	
	}

	public function billgenerating($data){
		// print_r($data);die;
		 	foreach($data as $value){
				// die("INSERT INTO ".DB_PREFIX."bill SET room_number='".$this->db->escape($value['room_number'])."',start_date= '".$this->db->escape($value['start_date'])."',last_date= '".$this->db->escape($value['last_date'])."',start_reading= '".$this->db->escape($value['start_reading'])."',last_reading= '".$this->db->escape($value['last_reading'])."',total_reading= '".$this->db->escape($value['total_reading'])."',total_bill= '".$this->db->escape($value['total_bill']) ."'");
			   $q=$this->db->query("INSERT INTO ".DB_PREFIX."bill SET room_number='".$this->db->escape($value['room_number'])."',start_date= '".$this->db->escape($value['start_date'])."',last_date= '".$this->db->escape($value['last_date'])."',start_reading= '".$this->db->escape($value['start_reading'])."',last_reading= '".$this->db->escape($value['last_reading'])."',total_reading= '".$this->db->escape($value['total_reading']) ."',total_bill= '" .$this->db->escape($value['total_bill']) ."',remark= '".$this->db->escape($value['remark']) ."'");
		       return $q;
		}

	}


	public function deletebill($bill_id) {
		// die("DELETE FROM " . DB_PREFIX . "bill WHERE bill_id = '" . (int)$bill_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "bill WHERE bill_id = '" . (int)$bill_id . "'");
		
	}

	public function deletebills($bill_id) {
		// die("DELETE FROM " . DB_PREFIX . "bill WHERE bill_id = '" . (int)$bill_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "bill WHERE bill_id = '" . (int)$bill_id . "'");
		
	}

	public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function billtable($room_no) {
		 $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "bill b  LEFT JOIN " . DB_PREFIX . "room r ON (b.room_number = r.room_number) WHERE r.room_number = '" . (int)$room_no . "'");
    //    die("SELECT DISTINCT * FROM " . DB_PREFIX . "bill b  LEFT JOIN " . DB_PREFIX . "room r ON (b.room_number = r.room_number) WHERE r.room_number = '" . (int)$room_no . "'");
		return $query->row;
	}


	public function getbills($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "bill  WHERE room_number = " . $this->db->escape($data['get_room_number']) ;
		//  die($sql);

		if (!empty($data['filter_start_date'])) {
			$sql .= " AND start_date LIKE '" . $this->db->escape($data['filter_start_date']) . "%'";
		}

		if (!empty($data['filter_last_date'])) {
			$sql .= " AND last_date LIKE '" . $this->db->escape($data['filter_last_date']) . "%'";
		}

		if (!empty($data['filter_start_reading'])) {
			$sql .= " AND start_reading LIKE '" . $this->db->escape($data['filter_start_reading']) . "%'";
		}

		if (!empty($data['filter_last_reading'])) {
			$sql .= " AND last_reading LIKE '" .$this->db->escape($data['filter_last_reading']) . "%'";
		}

		if (!empty($data['filter_total_reading'])) {
			$sql .= " AND total_reading LIKE '" . $this->db->escape($data['filter_total_reading']) . "%'";
		}

		if (!empty($data['filter_total_bill'])) {
			$sql .= " AND total_bill LIKE '" . $this->db->escape($data['filter_total_bill']) . "%'";
		}

		$sql .= " GROUP BY bill_id";

		$sort_data = array(
			'bill_id',
			'start_date',
			'last_date',
			'start_reading',
			'last_reading',
			'total_reading',
			'total_bill',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY bill_id";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
	    // print_r($query);die;

		return $query->rows;
	}

	public function getbillslist($room_number,$data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "bill  WHERE room_number = " .$room_number;
		//  die($sql);

		if (!empty($data['filter_start_date'])) {
			$sql .= " AND start_date LIKE '" . $this->db->escape($data['filter_start_date']) . "%'";
		}

		if (!empty($data['filter_last_date'])) {
			$sql .= " AND last_date LIKE '" . $this->db->escape($data['filter_last_date']) . "%'";
		}

		if (!empty($data['filter_start_reading'])) {
			$sql .= " AND start_reading LIKE '" . $this->db->escape($data['filter_start_reading']) . "%'";
		}

		if (!empty($data['filter_last_reading'])) {
			$sql .= " AND last_reading LIKE '" .$this->db->escape($data['filter_last_reading']) . "%'";
		}

		if (!empty($data['filter_total_reading'])) {
			$sql .= " AND total_reading LIKE '" . $this->db->escape($data['filter_total_reading']) . "%'";
		}

		if (!empty($data['filter_total_bill'])) {
			$sql .= " AND total_bill LIKE '" . $this->db->escape($data['filter_total_bill']) . "%'";
		}

		$sql .= " GROUP BY bill_id";

		$sort_data = array(
			'bill_id',
			'start_date',
			'last_date',
			'start_reading',
			'last_reading',
			'total_reading',
			'total_bill',
			'remark',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY bill_id";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			//   print_r($sql);die;
		}

		$query = $this->db->query($sql);
		//   print_r($query);die;

		return $query->rows;
	}

	public function getProductsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	public function getProductDescriptions($product_id) {
		$product_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $product_description_data;
	}

	public function getProductCategories($product_id) {
		$product_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_category_data[] = $result['category_id'];
		}

		return $product_category_data;
	}

	public function getProductFilters($product_id) {
		$product_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_filter_data[] = $result['filter_id'];
		}

		return $product_filter_data;
	}
	

	public function getTotalbills($data = array()) {
		// die("pp");
	    // print_r($data);die;
		$sql = "SELECT COUNT(DISTINCT bill_id) AS total FROM " . DB_PREFIX . "bill";

		$sql .= " WHERE room_number = '" .$this->db->escape($data['get_room_number']). "'";
		//  die($sql);

		if (!empty($data['filter_start_date'])) {
			$sql .= " AND start_date LIKE '" . $this->db->escape($data['filter_start_date']) . "%'";
		}

		if (!empty($data['filter_last_date'])) {
			$sql .= " AND last_date LIKE '" . $this->db->escape($data['filter_last_date']) . "%'";
		}

		if (isset($data['filter_start_reading']) && !is_null($data['filter_start_reading'])) {
			$sql .= " AND start_reading LIKE '" . $this->db->escape($data['filter_start_reading']) . "%'";
		}
		
		if (isset($data['filter_last_reading']) && !is_null($data['filter_last_reading'])) {
			$sql .= " AND last_reading LIKE '" . $this->db->escape($data['filter_last_reading']) . "%'";
		}
		
		if (isset($data['filter_total_reading']) && !is_null($data['filter_total_reading'])) {
			$sql .= " AND total_reading LIKE '" . $this->db->escape($data['filter_total_reading']) . "%'";
		}
		
		if (isset($data['filter_total_bill']) && !is_null($data['filter_total_bill'])) {
			$sql .= " AND total_bill LIKE '" . $this->db->escape($data['filter_total_bill']) . "%'";
		}
	    // print_r($sql);die;

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalbillslist($room_number,$data = array()) {
		$sql = "SELECT COUNT(DISTINCT bill_id) AS total FROM " . DB_PREFIX . "bill";

		$sql .= " WHERE room_number = '" .$room_number. "'";
    //    print_r($sql);die;
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND start_date LIKE '" . $this->db->escape($data['filter_start_date']) . "%'";
		}

		if (!empty($data['filter_last_date'])) {
			$sql .= " AND last_date LIKE '" . $this->db->escape($data['filter_last_date']) . "%'";
		}

		if (isset($data['filter_start_reading']) && !is_null($data['filter_start_reading'])) {
			$sql .= " AND start_reading LIKE '" . $this->db->escape($data['filter_start_reading']) . "%'";
		}
		
		if (isset($data['filter_last_reading']) && !is_null($data['filter_last_reading'])) {
			$sql .= " AND last_reading LIKE '" . $this->db->escape($data['filter_last_reading']) . "%'";
		}
		
		if (isset($data['filter_total_reading']) && !is_null($data['filter_total_reading'])) {
			$sql .= " AND total_reading LIKE '" . $this->db->escape($data['filter_total_reading']) . "%'";
		}
		
		if (isset($data['filter_total_bill']) && !is_null($data['filter_total_bill'])) {
			$sql .= " AND total_bill LIKE '" . $this->db->escape($data['filter_total_bill']) . "%'";
		}
		// print_r($sql);die;

		$query = $this->db->query($sql);

		return $query->row['total'];
	}	
	
}
