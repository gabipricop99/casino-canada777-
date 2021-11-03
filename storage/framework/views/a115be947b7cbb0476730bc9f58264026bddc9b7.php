

<?php $__env->startSection('page-title', trans('app.login')); ?>

<?php $__env->startSection('content'); ?>
<div class="login-wrapper">
  <div class="login-box">
    <div class="login-logo">

        <a href="<?php echo e(route('frontend.auth.login')); ?>">
            <img src="<?php echo e(asset('back/img/login-Logo.png')); ?>" />
        </a>
    </div>

    <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="login-box-body">

      <form role="form" action="<?php echo e(url('login')); ?>" method="POST" id="login-form" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="form-group has-feedback">
          <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo app('translator')->get('app.email_or_username'); ?>">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo app('translator')->get('app.password'); ?>">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat" id="btn-login">
              <?php echo app('translator')->get('app.log_in'); ?>
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="login-box-footer">
        <a href="<?php echo e(url('/categories/all')); ?>">RETURN TO SITE</a>
    </div>
  </div>
</div>
  <script src="/back/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/back/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/back/plugins/iCheck/icheck.min.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <?php echo JsValidator::formRequest('VanguardLTE\Http\Requests\Auth\LoginRequest', '#login-form'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/frontend/Default/auth/login.blade.php ENDPATH**/ ?>