

<?php $__env->startSection('page-title', 'Add Freespin Round'); ?>
<?php $__env->startSection('page-heading', 'Add Freespin Round'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
<?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

    <section class="content">
      <div class="box box-default">
		<?php echo Form::open(['url' => route('backend.freespinround.edit', $freespinround->id), 'files' => true, 'id' => 'freespinround-form']); ?>

        <div class="box-header with-border">
          <h3 class="box-title">Edit Freespin Round</h3>
        </div>

        <div class="box-body">
          <div class="row">
            <?php echo $__env->make('backend.freespinround.base', ['edit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>

        <div class="box-footer">
        <button type="submit" class="btn btn-primary">
          Edit Freespin Round
        </button>
        <a href="<?php echo e(route('backend.freespinround.delete', $freespinround->id)); ?>" class="btn btn-danger" data-method="GET" data-confirm-title="Please Confirm" data-confirm-text="Are you sure delete freespin round?" data-confirm-delete="Yes, delete it!">
          Delete Freespin Round
        </a>
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
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/freespinround/edit.blade.php ENDPATH**/ ?>