<?php
$url = 'http://sc.istmeinhandyan.de:1337/';
function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_NOBODY         => true,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "Title graber", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 5,      // timeout on connect
        CURLOPT_TIMEOUT        => 5,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_PORT           => 1337,     // port
        CURLOPT_VERBOSE        => true,     // debuging option
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
    //return $header['content'];
    return $header;
}
echo '<pre>';
echo print_r(get_web_page($url));
//$file = trim(get_web_page($url));

/*
$pattern1 = '~Players Online: </font><font size="2" color="#BBBBBB"><b>[0-9]*</b></font></td>~';
preg_match_all($pattern1, $file, $matches);
$string = json_encode($matches[0]);
//["Players Online: <\/font>61612<\/b><\/font><\/td>"]
$string = str_replace('<\/b><\/font><\/td>"]', '', $string);
$string = str_replace('["Players Online: <\/font>', '', $string);
$string = str_replace('<font size=\"2\" color=\"#BBBBBB\"><b>', '', $string);
echo '<pre>';
echo $string;
echo '</pre>';
*/

?>