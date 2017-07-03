<?php 
class Admin_model extends CI_Model{
		
	/**
	 * @return void
	 **/
	
	
	public function __construct(){
		parent::__construct();
		
	}
	
	public function get_report($data){		
		$type = isset($data['type']) ? $data['type'] : '';
		
		if($type == 'DASHBOARD'){
			$retvalue['users_count'] = $this->db->query("SELECT COUNT(*) AS ucount FROM tbl_user WHERE created_date > (NOW() - interval 1 month)")->row()->ucount;
			$retvalue['products_count'] = $this->db->query("SELECT COUNT(*) AS pcount FROM tbl_product WHERE created_date > (NOW() - interval 1 month)")->row()->pcount;
			$retvalue['api_count'] = $this->db->query("SELECT COUNT(*) AS acount FROM tbl_api WHERE createdDate > (NOW() - interval 1 month)")->row()->acount;
			$retvalue['views_count'] = 523;
			return (object)$retvalue;
		}
	}
	public function get_user($data){		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? $data['id'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
		$user_name = isset($data['user_name']) ? $data['user_name'] : '';
		$authID = isset($data['authID']) ? $data['authID'] : '';
		$username = isset($data['username']) ? $data['username'] : '';
		
		if($type == 'EMAIL_CHECK'){
			return $this->db->query("SELECT * FROM tbl_user WHERE email = '$email'")->row();
		}
		if($type == 'USERNAME_CHECK'){
			return $this->db->query("SELECT * FROM tbl_user WHERE username = '$username'")->row();
		}
		if($type == 'CHECK_AUTH'){
			return $this->db->query("SELECT * FROM tbl_user WHERE authID = '$authID' AND modifiedDate > (NOW() - interval 24 hour)")->row();
		}
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_user WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_user ORDER BY id DESC")->result();
		}
		if($type == 'DL'){
			return $this->db->query("SELECT * FROM tbl_user WHERE role='USER' ORDER BY id DESC LIMIT 5")->result();
		}
	}
	
	function reset_password(){
		$userID = $this->session->userdata("userID");
		$password = $this->input->post('password');
		$this->db->query("UPDATE tbl_user SET password = '$password' WHERE id = '$userID'" ); 
		return true;
	}
	public function login($userName,$password){
		$retvalue = array();
		$row = $this->db->query("SELECT * FROM tbl_user WHERE (email = '$userName' OR username = '$userName') AND password = '$password'")->row();
		if($row){
			$this->session->set_userdata('login',true);
			$this->session->set_userdata('userID',$row->id);
			$this->session->set_userdata('name',$row->firstName.' '.$row->lastName);
			$this->session->set_userdata('email',$row->email);
			$this->session->set_userdata('phone',$row->phone);
			$this->session->set_userdata('roleName',$row->role);
			if($row->role == 'ADMIN')
				$retvalue['url'] = base_url('admin');
			else if($this->session->userdata('previous_url'))
				$retvalue['url'] = $this->session->userdata('previous_url');
			else
				$retvalue['url'] = base_url();
			
			$retvalue['message'] = 'Logged in successfully';
			$retvalue['status'] = true;
		}else{
			$retvalue['message'] = 'Invalid Username or Password';
			$retvalue['status'] = false;
		}
		return $retvalue;
	}
	
	public function getDashboard($data){		
		$type="";$roleID="";$userID="";
		if(isset($data['type']))$type=$data['type'];
		
		if($type == 'REQUEST'){
			$data['total'] = $this->db->query("SELECT COUNT(*) as total FROM tbl_messages")->row()->total;
			$data['open'] = $this->db->query("SELECT COUNT(*) as open FROM tbl_messages WHERE status = 'Open'")->row()->open;
			$data['close'] = $this->db->query("SELECT COUNT(*) as close FROM tbl_messages WHERE status = 'Closed'")->row()->close;
			return $data;
		}
		if($type == 'BLOG'){
			$data['posts'] = $this->db->query("SELECT COUNT(*) as total FROM tbl_industries")->row()->total;
			$data['comments'] = $this->db->query("SELECT COUNT(*) as total FROM tbl_comments")->row()->total;
			return $data;
		}
		if($type == 'SUBSCRIBE'){
			$data['total'] = $this->db->query("SELECT COUNT(*) as total FROM tbl_subscriptions")->row()->total;
			return $data;
		}
	}
	
	function ins_upd_user(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$gender=$this->input->post('gender');
		$address=$this->input->post('address');
		$country=$this->input->post('country');
		$city=$this->input->post('city');
		$password=$this->input->post('password');
		$password = password_hash($password, PASSWORD_DEFAULT);		
		$username=$this->input->post('username');
		$auth_id=$this->input->post('auth_id');
		$role=$this->input->post('role') ? $this->input->post('role') : 'USER';
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		if($type == "INSERT"){
			$user = $this->db->query("SELECT * FROM tbl_user WHERE email='$email'")->row();
			if(!$user){
				$this->db->query("INSERT INTO tbl_user (first_name, last_name, email, password, auth_id, role, phone, gender, city, country, address, created_date, modified_date, status) VALUES ('$first_name', '$last_name', '$email', '$password', '$auth_id', '$role', '$phone', '$gender', '$city', '$country', '$address', NOW(), NOW(), '$status'); ");
				
				$id = $this->db->query("SELECT MAX(id) as id FROM tbl_user")->row()->id;
				$retvalue['status']= true;
				$retvalue['message']= 'User created successfully';
			}else{
				$retvalue['status']= false;
				$retvalue['message']= 'Email already exist';
			}
		}
		
		if($type == "UPDATE"){
			
			$user = $this->db->query("SELECT * FROM tbl_user WHERE email='$email' AND id != $id")->row();
			if(!$user){
				$this->db->query("UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name', email = '$email',  role = '$role', phone = '$phone', gender = '$gender', city = '$city', country = '$country', address = '$address', modified_date = NOW(), status = '$status' WHERE id = $id ");
				$retvalue['status']= true;
				$retvalue['message']= 'User updated successfully';
			}else{
				$retvalue['status']= false;
				$retvalue['message']= 'Email already exist';
			}
			
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_user WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'User deleted successfully';
		}
		return $retvalue;
				
		return $retvalue;
	}
	
	function register(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$fname=$this->input->post('fname');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$company=$this->input->post('company');
		$country=$this->input->post('country');
		$newsletter=(int)$this->input->post('newsletter');
		$password=$this->input->post('password');
		$username=$this->input->post('username');
		$status=$this->input->post('status');
		$image = base_url($this->config->item('default_image'));
		$qry = $this->db->query("SELECT * FROM tbl_user WHERE email = '$email'")->row();		
		if(!$qry){
			$this->db->query("INSERT INTO tbl_user (firstName,lastName, email, password, username, phone, image, role, company, country,  newsletter, createdDate, status) VALUES ('$fname', '$lname', '$email', '$password', '$username','$phone', '$image', 'USER', '$company', '$country', '$newsletter', NOW(), 'Active')");
			$this->login($email,$password);
			
			$data['name'] = $fname.' '.$lname;
			$message = $this->load->view('email/register',$data,true);
			//$this->send_email($email,'Welcome to'.$this->config->item('project_title'),$message);
			
			$retvalue['status']= true;
			$retvalue['message']= 'Registered successfully';
		}else{
			$retvalue['status']= false;
			$retvalue['message']= 'Email already exist';
		}
				
		return $retvalue;
	}
	
	function ins_upd_product(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int) $this->input->post('id');
		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$slug=$this->input->post('slug');
		$price=(float)$this->input->post('price');
		$product_link=$this->input->post('product_link');
		$min_age=(int)$this->input->post('min_age');
		$max_age=(int)$this->input->post('max_age');
		$gender=$this->input->post('gender');
		$category=$this->input->post('category');
		$apiID=(int)$this->input->post('apiID');
		$source=$this->input->post('source') ? $this->input->post('source') : 'Manual';
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		$userID = (int)$this->session->userdata("userID");
		
		if(isset($_FILES['image']['name'])){
			if($_FILES['image']['name'] != ''){		
				$iu=$this->admin_model->image_upload($_FILES['image'],'assets/images/products/','product');
				if($iu['status'] == true)
					$image = $iu['path'];
				else
					return $iu;
			}else{
				$image = $this->input->post('uploaded_img');
			}
		}
		if(!@file_get_contents($image))
			$image = base_url($this->config->item('default_image'));
		
		
		if($type == 'INSERT'){
			$this->db->query("INSERT INTO tbl_product (name, description, slug, price, image, product_link, min_age, max_age, gender, category, apiID, source, created_by, modified_by, created_date,modified_date,status) VALUES ('$name', '$description', '$slug', '$price', '$image', '$product_link', '$min_age', '$max_age', '$gender', '$category', $apiID, '$source', $userID, $userID, NOW(), NOW(),'$status')");
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_product")->row()->id;
			
			if($this->input->post('navigation')){
				$navigation = (array)$this->input->post('navigation');
				$this->db->query("DELETE FROM tbl_navigation_products WHERE product_id = $id");
				foreach($navigation as $n){
					$this->db->query("INSERT INTO tbl_navigation_products(navigation_id,product_id) VALUES($n,$id)");
				}
			}
			
			$retvalue['status']= true;
			$retvalue['message']= 'Product saved successfully';
		}
		
		if($type == 'UPDATE'){			
			$this->db->query("UPDATE tbl_product SET name = '$name', description = '$description', slug = '$slug', price = '$price', image = '$image', product_link = '$product_link', min_age = '$min_age', max_age = '$max_age', gender = '$gender', category = '$category', modified_by=$userID, modified_date = NOW(), status = '$status' WHERE id = $id ");
			
			if($this->input->post('navigation')){
				$navigation = (array)$this->input->post('navigation');
				$this->db->query("DELETE FROM tbl_navigation_products WHERE product_id = $id");
				foreach($navigation as $n){
					$this->db->query("INSERT INTO tbl_navigation_products(navigation_id,product_id) VALUES($n,$id)");
				}
			}
			
			$retvalue['status']= true;
			$retvalue['message']= 'Product updated successfully';
		}
		
		if($type == 'DELETE'){			
			$this->db->query("DELETE FROM tbl_product WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Product deleted successfully';
		}
		
		
		if($type == 'INSERT_API_PRODUCTS'){
			
			$products = json_decode($this->input->post('products'));
			foreach($products as $p){
				$product = json_decode($p[4]);
				$name = str_replace("'","\\'",str_replace("\\","\\\\",($product->name)));
				$id = $product->id;
				$price = $product->price;
				$image = $product->image;
				$product_link = $product->url;
				$min_age = $p[2];
				$max_age = $p[3];
				$category = $p[0];
				$navigation = (array)$p[1];
				
				$product = $this->db->query("SELECT * FROM tbl_product WHERE id = $id")->row();
				if($product){
					$this->db->query("UPDATE tbl_product SET name = '$name', price = '$price', image = '$image', product_link = '$product_link', min_age = '$min_age', max_age = '$max_age', category = '$category', apiID = '$apiID',modified_by = $userID, modified_date = NOW(), status = 'Active' WHERE id = $id ");
				}else{
					$this->db->query("INSERT INTO tbl_product (id,name, price, image, product_link, min_age, max_age, category, apiID, source, created_by, modified_by, created_date,modified_date,status) VALUES ($id,'$name', '$price', '$image', '$product_link', '$min_age', '$max_age', '$category', '$apiID', '$source', $userID, $userID, NOW(), NOW(),'Active'); ");
				}
				$this->db->query("DELETE FROM tbl_navigation_products WHERE product_id = $id");
				foreach($navigation as $n){
					$this->db->query("INSERT INTO tbl_navigation_products(navigation_id,product_id) VALUES($n,$id)");
				}
				
			}
			$retvalue['status']= true;
			$retvalue['message']= 'Product saved successfully';
		}
		
		
		return $retvalue;
	}
	
	function image_upload($file,$uploaddir='assets/images/products/',$id=""){
		$retvalue = array();
		$retvalue['status'] = false;
		$retvalue['path'] = base_url($this->config->item("placeholder.png"));
		$retvalue['message'] = 'Please try again later';
		
		$ext = end(explode(".", $file["name"]));
		$img_ext = $this->config->item("img_ext");
		if(!in_array($ext,$img_ext)){
			$retvalue['message'] = 'Invalid image file.Please upload file with these(jpg,png) extensions';
			return $retvalue;
		}
			
		$path=$uploaddir.$id.date('ymdHis').'.'.$ext;
		if(file_exists($path))
			unlink($path);
		if(move_uploaded_file($file["tmp_name"],$path)){
			$retvalue['status'] = true;
			$retvalue['path'] = base_url($path);
		}
		return $retvalue;
	}
	
	public function get_product($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		$category_id = isset($data['category_id']) ? (int)$data['category_id'] : 0;
		$key = isset($data['key']) ? $data['key'] : '';
		$category = isset($data['category']) ? $data['category'] : '';
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_product WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT *,(select name from tbl_api where id =p.apiID) as apiName FROM tbl_product p ORDER BY id DESC")->result();
		}
		if($type == 'NS'){
			return $this->db->query("SELECT * FROM tbl_navigation_products WHERE product_id = $id")->result();
		}
		
	}
	
	function ins_upd_category(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$name=$this->input->post('name');
		$sorting=(int)$this->input->post('sorting');
		$description=$this->input->post('description');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		$count = (int)$this->input->post('count');
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_category (name, description, sorting, createdDate, updatedDate, status) VALUES ( '$name', '$description', $sorting, NOW(), NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_category")->row()->id;
			/* for($i=0;$i<$count;$i++){
				$api_id = $this->input->post('api_'.$i);
				$api_category_id = (array)$this->input->post('category_'.$i);
				foreach($api_category_id as $acID){
				$this->db->query("INSERT INTO tbl_category_api (category_id, api_id, api_category_id) VALUES ($id, $api_id, '$acID')");
				}
			} */
			
			$retvalue['status']= true;
			$retvalue['message']= 'Category created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_category SET name = '$name', description = '$description', sorting = $sorting, status = '$status', updatedDate = NOW() WHERE id = $id");
			/* $this->db->query("DELETE FROM tbl_category_api WHERE category_id = $id");
			for($i=0;$i<$count;$i++){
				$api_id = $this->input->post('api_'.$i);
				$api_category_id = (array)$this->input->post('category_'.$i);
				foreach($api_category_id as $acID){
				$this->db->query("INSERT INTO tbl_category_api (category_id, api_id, api_category_id) VALUES ($id, $api_id, '$acID')");
				}
			} */
			
			$retvalue['status']= true;
			$retvalue['message']= 'Category updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_category WHERE id = $id");
			//$this->db->query("DELETE FROM tbl_category_api WHERE category_id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Category deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_category($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? $data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_category WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_category")->result();
		}
		if($type == 'AL'){
			
			$categories = array();
			
			$api = $this->db->query("SELECT * FROM tbl_api")->result();
			foreach($api as $a){
				
				$url = $a->categoryUrl;
								
				/* $cSession = curl_init(); 
				
				curl_setopt($cSession,CURLOPT_URL,$url);
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($cSession,CURLOPT_HEADER, false); 
				
				$result=curl_exec($cSession);
				
				curl_close($cSession);
				
				$result = json_encode($result);
				if(!$result) */
				$result = file_get_contents($url);
				$result = json_decode($result);
				$category = array();
				$category['api_id'] = $a->id;
				$category['api'] = $a->name;
				$category['categories']['api_categoryies'] = $result->categories;
				$qry = $this->db->query("SELECT * FROM tbl_category_api WHERE api_id = ".$a->id." AND category_id = $id")->result(); 
				$sc=array();
				foreach($qry as $q){
					$sc[] = $q->api_category_id;
				}
				$category['categories']['selected_categories'] = $sc;
				$categories[] = $category;
			}
			//var_dump($sc);exit();
			return $categories;
		}
		
	}
	function ins_upd_api(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$name=(string)$this->input->post('name');
		$apiKey=(string)$this->input->post('key');
		$productUrl=(string)$this->input->post('productUrl');
		$categoryUrl=(string)$this->input->post('categoryUrl');
		$testUrl=(string)$this->input->post('testURL');
		$rootPath=(string)$this->input->post('rootPath');
		$id_depth=(string)$this->input->post('id_depth');
		$name_depth=(string)$this->input->post('name_depth');
		$image_depth=(string)$this->input->post('image_depth');
		$url_depth=(string)$this->input->post('url_depth');
		$price_depth=(string)$this->input->post('price_depth');
		$desc=$this->input->post('desc');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		$count = (int)$this->input->post('count');
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_api (name, apiKey, categoryUrl, productUrl, testUrl, rootPath, id_depth, name_depth, image_depth, url_depth, price_depth, createdDate, status) VALUES ('$name', '$apiKey', '$categoryUrl', '$productUrl', '$testUrl', '$rootPath', '$id_depth', '$name_depth', '$image_depth', '$url_depth', '$price_depth', NOW(), '$status'); ");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_api")->row()->id;
			for($i=0;$i<$count;$i++){
				$name = $this->input->post('name_'.$i);
				$url = $this->input->post('url_'.$i);
				$this->db->query("INSERT INTO tbl_api_url (apiID, name, apiUrl) VALUES ($id, '$name', '$url')");
			}
			$retvalue['status']= true;
			$retvalue['message']= 'Api created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_api SET name = '$name', apiKey = '$apiKey', categoryUrl = '$categoryUrl', productUrl = '$productUrl', testUrl = '$testUrl', rootPath = '$rootPath', id_depth = '$id_depth', name_depth = '$name_depth', image_depth = '$image_depth', url_depth = '$url_depth', price_depth = '$price_depth', status = '$status' WHERE id = $id ");
			$this->db->query("DELETE FROM tbl_api_url WHERE apiID = $id");
			for($i=0;$i<$count;$i++){
				$name = $this->input->post('name_'.$i);
				$url = $this->input->post('url_'.$i);
				$this->db->query("INSERT INTO tbl_api_url (apiID, name, apiUrl) VALUES ($id, '$name', '$url')");
			}
			
			$retvalue['status']= true;
			$retvalue['message']= 'Api updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_api WHERE id = $id");
			$this->db->query("DELETE FROM tbl_api_url WHERE apiID = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Api deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_api($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_api WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_api ORDER BY id DESC")->result();
		}
		if($type == 'URL_S'){
			return $this->db->query("SELECT * FROM tbl_api_url WHERE apiID = $id")->result();
		}		
	}
	
	function get_product_from_api(){
		$products = array();
		$api = $this->input->post('api');
		$url = $this->input->post('url');
		$result = file_get_contents($url);
		$result = json_decode($result);
		if(isset($result->products)){
			if(count($result->products) > 0){
				foreach($result->products as $p){
					$product = array();
					$product['id'] = $p->sku;
					$product['name'] = $p->name;
					$product['price'] = $p->salePrice;
					if(@file_get_contents($p->image))
						$product['image'] = $p->image;
					else
						$product['image'] = base_url($this->config->item('default_image')); 
					$product['url'] = $p->url;
					$products[] = (object)$product;
				}
				
			}
		}
		//var_dump($products);exit();
		return $products;
	}
	
	function ins_upd_slide(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$title=(string)$this->input->post('title');
		$slideType=(string)$this->input->post('slideType');
		$slideUrl=(string)$this->input->post('slideUrl');
		$description=(string)$this->input->post('description');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		if($_FILES['image']['name'] != ''){		
			$iu=$this->admin_model->image_upload($_FILES['image'],'assets/images/slides/','slide');
			if($iu['status'] == true)
				$image = $iu['path'];
			else
				return $iu;
		}else{
			$image = $this->input->post('uploaded_img');
		}
		if(getimagesize($image) === false)
			$image = base_url($this->config->item('default_image'));
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_slide (image, title, description,slideType, slideUrl, created_date, updated_date, status) VALUES ('$image', '$title', '$description', '$slideType', '$slideUrl', NOW(), NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_slide")->row()->id;
			$retvalue['status']= true;
			$retvalue['message']= 'Slide created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_slide SET title = '$title', description = '$description', slideType = '$slideType', slideUrl = '$slideUrl', image = '$image', updated_date = NOW(), status = '$status' WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Slide updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_slide WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Slide deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_slide($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_slide WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_slide ORDER BY id DESC")->result();
		}	
	}
	function ins_upd_post(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$title=(string)$this->input->post('title');
		$url=(string)$this->input->post('postUrl');
		$description=(string)$this->input->post('description');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		if($_FILES['image']['name'] != ''){		
			$iu=$this->admin_model->image_upload($_FILES['image'],'assets/images/posts/','post');
			if($iu['status'] == true)
				$image = $iu['path'];
			else
				return $iu;
		}else{
			$image = $this->input->post('uploaded_img');
		}
		if(@file_get_contents($image) === false)
			$image = base_url($this->config->item('default_image'));
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_post (image, title, description,url, created_date, updated_date, status) VALUES ('$image', '$title', '$description', '$url', NOW(), NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_post")->row()->id;
			$retvalue['status']= true;
			$retvalue['message']= 'Post created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_post SET title = '$title', description = '$description', url = '$url', image = '$image', updated_date = NOW(), status = '$status' WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Post updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_post WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Post deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_post($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_post WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_post ORDER BY id DESC")->result();
		}	
	}
	function ins_upd_review(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$name=(string)$this->input->post('name');
		$review=(string)$this->input->post('review');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		if(isset($_FILES['image']['name'])){		
			$iu=$this->admin_model->image_upload($_FILES['image'],'assets/images/reviews/','review');
			if($iu['status'] == true)
				$image = $iu['path'];
			else
				return $iu;
		}else{
			$image = $this->input->post('uploaded_img');
		}
		if(@file_get_contents($image) === false)
			$image = base_url($this->config->item('default_user_image'));
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_review (image, name, review, created_date, updated_date, status) VALUES ('$image', '$name', '$review', NOW(), NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_review")->row()->id;
			$retvalue['status']= true;
			$retvalue['message']= 'Review created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_review SET name = '$name', review = '$review', image = '$image', updated_date = NOW(), status = '$status' WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Review updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_review WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Review deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_review($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_review WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_review ORDER BY id DESC")->result();
		}	
	}
	function ins_upd_section(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$name=(string)$this->input->post('name');
		$order=(int)$this->input->post('order');
		$description=(string)$this->input->post('description');
		$products=(array)$this->input->post('products');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_section (name, sortingOrder, description, createdDate, status) VALUES ('$name', '$order', '$description', NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_section")->row()->id;
			$this->db->query("DELETE FROM tbl_section_products WHERE section_id = $id");
			foreach($products as $p){
				$this->db->query("INSERT INTO tbl_section_products (section_id, product_id) VALUES ($id, $p)");
			}
			$retvalue['status']= true;
			$retvalue['message']= 'Section created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_section SET name = '$name', sortingOrder = '$order', description = '$description', status = '$status' WHERE id = $id");
			$this->db->query("DELETE FROM tbl_section_products WHERE section_id=$id");
			foreach($products as $p){
				$this->db->query("INSERT INTO tbl_section_products (section_id, product_id) VALUES ($id, $p)");
			}
			$retvalue['status']= true;
			$retvalue['message']= 'Section updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_section WHERE id = $id");
			$this->db->query("DELETE FROM tbl_section_products WHERE section_id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Section deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_section($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_section WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_section ORDER BY id DESC")->result();
		}
		if($type == 'PRODUCTS'){
			return $this->db->query("SELECT * FROM tbl_section_products WHERE section_id = $id")->result();
		}	
	}
	
	function ins_upd_navigation(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$name=(string)$this->input->post('name');
		$slug=(string)$this->input->post('slug');
		$description=(string)$this->input->post('description');
		$parent_id=(int)$this->input->post('parent_id');
		$sortin_order=(int)$this->input->post('sortin_order');
		$page_id=(int)$this->input->post('page_id');
		$navigation_type=$this->input->post('navigation_type');
		$navigation_link=$this->input->post('navigation_link');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_navigation (name, slug, parent_id, navigation_type, navigation_link, sortin_order, page_id, created_date, modified_date, status) VALUES ('$name', '$slug', '$parent_id', '$navigation_type', '$navigation_link', $sortin_order, $page_id, NOW(), NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_navigation")->row()->id;
			$retvalue['status']= true;
			$retvalue['message']= 'Navigation created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_navigation SET name = '$name', slug = '$slug', parent_id = '$parent_id', navigation_type = '$navigation_type', navigation_link = '$navigation_link', sortin_order = '$sortin_order', page_id = '$page_id', modified_date = NOW(), status = '$status' WHERE id = $id ");
			$retvalue['status']= true;
			$retvalue['message']= 'Navigation updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_navigation WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Navigation deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_navigation($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_navigation WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_navigation ORDER BY id DESC")->result();
		}
		if($type == 'NL'){
			return $this->db->query("SELECT * FROM tbl_navigation WHERE navigation_type = 'product' ORDER BY id DESC")->result();
		}
		if($type == 'P'){
			return $this->db->query("SELECT * FROM tbl_navigation WHERE parent_id = 0")->result();
		}
		if($type == 'SL'){
			return $this->db->query("SELECT * FROM tbl_navigation WHERE parent_id = $id")->result();
		}	
	}
	function ins_upd_filter(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$name=(string)$this->input->post('name');
		$key=(string)$this->input->post('key');
		$min_value=(int)$this->input->post('min_value');
		$max_value=(int)$this->input->post('max_value');
		$description=(string)$this->input->post('description');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		$count = $this->input->post("count");
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_filter (name,filterKey,min_value,max_value, created_date, modified_date, status) VALUES ('$name','$key','$min_value','$max_value', NOW(), NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_filter")->row()->id;
			/* for($i=1;$i<=$count;$i++){
				$name = $this->input->post('name_'.$i);
				$this->db->query("INSERT INTO tbl_filter_keys (filter_id, name, status) VALUES ($id, '$name', '$status')");
			} */
			$retvalue['status']= true;
			$retvalue['message']= 'Filter created successfully';
		}
		
		if($type == "UPDATE"){
			
			$this->db->query("UPDATE tbl_filter SET name = '$name', filterKey = '$key',min_value = '$min_value',max_value = '$max_value', modified_date = NOW(), status = '$status' WHERE id = $id ");
			
			/* $this->db->query("UPDATE tbl_filter_keys SET status = 'Delete' WHERE filter_id = $id");
			for($i=1;$i<=$count;$i++){
				$name = $this->input->post('name_'.$i);
				$keyID = (int)$this->input->post('key_id_'.$i);
				$key = $this->db->query("SELECT * FROM tbl_filter_keys WHERE id = $keyID")->row();
				if(!$key)
					$this->db->query("INSERT INTO tbl_filter_keys (filter_id, name) VALUES ($id, '$name')");
				else
					$this->db->query("UPDATE tbl_filter_keys SET status = 'Active' WHERE filter_id = $id");
			}
			$this->db->query("DELETE FROM tbl_filter_keys WHERE status = 'Delete' AND filter_id = $id"); */
			
			$retvalue['status']= true;
			$retvalue['message']= 'Filter updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_filter WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Filter deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_filter($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_filter WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_filter ORDER BY id DESC")->result();
		}
		if($type == 'P'){
			return $this->db->query("SELECT * FROM tbl_filter WHERE parent_id = 0")->result();
		}
		if($type == 'FK'){
			return $this->db->query("SELECT * FROM tbl_filter_keys WHERE filter_id = '$id'")->result();
		}	
	}
	function ins_upd_page(){
		$retvalue['status']= false;$retvalue['message']= 'Please try again later';
		
		$type=$this->input->post('type');
		$id=(int)$this->input->post('id');
		$name=(string)$this->input->post('name');
		$slug=(string)$this->input->post('slug');
		$content=(string)$this->input->post('content');
		$status=$this->input->post('status') ? $this->input->post('status') : 'Active';
		
		if($type == "INSERT"){
			$this->db->query("INSERT INTO tbl_page (name, slug, content, created_date, modified_date, status) VALUES ('$name', '$slug', '$content', NOW(), NOW(), '$status')");
			
			$id = $this->db->query("SELECT MAX(id) as id FROM tbl_page")->row()->id;
			$retvalue['status']= true;
			$retvalue['message']= 'Page created successfully';
		}
		
		if($type == "UPDATE"){
			$this->db->query("UPDATE tbl_page SET name = '$name', slug = '$slug', content = '$content', modified_date = NOW(), status = '$status' WHERE id = $id ");
			$retvalue['status']= true;
			$retvalue['message']= 'Page updated successfully';
		}
		
		if($type == "DELETE"){
			$this->db->query("DELETE FROM tbl_page WHERE id = $id");
			$retvalue['status']= true;
			$retvalue['message']= 'Navigation deleted successfully';
		}
		return $retvalue;
	}
	
	public function get_page($data){		
		
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_page WHERE id = '$id'")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_page ORDER BY id DESC")->result();
		}
		
	}
	function get_products_url(){
		$url = $this->input->post("url");
		$apiID = $this->input->post("apiID");
		$retvalue['status']=false;
		$api = $this->db->query("SELECT * FROM tbl_api WHERE id = $apiID")->row();
		if($api){
			$rootPath = $api->rootPath;
			$id_depth = $api->id_depth;
			$name_depth = $api->name_depth;
			$image_depth = $api->image_depth;
			$url_depth = $api->url_depth;
			$price_depth = $api->price_depth;
		
			if (filter_var($url, FILTER_VALIDATE_URL) === false) {
			
				$retvalue['message']="Test URL is not a valid URL";
				$retvalue['type']='URL';
				return $retvalue;
			}
			
			$result = @file_get_contents($url);
		
			$xmlresult = @simplexml_load_string($result);
			if($xmlresult)$result = json_encode($xmlresult);
			
			$result = json_decode($result,true);
			if(count($result) > 0){
				$products = array();
				$keys = explode("/",$rootPath);
				$result = $this->get_array_value($result,$keys);
				if($result){
					if(is_array($result)){
						foreach($result as $r){
							$product = array();
							
							//Id
							$keys = explode("/",$id_depth);
							if(is_array($r))
								$product['id'] = $this->get_array_value($r,$keys);
							else
								$product['id'] = $r;
							
							//Names
							$keys = explode("/",$name_depth);
							if(is_array($r))
								$product['name'] = $this->get_array_value($r,$keys);
							else
								$product['name'] = $r;
							
							//Image
							$keys = explode("/",$image_depth);
							if(is_array($r))
								$product['image'] = $this->get_array_value($r,$keys);
							else
								$product['image'] = $r;
							
							//Product URL
							$keys = explode("/",$url_depth);
							if(is_array($r))
								$product['url'] = $this->get_array_value($r,$keys);
							else
								$product['url'] = $r;
							
							//Price
							$keys = explode("/",$price_depth);
							if(is_array($r))
								$product['price'] = floatval(str_replace("$","",$this->get_array_value($r,$keys)));
							else
								$product['price'] = floatval(str_replace("$","",$r));
							
							array_push($products,(object)$product);
						}
						$retvalue['products'] = $products;
						$retvalue['status']=true;
					}else{
						$retvalue['message']=$rootPath.' is not an array';
						$retvalue['type']='Root Path';
					}
				}else{
					$retvalue['message']='Inavlid Loop'.$rootPath;
					$retvalue['type']='Root Path';
				}
			}else{
				$retvalue['message']='No Data Found';
				$retvalue['type']='URL';
			}
		}else{
			$retvalue['message']='Invalid Api Configuration';
			$retvalue['type']='URL';
		}
		
		return $retvalue;
		
	}
	
	function validate_url(){
		$status=false;$message='Failed';
		$url = $this->input->post("testURL");
		$rootPath = $this->input->post("rootPath");
		$id_depth = $this->input->post("id_depth");
		$name_depth = $this->input->post("name_depth");
		$image_depth = $this->input->post("image_depth");
		$url_depth = $this->input->post("url_depth");
		$price_depth = $this->input->post("price_depth");
		
		if (filter_var($url, FILTER_VALIDATE_URL) === false) {
		
			$retvalue['message']="Test URL is not a valid URL";
			$retvalue['type']='URL';
			return $retvalue;
		}
		$product = array();
		$result = @file_get_contents($url);
		
		$xmlresult = @simplexml_load_string($result);
		if($xmlresult)$result = json_encode($xmlresult);		
		
		$result = json_decode($result,true);
		
		if(count($result) > 0){
			
			$products = array();
			$keys = explode("/",$rootPath);
			$result = $this->get_array_value($result,$keys);
			if($result){
				if(is_array($result)){
					foreach($result as $r){
						
						//Id
						$keys = explode("/",$id_depth);
						
						if(is_array($r))
							$product['id'] = $this->get_array_value($r,$keys) == false ? false : true;
						else
							$product['id'] = true;
						
						//Names
						$keys = explode("/",$name_depth);
						if(is_array($r))
							$product['name'] = $this->get_array_value($r,$keys) == false ? false : true;
						else
							$product['name'] = true;
						
						//Image
						$keys = explode("/",$image_depth);
						if(is_array($r))
							$product['image'] = $this->get_array_value($r,$keys) == false ? false : true;
						else
							$product['image'] = true;
						
						//Product URL
						$keys = explode("/",$url_depth);
						if(is_array($r))
							$product['url'] = $this->get_array_value($r,$keys) == false ? false : true;
						else
							$product['url'] = true;
						
						//Price
						$keys = explode("/",$price_depth);
						if(is_array($r))
							$product['price'] = $this->get_array_value($r,$keys) == false ? false : true;
						else
							$product['price'] = true;										
					}
					if($product['id'] == false || $product['name'] == false || $product['image'] == false || $product['url'] == false || $product['price'] == false){
						$retvalue['status'] = false;
						$retvalue['message'] = 'Failed. Please give JSON depth paths correctly';
					}else{
						$retvalue['status'] = true;
						$retvalue['product'] = $product;
						$retvalue['message'] = 'Api Validated Successfully';
					}
				}else{
					$retvalue['message']=$rootPath.' is not an array';
					$retvalue['type']='Root Path';
				}
			}else{
				$retvalue['message']='Inavlid Loop'.$rootPath;
				$retvalue['type']='Root Path';
			}
		}else{
			$retvalue['message']='Invalid URL. No Data Found';
			$retvalue['type']='URL';
		}		
		return $retvalue;
		
	}
	function get_array_value(array $array, array $indexes)
	{
		if (count($array) == 0 || count($indexes) == 0) {
			return false;
		}

		$index = array_shift($indexes);
		if(!array_key_exists($index, $array)){
			return false;
		}

		$value = $array[$index];
		if (count($indexes) == 0) {
			return $value;
		}

		if(!is_array($value)) {
			return false;
		}

		return $this->get_array_value($value, $indexes);
	}
	
		
}

?>