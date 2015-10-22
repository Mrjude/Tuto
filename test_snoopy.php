<?php
/**
 * 爬虫程序 -- 原型
 * 从给定的url获取html内容
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
 * 从html内容中筛选链接
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
 * 修正相对路径
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
                // 已经是完整的url
                $result[] = $url_item;
            } else {
                // 不完整的url
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
 * 爬虫
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
 * 测试用主程序
 */
function main() {
    $current_url = "http://tupian.baidu.com"; //初始url
    $fp_puts = fopen("url.txt", "ab"); //记录url列表
    $fp_gets = fopen("url.txt", "r"); //保存url列表
    do {
        $result_url_arr = crawler($current_url);
        if ($result_url_arr) {
            foreach ($result_url_arr as $url) {
                fputs($fp_puts, $url . "\r\n");
            }
        }
    } while ($current_url = fgets($fp_gets, 1024)); //不断获得url
}
main();

$img = array();
for($count = 1; $count <= 3; $count++){
    $img[$count] = rand(0,58);
}
$count = 1;

$j=1;
while($j < 3){
    $contents = getLine('./url.txt', $j); // 读取url.txt文件第$j行内容
    echo "<br>";
    $url = $contents;
    $url = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','1',$url);
    echo '<img src="'.$url.'">'.$url.'</a>';
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