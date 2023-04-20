<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="#" class="insert-form" id="insert_form" method="post">
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
                    <div class="show-medicine">
                    <tr>
                        <td><input type="text" name="txtFullname[]" required=""></td>
                        <td><input type="text" name="txtEmail[]" required=""></td>
                        <td><input type="text" name="txtPhone[]" required=""></td>
                        <td><input type="text" name="txtAddress[]" required=""></td>
                        <td><input type="button" name="addd" class="add" value="Add"></td>
                    </tr>
                    </div>
                    <input type="submit" class="btn-success" name="save" id="save" value="save data">
                </table>
                
                
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // to add rows
        $(document).ready(function(){
            $(".add").click(function(e){    //pass parameter e
                e.preventDefault();         //stop page refresh
                $(".table-bordered").append(`<tr>
                        <td><input type="text" name="txtFullname[]" required=""></td>
                        <td><input type="text" name="txtEmail[]" required=""></td>
                        <td><input type="text" name="txtPhone[]" required=""></td>
                        <td><input type="text" name="txtAddress[]" required=""></td>
                        <td><input type="button" name="remove" class="remove" value="Remove"></td>
                    </tr>`);
            });

            //remove rows
            $(document).on('click', '.remove', function(e){
                e.preventDefault();
                let = row_med = $(this).parent().parent();  //select parent of parent of remove btn.. which is <tr>
                $(row_med).remove();
            });

            //ajax request to save all medicines
            $("#insert_form").submit(function(e){
                e.preventDefault();
                $("#save").val('Saving...');
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: $(this).serialize(),
                    success: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
</body>
</html>