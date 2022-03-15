<ul class="dropdown-menu">
	<li>
		<div class="notification_header">
			<h3>You have <?php echo $messages_count; ?> new messages</h3>
		</div>
	</li>	
	<?php
		$sql = $db->prepare('SELECT * FROM message WHERE user_id = :user AND status = :status ORDER BY id DESC');
		$sql->execute(array('user' => $_SESSION['cre-user'], 'status' => 0));

		while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
			?>
			<li><a href="inbox.php?id=<?php echo $rs['id'];?>" target="_blank">				
				<div class="notification_desc">
					<p><?php echo $rs['subject'];?></p>
					<p><span><?php echo time_ago($rs['date_added']);?></span></p>
					</div>
				<div class="clearfix"></div>	
				</a></li>
			<?php
		}

	?>
	<li>
		<div class="notification_bottom">
			<a href="messages.php">See all messages</a>
		</div> 
	</li>
</ul>