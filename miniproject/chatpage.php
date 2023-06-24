<?php
include('database_connection.php');
session_start();
if(isset($_POST['tb1'])){
    $friend_id=intval($_GET['friend_id']);
    $query1 = "
    INSERT INTO chat_message 
    (to_id, from_id,chat) 
    VALUES (:to_user_id, :from_user_id,:chat_message)
    ";
               $statement = $conn->prepare($query1);
               $statement->execute([':chat_message'=>$_POST['tb1'],':to_user_id'=>$friend_id,':from_user_id'=>$_SESSION['uid']]);
    $query2="UPDATE chat_message set timestamp=now() where chat=:chat_message";
    $stmt2=$conn->prepare($query2);
    $stmt2->execute([':chat_message'=>$_POST['tb1']]);


            }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <!--Bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="style.css">
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    <style>
        /* Style for message input box */
        .message-input {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            padding: 15px;
        }
        .toast {
            background-color: #ffe066;
            color: white;
            }
    </style>

</head>
<body style="padding: 15px; opacity:75%; background-image: url(https://www.ilovewallpaper.com/images/buzzy-bees-wallpaper-white-p8721-35735_medium.jpg); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    <div class="chat-container">
        <div class="container card chat-app" style="background-color: #ffe066; padding: 15px;min-height: 100vh;">
            <h3 style="font-family: cursive; padding: 20px;"> Conversation </h3>


            
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                    <div id="message-list">

                    <ul class="m-b-0">
                    <?php
                                            include_once('database_connection.php');
                                          
                                            $a=1;
                                           
                                            $friend_id=intval($_GET['friend_id']);
                                            $friend_name=$_GET['friend_id'];
                                            // echo $friend_id;
                                            
                                                                
                                            $stmt = $conn->prepare(
                                                    
                    // "SELECT chat, timestamp,to_id,from_id
                    // FROM chat_message
                    // WHERE to_id =:friend_id and from_id = :user or from_id=:friend_id and to_id=:user
                    // ;
                   " SELECT chat, timestamp, 
       u1.username as sender_username, u2.username as receiver_username
FROM chat_message 
JOIN user u1 ON from_id = u1.uid 
JOIN user u2 ON to_id = u2.uid 
WHERE (from_id = :user AND to_id = :friend_id) 
   OR (from_id = :friend_id AND to_id = :user) ORDER BY timestamp;");


                                    $stmt->execute([':friend_id'=>$friend_id,':user'=>$_SESSION['uid']]);
                                    $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                   
                                    foreach ($chats as $chat)
                                    {
                                       
                                
                                        ?>
                                        <li class="clearfix" style="padding: 10px; border: 1px solid #000;">
                                        
                                        
                                        <span class="message-data-time"><?php echo $chat['sender_username']; ?></span>
                                        <br>
                                            <span class="message-data-time"><?php echo $chat['timestamp']; ?></span>
                                      
                                        <div class="message my-message"><?php echo $chat['chat']; ?></div> 

                                    </li>
                                   
                                        
                                       

                                     
                                    
                  
                    <?php
                    }
                
                   
                    ?>    
                                  
                                       
                                    
                                         
                                                                              
                                                   
                                                </ul>
                        <!-- messages are displayed here.. -->
                    </div>
                </div>
        </div>
    </div>

        </div>
    </div>
    


    <div class="message-input">
        <div class="input-group mb-3">
            <div class="input-group">
                <form method="post">
                <input type="text" class="form-control" id="tb1" name="tb1" placeholder="Type something.." aria-label="Recipient's message with two button addons" size="160">
                                </form>
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                <ul class="dropdown-menu outline-primary" style="padding: 2px;">
                    <li><a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"> Camera</i></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"> Image</i></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <a href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-music"> Music</i></a>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-file-pdf-o"> File</i></a></li>
                  </ul>
                <button class="btn btn-success fa fa-send" type="button" onclick="sendMessage()" id="b1">  Send</button>
            </div>                
        </div>
    </div>

    
</body>
<!-- Include Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-JMY8VJcnr+1P5uk+mrx4nG3yfwC/HqY9zeViJ/rXefgiLvK1O2MLuPPl+U4rfFbUQnSx/ZbFZmGctoOUMoEzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const tb1 = document.getElementById('tb1');
        const messageList = document.getElementById('message-list');

        function sendMessage() {
            const message = tb1.value.trim();
            if (message === '') {
                return;
            }

            const sender = 'Me'; // set the sender name
            const timestamp = new Date().toLocaleString(); // get the current timestamp

            const messageContainer = document.createElement('div');
            messageContainer.classList.add('border', 'border-primary', 'rounded', 'p-3', 'mb-3');

            const senderElement = document.createElement('div');
            senderElement.classList.add('fw-bold');
            senderElement.innerText = sender;

            const messageElement = document.createElement('div');
            messageElement.innerText = message;

            const timestampElement = document.createElement('div');
            timestampElement.classList.add('text-muted', 'small', 'mt-2');
            timestampElement.innerText = timestamp;

            messageContainer.appendChild(senderElement);
            messageContainer.appendChild(messageElement);
            messageContainer.appendChild(timestampElement);

            messageList.appendChild(messageContainer);

            tb1.value = '';
        }
</script>
</html>
