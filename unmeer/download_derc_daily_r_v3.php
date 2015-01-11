<?php 

error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Usage php -f download_derc_daily_r_v3.php <date> <schema_file>

function ReadSchemaFile($schema_file)
{
    $aSchema = array();
	$iSchema = 0;
	$file = fopen($schema_file,"r");

	while(! feof($file))
  	{
		$aSchema[$iSchema]=fgetcsv($file);
		$iSchema++;
  	}

	 fclose($file);
	 return $aSchema;
}

/* $entry : contains all data for a single sumbission
   $aSchema : array containg all the schema file
   $entry_repeat_id : contains the repeat parent id (eg comments). Children should start with 
   the same id (eg comments/xxx)
*/
     
function GetDescriptionInSchema($key, $aSchema)
{
    $nSchemaCount = count($aSchema);
    for ($j=0; $j<$nSchemaCount; $j++)
	{
        $aSchemaSingle = $aSchema[$j];
        if (trim($aSchemaSingle[0]) === $key)
            return $aSchemaSingle[1];
    }
    return $key;
}
function GetRepeatInformaton($aRepeatChildren, $aSchema)
{
    $aSchemadArray = array();
    //var_dump($aRepeatChildren);
    $keys = array_keys($aRepeatChildren);
    //var_dump($aSchema);
    for ($i=0; $i<count($aRepeatChildren); $i++) {
        $aSchemadArray[$i] = array();
        
        $oneChild = $aRepeatChildren[$i];
        //var_dump($oneChild);
        $oneChildWithSchemaKey = array();
        $keys = array_keys($oneChild);
        //var_dump($keys);
        for ($j=0;$j<count($keys); $j++) {
            //$aSchema[$keys[$j]][1]
            //$oneChildWithSchemaKey[$aSchema[$keys[$j]][1]] = $oneChild[$keys[$j]];
            $schemaDesc = GetDescriptionInSchema($keys[$j], $aSchema);
            //echo "schema for " . $keys[$j] . " = " . GetDescriptionInSchema($keys[$j], $aSchema) . "\n";
            $oneChildWithSchemaKey[$schemaDesc] = $oneChild[$keys[$j]];
        }
        array_push($aSchemadArray[$i], $oneChildWithSchemaKey);
        //$aSchemadArray[$aSchema[$keys[$i]][1]] = $aRepeatChildren[$keys];
    }
    //var_dump($aSchemadArray);
    //echo json_encode($aSchemadArray);
    return $aSchemadArray;//$aRepeatChildren;
    
}

function WriteChildFile($file_name, $obj, $aSchema, $key)
{
    $nEntries = count($obj);
    //echo $nEntries;
    $aCsvOutput = array();

/*
    $aComment = array();
	$iComment = 0;
    $file = fopen('2015010_daily_derc_report_v3_comments.csv',"r");
    while(! feof($file))
  	{
		$aComment[$iComment]=fgetcsv($file);
		$iComment++;
  	}

    fclose($file);

    print_r($aComment);
*/
    for ($i=0; $i<$nEntries; $i++) {

        $entry = $obj[$i];
        //print_r($entry);
        $district_name = $entry['district'];
        $aCsvDistrict =  array();
        array_push($aCsvDistrict,  array($district_name,'', ''));

        if (!array_key_exists($key, $entry))
            continue;

        $aChild = $entry[$key];
        print_r($aChild);

        /*
        for ($j=0; $j<count($aChild); $j++)
        {
            $aChildrenKeys = array_keys($aChild[$j]);
            $aOneLineOutput = array();
            $aOneLineOutput = $aOneLineOutput[0];
            
            for ($k=0; $k<count($aChildrenKeys); $k++)
            {
                $desc = GetDescriptionInSchema($aChildrenKeys[$k]);
                array_push($aOneLineOutput, $desc);
                array_push($aOneLineOutput, 
            }
           
        */     
        /*
        
        $aComments[0]='';
        $aComments[1] = 'surveillance';
        $aComments[2] = 'surveillance comment';
        */
        array_push($aCsvDistrict, $aChild);


        array_push($aCsvOutput, $aCsvDistrict);
    }
     
    //print_r($aCsvOutput);

    $fp = fopen($file_name, 'w');
    for($i=0; $i<count($aCsvOutput); $i++) {
        $aOneDistrict = $aCsvOutput[$i];
        for ($j=0; $j<count($aOneDistrict); $j++) {
            fputcsv($fp, $aOneDistrict[$j]);
        }
    }

    fclose($fp);
    
}




function WriteCommentFile($file_name, $obj, $aSchema, $key='comment', $date)
{
    $nEntries = count($obj);
    //echo $nEntries;
    $aCsvOutput = array();


    array_push($aCsvOutput,  array('District','Date' , 'Category', 'Comment'));
    for ($i=0; $i<$nEntries; $i++) {

        $entry = $obj[$i];
        //print_r($entry);
        $district_name = $entry['district'];
        $aCsvDistrict =  array();
        //array_push($aCsvDistrict,  array($district_name,'Category', 'Comment'));

        if (!array_key_exists($key, $entry))
            continue;

        $aChild = $entry[$key];
        //print_r($entry);
        //print_r($aChild);

        
        for ($j=0; $j<count($aChild); $j++)
        {
            $aOneLineOutput[0] = $district_name;
            $aOneLineOutput[1] = $date;
            $aOneLineOutput[2] = $aChild[$j]['comments/issue_category'];
            $aOneLineOutput[3] = $aChild[$j]['comments/issue_comment'];
            array_push($aCsvDistrict, $aOneLineOutput);
        }
        $empty_line = array();
        $empty_line[0] = "";
        $empty_line[1] = "";
        $empty_line[2] = "";
        
        //array_push($aCsvDistrict,  $empty_line);
             
        /*
        
        $aComments[0]='';
        $aComments[1] = 'surveillance';
        $aComments[2] = 'surveillance comment';
        */



        array_push($aCsvOutput, $aCsvDistrict);
        
    }
     
    //print_r($aCsvOutput);

    $fp = fopen($file_name, 'w');
    //put header
    fputcsv($fp, $aCsvOutput[0]);
    //put the districts
    for($i=1; $i<count($aCsvOutput); $i++) {
        $aOneDistrict = $aCsvOutput[$i];
        for ($j=0; $j<count($aOneDistrict); $j++) {
            fputcsv($fp, $aOneDistrict[$j]);
        }
    }

    fclose($fp);
    
}

/*
	Logic

	1- Get all the submissions for one date (We should have 13 or 14?) TODO: Verify with Steve
	Note : the date is the date of the R2 and should be give YYYY-MM-DD
	2- Write individual files (???)
	3- Write combined district daily
	4- Write comments section into files (?) 
*/

//$ona_url = "https://ona.io/api/v1/data/22216"; //Note that the id should be changed if the form changes
//$username = "assefay";
//$password = "ttt123!";

/*to get the for id use: curl -u nerc_im:nercmanager -X GET https://ona.io/api/v1/data?owner=nerc_im*/
$ona_url = "https://ona.io/api/v1/data/22834"; //Note that the id should be changed if the form changes
$username = "nerc_im";
$password = "nercmanager";

//check argument

$nCount = count($argv);
if ($nCount != 3)
{
	echo "Usage :  download_derc_daily_r_v3.php <date>  <schema_file>\n";
	exit;
}

$date = $argv[1];
$schema_file = $argv[2];
//TODO : check date validity
//TODO : check schema validity



// create curl resource 
$ch = curl_init(); 
//curl_setopt($ch, CURLOPT_USERPWD, "nerc_im:nercmanager");
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

// set url 
//curl_setopt($ch, CURLOPT_URL, "https://ona.io/api/v1/data/22216?query=%7B%22district%22%3A%20%22kailahun%22%7D"); 
//curl_setopt($ch, CURLOPT_URL, "https://ona.io/api/v1/data/22216?query=%7B%22Date%22%3A%20%222015-01-03%22%7D");
 
//print "https://ona.io/api/v1/data/22263?query=%7B%22date%22%3A%20%222015-01-04%22%7D";
//echo "\n";
$query_url = $ona_url ."?query=";
$date_query = "{\"date\": \"$date\"}";
$query_url = $ona_url ."?query=".urlencode($date_query);

//echo urldecode("%7B%22date%22%3A%20%22$date%22%7D");
//$url = "https://ona.io/api/v1/data/22720?query=%7B%22date%22%3A%20%22$date%22%7D";
//print $url;
//echo "\n";
//print $query_url;

//curl_setopt($ch, CURLOPT_URL, "https://ona.io/api/v1/data/22263?query=%7B%22date%22%3A%20%222015-01-04%22%7D"); 
curl_setopt($ch, CURLOPT_URL, $query_url); 


//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$output = curl_exec($ch); 

// close curl resource to free up system resources 
curl_close($ch);  

$obj = json_decode($output, true);
//Check if we find something
if (!is_array($obj))
{
	echo $obj;
	echo "\n";
	echo "Problem \n";
	exit;
}

//var_dump($obj);
//exit;

$nEntries = count($obj);
if ($nEntries <= 0) 
{
	echo "No entries for $date \n";
	exit;	
}
//echo $nEntries;

$aSchema = ReadSchemaFile($schema_file);

$aCsvOutput = array();

//print_r($aSchema);

$nSchemaCount = count($aSchema);
$cvs_header = array();
for ($i=0; $i<$nSchemaCount; $i++)
{
	$aSchemaSingle = $aSchema[$i];
	//assuming field_name,header,type,repeat_type
	if (trim($aSchemaSingle[3]) != 'repeat') {
	   array_push($cvs_header, trim($aSchemaSingle[1]));
	}
}

array_push($aCsvOutput, $cvs_header);
//print_r($cvs_header);

for ($i=0; $i<$nEntries; $i++)
{
	$entry = $obj[$i];
	$aCvsSingle = array();
	for ($j=0; $j<$nSchemaCount; $j++)
	{
		$aSchemaSingle = $aSchema[$j];

		if (trim($aSchemaSingle[3]) != 'repeat') {
		   
            if (trim($aSchemaSingle[2]) == 'repeat') {
                //array_push($aCvsSingle, GetRepeatInformaton($entry, $aSchema, $aSchemaSingle[0]));
                //echo serialize($entry[$aSchemaSingle[0]]);
               
                //echo var_export($entry[$aSchemaSingle[0]]);
                //echo json_encode($entry[$aSchemaSingle[0]]);
                //array_push($aCvsSingle, serialize($entry[$aSchemaSingle[0]]));
                if (is_array($entry[$aSchemaSingle[0]]))
                    $aRepeat = GetRepeatInformaton($entry[$aSchemaSingle[0]], $aSchema);
                else
                    $aRepeat = array();
                array_push($aCvsSingle, json_encode($aRepeat));
            }
            else {
                array_push($aCvsSingle, $entry[$aSchemaSingle[0]]);
            }
		}
	}
	array_push($aCsvOutput, $aCvsSingle);
	//var_dump($entry);
	//echo $entry->bed_capacity_holding_centres;
	//echo $entry->district_under_quarantine;
	//echo $entry->_submitted_by;
	//$ttt = "_submitted_by";
	//echo $entry[$ttt] . "\n";			
}

//print_r($aCsvOutput);

/* file name logic
   date_daily_derc_report_v3.csv
 */
$dateObj=date_create($date);
$dateString = date_format($dateObj,"Ymd");
$file_name= $dateString . "_daily_derc_report_v3.csv";



$fp = fopen($file_name, 'w');
foreach ($aCsvOutput as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);


/*write the comments in a seperate file*/

$file_name= $dateString . "_daily_derc_report_comments_v3.csv";
WriteCommentFile($file_name, $obj, $aSchema, 'comments', $date);

//$file_name= $dateString . "_daily_derc_report_oicc_v3.csv";
//WriteChildFile($file_name, $obj, $aSchema, 'oicc');

//echo   $output;
//print_r ($obj);

//var_dump($obj);//->comments);


?>