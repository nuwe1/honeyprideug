<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

	function __construct()
	{
		$this->load->database();
	}
// this function is for creating an account for the app	
	public function createAccount($data) {
			
			return $this->db->insert('admins', $data);
		}

		
		//this is the function for editing an account 
		public function UpdateAccount($data,$id) {
			$this->db->where('user_id', $id);
			
			return $this->db->update('admins', $data);
			
		}
		// this is the function that updates the story
		public function update_story($data,$id) {
			$this->db->where('id', $id);
			
			return $this->db->update('success_stories', $data);
			
		}
		//this is the funtion that updates the password
		public function update_password($data,$id) {
			$this->db->where('admin_id', $id);
			
			return $this->db->update('admins', $data);
			
		}
		
		
// Verifying whether the password and phone number are correct		
	public function details_verification($email, $password) {
	    $this->db->select('admin_id,admin_fullname, admin_email, admin_password,admin_pic');
	    $this->db->from('admins');
	    $this->db->where('admin_email', $email);
	    $this->db->where('admin_password', sha1($password));
	    $this->db->limit(1);

	     $query = $this->db->get();

// Query and return the result row
	   if($query->num_rows() > 0){
		   return $query->row();
	    }else{
	     return NULL;
	    }

	   
	}


	public function details_verificate($email, $password) {
	    $this->db->select('admin_id,admin_fullname, admin_email, admin_password,admin_pic');
	    $this->db->from('admins');
	    $this->db->where('admin_email', $email);
	    $this->db->where('admin_password', $password);
	    $this->db->limit(1);

	     $query = $this->db->get();

// Query and return the result row
	   if($query->num_rows() > 0){
		   return $query->row();
	    }else{
	     return NULL;
	    }

	   
	}
	// this is the function for listing the partners
	public function list_partners($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('partners');
			return $query->result_array();
		}

	
	}

// this is the function for listing the news 
	public function list_news($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('u_news');
			return $query->result_array();
		}

	
	}
// this is the function for listing the videos 
	public function list_videos($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('videos');
			return $query->result_array();
		}

	
	}

// this is the function for listing the sucess stories


	public function list_sucessstory($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('success_stories');
			return $query->result_array();
		}

		$query = $this->db->get_where('success_stories', array('id' => $id));
		return $query->row_array();
	}
	// this is the function for listing the sucess stories 
	public function list_products($id = FALSE){
		if($id === FALSE)
		{
			$this->db->select('s.product_id , s.name, s.image, s.description, s.dateadded, m.admin_fullname',false);
			$this->db->from('products as s');
			$this->db->order_by('product_id', 'DESC');
			$this->db->join('admins as m', 'm.admin_id = s.added_by');
			$query = $this->db->get();
			return $query->result_array();
		}

		
	}

	// this is the function for listing the services 
	public function list_services($id = FALSE){
		if($id === FALSE)
		{
			$this->db->select('s.service_id , s.name, s.image, s.caption, s.description, s.dateadded, m.admin_fullname',false);
			$this->db->from('services as s');
			$this->db->order_by('service_id', 'DESC');
			$this->db->join('admins as m', 'm.admin_id = s.added_by');
			$query = $this->db->get();
			return $query->result_array();
		}

		
	}
	// this is the function for listing the team members 
	public function list_teammates($id = FALSE){
		if($id === FALSE)
		{
			$this->db->select('s.team_id , s.name, s.image, s.contact,s.role, s.description, s.dateadded, m.admin_fullname',false);
			$this->db->from('team as s');
			$this->db->order_by('team_id', 'DESC');
			$this->db->join('admins as m', 'm.admin_id = s.added_by');
			$query = $this->db->get();
			return $query->result_array();
		}

		
	}
// this is the function to list the attachments
	public function list_attachent($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('general_attachments');
			return $query->result_array();
		}

		$query = $this->db->get_where('general_attachments', array('id' => $id));
		return $query->row_array();
	}
	// this the function that list locations
	public function list_locations($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('location_id', 'DESC');
			$query = $this->db->get('fida_locations');
			return $query->result_array();
		}

		$query = $this->db->get_where('fida_locations', array('location_id' => $id));
		return $query->row_array();
	}
	//this is the function that list clients
	public function list_clients($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('clients_registered');
			return $query->result_array();
		}

		$query = $this->db->get_where('clients_registered', array('id' => $id));
		return $query->row_array();
	}
//this is the function that lists the feedback	
	public function list_feedback($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('feedback');
			return $query->result_array();
		}

		$query = $this->db->get_where('feedback', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list feed back ques
	public function list_feedbackques($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('feedback_questions');
			return $query->result_array();
		}

		$query = $this->db->get_where('feedback_questions', array('id' => $id));
		return $query->row_array();
	}
	//this is the function that allows the user to list the slide
	public function list_slide($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('slides');
			return $query->result_array();
		}

		$query = $this->db->get_where('slides', array('id' => $id));
		return $query->row_array();
	}
	// this is the function list the users
	public function list_users($id = FALSE){
		if($id === FALSE)
		{
			$this->db->order_by('admin_id', 'DESC');
			$query = $this->db->get('admins');
			return $query->result_array();
		}

		$query = $this->db->get_where('admins', array('admin_id' => $id));
		return $query->row_array();
	}
	
	// this is adding news
	public function add_new($data){
		
			return $this->db->insert('u_news', $data);

	}
// this is the delete
	public function delete_news($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('u_news');
			return true;
		}
		// this is the delete
	public function delete_video($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('videos');
			return true;
		}

// this is  the function that allows the user to add users
	public function add_user($data){
		 $this->db->insert('admins', $data);
	}
	//this is the function that allows the user to add slide images
	 public function add_slideimage($data){
		 $this->db->insert('slides', $data);
	}
// this is the function that allows the user to add the story
	public function add_story($data){
		 $this->db->insert('success_stories', $data);
	}
// this is a function that allows the user to add locations	
	public function add_location($data){
		 $this->db->insert('fida_locations', $data);
	}
// this is the function that allows the user to add the general file
	public function add_generalfile($data){
		 $this->db->insert('general_attachments', $data);
	}
	// this is to add a partner
	public function add_partners($data){
		 $this->db->insert('partners', $data);
	}
	// this is a function that allows the user to add products
	public function add_product($data){
		 $this->db->insert('products', $data);
	}
	// this is a function that allows the services
	public function add_service($data){
		 $this->db->insert('services', $data);
	}
	// this is a function that allows the teammates
	public function add_teammate($data){
		 $this->db->insert('team', $data);
	}

	// this is a function that allows the user to add partners
	public function add_partner($data){
		 $id =6;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is a function that allows the user to add business
	public function add_business($data){
		 $id =14;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is a function that allows the user to add a services
	public function add_services($data){
		 $id =15;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}

	// this is a function that allows the user to add a training program
	public function add_training_program($data){
		 $id =16;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	//this is the function that allows the user to add vission
	public function add_vission($data){
		$id =1;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that allows the user to add the luganda version of the vission
	public function add_our_dream($data){
		$id =10;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that allows the user to add our contact
	public function add_our_contact($data){
		$id =11;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that allows the user to add mission
	public function add_mission($data){
		 $id =2;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the funtion that allows the user to add mission in luganda
	public function add_our_environment($data){
		 $id =9;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that adds the values
	public function add_values($data){
		 $id =3;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	//this is the function that adds the values in  luganda
	public function add_values_luganda($data){
		 $id =16;
		 $this->db->where('id', $id);
		 return $this->db->update('about_fida', $data);
	}
	// this is the function that allows the user to add the strategic plan
	public function add_strategicplan($data){
		 $id =4;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that allows the user to add the strategic plan in luganda
	public function add_strategicplan_luganda($data){
		 $id =15;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the funtion that adds words of the ceo
	public function add_wordsbyceo($data){
		$id =5;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that adds the words of the ceo in luganda
	public function add_wordsbyceo_luganda($data){
		$id =14;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the funtion that allows the user to add about app data
	public function add_about_app($data){
		$id =8;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that allows the user to add the about app in luganda
	public function add_about_app_luganda($data){
		$id =13;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	// this is the function that allows the user to add the about literature
	public function add_about_literature($data){
		$id =13;
		 $this->db->where('id', $id);
		return $this->db->update('about_fida', $data);
	}
	
	// this is the function that adds the maintenance literature
	public function add_maintenance_literature($data){
		$id =1;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	//this is the function that adds the maintenance literature in luganda
	public function add_maintenance_literature_luganda($data){
		$id =7;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds the  family literature
	public function add_family_literature($data){
		$id =2;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds the family literature in luganda
	public function add_family_literature_luganda($data){
		$id =8;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds the property literature
	public function add_property_literature($data){
		$id =3;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds property literature in luganda
	public function add_property_literature_luganda($data){
		$id =9;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds gbv literature
	public function add_gbv_literature($data){
		$id =4;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds the gbv literature in luganda
	public function add_gbv_literature_luganda($data){
		$id =10;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
// this is the function that adds referal literature
	public function add_referals_literature($data){
		$id =5;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds the referals literature in luganda
	public function add_referals_literature_luganda($data){
		$id =11;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	// this is the function that adds the court process literature
	public function add_court_process_literature($data){
		$id =6;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	//this is funtion adds the court process literature
	public function add_court_process_literature_luganda($data){
		$id =12;
		 $this->db->where('literature_id', $id);
		return $this->db->update('db_literature', $data);
	}
	//this is the function tha adds maintanance steps
	public function add_maintenance_steps($data){
		$this->db->insert('db_steps', $data);
	}
	// this is the fucntion that adds the family steps
	public function add_family_steps($data){
		$this->db->insert('db_steps', $data);
	}
	// this is the add property steps function
	public function add_property_steps($data){
		$this->db->insert('db_steps', $data);
	}
	// this is the add gbv steps function
	public function add_gbv_steps($data){
		$this->db->insert('db_steps', $data);
	}
	//this is the function that adds referal steps
	public function add_referals_steps($data){
		$this->db->insert('db_steps', $data);
	}
	// this is the add court processes steps function
	public function add_court_processes_steps($data){
		$this->db->insert('db_steps', $data);
	}
	// this is the add maintenance menu function
	public function add_maintenace_menu($data){
		$this->db->insert('db_menu', $data);
	}
	// this is the function that adds family menu
	public function add_family_menu($data){
		$this->db->insert('db_menu', $data);
	}
	// this is the function that adds the property menu
	public function add_property_menu($data){
		$this->db->insert('db_menu', $data);
	}
	// this is the function that adds the gbv menu 
	public function add_gbv_menu($data){
		$this->db->insert('db_menu', $data);
	}
	//this is the function that adds referal menu
	public function add_referals_menu($data){
		$this->db->insert('db_menu', $data);
	}
	// this is the function that adds the court processes menu
	public function add_court_processes_menu($data){
		$this->db->insert('db_menu', $data);
	}
	//this is the function that adds the feedback ques
	public function add_feedbackques($data){
		$this->db->insert('feedback_questions', $data);
	}
	// this is the function that list the maintenance literature
	public function list_maintenace_literature(){
      $id =1;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the function that list the maintance literature in luganda
	public function list_maintenace_literature_luganda(){
      $id =7;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this  is the function that list the family literature 
	public function list_family_literature(){
      $id =2;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this  is the function that lists the famiily literature in luganda
	public function list_family_literature_luganda(){
      $id =8;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the function that lists property 
	public function list_property_literature(){
      $id =3;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	 // this  is the function that list the property literature in luganda
	public function list_property_literature_luganda(){
      $id =9;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the functiont that list the gbv literature 
	public function list_gbv_literature(){
      $id =4;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the function that lists the gbv literature in luganda
	public function list_gbv_literature_luganda(){
      $id =10;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	//this is the function that list the referals literature
	public function list_referals_literature(){
      $id =5;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the function that list the referals literature in luganda
	public function list_referals_literature_luganda(){
      $id =11;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the function that lists court processes literature
	public function list_court_processes_literature(){
      $id =6;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the function that lists the court processes literature in luganda
	public function list_court_processes_literature_luganda(){
      $id =12;
		$query = $this->db->get_where('db_literature', array('literature_id' => $id));
		return $query->row_array();
	}
	// this is the function that lists the maintenance steps
	public function list_maintenace_steps($id = FALSE){
      $type ='maintenance';
		$query = $this->db->get_where('db_steps', array('step_language' => $type));
		return $query->result_array();
	}
	// this is the function that adds family steps
	public function list_family_steps($id = FALSE){
      $type ='family';
		$query = $this->db->get_where('db_steps', array('step_language' => $type));
		return $query->result_array();
	}
	// this is the function that list property steps
	public function list_property_steps($id = FALSE){

         $type ='property';
		$query = $this->db->get_where('db_steps', array('step_language' => $type));
		return $query->result_array();
	}
	// this is the function that lists gbv steps
	public function list_gbv_steps($id = FALSE){
      $type ='gbv';
		$query = $this->db->get_where('db_steps', array('step_language' => $type));
		return $query->result_array();
	}
	// this is the fucntion that list referal steps
	public function list_referals_steps($id = FALSE){
      $type ='referrals';
		$query = $this->db->get_where('db_steps', array('step_language' => $type));
		return $query->result_array();
	}
	// this is the funtion that lists court processes steps
	public function list_court_processes_steps($id = FALSE){
      $type ='court';
		$query = $this->db->get_where('db_steps', array('step_language' => $type));
		return $query->result_array();
	}
	// this is the function that list the maintenance menu
	public function list_maintenace_menu($id = FALSE){
      $type ='maintenance';
		$query = $this->db->get_where('db_menu', array('menu_language' => $type));
		return $query->result_array();
	}
	// this is the function that lists the family menu
	public function list_family_menu($id = FALSE){
      $type ='family';
		$query = $this->db->get_where('db_menu', array('menu_language' => $type));
		return $query->result_array();
	}
	// this is the function that lists property menu
	public function list_property_menu($id = FALSE){
      $type ='property';
		$query = $this->db->get_where('db_menu', array('menu_language' => $type));
		return $query->result_array();
	}
	// this is the function that lists the gbv menu
	public function list_gbv_menu($id = FALSE){
      $type ='gbv';
		$query = $this->db->get_where('db_menu', array('menu_language' => $type));
		return $query->result_array();
	}
	// this function that list the menu
	public function list_referals_menu($id = FALSE){
      $type ='referrals';
		$query = $this->db->get_where('db_menu', array('menu_language' => $type));
		return $query->result_array();
	}
	// this is the function that list the court processes menu
	public function list_court_processes_menu($id = FALSE){
      $type ='court';
		$query = $this->db->get_where('db_menu', array('menu_language' => $type));
		return $query->result_array();
	}
	// this is the function that list vissions
	public function list_vission(){
      $id =1;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that lists our dream
	public function list_our_dream(){
      $id =10;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that lists our contact
	public function list_our_contact(){
      $id =11;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list the mission
    public function list_mission(){
      $id =2;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list our dream
	public function list_our_environment(){
      $id =9;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that lists the values
	public function list_values(){
      $id =3;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that lists the values in luganda
	public function list_values_luganda(){
      $id =16;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	//this is the function that lists strategic plan
	public function list_strategicplan(){
      $id =4;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list the strategic plan in luganda
	public function list_strategicplan_luganda(){
      $id =15;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list the words of the ceo
	public function list_wordsbyceo(){
      $id =5;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list the words of the ceo in luganda
	public function list_wordsbyceo_luganda(){
      $id =14;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list the about app information
	public function list_about_app(){
      $id =8;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that lists the about app in luganda
	public function list_about_app_luganda(){
      $id =13;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	// this is the function that list the about literature
	public function list_about_literature(){
      $id =13;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	
	// this is the function that list the objectives
	public function list_objectives($id = FALSE){
		$id =6;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	
	// this is the function that list the our business
	public function list_our_business($id = FALSE){
		$id =14;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}
	
	// this is the function that list the our services
	public function list_our_services($id = FALSE){
		$id =15;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}

// this is the function that list the our services
	public function list_training_programs($id = FALSE){
		$id =16;
		$query = $this->db->get_where('about_fida', array('id' => $id));
		return $query->row_array();
	}

// this is the function that list the times
    public function list_times(){
      
		$query = $this->db->get('settings');
		return $query->row_array();
	}
//this is the function that adds the news
	public function add_news($data){
		 $this->db->insert('success_stories', $data);
	}
	//this is the function that adds the videos
	public function add_video($data){
		 $this->db->insert('videos', $data);
	}
	//this the fucntion that gets the menu item
	public function get_menu_item($id){
		

		$query = $this->db->get_where('db_menu', array('menu_id' => $id));
		return $query->row_array();
	
	}
	// this is the function for showing the available drugs in the pharmarcy that was selected
	public function get_news_item($id){
		

		$query = $this->db->get_where('u_news', array('id' => $id));
		return $query->row_array();
	
	}
	public function get_video_item($id){
		

		$query = $this->db->get_where('videos', array('id' => $id));
		return $query->row_array();
	
	}
	// this is a function for editing the news item
	public function edit_news_item($data, $id){

			$this->db->where('id', $id);
			
			return $this->db->update('u_news', $data);

	}
	public function edit_video_item($data, $id){

			$this->db->where('id', $id);
			
			return $this->db->update('videos', $data);

	}
// this is a function for editing the news item
	
	public function edit_user_item($data, $id){

			$this->db->where('admin_id', $id);
			
			return $this->db->update('admins', $data);

	}
	// this  is the function that allows the user to edit the menu
	public function edit_menu_item($data, $id){

			$this->db->where('menu_id', $id);
			
			return $this->db->update('db_menu', $data);

	}
	// this is the function that update times
	public function update_times($data){

			
			
			return $this->db->update('settings', $data);

	}
	
	// this is the delete
	// this is the function that deletes the user
	public function delete_user($id)
		{
			$this->db->where('admin_id', $id);
			$this->db->delete('admins');
			return true;
		}
		// this is the function that deletes the slide images
	public function delete_slide_image($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('slides');
			return true;
		}
		// this is the function that deletes the feedback question
		public function delete_feedback_question($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('feedback_questions');
			return true;
		}
	// this is the function that deletest the sucess story	
	public function delete_sucessstory($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('success_stories');
			return true;
		}
// this is the function that deletes the location		
		public function delete_location($id)
		{
			$this->db->where('location_id', $id);
			$this->db->delete('fida_locations');
			return true;
		}
		// this is the fucntion that deletes the product files
		public function delete_product($id)
		{
			$this->db->where('product_id', $id);
			$this->db->delete('products');
			return true;
		}
		// this is the fucntion that deletes the product files
		public function delete_services($id)
		{
			$this->db->where('service_id', $id);
			$this->db->delete('services');
			return true;
		}
		// this is the function allows you to delete teammates
		public function delete_teammate($id)
		{
			$this->db->where('team_id', $id);
			$this->db->delete('team');
			return true;
		}
		
		//this is the function that delets the partner
		public function delete_partner($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('partners');
			return true;
		}
		//this is the function that deletes the property
		public function delete_property_step($id)
		{
			$this->db->where('step_id', $id);
			$this->db->delete('db_steps');
			return true;
		}
		//this is the function that deletes the property menu
		public function delete_property_menu($id)
		{
			$this->db->where('menu_id', $id);
			$this->db->delete('db_menu');
			return true;
		}
		// this is the function that deletes the maintance step
		public function delete_maintenance_step($id)
		{
			$this->db->where('step_id', $id);
			$this->db->delete('db_steps');
			return true;
		}
		//this is the function that deletes the maintence menu
		public function delete_maintenance_menu($id)
		{
			$this->db->where('menu_id', $id);
			$this->db->delete('db_menu');
			return true;
		}
		// this is the function that deletes the family steps
		
		public function delete_family_step($id)
		{
			$this->db->where('step_id', $id);
			$this->db->delete('db_steps');
			return true;
		}
		//this is the function that deletes the family
		public function delete_family_menu($id)
		{
			$this->db->where('menu_id', $id);
			$this->db->delete('db_menu');
			return true;
		}
		//this is the function that deletes the gbv steps
		public function delete_gbv_step($id)
		{
			$this->db->where('step_id', $id);
			$this->db->delete('db_steps');
			return true;
		}
		//this is the function that deletes the gbv menu
		public function delete_gbv_menu($id)
		{
			$this->db->where('menu_id', $id);
			$this->db->delete('db_menu');
			return true;
		}
		//this is the function that deletes the referal steps
		public function delete_referals_step($id)
		{
			$this->db->where('step_id', $id);
			$this->db->delete('db_steps');
			return true;
		}
		//this is the function that deletes the referal menu
		public function delete_referal_menu($id)
		{
			$this->db->where('menu_id', $id);
			$this->db->delete('db_menu');
			return true;
		}
		//this is the funtion that deletes the court processes
		public function delete_court_processes_step($id)
		{
			$this->db->where('step_id', $id);
			$this->db->delete('db_steps');
			return true;
		}
// this is the function that deletes the court processes menu
		
		public function delete_court_processes_menu($id)
		{
			$this->db->where('menu_id', $id);
			$this->db->delete('db_menu');
			return true;
		}
		//this is the delete attachment
		public function delete_attachment($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('general_attachments');
			return true;
		}
		
		// this is the get sucess story item
		public function get_successstory_item($id)
		{
		$query = $this->db->get_where('success_stories', array('id' => $id));
		return $query->row_array();
			
		}
// this is the function that counts about stat		
		public function total_aboutsstats()
         {
       $query = $this->db->query("SELECT COUNT(*) as aboutotal FROM page_stats WHERE page = 'about'");
       return $query->row_array();
        }
        //this is the function that counts the maintanance stat
     public function total_maintenancestats()
         {
       $query = $this->db->query("SELECT COUNT(*) as maintotal FROM page_stats WHERE page = 'maintenance'");
       return $query->row_array();
        }
        // this is the function total family stats
        public function total_familystats()
         {
       $query = $this->db->query("SELECT COUNT(*) as famtotal FROM page_stats WHERE page = 'family'");
       return $query->row_array();
        }
        // this is the function that counts the property stats
        public function total_propertystats()
         {
       $query = $this->db->query("SELECT COUNT(*) as proptotal FROM page_stats WHERE page = 'property'");
       return $query->row_array();
        }
        //this is the function that counts the gbv stats
        public function total_gbvsstats()
         {
       $query = $this->db->query("SELECT COUNT(*) as gbvtotal FROM page_stats WHERE page = 'gbv'");
       return $query->row_array();
        }
        //this is the function that counts the referal stats
        public function total_referalstats()
         {
       $query = $this->db->query("SELECT COUNT(*) as reftotal FROM page_stats WHERE page = 'referrals'");
       return $query->row_array();
        }
        // this is the function that counts the court statistics
        public function total_courtstats()
         {
       $query = $this->db->query("SELECT COUNT(*) as courtotal FROM page_stats WHERE page = 'court'");
       return $query->row_array();
        }
        //this is the function that counts the success story statistics
        public function total_successstats()
         {
       $query = $this->db->query("SELECT COUNT(*) as storytotal FROM page_stats WHERE page = 'stories'");
       return $query->row_array();
        }
        //this is the function that counts the clients registered with age below 18
        public function total_one()
         {
       $query = $this->db->query("SELECT COUNT(*) as one FROM clients_registered WHERE age = 'Below 18'");
       return $query->row_array();
        }
        // this is the function that counts the clients registered with age 19-30

 public function total_two()
         {
       $query = $this->db->query("SELECT COUNT(*) as two FROM clients_registered WHERE age = '19-34' ");
       return $query->row_array();
        }
// this is the function that counts the clients registered with 35-50
 public function total_three()
         {
       $query = $this->db->query("SELECT COUNT(*) as three FROM clients_registered WHERE age = '35-50'");
       return $query->row_array();
        }
        // this is the fucntion that counts the clients registered with 50

 public function total_four()
         {
       $query = $this->db->query("SELECT COUNT(*) as four FROM clients_registered WHERE age = 'Above 50'");
       return $query->row_array();
        }


}