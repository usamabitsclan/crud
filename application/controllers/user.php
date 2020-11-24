<?php
  class User extends CI_controller{

      function edit($userId)
      {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($userId);
        $data = array();
        $data['user'] = $user;
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');

        if($this->form_validation->run() == false) {
            $this->load->view('edit',$data);
        }
        else {
          //update record in database
          $formArray = array();
          $formArray['name'] = $this->input->post('name');
          $formArray['email'] = $this->input->post('email');
          $this->User_model->updateUser($userId,$formArray);
          $this->session->set_flashdata('success','Record Updated Successfully!');
          redirect(base_url().'index.php/user/index');
        }

      }
      function login()
      {
        $this->load->model('User_model');
        $this->load->view('login');
      }
      function userlogin()
      {
        //$this->load->model('User_model');
        $this->load->view('user');
      }
      function index()
      {
        $this->load->model('User_model');
        $users = $this->User_model->all();
        $data = array();
        $data['users'] = $users;
        // print_r($users);
        // print_r($data['users']);
        // echo $users['user_id'];
        // echo $users['name'];
        // echo $users['email'];
        //print_r($users);
        $this->load->view('list',$data);
      }
      function canlogin()
      {
        $this->load->model('User_model');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == false) {
            $this->load->view('login');
        }
        else {
          //save record in database

          $email = $this->input->post('email');
        //$pass_word = $this->encrypt->encode(input->post('pass_word'));
        //  $password = $this->encrypt->encode(input->post('password'));
        $password = md5($this->input->post('password'));
          $query =  $this->User_model->check($email,$password);
          $data = array();
          $data['users'] = $query;
          //print_r($query['user_id']);

          if($query['user_role'] == 1)
          {
            $this->session->set_flashdata('success','Logged In Successfully as admin!');
            redirect(base_url().'index.php/user/index');
          }
          elseif ($query['user_role'] == 2) {
            $this->session->set_flashdata('success','Logged In Successfully as admin!');
            redirect(base_url().'index.php/user/userlogin');
          }

          $this->session->set_flashdata('success','Invalid Credentials');
          redirect(base_url().'index.php/user/login');

          //
          //  $data['users'] = $query;
          //  print_r($query);
          //  print_r($query['user_id']);
          //
          // if($email == "admin@gmail.com" && $password = 123123)
          // {
          //   $this->session->set_flashdata('success','Logged In Successfully as admin!');
          //   redirect(base_url().'index.php/user/index');
          // }

          // $users = $this->User_model->all();
          // $data = array();
          // $data['users'] = $users;
          // print_r("here");
          // if($users[0]['email'] == $email){
          //   print_r($email);

          //}



        //  print_r($users[1]['name']);
          //print_r($email);
          //print_r($password);
           //$this->User_model->check($email,$password);

          //$user = $this->User_model->getUser($userId);



          $this->session->set_flashdata('success','Logged In Successfully!');
          // redirect(base_url().'index.php/user/index');

        }

      }
      function create()
      {
        //calling model
        $this->load->model('User_model');
        //applying Validation
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == false) {
            $this->load->view('create');
        }
        else {
          //save record in database

          $formArray =  array();
          $formArray['name'] = $this->input->post('name');
          $formArray['email'] = $this->input->post('email');
          $formArray['password'] = md5($this->input->post('password'));
          $formArray['user_role'] = 2;
          $formArray['created_at'] = date('Y-m-d');

          $this->User_model->create($formArray);
          $this->session->set_flashdata('success','Record Added Successfully!');
          redirect(base_url().'index.php/user/index');

        }


      }

      function delete($userId)
      {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($userId);


        if(empty($user)){
          $this->session->set_flashdata('failure','Record doesnt Exist !');
          redirect(base_url().'index.php/user/index');
        }
        print_r($userId);
        $this->User_model->deleteUser($userId);
        $this->session->set_flashdata('success','Record deleted Successfully !');
        redirect(base_url().'index.php/user/index');
      }
  }
?>
