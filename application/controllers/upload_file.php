<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_file extends CI_Controller {
    function  __construct() {
        parent::__construct();

        // Load file model
        $this->load->model('File');
    }

    function googleapi(){
      $this->load->library('googlemaps');
      $this->googlemaps->initialize();
      $data['map'] = $this->googlemaps->create_map();
        $this->load->view('googleapi2');

    }
    function index(){
        $data = array();

        // Get files data from the database
        $data['files'] = $this->File->getRows();

        // Pass the files data to view
        $this->load->view('Upload_File', $data);
    }
    function deletefile($id){
      printf("ID Here is ".$id);
      $insert = $this->File->deletefile($id);
      //$this->load->view('Upload_File', $data);
      redirect('/Upload_file');
      exit();
    }
    function dragDropUpload(){
        if(!empty($_FILES)){
            // File upload configuration
            $uploadPath = 'uploads/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = '*';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to the server
            if($this->upload->do_upload('file')){
                $fileData = $this->upload->data();
                $uploadData['file_name'] = $fileData['file_name'];
                $uploadData['uploaded_on'] = date("Y-m-d H:i:s");

                // Insert files info into the database
                $insert = $this->File->insert($uploadData);
            }
        }
    }
}
