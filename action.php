<?php
//这是一个信息增、删和改操作的处理页面

//1.导入配置文件
        require("dbconfig.php");
//2.连接MYSQL，并选择数据库
        $link=@mysql_connect(HOST,USER,PASS) or die("数据库连接失败！");
        mysql_select_db(DBNAME,$link);

//3.根据需要action值，来判断所属操作，执行对应的代码
    switch($_GET["action"])
    {
        case "add": //执行添加操作
            //1.获取要添加的信息，并补充其他信息
                $title = $_POST["title"];
                $keywords = $_POST["keywords"];
                $author = $_POST["author"];
                $content = $_POST["content"];
                $addtime = time();
            //2.座信息过滤（省略）
            //3.拼装添加SQL语句，并执行添加操作
                $sql = "insert into news values(null,'{$title}','{$keywords}','{$author}','{$addtime}','{$content}')";
                mysql_query($sql,$link);
            //4.判断是否成功
                $id=mysql_insert_id($link);//获取刚刚添加信息的自增id号值
                if($id>0)
                {
                    echo "<h3>文章信息添加成功！</h3>";
                }else
                {
                    echo "<h3>文章信息添加失败！</h3>";
                }
                echo "<a href='javascript:window.history.back();'>返回</a>&nbsp;&nbsp;";
                echo "<a href='index.php'>浏览文章</a>";
            break;
        case "del": //执行删除操作
                //1.获取要删除的id号
                $id=$_GET['id'];
                //2.拼装删除sql语句，并执行删除操作
                $sql = "delete from news where id={$id}";
                mysql_query($sql,$link);
                
                //3.自动跳转到浏览文章页面
                header("Location:index.php");
            break;
        case "update": //执行添加操作
            //1.获取要修改的信息
            $title = $_POST['title'];
            $keywords = $_POST['keywords'];
            $author = $_POST['author'];
            $content = $_POST['content'];
            $id = $_POST['id'];
            //2.过滤要修改的信息（省略）
            
            //3.拼装修改sql语句，并执行修改操作
            $sql = "update news set title='{$title}',keywords='{$keywords}',author='{$author}',content='{$content}' where id = {$id} ";
            
            mysql_query($sql,$link);
            //4.跳转回浏览界面
            header("Location:index.php");
            break;
    }
//4.关闭数据库连接
    mysql_close($link);
    


