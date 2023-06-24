<?php
    include_once('database_connection.php');

    $request_id = intval($_GET['request_id']);
    $reciever_id = intval($_GET['reciever_id']);
    
    $sender_id = intval($_GET['sender_id']);
    $query = "UPDATE request SET status='accepted' WHERE request_id=:request_id";
    $query2 = "Insert into friends (sender_id, reciever_id) values(:sender_id,:reciever_id )";
    $stmt = $conn->prepare($query);
    $stmt->execute([':request_id'=>$request_id]);
    $stmt2 = $conn->prepare($query2);
    $stmt2->execute();

    echo "Request updated";
?>