<?php

class AdminModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }



    public function createUser($nic, $name, $address, $email, $contactNum, $gender, $password, $userRole, $profile_image)
    {
        $img_name = $profile_image['name'];
        $img_size = $profile_image['size'];
        $tmp_name = $profile_image['tmp_name'];
        $error = $profile_image['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'D:/Softwares/xamppNew/htdocs/Royal/public/assets/uploads/' . $new_img_name;
//                die($img_upload_path);
                move_uploaded_file($tmp_name, $img_upload_path);
                // $sql = "INSERT INTO user(profile_image) VALUES ('$new_img_name');";
                // header("location: adminDash.php");
                // if (mysqli_query($con, $sql)) die("Success");
                // else die("Fail");
            } else {
                $em = "You can't upload files of this type";
//                header("location:adminDash.php?error = $em");
            }
        }

        $profile_image = $new_img_name;

        $query = "INSERT INTO user(nic, name, address, email, contact_num, gender, password, user_role, profile_image) VALUES ('$nic', '$name', '$address', '$email', '$contactNum', '$gender', '$password', '$userRole', '$profile_image');";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

    public function removeUser($id){
        $query = "Delete FROM user where nic=".$id;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

    public function getUsers()
    {
        $query = "SELECT * FROM user";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchall();
    }
}