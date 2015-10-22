<!DOCTYPE html>
<html xmlns:Content-Type="http://www.w3.org/1999/xhtml">
<head>
    <meta Content-Type:text/html; charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TUTO</title>
    <!-- Bootstrap
   <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <!--My own css style -->
    <!-- <link href="css/my-style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/baguettebox.min.css">
    <link rel="stylesheet" href="css/zzsc.css">
    <script src="js/baguettebox.min.js"></script><!--放大预览效果-->
    <link rel="stylesheet" href="css/searchStyle.css"/><!--搜索框-->

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
    <link href="css/mypage.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.smint.js"></script>
    <!--<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>-->
    <?php
    /*//覆盖式写入文件
    $filename = 'tuto.txt';
    $data = ',加油';
    file_put_contents($filename, $data);
    $file_handle = fopen("tuto.txt","r");
    //采用“fopen”函数打开文件，得到返回值的就是资源类型。
    if ($file_handle){
        //接着采用while循环（后面语言结构语句中的循环结构会详细介绍）一行行地读取文件，然后输出每行的文字
        while (!feof($file_handle)) { //判断是否到最后一行
            $line = fgets($file_handle); //读取一行文本
            echo $line; //输出一行文本
            echo "<br />"; //换行
        }
    }
    fclose($file_handle);//关闭文件*/
    $host = 'qdm130083469.my3w.com';
    $user = 'qdm130083469';
    $pass = 'szb123456';
    mysql_connect($host, $user, $pass)or die("数据库未连接");
    mysql_select_db('qdm130083469_db');
    mysql_query("set names 'utf8'");
    $i=1;//初始化变量
    while($i<60){
        mysql_query("insert into img(id, img_path) values('$i', 'img/nba_img/$i.jpg')");
        $i++;
    }
    ?>
</head>
<body>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h3 id="myModalLabel" style="text-align: center; font-size: 30px;">
                    Register File
                </h3>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">UserName</span>
                    <input type="text" name="username" class="form-control" placeholder="username">
                </div><br>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">PassWord</span>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div><br>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">&nbsp;&nbsp;&nbsp;@mail&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="email" name="mail" class="form-control" placeholder="e-mail">
                </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <form action="index.php" method="POST" class="btn">
                    <input type="submit" value="submit" class="btn btn-primary" style="width: 100px">
                    <?php
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $mail = $_POST['mail'];
                    ?>
                </form>
                <form action="index.php" method="POST"  class="btn">
                    <input type="reset" value="change" class="btn btn-primary" style="width: 100px">
                </form>
                <form action="index.php" method="POST" class="btn" data-dismiss="modal" >
                    <input type="button" value="close" class="btn btn-primary" style="width: 100px">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="subMenu" >
    <div class="navbar navbar-default navbar-fixed-top" role="navigation"
         style="-moz-box-shadow: 0px 5px 10px #909090; -webkit-box-shadow: 0px 5px 10px #909090;
				box-shadow:0px 5px 10px #909090;">
        <div class="container">
            <div class="nav navbar-nav" >
                <a class="navbar-btn" href="#"><img src="img/Carousel-256.png" style="width: 50px; height: 50px;"></a>
                <a class="navbar-brand" href="#" id="mytuto" style="font-size: 25px;">TUTO</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav nav-pills navbar-left" style="font-size: 22px;">
                    <li><a href=""  id="myhome">Home</a></li>
                    <li><a href="" id="myabout">About</a></li>
                    <li class="dropdown">
                        <a href="" id="mygallery" class="dropdown-toggle" data-toggle="dropdown">Gallery <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Charactor Figure</a></li>
                            <li><a href="#">Scenry Landing</a></li>
                            <li><a href="#">Art Designing</a></li>
                            <!--<li class="divider"></li>-->
                        </ul>
                    </li>
                    <li><a href="" id="myshare">Share</a></li>
                </ul>
                <ul class="nav nav-pills navbar-right" style="font-size: 19px;">

                    <li data-toggle="modal" data-target="#myModal"><a href="#">Login</a></li>
                    <li data-toggle="modal" data-target="#myModal"><a href="#">Register</a></li>
                    <!--<li><a href="../navbar-static-top/">Static top</a></li>-->
                    <li><a href="#"> More >></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--展示图片欢迎页-->
<div class="section mytuto" style="width: auto; height: 705px;">
    <div id="myCarousel" class="carousel slide" style="width:auto; height:300px; top: 50px;
            -moz-box-shadow: 0px 5px 10px #909090;-webkit-box-shadow: 0px 5px 10px #909090;
            box-shadow:0px 5px 10px #909090;">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style=" width:auto; height:300px;">
            <div class="item active" style="top: -300px;"><img src="img/60.jpg"></div>
            <div class="item" style="top: -100px;"><img src="img/61.jpg"></div>
            <div class="item" style="top: -100px;"><img src="img/62.jpg"></div>
        </div>
        <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
    </div>
    <div style="width: auto; height: 425px; top: 68px; text-align: center; background: #ffffff">
        <?php
//            $sql = "select img_path from img ";
//            $result = mysql_query($sql);
//            $data = array();
//            while($row = mysql_fetch_array($result)) {
//                $data[] = $row;
//                //print_r($data);
//            }
//            function tourl($data) {
//                $data = preg_replace('/[^a-zA-Z0-9]+/', '-', $data);
//                $data = trim($data, '-');
//                return strtolower($data);
//            }
//            $img = array();
//            for($count = 1; $count <= 6; $count++){
//                $img[$count] = rand(0,58);
//            }
//            $count = 1;
//            while($count <= 6){
//                echo '<a href="'.$data[$img[$count]][0].'"><img src="'.$data[$img[$count]][0].'"
//                style="padding: 8px; margin: 60px 25px -40px 25px; height:150px; width:280px; -moz-box-shadow: 0px 5px 10px #909090;
//                -webkit-box-shadow: 0px 5px 10px #909090; box-shadow:0px 5px 10px #909090;"/></a>';
//                $count++;
//            }
        ?>
    </div>
    <!--<script>
        baguetteBox.run('.baguetteBoxOne', {animation: 'fadeIn',});
    </script>-->
</div>

<div class="section myhome" style="height: 300px; -webkit-box-shadow: 0px -5px 10px #909090;
    box-shadow:0px -5px 10px #909090;">
    <a name="id_pic"><h1><hr style="top: -10px;"></h1></a>
    <div class="inner">
        <div class="flexsearch">
            <div class="flexsearch--wrapper">
                <form class="flexsearch--form" action="index.php#id_pic" method="POST">
                    <div class="flexsearch--input-wrapper">
                        <input class="flexsearch--input" type="search" placeholder="search" name="id_pic">
                        <input class="flexsearch--submit" type="submit" value="&#10140;" name="search">
                        <?php
                            $id_pic_pick = $_POST['id_pic'];
                        ?>
                        <h1><hr></h1>
                    </div>
                </form>
            </div>
        </div>
        <div style="width: auto; height: 400px; text-align: center;">
            <?php
                $pic = 1;
                if($id_pic_pick == 0) {
                    $pic = rand(1,59);
                }
                else {
                    $pic = $id_pic_pick;
                }
                $sql = "select img_path from img where id = $pic";
                $result = mysql_query($sql);
                $data = array();
                while($row = mysql_fetch_array($result)) {
                    $data[] = $row;
//                    print_r($data);
                }
                function tourl($data) {
                    $data = preg_replace('/[^a-zA-Z0-9]+/', '-', $data);
                    $data = trim($data, '-');
                    return strtolower($data);
                }
//            $img = array();
//            for($count = 1; $count <= 9; $count++){
//                $img[$count] = rand(0,58);
//            }
//            $count = 1;
//            while($count <= 9){
                echo '<img src="'.$data[0][0].'"style="padding: 8px; margin: 48px 20px -35px 20px;
                 height:290px; width:500px; -moz-box-shadow: 0px 5px 10px #909090;
                -webkit-box-shadow: 0px 5px 10px #909090; box-shadow:0px 5px 10px #909090;"/>';
//                $count++;
//            }
            ?>
        </div>
    </div>
</div>
<div class="section myabout" style="height: 300px;">
    <div class="inner">
        <div class="jumbotron">
<!--            <h1>myabout</h1>-->
            <?php
                include_once("upload.php");
            ?>
        </div>
    </div>
</div>
<div class="section mygallery" style="height: 300px;">
    <div class="inner">
        <div class="jumbotron">
<!--            <h1>mygallery</h1>-->
            <?php
                include_once("test_snoopy.php");
            ?>
        </div>
    </div>
</div>
<div class="section myshare" style="height: 480px;">
    <div class="inner">
        <div class="jumbotron">
<!--            <h1>myshare</h1>-->
        </div>
    </div>
</div>
<div style="font-size: 20px; text-align: center; margin: 5px auto;">
    <hr/>
    <p>
        <a href="http://"><img src="img/Chrome.ico" style="height: 60px; width: 60px; margin: 6px"></a>
        <a href="#"><img src="img/Dropbox.ico" style="height: 60px; width: 60px; margin: 6px"></a>
        <a href="#"><img src="img/Skype.ico" style="height: 60px; width: 60px; margin: 6px"></a>
    </p>
    <p style="font-family: 'Helvetica', sans-serif">Copyright &copy; 2015.Company name All rights reserved.</br></br>
        This page designed by.mjude.</p>
</div>

<!--js===================================================================-->
<script type="text/javascript">
    $(document).ready( function() {
        $('.subMenu').smint({
            'scrollSpeed' : 1000
        });
    });
</script>
<!-- 如果要使用Bootstrap的js插件，必须先调入jQuery
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script> -->
<!-- 包括所有bootstrap的js插件或者可以根据需要使用的js插件调用　
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
</body>
</html>