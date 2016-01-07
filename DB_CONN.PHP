 <?php	 

	$username = "";
    $password = "";
    $host = "";
    $database="";
    $con = mysqli_connect($host,$username,$password,$database) or die('Could not connect: ' . mysql_error());
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }


   mysqli_query($con,"INSERT INTO `stores` (s_no,name,country,lat,long,address,city,state_code,zip,phone,sunday_open,timezones)
    VALUES('1212021','RVSV','SVSV','324123.43','32442.54','SDFWFS WF','SDVSDV','ER','243324234','sdfds','SSS','SDFSD2')");
   if(!mysqli_query($con,$sql))
    {
        die('Error : Databse not copied' . mysql_error());
    }
    mysqli_commit($con);
    echo "Copied to database sucessfully";
    

?>