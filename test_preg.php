<?php

/*PHP正则提取图片img标记中的任意属性*/
$str = '<center><img src="http://img0.bdstatic.com/img/image/shouye/sheying1019.jpg" height="120" width="120">
<br/>PHP正则提取或更改图片img标记中的任意属性</center>';

//去掉换行、制表等特殊字符，可以echo一下看看效果
//$html=preg_replace("[A-Za-z]","",$html);
//echo $html;

//1、取整个图片代码
preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$str,$match);
echo $match[0];

////2、取width
//preg_match('/<img.+(width=\"?\d*\"?).+>/i',$str,$match);
//echo $match[1];
////3、取height
//preg_match('/<img.+(height=\"?\d*\"?).+>/i',$str,$match);
//echo $match[1];

//4、取src
$str = preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$str,$match);
echo $match[1];
//$str = preg_match('/(href|src)=([\'|']?)([^\''>]+\.(gif|jpg|jpeg|bmp|png))\\2/i', $str, $match);
//echo $match[1];
//echo $str;

echo "<br>";

//$url = 'http://www.baidu.com';
//$fp = fopen($url, 'r');
//stream_get_meta_data($fp);
//$result = '';
//while(!feof($fp))
//{
//    $result .= fgets($fp, 1024);
//}
//
//preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', $result, $match);
//echo $match[1];

//    $j=1;
//    //while($j < 100){
//    $contents = getLine('./test.txt', $j); //读取test.txt文件第$j行内容
//    echo "<br>";

    $url = 'http://tupian.baidu.com';
    $contents = file_get_contents($url);
//    $getcontent = iconv("gb2312", "utf-8", $contents);
//    echo $contents;
    $urls = $contents;
    $urls = preg_match_all('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i', $urls, $match);
    echo $match;

    //$result = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$result);
    //$url = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$url);
    //echo '<img src="'.$match.'">'.$match.'</a>';
    //echo $url;
//    echo $result;
//    $j++;
//}

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