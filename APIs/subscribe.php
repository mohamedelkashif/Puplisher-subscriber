<?php

require("../phpMQTT.php");

	
  $done = 0;
  $host = "m12.cloudmqtt.com"; 
  $port = 11913;
  $username = "oqmzsuoc"; 
  $password = "dBQg-4Zz98vW";  
  $start_time = time();
  $mqtt = new phpMQTT($host, $port, "ClientID".rand()); 

  if(!$mqtt->connect(true,NULL,$username,$password)){
    exit(1);
  }
  else
  {
  	echo "connected successfully <br/>";
  }
  $topicsfound = explode(',', $_POST['topic']);
  foreach($topicsfound as $topicfound)
    {
      $topics[$topicfound] = array("qos"=>0, "function"=>"procmsg");
    }
  
  $mqtt->subscribe($topics,0);

  while(!hasTimedout()  && $mqtt->proc()){

  }
  function hasTimedout() {
  global $start_time;
  return (time() - $start_time > 60);
  }
  $mqtt->close();
  echo 'Session has ended';
  function procmsg($topic,$msg){
 //  	global $done;
	// $done = 1;
    echo "Topic was: $topic ,Msg Recieved: $msg <br/>";
    echo str_pad('',4096)."\n";
     ob_flush();
        flush();

  }

?>
