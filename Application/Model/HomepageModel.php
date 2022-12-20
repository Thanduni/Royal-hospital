<?php

@session_start();

class HomepageModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function checkUserLogin($username = '', $pass = '')
    {
        $query = "select * from user where email = :email;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $username);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $count = count($results);

        if(empty($username) || empty($pass)){
            $status = "Please fill in the blanks";
            return $status;
        }

        if ($count == 1) {
            $password = $results[0]['password'];
            if (password_verify($pass, $password)) {
                $name = $results[0]['name'];
                $email = $results[0]['email'];
                $userRole = $results[0]['user_role'];
                $profilePic = $results[0]['profile_image'];

                $_SESSION['name'] = $name;
                $_SESSION['mailaddress'] = $email;
                $_SESSION['profilePic'] = $profilePic;
                $_SESSION['userRole'] = $userRole;
                $_SESSION['password'] = $pass;

                $status = "success";
            } else {
                $status = "Incorrect login credentials i.e. email or password!";
            }
        }
        return $status;
    }

//    function addStudent($firstname, $lastname){
//        $query = "INSERT INTO student (firstname, lastname)  VALUES ('$firstname', '$lastname');";
//        $stmt = $this->db->prepare($query);
//        $stmt->execute();
//        //bind
//    }

}

