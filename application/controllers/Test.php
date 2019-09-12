<?php
   class Test extends CI_Controller { 
     
      public function index() { 
         echo "Hello";

        // $url = base_url('/test/index');
        // // print_r($url);die();
        // $json = file_get_contents($url);
        // // $json = file_get_contents('php://input');
        // $decoded = json_decode($json,true);

        // // print_r($json);die();

      }
  }
?>


<!-- public function catchPokemon($pokemon)
{
    $pokemon = strtolower($pokemon);
    $siteaddressAPI = "http://pokeapi.co/api/v1/pokemon/" . $pokemon . "/";
    $data = file_get_contents($siteaddressAPI);

    $this->load->view('catches', json_decode($data));
} -->