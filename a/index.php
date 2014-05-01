<?php



echo date('H:i:s',time()); die;
// Create a curl handle
$ch = curl_init('http://s.taobao.com/search?spm=a214x.6760217.991146337.60.JIg96L&initiative_id=staobaoz_20140327&js=1&q=%CD%D0%C2%ED%CB%B9&stats_click=search_radio_all%3A1');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// Execute
curl_exec($ch);

// Check if any error occurred'顏色分類
if(!curl_errno($ch))
{
 $info = curl_getinfo($ch);

 echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
}

// Close handle
curl_close($ch);
?>