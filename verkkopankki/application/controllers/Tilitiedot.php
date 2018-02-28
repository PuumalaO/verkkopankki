<?php

class Tilitiedot extends CI_Controller{

          public function __construct()
          {
                    parent::__construct();
                    $this->load->model('Pankki_model');
                    $this->load->model('Login_model');

                    $this->load->helper('url');
          }

          public function lataa_etusivu()
          {
               $data['page'] = 'templates/home';
               $this->load->view('templates/content', $data);

          }

          public function asiakastieto()
          {
               $data['asiakasdata'] = $this->Pankki_model->get_asiakastieto();
               $data['tilidata'] = $this->Pankki_model->get_tilitieto();
               $data['title'] = 'Asiakastiedot';

               $this->load->view('templates/header', $data);
               $this->load->view('tili/nayta_asiakas', $data);
               $this->load->view('templates/footer');
          }

          public function user_asiakastieto()
          {
               $data['asiakasdata'] = $this->Pankki_model->get_user_asiakastieto();
               $this->load->view('templates/header', $data);
               $this->load->view('tili/nayta_asiakas', $data);
               $this->load->view('templates/footer');
          }

          
          public function tilitieto()
          {
               $data['tilidata'] = $this->Pankki_model->get_tilitieto();
               $data['title'] = 'Tilitiedot';

               $this->load->view('templates/header', $data);
               $this->load->view('tili/nayta_tilit', $data);
               $this->load->view('templates/footer');

          }

          public function korttitieto()
          {
               $data['korttidata'] = $this->Pankki_model->get_korttitiedot();
               $data['title'] = 'Korttitiedot';

               $this->load->view('templates/header');
               $this->load->view('tili/nayta_kortit', $data);
               $this->load->view('templates/footer');

          }

          public function nayta_saldo($id)
          {
               $data['tilidata'] = $this->Pankki_model->get_user_tilitieto($id);
               $data['title'] = 'Tilitiedot';

               $this->load->view('templates/header', $data);
               $this->load->view('tili/nayta_tilit', $data);
               $this->load->view('templates/footer');

          }

          public function nayta_korttisaldo($korttid)
          {
               $data['tilitieto'] = $this->Pankki_model->get_saldo($_SESSION['idtili']);

               $this->load->view('tili/kortti_saldo', $data);

          }

          public function talletus($id)
          {
               $table = 'tili';
               $column = 'idtili';
               $data['tili'] = $this->Pankki_model->get_selected($table, $column, $id);
               $data['page'] = 'tili/talletus';
               $data['title'] = 'Talleta rahaa';
               $this->load->view('templates/content', $data);


          }

          public function talleta_raha()
          {
               $update_id=$this->input->post('idtili');
               $table = 'tili';
               $column = 'idtili';
               $prevsaldo = $this->Pankki_model->get_saldo($update_id);
               $talletus = $this->input->post('summa');
               $update_data=array(
                         'saldo'=> $prevsaldo + $talletus,
                    );
               $success = $this->Pankki_model->update_selected($table, $column, $update_data, $update_id);
               if($success)
               {
                    $data['message'] = 'Rahojen talletus onnistui';

               }

               else
               {
                    $data['message'] = 'Rahojen talletus epäonnistui';
               }
               $this->nayta_saldo($update_id);
          }

          public function tilioikeustieto()
          {
               $data['tilidata'] = $this->Pankki_model->get_tilioikeustieto();
               $data['title'] = 'Tilitiedot';

               $this->load->view('templates/header');
               $this->load->view('tili/nayta_tilioikeudet', $data);
               $this->load->view('templates/footer');

          }

          public function user_tilioikeustieto()
          {

               $data['tilidata'] = $this->Pankki_model->get_user_tilioikeustieto();
               $data['title'] = 'Tilitiedot';

               $this->load->view('templates/header');
               $this->load->view('tili/nayta_tilioikeudet', $data);
               $this->load->view('templates/footer');

          }

          public function add_asiakas()
          {
               $this->load->helper('form');
               $this->load->library('form_validation');

               $data['title'] = 'Lisää asiakkaan tiedot';

               $this->form_validation->set_rules('etunimi', 'Etunimi', 'required');
               $this->form_validation->set_rules('sukunimi', 'Sukunimi', 'required');
		$this->form_validation->set_rules('verkkopankkitunnus', 'Verkkopankkitunnus', 'required|trim');
               $this->form_validation->set_rules('salasana', 'Salasana', 'required|trim');
		$this->form_validation->set_message('required', '{field} vaaditaan!');



                if($this->form_validation->run() === FALSE)
               {
			$data['message'] = validation_errors();
                    $data['page'] = 'tili/lisaa_asiakas';
                    $this->load->view('templates/content', $data);

               }


               else {

                    $this->Login_model->register_user();
                    $data['message'] = 'Asiakas lisätty onnistuneesti';
                    $this->load->view('templates/header');
                    $this->load->view('tili/success', $data);
                    $this->load->view('templates/footer');

               }
          }

          public function edit_asiakas($id)
          {
               $table = 'asiakas';
               $column = 'idasiakas';
               $data['asiakas'] = $this->Pankki_model->get_selected($table, $column, $id);
               $data['page'] = 'tili/muokkaa_asiakas';
               $this->load->view('templates/content', $data);

          }

          public function update_asiakas()
          {
               $table = 'asiakas';
               $column = 'idasiakas';

               $update_id=$this->input->post('idasiakas');

               $update_data=array(
                    'idasiakas' => $update_id,
                    'etunimi'=>$this->input->post('etunimi'),
                    'sukunimi'=>$this->input->post('sukunimi'),
                    );

               $success=$this->Pankki_model->update_selected($table, $column, $update_data, $update_id);
               if($success)
               {
                    $data['message'] = 'Asiakastietojen päivitys onnistui!';
               }

               else
               {
                    $data['message'] = 'Asiakastietojen päivitys epäonnistui!';
               }
               $data['page'] = 'templates/info';
               $this->load->view('templates/content', $data);
          }

          public function edit_login($id)
          {
               $table = 'tilioikeudet';
               $column = 'idtilioikeudet';
               $data['asiakas'] = $this->Pankki_model->get_selected($table, $column, $id);
               $data['page'] = 'tili/muokkaa_login';
               $this->load->view('templates/content', $data);
          }

          public function update_login()
          {
               $table = 'tilioikeudet';
               $column = 'idtilioikeudet';
               $form_password = $this->input->post('salasana');
               $database_password = password_hash($form_password, PASSWORD_DEFAULT);
               $update_id=$this->input->post('idtilioikeudet');

               $update_data=array(
                    'idtilioikeudet' => $update_id,
                    'verkkopankkitunnus'=>$this->input->post('verkkopankkitunnus'),
                    'salasana'=>$database_password,
                    'idasiakas' => $this->input->post('idasiakas'),
                    'idtili' => $this->input->post('idtili'),
                    );

               $success=$this->Pankki_model->update_selected($table, $column, $update_data, $update_id);
               if($success)
               {
                    $data['message'] = 'Kirjautumistietojen päivitys onnistui!';
               }

               else
               {
                    $data['message'] = 'Kirjautumistietojen päivitys epäonnistui!';
               }
               $data['page'] = 'templates/info';
               $this->load->view('templates/content', $data);
          }

          public function edit_kortti($id)
          {
               $table = 'kortti';
               $column = 'idkortti';
               $data['kortti'] = $this->Pankki_model->get_selected($table, $column, $id);
               $data['page'] = 'tili/muokkaa_kortti';
               $this->load->view('templates/content', $data);
          }

          public function update_kortti()
          {
               $table = 'kortti';
               $column = 'idkortti';

               $update_id=$this->input->post('idkortti');

               $update_data=array(
                    'salasana' =>$this->input->post('salasana'),
                    );

               $success=$this->Pankki_model->update_selected($table, $column, $update_data, $update_id);
               if($success)
               {
                    $data['message'] = 'Kortin salasanan päivitys onnistui!';
               }

               else
               {
                    $data['message'] = 'Kortin salasanan päivitys epäonnistui!';
               }
               $data['page'] = 'templates/info';
               $this->load->view('templates/content', $data);

          }

          public function verify_delete($id)
          {
               $data['page'] = 'tili/delete_asiakas';
               $data['id'] = $id;
               $this->load->view('templates/content', $data);
          }

          public function verify_tilidelete($id)
          {
               $data['page'] = 'tili/delete_tili';
               $data['id'] = $id;
               $this->load->view('templates/content', $data);
          }

          public function verify_korttidelete($id)
          {
               $data['page'] = 'tili/delete_kortti';
               $data['id'] = $id;
               $this->load->view('templates/content', $data);
          }

          public function delete_thiskortti($id)
          {
               $this->Pankki_model->delete_kortti($id);
               $this->korttitieto();
          }

          public function delete_thistili($id)
          {
               $this->Pankki_model->delete_tili($id);
               $this->tilitieto();
          }

          public function delete_asiakas($id)
          {
               $table = 'asiakas';
               $column = 'idasiakas';

               $success = $this->Pankki_model->delete_selected($table, $column, $id);

               if($success)
               {
                    $data['message'] = 'Poisto onnistui!';
               }

               else
               {
                    $data['message'] = 'Poisto epäonnistui';
               }

               $data['page'] = 'templates/info';
               $this->load->view('templates/content', $data);
          }

          public function add_kortti($id)
          {
               $this->load->helper('form');
               $this->load->library('form_validation');

               $this->form_validation->set_rules('salasana', 'Salasana', 'required|trim');

               if($this->form_validation->run() === FALSE)
               {

                    $data['title'] = 'Luo kortti';
                    $data['id'] = $id;
                    $data['page'] = 'tili/lisaa_kortti';
                    $this->load->view('templates/content', $data);

               }

               else {

                    $this->Pankki_model->register_kortti($id);
                    $data['message'] = 'Kortti lisätty onnistuneesti';
                    $this->load->view('templates/header');
                    $this->load->view('tili/success', $data);
                    $this->load->view('templates/footer');

               }

          }

          public function add_tili($id)
          {

               $data['title'] = 'Luo tili';


                    $this->Pankki_model->register_tili($id);
                    $data['message'] = 'Tili lisätty onnistuneesti';
                    $this->load->view('templates/header');
                    $this->load->view('tili/success', $data);
                    $this->load->view('templates/footer');

     }

     public function rahansiirto($id)
     {
          $table = 'tili';
          $column = 'idtili';
          $data['tili'] = $this->Pankki_model->get_selected($table, $column, $id);
          $data['page'] = 'tili/tilisiirto';
          $data['title'] = 'Siirrä rahaa toiselle tilille';
          $this->load->view('templates/content', $data);


     }

     public function siirto()
     {
          $idsend=$this->input->post('idsend');

          $idreceive = $this->input->post('idreceive');

          $amount = $this->input->post('summa');

          $result = $this->Pankki_model->tilisiirto($idsend, $idreceive, $amount);

          $data['message'] = $result;

          $data['page'] = 'templates/home';
          $this->load->view('templates/content', $data);
     }

     public function korttinosto($id)
     {

          $table = 'kortti';
          $column = 'idkortti';
          $data['kortti'] = $this->Pankki_model->get_selected($table, $column, $id);

          $this->load->view('tili/korttinosto', $data);
     }

     public function nosto()
     {
          $amount = $this->input->post('summa');
          $id = $this->input->post('idtili');
          $this->Pankki_model->korttisiirto($id, $amount);
          $this->lataa_pankkiautomaatti();
     }

     public function lataa_pankkiautomaatti()
     {
          $this->load->view('tili/kortti');

     }

     public function view()
     {
          //$data['tilitiedot'] = $this->Tili_model->get_tilitieto($idtili);

     }
}
