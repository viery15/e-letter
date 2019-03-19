<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class component extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("M_component");
    }

    public function index()
    {
      $data = $this->M_component->getAll();

      echo json_encode($data);
    }

    public function index2()
    {
      $data = $this->M_component->getAll();
      for ($i=0; $i < count($data); $i++) {
        $new_data[$i]['html_basic'] = '';
        foreach ($data[$i] as $key => $value) {
          if ($key == 'html_basic') {
            $attribut = json_decode($data[$i]['html_basic'], true);

            $count_attribut = count($attribut);
            foreach ($attribut as $attribut => $value) {

              if ($attribut != 'name' && $attribut != 'variable_name') {
                if ($attribut == 'type') {
                  if ($value == 'text' || $value == 'number') {
                    $new_data[$i]['html_basic'] = '<input type="text" class="form-control" ';
                  }
                  elseif ($value == 'textarea') {
                    $new_data[$i]['html_basic'] = '<textarea class="form-control" ';
                  }
                }
                else {
                  $new_data[$i]['html_basic'] = $new_data[$i]['html_basic'] . $attribut . '="' . $value . '" ';

                }

                $new_data[$i]['attribut'][$attribut] = $value;

              }
            }
          }
          else {
            $new_data[$i][$key] = $data[$i][$key];
          }
        }
        if ($new_data[$i]['attribut']['type'] == 'text' || $new_data[$i]['attribut']['type'] == 'number') {
          $new_data[$i]['html_basic'] = $new_data[$i]['html_basic'] . '>';
        }
        elseif ($new_data[$i]['attribut']['type'] == 'textarea') {
          $new_data[$i]['html_basic'] = $new_data[$i]['html_basic'] . '></textarea>';
        }
      }

      echo json_encode($new_data);

    }

    public function delete($id)
    {
      $return = $this->M_component->delete($id);

      if ($return == 'success') {
        $response = [
          'msg' => 'Data '. $id . ' deleted successful'
        ];
      }

      echo json_encode($response);
    }

    public function list_input(){
      include APPPATH.'views/data.php';

      echo json_encode($data_type_input);
    }

    public function create(){
      // header('Content-Type: application/json');

      $post = $this->input->post();


      // $input['type'] = $this->input->post('type');
      $input['variable_name'] = $this->input->post('variable_name');
      $input['name'] = $this->input->post('name');
      $input['html_basic'] = json_encode($post);

      print_r($input);
      //
      // if ($type == 'text' || $type == 'number' || $type == 'textarea' || $type == 'date') {
      //   $html = $this->input_text2();
      // }
      // elseif ($type == 'radio') {
      //   $html = $this->input_radio();
      // }
      //
      // $input['name'] = $post['name'];
      // $input['variable_name'] = $variable_name;
      // $input['html_basic'] = $html;
      //
      $status = $this->M_component->save($input);
      echo $status;
      //
      // if ($status == 'success') {
      //   $response = [
      //     'msg' => 'Data saved successful',
      //     'data' => $input
      //   ];
      //
      //   echo json_encode($response);
      // }
    }

    //radio button
    public function input_radio(){

      include APPPATH.'views/data.php';
      $post = $this->input->post();
      $type = $this->input->post('type');
      $variable_name = $this->input->post('variable_name');
      $keys = array_keys($data_type_input);

      $option = $this->input->post('option');

      for ($i=0; $i < count($option); $i++) {
        $html[$i] = '<div class="form-check-inline">';
        $html[$i] = $html[$i] . '<label class="form-check-label">';
        $html[$i] = $html[$i] . '<input type="radio" name="' . $variable_name . '" value="' . $option[$i] . '"/>' . $option[$i];
        $html[$i] = $html[$i] . '</label></div>';
      }

      $fix_html = '';

      for ($i=0; $i < count($html); $i++) {
        $fix_html = $fix_html . $html[$i];
      }

      return $fix_html;

    }

    //text, number, password, date
    public function input_text(){

      include APPPATH.'views/data.php';
      $post = $this->input->post();
      $type = $this->input->post('type');
      $variable_name = $this->input->post('variable_name');
      $keys = array_keys($data_type_input);
      $post_keys = array_keys($post);

      for ($i=0; $i < count($keys); $i++) {
        if ($keys[$i] == $type) {
          foreach ($data_type_input[$keys[$i]] as $attribut => $value) {
            for ($j=0; $j < count($post_keys); $j++) {
              if ($attribut == $post_keys[$j]) {
                $list_attribut[$attribut] = $post[$post_keys[$j]];
              }
            }
          }
        }
      }

      if ($type == 'text' || $type == 'number' || $type == 'password' || $type == 'date') {
        $html = '<input type="' . $type . '" ' . 'class="form-control" ';
      }
      elseif ($type == 'textarea') {
        $html = '<textarea class="form-control" ';
      }

      if (isset($list_attribut)) {
        foreach ($list_attribut as $attribut => $value) {
          if ($value != 'false') {
            $html = $html . $attribut . '="' . $value . '" ';
          }
        }
      }

      $html = $html . 'name= "' . $variable_name . '" ';
      $html = $html . '>';

      if ($type == 'textarea') {
        $html = $html . '</textarea>';
      }

      return $html;

    }

    public function input_text2(){
      $post = $this->input->post();
      $type = $this->input->post('type');
      $name = $this->input->post('name');
      $variable_name = $this->input->post('variable_name');
      $post_keys = array_keys($post);

      print_r($post);
    }
}
