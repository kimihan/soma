<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/MY_Controller.php');
class Home extends MY_Controller {

    public function index()
    {
        echo "Futuro site";
    }
}
