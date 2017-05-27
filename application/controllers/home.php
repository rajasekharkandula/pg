<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model("home_model");
	}
	function index(){
	
		$data['menu'] = $this->home_model->getMenu();
		 $data['header'] = $this->load->view('header',$data,true);
		$data['slides'] = $this->home_model->getSlides();
		$data['banners'] = $this->home_model->getBanners();
		$data['products'] = $this->home_model->getTopRated();
		$data['sellers'] = $this->home_model->getTopSellers();
		$data['newest'] = $this->home_model->getNewProducts();
		$data['featured'] = $this->home_model->getFeaturedProducts();
		//var_dump($data['menu']);exit();
		$this->load->view('index',$data);
	}
	function login()
	{
		$data['menu'] = $this->home_model->getMenu();
		$data['header'] = $this->load->view('header',$data,true);
		$this->load->view('login',$data);
	}
	function logout(){
		$this->session->sess_destroy();
		$data['menu'] = $this->home_model->getMenu();
		$data['header'] = $this->load->view('header',$data,true);
		$data['slides'] = $this->home_model->getSlides();
		$data['banners'] = $this->home_model->getBanners();
		$data['products'] = $this->home_model->getTopRated();
		$data['sellers'] = $this->home_model->getTopSellers();
		$data['newest'] = $this->home_model->getNewProducts();
		$data['featured'] = $this->home_model->getFeaturedProducts();
		$this->load->view('home',$data);
	}
	function signup()
	{
		$data['menu'] = $this->home_model->getMenu();
		$data['header'] = $this->load->view('header',$data,true);
		$this->load->view('signup',$data);
	}
	function profile()
	{
		$data['menu'] = $this->home_model->getMenu();
		$data['header'] = $this->load->view('header',$data,true);
		$data['account'] = $this->home_model->getMyAccountDet();
		$data['gifts'] = $this->home_model->getGifts();
		$data['profile'] = $this->home_model->getProfileDet();
		//var_dump($data['gifts']);exit();
		$this->load->view('profile',$data);
	}
	function updateProfile()
	{
		$data['menu'] = $this->home_model->getMenu();
		$data['header'] = $this->load->view('header',$data,true);
		$data['account'] = $this->home_model->getMyAccountDet();
		$data['gifts'] = $this->home_model->getGifts();
		$data['profile'] = $this->home_model->getProfileDet();
		$data['updateprofile'] = $this->home_model->updateProfile();
		//var_dump($data['updateprofile']);exit();
		$this->load->view('profile',$data);
	}
	function products($categorySlug = "")
	{
		 $data['menu'] = $this->home_model->getMenu();
		 $data['categories'] = $this->home_model->getCategories();
		 $data['filters'] = $this->home_model->getFilters();
		 $data['filterKey'] = $this->home_model->getFilterKey();
		 if($categorySlug == "")
		 $categorySlug = isset($_GET['slug']) ? $_GET['slug'] : NULL;
		 $filterIDs = isset($_GET['fid']) ? $_GET['fid'] : NULL;
		 $search = array(
			'type'=>'SEARCH',
			'categorySlug' => $categorySlug,
			'filterIDs' => $filterIDs
		 );
		 $data['categorySlug'] = $categorySlug;
		 $data['filterIDs'] = $filterIDs;
		 $data['products'] = $this->home_model->getProducts($search);
		 
		 $data['categoryName'] = $this->home_model->getCategoriesBySlug($categorySlug);
		 
		 $data['header'] = $this->load->view('header',$data,true);
		 //var_dump($data['products']);exit();
		 $this->load->view('products',$data);
	}
	function createUser()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		//var_dump($email);exit();
		echo json_encode($this->home_model->createUser($email,$password));
	}
	function loginCheck()
	{
		echo json_encode($this->home_model->loginCheck());
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
	function removeProfile()
	{
		echo json_encode($this->home_model->removeProfile());
	}
	
}
?>