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
	function user_xml($data){
		$type = isset($data['type'])?$data['type']:'';
		$userID = isset($data['userID'])?$daya['userID']:'';
		$email = isset($data['email'])?$data['email']:'';
		$password = isset($data['password'])?$data['password']:'';
		$xml = "<ROOT>
					<HEADER>
						<TYPE>$type</TYPE>
						<USERID>$userID</USERID>
						<EMAIL>$email</EMAIL>
						<PASSWORD>$password</PASSWORD>
					</HEADER>
				</ROOT>";
	}
	function createUser($email,$password)
	{
		$retvalue = array();
		$query = $this->db->query("insert into tbl_user(email,password,created_date,modified_date,status) values('$email','$password',NOW(),NOW(),'Active')");
		
		return $query;
	 }
	 function loginCheck()
	 {
		 $retvalue = array();
		 $email = $this->input->post('email');
		 $password = $this->input->post('password');
		
		 $user = $this->db->query("select id,email,password,first_name from tbl_user where email = '$email' AND password='$password'")->row();
		 if($user){
			 $userdata = array(
				 'userID' => $user->id,
				 'email' => $user->email,
				 'firstName' => $user->first_name,
				 'logged_in' => TRUE
				 );
			$this->session->set_userdata($userdata);
			$retvalue['message'] = "Success";
			 
		 }else{
			 $retvalue['message'] = "Invalid Credintials";
		 }
		 return $retvalue;
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
		 $filterIDs = isset($data['filterIDs']) ? $data['filterIDs'] : '';
		 
		if($type == 'SEARCH'){
			$str = "SELECT * FROM tbl_product WHERE status = 'Active' ";
			if($navigationSlug != NULL && $navigationSlug !=''){
				$query = $this->db->query("SELECT id FROM tbl_navigation n WHERE n.slug = '$navigationSlug' OR n.parent_id IN (SELECT id FROM tbl_navigation WHERE slug = '$navigationSlug')")->result();
				$ids = array();
				foreach($query as $r)array_push($ids,$r->id);
				$ids = implode(",",$ids);
				$str.=" AND id IN (SELECT product_id FROM tbl_navigation_products WHERE navigation_id IN ($ids)) ";
			}
			/* if($filterIDs != NULL && $filterIDs !=''){
				$str.=" AND id IN (SELECT product_id FROM tbl_filter_products WHERE filter_id IN ($filterIDs))";
			} */
			return $this->db->query($str)->result();
		}
		 
	 }
	 function getNavigationBySlug($slug)
	 {
		 $query = $this->db->query("select name from tbl_navigation where slug='$slug'")->row();
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
		 $query = $this->db->query("update users set first_name='".$first_name."',last_name='".$last_name."',email='".$email."',phone='".$phone."' where id='".$id."'");
		 $data = $this->db->query("select * from users where id='".$id."'")->row();
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
		 $birth_month = $this->input->post("birth_month");
		 $birth_day = $this->input->post("birth_day");
		 $birth_year = $this->input->post("birth_year");
		 $relation = $this->input->post("relation");
		 $query = $this->db->query("insert into tbl_custom_profiles(user_id,name,created_at,birth_day,birth_month,birth_year,relation,reason,updated_at,status)values('".$id."','".$name."',NOW(),'".$birth_day."','".$birth_month."','".$birth_year."','".$relation."','".$reason."',NOW(),'P')");
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
	 function updateProfile($id)
	 {
		 $userID = $this->session->userdata("userID");
		 $id = $this->input->post("id");
		 $query = $this->db->query("select * from tbl_custom_profiles where id='".$id."' and user_id='".$userID."'")->row();
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
	 function removeProfile()
	 {
		 $userID = $this->session->userdata("userID");
		 $id = $this->input->post("id");
		 $query = $this->db->query("update tbl_custom_profiles set status='F' where id='".$id."' and user_id='".$userID."'");
		 mysqli_next_result($this->db->conn_id);
		 return $query;
	 }
}

?>