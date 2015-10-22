<?php

header("Content-Type: text/html;charset=utf-8");

//����һ========================================================================
$urls = array(
    'http://www.sina.com.cn/',
    'http://www.sohu.com/',
    'http://www.163.com/',
    'http://tupian.baidu.com'
); //����Ҫץȡ��ҳ��URL

$save_file='test.txt'; //��ץȡ�Ĵ���д����ļ�

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
    curl_setopt($conn[$i], CURLOPT_FILE,$save); //���ý���ȡ�Ĵ���д���ļ�

    curl_multi_add_handle ($mh,$conn[$i]);
} //��ʼ��

do {
    curl_multi_exec($mh,$active);
} while ($active); //ִ��

foreach ($urls as $i => $url) {
    curl_multi_remove_handle($mh,$conn[$i]);
    curl_close($conn[$i]);
} //��������

curl_multi_close($mh);
//fclose($save);



//������=================================================================================
//$urls = array(
//    'http://www.sina.com.cn/',
//    'http://www.sohu.com/',
//    'http://www.163.com/'
//);
//
//$save_to='test.txt';  // ��ץȡ�Ĵ���д����ļ�
//$st = fopen($save_to,"a");
//
//$mh = curl_multi_init();
//foreach ($urls as $i => $url) {
//    $conn[$i] = curl_init($url);
//    curl_setopt($conn[$i], CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
//    curl_setopt($conn[$i], CURLOPT_HEADER ,0);
//    curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT,60);
//    curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER,true); // ���ò�����ȡ����д�������������ת��Ϊ�ַ���
//    curl_multi_add_handle ($mh,$conn[$i]);
//}
//
//do {
//    curl_multi_exec($mh,$active);
//} while ($active);
//
//foreach ($urls as $i => $url) {
//    $data = curl_multi_getcontent($conn[$i]); // �����ȡ�Ĵ����ַ���
//    fwrite($st,$data); // ���ַ���д���ļ�����Ȼ��Ҳ���Բ�д���ļ�������������ݿ�
//} // ������ݱ�������д���ļ�
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
    $contents = getLine('test.txt', $j); //��ȡimage_url.txt�ļ���$j������
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

