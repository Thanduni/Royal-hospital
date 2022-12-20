<?php
@session_start();

class Admin extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render("adminDash");
    }

    function getUsers()
    {
        if ($_SESSION['mailaddress']) {
            $data = [];
            $result = $this->model->getUsers();
            $data['result'] = $result;
            $this->view->render("adminUsersPage", $data);
        } else {
            $this->redirect("Homepage/Login");
        }
    }

    public function addUser()
    {
        $nic = $_POST['nic'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contactNum = $_POST['contactNum'];
        $gender = $_POST['gender'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userRole = $_POST['userRole'];
        $profile_image = $_FILES['profile_image'];

        $result = $this->model->createUser($nic, $name, $address, $email, $contactNum, $gender, $password, $userRole, $profile_image);
        $this->redirect("Admin/getUsers");
//        $this->adminDashboard();
    }

    function removeUser()
    {
        if ($_SESSION['mailaddress']) {
            $this->model->removeUser($_GET['NIC']);
            $this->redirect("Admin/getUsers");
        } else {
            $this->redirect("Homepage/Login");
        }
    }
}