<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 5/14/2019
 * Time: 8:11 PM
 */

?>

<div class="card">
    <div class="card-content">
        <div class="card-header bg-primary">
            Latest Withdrawals
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = $db->query("SELECT withdrawals.id,withdrawals.user_id, withdrawals.amount, withdrawals.date_added, withdrawals.status, users.username FROM withdrawals INNER JOIN users ON withdrawals.user_id = users.id WHERE withdrawals.status = '1' ORDER BY withdrawals.id DESC LIMIT 5");
                    $n = 0;

                    while ($sql_rs = $sql->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr>
                            <td><?php echo ++$n;?></td>
                            <td><?php echo $sql_rs['username'];?></td>
                            <td><?php echo amount_format($sql_rs['amount']);?></td>
                            <td><?php echo date("F d Y, h:i a",$sql_rs['date_added']);?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
