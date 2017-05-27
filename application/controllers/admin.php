<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}
	
	public function index()
	{
		
		$pageData['page'] = 'DASHBOARD';
		$pageData['pageTitle'] = 'Dashboard';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['reports'] = $this->admin_model->get_report(array('type'=>'DASHBOARD'));
		$data['users'] = $this->admin_model->get_user(array('type'=>'DL'));
		$data['products'] = $this->admin_model->get_product(array('type'=>'DL'));
		$this->load->view('admin/index',$data);
	}
	public function categories()
	{
		$pageData['page'] = 'CATALOG';
		$pageData['pageTitle'] = 'Categories';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['categories'] = $this->admin_model->get_category(array('type'=>'L'));
		//var_dump($data['categories']);exit();
		$this->load->view('admin/categories',$data);
	}
	public function category($id=0)
	{
		$pageData['page'] = 'CATALOG';
		$pageData['pageTitle'] = 'Categories';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['category'] = $this->admin_model->get_category(array('type'=>'S','id'=>$id));
		//$data['api_categories'] = $this->admin_model->get_category(array('type'=>'AL','id'=>$id));
		//var_dump($data['api_categories']);exit();
		$this->load->view('admin/category',$data);
	}
	public function products()
	{
		$pageData['page'] = 'CATALOG';
		$pageData['pageTitle'] = 'Products';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['products'] = $this->admin_model->get_product(array('type'=>'L'));
		//var_dump($data['products']);exit();
		$this->load->view('admin/products',$data);
	}
	public function product($id=0)
	{
		$pageData['page'] = 'CATALOG';
		$pageData['pageTitle'] = 'Products';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['product'] = $this->admin_model->get_product(array('type'=>'S','id'=>$id));
		//var_dump($data['api_categories']);exit();
		$this->load->view('admin/product',$data);
	}
	public function api_products()
	{
		$pageData['page'] = 'CATALOG';
		$pageData['pageTitle'] = 'Products';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['api'] = $this->admin_model->get_api(array('type'=>'L'));
		//var_dump($data['products']);exit();
		$this->load->view('admin/api_products',$data);
	}
	public function api()
	{
		$pageData['page'] = 'API';
		$pageData['pageTitle'] = 'API List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['api'] = $this->admin_model->get_api(array('type'=>'L'));
		$this->load->view('admin/api_list',$data);
	}
	public function api_config($id=0)
	{
		$pageData['page'] = 'API';
		$pageData['pageTitle'] = 'API List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['api'] = $this->admin_model->get_api(array('type'=>'S','id'=>$id));
		$data['api_url'] = $this->admin_model->get_api(array('type'=>'URL_S','id'=>$id));
		//var_dump($data['api_url']);exit();
		$this->load->view('admin/api',$data);
	}
	public function slides()
	{
		$pageData['page'] = 'SLIDE';
		$pageData['pageTitle'] = 'Slides List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['slides'] = $this->admin_model->get_slide(array('type'=>'L'));
		$this->load->view('admin/slides',$data);
	}
	public function slide_config($id=0)
	{
		$pageData['page'] = 'SLIDE';
		$pageData['pageTitle'] = 'Slides List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['slide'] = $this->admin_model->get_slide(array('type'=>'S','id'=>$id));
		$this->load->view('admin/slide_config',$data);
	}
	public function navigations()
	{
		$pageData['page'] = 'NAVIGATION';
		$pageData['pageTitle'] = 'Navigation List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['navigations'] = $this->admin_model->get_navigation(array('type'=>'L'));
		$this->load->view('admin/navigations',$data);
	}
	public function navigation_config($id=0)
	{
		$pageData['page'] = 'SLIDE';
		$pageData['pageTitle'] = 'Slides List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['navigation'] = $this->admin_model->get_navigation(array('type'=>'S','id'=>$id));
		$data['navigations'] = $this->admin_model->get_navigation(array('type'=>'P'));
		$this->load->view('admin/navigation_config',$data);
	}
	
	public function filters()
	{
		$pageData['page'] = 'FILTER';
		$pageData['pageTitle'] = 'Filter List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['filters'] = $this->admin_model->get_filter(array('type'=>'L'));
		$this->load->view('admin/filters',$data);
	}
	public function filter_config($id=0)
	{
		$pageData['page'] = 'FILTER';
		$pageData['pageTitle'] = 'Filter Configuration';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['filter'] = $this->admin_model->get_filter(array('type'=>'S','id'=>$id));
		$data['filter_keys'] = $this->admin_model->get_filter(array('type'=>'FK','id'=>$id));
		$this->load->view('admin/filter_config',$data);
	}
	
	public function users()
	{
		$pageData['page'] = 'USER';
		$pageData['pageTitle'] = 'User List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['users'] = $this->admin_model->get_user(array('type'=>'L'));
		$this->load->view('admin/users',$data);
	}
	public function user_config($id=0)
	{
		$pageData['page'] = 'USER';
		$pageData['pageTitle'] = 'User Configuration';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['user'] = $this->admin_model->get_user(array('type'=>'S','id'=>$id));
		$this->load->view('admin/user_config',$data);
	}
	public function pages()
	{
		$pageData['page'] = 'CMS';
		$pageData['pageTitle'] = 'Pages List';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['pages'] = $this->admin_model->get_page(array('type'=>'L'));
		$this->load->view('admin/pages',$data);
	}
	public function page_config($id=0)
	{
		$pageData['page'] = 'CMS';
		$pageData['pageTitle'] = 'Page Configuration';
		$data['head'] = $this->load->view('admin/templates/head',$pageData,true);
		$data['header'] = $this->load->view('admin/templates/header',$pageData,true);
		$data['footer'] = $this->load->view('admin/templates/footer',$pageData,true);
		$data['page'] = $this->admin_model->get_page(array('type'=>'S','id'=>$id));
		$this->load->view('admin/page_config',$data);
	}
	
	function ins_upd_page(){
		echo json_encode($this->admin_model->ins_upd_page());
	}
	function ins_upd_user(){
		echo json_encode($this->admin_model->ins_upd_user());
	}
	function ins_upd_filter(){
		echo json_encode($this->admin_model->ins_upd_filter());
	}
	function ins_upd_slide(){
		echo json_encode($this->admin_model->ins_upd_slide());
	}
	function ins_upd_navigation(){
		echo json_encode($this->admin_model->ins_upd_navigation());
	}
	function ins_upd_api(){
		echo json_encode($this->admin_model->ins_upd_api());
	}
	function ins_upd_category(){
		echo json_encode($this->admin_model->ins_upd_category());
	}
	function ins_upd_product(){
		echo json_encode($this->admin_model->ins_upd_product());
	}
	function get_product_from_api(){
		$data['products'] = $this->admin_model->get_product_from_api();
		$data['categories'] = $this->admin_model->get_category(array('type'=>'L'));
		//var_dump($data['products']);exit();
		echo $this->load->view("admin/api_product_template",$data,true);
	}
	function get_api(){
		$data = array(
			'type'=>$this->input->post('type'),
			'id'=>$this->input->post('id')
		);
		echo json_encode($this->admin_model->get_api($data));
	}
	function add_products(){
		var_dump($this->input->post('products'));
	}
	function validate_url(){
		echo json_encode($this->admin_model->validate_url());
	}
}