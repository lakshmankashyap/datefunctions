<?php
ob_start();
function exception_error_handler($errno, $errstr, $errfile, $errline) {
    pr(sprintf("Error No %s at line => %s in file { %s } error Msg :: $errstr", $errno, $errline, $errfile, $errstr));
}

//set ur error handle
set_error_handler("exception_error_handler");

function print_pre($expression, $return = false, $wrap = false) {
    $css = 'border:1px dashed #06f;background:#69f;padding:1em;text-align:left;';
    if ($wrap) {
        $str = '<p style="' . $css . '"><tt>' . str_replace(array('  ', "\n"), array('&nbsp; ', '<br />'), htmlspecialchars(print_r($expression, true))) . '</tt></p>';
    } else {
        $str = '<pre style="' . $css . '">' . htmlspecialchars(print_r($expression, true)) . '</pre>';
    }
    if ($return) {
        if (is_string($return) && $fh = fopen($return, 'a')) {
            fwrite($fh, $str);
            fclose($fh);
        }
        return $str;
    } else echo $str;
} 

function isLocal() {
    return $_SERVER['HTTP_HOST'] == 'localhost' || preg_match("/.local/", $_SERVER['HTTP_HOST']);
}
function varDump($value = null) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}
function pr($value = null) {
    printf('<pre>%s</pre>', print_r($value, true));
}
function prd($value = null) {
    printf('<pre>%s</pre>', print_r($value, true));
    die;
}
 
 // for age calculate

function getAge($then) {
    $then_ts = strtotime($then);
    $then_year = date('Y', $then_ts);
    $age = date('Y') - $then_year;
    if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
    return $age;
}

function successMessage(){
    $message = "Action successfully";
    return "<div class='message' style='background:#cef6ce;
color:#088a08;'>$message</div>";
}

function failureMessage(){
    $message = "We're sorry, something wrong. Please try again.";
    return "<div class='message error' style='background:#f5a9a9;
color:#610b0b;'>$message</div>";
}

function failureLogin(){
    $message = "Username or Password wrong. Please try again.";
    return "<div class='message error' style='background:#f5a9a9;
color:#610b0b;'>$message</div>";
}

function failureEmpty(){
    $message = "Please Fill all the requirements fields";
    return "<div class='message error' style='background:#f5a9a9;
color:#610b0b;'>$message</div>";
}

function dateFormate($date){
    return date("d/m/Y", strtotime($date)); 
}

function dateYearFormate($date){
    return date("Y-m-d", strtotime($date));
}

function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
 function dateOfEntry(){
    $doe =date("Y-m-d H:i:s");
    return $doe;
}

function mysql_real_escape_string_port($string) {
    return addcslashes ($string, "\x00\n\r\\'\"\x1a");
}


function redirects($url) {
  if(headers_sent()){
  ?>
    <html><head>
      <script language="javascript" type="text/javascript">
        window.self.location='<?php print($url);?>';
      </script>
    </head></html>
  <?php
    exit;
  } else {
    header("Location: ".$url);
    exit;
  }
}

//for print words limit
function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ", array_splice($words, 0, $word_limit));
}
 
//

function limitWords($string, $num_words){
    //Pull an array of words out from the string (you can specify what delimeter you'd like)
    $array_of_words = explode(" ", $string);

    //Loop the array the requested number of times and build an output, re-inserting spaces.
    for ($i = 1; $i <= $num_words; $i++) {
        $output .= $array_of_words[$i] . " ";
    }
    return trim($output);
}
//for stripslashes_deep use at article
function stripslashes_deep($value)
{
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}


function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return strtolower($string);
}

$request_url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

function dateByMonth($date){
   $orignaltime = strtotime($date);
   return date("d  F Y",$orignaltime); 
}

function IsArticleColor($i = NULL){

 if($i ==0){
    $isColor = '#c46f17;';
 }else if($i ==1){
     $isColor = '';
 }elseif ($i == 2) {
     $isColor = '#56714c;';
 }elseif($i == 3){
    $isColor = ''; 
 }elseif($i == 4){
    $isColor = '#56714c;'; 
 }elseif($i == 5){
    $isColor ='#c46f17';
 }
return $isColor;
}

// $evalutation_location_array = array("South(S)", "South West(SW)", "West(W)", "North West(NW)", "North(N)", "South East(SE)", "East(E)", "North East(NE)");
function PinchIsastorology(){
  $pinch_astrology_location_array = array("Delhi", "Mumbai", "Kolkata", "Bangalore", "Ahemdabad", "Jaipur");
  return $pinch_astrology_location_array;
}

//for data like 10 oct 2015

function GetMonth($getDate =NULL){
     $orignaltime = strtotime($getDate);
     return date("d M Y",$orignaltime);
}



function getFacebookComment(){
$source_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($source_url);
$xml = file_get_contents($url);
$xml = simplexml_load_string($xml);
$shares = $xml->link_stat->share_count;
$likes = $xml->link_stat->like_count;
$comments = $xml->link_stat->comment_count; 
$total = $xml->link_stat->total_count;


return isset($comments) ? $comments : 0;

}

function get_youtube($url){

 $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

 $curl = curl_init($youtube);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $return = curl_exec($curl);
 curl_close($curl);
 return json_decode($return, true);

}


function getFullUrl(){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link;
}


//for insert query 
function replace_SpecialChar($text) {
    $text = str_replace("�", "&#8217;", $text);
    $text = str_replace("�", "&#8217;", $text);
    $text = str_replace("�", "&#8217;", $text);
    $text = str_replace("�", "&#8217;", $text);
    $text = str_replace("'", "&#8217;", $text);
    $text = str_replace(",", ",", $text);
    $text = str_replace("�", "-", $text);
    $text = str_replace("-", "-", $text);
    $text = str_replace("�", "&quot;", $text);
    $text = str_replace("�", "&quot;", $text);
    return $text;
}

function rmDoubleSpace($string){
    return preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);
}


function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
}

function facebookActivities(){

  $source_url = getFullUrl();
  $xml = simplexml_load_file("http://api.facebook.com/restserver.php?method=links.getStats&urls=".$source_url);
 
  $FB['share'] =$xml->link_stat->share_count; //share count
  $FB['like'] =$xml->link_stat->like_count; //share count
 return $FB;

}

function isImage($imagesId){

if($imagesId ==7){ 
  $image ='b1.jpg';
}else if($imagesId ==9){
  $image ='b2.jpg';
}else if($imagesId ==6){
  $image ='b3.jpg';
}else if ($imagesId ==5) {
 $image ='b4.jpg';
}else if ($imagesId ==2) {
 $image ='b5.jpg';
}else if ($imagesId ==9) {
 $image ='b6.jpg';
}else if ($imagesId ==1) {
 $image ='b7.jpg';
}else if ($imagesId ==4) {
 $image ='b8.jpg';
}
else if ($imagesId ==8) {
 $image ='b9.jpg';
}else if($imagesId ==3) {
 $image ='b10.jpg';

}else{
  $image ="";
}
return $image;
}


function validEmail($email){
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }

    return true;
}

function getLenths($string,$countNum){
   return $stringCount = strlen($string) >= $countNum ? 
substr($string, 0, $countNum) . '....' : 
$string;

}

function Month(){
    $months = array(
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'June',
    'July ',
    'Aug',
    'Sept',
    'Oct',
    'Nov',
    'Dec',
);
    return $months;
}

function youtubeViewsCount($vId){
     $json = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails,statistics&id=".$vId."&key=AIzaSyA754k1RAJryt3oxbfZ3mpaO5756CDhMgE");

    return $json_data = json_decode($json, true);
}

function youtubeChanel(){
    $feedURL = 'https://www.youtube.com/feeds/videos.xml?user=vaastuwithpuneet';
    return $sxml = simplexml_load_file($feedURL);
}

//for get video time duration

function getYoutubeVideoDuration($vID){
    $dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=".$vID."&key=AIzaSyA754k1RAJryt3oxbfZ3mpaO5756CDhMgE");

  $duration =json_decode($dur, true);
  foreach ($duration['items'] as $vidTime) {
     $vTime= $vidTime['contentDetails']['duration'];
  $interval = new DateInterval($vTime);
    $seconds = $interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s;
return gmdate("H:i:s", $seconds);

   }
}




function captcha(){
$n1=rand(1,6); //Generate First number between 1 and 6  
$n2=rand(5,9); //Generate Second number between 5 and 9  
$answer=$n1+$n2;  
 
$math = "What is ".$n1." + ".$n2." : ";  
$_SESSION['vercode'] = $answer;

return $math;
}

function replacePie($pie){

    return str_replace("|", ",", $pie);

}