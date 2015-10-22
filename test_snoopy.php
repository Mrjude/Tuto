<?php
/**
 * ������� -- ԭ��
 * �Ӹ�����url��ȡhtml����
 * @param string $url
 * @return string
 */
function _getUrlContent($url) {
    $handle = @fopen($url, "r");
    if ($handle) {
        $content = stream_get_contents($handle, 1024 * 1024);
        return $content;
    } else {
        return false;
    }
}
/**
 * ��html������ɸѡ����
 * @param string $web_content
 * @return array
 */
function _filterUrl($web_content) {
    $reg_tag_a = '/<img.+src=\"?(.+\.(jpg|jpeg))\"?.+>/i';
    $result = preg_match_all($reg_tag_a, $web_content, $match_result);
    if ($result) {
        return $match_result[1];
    }
}
/**
 * �������·��
 * @param string $base_url
 * @param array $url_list
 * @return array
 */
function _reviseUrl($base_url, $url_list) {
    $url_info = parse_url($base_url);
    $base_url = $url_info['scheme'] . '://';
    if ($url_info['user'] && $url_info['pass']) {
        $base_url .= $url_info['user'] . ":" . $url_info['pass'] . "@";
    }
    $base_url .= $url_info['host'];
    if ($url_info['port']) {
        $base_url .= ":" . $url_info['port'];
    }
    $base_url .= $url_info['path'];
    print_r($base_url);
    if (is_array($url_list)) {
        foreach ($url_list as $url_item) {
            if (preg_match('/^http/', $url_item)) {
                // �Ѿ���������url
                $result[] = $url_item;
            } else {
                // ��������url
                $real_url = $base_url . '/' . $url_item;
                $result[] = $real_url;
            }
        }
        return $result;
    } else {
        return;
    }
}
/**
 * ����
 * @param string $url
 * @return array
 */
function crawler($url) {
    $content = _getUrlContent($url);
    if ($content) {
        $url_list = _reviseUrl($url, _filterUrl($content));
        if ($url_list) {
            return $url_list;
        }
        else {
            return ;
        }
    } else {
        return ;
    }
}
/**
 * ������������
 */
function main() {
    $current_url = "http://tupian.baidu.com"; //��ʼurl
    $fp_puts = fopen("url.txt", "ab"); //��¼url�б�
    $fp_gets = fopen("url.txt", "r"); //����url�б�
    do {
        $result_url_arr = crawler($current_url);
        if ($result_url_arr) {
            foreach ($result_url_arr as $url) {
                fputs($fp_puts, $url . "\r\n");
            }
        }
    } while ($current_url = fgets($fp_gets, 1024)); //���ϻ��url
}
main();

$img = array();
for($count = 1; $count <= 3; $count++){
    $img[$count] = rand(0,58);
}
$count = 1;

$j=1;
while($j < 3){
    $contents = getLine('./url.txt', $j); // ��ȡurl.txt�ļ���$j������
    echo "<br>";
    $url = $contents;
    $url = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$url);
    echo '<img src="'.$url.'">'.$url.'</a>';
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