<?php
@session_start();

class Homepage extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isset($_SESSION['mailaddress'])) {
            $this->Login();
        } else {
            $this->view->render("Homepage");
        }
    }

    public function loginCheck()
    {
        if (isset($_SESSION['mailaddress'])) {
            $this->adminDashboard();
        } else {
            $this->Login();
        }
    }

    public function logoutCheck()
    {
        if (isset($_POST['logout'])) {
            session_destroy();
            session_unset();
            $this->view->render("Login");
        }
    }

    public function Login()
    {
        if (isset($_SESSION['mailaddress'])) {
            $this->Logout();
        } else {
            $this->view->render("Login");
        }
//        else{
//            session_destroy();
//            session_unset();
//            $this->view->render("Login");
//        }
    }

    public function Logout()
    {
        $this->view->render("Logout");
    }

    public function submit()
    {
        if(!empty($_SESSION['mailaddress']) && !empty($_SESSION['password'])){
            $email = $_SESSION['mailaddress'];
            $password = $_SESSION['password'];
        }else{
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        $status = $this->model->checkUserLogin($email, $password);
        if ($status == "success") {
            $userRole = $_SESSION['userRole'];
            if ($userRole == "Admin") {
                $this->view->render("adminDash");
            } else if ($userRole == "Doctor") {
//                    $this->view->render("doctorDash");
                die($userRole);
            } else if ($userRole == "Nurse") {
//                    $this->view->render("nurseDash");
                die($userRole);
            } else if ($userRole == "Receptionist") {
//                    $this->view->render("receptionistDash");
                die($userRole);
            } else if ($userRole == "Patient") {
//                    $this->view->render("patientDash");
                die($userRole);
            } else if ($userRole == "Storekeeper") {
//                    $this->view->render("storekeeperDash");
                die($userRole);
            }
        } else {
            $data['status'] = $status;
            $this->view->render("Login", $data);
        }
    }

    public function adminDashboard()
    {
        if (isset($_SESSION['mailaddress']) && $_SESSION['userRole'] == "Admin") {
            $data = [];
            $result = $this->model->getUsers();
            $data['result'] = $result;
            $this->view->render("adminDash", $data);
        } else {
            $this->view->render("Login");
        }
    }
}