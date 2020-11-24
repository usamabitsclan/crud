<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class ajaxCrudController extends CI_Controller {
      //functions

      function updating(){
		//print_r("here");
		$this->load->model('ajax_crud_model');
		$id = $this->input->post('id');
		$rowss = $this->ajax_crud_model->getRow($id);

		if(empty($rowss)){
			//print_r("empty row");
			$response['msg'] = "Either record deleted or not  found in DB";
			$response['status'] = 100;
			json_encode($response);
			exit;
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','password','required');

		if($this->form_validation->run() == true){
			$formArray = array();
			$formArray['name'] = $this->input->post('name');
			$formArray['email'] = $this->input->post('email');
			$formArray['password'] = $this->input->post('password');
			$id = $this->ajax_crud_model->update($id,$formArray);
			//print_r("updated row");

			$row = $this->ajax_crud_model->getRow($id);
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
  function delete($id){

		$this->load->model('ajax_crud_model');
		//	$id = $this->input->post('id');
		$rowss = $this->ajax_crud_model->getRow($id);

		if(empty($rowss)){
			//print_r("empty row");
			$response['msg'] = "<div class=\"alert alert-danger\">Either record deleted or not  found in DB</div>";
			$response['status'] = 0;
			echo json_encode($response);

			exit;
		}
		else{
			$this->ajax_crud_model->delete($id);
			$response['msg'] = "<div class=\"alert alert-success\">Record has been deleted</div>";
			$response['status'] = 0;
			echo json_encode($response);
           	//location.reload(); // then reload the page.(3)
		}

	}

      function update($id){

        $this->load->model('ajax_crud_model');

		    $rowss = $this->ajax_crud_model->getRow($id);
		    //print_r($rowss);
		    $data['row'] = $rowss;
		    //print_r($data['row']['name']);

        //$this->load->view('update',$data);
		    $html = $this->load->view('update',$data,true);
		    $response['html'] = $html;
		    echo json_encode($response);
      }
      function usama(){
        echo "USama";
      }
      function index(){
           $data["title"] = "BITSCLAN CRUD";
           $this->load->view('ajaxcrud', $data);
      }
      function fetch_user(){
           $this->load->model("ajax_crud_model");
           $fetch_data = $this->ajax_crud_model->make_datatables();
           $data = array();
           foreach($fetch_data as $row)
           {
                $sub_array = array();
                //$sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';
                $sub_array[] = $row->name;
                $sub_array[] = $row->email;
                $sub_array[] = $row->password;
                $sub_array[] = $row->user_role;

//                <button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs">Update</button>
                $sub_array[] = '<a href="javascript:void(0);" onclick="update(id);" id="'.$row->id.'" class="btn btn-primary">update</a>';
                $sub_array[] = '<a href="javascript:void(0);" onclick="deletee(id);" id="'.$row->id.'" class="btn btn-danger">Delete</a>';
                $data[] = $sub_array;
           }
           $output = array(
                "draw"                    =>     intval($_POST["draw"]),
                "recordsTotal"          =>      $this->ajax_crud_model->get_all_data(),
                "recordsFiltered"     =>     $this->ajax_crud_model->get_filtered_data(),
                "data"                    =>     $data
           );
           echo json_encode($output);
      }
 }
