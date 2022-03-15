<?php $user_id = $_SESSION['cre-user']; ?>
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Profile Fields</h3>

<div class="box-tools pull-right">
&nbsp;           
</div>
</div>
<div class="box-body">
<h4 class="text-red" id="profile-email-heading"><?php if(user_details($user_id,"status") == 0){ echo "You must verify your email address.";}else{echo "Email Verfied!";} ?></h4>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" id="profile-email" placeholder="email" value="<?php echo user_details($_SESSION['cre-user'],"email"); ?>" disabled="disabled">
                        <span class="input-group-addon" id="profile-email-label">
                            <?php if(user_details($_SESSION["user"],"status") == 0){
                            	echo "Unverified Email";
                            	}else{
                            		echo "Verfied Email";
                            	}
                             ?>
                        </span>
                        <span class="input-group-btn hide" id="save-profile-email-btn-span">
                            <button id="save-profile-email-btn" class="btn btn-info btn-flat" type="button" ><i class="fa fa-save"></i> Save</button>
                        </span>
                        <span class="input-group-addon hide" id="profile-email-spinner" >
                            <i class="fa fa-refresh fa-spin"></i>
                        </span>
                    </div>
                
                
            
                <?php if(user_details($_SESSION["user"],"status") == 0){?>
                    <br/>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button id="change-email" class="btn btn-warning btn-flat" type="button">Change Email</button>
                        </span>
                        <span class="input-group-btn">
                            <button id="verify-email" class="btn btn-info btn-flat" type="button">Verify Email</button>
                        </span>
                    </div>
                
                    <br/>
                <?php } ?>
                    
                        
                        
                    <h4 class="text-red" id="update-phone-number-heading"><?php if(user_details($_SESSION["user"],"phone") == ""){echo 'You must provide a phone number.';}else{echo "Edit and update your phone number!";}?></h4>                
                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                        <input type="text" id="phone-text-area" class="form-control" placeholder="Enter your phone number" disabled value="<?php echo user_details($_SESSION["user"],"phone"); ?>">
                        <span class="input-group-btn">
                        
                            <button id="change-phone-number-btn" class="btn btn-info btn-flat" type="button"><i class="fa fa-save"></i> Save</button>

                            <button id="edit-phone-number-btn" class="btn btn-warning btn-flat" type="button"><i class="fa fa-pencil"></i> Edit</button>
                        
                        </span>
                    </div>
                    <br/>
            
                
                    <?php
//                        $acc = $db->prepare("SELECT * FROM account_info WHERE user_id = :me");
//                        $acc->execute(array('me' => $_SESSION['cre-user']));
//
//                        $acc_count = $acc->rowCount();

                        
                    ?>
                    <h4 class="text-red" id="acct-details-heading">
                        Account Details
                    </h4>
                
                <form action="" method="post" role="form">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-university"></i></span>
                        <input type="text" required="" class="form-control" name="bank_name" id='field-bank-name' value="<?php echo log_user('bank_name'); ?>" placeholder="Bank Name">
                    </div>
                    <br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                        <input name="account_number" required="" type="text" class="form-control" id='field-bank-acct-number' value="<?php echo log_user('account_no'); ?>" placeholder="Account Number" >
                    </div>
                    <br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                        <input type="text" class="form-control" required="" id='field-bank-acct-name' value="<?php echo log_user('account_name'); ?>" placeholder="Account Name" name="account_name">
                    </div>
                    <br/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <select class="form-control" required="" id="select-bank-acct-type"  name="account_type">
                    
                        
                            <option value="<?php echo log_user('account_type'); ?>" selected><?php echo log_user('account_type'); ?></option>
                            <option value="Savings">Savings</option>
                            <option value="Current">Current</option>
                            <option value="Cheque">Cheque</option>
                        
                        
                        
                    
                        </select>
                    </div>
                
                    <br/>

                    <div class="form-group">
                        <input type="submit" name="ok-acc" class="btn btn-sm btn-primary" value="Update">
                    </div>

                </form>
                     <br/>


    <form action="" method="post">
        <h4 class="text-green" id="bitcoin-wallet-heading">Your Bitcoin wallet.</h4>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-bitcoin"></i></span>
            <input type="text" class="form-control" id='bitcoin-wallet-number' value="<?php echo log_user("bitcoin");?>" placeholder="Bitcoin Wallet Number" disabled="disabled">
        </div>
        <br/>
        <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-flat" id="edit-bitcoin-number" type="button"><i class="fa fa-edit"></i> Edit</button>
                        </span>
            <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" id="save-bitcoin-number" type="button" disabled="disabled"><i class="fa fa-save"></i> Save</button>
                        </span>
        </div>
    </form>
                
</div>

<div class="box-footer">
&nbsp;
</div>
</div>