<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'models/ModelDefault.php';

class AdminModel extends ModelDefault{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

        

}
