

<?php $__env->startSection('page-title', trans('app.edit_reject')); ?>
<?php $__env->startSection('page-heading', 'Reject'); ?>

<?php $__env->startSection('content'); ?>

  <section class="content-header">
    <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </section>

  <section class="content">
    <div class="box box-default">
      <?php if($reject[0]->system == "interac"): ?>
        <?php echo Form::open(['route' => array('backend.withdraw.reject', $reject[0]->id), 'files' => true, 'id' => 'reject-form']); ?>

      <?php elseif($reject[0]->system == "crypto"): ?>
        <?php echo Form::open(['route' => array('backend.crypto_withdraw.reject', $reject[0]->id), 'files' => true, 'id' => 'reject-form']); ?>

      <?php endif; ?>
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo app('translator')->get('app.reject'); ?></h3>
      </div>

      <div class="box-body">
        <div class="row">

        </div>
      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">
          <?php echo app('translator')->get('app.reject'); ?>
        </button>

      </div>
      <?php echo Form::close(); ?>

    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/withdraw/reject.blade.php ENDPATH**/ ?>