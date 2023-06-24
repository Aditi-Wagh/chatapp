<!DOCTYPE html>
<html lang="en">
<head>


<style>
table {
  
  
  width: 100%;
}
th{
    text-align: center;
}

td {
  
  padding: 10px 20px;
}

td:nth-child(odd) {
  background-color: #f3f3f3;
}

td:nth-child(even) {
  background-color: #e2ffe2;
  text-align: left;
}

</style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>

    <!--Bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body style="background-image: url(https://www.ilovewallpaper.com/images/buzzy-bees-wallpaper-white-p8721-35735_medium.jpg);">

    <div class="container">
        <div class="row">
         
            <table class="table table-hover">
                <thead>
                <tr style="background-color:#f6962e; ">
                        <th>User Id</th>
                        <th>User Name</th>
                       
                    </tr>
                </thead>
 
                <tbody>
                    <?php
                        include_once('database_connection.php');
                        $a=1;
                        $stmt = $conn->prepare(
                                " select uid,username from user;");
                        $stmt->execute();
                        $users = $stmt->fetchAll();
                        foreach($users as $user)
                        {
                    ?>
                    <tr style="background-color: #F2D68D;">
                        <td>
                            <?php echo $user['uid']; ?>
                        </td>
                        <td>
                            <?php echo $user['username']; ?>
                        </td>
                       
                      
                    </tr>
                   
                    <?php
                    }
                    ?>
                </tbody>
            </table>
 
            
        </div>
    </div>

 
</body>
</html>