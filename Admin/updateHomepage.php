<?php
session_start();

require_once("../conf/config.php");

if (isset($_POST['homepageInfo'])) {
    if (empty($_POST["slider_title-0"]) || empty($_POST["slider_title-1"]) || empty($_POST["slider_title-2"]) ||
        empty($_POST["slider_description-0"]) || empty($_POST["slider_description-1"]) || empty($_POST["slider_description-2"]) ||
        empty($_POST["slider_image_0"]) || empty($_POST["slider_image_1"]) || empty($_POST["slider_image_2"])) {
        header("location:" . BASEURL . "/Admin/noticeboardHomepageEdit.php?Empty=Please fill in the blanks");
    }else{
        for($j=0; $j<3; $j++){

            $sliderTitle = $_POST['slider_title-'.$j];
            $sliderDesc = $_POST['slider_description-'.$j];
            $sliderImage = $_POST['slider_image_'.$j];

            $query = "UPDATE `homepagecontent` SET `slider_title`='$sliderTitle',`slider-description`='$sliderDesc',`slider_image`='$sliderImage' WHERE adID=".($j+1);
            $result = mysqli_query($con, $query);
            if($result)
                header("location:". BASEURL . "/Admin/noticeboardHomepageEdit.php?result=The homepage slider information is updated successfully!");
        }
    }
}

?>