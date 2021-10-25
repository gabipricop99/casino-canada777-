

<?php $__env->startSection('page-title', trans('app.bonus')); ?>
<?php $__env->startSection('page-heading', trans('app.bonus')); ?>

<?php $__env->startSection('content'); ?>

	<section class="content-header">
		<?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo app('translator')->get('app.bonus'); ?></h3>
				<div class="pull-right box-tools">
					<a href="<?php echo e(route('backend.bonus.add')); ?>" class="btn btn-block btn-primary btn-sm"><?php echo app('translator')->get('app.add'); ?></a>
				</div>
			</div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
					<thead>
					<tr>
						<th><?php echo app('translator')->get('app.id'); ?></th>
						<th><?php echo app('translator')->get('app.name'); ?></th>
						<th><?php echo app('translator')->get('app.type'); ?></th>
						<th>Valid From</th>
						<th>Valid Until</th>
						<th>Days</th>
						<th>Min Deposit</th>
						<th>Max Deposit</th>
						<th>Match Win</th>
						<th>Code</th>
						<th>Wagering</th>
						<th><?php echo app('translator')->get('app.active'); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if(count($bonus)): ?>
						<?php $__currentLoopData = $bonus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php echo $__env->make('backend.bonus.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<tr><td colspan="9"><?php echo app('translator')->get('app.no_data'); ?></td></tr>
					<?php endif; ?>
					</tbody>
					<thead>
					<tr>
						<th><?php echo app('translator')->get('app.id'); ?></th>
						<th><?php echo app('translator')->get('app.name'); ?></th>
						<th><?php echo app('translator')->get('app.type'); ?></th>
						<th>Valid From</th>
						<th>Valid Until</th>
						<th>Days</th>
						<th>Min Deposit</th>
						<th>Max Deposit</th>
						<th>Match Win</th>
						<th>Code</th>
						<th>Wagering</th>
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
		$('#jackpots-table').dataTable();
		$("#status").change(function () {
			$("#users-form").submit();
		});
		$('.addPayment').click(function(event){
			console.log($(event.target));
			var item = $(event.target).hasClass('addPayment') ? $(event.target) : $(event.target).parent();
			var id = item.attr('data-id');
			$('#AddId').val(id);
			$('#outAll').val('0');
		});


		$('#doOutAll').click(function () {
			$('#outAll').val('1');
			$('form#outForm').submit();
		});

		$('.outPayment').click(function(event){
			console.log($(event.target));
			var item = $(event.target).hasClass('outPayment') ? $(event.target) : $(event.target).parent();
			console.log(item);
			var id = item.attr('data-id');
			$('#OutId').val(id);
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/bonus/list.blade.php ENDPATH**/ ?>