<?php
                        include_once('database_connection.php');
                        session_start();
                        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main page</title>
    <!--Bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="style.css">
    <style>
    a:link {
            text-decoration: none;
        }
        a:hover {
            text-decoration: none;
        }
        a { text-decoration:none; }
        </style>

</head>
<body style="padding: 15px; opacity:75%; background-image: url(https://www.ilovewallpaper.com/images/buzzy-bees-wallpaper-white-p8721-35735_medium.jpg); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    
        <div class="container card chat-app" style="background-color: #ffe066; padding: 55px;">
            <div class="row">
                <div class="container col">
                    <a href="request.php">
                        <button type="button" class="btn btn-dark position-relative float-start">
                            Requests
                            
                            </span>
                            </button>
                    </a>
                    <br><br><br>
                    <a href="searchpage.php">
                        <button type="button" class="btn btn-dark position-relative float-start">

                            Add Friends
                        </button>
                    </a>
                </div>
    
                <div class="container col">
                    <h1><?php echo $_SESSION['username']?>'s Profile </h1>
                </div>
            </div>
        </div>
      
        <div>
        <section>
        <div class="container py-5">      
          <div class="row">      
            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">      
              <div class="card">
                <div class="card-body">      
                  <ul class="list-unstyled mb-0">
                    
                  <?php
                        include_once('database_connection.php');
                    
                        $a=1;
                        $stmt = $conn->prepare(
                                " 
                                SELECT u.username,u.uid FROM user as u
                                JOIN friends as f ON (u.uid = f.sender_id OR u.uid = f.reciever_id)
                                WHERE (f.sender_id =:uid OR f.reciever_id =:uid) AND u.uid != :uid;
                                
                                ");
                        $stmt->execute([':uid'=>$_SESSION['uid']]);
                        

                        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                       
                        foreach($users as $user)
                        {
                            $u=$user['uid'];
                            $stmt1 = $conn->prepare(
                                                    
                                "SELECT username from user where uid=:u
                                ;");
                                                $stmt1->execute([':u'=>$u]);
                                                $c = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                                $friend_name=$c[0]['username'];
                    ?>
                  
                     <a href="chatpage.php?friend_id=<?php echo $u?>&friend_name=<?php echo $friend_name?>" class="d-flex " id="name">
                        <li class="p-2 border-bottom" style="background-color:  #ffe066;"></li>
                        <div class="d-flex flex-row p-3">
                          
                          <div class="pt-1">
                            <p class="fw-bold mb-0 h5 p-2">
                            <?php echo $user['username']; ?>
                            <hr width="300px">
                            </p>
                            
                          </div>
                        </div>                      
                    </li>
                    
                </a> 
                
                <?php
                    }
                    ?>
                

            </ul>      
                </div>
              </div>      
            </div>      
          </div>      
        </div>
      </section>
    </div>

    
</body>
</html>
