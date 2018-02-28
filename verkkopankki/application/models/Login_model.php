<?php

class Login_model extends CI_Model
{
     public function login($data)
     {
          $condition = "verkkopankkitunnus =" . "'" . $data['verkkopankkitunnus'] . "' AND " . "salasana =" . "'" . $data['salasana'] . "'";
          $this->db->select('*');
          $this->db->from('tilioikeudet');
          $this->db->where($condition);
          $this->db->limit(1);

          $query = $this->db->get();

          if($query->num_rows() == 1)
          {
               return true;
          }
          else
          {
               return false;
          }

     }

     public function get_password($form_username)
     {
          $this->db->select('salasana');
          $this->db->from('tilioikeudet');
          $this->db->where('verkkopankkitunnus', $form_username);
          return $this->db->get()->row('salasana');
     }

     public function get_korttipassword($formidkortti)
     {
          $this->db->select('salasana');
          $this->db->from('kortti');
          $this->db->where('idkortti', $formidkortti);
          //$database_password _hash('salasana')
          return $this->db->get()->row('salasana');
     }

	public function admin_check($username, $form_password, $database_password)
     {

          if(password_verify($form_password, $database_password) && $username ==='admin')
          {
               return true;
          }

          else
          {
               return false;
          }
	}
     public function register_user()
     {
          $tilidata = array(

               'saldo' => '0'
          );
          $this->db->insert('tili', $tilidata);
          $idtili = $this->db->insert_id();

          $asiakasdata= array(
               'etunimi' => $this->input->post('etunimi'),
               'sukunimi' => $this->input->post('sukunimi'),
               );
               $this->db->insert('asiakas', $asiakasdata);
               $idasiakas = $this->db->insert_id();

               $form_password = $this->input->post('salasana');
               $database_password = password_hash($form_password, PASSWORD_DEFAULT);

          $logindata = array(
               //'idtilioikeudet' => $asiakkaanid,
               'verkkopankkitunnus' => $this->input->post('verkkopankkitunnus'),
               'salasana' => $database_password,
               'idasiakas' => $idasiakas,
               'idtili' => $idtili,

          );
                    $this->db->insert('tilioikeudet', $logindata);
               }
}
