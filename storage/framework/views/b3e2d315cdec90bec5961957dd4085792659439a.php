

<?php $__env->startSection('page-title', trans('app.edit_approve')); ?>
<?php $__env->startSection('page-heading', 'Approve'); ?>

<?php $__env->startSection('content'); ?>

  <section class="content-header">
    <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </section>

  <section class="content">
    <div class="box box-default">
      <?php if($approve->system == "interac"): ?>
      <?php echo Form::open(['route' => array('backend.withdraw.approve', $approve->id), 'files' => true, 'id' => 'approve-form']); ?>

      <?php elseif($approve->system == "crypto"): ?>
      <?php echo Form::open(['route' => array('backend.crypto_withdraw.approve', $approve->id), 'files' => true, 'id' => 'approve-form']); ?>

      <?php endif; ?>
      
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo app('translator')->get('app.approve'); ?></h3>
      </div>

      <div class="box-body">
        <div class="row">

        </div>
      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">
          <?php echo app('translator')->get('app.approve'); ?>
        </button>

      </div>
      <?php echo Form::close(); ?>

    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/withdraw/approve.blade.php ENDPATH**/ ?>