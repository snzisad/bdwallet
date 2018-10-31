<?php $__env->startSection('title', "Wallet"); ?>

<?php $__env->startSection('content'); ?>

<div class="container">

    <div class="row order_confirm_panel" style="display: all;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <div class="panel-heading">Welcome to your Wallet</div>

                    <div class="panel-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-balance-tab" data-toggle="tab" href="#nav-balance" role="tab" aria-controls="nav-balance" aria-selected="true"><i class="fa fa-money"></i> Balance</a>
                                <a class="nav-item nav-link" id="nav-exchange-tab" data-toggle="tab" href="#nav-exchange" role="tab" aria-controls="nav-exchange" aria-selected="true"><i class="fa fa-refresh"></i> Exchange</a>
                                <a class="nav-item nav-link" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit" role="tab" aria-controls="nav-deposit" aria-selected="false"><i class="fa fa-arrow-circle-down"></i> Deposit</a>
                                <a class="nav-item nav-link" id="nav-withdraw-tab" data-toggle="tab" href="#nav-withdraw" role="tab" aria-controls="nav-withdraw" aria-selected="false"><i class="fa fa-arrow-circle-up"></i> Withdraw</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent" style="margin-top: 20px;">

                            <div class="exchange_money_info" action="<?php echo e(route('getexchangeinfo')); ?>"></div>
                            <div class="withdraw_money_link" action="<?php echo e(route('getwalletinfo')); ?>"></div>
                            <div class="wallet_balance_link" action="<?php echo e(route('getwalletbalance')); ?>"></div>
                            <div class="csrf_exchange_info" data-token='<?php echo e(csrf_token()); ?>'></div>
                            
                            <!-- Balance Tab -->
                            <div class="tab-pane fade show active" id="nav-balance" role="tabpanel" aria-labelledby="nav-balance-tab">

                                <div class="form-group">
                                    <label>Wallet</label>
                                    <select class="form-control form-control-lg my_wallet">
                                        <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Balance</label>
                                    <input type="text" class="form-control my_wallet_balance"  value="0" readonly/>
                                </div>
                            </div>
                            
                            <!-- Exchange tab -->
                            <div class="tab-pane fade" id="nav-exchange" role="tabpanel" aria-labelledby="nav-exchange-tab">
                                <form class="col-md-10" method="post" action="<?php echo e(route('walletexchange')); ?>">
                                    <?php echo e(csrf_field()); ?>


                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>" />

                                    <div class="form-group">
                                        <label>From Wallet</label>
                                        <select class="form-control form-control-lg from_id" id="from_wallet_id" name="from_id">
                                            <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>To Wallet</label>
                                        <select class="form-control form-control-lg to_id" id="to_wallet_id" name="to_id">
                                           <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control send_amount" id="send_amount" name="send_amount"  required autofocus value="1"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Wll receive</label>
                                        <input type="number" class="form-control receive_amount" id="receive_amount" name="receive_amount" value="0.99" readonly/>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Rate: 
                                            <span class="exchange_rate_from">1</span> 
                                            <span class="exchange_rate_from_type"><?php echo e($all_gateway[0]["currency"]["type"]); ?></span> = 
                                            <span class="exchange_rate_to"> 0.90</span> 
                                            <span class="exchange_rate_to_type"><?php echo e($all_gateway[0]["currency"]["type"]); ?></span></label>
                                        <input type="hidden" class="exchange_rate" name="rate" value="1 <?php echo e($all_gateway[0]['currency']['type']); ?> = 0.90 <?php echo e($all_gateway[0]['currency']['type']); ?>">
                                    </div>
                                    
                                    <input type="submit" class="btn btn-success" value="Exchange"/>
                                </form>
                            </div>

                            <!-- Deposit Tab -->
                            <div class="tab-pane fade" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
                                <form class="col-md-10" method="post" action="<?php echo e(route('walletdeposit')); ?>">
                                    <?php echo e(csrf_field()); ?>


                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>" />

                                    <div class="form-group">
                                        <label>Deposit via</label>
                                        <select class="form-control form-control-lg wallet_id" id="wallet_id" gateway="<?php echo e($all_gateway); ?>" name="wallet_id">
                                            <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" name="amount"  required autofocus/>
                                    </div>

                                    <div class="instruction text-light bg-info"> <i class="fa fa-info-circle"></i> Please send your amount to our following merchant account. Enter the transaction number/ batch in the box to confirm your deposit.</div>

                                    <div class="form-group">
                                        <label class="marchant_account_name">Our Merchant Account</label>
                                        <input type="text" class="form-control marchant_account" id="marchant_account" value="<?php echo e($all_gateway[0]->account); ?>" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label>Transaction ID/Batch</label>
                                        <input type="text" class="form-control" name="transaction_id" required autofocus/>
                                    </div>

                                    <input type="submit" class="btn btn-success" value="Add Deposit"/>
                                </form>
                            </div>

                            <!-- Withdraw Tab -->
                            <div class="tab-pane fade" id="nav-withdraw" role="tabpanel" aria-labelledby="nav-withdraw-tab">
                                <div class="bg-danger text-light text-center error_panel" style="padding: 5px; font-size: 16px; margin-bottom: 10px; display: none;">
                                    <i class="fa fa-close"></i> <span class="error_panel_message"></span>
                                </div>
                                <form class="col-md-10" method="post" action="<?php echo e(route('walletwithdraw')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    
                                    <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>" class="user_id"/>

                                    <div class="form-group">
                                        <label>From Wallet</label>
                                        <select class="form-control form-control-lg from_wallet_id" id="from_id" name="from_id">
                                            <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>To</label>
                                        <select class="form-control form-control-lg to_wallet_id" id="to_id" name="to_id">
                                            <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Rate: 
                                            <span class="wallet_exchange_rate_from">1</span> 
                                            <span class="wallet_exchange_rate_from_type"><?php echo e($all_gateway[0]['currency']['type']); ?></span> = 
                                            <span class="wallet_exchange_rate_to"> 0.99</span> 
                                            <span class="wallet_exchange_rate_to_type"><?php echo e($all_gateway[0]['currency']['type']); ?></span></label>
                                        <input type="hidden" class="wallet_exchange_rate" name="rate" value="1 <?php echo e($all_gateway[0]['currency']['type']); ?> = 0.90 <?php echo e($all_gateway[0]['currency']['type']); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control amount_send" id="send_amount"  name="send_amount" value="1"  required autofocus/>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Balance: <span class="wallet_balance"><?php echo e($all_gateway[0]->reserve); ?></span> <span class="wallet_balance_type"><?php echo e($all_gateway[0]->currency['type']); ?></span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Wll receive</label>
                                        <input type="text" class="form-control amount_receive" id="receive_amount" name="receive_amount" value="0.90" readonly/>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold text-center" style="font-size: 15px;">Reserve: <span class="gateway_reserve_amount"><?php echo e($all_gateway[0]->reserve); ?></span> <span class="gateway_reserve_amount_type"><?php echo e($all_gateway[0]->currency['type']); ?></span></label>
                                    </div>

                                    <div class="form-group">
                                        <label class="withdraw_account">Your Account</label>
                                        <input type="text" class="form-control" name="account" required autofocus/>
                                    </div>

                                    <input type="submit" class="btn btn-success btn_withdraw_money" value="Send Request"/>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.generalLayout", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>