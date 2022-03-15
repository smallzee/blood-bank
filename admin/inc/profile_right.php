<?php $user_id = $_SESSION['cre-user']; ?>
<?php 
$id = $_SESSION['cre-user'];
  $sql = $db->prepare('SELECT * FROM users WHERE id = :id');
  $sql->execute(array('id' => $id));
  $rs = $sql->fetch(PDO::FETCH_ASSOC);

 ?>
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Contact Details (Optional)</h3>

<div class="box-tools pull-right">
&nbsp;           
</div>
</div>
<div class="box-body">
                
                <form action="" method="post" role="form">
                    
                    <div class="form-group">

                          <label>Country</label>
                          <select name="country" required="" class="form-control">
                            <option><?php echo $rs['country'];?></option>
                            <option>Swaziland</option>
                            <option>Namibia</option>
                            <option>South Africa</option>
                            <option>Botswana</option>
                            <option>Lesotho</option>
                            <option>Zimbabwe</option>
                            <option>Nigeria</option>
                        </select>
                    <div class="form-group">
                      <input type="submit" name="ok" class="btn btn-success" value="Update">
                    </div>
                </form>
                    
                
</div>

<div class="box-footer">
&nbsp;
</div>
</div>