<?php

class Pankki_model extends CI_Model {

          public function __construct()
          {
               $this->load->database();
          }

          public function get_asiakastieto($idasiakas = FALSE)
          {
               if($idasiakas === FALSE)
               {
                    $query = $this->db->get('asiakas');
                    return $query->result_array();
               }

               $query = $this->db->get_where('asiakas', array('idasiakas' =>$_SESSION['idasiakas']));
               return $query->row_array();
          }

          public function get_user_asiakastieto()
          {
               $this->db->select('idasiakas');
               $this->db->from('tilioikeudet');
               $this->db->where('verkkopankkitunnus', $_SESSION['user']);
               $_SESSION['idasiakas'] = $this->db->get()->row('idasiakas');

               $query = $this->db->get_where('asiakas', array('idasiakas' =>$_SESSION['idasiakas']));
               return $query->result_array();
          }

          public function get_user_tilitieto($id)
          {
               $query = $this->db->get_where('tili', array('idtili' =>$id));
               return $query->result_array();
          }

          public function get_tilitieto()
          {
               $query = $this->db->get('tili');
               return $query->result_array();
          }

          public function get_tilioikeustieto()
          {
               $query = $this->db->get('tilioikeudet');
               return $query->result_array();
          }

          public function get_user_tilioikeustieto()
          {
               $query = $this->db->get_where('tilioikeudet', array('verkkopankkitunnus' =>$_SESSION['user']));
               return $query->result_array();
          }

          public function get_korttitiedot()
          {
               $query = $this->db->get('kortti');
               return $query->result_array();
          }

          public function get_oikeustiedot()
          {
               $query = $this->db->get('tilioikeudet');
               return $query->result_array();
          }

          public function get_saldo($id)
          {
               $query = $this->db->get_where('tili', array('idtili' =>$id));
               return $query->row('saldo');

          }

          public function tilisiirto($idsend, $idreceive, $amount)
          {
               $this->db->trans_start();

               $column = 'idtili';
               $table = 'tili';

               $query = $this->db->get_where('tili', array('idtili' =>$idsend));
               $sendsaldo = $query->row('saldo');


               $query = $this->db->get_where('tili', array('idtili' =>$idreceive));
		$check = $query->num_rows();
               $receivesaldo = $query->row('saldo');

               $update_send = array(
                         'saldo' => $sendsaldo - $amount,
               );

               $update_receive = array(
                         'saldo' => $receivesaldo + $amount,
               );

               $this->db->where($column, $idsend);
               $this->db->update($table, $update_send);

               $this->db->where($column, $idreceive);
               $this->db->update($table, $update_receive);


               if($sendsaldo < $amount)
               {
                    $this->db->trans_rollback();
                    $data = "Tilillä ei ole tarpeeksi rahaa tilisiirron suorittamiseksi.";
                    return $data;
               }

               elseif($this->db->trans_status() === FALSE)
               {
                    $this->db->trans_rollback();
                    $data = "Jokin meni pieleen. Yritä suorittaa siirto uudelleen.";
                    return $data;


               }

               elseif ($check >= 1)
               {
		    $this->db->trans_complete();
                    $data  = 'Rahojen siirto onnistui';
                    return $data;
               }
		else
		{
			$this->db->trans_rollback();
                    $data = "Jokin meni pieleen. Yritä suorittaa siirto uudelleen.";
                    return $data;

		}


          }

          public function korttisiirto($id, $amount)
          {
               $column = 'idtili';
               $table = 'tili';

               $query = $this->db->get_where('tili', array('idtili' =>$id));
               $saldo = $query->row('saldo');

               $update_data = array(
                         'saldo' => $saldo - $amount,
               );

               $this->db->where($column, $id);
               $this->db->update($table, $update_data);
          }

          public function set_asiakas()
          {
               $data = array(
                    'idasiakas'=> $this->input->post('idasiakas'),
                    'etunimi' => $this->input->post('etunimi'),
                    'sukunimi' => $this->input->post('sukunimi'),
                    );

                    $this->db->insert('asiakas', $data);
          }

          public function get_selected($table, $column, $selected_id)
          {
               $this->db->select('*');
               $this->db->from($table);
               $this->db->where($column, $selected_id);
               return $this->db->get()->result_array();
          }

          public function update_selected($table, $column, $data, $id)
          {
               //$this->db->db_debug = false;
               $this->db->where($column, $id);
               $test = $this->db->update($table, $data);
               return $test;
          }

          public function delete_tili($id)
          {
                    $this->db->where('idtili', $id);
                    $this->db->delete('tilioikeudet');

                    $this->db->where('idtili', $id);
                    $this->db->delete('tili');

          }

          public function delete_kortti($id)
          {
               $this->db->where('idkortti', $id);
               $this->db->delete('kortti');
          }

          public function delete_selected($table, $column, $id)
          {
               if($id == '1000')
               {

               }



               else{
                    //Poistetaan Tili Asiakasidllä
                    $this->db->select('idtili');
                    $this->db->from('tilioikeudet');
                    $this->db->where('idasiakas', $id);
                    $idtili = $this->db->get()->row('idtili');

                    $this->db->select('idkortti');
                    $this->db->from('kortti');
                    $this->db->where('idtili', $idtili);
                    $idkortti = $this->db->get()->row('idkortti');

                    $this->db->where($column, $id);
                    $test = $this->db->delete('tilioikeudet');

                    //Poistetaan kortti Asiakasidllä

                    $this->db->where('idkortti', $idkortti);
                    $this->db->delete('kortti');

                    $this->db->where('idtili', $idtili);
                    $this->db->delete('tili');



                    $this->db->where($column, $id);
                    $this->db->delete('asiakas');
                    return $test;
               }
          }

          public function register_tili($id)
          {
               $this->db->select('salasana');
               $this->db->from('tilioikeudet');
               $this->db->where('idasiakas', $id);
               $salasana = $this->db->get()->row('salasana');

               $this->db->select('verkkopankkitunnus');
               $this->db->from('tilioikeudet');
               $this->db->where('idasiakas', $id);
               $tunnus = $this->db->get()->row('verkkopankkitunnus');

               $tilidata = array(
                    'saldo' => '0'
               );

               $this->db->insert('tili', $tilidata);
               $idtili = $this->db->insert_id();

               $logindata = array(
                    'verkkopankkitunnus' => $tunnus,
                    'salasana' => $salasana,
                    'idasiakas' => $id,
                    'idtili' => $idtili,

               );


                         $this->db->insert('tilioikeudet', $logindata);
                    }

               public function register_kortti($id)
               {

                    $idtili = $id;
                    $data = array(
                         'idtili'=> $id,
                         'salasana' => $this->input->post('salasana'),
                         );

                         $this->db->insert('kortti', $data);

               }


}
