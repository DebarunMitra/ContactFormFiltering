<!DOCTYPE html>
<?php
$error='';
$name='';
$mail='';
$subject='';
$msg='';
$flag=0;
 function clean_str($string)
 {
 	$string=trim($string);
 	$string=stripcslashes($string);
 	$string=htmlspecialchars($string);
 	return $string;
 }
 ?>

<html>
<head>
	<title>Contact Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <style>
      .header_img
      {
           background: url('images/sparsh.png') no-repeat;
           position:static;
           background-size: 100% 100%;
           width: auto;
      }
      .bg_img
      {
          position: static;
          top: 20px;
          width:auto;
          background: url('images/run.jpg');
          background-size: 100% 100%;
      }
      label
      {
          font-family: serif;
          font-size:20px;
          color: cyan;
      }
      h1{
          padding: 10%;
          font-family: serif;
          color:cyan; 
          font-size: xx-large;
      }
      .responsive
      {
            min-width:109%; 
            height:100px; 
            background-size:cover;
            position: initial;
      }
        @media only screen and (max-width: 1200px) {
      .responsive
      {
            width:109%; 
            height:100px; 
            background-size:cover;
            position: initial;
      }
       @media only screen and (min-width: 400px) {
      .responsive
      {
            width:113%; 
            height:100px; 
            background-size:cover;
            position: initial;
      }
        }
  </style>
</head>
<body>
    <div class="container" style="width:30%; border-style:solid; border-color: seagreen; border-width: 10px; border-radius:25px;">
       <img src="images/sparsh.png" class="row responsive">
        <div class="row bg_img">
   <div class="col-lg-12 col-md-12" style="">
      <h1 class="text-center" style=""><u>Contact Form</u></h1>
	<form method="post">
		<div class="form-group">
                    <label>Enter Name</label><br>
                    <input type="text" name="name" class="form-control" placeholder="ENTER NAME" value="<?=$name?>">
		</div>
				<div class="form-group">
                                    <label>Enter Email Id</label><br>
			<input type="text" name="mail" class="form-control" placeholder="ENTER MAIL ID" value="<?=$mail?>">
		</div>
				<div class="form-group">
                                    <label>Enter Subject</label><br>
			<input type="text" name="subject" class="form-control" placeholder="ENTER SUBJECT" value="<?=$subject?>">
		</div>
				<div class="form-group">
                                    <label>Enter Message</label><br>
                        <textarea type="text" name="msg" class="form-control" placeholder="ENTER MESSAGE" value="<?=$msg?>"></textarea>
		</div>
		<div class="form-group" align="center">
		<button class="btn btn-danger" id="submit"  name="submit">SEND</button>
	</div>
	</form>
	<?php
	if(isset($_POST['submit']))
	if(empty($_POST['name']))
	{
		$error.='<p><label class="">ENTER YOUR NAME</label></p>';
	}
	else
	{
			$name= clean_str($_POST['name']);
			if(!preg_match("/^[a-zA-Z ]*$/", $name))
			{
				$error.='<p><label class="">ONLY LETTERS & WHITE SPACE ALLOWED IN NAME</label></p>';		
                        }
	}
	if(empty($_POST['mail']))
	{
		$error.='<p><label class="">ENTER YOUR EMAIL ID</label></p>';
        }
	else
	{
			$mail=clean_str($_POST['mail']);
			if(!filter_var($mail,FILTER_VALIDATE_EMAIL))
			{
				$error.='<p><label class="">INVALID EMAIL FORMAT</label></p>';
                         }
	}
	if(empty($_POST['subject']))
	{
		$error.='<p><label class="">ENTER YOUR SUBJECT</label></p>';
        }
	else
	{
			$subject=clean_str($_POST['subject']);
			if(!preg_match("/^[a-zA-Z0-9,'' ]*$/", $subject))
			{
				$error.='<p><label class="">ONLY LETTERS & WHITE SPACE ALLOWED IN SUB</label></p>';
                        }
	if(empty($_POST['msg']))
	{
		$error.='<p><label class="">ENTER YOUR MESSAGE</label></p>';
        }
	else
	{
			$msg=clean_str($_POST['msg']);
			if(!preg_match("/^[a-zA-Z0-9,'' ]*$/", $msg))
			{
				$error.='<p><label class="">ONLY LETTERS & WHITE SPACE ALLOWED IN MSG</label></p>';
             
                        }
	}
	if($error=='')
	{
		$file_open=fopen("contact_data.csv", "a");
		$no_rows=count(file("contact_data.csv"));
		if($no_rows>1)
		{
			$no_rows=($no_rows - 1) + 1;
		}
		$form_data=array(
			'sl_no' => $no_rows,
			'name'=>$name,
			'mail'=>$mail,
			'subject'=>$subject,
			'msg'=>$msg
		 );
		fputcsv($file_open, $form_data);
		$error.='<center><p><label class="">Successful</label></p></center>';
		$name='';
		$mail='';
		$subject='';
		$msg='';
		$flag=1;
	}
        echo $error;
}

	
	?>
</div>
 </div>
    </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                        <script>
               if ( window.history.replaceState ) {
                          window.history.replaceState( null, null, window.location.href );
                         }
                                   </script>
  </body>
</html>