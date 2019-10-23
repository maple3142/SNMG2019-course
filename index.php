<?php 

// 要使用 $_SESSION 都要先 session_start()
session_start();

// 資料庫位置帳密資料
include_once("conn.php");

function isLogin(){
    // isset() 如果有設置的話
    if(isset($_SESSION['login']) && $_SESSION['login'] == true)
        return true;
    return false;
}
?>

<!-- 告訴電腦這是html檔案 -->
<!DOCTYPE html>
<html>
    <head>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, viewport-fit=cover"
        />
        <!-- 告訴電腦要用utf-8編碼 -->
        <meta charset="UTF-8" />
        <!-- 網頁標題 -->
        <title>Message Board</title>

        <!-- css -->
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <section>
            <form action="login.php" method="post">
                <ul>
                    <li>
                        <p>2019_SNMG_COURSE_EP.2</p>
                    </li>
                    <?php if(!isLogin()){ ?>
                    <!-- Login -->
                    <li>
                        <input
                            type="text"
                            name="Name"
                            placeholder="Input Your Name"
                        />
                    </li>
                    <li>
                        <input
                            type="password"
                            name="Password"
                            placeholder="Password"
                        />
                    </li>
                    <li>
                        <button class="active">Login</button>
                    </li>
                    <?php }else{?>
                    <!-- Logout -->
                    <li>
                        <p id="user_name">Welcome!, <?php echo $_SESSION['username'];?></p>
                    </li>
                    <li>
                        <button class="active" name="Logout" value="Logout" >Logout</button>
                    </li>
                    <?php }?>
                </ul>
            </form>
        </section>

        <section>
            <div class="container">
                <!-- 標題 -->
                <h1>Message Board</h1>
            </div>
            <?php if(isLogin()) {?>
            <div class="container">
                <!-- 輸入欄 -->
                <input
                    id="input_bar"
                    type="text"
                    placeholder="Say something ヽ(✿ﾟ▽ﾟ)ノ"
                />

                <!-- 新增按鈕 -->
                <button id="submit_btn">Send</button>
            </div>
            <?php }?>
            <div class="container">
                <!-- 裡面拿來放輸入資料的table -->
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>yabasu</td>
                        <td>m1nN4_n0_N1H0ng0</td>
                        <td><button class="delete_btn">Delete</button></td>
                    </tr>
                    <?php foreach($db->query('SELECT * FROM messages') as $row){ ?>
                    <tr>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['content'];?></td>
                        <td><button class="delete_btn">Delete</button></td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </section>

        <!-- 引入 jquery library -->
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <script src="main.js"></script>
    </body>
</html>
