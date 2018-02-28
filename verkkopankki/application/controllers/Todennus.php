<?php


class Todennus extends CI_Controller{


public function __construct()
{
     parent::__construct();

     $this->load->helper('form');

     $this->load->library('form_validation');
     $this->load->library('session');

     $this->load->model('Login_model');
     $this->load->model('Pankki_model');
}

public function index()
{
     $data['page'] = 'todennus/login_form';
     $this->load->view('templates/content', $data);
}

public function rekisterointi_lomake()
{
     $this->load->view('todennus/rekisterointi_form');
}

//UUDEN KÄYTTÄJÄN REKISTERÖINTI!!
/* public function uusi_kayttaja()
{
     $this->form_validation->set_rules('verkkopankkitunnus', 'Verkkopankkitunnus', 'required');
     $this->form_validation->set_rules('salasana', 'Salasana', 'required');

     if($this->form_validation->run() === FALSE)
     {
          $this->load->view('todennus/rekisterointi_form');
     }

     else
     {
          $data = array(
               'verkkopankkitunnus' => $this , );
     }*/

     public function kirjaudu()
     {
          $form_username=$this->input->post('verkkopankkitunnus');
          $form_password=$this->input->post('salasana');
          $database_password = $this->Login_model->get_password($form_username);
          $admin_check = $this->Login_model->admin_check($form_username, $database_password);

          if ($admin_check == true)
          {
               //echo "OLI ADMIN ";
               $_SESSION['log_in']=true;
               $_SESSION['user'] = $form_username;
               $data['message'] = 'Kirjautuminen onnistui';
               $data['page'] = 'templates/logged_in';
               $this->load->view('templates/content', $data);
          }

          else if ($admin_check != true)
          {
               //echo "EI OLLUT ADMIN";

               if(password_verify($form_password, $database_password))
               {
                    //echo "PASSWORD VERIFIED ";
                    $_SESSION['log_in'] = true;
                    $_SESSION['user'] =$form_username;
                    $data['message'] = 'Kirjautuminen onnistui';
                    $data['page'] = 'templates/logged_in';
                    $this->load->view('templates/content', $data);
               }

               else
               {
                    //echo "EI VOITU VERIFOIDA ";
                    $_SESSION['log_in'] = false;
                    $data['message'] = 'Käyttäjätunnus tai salasana ei täsmää';
                    $data['page'] = 'templates/home';
                    $this->load->view('templates/content', $data);
               }
          }
     }

          public function kortti()
          {
               $this->load->view('todennus/kortti_form');
          }

          public function kortti_kirjaudu()
          {
               $idkortti = $this->input->post('idkortti');
               $_SESSION['kortti'] = $idkortti;
               $query = $this->db->get_where('kortti', array('idkortti' =>$_SESSION['kortti']));
               $_SESSION['idtili'] = $query->row('idtili');

               $password=$this->input->post('salasana');


               $database_password = $this->Login_model->get_korttipassword($idkortti);

               if($password == $database_password)
               {
                    //echo "PASSWORD VERIFIED ";
                    $_SESSION['kortti_log'] = true;
                    $data['message'] = 'Kirjautuminen onnistui';

                    $this->load->view('tili/kortti', $data);
               }

               else
               {
                    //echo "EI VOITU VERIFOIDA ";
                    $_SESSION['kortti_log'] = false;
                    $data['message'] = 'Käyttäjätunnus tai salasana ei täsmää';
                    $this->load->view('todennus/kortti_form');
               }
          }

          public function kortti_logout()
          {
               $_SESSION['kortti_log'] = false;
               $this->lataa_etusivu();

          }

          public function lataa_etusivu()
          {
               $data['page'] = 'templates/home';
               $this->load->view('templates/content', $data);

          }

          public function lataa_pankkiautomaatti()
          {
               $this->load->view('tili/kortti');

          }



          /*$this->form_validation->set_rules('verkkopankkitunnus', 'Verkkopankkitunnus', 'trim|required');
          $this->form_validation->set_rules('salasana', 'Salasana', 'trim|required');

          if($this->form_validation->run() === FALSE)
          {
               if(isset($this->session->userdata['logged_in']))
               {
                    $this->load->view('templates/header');
                    $this->load->view('templates/home');
                    $this->load->view('templates/footer');
               }
               else
               {
                    $this->load->view('templates/header');
                    $this->load->view('todennus/login_form');
                    $this->load->view('templates/footer');
               }
          }
          else
          {
               $data = array(
                    'verkkopankkitunnus' => $this->input->post('verkkopankkitunnus'),
                    'salasana' => $this->input->post('salasana'),
               );
               $result = $this->login_model->login($data);
               if($result == TRUE)
               {

                    $verkkopankkitunnus = $this->input->post('verkkopankkitunnus');
                    $result = $this->login_model->get_kayttajatieto($verkkopankkitunnus);

                    if ($result != FALSE)
                    {
                         $session_data = array(
                                   'verkkopankkitunnus' => $result[0]->verkkopankkitunnus
                         );

                         $this->session->set_userdata('logged_in', $session_data);
                         $this->load->view('todennus/admin_page');
                    }
               }
               else
               {
                    $data = array(
                         'error_message' => 'Väärä tunnus tai salasana!'
                    );
                    $this->load->view('login_form', $data);
               }

          }*/

     public function kirjaudu_ulos()
     {
          $_SESSION['log_in']=false;
          $_SESSION['user'] = null;
          session_destroy();
          $data['message']='Olet kirjautunut ulos';
          $data['page']='templates/logout';
          $this->load->view('templates/content',$data);

     }
     public function logout(){

  }

  public function add_user()
 {
       $this->load->helper('form');
       $this->load->library('form_validation');

       $data['title'] = 'Lisää uuden asiakkaan tiedot';

       $this->form_validation->set_rules('idasiakas', 'Asiakkaan ID', 'required');
       $this->form_validation->set_rules('etunimi', 'Etunimi', 'required');
       $this->form_validation->set_rules('sukunimi', 'Sukunimi', 'required');
       $this->form_validation->set_rules('verkkopankkitunnus', 'Verkkopankkitunnus', 'required');
       $this->form_validation->set_rules('salasana', 'Salasana', 'required');


       if($this->form_validation->run() === FALSE)
       {

            $data['page'] = 'tili/lisaa_asiakas';
            $this->load->view('templates/content', $data);

       }

       else {
            $this->Login_model->register_user();
            $this->load->view('templates/header', $data);
            $this->load->view('tili/success');
            $this->load->view('templates/footer');

}

}
}
