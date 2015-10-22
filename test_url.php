<?php

    include_once("test_snoopy.php");

    $j=1;
    while($j < 100){
        $contents = getLine('url.txt', $j); // 读取image_url.txt文件第$j行内容
        //echo $contents;
        echo "<br>";

        $url = $contents;
        //$url=$_GET['$contents'];

        $url = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$url);
        //$url = preg_replace('');

        /*function pic_tourl($url) {
            $url = htmlentities($url, ENT_QUOTES, "UTF-8");
            $url = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$url);
            $url = html_entity_decode($url, ENT_QUOTES, "UTF-8");
            $url = preg_replace('/[^a-z0-9]+/i', '-', $url);
            return strtolower($url);
        }*/
        //header('Loaction:'.$url);
        echo '<img src="'.$url.'">'.$url.'</a>';
        $j++;
    }

//$url = htmlentities($url, ENT_QUOTES, "UTF-8");
//$handler = fopen('', 'r');
//$content = '';
//while(!feof($handler)){
//        $content .= fread($handler, 8080);
//}
//echo $content;
//fclose($handler);

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