

<?php $__env->startSection('page-title', trans('app.withdraw')); ?>
<?php $__env->startSection('page-heading', trans('app.withdraw')); ?>

<?php $__env->startSection('content'); ?>

	<section class="content-header">
		<?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo app('translator')->get('app.withdraw'); ?></h3>
				<div class="pull-right box-tools">
					<!-- <a href="" class="btn btn-block btn-primary btn-sm">ADD</a> -->
				</div>
			</div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="withdraw-table">
						<thead>
							<tr>
								<th>UserID</th>
								<th>Username</th>
								<th>Date</th>
								<th>RealBalance</th>
								<th>Amount</th>
								<th>Request Email</th>
								<th>Phone</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if(isset($transactions) && count($transactions)): ?>
						<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($transaction->user_id); ?></td>
								<td>
									<a href="<?php echo e(route('backend.user.edit', $transaction->user_id)); ?>">
									<?php echo e($transaction->username); ?>

									</a>
								</td>
								<td><?php echo e($transaction->created_at); ?></td>
								<td><?php echo e($transaction->balance); ?></td>
								<td><?php echo e($transaction->summ); ?></td>
								<td><?php echo e($transaction->email); ?></td>
								<td><?php echo e($transaction->phone); ?></td>
								<td><?php echo e($transaction->getStatus()); ?></td>
								<td class="d-flex">
									<!-- <?php if($transaction->approve): ?>
									<button type="button" class="btn btn-block btn-success btn-xs">Approve</button>
									<?php else: ?>
									<button type="button" class="btn btn-block btn-success btn-xs" disabled="true">Inprogress</button>
									<?php endif; ?> -->
									<?php if($transaction->status == 0): ?>
										<?php if( $transaction->system == 'interac'): ?>
											<a href="<?php echo e(route('backend.withdraw.approve', $transaction->id)); ?>" type="button" class="btn btn-block btn-success btn-xs">Approve</a>
											<a href="<?php echo e(route('backend.withdraw.reject', $transaction->id)); ?>" type="button" class="btn btn-block btn-danger btn-xs">Reject</a>
										<?php elseif($transaction->system == 'crypto'): ?>
											<a href="<?php echo e(route('backend.crypto_withdraw.approve', $transaction->id)); ?>" type="button" class="btn btn-block btn-success btn-xs">Approve</a>
											<a href="<?php echo e(route('backend.crypto_withdraw.reject', $transaction->id)); ?>" type="button" class="btn btn-block btn-danger btn-xs">Reject</a>
										<?php endif; ?>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
						</tbody>
                    </table>
                </div>
            </div>
		</div>
	</section>
	<div id="multiaccount-modal" class="multiaccount-modal modal">
		<div class="multiaccount-modal-content">
			
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<script>
		$('#withdraw-table').dataTable({
			"order": [[ 2, "desc" ]]
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/withdraw/list.blade.php ENDPATH**/ ?>