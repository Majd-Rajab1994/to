<?php
namespace App\Controllers;

use CodeIgniter\Config\Config;

class iscroll extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select * from tbl_posts");
        $data['count'] = count($query->getResult());
        $query = $db->query("select * from tbl_posts order by id DESC limit 7");
        $data['array'] = $query->getResultArray();
        return view('infinitescroll.php',$data);
    }
    public function getData()
    {
        helper(['form', 'url']);
        $lid = $this->request->getPost('lid');
        $db = \Config\Database::connect();
        $query = $db->query("select * from tbl_posts where id >= '?' order by id DESC limit 7",[$lid]);
        $array = $query->getResultArray();
        if($array)
        {
            foreach($array as $data)
            {
                echo '<div class="post-item" id="'.$data['id'].'">
                <p class="post-title">'.$data['title'].'</p>
                <p>'.$data['content'].'</p>
                </div>';
            }
        }

    }
}
?>