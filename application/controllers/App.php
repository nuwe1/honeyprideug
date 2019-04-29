<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
  // public function __construct()
  //   {

  //       parent::__construct();

  //      if (!$this->session->userdata['logged_in']['name'])
  //      {
            
  //           redirect('App'); //if session is not there, redirect to login page
  //      }   

  //  }
//this the index page where the user is presented with the login page
	public function index()
	{
          $data['title'] = 'Login';
          $this->load->view('app/index', $data);
	}
  // this is a function that enables the user to create another user
  public function signup()
  {
          $data['title'] = 'Login';
          
          $this->form_validation->set_rules('fullname',  'Full Name',   'trim|required');
          $this->form_validation->set_rules('email',      'Email',        'trim|required|is_unique[users.user_email]');
          $this->form_validation->set_rules('password',   'Password',     'trim|required');
         
   
      if ($this->form_validation->run() === FALSE ) {
         $this->session->set_flashdata("error","please Enter all fields");
      }
      else {
        $status = 'admin';
        $data = array(
        'admin_fullname'   => $this->input->post('fullname'),
        'admin_email' => $this->input->post('email'),
        'admin_username'    =>  $this->input->post('username'),
        'admin_password'=> sha1($this->input->post('password')),
        'admin_pic'    =>  $this->input->post('pic'),
        'admin_status'    =>  $status
      );
        $this->App_model->createAccount($data);

        redirect('App/', 'refresh');
        $this->session->set_flashdata("success","Sucessful registered you can now log in");
      }
  }
// the login function is called when the user submits the records they have entered in the 
// login page
  public function login()
  {
          $data['title'] = 'Login';
          $this->form_validation->set_rules('password',  'password', 'trim|required');
    if($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata("error","please Enter all fields");
       $this->load->view('app/index', $data);
     
    }
    else {
     $check_database = $this->check_database();

      //Go to dashboard page if the login details are available in the database
     if ($check_database == TRUE){
      redirect('App/About', 'refresh');
     }else{
      
        $this->load->view('app/index', $data);
     }
      
    }
  }
  //this fnction is invoked by the login function and the function checks the database for the detials that the user submited in the form
    public function check_database() {
     
        $this->load->library('session');

        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        //query the database
        $result  = $this->App_model->details_verification($email, $password);

      if($result) {
    

          $sess_array = array(
            'id' => $result->admin_id, 
             'email' => $result->admin_email,
            'name' => $result->admin_fullname,
            'image' => $result->admin_pic,
            'pass' => $result->admin_password

           );
        $this->session->set_userdata('logged_in', $sess_array);

          return TRUE;
      } else {
         $this->session->set_flashdata("error","Invalid email or  password");
     $this->form_validation->set_message('check_database', 'Invalid email or password');
     return false;
      }

    }
    //this funtion is used to update the session
    public function update_session(){
      $this->load->library('session');
     $email      = $this->session->userdata['logged_in']['email'] ;
        $password   = $this->session->userdata['logged_in']['pass'] ;
        //query the database
        $result  = $this->App_model->details_verificate($email, $password);

      if($result) {
    

          $sess_array = array(
            'id' => $result->admin_id, 
             'email' => $result->admin_email,
            'name' => $result->admin_fullname,
            'image' => $result->admin_pic,
            'pass' => $result->admin_password

           );
        $this->session->set_userdata('logged_in', $sess_array);

          return TRUE;
      } else {
         $this->session->set_flashdata("error","Something went wrong try logging out and then in again");
    
     return false;
      } 
    }
    // this function is used to update the name of the user in the profile [age]
    public function update_name()
  {
      $data['title'] = 'Update Name';
      $data['user'] = $this->session->userdata['logged_in']['name'] ;
      $data['image'] = $this->session->userdata['logged_in']['image'] ;
      $data['users'] = $this->App_model->list_users();

      $this->form_validation->set_rules('fullname',  'Name', 'trim|required');
    if($this->form_validation->run() === FALSE) {
      
      
      $this->session->set_flashdata("error","please Enter all fields");
      redirect('App/profile');
    }
    else {
     $check_password = $this->check_password();

      //Go to private area
     if ($check_password == TRUE){

      $data = array(
        'admin_fullname' =>$this->input->post('fullname')
        
         );

      $id = $this->session->userdata['logged_in']['id'];

      $this->App_model->update_password($data,$id);

      $this->session->set_flashdata("error", "the name  has sucessfully been updated please logout to effect the changes");
      $this->update_session();
      redirect('App/profile');
     }else{
      $this->session->set_flashdata("error", "the password is wrong");
 
     redirect('App/profile'); 
     }
      
    }
  }


// this is function is used to updatet the password of the currently logged in user
public function update_details()
  {
      $data['title'] = 'Update password';
      $data['user'] = $this->session->userdata['logged_in']['name'] ;
      $data['image'] = $this->session->userdata['logged_in']['image'] ;
      $data['users'] = $this->App_model->list_users();

      $this->form_validation->set_rules('password',  'password', 'trim|required');
    if($this->form_validation->run() === FALSE) {
      
      
      $this->session->set_flashdata("error","please Enter all fields");
      redirect('App/profile');
    }
    else {
     $check_password = $this->check_password();

      //Go to private area
     if ($check_password == TRUE){

      $data = array(
       
        'admin_password' =>sha1($this->input->post('newpassword')) 
         );

      $id = $this->session->userdata['logged_in']['id'];

      $this->App_model->update_password($data,$id);

      $this->session->set_flashdata("error", "the password  has sucessfully been updated please logout to effect the changes");
      
      redirect('App/logout');
     }else{
      $this->session->set_flashdata("error", "the password is wrong");
 
     redirect('App/profile'); 
     }
      
    }
  }
// this  function checks the database to verify if the password is wrong or not 
 public function check_password() {
     
        $this->load->library('session');

        $email      = $this->session->userdata['logged_in']['email'];
        $password   = $this->input->post('password');
        $username   = $this->input->post('fullname');
        //query the database
        $result  = $this->App_model->details_verification($email, $password);

      if($result) {
    

          
          return TRUE;
      } else {
     $this->form_validation->set_message('check_database', 'The current password is wrong');
     return false;
      }
    }

 //the profile funtion displays the profile page where the user can change their details    
public function profile() {
  $data['title'] = 'Edit Details ';
  $data['user'] = $this->session->userdata['logged_in']['name'] ;
  $data['image'] = $this->session->userdata['logged_in']['image'];
  $data['email'] = $this->session->userdata['logged_in']['email'];
 
 $data['users'] = $this->App_model->list_users();
  
  $this->load->view('app/includes/header', $data);
  $this->load->view('app/includes/menu', $data);
  $this->load->view('app/profile', $data);
  }
  //this fnction is used to delete the user from the database
     public function delete_user($id)
  {
    $this->App_model->delete_user($id);
    redirect('App/profile/');
  }
  // this is the function that handles what the user has input in the profile page
  public function profile_submission()
     {   
          $data['title'] = 'Add user';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
         $data['image'] = $this->session->userdata['logged_in']['image'] ;
         $data['email'] = $this->session->userdata['logged_in']['email'] ;
          
          
              
          $this->form_validation->set_rules('name', 'Name', 'required');
          
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
         $this->load->view('app/includes/header', $data);
         $this->load->view('app/includes/menu', $data);
         $this->load->view('app/profile', $data);
   }else{
     
      $data = array(
              'admin_fullname' => $this->input->post('name'),
              'admin_email'=> $this->input->post('email'),
              'admin_password'=> sha1($this->input->post('password'))
              
              
      );

    
    $this->App_model->add_user($data);
    redirect('App/profile/');
     }
     
}
// this is the function that is used to edit the profile picture of the user
public function edit_users_picture()
{   
  $data['title'] = 'Edit photo';
  $data['user'] = $this->session->userdata['logged_in']['name'] ;
  $data['image'] = $this->session->userdata['logged_in']['image'] ;
  $data['email'] = $this->session->userdata['logged_in']['email'] ;
  $now = new DateTime();
  $now->setTimezone(new DateTimezone('Asia/Kolkata'));


      $config = array(
      'upload_path' => "./assets/images/admins/",
      'file_name' => "admin_".$now->format('YmdHis'),
      'allowed_types' => "gif|jpg|png|jpeg",
      'overwrite' => TRUE,
      //'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
      //'max_height' => "1000",
      //'max_width' => "1000"
      );

      $img = "image"; // input name="img"
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

                    if(!$this->upload->do_upload($img))
                    {

                    $this->session->set_flashdata("error", $this->upload->display_errors());
                    $data['error'] = $this->upload->display_errors();
                    $this->load->view('app/includes/header', $data);
                    $this->load->view('app/includes/menu', $data);
                    $this->load->view('app/profile', $data);

                    }else{
                    $data['message'] = $this->upload->data();
                    $picture = $data['message']['file_name'];

                    $data = array(
                    'admin_pic' => $picture,

                    );

                    $id = $this->session->userdata['logged_in']['id'];
  
                    $this->App_model->edit_user_item($data,$id);
                    $this->update_session();
                    $this->session->set_flashdata("error", "the image has sucessfully been updated ");
     
                    redirect('App/profile/');


                    }

       
  }
  //this is the function that is used to displa a tabulated list of the sucess stories from the database
      public function sucess_story()
     {
          $data['title'] = 'Sucess story';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['story'] = $this->App_model->list_sucessstory();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/sucessstories_view', $data);
     }
//this is a function  that is used to add a success story
      public function sucessstory_add()
     {   
          $data['title'] = 'Add sucess story';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/sucessstory_add', $data);
     }
// this is a success story  function that is used to handle the sucess story details that have been submitted by the sucess story     
      public function sucessstory_submition()
     {   
         $data['title'] = 'Add sucess story';
         $data['user'] = $this->session->userdata['logged_in']['name'] ;
         $data['image'] = $this->session->userdata['logged_in']['image'] ;
        $this->form_validation->set_rules('name', 'name', 'required');

    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/sucessstory_add', $data);
   }else{
     
        
            
      $data = array(
              'name' => $this->input->post('name'),
              'title' => $this->input->post('title'),
              'content'=>$this->input->post('content'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' => $this->session->userdata['logged_in']['id'] 
              
              
      );

    $this->App_model->add_story($data);
    redirect('App/sucess_story/');
     }
  
}
// the delete success story is used to take in the id and delete the story
      public function delete_sucessstory($id)
  {
    $this->App_model->delete_sucessstory($id);
    redirect('App/sucess_story/');
  }
//the edit sucess story function that displays the edit page for the success story
     public function edit_sucessstory()
     {   
          $data['title'] = 'Edit Sucess story';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $id = $this->uri->segment(3);
          $this->App_model->get_successstory_item($id);
          $data['story'] = $this->App_model->get_successstory_item($id);
          
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/successstory_edit', $data);
     }
 //the success story edit submission fucntion is used to submit the sucess story details that has been changed    
public function sucessstoryedit_submition()
     {   
          $data['title'] = 'Edit Sucess story';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         $id = $this->uri->segment(3);
          $this->App_model->get_successstory_item($id);
          $data['story'] = $this->App_model->get_successstory_item($id);
           $this->form_validation->set_rules('name', 'name', 'required');
           
 if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/successstory_edit', $data);
   }else{
     
      
      $data = array(
               'name' => $this->input->post('name'),
              'title' => $this->input->post('title'),
              'content'=>$this->input->post('content') ,
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' => $this->session->userdata['logged_in']['id'] 
              
              
      );

    $this->App_model->update_story($data,$id);

      redirect('App/sucess_story/');
     }

   } 
//the files function is used to show products
    public function products()
     {
          $data['title'] = 'Products';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['products'] = $this->App_model->list_products();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/products_view', $data);
     }
 // the files add function allows one to add products   
      public function products_add()
     {   
          $data['title'] = 'Add Products';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['story'] = $this->App_model->list_sucessstory();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/product_add', $data);
     }
//this is the function that handles the submission to the database
         public function products_submition()
     {   
          $data['title'] = 'Add Products';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->form_validation->set_rules('name', 'name', 'required');
          $now = new DateTime();
         $now->setTimezone(new DateTimezone('Asia/Kolkata'));
         
      $config = array(
      'upload_path' => "./assets/images/products/",
      'file_name' => "product_".$now->format('YmdHis'),
      'allowed_types' => "*",
      'overwrite' => TRUE,
      //'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
      //'max_height' => "1000",
      //'max_width' => "1000"
      );
      $img = "file"; // input name="img"
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

        if(!$this->upload->do_upload($img)){

          $this->session->set_flashdata("error", $this->upload->display_errors());
          $data['error'] = $this->upload->display_errors();
                    
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/product_add', $data); 

        } else{
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/product_add', $data);
   }else{
     
                    $data['message'] = $this->upload->data();
                    $file = $data['message']['file_name'];
                    

            
      $data = array(
              'name' => $this->input->post('name'),
              'description'=>$this->input->post('en_description') ,
              'image' => $file,
              'dateadded' => date('Y-m-d h:i:s'),
              'added_by' => $this->session->userdata['logged_in']['id'] 
              
              
      );

    $this->App_model->add_product($data);
    redirect('App/products/');
     }
     
}
}
//this function is used to delete the products 
     public function delete_product($id)
  {
    $this->App_model->delete_product($id);
    redirect('App/products/');
  }

//the files function is used to show services
    public function services()
     {
          $data['title'] = 'Services';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['services'] = $this->App_model->list_services();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/services_view', $data);
     }
 // the files add function allows one to add products   
      public function services_add()
     {   
          $data['title'] = 'Add Services';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['story'] = $this->App_model->list_sucessstory();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/services_add', $data);
     }
//this is the function that handles the submission to the database
         public function services_submition()
     {   
          $data['title'] = 'Add Services';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->form_validation->set_rules('name', 'name', 'required');
          $now = new DateTime();
         $now->setTimezone(new DateTimezone('Asia/Kolkata'));
         
      $config = array(
      'upload_path' => "./assets/images/services/",
      'file_name' => "service_".$now->format('YmdHis'),
      'allowed_types' => "*",
      'overwrite' => TRUE,
      //'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
      //'max_height' => "1000",
      //'max_width' => "1000"
      );
      $img = "file"; // input name="img"
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

        if(!$this->upload->do_upload($img)){

          $this->session->set_flashdata("error", $this->upload->display_errors());
          $data['error'] = $this->upload->display_errors();
                    
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/services_add', $data); 

        } else{
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/services_add', $data);
   }else{
     
                    $data['message'] = $this->upload->data();
                    $file = $data['message']['file_name'];
                    

            
      $data = array(
              'name' => $this->input->post('name'),
              'description'=>$this->input->post('en_description') ,
              'image' => $file,
              'caption' => $this->input->post('caption'),
              'dateadded' => date('Y-m-d h:i:s'),
              'added_by' => $this->session->userdata['logged_in']['id'] 
              
              
      );

    $this->App_model->add_service($data);
    redirect('App/services/');
     }
     
}
}
//this function is used to delete the files 
     public function delete_services($id)
  {
    $this->App_model->delete_services($id);
    redirect('App/services/');
  }

//the files function is used to show services
    public function team()
     {
          $data['title'] = 'Team';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['teammates'] = $this->App_model->list_teammates();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/teammembers_view', $data);
        }
      // the files add function allows one to add products   
      public function team_add()
     {   
          $data['title'] = 'Add Team member';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['story'] = $this->App_model->list_sucessstory();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/teammember_add', $data);
     }
//this is the function that handles the submission to the database
         public function team_submition()
     {   
          $data['title'] = 'Add Team member';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->form_validation->set_rules('name', 'name', 'required');
          $now = new DateTime();
         $now->setTimezone(new DateTimezone('Asia/Kolkata'));
         
      $config = array(
      'upload_path' => "./assets/images/team/",
      'file_name' => "team_".$now->format('YmdHis'),
      'allowed_types' => "*",
      'overwrite' => TRUE,
      //'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
      //'max_height' => "1000",
      //'max_width' => "1000"
      );
      $img = "file"; // input name="img"
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

        if(!$this->upload->do_upload($img)){

          $this->session->set_flashdata("error", $this->upload->display_errors());
          $data['error'] = $this->upload->display_errors();
                    
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/teammember_add', $data); 

        } else{
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/teammember_add', $data);
   }else{
     
                    $data['message'] = $this->upload->data();
                    $file = $data['message']['file_name'];
                    

            
      $data = array(
              'name' => $this->input->post('name'),
              'description'=>$this->input->post('en_description') ,
              'image' => $file,
              'role' => $this->input->post('role'),
              'contact' => $this->input->post('contact'),
              'dateadded' => date('Y-m-d h:i:s'),
              'added_by' => $this->session->userdata['logged_in']['id'] 
              
              
      );

    $this->App_model->add_teammate($data);
    redirect('App/team/');
     }
     
}
}
//this function is used to delete the files 
     public function delete_teammate($id)
  {
    $this->App_model->delete_teammate($id);
    redirect('App/team/');
  }


 //this is a function that is used to show the tabulated list of clients    
    public function clients()
     {
          $data['title'] = 'Clients';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $data['clients'] = $this->App_model->list_clients();
          $data['image'] = $this->session->userdata['logged_in']['image'];
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/clients_view', $data);
     }
// the feedback view shows the list of feedack 
     public function feedback()
     {
          $data['title'] = 'Feedback';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $data['feedbacks'] = $this->App_model->list_feedback();
          $data['image'] = $this->session->userdata['logged_in']['image'];
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/feedback_view', $data);
     }
//this is the function displays the feedback answer
     public function feedback_answer()
     {
          $data['title'] = 'Feedback';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $data['feedbacks'] = $this->App_model->list_feedbackques();
          $data['image'] = $this->session->userdata['logged_in']['image'];
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/feedbackques_view', $data);
     }
// this is the  view that displays the questions
      public function feedback_question()
     {
          $data['title'] = 'Feedback';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $data['feedbacks'] = $this->App_model->list_feedback();
          $data['image'] = $this->session->userdata['logged_in']['image'];
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/feedback_questions', $data);
     }

     //this function handles the feedback
          public function feedback_question_submition()
     {   
          $data['title'] = 'Add questions';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
        
         $this->form_validation->set_rules('question', 'Question', 'required');
           


    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/feedback_questions', $data);
   }else{
     
                    
                     $str=implode(",",$_POST['subcategory']);
            
      $data = array(
              'question' => $this->input->post('question'),
              'type'=> $this->input->post('type'),
              'answers' => $str,
              'position' => $this->input->post('position')
              
              
      );

    $this->App_model->add_feedbackques($data);
    redirect('App/feedback_answer/');
     }
     
}
//this is the delete feedback question 
  public function delete_feedback_question($id)
   {
     $this->App_model->delete_feedback_question($id);
     redirect('App/feedback_answer/');
   }
  // this is a vission function  that displays the vission of honey pride
  public function vission()
     {   
          $data['title'] = 'Vission';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['vission'] = $this->App_model->list_vission();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/vission_view', $data);
     }
    // this is the function that handles any information that the user has edited on the vission view and submitted
     public function vission_submition()
     {   
          $data['title'] = 'Vission';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
         $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/vission_view', $data);
   }else{   
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

               );

    $this->App_model->add_vission($data);
 }
    redirect('App/vission/');
     
   }
// the mission view shows the mission of honeypride     
      public function mission()
     {   
          $data['title'] = 'Mission';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['mission'] = $this->App_model->list_mission();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/mission_view', $data);
     }
 //this is the function that handles the mission edits     
     public function mission_submition()
     {   
          $data['title'] = 'Mission';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         $data['mission'] = $this->App_model->list_mission();
          
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/mission_view', $data);
   }else{  
      $data = array(
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']
              
               );

    $this->App_model->add_mission($data);
  }
   
    
      
    redirect('App/mission/');
  
   }
   // the strategic plan displays a view with the strategic plan
   public function strategic_plan()
     {   
          $data['title'] = 'Strategic plan';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['strategicplan'] = $this->App_model->list_strategicplan();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/strategic_plan_view', $data);
     }
     //this is the function that handles the  strategic plan submission
     public function strategic_plan_submition()
     {   
          $data['title'] = 'Strategic plan';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['strategicplan'] = $this->App_model->list_strategicplan();
         $data['luganda'] = $this->App_model->list_strategicplan_luganda();
          
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    
    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/strategic_plan_view', $data);
   }else{   
      $data = array(
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']
               );

    $this->App_model->add_strategicplan($data);
  }
      
    redirect('App/strategic_plan/');
     
   }
   // this is the function that displays the words of the ceo
   public function words_by_ceo()
     {   
          $data['title'] = 'Words by Ceo';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['wordsbyceo'] = $this->App_model->list_wordsbyceo();
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/words_by_ceo_view', $data);
     }
     //this is the function that handles the words of the ceo that have been submitted
     public function words_by_ceo_submition()
     {   
          $data['title'] = 'Words by Ceo';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         $data['wordsbyceo'] = $this->App_model->list_wordsbyceo();
          
          $this->form_validation->set_rules('en_description', 'Description', 'required');
    

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/words_by_ceo_view', $data);
   }else{   
      $data = array(
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']
               );

    $this->App_model->add_wordsbyceo($data);
  }
      
    redirect('App/words_by_ceo/');
    
   }
   //this is the values view that displays the views of Honeypride
   public function values()
     {   
          $data['title'] = 'Values';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['values'] = $this->App_model->list_values();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/values_view', $data);
     }
    // this is the  function that handles the values that have been submited to the database 
     public function values_submition()
     {   
          $data['title'] = 'Values';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['values'] = $this->App_model->list_values();

          $this->form_validation->set_rules('en_description', 'Description', 'required');
    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/values_view', $data);
   }else{   
      $data = array(
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']
               );

    $this->App_model->add_values($data);
  }
    redirect('App/values/');
     
   }
// this  function that displays the about app information
public function Business_model()
     {   
          $data['title'] = 'Business model';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['aboutapp'] = $this->App_model->list_about_app();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/business_model_view', $data);
     }
// this is the function that deals with what has been submitted by the About app function
     public function Business_model_submition()
     {   
          $data['title'] = 'Business Model';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         $data['aboutapp'] = $this->App_model->list_about_app();
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/business_model_view', $data);
   }else{   
    
      $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_about_app($data);
  }
    redirect('App/Business_model/');
     
   }
   // this function displays  the objectives add view where the user can edit the objectives
   public function objectives()
     {   
          $data['title'] = 'Objectives';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['objective'] = $this->App_model->list_objectives();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/objectives_add', $data);
     }
     //this is the objectives submission function that handles that details submissted by the user
     public function objectives_submition()
     {   
          $data['title'] = 'Objectives';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['objective'] = $this->App_model->list_objectives();
                
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/objectives_add', $data);
   }else{   
    
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_partner($data);
  }
      
    redirect('App/objectives/');
     
   }
   // this function displays  the our business add view where the user can edit the objectives
   public function our_business()
     {   
          $data['title'] = 'Business';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['objective'] = $this->App_model->list_our_business();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/our_business_add', $data);
     }
     //this is the our business submission function that handles that details submissted by the user
     public function our_business_submition()
     {   
          $data['title'] = 'Business';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['objective'] = $this->App_model->list_our_business();
                
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/our_business_add', $data);
   }else{   
    
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_business($data);
  }
      
    redirect('App/our_business/');
     
   }
   // this function displays  the our services add view where the user can edit the objectives
   public function our_services()
     {   
          $data['title'] = 'Services';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['objective'] = $this->App_model->list_our_services();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/our_services_add', $data);
     }
     //this is the services submission function that handles that details submissted by the user
     public function our_services_submition()
     {   
          $data['title'] = 'Services';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['objective'] = $this->App_model->list_our_services();
                
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/our_services_add', $data);
   }else{   
    
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_services($data);
  }
      
    redirect('App/our_services/');
     
   }

   // this function displays  the training programs add view where the user can edit the objectives
   public function training_programs()
     {   
          $data['title'] = 'Training programs';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['objective'] = $this->App_model->list_training_programs();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/training_programs_add', $data);
     }
     //this is the services submission function that handles that details submissted by the user
     public function training_programs_submition()
     {   
          $data['title'] = 'Services';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['objective'] = $this->App_model->list_training_programs();
                
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/training_programs_add', $data);
   }else{   
    
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_training_program($data);
  }
      
    redirect('App/training_programs/');
     
   }
   // this function displays  the our environment add view where the user can edit the objectives
   public function our_environment()
     {   
          $data['title'] = 'Our Environment';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['objective'] = $this->App_model->list_our_environment();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/our_environment', $data);
     }
     //this is the our environment submission function that handles that details submissted by the user
     public function our_environment_submition()
     {   
          $data['title'] = 'Our Environment';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['objective'] = $this->App_model->list_our_environment();
                
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/our_environment', $data);
   }else{   
    
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_our_environment($data);
  }
      
    redirect('App/our_environment/');
     
   }
   // this function displays  the training programs add view where the user can edit the objectives
   public function our_dream()
     {   
          $data['title'] = 'Our Dream';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['objective'] = $this->App_model->list_our_dream();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/our_dream', $data);
     }
     //this is the services submission function that handles that details submissted by the user
     public function our_dream_submition()
     {   
          $data['title'] = 'Our Dream';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['objective'] = $this->App_model->list_our_dream();
                
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/our_dream', $data);
   }else{   
    
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_our_dream($data);
  }
      
    redirect('App/our_dream/');
     
   }
      // this function displays  the our contact add view where the user can edit the objectives
   public function our_contact()
     {   
          $data['title'] = 'Our Contact';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['objective'] = $this->App_model->list_our_contact();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/our_contact', $data);
     }
     //this is the our contact submission function that handles that details submissted by the user
     public function our_contact_submition()
     {   
          $data['title'] = 'Our Contact';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['objective'] = $this->App_model->list_our_contact();
                
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/our_contact', $data);
   }else{   
    
     $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_our_contact($data);
  }
      
    redirect('App/our_contact/');
     
   }
public function partners()
     {
          $data['title'] = 'Partners';
         $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['partners'] = $this->App_model->list_partners();

          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/partner_view', $data);
     }

      public function partners_add()
     {   
          $data['title'] = 'Add partner';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/partner_add', $data);
     }
      public function partner_submition()
     {   
          $data['title'] = 'Add partner';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         $this->form_validation->set_rules('name', 'Name', 'required');
          $now = new DateTime();
         $now->setTimezone(new DateTimezone('Asia/Kolkata'));
      

      $config = array(
      'upload_path' => "./assets/images/partners/",
      'file_name' => "partner_".$now->format('YmdHis'),
      'allowed_types' => "*",
      'overwrite' => TRUE,
      
      );
      $img = "imeg"; // input name="img"
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

        if(!$this->upload->do_upload($img)){

          $this->session->set_flashdata("error", $this->upload->display_errors());
          $data['error'] = $this->upload->display_errors();
                    
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/partner_add', $data); 

        } else{
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/partner_add', $data);
   }else{
     
                    $data['message'] = $this->upload->data();
                    $picture = $data['message']['file_name'];

            
      $data = array(
              'name' => $this->input->post('name'),
              'logo'=> $picture,
              'dateadded' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']
              
              
      );

    $this->App_model->add_partners($data);
    redirect('App/partners/');
     }
     }
}
      public function delete_partner($id)
  {
    $this->App_model->delete_partner($id);
    redirect('App/partners/');
  }
     public function edit_partner()
     {   
          $data['title'] = 'Edit Partner';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $id = $this->uri->segment(3);
          //$this->App_model->get_showtime_item($id);
          //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/showtimes_edit', $data);
     }
     
public function partneredit_submition()
     {   
          $data['title'] = 'Edit partner';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
           $this->form_validation->set_rules('price', 'Price', 'required');
          $this->form_validation->set_rules('date', 'End time', 'required');
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/sucesstory_edit', $data);
   }else{   
    
    $data = array(
              
              'day' => $this->input->post('date'),
              'start' => $this->input->post('time'),
              'pricing'=>$this->input->post('price')
              
      );

     $id = $this->uri->segment(3);
     //$this->App_model->edit_showtime_item($data,$id);
     redirect('App/partners/');
     }
   }
public function news()
     {
          $data['title'] = 'News';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['news'] = $this->App_model->list_news();
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/news_view', $data);
     }
      public function news_add()
     {   
          $data['title'] = 'Add News';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/news_add', $data);
     }
     public function news_submition()
     {   
          $data['title'] = 'Add News';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
              
          $this->form_validation->set_rules('headline', 'Headline', 'required');
          $this->form_validation->set_rules('author', 'Author', 'required');
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/news_add', $data);
   }else{   
    $status = 1;
      $data = array(
              'headline' => $this->input->post('headline'),
              'description' => $this->input->post('description'),
              'image_link' => $this->input->post('url'),
              'author' => $this->input->post('author'),
              'date'=> date('Y-m-d h:i:s'),
              'status' => $status 
               );

    $this->App_model->add_new($data);
    redirect('App/news/');
     }
   }
   public function delete_news($id)
  {
    $this->App_model->delete_news($id);
    redirect('App/news/');
  }
     public function edit_news()
     {   
          $data['title'] = 'Edit News';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $id = $this->uri->segment(3);
          $this->App_model->get_news_item($id);
          $data['news'] = $this->App_model->get_news_item($id);
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/news_edit', $data);
     }
     
public function newsedit_submition()
     {   
          $data['title'] = 'Add News';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
              
          $this->form_validation->set_rules('headline', 'Headline', 'required');
          $this->form_validation->set_rules('author', 'Author', 'required');
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/news_edit', $data);
   }else{   
    
      $data = array(
              'headline' => $this->input->post('headline'),
              'description' => $this->input->post('description'),
              'image_link' => $this->input->post('url'),
              'author' => $this->input->post('author'),
               );
     $id = $this->uri->segment(3);
    $this->App_model->edit_news_item($data,$id);
    redirect('App/news/');
     }
     }
public function videos()
     {
          $data['title'] = 'Videos';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['videos'] = $this->App_model->list_videos();
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/video_view', $data);
     }
      public function video_add()
     {   
          $data['title'] = 'Add Video';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/video_add', $data);
     }
     public function videos_submition()
     {   
          $data['title'] = 'Add Video';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
              
          $this->form_validation->set_rules('headline', 'Headline', 'required');
          $this->form_validation->set_rules('author', 'Author', 'required');
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/video_add', $data);
   }else{   
    $status = 1;
      $data = array(
              'headline' => $this->input->post('headline'),
              'description' => $this->input->post('description'),
              'video_link' => $this->input->post('url'),
              'author' => $this->input->post('author'),
              'date'=> date('Y-m-d h:i:s'),
              'status' => $status 
               );

    $this->App_model->add_video($data);
    redirect('App/videos/');
     }
   }
   public function delete_video($id)
  {
    $this->App_model->delete_video($id);
    redirect('App/videos/');
  }
     public function edit_videos()
     {   
          $data['title'] = 'Edit News';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $id = $this->uri->segment(3);
          $this->App_model->get_video_item($id);
          $data['news'] = $this->App_model->get_video_item($id);
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/video_edit', $data);
     }
     
public function videossedit_submition()
     {   
          $data['title'] = 'Add News';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
              
          $this->form_validation->set_rules('headline', 'Headline', 'required');
          $this->form_validation->set_rules('author', 'Author', 'required');
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/video_edit', $data);
   }else{   
    
      $data = array(
              'headline' => $this->input->post('headline'),
              'description' => $this->input->post('description'),
              'video_link' => $this->input->post('url'),
              'author' => $this->input->post('author'),
               );
     $id = $this->uri->segment(3);
    $this->App_model->edit_video_item($data,$id);
    redirect('App/videos/');
     }
     }
 

   //this is an about function that shows the about literature
   public function About()
     {   
          $data['title'] = 'About Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_about_literature();
         
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/aboutliterature_view', $data);
     }
     //this is the function that handles the about submission
     public function About_submition()
     {   
          $data['title'] = 'About Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['proplit'] = $this->App_model->list_about_literature();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/aboutliterature_view', $data);
   }else{ 

   $data = array(
             
              'content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );
      

    $this->App_model->add_about_literature($data);
  }
      
    redirect('App/About/');
   }
    //this is a maintenance funtion that handles maintence literature information
   public function maintenance()
     {   
          $data['title'] = 'Maintenance Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_maintenace_literature();
          $data['luganda'] = $this->App_model->list_maintenace_literature_luganda();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/maintenanceliterature_view', $data);
     }
     //this maintenance handles the details that have been submited by the maintenance submission
     public function maintenance_submition()
     {   
          $data['title'] = 'Maintenance Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_maintenace_literature();
          $data['luganda'] = $this->App_model->list_maintenace_literature_luganda();
         
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/maintenanceliterature_view', $data);
   }else{ 

   if($this->input->post('type') === 'english'){
      $data = array(
             
              'literature_content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_maintenance_literature($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $data = array(
             
              'literature_content' => $this->input->post('lug_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_maintenance_literature_luganda($data);

  }   
    
      
    redirect('App/maintenance/');
     }
   }
   //this is the maintenance steps view
 public function maintenance_steps()
      {
           $data['title'] = 'Maintenance steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_maintenace_steps();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancesteps_view', $data);
      }
// this is the maintenance steps add view that allows the user to add maintenance steps
       public function maintenance_steps_add()
      {   
           $data['title'] = 'Add maintenance steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenance_steps_add', $data);
      }
    /// this is the maintenance steps add aubmission that allows maintenance steps after they have been submited
       public function maintenance_steps_add_submition()
      {   
           $data['title'] = 'Add a maintenance step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;

          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainstep_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenance_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenance_steps_add', $data);
   }else{
     
                      $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                      $language = "maintenance";
        
        if($this->input->post('type') === 'english'){
          $lang = "english";
      $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_maintenance_steps($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $lang = "luganda";
    $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_maintenance_steps($data);

  }       
       
     redirect('App/maintenance_steps/');
      }
      }
 }
 //this is the function that deletes the maintenance steps
       public function delete_maintenance_step($id)
   {
     $this->App_model->delete_maintenance_step($id);
     redirect('App/maintenance_steps/');
   }
  // this function is invoked whent he user clicks an edit button and displays the edit view of the maintenance step 
      public function edit_maintenance_steps()
      {   
           $data['title'] = 'Edit maintenance steps';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           //$this->App_model->get_showtime_item($id);
           //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancesteps_edit', $data);
      }
    //this function handles what the user submits when they have finished editing
 public function maintenancesteps_edit_submition()
      {   
           $data['title'] = 'Edit Maintenance step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "partner_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenance_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenance_steps_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];

            
       $data = array(
               'title' => $this->input->post('title'),
               'logo'=> $picture,
               'date_added' => date('Y-m-d h:i:s')
              
              
       );

     $this->App_model->add_partner($data);
     redirect('App/maintenance_steps/');
      }
      }
    }
    //this is function that displays the maintenance menus
        public function maintenance_menu()
      {
           $data['title'] = 'Maintenance menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_maintenace_menu();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancemenu_view', $data);
      }
// this is the function that displays the add men option
       public function maintenance_menu_add()
      {   
           $data['title'] = 'Add a maintenance menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancemenu_add', $data);
      }
      // this is the  function that handles the maintenance  menu details that have been submited
       public function maintenance_menu_add_submition()
      {   
           $data['title'] = 'Add maintenance menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;

          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancemenu_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancemenu_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "maintenance";
                     
            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_maintenace_menu($data);
     redirect('App/maintenance_menu/');
      }
      }
 }
 //this is the function that deletes the maintenance menu details that have been selected 
       public function delete_maintenance_menu($id)
   {
     $this->App_model->delete_maintenance_menu($id);
     redirect('App/maintenance_menu/');
   }
   // the edit maintenance menu edits the maintence menu details that have been selected
      public function edit_maintenance_menu()
      {   
           $data['title'] = 'Edit maintenance menu';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancemenu_edit', $data);
      }
  // the maintenance menu edit submission that handles the details that have been submitted  
 public function maintenance_menuedit_submition()
      {   
           $data['title'] = 'Edit maintenance menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){
          if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancemenu_edit', $data);
   }else{

           $language = "maintenance";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );
      $this->App_model->edit_menu_item($data, $id);
     redirect('App/maintenance_menu/');
   }
         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenancemenu_edit', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "maintenance";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->edit_menu_item($data, $id);
     redirect('App/maintenance_menu/');
   }
    }
  }
//this is the function that displays the family leterature view
public function family()
     {   
          $data['title'] = 'Family Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_family_literature();
          $data['luganda'] = $this->App_model->list_family_literature_luganda();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/familyliterature_view', $data);
     }
     //this is the function that deals with the submission of the family
     public function family_submition()
     {   
          $data['title'] = 'Family Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['proplit'] = $this->App_model->list_family_literature();
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['luganda'] = $this->App_model->list_family_literature_luganda();
         
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/familyliterature_view', $data);
   }else{   
    if($this->input->post('type') === 'english'){
      $data = array(
             
              'literature_content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_family_literature($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $data = array(
             
              'literature_content' => $this->input->post('lug_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_family_literature_luganda($data);

  }
    
      
    redirect('App/family/');
     }
   }
   //this is the function that handles the family steps that have been added
 public function family_steps()
      {
           $data['title'] = 'Family steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_family_steps();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familysteps_view', $data);
      }
//this is the function  that adds the family steps 
       public function family_steps_add()
      {   
           $data['title'] = 'Add Family steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/family_steps_add', $data);
      }
      // this is the fauntion that adds the steps after the user submits
       public function family_steps_add_submition()
      {   
           $data['title'] = 'Add a family step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "famsteps_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/family_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/family_steps_add', $data);
   }else{
     
                      $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                      $language = "family";
            if($this->input->post('type') === 'english'){
          $lang = "english";
      $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_family_steps($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $lang = "luganda";


     
    $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_family_steps($data);

  }       
       
     redirect('App/family_steps/');
      }
      }
 }
 // this is the function that deletes the family steps
       public function delete_family_step($id)
   {
     $this->App_model->delete_family_step($id);
     redirect('App/family_steps/');
   }
   // this is the function that edits the family steps
      public function edit_family_steps()
      {   
           $data['title'] = 'Edit family steps';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           //$this->App_model->get_showtime_item($id);
           //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familysteps_edit', $data);
      }
    // this is the function that handles the edite submission page
 public function familysteps_edit_submition()
      {   
           $data['title'] = 'Edit family step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "partner_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/family_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/family_steps_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];

            
       $data = array(
               'title' => $this->input->post('title'),
               'logo'=> $picture,
               'date_added' => date('Y-m-d h:i:s')
              
              
       );

     $this->App_model->add_partner($data);
     redirect('App/family_steps/');
      }
      }
    }
    // this is the function that displays the family  menu
    public function family_menu()
      {
           $data['title'] = 'Family menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['steps'] = $this->App_model->list_family_menu();
           $data['image'] = $this->session->userdata['logged_in']['image'] ;

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familymenu_view', $data);
      }
// this is the function that allows the user to add the family menu
       public function family_menu_add()
      {   
           $data['title'] = 'Add a family menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familymenu_add', $data);
      }
//this is the function that handles the menu details that have been submitted
       public function family_menu_add_submition()
      {   
           $data['title'] = 'Add a family menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "fammenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familymenu_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familymenu_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "family";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_family_menu($data);
     redirect('App/family_menu/');
      }
      }
 }
 //this is the function that deletes a particular family menu
       public function delete_family_menu($id)
   {
     $this->App_model->delete_family_menu($id);
     redirect('App/family_menu/');
   }
/// this is  the function that  allows the menu to be editted
      public function edit_family_menu()
      {   
           $data['title'] = 'Edit family menu';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familymenu_edit', $data);
      }
    // this is the function that handles the details that have been entered by the user 
 public function family_menuedit_submition()
      {   
           $data['title'] = 'Edit Family menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){
          if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");

          $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familymenu_edit', $data);
   }else{

           $language = "family";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );
      $this->App_model->edit_menu_item($data, $id);
     redirect('App/family_menu/');
   }
         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/familymenu_edit', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "family";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->edit_menu_item($data, $id);
     redirect('App/family_menu/');
   }
    }
    }
   // this is the function that  shows the property liteture view with  the information in it 
    public function property()
     {   
          $data['title'] = 'Property Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_property_literature();
          $data['luganda'] = $this->App_model->list_property_literature_luganda();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/propertyliterature_view', $data);
     }
     // this is the function that handles the details the user has entered with in the literature form 
     public function property_submition()
     {   
          $data['title'] = 'Property Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_property_literature();
          $data['luganda'] = $this->App_model->list_property_literature_luganda();
         
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
         $this->session->set_flashdata("error","Please update the record");
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/propertyliterature_view', $data);
   }else{ 
   if($this->input->post('type') === 'english'){
      $data = array(
             
              'literature_content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_property_literature($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $data = array(
             
              'literature_content' => $this->input->post('lug_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_property_literature_luganda($data);

  }  
    
      
    redirect('App/property/');
     }
   }
  // this is the  function that displays the details that have been added 
 public function property_steps()
      {
           $data['title'] = 'Property steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_property_steps();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertysteps_view', $data);
      }
// this is a funtion that diplays a form that allows the user to enter the details of   the form
       public function property_steps_add()
      {   
           $data['title'] = 'Add property steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/property_steps_add', $data);
      }
      // this is the funtion that handles the steps that have been submited by the user
       public function property_steps_add_submition()
      {   
           $data['title'] = 'Add a property step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "propsteps_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/property_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/property_steps_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                      $language = "property";
            
      if($this->input->post('type') === 'english'){
          $lang = "english";
      $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_property_steps($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $lang = "luganda";


     
    $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_property_steps($data);

  } 

     
     redirect('App/property_steps/');
      }
      }
 }
  // this is the function that allows the user to delete the details of the steps
       public function delete_property_step($id)
   {
     $this->App_model->delete_property_step($id);
     redirect('App/property_steps/');
   }
   // this is the function that allow the user to edit a particular step
      public function edit_property_steps()
      {   
           $data['title'] = 'Edit property steps';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           //$this->App_model->get_showtime_item($id);
           //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertysteps_edit', $data);
      }
 // this  is a function that handles the data that has been submited by the user   
 public function propertysteps_edit_submition()
      {   
           $data['title'] = 'Edit property step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "partner_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/property_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/maintenance_steps_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];

            
       $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_partner($data);
     redirect('App/property_steps/');
      }
      }
    }
    // this is a function that shows the menu items that have been entered by the user
    public function property_menu()
      {
           $data['title'] = 'Property menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_property_menu();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertymenu_view', $data);
      }
// the property menu add function displays a view that allows the user enter the menu
       public function property_menu_add()
      {   
           $data['title'] = 'Add a property menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertymenu_add', $data);
      }
// this is a function that handles the detail that have been submited by the funtion above
       public function property_menu_add_submition()
      {   
           $data['title'] = 'Add property menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "propmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );

       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertymenu_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertymenu_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "property";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_property_menu($data);
     redirect('App/property_menu/');
      }
      }
 }
 // the delete property menu function allow he user to delete a particular function on edit of a button
       public function delete_property_menu($id)
   {
     $this->App_model->delete_property_menu($id);
     redirect('App/property_menu/');
   }
   // the edit  property menu function allows the user to edit a particular record 
      public function edit_property_menu()
      {   
           $data['title'] = 'Edit property menu';
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertymenu_edit', $data);
      }
   // this is the function that handles the details that have been submiteed by the user  
 public function property_menuedit_submition()
      {   
           $data['title'] = 'Edit property';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){
          if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/propertymenu_edit', $data);
   }else{

           $language = "property";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );
      $this->App_model->edit_menu_item($data, $id);
     redirect('App/property_menu/');
   }
         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
          $this->load->view('app/propertymenu_edit', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "property";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->edit_menu_item($data, $id);
     redirect('App/property_menu/');
   }
    }
    }
    // this is a function that displays the gender based violence literature view
    public function Gbv()
     {   
          $data['title'] = 'GBV Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_gbv_literature();
          $data['luganda'] = $this->App_model->list_gbv_literature_luganda();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/gbvliterature_view', $data);
     }
     // this function handles the data that is subnitted by the user on edit of the literatuter form
     public function gbv_submition()
     {   
          $data['title'] = 'GBV Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/gbvliterature_view', $data);
   }else{   
    if($this->input->post('type') === 'english'){
      $data = array(
             
              'literature_content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_gbv_literature($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $data = array(
             
              'literature_content' => $this->input->post('lug_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_gbv_literature_luganda($data);

  }  
      
    redirect('App/gbv/');
     }
   }
   // this is the function that allows the user to view the steps that have been added
 public function gbv_steps()
      {
           $data['title'] = 'GBV steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['steps'] = $this->App_model->list_gbv_steps();
           $data['image'] = $this->session->userdata['logged_in']['image'] ;

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvsteps_view', $data);
      }
// the function that allows to add the new steps
       public function gbv_steps_add()
      {   
           $data['title'] = 'Add GBV steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbv_steps_add', $data);
      }
//this is the function that handles  the gbv steps on submission      
       public function gbv_steps_add_submition()
      {   
           $data['title'] = 'Add a GBV step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "gbvstep_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);


         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbv_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbv_steps_add', $data);
   }else{
     
                      $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                      $language = "gbv";
          if($this->input->post('type') === 'english'){
          $lang = "english";
      $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_gbv_steps($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $lang = "luganda";


     
    $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_gbv_steps($data);

  }   
       

     
     redirect('App/gbv_steps/');
      }
      }
 }
 //this is the function that deletes the steps 
       public function delete_gbv_step($id)
   {
     $this->App_model->delete_gbv_step($id);
     redirect('App/gbv_steps/');
   }
   // this is the function that deletes the gbv steps that have been added by the user
      public function edit_gbv_steps()
      {   
           $data['title'] = 'Edit GBV steps';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           //$this->App_model->get_showtime_item($id);
           //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvsteps_edit', $data);
      }
    // this is the  function that handles the data on submission
 public function gbvsteps_edit_submition()
      {   
           $data['title'] = 'Edit GBV step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "partner_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbv_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbv_steps_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];

            
       $data = array(
               'title' => $this->input->post('title'),
               'logo'=> $picture,
               'date_added' => date('Y-m-d h:i:s')
              
              
       );

     $this->App_model->add_partner($data);
     redirect('App/gbv_steps/');
      }
      }
    }
  // this is the function that handles the menu
    public function gbv_menu()
      {
           $data['title'] = 'GBV menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_gbv_menu();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvmenu_view', $data);
      }
//this is the function allows the user  to add the gbv menu
       public function gbv_menu_add()
      {   
           $data['title'] = 'Add a GBV menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvmenu_add', $data);
      }
  // the gbv menu submission that handles the gbv menu submission    
       public function gbv_menu_add_submition()
      {   
           $data['title'] = 'Add GBV menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "gbvmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvmenu_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvmenu_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "gbv";
                     


            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );
     $this->App_model->add_gbv_menu($data);
     redirect('App/gbv_menu/');
      }
      }
 }
 //this is the function that allows the user to delete the gbv menu
       public function delete_gbv_menu($id)
   {
     $this->App_model->delete_gbv_menu($id);
     redirect('App/gbv_menu/');
   }
   //this is the function that alows the user to edit gbv men item
      public function edit_gbv_menu()
      {   
           $data['title'] = 'Edit GBV menu';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvmenu_edit', $data);
      }
 // this function handles the details that have been submitted by the user   
 public function gbv_menuedit_submition()
      {   
           $data['title'] = 'Edit GBV menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){
          if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvmenu_edit', $data);
   }else{

           $language = "gbv";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );
      $this->App_model->edit_menu_item($data, $id);
    redirect('App/gbv_menu/');
   }
         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/gbvmenu_edit', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "gbv";
                    

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->edit_menu_item($data, $id);
    redirect('App/gbv_menu/');
   }
    }
    }
    // this is the function literature function that haandles the referal literature
    public function referals()
     {   
          $data['title'] = 'referals Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_referals_literature();
           $data['luganda'] = $this->App_model->list_referals_literature_luganda();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/referalliterature_view', $data);
     }
     // this is the function that handles the details that have been submited
     public function referal_submition()
     {   
          $data['title'] = 'referal Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_referals_literature();
           $data['luganda'] = $this->App_model->list_referals_literature_luganda();
         
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/referalliterature_view', $data);
   }else{   
    if($this->input->post('type') === 'english'){
      $data = array(
             
              'literature_content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_referals_literature($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $data = array(
             
              'literature_content' => $this->input->post('lug_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_referals_literature_luganda($data);

  }  
      
    redirect('App/referals/');
     }
   }
  // this is the function that displays the steps  
 public function referal_steps()
      {
           $data['title'] = 'Referal steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_referals_steps();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalssteps_view', $data);
      }
// this is the function that allows the user to add steps
       public function referal_steps_add()
      {   
           $data['title'] = 'Add referals steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referals_steps_add', $data);
      }
 // this is the function that handles the user details that have been submited     
       public function referal_steps_add_submition()
      {   
           $data['title'] = 'Add a referals step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "refstep_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referals_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referals_steps_add', $data);
   }else{
     
                      $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                      $language = "referrals";
            
             if($this->input->post('type') === 'english'){
          $lang = "english";
      $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_referals_steps($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $lang = "luganda";


     
    $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_referals_steps($data);

  } 

     
     redirect('App/referal_steps/');
      }
      }
 }
 // this is the function that removes a referal step
       public function delete_referal_step($id)
   {
     $this->App_model->delete_referals_step($id);
     redirect('App/referal_steps/');
   }
   // this is the function that edits the referal step
      public function edit_referal_step()
      {   
           $data['title'] = 'Edit referal steps';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           // $this->App_model->get_menu_item($id);
           // $data['main'] = $this->App_model->get_menu_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalssteps_edit', $data);
      }
   // this is the function that handles the details that have been submited by the user after edit 
 public function referalsteps_edit_submition()
      {   
           $data['title'] = 'Edit referal step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "partner_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referals_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referals_steps_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];

            
       $data = array(
               'title' => $this->input->post('title'),
               'logo'=> $picture,
               'date_added' => date('Y-m-d h:i:s')
              
              
       );

     $this->App_model->add_partner($data);
     redirect('App/referal_steps/');
      }
      }
    }
   // this function displays  the menu that have been added 
    public function referal_menu()
      {
           $data['title'] = 'Referal menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_referals_menu();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalsmenu_view', $data);
      }
// this function  displays the menu add  view that allows the user to add a  menu
       public function referal_menu_add()
      {   
           $data['title'] = 'Add a referal menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalsmenu_add', $data);
      }
// this is a function that handles the data that has been entered by the user      
       public function referal_menu_add_submition()

      {   
           $data['title'] = 'Add referal menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "refemenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalsmenu_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalsmenu_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "referrals";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_referals_menu($data);
     redirect('App/referal_menu/');
      }
      }
 }
 // this is the function that allows the user to delete a referal menu
       public function delete_referal_menu($id)
   {
     $this->App_model->delete_referal_menu($id);
     redirect('App/referal_menu/');
   }
   // this the function that allows the user to edit the referal menu
      public function edit_referal_menu()
      {   
           $data['title'] = 'Edit referal menu';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalsmenu_edit', $data);
      }
 // this is the function handles the details that were submitted   
 public function referal_menuedit_submition()
      {   
           $data['title'] = 'Edit referal';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){
          if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalsmenu_edit', $data);
   }else{

           $language = "referrals";
                    

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );
      $this->App_model->edit_menu_item($data, $id);
    redirect('App/referal_menu/');
   }
         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/referalsmenu_edit', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "referrals";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->edit_menu_item($data, $id);
     redirect('App/referal_menu/');
   }
    }
    }
 // this is the function that displays the court processes literature view   
    public function court_processes()
     {   
          $data['title'] = 'Court processes Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['id'] = $this->session->userdata['logged_in']['id'] ;
          $data['proplit'] = $this->App_model->list_court_processes_literature();
          $data['luganda'] = $this->App_model->list_court_processes_literature_luganda();
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/court_processliterature_view', $data);
     }
    // this is the function that handles the submission 
     public function court_processes_submition()
     {   
          $data['title'] = 'Court processes Literature';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['proplit'] = $this->App_model->list_court_processes_literature();
          $data['luganda'] = $this->App_model->list_court_processes_literature_luganda();
         
          
              
          $this->form_validation->set_rules('en_description', 'Description', 'required');
          
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please update the record");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/court_processliterature_view', $data);
   }else{   
    if($this->input->post('type') === 'english'){
      $data = array(
             
              'literature_content' => $this->input->post('en_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_court_process_literature($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $data = array(
             
              'literature_content' => $this->input->post('lug_description'),
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' =>$this->session->userdata['logged_in']['id']

              
               );

    $this->App_model->add_court_process_literature_luganda($data);
  }  
      
    redirect('App/court_processes/');
     }
   }
   // this is the court process steps that exist
 public function court_processes_steps()
      {
           $data['title'] = 'Court processes steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_court_processes_steps();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocesssteps_view', $data);
      }
// this allows the user to add court processes
       public function court_processes_steps_add()
      {   
           $data['title'] = 'Add court processes steps';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/court_processes_steps_add', $data);
      }
      // this function that handles the data that has been entered
       public function court_processes_steps_add_submition()
      {   
           $data['title'] = 'Add a court processes step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "courtsteps_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/court_processes_steps_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/court_processes_steps_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                      $language = "court";
            
       if($this->input->post('type') === 'english'){
          $lang = "english";
      $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_court_processes_steps($data);
  }elseif ($this->input->post('type') === 'luganda') {
    $lang = "luganda";


     
    $data = array(
               'step_title' => $this->input->post('title'),
               'step_position' => $this->input->post('position'),
               'step_logo'=> $picture,
               'step_desc' => $this->input->post('description'),
               'step_language'=> $language,
               'step_type'=> $lang,
               'step_added' => date('Y-m-d h:i:s'),
                'step_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_court_processes_steps($data);

  } 

     
     redirect('App/court_processes_steps/');
      }
      }
 }
 // this is the function that allows the user to delete the details of the user
       public function delete_court_processes_step($id)
   {
     $this->App_model->delete_court_processes_step($id);
     redirect('App/court_processes_steps/');
   }
 // this is the function that allows the user to edit the steps  
      public function edit_court_processes_steps()
      {   
           $data['title'] = 'Edit court processes steps';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           //$this->App_model->get_showtime_item($id);
           //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessessteps_edit', $data);
      }
   //this is the function that handles the submission 
 public function court_processessteps_edit_submition()
      {   
           $data['title'] = 'Edit court process step';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "partner_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessessteps_edit', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocesssteps_edit', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];

            
       $data = array(
               'title' => $this->input->post('title'),
               'logo'=> $picture,
               'date_added' => date('Y-m-d h:i:s')
              
              
       );

     $this->App_model->add_partner($data);
     redirect('App/court_processes_steps/');
      }
      }
    }
  // this is the function that displays the court processes menu   
    public function court_processes_menu()
      {
           $data['title'] = 'Court process menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['steps'] = $this->App_model->list_court_processes_menu();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessesmenu_view', $data);
      }
//this is the function that allows the user to add a menu
       public function court_processes_menu_add()
      {   
           $data['title'] = 'Add a court process menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessesmenu_add', $data);
      }
       public function court_processes_menu_add_submition()
      {   
           $data['title'] = 'Add court process menu';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "courtmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){

           $this->session->set_flashdata("error", $this->upload->display_errors());
           $data['error'] = $this->upload->display_errors();
                    
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessesmenu_add', $data); 

         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessesmenu_add', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "court";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->add_court_processes_menu($data);
     redirect('App/court_processes_menu/');
      }
      }
 }
 //this is the function that allows the user to delete the menu
       public function delete_court_processes_menu($id)
   {
     $this->App_model->delete_court_processes_menu($id);
     redirect('App/court_processes_menu/');
   }
   //this is the function that allows the user to edit the menu
      public function edit_court_processes_menu()
      {   
           $data['title'] = 'Edit Court processes menu';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessesmenu_edit', $data);
      }
   // this is the function that handles the menudetails that have been submited 
 public function court_processes_menuedit_submition()
      {   
           $data['title'] = 'Edit court processes';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           $this->App_model->get_menu_item($id);
           $data['main'] = $this->App_model->get_menu_item($id);
         
          $now = new DateTime();
          $now->setTimezone(new DateTimezone('Asia/Kolkata'));
          $this->form_validation->set_rules('title', 'Title', 'required');

       $config = array(
       'upload_path' => "./assets/images/stories",
       'file_name' => "mainmenu_".$now->format('YmdHis'),
       'allowed_types' => "gif|jpg|png|jpeg",
       'overwrite' => TRUE
      
       );
       $img = "image"; // input name="img"
       $this->load->library('upload', $config);
       $this->upload->initialize($config);

         if(!$this->upload->do_upload($img)){
          if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/courtprocessesmenu_edit', $data);
   }else{

           $language = "court";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );
      $this->App_model->edit_menu_item($data, $id);
     redirect('App/court_processes_menu/');
   }
         } else{
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
          $this->load->view('app/courtprocessesmenu_edit', $data);
   }else{
     
                     $data['message'] = $this->upload->data();
                     $picture = $data['message']['file_name'];
                     $language = "court";
                     

            
       $data = array(
               'menu_title' => $this->input->post('title'),
               'menu_logo'=> $picture,
               'menu_desc' => $this->input->post('description'),
               'menu_type'=> $this->input->post('type'),
               'menu_language'=> $language,
               'menu_added' => date('Y-m-d h:i:s'),
                'menu_added_by'=> $this->session->userdata['logged_in']['id']
              
       );

     $this->App_model->edit_menu_item($data, $id);
     redirect('App/court_processes_menu/');
   }
    }
    }
// this is a function that diplays the locations
   public function locations()
       {
          $data['title'] = 'Locations';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $data['locations'] = $this->App_model->list_locations();

           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/locations_view', $data);
      }
//this is the function that allows the user to add a location
       public function locations_add()
      {   
           $data['title'] = 'Add location';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/location_add', $data);
      }
// this is the function that allows the user to submit a location       
       public function location_submition()
      {   
          $data['title'] = 'Add location';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->form_validation->set_rules('name', 'Name', 'required');

       
    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/location_add', $data);
    }else{
     
                     

            
       $data = array(
               
               'name'=> $this->input->post('name'),
               'address'=> $this->input->post('address'),
               'contacts'=> $this->input->post('contact'),
               'latitude' =>$this->input->post('latitude'),
               'longitude'=> $this->input->post('longitude'),
               'date_added' => date('Y-m-d h:i:s'),
               'admin_id' => $this->session->userdata['logged_in']['id']              
              
              
       );

     $this->App_model->add_location($data);
     redirect('App/locations/');
      }
      
 }
 //this is the function that deletes the locations
       public function delete_location($id)
   {
     $this->App_model->delete_location($id);
     redirect('App/locations/');
   }
  // this is the fucntion that allows the user to edit the locations 
      public function edit_location()
      {   
           $data['title'] = 'Edit location';
           $data['user'] = $this->session->userdata['logged_in']['name'];
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
           $id = $this->uri->segment(3);
           //$this->App_model->get_showtime_item($id);
           //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
           $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
           $this->load->view('app/location_edit', $data);
     }
 // this is the function that handles the location edit submission     
 public function locationedit_submition()
      {   
           $data['title'] = 'Edit location';
           $data['user'] = $this->session->userdata['logged_in']['name'] ;
           $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
            $this->form_validation->set_rules('price', 'Price', 'required');
          
          

    
     if ($this->form_validation->run() === FALSE){
       $this->session->set_flashdata("error","Please enter all fields");
          
          $this->load->view('app/includes/header', $data);
           $this->load->view('app/includes/menu', $data);
         $this->load->view('app/location_edit', $data);
    }else{   
    
     $data = array(
              
               'day' => $this->input->post('date'),
               'start' => $this->input->post('time'),
               'pricing'=>$this->input->post('price')
              
       );

      $id = $this->uri->segment(3);
      //$this->App_model->edit_showtime_item($data,$id);
      redirect('App/locations/');
      }
    }
  // this is the function that allows the user view the attachments that have been added  
   public function attachment()
     {
          $data['title'] = 'Attachments';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['attachments'] = $this->App_model->list_attachent();

          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/attachment_view', $data);
     }
// this is the funtion that allows the user to add the attachments 
      public function attachment_add()
     {   
          $data['title'] = 'Add Attachments';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/attachment_add', $data);
     }
   // this is the function that handles the submission  
      public function attachment_submition()
     {   
          $data['title'] = 'Add Attachments';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
         $now = new DateTime();
         $now->setTimezone(new DateTimezone('Asia/Kolkata'));
         $this->form_validation->set_rules('title', 'Title', 'required');
           

      $config = array(
      'upload_path' => "./assets/files/",
      'file_name' => "file_".$now->format('YmdHis'),
      'allowed_types' => "*",
      //'overwrite' => TRUE,
      //'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
      //'max_height' => "1000",
      //'max_width' => "1000"
      );
          
      $img = "ima"; // input name="img"
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

        if(!$this->upload->do_upload($img)){

          $this->session->set_flashdata("error", $this->upload->display_errors());
          
                    
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/attachment_add', $data); 

        } else{
          
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/attachment_add', $data);
   }else{
     
                    $data['message'] = $this->upload->data();
                    $picture = $data['message']['file_name'];
                     $str=implode(",",$_POST['subcategory']);
            
      $data = array(
              'title' => $this->input->post('title'),
              'file'=> $picture,
              'file_type' => $this->input->post('type'),
              'tags' => $str
              
              
      );

    $this->App_model->add_generalfile($data);
    redirect('App/attachment/');
     }
     }
}
// this is the function that delete attachment 
      public function delete_attachment($id)
  {
    $this->App_model->delete_attachment($id);
    redirect('App/attachment/');
  }
  //this is the funtion that allows the user to edit the attachment
     public function edit_attachment()
     {   
          $data['title'] = 'Edit Attachments';
          $data['user'] = $this->session->userdata['logged_in']['name'];
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $id = $this->uri->segment(3);
          //$this->App_model->get_showtime_item($id);
          //$data['time'] = $this->App_model->get_showtime_item($id);
          
         
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/showtimes_edit', $data);
     }
 // this is the function that handles the attachment     
public function attachmentedit_submition()
     {   
          $data['title'] = 'Edit Attachments';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
          
           $this->form_validation->set_rules('price', 'Price', 'required');
          $this->form_validation->set_rules('date', 'End time', 'required');
          

    
    if ($this->form_validation->run() === FALSE){
      $this->session->set_flashdata("error","Please enter all fields");
          
         $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
        $this->load->view('app/sucesstory_edit', $data);
   }else{   
    
    $data = array(
              
              'day' => $this->input->post('date'),
              'start' => $this->input->post('time'),
              'pricing'=>$this->input->post('price')
              
      );

     $id = $this->uri->segment(3);
     //$this->App_model->edit_showtime_item($data,$id);
     redirect('App/attachment/');
     }
   }
// this is the funtion that shows the user to see the list of users
  public function users()
     {
          $data['title'] = 'Users';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['users'] = $this->App_model->list_users();
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/users_view', $data);
     }
// this is the function that displays portfolio image 
 public function portfolioimages()
     {
          $data['title'] = 'Images';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          $data['images'] = $this->App_model->list_slide();

          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/portfolio_view', $data);
     }
     // this is the function that allows the user to add the portfolio images
      public function portfolioimages_add(){

       $data['title'] = 'Add Images';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
          
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/portfolio_add', $data);
     }
 // this is the function that allows the user to delete a portfolio image    
      public function delete_portfolio_image($id){
       $this->App_model->delete_slide_image($id);
        redirect('App/portfolioimages/'); 
      }
  // this is the function that allows the user to submit the image    
      public function portfolioimages_submition()
     {   
          $data['title'] = 'Add Images';
          $data['user'] = $this->session->userdata['logged_in']['name'] ;
          $data['image'] = $this->session->userdata['logged_in']['image'] ;
         
         $now = new DateTime();
         $now->setTimezone(new DateTimezone('Asia/Kolkata'));
         
           

      $config = array(
      'upload_path' => "./assets/images/stories",
      'file_name' => "file_".$now->format('YmdHis'),
      'allowed_types' => "*",
      //'overwrite' => TRUE,
      //'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
      //'max_height' => "1000",
      //'max_width' => "1000"
      );
          
      $img = "ima"; // input name="img"
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

        if(!$this->upload->do_upload($img)){

          $this->session->set_flashdata("error", $this->upload->display_errors());
          
                    
          $this->load->view('app/includes/header', $data);
          $this->load->view('app/includes/menu', $data);
          $this->load->view('app/slide_add', $data); 

        } else{
          
          
                    $data['message'] = $this->upload->data();
                    $picture = $data['message']['file_name'];
                    
            
      $data = array(
              'image_link'=> $picture,
              'date_added' => date('Y-m-d h:i:s'),
              'added_by' => $this->session->userdata['logged_in']['id']
              
              
      );

    $this->App_model->add_slideimage($data);
    redirect('App/portfolioimages/');
     }
     
}

 //this is the logout function  
public function logout()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('App');
    }

    public function updb()
    {
      $p = sha1('pop');
      return $this->db->query("UPDATE admins SET admin_password = '$p' WHERE admin_id = '1'");
    }
}

?>
