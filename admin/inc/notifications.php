<?php
        //load top 5 unread notifications

        $nots = $db->prepare("SELECT * FROM notifications WHERE user_id = :me and status = :status ORDER BY date_added DESC LIMIT 10");
        $nots->execute(array(
            'me' => $_SESSION['cre-user'],
            'status' => 0
        ));

        while($nots_rs = $nots->fetch(PDO::FETCH_ASSOC)){
            ?>

            <li><a href="view_notifications.php?id=<?php echo $nots_rs['id']; ?>"> <span class="label label-success"><i
                                class="icon-plus"></i></span> <span class="message"><?php echo $nots_rs['title'];?></span> <span
                            class="time"><?php echo time_ago($nots_rs['date_added']);?></span> </a></li>
            <?php
        }

        $nots->closeCursor();
    ?>