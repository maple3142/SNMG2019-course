<?php
session_start();
include_once("conn.php");

function get_sess($k, $v = NULL)
{
	return isset($_SESSION[$k]) ? $_SESSION[$k] : $v;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
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
				<?php if (!get_sess('username')) { ?>
					<li>
						<input type="text" name="username" placeholder="Input Your username" />
					</li>
					<li>
						<input type="password" name="password" placeholder="password" />
					</li>
					<li>
						<button class="active">Login</button>
					</li>
				<?php } else { ?>
					<!-- Logout -->
					<li>
						<p id="user_name">Welcome!, <?php echo $_SESSION['username']; ?></p>
					</li>
					<li>
						<button class="active" name="Logout" value="Logout">Logout</button>
					</li>
				<?php } ?>
			</ul>
		</form>
	</section>

	<section>
		<div class="container">
			<!-- 標題 -->
			<h1>Message Board</h1>
		</div>
		<?php if (get_sess('username')) { ?>
			<form class="container" id="input">
				<!-- 輸入欄 -->
				<input id="input_bar" name="content" type="text" placeholder="Say something ヽ(✿ﾟ▽ﾟ)ノ" />

				<!-- 新增按鈕 -->
				<button id="submit_btn" type="submit">Send</button>
			</form>
		<?php } ?>
		<div class="container">
			<!-- 裡面拿來放輸入資料的table -->
			<table>
				<thead>
					<tr>
						<th>Sender</th>
						<th>Comment</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="list"></tbody>
			</table>
		</div>
	</section>
	<script>
		window.params = <?php
						echo json_encode([
							'username' => get_sess('username'),
							'user_id' => get_sess('user_id')
						]); ?>
	</script>
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script src="main.js"></script>
</body>

</html>