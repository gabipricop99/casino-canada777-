

<?php $__env->startSection('page-title', trans('app.permissions')); ?>
<?php $__env->startSection('page-heading', trans('app.permissions')); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <section class="content">
        <?php echo Form::open(['route' => 'backend.permission.save', 'class' => 'mb-4']); ?>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo app('translator')->get('app.permissions'); ?></h3>
                <?php if (\Auth::user()->hasPermission('permissions.add')) : ?>
                <div class="pull-right box-tools">
                    <a href="<?php echo e(route('backend.permission.create')); ?>" class="btn btn-block btn-primary btn-sm"><?php echo app('translator')->get('app.add'); ?></a>
                </div>
                <?php endif; ?>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('app.name'); ?></th>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($role->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($permissions)): ?>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('backend.permission.edit', $permission->id)); ?>"><?php echo e($permission->name ?: $permission->name); ?></a></td>

                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <label class="checkbox-container" for="cb-<?php echo e($role->id); ?>-<?php echo e($permission->id); ?>">
                                            <?php echo Form::checkbox(
                                                "roles[{$role->id}][]",
                                                $permission->id,
                                                $role->hasOnePermission($permission->id),
                                                [
                                                    'id' => "cb-{$role->id}-{$permission->id}"
                                                ]
                                            ); ?>

                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('app.name'); ?></th>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($role->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    <?php echo app('translator')->get('app.save_permissions'); ?>
                </button>
            </div>
            <?php echo Form::close(); ?>

        </div>

    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/permission/index.blade.php ENDPATH**/ ?>