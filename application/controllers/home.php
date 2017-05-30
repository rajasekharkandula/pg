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
		//var_dump($data['newest']);exit();
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
		$this->load->view('index',$data);
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
		$data['profileGifts'] = $this->home_model->getProfileGifts();
		//var_dump($data['gifts']);exit();
		$this->load->view('profile',$data);
	}
	function contact()
	{
		$data['menu'] = $this->home_model->getMenu();
		$data['header'] = $this->load->view('header',$data,true);
		$this->load->view('contact',$data);
	}
	function products($navigationSlug = "")
	{
		 $data['menu'] = $this->home_model->getMenu();
		 $data['categories'] = $this->home_model->getCategories();
		 $data['filters'] = $this->home_model->getFilters();
		 $data['filterKey'] = $this->home_model->getFilterKey();
		 $data['profile'] = $this->home_model->getProfileDet();
		 if($categorySlug == "")
		 $categorySlug = isset($_GET['slug']) ? $_GET['slug'] : NULL;
		 if($navigationSlug == "")
		 $navigationSlug = isset($_GET['slug']) ? $_GET['slug'] : NULL;
		 $filterIDs = isset($_GET['fid']) ? $_GET['fid'] : NULL;
		 $search = array(
			'type'=>'SEARCH',
			'navigationSlug' => $navigationSlug,
			'filterIDs' => $filterIDs
		 );
		 $data['navigationSlug'] = $navigationSlug;
		 $data['filterIDs'] = $filterIDs;
		 $data['products'] = $this->home_model->getProducts($search);
		 
		 $data['navigation'] = $this->home_model->getNavigationBySlug($navigationSlug);
		 
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