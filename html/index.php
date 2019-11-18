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
			<nav>
				<div class="nav-title">
					<h1>2019_SNMG_COURSE_EP.2 (maple3142)</h1>
				</div>
				<div class="nav-items">
					<?php if (!get_sess('username')) { ?>
						<div>
							<input type="text" name="username" placeholder="Username" autocomplete="off" />
						</div>
						<div>
							<input type="password" name="password" placeholder="Password" autocomplete="off" />
						</div>
						<div>
							<button class="active">Login</button>
						</div>
					<?php } else { ?>
						<!-- Logout -->
						<div>
							<p id="user_name">Welcome!, <?php echo $_SESSION['username']; ?></p>
						</div>
						<div>
							<button class="active" name="Logout" value="Logout">Logout</button>
						</div>
					<?php } ?>
				</div>
			</nav>
		</form>
	</section>

	<section>
		<div class="container">
			<h2 class="title">Message Board</h2>
		</div>
		<?php if (get_sess('username')) { ?>
			<form class="container" id="input">
				<input id="input_bar" name="content" type="text" placeholder="Say something ヽ(✿ﾟ▽ﾟ)ノ" autocomplete="off" />
				<button id="submit_btn" type="submit">Send</button>
			</form>
		<?php } ?>
		<div class="container">
			<table class="comments">
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