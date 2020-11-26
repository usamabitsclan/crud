<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fullcalendar extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('fullcalendar_model');
  $this->load->helper('randomColor_helper');

 }
 function phpdropzone(){
   foreach($myitemfiles as $file){ //get an array which has the names of all the files and loop through it
        $obj['name'] = $file; //get the filename in array
        $obj['size'] = filesize("Uploaads/".$file); //get the flesize in array
        $result[] = $obj; // copy it to another array
      }
       header('Content-Type: application/json');
       echo json_encode($result); // now you have a json response which you can use in client side
 }
function dropzone(){
  $this->load->view('dropzone');

}
function getimages(){
  $this->load->model('File');
  $data = array();

  // Get files data from the database
  $data['files'] = $this->File->getRows();
  $data = $data['files'];
  //var_dump($data);
  // Pass the files data to view
  echo json_encode($data);
}
function removedropzone(){
  $uploadDir = 'Uploads';

if ($_POST['request'] == "add") {
    if (!empty($_FILES)) {
     $tmpFile = $_FILES['file']['tmp_name'];
     $filename = $uploadDir.'/'.$_FILES['file']['name'];
     move_uploaded_file($tmpFile,$filename);
    }
}else{

    $this->load->model('File');
    $name = $_POST['name'];
    $this->File->deleteefile($name);
    $fileName = $uploadDir.'/'.$_POST['name'];
    unlink($fileName);
}
}
function uploadphp(){
  $target_dir = "Uploads/"; // Upload directory

  $request = 1;
  if(isset($_POST['request'])){
    $request = $_POST['request'];
  }

  // Upload file
  if($request == 1){
    //$filename = $target_dir.$_POST['name'];
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $msg = "";
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
      $msg = "Successfully uploaded";
    }else{
      $msg = "Error while uploading";
    }
    echo $msg;
    exit;
  }

  // Remove file
  if($request == 2){
    $filename = $target_dir.$_POST['name'];
    unlink($filename);
    exit;
  }
}
 function index()
 {
  $this->load->view('fullcalendar');
 }

 function load()
 {
  $event_data = $this->fullcalendar_model->fetch_all_event();

  foreach($event_data->result_array() as $row)
  {
   $data[] = array(
    'id' => $row['id'],
    'title' => $row['title'],
    'start' => $row['start_event'],
    'end' => $row['end_event'],
    'color' => '#'.$row['color'],
    'allDay' => false,
    //'color' => $row['color']
    //'#'+Math.random().toString(16).substr(-6).substr(-1)
   );
  }
  echo json_encode($data);
 }

 function insert()
 {
  if($this->input->post('title'))
  {
   $data = array(
    'title'  => $this->input->post('title'),
    'start_event'=> $this->input->post('start'),
    'end_event' => $this->input->post('end'),
    'color' => makeRandomColor()
   );
   $this->fullcalendar_model->insert_event($data);
  }
 }

 function update()
 {
  if($this->input->post('id'))
  {
   $data = array(
    'title'   => $this->input->post('title'),
    'start_event' => $this->input->post('start'),
    'end_event'  => $this->input->post('end')
   );

   $this->fullcalendar_model->update_event($data, $this->input->post('id'));
  }
 }

 function delete()
 {
  if($this->input->post('id'))
  {
   $this->fullcalendar_model->delete_event($this->input->post('id'));
  }
 }

}

?>
