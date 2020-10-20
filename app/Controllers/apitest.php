<?php
namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
//use CodeIgniter\Debug\Toolbar\Collectors\BaseCollector;
use CodeIgniter\RESTful\ResourceController;

class apitest extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query("select * from todo where is_deleted like 0");
        $data = $query->getResult();
        if($data)
        {
            return $this->respond($data);
        }
        else
        {
            return $this->failNotFound('error');
        }
    }
    public function show($id = null)
    {
        $db = \Config\Database::connect();
        if(!empty($id))
        {
            $query = $db->query("select * from todo where is_deleted like 0 and id like ?",[$id]);
        }
        else
        {
            $query = $db->query("select * from todo where is_deleted like 0");
        }
        $data = $query->getResult();
        if($data)
        {
            return $this->respond($data);
        }
        else
        {
            return $this->failNotFound('error');
        }
    }
    public function create()
    {
        $name = $this->request->getVar('name');
        $db = \Config\Database::connect();
        $db->query('insert into todo (name,is_deleted) values (?,0)',[$name]);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response);
    }
    public function update($id = null)
    {
        $name = $this->request->getVar('name');
        if(!empty($id))
        {
            $db = \Config\Database::connect();
            $db->query('update todo set name = ? where id = ? ',[$name,$id]);
        }
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
    public function delete($id = null)
    {
        if(!empty($id))
        {
            $db = \Config\Database::connect();
            $db->query('update todo set is_deleted = 1 where id like ? ',[$id]);
        }
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
}
?>