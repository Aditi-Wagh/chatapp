<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat_Application</title>

    <!--Bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
  $("#tableSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
    </script>
</head>
<body style="padding-left: 500px; padding-right: 500px; padding-top: 200px; background-image: url(https://www.ilovewallpaper.com/images/buzzy-bees-wallpaper-white-p8721-35735_medium.jpg); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
<div class="container">
<form method="post">
  <input class="form-control mb-4" name="username" id="username" type="text"
    placeholder="Type something to search list items">
</form>

  
</div>
</body>
</html>
<?php
include('database_connection.php');

session_start();

if(isset($_SESSION['uid'])&& isset($_POST['username']))
{
$sender_id=$_SESSION['uid'];
$username=$_POST['username'];
$query1 = "
   SELECT * FROM user 
    WHERE username = :username 
 ";
 $statement = $conn->prepare($query1);
 $statement->bindParam(':username',$_POST['username']);
 $statement->execute();
 $result=$statement->fetch(PDO::FETCH_ASSOC);
if($result<>NULL){
    ?>
    <table class="table table-hover">
    <thead>
    <tr style="background-color:#f6962e; ">
            <th>User Id</th>
            <th>User Name</th>
            <th> </th>
           
        </tr>
    </thead>

    <tbody>
       
        <tr style="background-color: #F2D68D;">
            <td>
                <?php echo $result['uid']; ?>
            </td>
            <td>
                <?php echo $result['username']; ?>
            </td>
            <td>
            <?php

$receiver_id=$result['uid'];

$request_button='<button type="button" id="btn" onclick="send_request()" > Request </button>
<script>

    function send_request() {
        document.getElementById("btn").innerHTML="Requested";
       
    }
</script>';
echo $request_button;
if(isset($request_button)){
$query2 = "
   insert into request(sender_id,reciever_id,status) values(:sender_id,:receiver_id,'pending')
 ";
 $statement = $conn->prepare($query2);
 //$statement->bindParam([':sender_id',$_SESSION['uid']],[':receiver_id',$result['uid']]);
 $statement->execute([':sender_id'=> $sender_id,':receiver_id'=>$receiver_id]);
 
}
?>
</td>
           
          
           </tr>
       
        <?php
        }
        else{
            echo " User Not found";
        }
    }
        ?>
    </tbody>
</table>



