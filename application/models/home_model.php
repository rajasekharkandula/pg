<?php 
/**
*	Name: Home Model
*	Author: Axinovate Technologies LLP
*			info@axinovate.com
*
*	Created: 10 May 2017
*
*
*/

class Home_model extends CI_Model{
	public function __Construct(){
		parent:: __Construct();
		$this->load->model("admin_model");
	}
	
	/**
 * Method randStrGen for generating random string
 * @param int
 * @return string
 **/
	function randStrGen($len=5){
		$result = "";
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$charArray = str_split($chars);
		for($i = 0; $i < $len; $i++){
			$randItem = array_rand($charArray);
			$result .= "".$charArray[$randItem];
		}
		return 'r'.$result;
	}
	function getHeader(){
		 return $this->db->query("select * from tbl_navigation")->result();
	}
	
	function login()
	{
		 $retvalue = array();
		 $retvalue['status'] = false;
		 $email = $this->input->post('email');
		 $password = $this->input->post('password');
		
		 $user = $this->db->query("select * from tbl_user where email = '$email' AND password='$password'")->row();
		 if($user){
			 $userdata = array(
				 'userID' => $user->id,
				 'email' => $user->email,
				 'name' => $user->first_name.' '.$user->last_name,
				 'logged_in' => TRUE
				 );
			$this->session->set_userdata($userdata);
			$retvalue['message'] = "Success";
			 $retvalue['status'] = true;
		 }else{
			 $retvalue['message'] = "Invalid Credintials";
		 }
		 return $retvalue;
	}
	
	function register()
	{
		$retvalue = array();
		$retvalue['status'] = false;
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->query("select * from tbl_user where email = '$email'")->row();
		if($user){
			$retvalue['message'] = "This email already exists.";
			return $retvalue;
		}
		$this->db->query("INSERT INTO tbl_user (email, password, role, created_date, modified_date, status) VALUES ( '$email', '$password', 'USER', NOW() NOW(), 'Active')");
		
		$user = $this->db->query("select * from tbl_user where email = '$email' AND password='$password'")->row();
		if($user){
			$userdata = array(
				'userID' => $user->id,
				'email' => $user->email,
				'name' => $user->first_name.' '.$user->last_name,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($userdata);
			$retvalue['message'] = "Success";
			$retvalue['status'] = true;
		}else{
			$retvalue['message'] = "Please try again later";
		}
		return $retvalue;
	}
	function get_user($data){
		$type = isset($data['type']) ? $data['type'] : '';
		$userID = isset($data['userID']) ? (int)$data['userID'] : 0;
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_user WHERE id=$userID")->row();
		}
	}
	function update_user(){
		$retvalue = array();
		$retvalue['status'] = false;
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$userID = $this->session->userdata("userID");
		$row = $this->db->query("SELECT * FROM tbl_user WHERE email='$email' AND id != $userID")->row();
		if($row){
			$retvalue['message'] = 'This email already exists';
			return $retvalue;
		}
		$this->db->query("UPDATE tbl_user SET first_name = '$first_name',last_name = '$last_name', email = '$email', phone = '$phone' WHERE id  = $userID");
		
		$userdata = array(
			'email' => $email,
			'name' => $first_name.' '.$last_name,
		);
		$this->session->set_userdata($userdata);
		
		$retvalue['message'] = 'Profile updated successfully';
		$retvalue['status'] = true;
		return $retvalue;
		
	}
	function change_password(){
		$password = $this->input->post('password');
		$userID = $this->session->userdata("userID");
		$this->db->query("UPDATE tbl_user SET password = '$password' WHERE id  = $userID");
		$retvalue['message'] = 'Password successfully';
		$retvalue['status'] = true;
		return $retvalue;
	}
	
	function get_likes($data){
		$type = isset($data['type']) ? $data['type'] : '';
		$userID = isset($data['userID']) ? (int)$data['userID'] : 0;
		$sessionUserID = (int)$this->session->userdata("userID");
		if($type == 'L'){
			return $this->db->query("SELECT p.*,(SELECT COUNT(*) FROM tbl_likes WHERE user_id = '$sessionUserID' AND product_id = p.id) AS liked  FROM tbl_likes l INNER JOIN tbl_product p ON p.id = l.product_id WHERE l.user_id=$userID")->result();
		}
	}
	
	function get_profile($data){
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		$userID = isset($data['userID']) ? (int)$data['userID'] : 0;
		$key = isset($data['key']) ? $data['key'] : NULL;
		$sessionUserID = (int)$this->session->userdata("userID");
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_custom_profiles WHERE id=$id")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_custom_profiles WHERE user_id=$userID")->result();
		}
		if($type == 'PRODUCTS'){
			return $this->db->query("SELECT pr.profile_id,pd.*,(SELECT COUNT(*) FROM tbl_likes WHERE user_id = '$sessionUserID' AND product_id = pd.id) AS liked FROM tbl_custom_profiles_products pr INNER JOIN tbl_custom_profiles p ON p.id = pr.profile_id INNER JOIN tbl_product pd ON pd.id = pr.product_id WHERE p.user_id=$userID")->result();
		}
		if($type == 'USERS'){
			$str = "SELECT u.id,CONCAT(u.first_name,' ',u.last_name) as name FROM tbl_user u INNER JOIN tbl_custom_profiles p ON p.user_id AND u.id ";
			if($key != NULL && $key != '')
				$str.=" WHERE u.first_name LIKE '%$key%' OR u.last_name LIKE '%$key%'";
			$str.=" GROUP BY u.id";
			return $this->db->query($str)->result();
		}
	}
	
	function ins_upd_profile(){
		$retvalue = array();
		$retvalue['status'] = false;
		$type = $this->input->post("type");
		$id = (int)$this->input->post("id");
		$name = $this->input->post("name");
		$reason = $this->input->post("reason");
		$date = date('Y-m-d',strtotime($this->input->post("date")));
		$relation = $this->input->post("relation");
		$userID = (int)$this->session->userdata("userID");
		
		if($type == 'INSERT'){
			$this->db->query("INSERT INTO tbl_custom_profiles (user_id, name, created_date, updated_date, date_for_gift, relation, reason, status) VALUES ($userID, '$name', NOW(), NOW(), '$date', '$reason', '$reason','Active'); ");
			$retvalue['message'] = 'Profile created successfully';
			$retvalue['status'] = true;
		}
		
		if($type == 'UPDATE'){
			$this->db->query("UPDATE tbl_custom_profiles SET name = '$name', updated_date = NOW(), date_for_gift = '$date', relation = '$relation', reason = '$reason', status = 'Active' WHERE id = $id");
			$retvalue['message'] = 'Profile updated successfully';
			$retvalue['status'] = true;
		}
		
		if($type == 'DELETE'){
			$this->db->query("DELETE FROM tbl_custom_profiles WHERE id = $id");
			$retvalue['message'] = 'Profile deleted successfully';
			$retvalue['status'] = true;
		}
		
		return $retvalue;
	}
	function get_user_gift($data){
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		$userID = isset($data['userID']) ? (int)$data['userID'] : 0;
		$sessionUserID = (int)$this->session->userdata("userID");
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_user_products WHERE user_id=$userID")->result();
		}
		if($type == 'ALL'){
			return $this->db->query("SELECT p.*,CONCAT(u.first_name,' ',u.last_name) AS username,u.email FROM tbl_user_products p INNER JOIN tbl_user u ON u.id = p.user_id")->result();
		}
		
	}
	function ins_upd_user_gift(){
		$retvalue = array();
		$retvalue['status'] = false;
		$type = $this->input->post("type");
		$id = (int)$this->input->post("id");
		$name = $this->input->post("name");
		$price = $this->input->post("price");
		$link = $this->input->post("link");
		$userID = (int)$this->session->userdata("userID");
		
		if(isset($_FILES['image'])){		
			$image=$this->admin_model->image_upload($_FILES['image'],'assets/images/products/','product');
			if(!$image)
				$image = $this->input->post('uploaded_img') ? $this->input->post('uploaded_img') : $this->config->item('default_image');
		}else{
			$image = $this->config->item('default_image');
		}
		
		if($type == 'INSERT'){
			$this->db->query("INSERT INTO tbl_user_products (user_id, name, price, link, image, created_date, status) VALUES ($userID, '$name', '$price', '$link', '$image', NOW(), 'Active')");
			$retvalue['message'] = 'Gift created successfully';
			$retvalue['status'] = true;
		}
		
		if($type == 'UPDATE'){
			$this->db->query("UPDATE tbl_user_products SET name = '$name', price = '$price', link = '$link', image = '$image', status = 'Active' WHERE id = $id");
			$retvalue['message'] = 'Gift updated successfully';
			$retvalue['status'] = true;
		}
		
		if($type == 'DELETE'){
			$this->db->query("DELETE FROM tbl_user_products WHERE id = $id");
			$retvalue['message'] = 'Gift deleted successfully';
			$retvalue['status'] = true;
		}
		
		return $retvalue;
	}
	function ins_upd_like(){
		$id = (int)$this->input->post("id");
		$userID = (int)$this->session->userdata("userID");
		$row = $this->db->query("SELECT * FROM tbl_likes WHERE user_id = $userID AND product_id = $id")->row();
		if($row){
			$this->db->query("DELETE FROM tbl_likes WHERE user_id = $userID AND product_id = $id");
			return false;
		}else{
			$this->db->query("INSERT INTO tbl_likes (user_id, product_id) VALUES ($userID, $id)");
			return true;
		}
	}
	
	function get_product($data){
		$type = isset($data['type']) ? $data['type'] : '';
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		$userID = $this->session->userdata("userID");
		if($type == 'S'){
			return $this->db->query("SELECT * FROM tbl_product WHERE id=$id")->row();
		}
		if($type == 'L'){
			return $this->db->query("SELECT * FROM tbl_product")->result();
		}
		if($type == 'GIFT'){
			$retvalue['product'] = $this->db->query("SELECT * FROM tbl_product WHERE id=$id")->row();
			$retvalue['profiles'] = $this->db->query("SELECT p.*,(SELECT COUNT(pr.product_id) FROM tbl_custom_profiles_products pr WHERE pr.product_id = $id AND pr.profile_id = p.id) AS selected FROM tbl_custom_profiles p WHERE p.user_id=$userID")->result();
			return $retvalue;
		}
	}
	
	function ins_upd_gift(){
		$id = $this->input->post('id');
		$productID = $this->input->post('productID');
		$row = $this->db->query("SELECT * FROM tbl_custom_profiles_products WHERE profile_id = $id AND product_id = $productID")->row();
		if($row){
			$this->db->query("DELETE FROM tbl_custom_profiles_products WHERE profile_id = $id AND product_id = $productID");
			return 0;
		}else{
			$this->db->query("INSERT INTO tbl_custom_profiles_products (profile_id, product_id) VALUES ($id, $productID)");
			return 1;
		}
	}
	
	function getSlides()
	{
		 $query = $this->db->query("select id,image from tbl_slide WHERE slideType='slide'")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	}
	function getMenu()
	 {
		 $query = $this->db->query("select * from tbl_navigation")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getBanners()
	 {
		 $query = $this->db->query("select * from tbl_slide  WHERE slideType='banner' LIMIT 2")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getSections(){
		$retvalue = array();
		$userID = $this->session->userdata("userID");
		$qry = $this->db->query("select * from tbl_section ORDER BY sortingOrder ASC")->result();
		foreach($qry as $r){
			$section = array();
			$section['name'] = $r->name;
			$section['products'] = $this->db->query("select p.*,(SELECT COUNT(*) FROM tbl_likes WHERE user_id = '$userID' AND product_id = p.id) AS liked from tbl_section_products s INNER JOIN tbl_product p ON p.id = s.product_id WHERE s.section_id = ".$r->id." LIMIT 4")->result();
			array_push($retvalue,$section);
		}
		return $retvalue;
	 }
	 function getTopRated()
	 {
		 $query = $this->db->query("select * from tbl_product")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getTopSellers()
	 {
		 $query = $this->db->query("select * from tbl_product LIMIT 4")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 } 
	 function getNewProducts()
	 {
		 $query = $this->db->query("select * from tbl_product order by name asc limit 4")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getFeaturedProducts()
	 {
		 $query = $this->db->query("select * from tbl_product LIMIT 4")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 } 
	 function getCategories()
	 {
		 $query = $this->db->query("select * from tbl_category")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getFilters()
	 {
		 $query = $this->db->query("select * from tbl_filter")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getFilterKey()
	 {
		 $query = $this->db->query("select f.filterKey from tbl_filter f group by f.filterKey")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getProducts($data)
	 {
		 $type = isset($data['type']) ? $data['type'] : '';
		 $navigationSlug = isset($data['navigationSlug']) ? $data['navigationSlug'] : '';
		 $category = isset($data['category']) ? $data['category'] : NULL;
		 $age = isset($data['age']) ? $data['age'] : NULL;
		 $price = isset($data['price']) ? $data['price'] : NULL;
		 $key = isset($data['key']) ? $data['key'] : NULL;
		 $userID = (int)$this->session->userdata("userID");
		if($type == 'SEARCH'){
			$str = "SELECT *,(SELECT COUNT(*) FROM tbl_likes WHERE user_id = '$userID' AND product_id = p.id) AS liked FROM tbl_product p WHERE p.status = 'Active' ";
			
			if($navigationSlug != NULL && $navigationSlug !=''){
				$query = $this->db->query("SELECT id FROM tbl_navigation n WHERE n.slug = '$navigationSlug' OR n.parent_id IN (SELECT id FROM tbl_navigation WHERE slug = '$navigationSlug')")->result();
				$ids = array();
				foreach($query as $r)array_push($ids,$r->id);
				$ids = implode(",",$ids);
				$str.=" AND p.id IN (SELECT product_id FROM tbl_navigation_products WHERE navigation_id IN ($ids)) ";
			}
			if($category != NULL && $category !=''){
				$str.=" AND p.category IN ($category) ";
			}
			if($age != NULL && $age !=''){
				$query = $this->db->query("SELECT * FROM tbl_filter WHERE id = $age")->row();
				if($query)
				$str.=" AND (p.min_age >= ".$query->min_value." AND p.max_age <= ".$query->max_value.")";
			}
			if($price != NULL && $price !=''){
				$query = $this->db->query("SELECT * FROM tbl_filter WHERE id = $price")->row();
				if($query)
				$str.=" AND (p.price >= ".$query->min_value." AND p.price <= ".$query->max_value.")";
			}
			if($key != NULL && $key !=''){
				$str.=" AND p.name LIKE '%$key%'";
			}
			
			//echo $str;exit();
			return $this->db->query($str)->result();
		}
		 
	 }
	 function getNavigationBySlug($slug)
	 {
		 $query = $this->db->query("select * from tbl_navigation where slug='$slug'")->row();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getMyAccountDet()
	 {
		 $id = $this->session->userdata("userID");
		 $query = $this->db->query("select id,first_name,last_name,email,phone from tbl_user where id='".$id."'")->row();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function updMyAccountDet()
	 {
		 $id = $this->session->userdata('userID');
		 $first_name = $this->input->post('firstName');
		 $last_name = $this->input->post('lastName');
		 $email = $this->input->post('email');
		 $phone = $this->input->post('phone');
		 $query = $this->db->query("update tbl_user set first_name='".$first_name."',last_name='".$last_name."',email='".$email."',phone='".$phone."' where id='".$id."'");
		 $data = $this->db->query("select * from tbl_user where id='".$id."'")->row();
		 $userdata = array(
					'userID'=>$data->id,
					'firstName'=>$data->first_name,
					'lastName'=>$data->last_name,
					'email'=>$data->email
		 );
		 $this->session->set_userdata($userdata);
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function updatePassword()
	 {
		 $id = $this->session->userdata('userID');
		 $psw = $this->input->post('password');
		 $query = $this->db->query("update users set encrypted_password='".$psw."' where id='".$id."'");
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function insGiftDet()
	 {
		 $userID = $this->session->userdata("userID");
		 $name = $this->input->post("giftname");
		 $price = $this->input->post("giftprice");
		 $link = $this->input->post("giftlink");
		 $file_name = $_FILES["giftimage"]["name"];
		 $file_tmp = $_FILES["giftimage"]["tmp_name"];
		 $path = 'assets/uploads/gift/image/';
		 $location = $path.$file_name;
		 move_uploaded_file($file_tmp, $location);
		 $query = $this->db->query("insert into tbl_gifts(name,price,link,image,created_at,updated_at,user_id)values('".$name."','".$price."','".$link."','".$location."',NOW(),NOW(),'".$userID."')");
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getGifts()
	 {
		 $id = $this->session->userdata("userID");
		 $query = $this->db->query("select * from tbl_gifts where user_id='".$id."'")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function insProfile()
	 {
		 $id = $this->session->userdata("userID");
		 $name = $this->input->post("name");
		 $reason = $this->input->post("reason");
		 $datetimepicker = $this->input->post("datetimepicker");
		 $relation = $this->input->post("relation");
		 $query = $this->db->query("insert into tbl_custom_profiles(user_id,name,created_at,date_for_gift,relation,reason,updated_at,status)values('".$id."','".$name."',NOW(),'".$datetimepicker."','".$relation."','".$reason."',NOW(),'P')");
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getProfileDet()
	 {
		 $id = $this->session->userdata("userID");
		 $query = $this->db->query("select * from tbl_custom_profiles where user_id='".$id."' and status='P'")->result();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function updateProfile()
	 {
		 $userID = $this->session->userdata("userID");
		 $id = $this->input->post("id");
		 $query = $this->db->query("select * from tbl_custom_profiles where id='".$id."' and user_id='".$userID."'")->row();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function editProfile($id)
	 {
		 $userID = $this->session->userdata("userID");
		 //$id = $this->input->post("id");
		 $name = $this->input->post("name");
		 $reason = $this->input->post("reason");
		 $datetime = $this->input->post("datetime");
		 $relation = $this->input->post("relation");
		 //echo $id;exit;
		 $query = $this->db->query("update tbl_custom_profiles set name='".$name."',date_for_gift='".$datetime."',relation='".$relation."',reason='".$reason."' where id='$id' and user_id='".$userID."'");
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function removeProfile()
	 {
		 $userID = $this->session->userdata("userID");
		 $id = $this->input->post("id");
		 $query = $this->db->query("update tbl_custom_profiles set status='F' where id='".$id."' and user_id='".$userID."' and status = 'P' ");
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function getGiftDet()
	 {
		 $id = $this->input->post("id");
		 $userID = $this->session->userdata("userID");
		 $data['product'] = $this->db->query("select * from tbl_product where id='".$id."'")->row();
		 $data['profiles'] = $this->db->query("select *,(select count(*) from tbl_custom_profiles_products where custom_profile_id = p.id AND product_id = $id AND userID = '$userID') AS selected from tbl_custom_profiles p where p.user_id='".$userID."'")->result();
		 return $data;
	 }
	 function getProfileGifts()
	 {
		 $userID = $this->session->userdata("userID");
		 $query = $this->db->query("select * from tbl_product p inner join tbl_custom_profiles_products cpp on p.id=cpp.product_id where cpp.userID = '".$userID."' ")->result();
		 return $query;
	 }
	 function insCustomProfileProducts()
	 {
		 $userID = $this->session->userdata("userID");
		 $profileID = $this->input->post("profileID");
		 $productID = $this->input->post("productID");
		 $this->db->query("DELETE FROM tbl_custom_profiles_products WHERE custom_profile_id = $profileID AND product_id = $productID AND userID = $userID");
		 $query = $this->db->query("insert into tbl_custom_profiles_products(custom_profile_id,product_id,userID)values('".$profileID."','".$productID."','".$userID."')");
		 return $query;
	 }
	 function removeProfileProduct()
	 {
		 $userID = $this->session->userdata("userID");
		 $profileID = $this->input->post("profileID");
		 $productID = $this->input->post("productID");
		 $query = $this->db->query("delete from tbl_custom_profiles_products where custom_profile_id = $profileID");
		 return $query;
	 }
	 function insertLikedProducts()
	 {
		 $userID = $this->session->userdata("userID");
		 $productID = $this->input->post("product_id");
		 $qry  = $this->db->query("SELECT * FROM tbl_likes where user_id = '$userID' and product_id = '$productID'")->row();
		 if($qry){
			  $this->db->query("DELETE FROM tbl_likes WHERE user_id='$userID' and product_id='$productID'");
			  return false;
		 }else{
			  $this->db->query("insert into tbl_likes(user_id,product_id)values('$userID','$productID')");
			  return true;
		 }
	 }
	 function searchProducts()
	 {
		 echo "ok"; exit();
		 $search = $this->input->post("searchkey");
		 echo $search;
		 $data['search'] = $this->db->query("select * from tbl_product where name LIKE '".$search."'%")->result();
		 return $data;
	 }
}

?>