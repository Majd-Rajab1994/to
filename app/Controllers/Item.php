<?php
namespace App\Controllers;

use REST_Controller;

require APPPATH.APPPATH.'libraries/REST_Controller.php';

class Item extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    public function index_get($id = 0)
    {
        echo "hi";
        /*
        $db = \Config\Database::connect();
        if(!empty($id))
        {
            $data = $db->query("select * from todo where is_deleted like 0 and id like ?",[$id]);
        }
        else
        {
            $data = $db->query("select * from todo where is_deleted like 0");
        }
        $this->response($data,REST_Controller::HTTP_OK);
        */
    }
}
?>