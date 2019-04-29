<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  
//this the index page 
	public function index()
	{
          $data['title'] = 'Home';
          $data['environment'] = $this->App_model->list_our_environment();
          $data['dream'] = $this->App_model->list_our_dream();
           $data['vission'] = $this->App_model->list_vission();
           $data['mission'] = $this->App_model->list_mission();
           $data['wordsbyceo'] = $this->App_model->list_wordsbyceo();
           $data['story'] = $this->App_model->list_sucessstory();
           $data['partners'] = $this->App_model->list_partners();
           $data['services'] = $this->App_model->list_services();
           $data['products'] = $this->App_model->list_products();
          $data['teammates'] = $this->App_model->list_teammates();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/index', $data);
          $this->load->view('home/includes/footer', $data);
	}
public function aboutus()
  {
          $data['title'] = 'About Us';
          $data['about'] = $this->App_model->list_about_literature();
          $data['vission'] = $this->App_model->list_vission();
          $data['aboutapp'] = $this->App_model->list_about_app();
          $data['mission'] = $this->App_model->list_mission();
          $data['strategicplan'] = $this->App_model->list_strategicplan();
          $data['values'] = $this->App_model->list_values();
          $data['objective'] = $this->App_model->list_objectives();
          $data['business'] = $this->App_model->list_our_business();
          $data['services'] = $this->App_model->list_our_services();
           $data['programs'] = $this->App_model->list_training_programs();
           $data['environment'] = $this->App_model->list_our_environment();
            
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/aboutus_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  public function blog()
  {
          $data['title'] = 'Blog';
          $data['news'] = $this->App_model->list_news();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/blog_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  public function vlog()
  {
          $data['title'] = 'Vlog';
           $data['videos'] = $this->App_model->list_videos();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/video_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  
  public function blogItem()
  {
          $data['title'] = 'Blog';
          $id = $this->uri->segment(3);
          $this->App_model->get_news_item($id);
          $data['news'] = $this->App_model->get_news_item($id);
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/blogdetail_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  public function contact()
  {
          $data['title'] = 'Contact';
          $data['objective'] = $this->App_model->list_our_contact();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/contact_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  public function portfolio()
  {
          $data['title'] = 'Gallery';
          $data['images'] = $this->App_model->list_slide();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/portfolio_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  public function products()
  {
          $data['title'] = 'Products';
          $data['products'] = $this->App_model->list_products();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/products_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  public function services()
  {
          $data['title'] = 'Services';
          $data['services'] = $this->App_model->list_services();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/services_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
  public function team()
  {
          $data['title'] = 'Team';
          $data['teammates'] = $this->App_model->list_teammates();
          $this->load->view('home/includes/header', $data);
          $this->load->view('home/team_view', $data);
          $this->load->view('home/includes/footer', $data);
  }
}

?>
