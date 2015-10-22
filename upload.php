<?php
/**
 * Created by PhpStorm.
 * User: M-JUDE
 * Date: 2015/10/5
 * Time: 0:35
 */
$uptypes=array(
    'image/jpg', //上传文件类型列表
    'image/jpeg',
    'image/png',
    'image/pjpeg',
    'image/gif',
    'image/bmp',
    'application/x-shockwave-flash',
    'image/x-png',
    'application/msword',
    'audio/x-ms-wma',
    'audio/mp3',
    'application/vnd.rn-realmedia',
    'application/x-zip-compressed',
    'application/octet-stream');
$max_file_size=1000000; //上传文件大小限制, 单位BYTE
$path_parts=pathinfo($_SERVER['PHP_SELF']); //取得当前路径
$destination_folder="up/"; //上传文件路径
$watermark=1; //是否附加水印(1为加水印,0为不加水印);
$watertype=1; //水印类型(1为文字,2为图片)
$waterposition=2; //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
$waterstring="www.tt365.org"; //水印字符串
$waterimg="xplore.gif"; //水印图片
$imgpreview=1; //是否生成预览图(1为生成,0为不生成);
$imgpreviewsize=1/1; //缩略图比例
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <link rel="stylesheet" href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/upload.css">
    <script src="js/upload.js"></script>
</head>

<body bgcolor="#FFFFFF">
<center>
    <form enctype="multipart/form-data" method="post" name="upform">
        <table border="2" bgcolor="#f0f8ff" width="60%" height="20%" id="table1" cellspacing = 0 >
            <tr height="25%">
                <td colspan="2">
                    <p align="center" style="font-size:10px; margin: 5px">Allowing Type of File:jpg|jpeg|gif|bmp|png|swf|mp3|wma|zip|rar|doc</p>
                </td>
            </tr>
            <tr height="5%">
<!--                <td width="10%">-->
<!--                    <div style="width:120px; height:40px; overflow:hidden; text-align: center;" >-->
<!--                        <IMG id="uploadimage" src=" " onload="javascript:DrawImage(this);">-->
<!--                    </div>-->
<!--                </td>-->
                <td width="50%">
                    <div style="width:360px; height:40px; text-align: center;padding: 10px;" >
                        <input name=upfile type=file onchange="javascript:FileChange(this.value);">
                    </div>
                </td>
                <td width="50%">
                    <div style="width:360px; height:40px; text-align: center; padding:10px 320px 10px 10px;">
                        <input type="submit" value="Upload">
                    </div>
                </td>
            </tr>
        </table>
    </form>



    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //是否存在文件
        if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
        {
            echo "<font-color='red'>the File isn't Exist！</font>";
            exit;
        }
        $file = $_FILES["upfile"];//定义$file变量
        //检查文件大小
        if($max_file_size < $file["size"])
        {
            echo "<font-color='red'>the File is Large！</font>";
            exit;
        }
        //检查文件类型
        if(!in_array($file["type"], $uptypes))
        {
            echo "<font-color='red'>the File Can't be upload！</font>";
            exit;
        }
        //上传文件地址是否存在
        if(!file_exists($destination_folder))
            mkdir($destination_folder);
        $filename=$file["tmp_name"];
        $image_size = getimagesize($filename);
        $pinfo=pathinfo($file["name"]);
        $ftype=$pinfo['extension'];
        $destination = $destination_folder.time().".".$ftype;
        if (file_exists($destination) && $overwrite != true)
        {
            echo "<font-color='red'>the Same File Exist！</a>";
            exit;
        }
        if(!move_uploaded_file ($filename, $destination))
        {
            echo "<font-color='red'>the File Move Error！</a>";
            exit;
        }
        $pinfo=pathinfo($destination);
        $fname=$pinfo['basename'];
        echo " <font-color=red>Upload Success</font><br>
        <table width=\"348\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\" class=\"table_decoration\" align=\"center\">
            <tr>
                <td>
                    <!--<input type=\"checkbox\" id=\"fmt\" onclick=\"select_format()\"/>Code UBB<br/>-->
                        <div id=\"site\">
                            <table border=\"0\">
                                <tr>
                                    <!--<td valign=\"top\">Address:</td>-->
                                    <td>
                                        <input style=\"width:600px\" type=\"text\" onclick=\"sendtof(this.value)\" onmouseover=\"oCopy(this)\" style=font-size=9pt;color:blue size=\"44\" value=\"http://".$_SERVER['SERVER_NAME'].$path_parts["dirname"]."/".$destination_folder.$fname."\"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id=\"sited\" style=\"display:none\">
                            <table border=\"0\">
                                <tr>
                                    <!--<td valign=\"top\">Address:</td>-->
                                    <td>
                                        <input style=\"width:200px\" type=\"text\" onclick=\"sendtof(this.value)\" onmouseover=\"oCopy(this)\" style=font-size=9pt;color:blue size=\"44\" value=\"[img]http://".$_SERVER['SERVER_NAME'].$path_parts["dirname"]."/".$destination_folder.$fname."[/img]\"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                </td>
            </tr>
        </table>";
        echo " Width:".$image_size[0]." Height:".$image_size[1];
//        if($watermark==1)
//        {
//            $iinfo=getimagesize($destination,$iinfo);
//            $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
//            $white=imagecolorallocate($nimage,255,255,255);
//            $black=imagecolorallocate($nimage,0,0,0);
//            $red=imagecolorallocate($nimage,255,0,0);
//            imagefill($nimage,0,0,$white);
//            switch ($iinfo[2])
//            {
//                case 1:
//                    $simage =imagecreatefromgif($destination);
//                    break;
//                case 2:
//                    $simage =imagecreatefromjpeg($destination);
//                    break;
//                case 3:
//                    $simage =imagecreatefrompng($destination);
//                    break;
//                case 6:
//                    $simage =imagecreatefromwbmp($destination);
//                    break;
//                default:
//                    die("<font-color='red'>this Type of File Can't be Upload！</a>");
//                    exit;
//            }
//            imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
//            imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);
//            switch($watertype)
//            {
//                case 1: //加水印字符串
//                    imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
//                    break;
//                case 2: //加水印图片
//                    $simage1 =imagecreatefromgif("xplore.gif");
//                    imagecopy($nimage,$simage1,0,0,0,0,85,15);
//                    imagedestroy($simage1);
//                    break;
//            }
//            switch ($iinfo[2])
//            {
//                case 1:
//                    //imagegif($nimage, $destination);
//                    imagejpeg($nimage, $destination);
//                    break;
//                case 2:
//                    imagejpeg($nimage, $destination);
//                    break;
//                case 3:
//                    imagepng($nimage, $destination);
//                    break;
//                case 6:
//                    imagewbmp($nimage, $destination);
//                    //imagejpeg($nimage, $destination);
//                    break;
//            }
//            //覆盖原上传文件
//            imagedestroy($nimage);
//            imagedestroy($simage);
//        }
        if($imgpreview==1)
        {
            echo "<br>";
            echo "<a href=\"".$destination."\" target='_blank'><img src=\"".$destination."\" width=600px"." \"height=300px";
//                ."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
//            echo " alt=\"Preview:\rFile Name:".$fname."\rUpload Time:".date('m/d/Y h:i')."\" border='0'></a>";
        }
    }
    ?>
</center>
</body>
</html>