<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'ModelDefault.php';
class WebsiteModel extends ModelDefault{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    

}
