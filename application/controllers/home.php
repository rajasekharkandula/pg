<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model("home_model");
		$this->load->model("admin_model");
	}
	
	function access($data=array()){
		if($this->session->userdata('role') == 'ADMIN'){
			redirect('admin');
		}
	}
	
	function index(){
	
		$this->access();
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		
		$data['slides'] = $this->home_model->getSlides();
		$data['banners'] = $this->home_model->getBanners();
		$data['sections'] = $this->home_model->getSections();
		$this->load->view('index',$data);
	}
	function signin(){
		$this->access();
		if($this->session->userdata('logged_in') == true)redirect('home');
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$this->load->view('login',$data);
	}
	function signup(){
		$this->access();
		if($this->session->userdata('logged_in') == true)redirect('home');
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$this->load->view('register',$data);
	}
	function login(){
		echo json_encode($this->home_model->login());
	}
	function register(){
		echo json_encode($this->home_model->register());
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('home');
	}
	function profile(){
		$this->access();
		if($this->session->userdata('logged_in') == false)redirect('home/signin');
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['user'] = $this->home_model->get_user(array('type'=>'S','userID'=>$this->session->userdata('userID')));
		//var_dump($data['user']);exit();
		$this->load->view('profile',$data);
	}
	function update_user(){
		echo json_encode($this->home_model->update_user());
	}
	function reset_password(){
		$this->access();
		if($this->session->userdata('logged_in') == false)redirect('home/signin');
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$this->load->view('reset_password',$data);
	}
	function change_password(){
		echo json_encode($this->home_model->change_password());
	}
	function likes(){
		$this->access();
		if($this->session->userdata('logged_in') == false)redirect('home/signin');
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['products'] = $this->home_model->get_likes(array('type'=>'L','userID'=>$this->session->userdata('userID')));
		$data['gifts'] = $this->home_model->get_user_gift(array('type'=>'L','userID'=>$this->session->userdata('userID')));
		//var_dump($data['gifts']);exit();
		$this->load->view('likes',$data);
	}
	function profiles(){
		$this->access();
		if($this->session->userdata('logged_in') == false)redirect('home/signin');
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		$data['profiles'] = $this->home_model->get_profile(array('type'=>'L','userID'=>$this->session->userdata('userID')));
		$data['products'] = $this->home_model->get_profile(array('type'=>'PRODUCTS','userID'=>$this->session->userdata('userID')));
		//var_dump($data['profiles']);exit();
		$this->load->view('profiles',$data);
	}
	function get_profile(){
		$data = array(
			'type'=>$this->input->post('type'),
			'id'=>$this->input->post('id'),
			'userID'=>$this->input->post('userID')
		);
		echo json_encode($this->home_model->get_profile($data));
	}
	function get_product(){
		$data = array(
			'type'=>$this->input->post('type'),
			'id'=>$this->input->post('id'),
			'userID'=>$this->input->post('userID')
		);
		echo json_encode($this->home_model->get_product($data));
	}
	function get_gift_modal(){
		$data = array(
			'type'=>$this->input->post('type'),
			'id'=>$this->input->post('id'),
			'userID'=>$this->input->post('userID')
		);
		$data = $this->home_model->get_product($data);
		//var_dump($data);exit();
		echo $this->load->view('gift_template',$data);;
	}
	function ins_upd_profile(){
		echo json_encode($this->home_model->ins_upd_profile());
	}
	function ins_upd_like(){
		echo json_encode($this->home_model->ins_upd_like());
	}
	function ins_upd_gift(){
		echo json_encode($this->home_model->ins_upd_gift());
	}
	function ins_upd_user_gift(){
		echo json_encode($this->home_model->ins_upd_user_gift());
	}
	function contact()
	{
		$data['menu'] = $this->home_model->getMenu();
		$data['header'] = $this->load->view('header',$data,true);
		$this->load->view('contact',$data);
	}
	function products($navigationSlug = "")
	{
		
		$this->access();
		
		if($navigationSlug == "")
		$navigationSlug = isset($_GET['slug']) ? $_GET['slug'] : NULL;
		$age = isset($_GET['age']) ? $_GET['age'] : NULL;
		$price = isset($_GET['price']) ? $_GET['price'] : NULL;
		$category = isset($_GET['category']) ? $_GET['category'] : NULL;
		$key = isset($_GET['key']) ? $_GET['key'] : NULL;
		$search = array(
			'type'=>'SEARCH',
			'navigationSlug' => $navigationSlug,
			'age' => $age,
			'price' => $price,
			'category' => $category,
			'key' => $key
		);
		$data['navigationSlug'] = $navigationSlug;
		$data['age'] = $age;
		$data['price'] = $price;
		$data['category'] = $category;
		$pageData['search_key'] = $data['key'] = $key;
		$pageData['search_type'] = 'product';
		
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
		
		$data['categories'] = $this->home_model->getCategories();
		$data['filters'] = $this->home_model->getFilters();
		$data['filterKey'] = $this->home_model->getFilterKey();
		$data['products'] = $this->home_model->getProducts($search);
		$data['navigation'] = $this->home_model->getNavigationBySlug($navigationSlug);
		//var_dump($data['products']);exit();
		$this->load->view('products',$data);
	}
	function users()
	{
		
		$this->access();
		
		$key = isset($_GET['key']) ? $_GET['key'] : NULL;
		$pageData['search_key'] = $data['key'] = $key;
		$pageData['search_type'] = 'user';
		
		
		$pageData['data'] = $this->home_model->getHeader();
		$data['head'] = $this->load->view('templates/head',$pageData,true);
		$data['header'] = $this->load->view('templates/header',$pageData,true);
		$data['footer'] = $this->load->view('templates/footer',$pageData,true);
				
		$data['users'] = $this->home_model->get_profile(array('type'=>'USERS','key'=>$key));
		//var_dump($data['users']);exit();
		$this->load->view('users',$data);
	}
	function user_profile($id=0)
	{
		$this->access();
		
		$user = $this->home_model->get_user(array("type"=>'S','userID'=>$id));
		if($user){
			$pageData['data'] = $this->home_model->getHeader();
			$data['head'] = $this->load->view('templates/head',$pageData,true);
			$data['header'] = $this->load->view('templates/header',$pageData,true);
			$data['footer'] = $this->load->view('templates/footer',$pageData,true);
			$data['liked'] = $this->home_model->get_likes(array('type'=>'L','userID'=>$id));
			$data['profiles'] = $this->home_model->get_profile(array('type'=>'L','userID'=>$id));
			$data['products'] = $this->home_model->get_profile(array('type'=>'PRODUCTS','userID'=>$id));
			$data['user'] = $user;
			//var_dump($data['users']);exit();
			$this->load->view('user_profile',$data);
		}else{
			echo 'Invalid URL';
		}
	}
	function page($id=0)
	{
		$this->access();
		
		$page = $this->admin_model->get_page(array("type"=>'S','id'=>$id));
		if($page){
			$pageData['data'] = $this->home_model->getHeader();
			$data['head'] = $this->load->view('templates/head',$pageData,true);
			$data['header'] = $this->load->view('templates/header',$pageData,true);
			$data['footer'] = $this->load->view('templates/footer',$pageData,true);
			$data['page'] = $page;
			//var_dump($data['users']);exit();
			$this->load->view('page',$data);
		}else{
			echo 'Invalid URL';
		}
	}
	function createUser()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		//var_dump($email);exit();
		echo json_encode($this->home_model->createUser($email,$password));
	}
	
	function updMyAccountDet()
	{
		echo json_encode($this->home_model->updMyAccountDet());
	}
	function updatePassword()
	{
		echo json_encode($this->home_model->updatePassword());
	}
	function insGiftDet()
	{
		echo json_encode($this->home_model->insGiftDet());
	}
	function insProfile()
	{
		echo json_encode($this->home_model->insProfile());
	}
	function updateProfile()
	{
		echo json_encode($this->home_model->updateProfile());
	}
	function editProfile($id="")
	{
		echo json_encode($this->home_model->editProfile($id));
	}
	function removeProfile()
	{
		echo json_encode($this->home_model->removeProfile());
	}
	function getGiftDet()
	{
		echo json_encode($this->home_model->getGiftDet());
	}
	function insCustomProfileProducts()
	{
		echo json_encode($this->home_model->insCustomProfileProducts());
	}
	function removeProfileProduct()
	{
		echo json_encode($this->home_model->removeProfileProduct());
	}
	function insertLikedProducts()
	{
		echo json_encode($this->home_model->insertLikedProducts());
	}
	function searchProducts()
	{
		echo json_encode($this->home_model->searchProducts());
	}
}
?>