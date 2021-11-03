

<?php $__env->startSection('page-title', 'Add Bonus'); ?>
<?php $__env->startSection('page-heading', 'Add Bonus'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
<?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

    <section class="content">
      <div class="box box-default">
		<?php echo Form::open(['route' => 'backend.bonus.add', 'files' => true, 'id' => 'bonus-form']); ?>

        <div class="box-header with-border">
          <h3 class="box-title">Add Bonus</h3>
        </div>

        <div class="box-body">
          <div class="row">
            <?php echo $__env->make('backend.bonus.base', ['edit' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>

        <div class="box-footer">
        <button type="submit" class="btn btn-primary">
          Add Bonus
        </button>
        </div>
		<?php echo Form::close(); ?>

      </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(function() {
            $('input[name^="valid_"]').datepicker({
                format: 'yyyy-mm-dd',
            });
        });
    </script>
    <?php echo HTML::script('/back/js/as/app.js'); ?>

    <?php echo HTML::script('/back/js/as/btn.js'); ?>

    <?php echo HTML::script('/back/js/as/profile.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/bonus/add.blade.php ENDPATH**/ ?>