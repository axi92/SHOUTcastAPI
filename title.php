<?php
$url = 'http://sc.istmeinhandyan.de:1337/';
function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 5,      // timeout on connect
        CURLOPT_TIMEOUT        => 5,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_PORT           => 1337,     // port
        CURLOPT_VERBOSE        => false,     // debuging option
        CURLOPT_SSL_VERIFYPEER => false,     // debuging option
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header['content'];
}
$file = trim(get_web_page($url));


$pattern1 = '~Current Song: <\/font><\/td><td><font class=default><b>[a-zA-Z0-9 .-]*~';
preg_match_all($pattern1, $file, $matches);
$string = json_encode($matches[0]);
$string = str_replace('Current Song: <\/font><\/td><td><font class=default><b>', '', $string);
$string = str_replace('["', '', $string);
$string = str_replace('"]', '', $string);
/*
$string = str_replace('<font size=\"2\" color=\"#BBBBBB\"><b>', '', $string);
*/
//echo '<pre>';
echo $string;
//echo '</pre>';

?>