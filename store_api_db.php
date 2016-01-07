 <?php
    //connect to mysql db
    $username = "nextorbit";
    $password = "";
    $host = "localhost";
    $database="walmart";
    $con = mysqli_connect($host,$username,$password,$database) or die('Could not connect: ' . mysql_error());
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    //connect to the walmart database
    //mysqli_select_db("walmart", $con);

    //@mysql_select_db($database) or die( "Unable to select database");

    /*$cities = array("Newark", "Los+Angeles", "Chicago", "Houston", "Philadelphia", "Phoenix", "San+Antonio", "San+Diego"," Dallas"," San+Jose", "Austin", "Indianapolis", "Jacksonville", "San+Francisco", "Columbus", "Charlotte", "Fort+Worth", "Detroit", "El+Paso", "Memphis", "Seattle", "Denver", "Washington+DC", "Boston", "Nashville", "Baltimore", "Oklahoma+City", "Louisville", "Portland", "Las+Vegas", "Milwaukee", "Albuquerque", "Tucson", "Fresno", "Sacramento", "Long+Beach", "Kansas+City", "Mesa", "Virginia+Beach", "Atlanta", "Colorado+Springs", "Omaha", "Raleigh", "Oakland", "Minneapolis", "Tulsa", "Cleveland", "Wichita", "Arlington");*/

    $cities = array("Newark");

    $arrlength = count($cities);

    for($x = 0; $x <  $arrlength; $x++) {
    $city_name=$cities[$x];
    printf($city_name);
    insert_store_data($city_name);
    }

 function insert_store_data($city_name)
    {

    global $con;
    //read the json file contents
    $URL= 'http://api.walmartlabs.com/v1/stores?apiKey=7hbsnck6acm8sh2nr8w4m3pc&city=' . $city_name . '&format=json';
    //$URL= 'http://api.walmartlabs.com/v1/stores?apiKey=7hbsnck6acm8sh2nr8w4m3pc&city=newark&format=json';
    $jsonResult=file_get_contents($URL);
    print_r( $jsonResult);
    //convert json object to php associative array
    $result=json_decode($jsonResult,true);
    //print_r($result);
    //$iCount=count($result);

    
    for($i= 0; $i < sizeof($result); $i++){
        
    $s_no = mysqli_real_escape_string($result[$i]["no"]);
    $name = mysqli_real_escape_string($result[$i]["name"]);
    $country = mysqli_real_escape_string($result[$i]['country']);
    $lat = mysqli_real_escape_string($result[$i]['coordinates'][0]);
    $long = mysqli_real_escape_string($result[$i]['coordinates'][1]);
    $address = mysqli_real_escape_string($result[$i]['streetAddress']);
    $state = mysqli_real_escape_string($result[$i]['stateProvCode']);
    $city = mysqli_real_escape_string($result[$i]['city']);
    $zip = mysqli_real_escape_string($result[$i]['zip']);
    $phone = mysqli_real_escape_string($result[$i]['phoneNumber']);
    $sunday_open = mysqli_real_escape_string($result[$i]['sundayOpen']);
    $timezones = mysqli_real_escape_string($result[$i]['timezone']);
    print_r($s_no);
    print_r($lat);
    print_r($long);
    print_r($zip);
    print_r($phone);
    //insert into mysql table

    /*$sql = "INSERT INTO `stores` (s_no,name,country,lat,long,address,city,state_code,zip,phone,sunday_open,timezones)
    VALUES('" . $s_no . "', '" . $name . "', '" . $country . "', '" . $lat . "','" . $long . "', '" . $address . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $phone . "', '" . $sunday_open . "','" . $timezones . "')";*/
   
   mysqli_query($con,"INSERT INTO `store2` (s_no,name,country,lat,long,address,city,state_code,zip,phone,sunday_open,timezones)
    VALUES('" . $s_no . "', '" . $name . "', '" . $country . "', '" . $lat . "','" . $long . "', '" . $address . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $phone . "', '" . $sunday_open . "','" . $timezones . "')");
   /* if(!mysqli_query($con,$sql))
    {
        die('Error : Databse not copied' . mysql_error());
    }*/
    mysqli_commit($con);
    echo "Copied to database sucessfully";
    sleep(3);
    }
}


    /*     
     for(var i = 0; i <$iCount; i++) {
        var obj = json[i];

        console.log(obj.id);
    }
    

        $json_array = json_decode($_POST['json'], true);
    $assoc_array = array();

    for($i = 0; $i < sizeof($json_array); $i++)
    {
         $key = $json_array[$i]['name'];
         $assoc_array[$key] = $json_array[$i]['value'];
    }*/

    ?>