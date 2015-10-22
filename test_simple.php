<?php

header("Content-Type: text/html;charset=utf-8");

//方法一========================================================================
$urls = array(
    'http://www.sina.com.cn/',
    'http://www.sohu.com/',
    'http://www.163.com/',
    'http://tupian.baidu.com'
); //设置要抓取的页面URL

$save_file='test.txt'; //把抓取的代码写入该文件

if(file_exists($save_file)) {
    $urls = array("");
    $save = fopen($save_file, "a");
    $mh = curl_multi_init();
}
else {
    $save = fopen($save_file, "a");
    $mh = curl_multi_init();
}

foreach ($urls as $i => $url) {
    $conn[$i] = curl_init($url);
    curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
    curl_setopt($conn[$i], CURLOPT_HEADER ,0);
    curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT,60);
    curl_setopt($conn[$i], CURLOPT_FILE,$save); //设置将爬取的代码写入文件

    curl_multi_add_handle ($mh,$conn[$i]);
} //初始化

do {
    curl_multi_exec($mh,$active);
} while ($active); //执行

foreach ($urls as $i => $url) {
    curl_multi_remove_handle($mh,$conn[$i]);
    curl_close($conn[$i]);
} //结束清理

curl_multi_close($mh);
//fclose($save);



//方法二=================================================================================
//$urls = array(
//    'http://www.sina.com.cn/',
//    'http://www.sohu.com/',
//    'http://www.163.com/'
//);
//
//$save_to='test.txt';  // 把抓取的代码写入该文件
//$st = fopen($save_to,"a");
//
//$mh = curl_multi_init();
//foreach ($urls as $i => $url) {
//    $conn[$i] = curl_init($url);
//    curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
//    curl_setopt($conn[$i], CURLOPT_HEADER ,0);
//    curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT,60);
//    curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER,true); // 设置不将爬取代码写到浏览器，而是转化为字符串
//    curl_multi_add_handle ($mh,$conn[$i]);
//}
//
//do {
//    curl_multi_exec($mh,$active);
//} while ($active);
//
//foreach ($urls as $i => $url) {
//    $data = curl_multi_getcontent($conn[$i]); // 获得爬取的代码字符串
//    fwrite($st,$data); // 将字符串写入文件。当然，也可以不写入文件，比如存入数据库
//} // 获得数据变量，并写入文件
//
//foreach ($urls as $i => $url) {
//    curl_multi_remove_handle($mh,$conn[$i]);
//    curl_close($conn[$i]);
//}
//
//curl_multi_close($mh);
//fclose($st);

$j=1;
while($j < 10000){
    $contents = getLine('test.txt', $j); //读取image_url.txt文件第$j行内容
    echo "<br>";

    $url = $contents;
    $result = preg_match('/http://[^\s]*.(jpg|png|jpeg)', $url, $match);
    echo $result;

    $result = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$result);
    //$url = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$url);
    //echo '<img src="'.$match.'">'.$match.'</a>';
    //echo $url;
    $j++;
}

function getLine($file, $line, $length = 4096){
    $returnTxt = null; // 初始化返回
    $i = 1; // 行数

    $handle = @fopen($file, "r");
    if ($handle) {
        while (!feof($handle)) {
            $buffer = fgets($handle, $length);
            if($line == $i) $returnTxt = $buffer;
            $i++;
        }
        fclose($handle);
    }
    return $returnTxt;
}

?>

