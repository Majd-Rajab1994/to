<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class apiforms extends BaseController
{
    public function index()
    {
        return view('apiview');
    }
    public function insertapi()
    {
        //$url = base_url()."/apiinsert";
        $url = "http://dummy.restapiexample.com/api/v1/create";
        helper(['form', 'url']);
        $name = $this->request->getPost('name1');
        $data = array(
            'name'=> $name,
            'salary' => '123',
            'age' => '123'
        );
        $data = http_build_query($data);
        $ch =curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $val = curl_exec($ch);
        curl_close($ch);
        echo $val;

    }
    public function apiget()
    {
        //$url = 'http://localhost:8080/apitest';
        //$url = 'http://dummy.restapiexample.com/api/v1/employee/1';
        $url = 'https://api.mocki.io/v1/ce5f60e2';

        $ch =curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $val = curl_exec($ch);
        //print_r($dec);
        
        curl_close($ch);
        echo '{"data":['.$val.']}';
    }
    
}
?>