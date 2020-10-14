<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$db = \Config\Database::connect();
        $query = $db->query("select * from todo where is_deleted like 0");
        $data['todolist'] = $query->getResultArray();
        return view('homepage' , $data );
	}


public function insert()
{
    $db = \Config\Database::connect();
    $request = \Config\Services::request();
    $name1 = $request->getVar('name1');
    $db->query('insert into todo (name,is_deleted) values (?,0)',[$name1]);
    return redirect()->to('/');	
}
public function insertpage()
{
    return view('insertpage' );
}

public function delete()
{
    $uri = $this->request->uri;
    $id = $uri->getSegment(3);
    $db = \Config\Database::connect();
    $db->query('update todo set is_deleted= True where id like ?',[$id]);
    return redirect()->to('/');
}

public function update()
{
    $db = \Config\Database::connect();
    $request = \Config\Services::request();
    $name1 = $request->getVar('name1');
    $id1 = $request->getVar('id1');
    $db->query('update todo set name = ? where id like ?',[$name1,$id1]);
    return redirect()->to('/');	
}
public function updatepage()
{
    $uri = $this->request->uri;
    $data['id'] = $uri->getSegment(3);
    $data['name'] = $uri->getSegment(4);
    return view('updatepage',$data);
}

//--------------------------------------------------------------------

}