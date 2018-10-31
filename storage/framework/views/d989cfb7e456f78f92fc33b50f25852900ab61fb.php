<?php $__env->startSection('title', "Exchange Request"); ?>

<?php $__env->startSection('content'); ?>
	
	<div class="container">

        <div class="panel">
            <div class="panel_title">
                Exchange Requests
            </div>
            <div class="panel_content">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Send</th>
                      <th scope="col">Receive</th>
                      <th scope="col">Rate</th>
                      <th scope="col">Transaction Number</th>
                      <th scope="col">User Account</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                              <td style="text-align: center;"> 
                                <?php echo e($request->send_from_data['name']); ?>

                              </td>
                              <td  style="text-align: center;">
                                <?php echo e($request->send_to_data['name']); ?>

                              </td>
                              <td style="text-align: center;"> 
                                <?php echo e($request->send_amount); ?> <?php echo e($request->send_from_data['currency']['type']); ?>

                              </td>
                              <td  style="text-align: center;">
                                <?php echo e($request->receive_amount); ?> <?php echo e($request->send_to_data['currency']['type']); ?>

                              </td>
                              <td style="text-align: center;"> 
                                <?php echo e($request->rate); ?>

                              </td>
                              <td  style="text-align: center;">
                                <?php echo e($request->transaction_number); ?>

                              </td>
                              <td style="text-align: center;"> 
                                <?php echo e($request->user_account); ?>

                              </td>
                              <td style="text-align: center;"> 
                                <?php echo e($request->user_phone); ?>

                              </td>
                              <td  style="text-align: center;">
                                <a href="<?php echo e(asset('/adminpanel/acceptorder/'.$request->exchange_id)); ?>" class="btn btn-primary btn-sm">Accept</a>
                                <a href="<?php echo e(asset('/adminpanel/rejectorder/'.$request->exchange_id)); ?>" class="btn btn-danger btn-sm">Reject</a>
                              </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.adminPanelLayout", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>