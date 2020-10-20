<?php namespace App\Controllers;

use CodeIgniter\Validation\Validation;
use Config\Validation as ConfigValidation;
use App\Models\todomodel;

class Home extends BaseController
{
	public function index()
	{
        $data['ch'] = true;
        echo view('SigninPage',$data);
    }
    public function select2()
    {
        return view('select2');
    }
    public function datatable()
    {
        $model = new todomodel();
        //$db = \Config\Database::connect();
        //$query = $db->query("select name from todo where is_deleted like 0");
        //$data['todolist'] = $query->getResultArray();
        $data['todolist'] = $model->where('is_deleted ',0)->findAll();
        return view('datatable',$data);
    }
    public function jsontest()
    {
        //$db = \Config\Database::connect();
        //$query = $db->query("select name from todo where is_deleted like 0");
        //$data = $query->getResultArray();
        $model = new todomodel();
        $data = $model->where('is_deleted ',0)->findAll();
        echo '{"data": '.json_encode($data) .'}';
    }

    public function gettodo()
    {
        //helper(['form','url']);
        $request = \Config\Services::request();
        $q = $request->getPost('q');
        //$q = '';
        $db = \Config\Database::connect();
        $query = $db->query("select * from todo where is_deleted like 0 and name like '%".$q."%' ");
        $data = $query->getResultArray();
        //echo '{"data" : '.json_encode($data)."}";
        echo json_encode($data);
    }

    public function reg()
    {
        helper(['form','url']);
        $validation =  \Config\Services::validation();
        $ch = $this->$validation([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cpassword' => 'required'
        ]);
        if (!$ch) {
            return view('SignupPage');
        }
        else {
            echo "fff";
        }
    }

    public function SignupPage()
    {
        $data['ch'] = 0;
        return view('SignupPage',$data);
    }

    public function adduser()
    {
        $data['ch'] = 0;
        $request = \Config\Services::request();
        $name = $request->getVar('name');
        $username = $request->getVar('username');
        $password = $request->getVar('password');
        $cpassword = $request->getVar('cpassword');
        $email = $request->getVar('email');
        if ($name == null || $username == null || $password == null || $email == null) {
            $data['ch'] = 1;
            return view('SignupPage',$data);
        }
        elseif ($password != $cpassword) {
            $data['ch'] = 2;
            return view('SignupPage',$data);
        }
        else{
            $db = \Config\Database::connect();
            $query = $db->query('select * from users where name = ? or username = ?',[$name,$username]);
            $arr = $query->getResult();
            $c = count($arr);
            if ($c > 0) {
                $data['ch'] = 3;
                return view('SignupPage',$data);
            }
            else{
                //$encrypter = \Config\Services::encrypter();
                //$password =  bin2hex($encrypter->encrypt($password));
                //$password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

                
                //$pepper = getConfigVariable("pepper");
                $pwd_peppered = hash_hmac("sha256", $password, 'majd');
                $password = password_hash($pwd_peppered, PASSWORD_ARGON2ID);

                $db->query('insert into users (name,username,password,email,is_active) values (?,?,?,?,1)',[$name,$username,$password,$email]);
                return redirect()->to('/');
            }
        }
    }
    public function checkuser()
    {
        $data['ch'] = true;
        $request = \Config\Services::request();
        $username = $request->getVar('username');
        $password = $request->getVar('password');
        //$password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

        $db = \Config\Database::connect();
        $query = $db->query('select * from users where username = ?',[$username]);
        $arr = $query->getResult();
        $c = count($arr);
        
        if ($c > 0) {
            $onerow = $query->getRow();
            $pass = $onerow->password;
            $id = $onerow->id;
            $pwd_peppered = hash_hmac("sha256", $password, 'majd');
            if (password_verify($pwd_peppered, $pass)) {
                ob_start();
                session_start();
                $_SESSION['username']= $username;
                $_SESSION['userid'] = $id;
                return redirect()->to('/datatable');
            }
            else{
                $data['ch'] = false;
                return view('SigninPage',$data);
            }
            
        }
        else{
            $data['ch'] = false;
            return view('SigninPage',$data);
        }
    }
    
    public function view()
    {
        //$db = \Config\Database::connect();
        //$query = $db->query("select * from todo where is_deleted like 0");
        //$data['todolist'] = $query->getResultArray();
        $model = new todomodel();
        $data['todolist'] = $model->where('is_deleted ',0)->findAll();
        return view('homepage2' , $data );
    }


public function insert()
{
    //$db = \Config\Database::connect();
    //$request = \Config\Services::request();
    //helper(['form', 'url']);
    //$name1 = $this->request->getPost('name1');
    ////$name1 = $request->getVar('name1');
    //$db->query('insert into todo (name,is_deleted) values (?,0)',[$name1]);
    ////return redirect()->to('/');	
    helper(['form', 'url']);
    $model = new todomodel();
    $data = [
        'name' => $this->request->getPost('name1'),
        'is_deleted' => 0
    ];
    $model->insert($data);
}

public function insertsession()
{
    $db = \Config\Database::connect();
    $request = \Config\Services::request();
    helper(['form', 'url']);
    $name1 = $this->request->getPost('name1');
    //$name1 = $request->getVar('name1');
    ob_start();
    session_start();
    $userid = $_SESSION['userid'];
    echo $userid;
    $db->query('insert into todo (name,is_deleted,user_id) values (?,0,?)',[$name1,$userid]);
    //return redirect()->to('/');	
}
public function insertpage()
{
    return view('insertpage' );
}

public function delete()
{
    //$uri = $this->request->uri;
    //$id = $uri->getSegment(3);
    helper(['form', 'url']);
    $id = $this->request->getPost('id1');
    $db = \Config\Database::connect();
    $db->query('update todo set is_deleted= True where id like ?',[$id]);
    //return redirect()->to('/');
}

public function update()
{
    helper(['form', 'url']);
    $model = new todomodel();
    $data= [
        'name' => $this->request->getPost('name1')
    ];
    $id1 = $this->request->getPost('id1');
    //$db = \Config\Database::connect();
    //$db->query('update todo set name = ? where id like ?',[$name1,$id1]);
    $model->update($id1,$data);
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
