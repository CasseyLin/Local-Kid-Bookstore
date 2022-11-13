<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$type = $this->session->userdata('type');
		if($type != 'U')
		{
			$this->session->set_flashdata('no_access', '<i class="fas fa-exclamation-triangle"></i> You are not allowed or not logged in! Please Log in with an user account');
			redirect('users/login');
		}

		/*=== Load the cart library ===*/
		$this->load->library('cart');
	}

	public function index()
	{
		/*=== LOAD DYNAMIC CATEGORY ===*/
		$this->load->model('admin_model');
		$view['category'] = $this->admin_model->get_category();
		/*==============================*/

		#...Get User Info
		$id = $this->session->userdata('id');
		$this->load->model('user_model');
		$view['user_details'] = $this->user_model->get_user_details($id);


		$view['user_view'] = "users/user_index";
		$this->load->view('layouts/user_home', $view);
	}

	public function my_orders()
	{
		/*=== LOAD DYNAMIC CATEGORY ===*/
		$this->load->model('admin_model');
		$view['category'] = $this->admin_model->get_category();
		/*==============================*/

		$this->load->model('user_model');
		$view['orders'] = $this->user_model->my_orders();

		$view['user_view'] = "users/myOrders";
		$this->load->view('layouts/user_home', $view);	
	}

	public function order_view($orderId)
	{
		/*=== LOAD DYNAMIC CATEGORY ===*/
		$this->load->model('admin_model');
		$view['category'] = $this->admin_model->get_category();
		/*==============================*/

		$this->load->model('admin_model');
		$view['order_detail'] = $this->admin_model->get_order_detail($orderId);

		if($this->admin_model->get_order_detail($orderId))
		{
			$view['user_view'] = "users/myOrder_detail";
			$this->load->view('layouts/user_home', $view);
		}
		else
		{
			$view['user_view'] = "temp/404page";
			$this->load->view('layouts/user_home', $view);
		}
		

	}


	public function edit_profile($id)
	{
		/*=== LOAD DYNAMIC CATEGORY ===*/
		$this->load->model('admin_model');
		$view['category'] = $this->admin_model->get_category();
		/*==============================*/

		#get existing informations
		$this->load->model('user_model');
		$view['user_details'] = $this->user_model->get_user_details($id);

		$this->form_validation->set_rules('name', 'Name', 'trim|required|strip_tags[name]');
		$this->form_validation->set_rules('contact', 'Contact', 'trim|required|numeric|strip_tags[contact]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_dash|min_length[6]');
		$this->form_validation->set_rules('repassword', 'Confirm Password',
		'trim|required|alpha_dash|min_length[6]|matches[password]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[80]|strip_tags[address]');

		$this->form_validation->set_rules('city', 'City', 'trim|required|strip_tags[city]');

		if($this->form_validation->run() == FALSE)
		{
			if($this->user_model->get_user_details($id))
			{
				$view['user_view'] = "users/edit_profile";
				$this->load->view('layouts/user_home', $view);
			}
			else
			{
				$view['user_view'] = "temp/404page";
				$this->load->view('layouts/user_home', $view);
			}
		}
		else
		{
			$this->load->model('user_model');

			if($this->user_model->edit_profile($id, $data))
			{
				$this->session->set_flashdata('success', 'Your profile info update successfully');
				redirect('user_home');
			}
			else
			{
				print $this->db->error();
			}
		}
	}

}