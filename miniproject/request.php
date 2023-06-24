<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
        "width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
    <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Attendance Page</title>
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
</head>
 
<body style="background-image: url(https://www.ilovewallpaper.com/images/buzzy-bees-wallpaper-white-p8721-35735_medium.jpg);">
    <div class="container">
        <div class="row">
         
            <table class="table table-hover">
                <thead>
                    <tr style="background-color:#f6962e; ">
                        <th>Sender id</th>
                        <th>Sender Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
 
                <tbody>
                    <?php
                       
                        include_once('database_connection.php');
                        session_start();
                        //$_SESSION['uid']=2;
                        $reciever_id=0;
                        if(isset($_SESSION['uid'])){
                            //echo"is set";
                            $reciever_id=$_SESSION['uid'];
                        }
                        
                        $query=" select DISTINCT request.request_id,request.sender_id ,user.username, request.status from user inner join request on request.sender_id=uid where reciever_id=:receiver_id and status='pending'";
                        $stmt = $conn->prepare($query);
                        $stmt->execute([':receiver_id'=>$reciever_id]);
                        //echo "query executed";
                        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        //print_r($users);
                        $output="";

                        foreach($users as $arr)
                        {
                    
                      $output .="<tr style='background-color: #F2D68D;'>
                        <td>
                            ".$arr['sender_id']."
                           
                        </td>
                        <td>
                             ".$arr['username']."
                        </td>
                        <td>
                           ".$arr['status']."
                       
                           <button type='button' onclick='setAccept(".$arr['request_id'].",".$arr['sender_id']."," .$reciever_id.")' id='accept' class='btn btn-info'>Accept</button>
                        
                     
                        
                        </td>
                       </tr>";
                    // echo $output;
                    
                    }
                    
                    echo $output;

                
                  
                    ?>
                </tbody>
            </table>
 
            
        </div>
    </div>
</body>
 
</html>
<script>
    function setAccept(request_id,sender_id,reciever_id){
        document.getElementById('accept').innerHTML='Accepted';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        xmlhttp.open("GET", "updated.php?request_id=" + request_id +"&reciever_id=" + reciever_id+"&sender_id="+sender_id, true);
        xmlhttp.send();
    }
</script>