<?php
	session_start();
?>

<html>

<head>
	<title>Gwitter</title>

	<style>
		.center_vertically {
			padding: 25px;
			display: flex;
			flex-direction: column;
			justify-content: flex-start;
		}

		form {
			width: 100%;
		}

		.newgweet {
			padding: 20px;
			display: flex;
			flex-direction: column;
		}

		textarea {
			display: block;
			width: 100%;
			height: 150px;
			padding: 10px 12px;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius: 4px;
			background-color: #f8f8f8;
			font-size: 16px;
			resize: none;
		}
	</style>
</head>

<body style="padding:50px; height: 100%">

	<h1>Gwitter!</h1>
	<a href="logout.php">Logout</a>

	<div id="mainview" style="display:flex;">
		<div id="gweets" style=" flex-grow: 1">

			<div class="newgweet">
				<form method="POST" style="   align-self: end">
					<textarea name="gweet"></textarea>
					Send Gweet:
					<input type="submit" style="width:60px; border-radius:5px; margin: 10px; padding: 5px 10px;" value="Send"></button>
				</form>
			</div>

			<?php
			    if (isset($_POST["gweet"])) {
				$tim = time();
				$usr = $_SESSION["username"];
				$pst = $_POST["gweet"];

				$stmt = "INSERT INTO Gweets(username, gweet, time, isreply) VALUES('$usr', '$pst', '$tim', 0)";

				$database = new SQLite3("./gwitter.db");
				$something = $database->exec($stmt);
				if ($something) {
				} else {
					echo "Something went wrong!";
				}
				$database->close();
			}
			?>


			<?php
			$stmt = "SELECT * FROM Gweets WHERE isreply=0; ORDER BY time DESC";
			$db = new SQLite3("./gwitter.db");
			$results = $db->query($stmt);


			if ($results) {
				while ($row = $results->fetchArray()) {
			?>

					<div class="center_vertically">
						<div class="center_vertically">
							<h2><?php echo $row[0] ?></h2>
							<div style="margin-left:20px;">
								<p>
									<?php echo $row[2] ?>
								</p>
								<?php echo gmdate("D M-d Y H:i:s:Z", $row[3]) ?> <a href="gweets.php?replies=<?php echo $row[1] ?>" style="display:inline; width:60px; border:0px; text-decoration:underline; background:transparent; margin: 10px; padding: 2px 5px;" name="id" onclick="console.log(`lmao`)">replies</a>
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>

		</div>

		<div id="replies" style=" flex-grow: 1">
			<?php
			if (isset($_GET["replies"])) {
				$id = $_GET["replies"];
				$stmt = "SELECT * FROM Reply WHERE parent_id='$id'";
				$db = new SQLite3("./gwitter.db");
				$results = $db->query($stmt);

				if ($results) {
					while ($row = $results->fetchArray()) {
						$pid = $row[0];
						$cid = $row[1];

						$stmt_child = "SELECT * FROM Gweets WHERE id=$cid; ORDER BY time DESC";
						$resultsc = $db->query($stmt_child);

						if ($resultsc) {
							while ($rowc = $resultsc->fetchArray()) {
			?>
								<div class="center_vertically">
									<div class="center_vertically">
										<h2><?php echo $rowc[0] ?> replied</h2>
										<div style="margin-left:20px;">
											<p>
												<?php echo $rowc[2] ?>
											</p>
											<?php echo gmdate("D M-d Y H:i:s:Z", $rowc[3]) ?>
										</div>
									</div>
								</div>

				<?php
							}
						}
					}
				} else {
					echo "Something went wrong";
				}
				?>
				<div class="newgweet">
					<form method="POST" style="align-self: end">
						<textarea name="reply"></textarea>
						Send Reply:
						<input type="submit" style="width:60px; border-radius:5px; margin: 10px; padding: 5px 10px;" value="Send"></button>
					</form>
				</div>
				<?php
				if (isset($_POST["reply"])) {
					$tim = time();
					$usr = $_SESSION["username"];
					$pst = $_POST["reply"];
					$parentid = $_GET["replies"];

					$stmt = "INSERT INTO Gweets(username, gweet, time, isreply) VALUES('$usr', '$pst', '$tim', 1)";

					$something = $db->exec($stmt);
					if ($something) {
					} else {
						echo "Something went wrong2!";
					}

					$gwtid = $db->lastInsertRowID();
					$stmt2 = "INSERT INTO Reply(parent_id, reply_id) VALUES('$parentid', '$gwtid')";
					$something = $db->exec($stmt2);
					if ($something) {
				?>
						Reply Sent!
						<div class="center_vertically">
							<div class="center_vertically">
								<h2><?php echo $usr ?> replied</h2>
								<div style="margin-left:20px;">
									<p>
										<?php echo $pst ?>
									</p>
									<?php echo gmdate("D M-d Y H:i:s:Z", $tim) ?>
								</div>
							</div>
						</div>
			<?php
					} else {
						echo "Something went wrong3!";
					}
				}
			}
			?>

		</div>
	</div>

</body>

</html>
