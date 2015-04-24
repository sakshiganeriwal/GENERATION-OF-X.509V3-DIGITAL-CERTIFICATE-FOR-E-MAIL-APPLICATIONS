<?php
if(!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}
 
echo "Socket created \n";

if (!socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1)) {
		echo socket_strerror(socket_last_error($socket));
		exit;
}

for ( $port = 1234; $port < 65536; $port++ )
{
	echo $port;
    $result = socket_bind($sock, "192.168.137.178", $port);// or die("Could not bind to socket\n");
	//$result2=socket_bind($sock,"127.0.0.1",$port);
    if ( $result )
    {
        print "bind succeeded, port=$port\n";
        break;
    } else {
        print "Binding to port $port failed: ";
        print socket_strerror(socket_last_error($socket))."\n";
    }
}
if ( $port == 65536 ) die("Unable to bind socket to address\n");
// Bind the source address
/*if( !socket_bind($sock, "127.0.0.1" , 5000) )
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not bind socket : [$errorcode] $errormsg \n");
}
 
echo "Socket bind OK \n";
 */
for(;;){
	if(!socket_listen ($sock , 10)){
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		
		die("Could not listen on socket : [$errorcode] $errormsg \n");
	}
	
	echo "Socket listen OK \n";
	
	echo "Waiting for incoming connections... \n";
	
	//Accept incoming connection - This is a blocking call
	$client = socket_accept($sock);
		
	//display information about the client who is connected
	if(socket_getpeername($client , $address , $port)){
		echo "Client $address : $port is now connected to us.";
	}
	
	$msg="HTTP/1.1 200 OK\nContent-Type: text/html\n\r\n";
	
	if(socket_recv ( $client , $buf , 2045 , MSG_WAITALL ) === FALSE){
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		
		die("Could not receive data: [$errorcode] $errormsg \n");
	}
	$pagelink1=explode(" ",$buf);
	$pagelink=$pagelink1[1];
	
	if($pagelink=="/"){
		$pagelink="/index.html";
	
	}
	
	$pagelink="C:/wamp/www".$pagelink;
	$page=file_get_contents($pagelink);
	$msg=$msg.$page;
	socket_send($client,$msg,strlen($msg),0);

}
 
socket_close($client);
socket_close($sock);

?>