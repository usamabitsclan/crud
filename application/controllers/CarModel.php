<?php
/**
 * 
 */
class CarModel extends CI_controller
{
	#this method will login
	function user(){
		$this->load->view('user');

	}
	function login(){
		$this->load->view('login');
	}
	function canlogin()
      {
      	//print_r($this->input->post('email'));
      	//print_r($this->input->post('password'));
      	      $this->load->library('form_validation');

        $this->load->model('Car_model');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == false) {
            $this->load->view('login');
        }
        else {
          //save record in database

          $email = $this->input->post('email');
          $password = $this->input->post('password');
          $query =  $this->Car_model->check($email,$password);
          $data = array();
          $data['users'] = $query;

          if($query['user_role'] == 1)
          {
          	//this is user role
            $this->session->set_flashdata('success','Logged In Successfully as admin!');
            redirect(base_url().'index.php/CarModel/index');
          }
          elseif ($query['user_role'] == 2) {
          	//this is admin role
            $this->session->set_flashdata('success','Logged In Successfully as admin!');
            redirect(base_url().'index.php/CarModel/Adminindex');
          }

          $this->session->set_flashdata('success','Invalid Credentials');
          redirect(base_url().'index.php/CarModel/login');

          $this->session->set_flashdata('success','Logged In Successfully!');
       
        }

      }

	function index()
	{	
		//echo "Hey How are you";
		$this->load->model('Car_model');
		$rows = $this->Car_model->all();
		$data['rows'] = $rows;

		$this->load->view('list',$data);
		# code...
	}
	function Adminindex()
	{	
		//echo "Hey How are you";
		$this->load->model('Car_model');
		$rows = $this->Car_model->all();
		$data['rows'] = $rows;

		$this->load->view('Adminlist',$data);
		# code...
	}
	function showCreateForm(){
		// There is a third optional parameter lets you change the behavior of the function so that it returns data as a string rather than sending it to your browser. This can be useful if you want to process the data in some way. If you set the parameter to true (boolean) it will return data. The default behavior is false, which sends it to your browser. Remember to assign it to a variable if you want the data returned:
		$html = $this->load->view('create','',true);
		$response['html'] = $html;
		echo json_encode($response);
	}
	function saveModel(){
		$this->load->model('Car_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('color','Color','required');
		$this->form_validation->set_rules('price','Price','required');

		if($this->form_validation->run() == true){
			$formArray = array();
			$formArray['name'] = $this->input->post('name');
			$formArray['color'] = $this->input->post('color'); 
			$formArray['transmission'] = $this->input->post('transmission'); 
			$formArray['price'] = $this->input->post('price'); 
			$formArray['created_at'] = date('Y-m-d H:i:s');
			$formArray['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->Car_model->create($formArray);

			$row = $this->Car_model->getRow($id);
			$vData['row'] = $row;
			
			$rowhtml = $this->load->view('carrow',$vData,true);

			//save enteries to DB
			$response['row'] = $rowhtml;
			$response['status'] = 1;
			$response['message'] = "<div class=\"alert alert-success\">Record has been added successfully.</div>"; 



		}else{
			//return error messages
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['color'] = strip_tags(form_error('color'));
			$response['price'] = strip_tags(form_error('price'));


		}
		echo json_encode($response);
	}
// this function will edit using ajax
	function getCarModel($id){
		$this->load->model('Car_model');

		$rowss = $this->Car_model->getRow($id);
		//print_r($rowss);
		$data['row'] = $rowss;
		//print_r($data['row']['name']);


		$html = $this->load->view('edit',$data,true);
		$response['html'] = $html;
		echo json_encode($response);

	}

	function updateModel(){
		//print_r("here");
		$this->load->model('Car_model');
		$id = $this->input->post('id');
		$rowss = $this->Car_model->getRow($id);

		if(empty($rowss)){
			//print_r("empty row");
			$response['msg'] = "Either record deleted or not  found in DB";
			$response['status'] = 100;
			json_encode($response);
			exit;
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('color','Color','required');
		$this->form_validation->set_rules('price','Price','required');

		if($this->form_validation->run() == true){
			$formArray = array();
			$formArray['name'] = $this->input->post('name');
			$formArray['color'] = $this->input->post('color'); 
			$formArray['transmission'] = $this->input->post('transmission'); 
			$formArray['price'] = $this->input->post('price'); 
			$formArray['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->Car_model->update($id,$formArray);
			//print_r("updated row");

			$row = $this->Car_model->getRow($id);
			//$vData['row'] = $row;
			
			//$rowhtml = $this->load->view('carrow',$vData,true);

			//save enteries to DB
			//$response['row'] = $rowhtml;
			$response['row'] = $row;

			$response['status'] = 1;
			$response['message'] = "<div class=\"alert alert-success\">Record has been updated successfully.</div>"; 



		}else{
			//return error messages
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['color'] = strip_tags(form_error('color'));
			$response['price'] = strip_tags(form_error('price'));


		}
		echo json_encode($response);
	}

	function deleteModel($id){

		$this->load->model('Car_model');
		//	$id = $this->input->post('id');
		$rowss = $this->Car_model->getRow($id);

		if(empty($rowss)){
			//print_r("empty row");
			$response['msg'] = "<div class=\"alert alert-danger\">Either record deleted or not  found in DB</div>";
			$response['status'] = 0;
			echo json_encode($response);
			
			exit;
		}
		else{
			$this->Car_model->delete($id);
			$response['msg'] = "<div class=\"alert alert-success\">Record has been deleted</div>";
			$response['status'] = 0;
			echo json_encode($response);
           	//location.reload(); // then reload the page.(3)
		}

	}
}


?>