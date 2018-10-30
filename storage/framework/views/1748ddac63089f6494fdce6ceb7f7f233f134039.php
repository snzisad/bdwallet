<?php $__env->startSection('title', "BD Wallet"); ?>

<?php $__env->startSection('content'); ?>

    <!-- Breaking News -->
    <div class="d-flex text-light"  style="font-size: 18px; margin-left: 15px;">
        <div class="bg-success p-2" style="padding: 8px;">News:</div>
        <marquee class="bg-primary mr-auto" style="padding: 8px;"> <?php echo e($news->text); ?></marquee>
    </div>

    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Exchange Money</div>

                    <div class="panel-body">
                        <div class="bg-danger text-light text-center error_panel" style="padding: 5px; font-size: 16px; margin-bottom: 10px; display: none;">
                            <i class="fa fa-close"></i> <span class="error_panel_message"></span>
                        </div>
                        <form class="exchange-money text-center " method="POST" action="<?php echo e(route('sendexchangerequest')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <div class="exchange_money_info" action="<?php echo e(route('getexchangeinfo')); ?>"></div>
                            <div class="csrf_exchange_info" data-token='<?php echo e(csrf_token()); ?>'></div>

                            <input type="hidden" class="minimum_transfer">

                            <div class="row">
                                <div class="col-md-2" style="margin-bottom: auto;margin-top: auto;">
                                    <img class="from_image" src = "<?php echo e(asset('/picture/icon/'.$all_gateway[0]->icon)); ?>" />
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 22px;"><i class="fa fa-arrow-circle-o-up text-primary"></i> From</label>
                                        <select class="form-control form-control-lg from_id" id="from_id" name="from_id">
                                            <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="send_amount" id="send_amount" class="form-control send_amount" required placeholder="Enter Sending Amount" value="1" />
                                    </div>
                                    <label class="font-weight-bold text-center" style="font-size: 15px;">Rate: 
                                        <span class="exchange_rate_from">1</span> 
                                        <span class="exchange_rate_from_type"><?php echo e($all_gateway[0]["currency"]["type"]); ?></span> = 
                                        <span class="exchange_rate_to"> 0.90</span> 
                                        <span class="exchange_rate_to_type"><?php echo e($all_gateway[0]["currency"]["type"]); ?></span>
                                    </label>
                                    <input type="hidden" class="exchange_rate" name="rate" value="1 <?php echo e($all_gateway[0]['currency']['type']); ?> = 0.90 <?php echo e($all_gateway[0]['currency']['type']); ?>">
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 22px;"><i class="fa fa-arrow-circle-o-down text-primary"></i> To</label>

                                        <select class="form-control form-control-lg to_id" id="to_id" name="to_id">
                                            <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($gateway->id); ?>"><?php echo e($gateway->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="receive_amount" class="form-control receive_amount" id="receive_amount" placeholder="Received Amount" value="0.90" readonly/>
                                    </div>
                                    <label class="font-weight-bold text-center" style="font-size: 15px;">Reserve: <span class="reserve_amount"><?php echo e($all_gateway[0]->reserve); ?></span> <span class="reserve_amount_type"><?php echo e($all_gateway[0]->currency['type']); ?></span></label>
                                </div>

                                <div class="col-md-2" style="margin-bottom: auto;margin-top: auto;">
                                    <img class="to_image"  src = "<?php echo e(asset('/picture/icon/'.$all_gateway[0]->icon)); ?>" />
                                </div>
                            </div>

                            <div class="text-center">
                                <Button type="submit" class="btn btn-success text-center btn-lg btn_exchange_money" style="width: 180px; margin-top: 20px;"> 
                                    <i class="fa fa-exchange"></i> Exchange
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Reviews</div>

                    <div class="panel-body">
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="testimonials">
                                <h5 class="author"> <?php echo e($review->user->name); ?></h5>
                                <?php if($review->status == "positive"): ?>
                                    <span class="status text-light bg-success"><i class="fa fa-smile-o"></i> Positive</span>
                                <?php else: ?>
                                    <span class="status text-light bg-danger"><i class="fa fa-frown-o"></i> Negative</span>
                                <?php endif; ?>
                                <p class="text"> <?php echo e($review->comment); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="text-right"><a href="<?php echo e(asset('reviews')); ?>" class="btn btn-primary btn-sm">See All Reviews <i class="fa fa-arrow-right"></i></a></div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Exchange History</div>

                    <div class="panel-body">
                        <table class="table exchange_history">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col">From</th>
                              <th scope="col">To</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $exchange_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td><img src="<?php echo e(asset('/picture/icon/'.$history->send_from_data['icon'])); ?>"> <?php echo e($history->send_from_data['name']); ?></td>
                                  <td><img src="<?php echo e(asset('/picture/icon/'.$history->send_to_data['icon'])); ?>"> <?php echo e($history->send_to_data['name']); ?></td>
                                  <td><?php echo e($history->send_amount); ?> <?php echo e($history->send_from_data['currency']['type']); ?></td>
                                  <td>
                                    <?php if($history->status == "Processing"): ?>
                                      <span class="status text-light bg-primary"><i class="fa fa-clock-o"></i> Processing</span>
                                     <?php elseif($history->status == "Accepted"): ?>
                                      <span class="status text-light bg-success"><i class="fa fa-check"></i> Success</span>
                                     <?php else: ?>
                                      <span class="status text-light bg-danger"><i class="fa fa-close"></i> Failed</span>
                                     <?php endif; ?>
                                  </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Notice: <font color="#000" size="3px" style="font-weight: normal"><?php echo e($notice->text); ?></font></div>

                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Track Exchange</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="<?php echo e(route('track')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="exchange_id" placeholder="Enter Exchange ID" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="submit" class="btn btn-success btn-block text-bold">
                                        Track
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Gateway & Reserve</div>

                    <div class="panel-body">
                        <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reserve d-flex">
                            <img class="p-2" src="<?php echo e(asset('picture/icon/'.$gateway->icon)); ?>">
                            <div class="mr-auto">
                                <h5><?php echo e($gateway->name); ?></h5>
                                <span><?php echo e($gateway->reserve); ?> <?php echo e($gateway->currency->type); ?></span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.generalLayout", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>