<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.1.1min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var html = '<tr><td><input type="text" name="txtFullname" required=""></td><td><input type="text" name="txtEmail" required=""></td><td><input type="text" name="txtPhone" required=""></td><td><input type="text" name="txtAddress" required=""></td><td><input type="button" name="addd" ad="add" value="Add"></td></tr>';
            var x = 1;
            $("#add").click(function(){
                alert('ok');
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <form action="" class="insert-form" id="insert_form" method="post">
            <hr>
            <h1 class="text-center">Dynamic Input Feild</h1>
            <hr>
            <div class="input-feild">
                <table class="table-bordered">
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Add or Remove</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="txtFullname" required=""></td>
                        <td><input type="text" name="txtEmail" required=""></td>
                        <td><input type="text" name="txtPhone" required=""></td>
                        <td><input type="text" name="txtAddress" required=""></td>
                        <td><input type="button" name="addd" id="add" value="Add"></td>
                    </tr>
                </table>
                <center>
                    <input type="submit" class="btn-success" name="save" id="save" value="save data">
                </center>
            </div>
        </form>
    </div>
</body>
</html>