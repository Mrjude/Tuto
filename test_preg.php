<?php

/*PHP������ȡͼƬimg����е���������*/
$str = '<center><img src="http://img0.bdstatic.com/img/image/shouye/sheying1019.jpg" height="120" width="120">
<br/>PHP������ȡ�����ͼƬimg����е���������</center>';

//ȥ�����С��Ʊ�������ַ�������echoһ�¿���Ч��
//$html=preg_replace("[A-Za-z]","",$html);
//echo $html;

//1��ȡ����ͼƬ����
preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$str,$match);
echo $match[0];

////2��ȡwidth
//preg_match('/<img.+(width=\"?\d*\"?).+>/i',$str,$match);
//echo $match[1];
////3��ȡheight
//preg_match('/<img.+(height=\"?\d*\"?).+>/i',$str,$match);
//echo $match[1];

//4��ȡsrc
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
//    $contents = getLine('./test.txt', $j); //��ȡtest.txt�ļ���$j������
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
    $returnTxt = null; // ��ʼ������
    $i = 1; // ����

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