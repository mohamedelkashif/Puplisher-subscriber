<?php

require("../phpMQTT.php");
	
  $host = "m12.cloudmqtt.com"; 
  $port = 11913;
  $username = "oqmzsuoc"; 
  $password = "dBQg-4Zz98vW"; 
  $message =$_POST['message'];

  //MQTT client id to use for the device. "" will generate a client id automatically
  $mqtt = new phpMQTT($host, $port, "ClientID".rand()); 

  if ($mqtt->connect(true,NULL,$username,$password)) {
    $mqtt->publish($_POST['topic'],$message, 0);
    $mqtt->close();
    echo "Message published<br />";
    ob_start();
    header('Location: '.'publisher.html');
    ob_end_flush();
  }else{
    echo "Fail or time out<br />";
  }
?>
