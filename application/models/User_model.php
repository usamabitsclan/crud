<?php

class User_model extends CI_model
{
  function create($formArray)
  {
    $this->db->insert('users',$formArray); //inserts into user (name email)
  }
  function check($email,$password)
  {

    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('email',$email);
    $this->db->where('password',$password);

    if($query=$this->db->get())
  {
      //return $query->num_rows();
      return $query->row_array();
  }
  else{
    return false;
  }

    // if ($this->db->where('email',$email)) {
    //   return $this->db->get('users')->row_array();
    //   print_r("Correct email");
    //   if ($this->db->where('password',$password)) {
    //      print_r("Incorrect password");
    //      return $this->db->get('users')->row_array();
    //   }
    // }else{
    //    return $user = null;
    // }


  }

  function all(){
    return $users =   $this->db->get('users')->result_array(); //select * from users

  }
  function getUser($userId){
    $this->db->where('id',$userId);
    return $this->db->get('users')->row_array(); //select * from Users where ID is this
  }
  function updateUser($userId,$formArray){
    $this->db->where('id',$userId);
    return $this->db->update('users',$formArray); //Update User where id this ->populate these values
  }

  function deleteUser($userId){
    $this->db->where('id',$userId);
    return $this->db->delete('users'); //select * from Users where ID is this
  }

}
?>
