<?php
/**
 * 
 */
class Car_model extends CI_model
{

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

  }
	#this methof will show car listing page
	function create($formArray)
	{
		$this->db->insert('car_models',$formArray);
		return $id = $this->db->insert_id();

		#echo "Hey How are you";
		# code...
	}
	//to return all data from table
	function all(){
		$result = $this->db
					->order_by('id','ASC')
					->get('car_models')
					->result_array();
					//select * from car_models order by id ASC
					return $result;
	}
	function getRow($id){

		$this->db->where('id',$id);
		$row = $this->db->get('car_models')->row_array();
		return $row;
	}
	function update($id,$formArray){
		$this->db->where('id',$id);
		$this->db->update('car_models',$formArray);
		return $id;

	}

	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('car_models');
	}
}


?>