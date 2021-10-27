

<?php $__env->startSection('page-title', trans('app.notifications')); ?>
<?php $__env->startSection('page-heading', trans('app.notifications')); ?>

<?php $__env->startSection('content'); ?>

	<section class="content-header">
		<?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo app('translator')->get('app.notifications'); ?></h3>
				<div class="pull-right box-tools">
					<a href="<?php echo e(route('backend.notifications.add')); ?>" class="btn btn-block btn-primary btn-sm"><?php echo app('translator')->get('app.add'); ?></a>
				</div>
			</div>
            <div class="box-body">
                <div class="table-responsive" >
                    <table class="table table-bordered table-striped" id="notifications_table">
					<thead>
					<tr>
						<th><?php echo app('translator')->get('app.id'); ?></th>
						<th><?php echo app('translator')->get('app.message'); ?></th>
						<th><?php echo app('translator')->get('app.image'); ?></th>
						<th><?php echo app('translator')->get('app.schedule_campaign'); ?></th>
						<th><?php echo app('translator')->get('app.frequency'); ?></th>
						<th><?php echo app('translator')->get('app.valid_date'); ?></th>
						<th><?php echo app('translator')->get('app.active'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if(count($notifications)): ?>
						<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php echo $__env->make('backend.notifications.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<tr><td colspan="9"><?php echo app('translator')->get('app.no_data'); ?></td></tr>
					<?php endif; ?>
					</tbody>
					<thead>
					<tr>
						<th><?php echo app('translator')->get('app.id'); ?></th>
						<th><?php echo app('translator')->get('app.message'); ?></th>
						<th><?php echo app('translator')->get('app.image'); ?></th>
						<th><?php echo app('translator')->get('app.schedule_campaign'); ?></th>
						<th><?php echo app('translator')->get('app.frequency'); ?></th>
						<th><?php echo app('translator')->get('app.valid_date'); ?></th>
						<th><?php echo app('translator')->get('app.active'); ?></th>
					</tr>
					</thead>
                    </table>
                </div>
            </div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<script>
		$('#notifications_table').dataTable();
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/notifications/list.blade.php ENDPATH**/ ?>