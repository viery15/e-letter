<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_component extends CI_Model
{
    private $_table = "eletter.component";

    public function getAll(){
      $this->db->order_by('id','DESC');
      return $this->db->get($this->_table)->result();
    }

    public function save($input){
      $this->db->insert($this->_table, $input);

      return 'success';
    }

    public function delete($id) {
      $this->db->delete($this->_table, array('id' => $id));

      return 'success';
    }

    public function update($id) {
      $post = $this->input->post();

      $this->db->update($this->_table, $this, array('id' => $id));
    }

}
