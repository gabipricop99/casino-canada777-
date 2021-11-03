<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.name'); ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo app('translator')->get('app.name'); ?>" required value="<?php echo e($edit ? $bonus->name : ''); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.type'); ?></label>
        <?php echo Form::select('type', $types, $edit ? $bonus->type : '', ['id' => 'type', 'class' => 'form-control']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Valid From</label>
        <input type="text" class="form-control" id="valid_from" name="valid_from" placeholder="Valid From Date" required value="<?php echo e($edit ? $bonus->valid_from : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Valid Until</label>
        <input type="text" class="form-control" id="valid_until" name="valid_until" placeholder="Valid Until Date" required value="<?php echo e($edit ? $bonus->valid_until : ''); ?>">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Days</label>
        <label class="checkbox-container"><?php echo Form::checkbox("is_mon", null, $edit ? $bonus->is_mon : true); ?> Monday<span class="checkmark"></span></label>
        <label class="checkbox-container"><?php echo Form::checkbox("is_tue", null, $edit ? $bonus->is_tue : true); ?> Tuesday<span class="checkmark"></span></label>
        <label class="checkbox-container"><?php echo Form::checkbox("is_wed", null, $edit ? $bonus->is_wed : true); ?> Wednesday<span class="checkmark"></span></label>
        <label class="checkbox-container"><?php echo Form::checkbox("is_thr", null, $edit ? $bonus->is_thr : true); ?> Thursday<span class="checkmark"></span></label>
        <label class="checkbox-container"><?php echo Form::checkbox("is_fri", null, $edit ? $bonus->is_fri : true); ?> Friday<span class="checkmark"></span></label>
        <label class="checkbox-container"><?php echo Form::checkbox("is_sat", null, $edit ? $bonus->is_sat : true); ?> Saturday<span class="checkmark"></span></label>
        <label class="checkbox-container"><?php echo Form::checkbox("is_sun", null, $edit ? $bonus->is_sun : true); ?> Sunday<span class="checkmark"></span></label>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Deposit Min</label>
        <input type="text" class="form-control" id="deposit_min" name="deposit_min" placeholder="Deposit Min" required value="<?php echo e($edit ? $bonus->deposit_min : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Deposit Max</label>
        <input type="text" class="form-control" id="deposit_max" name="deposit_max" placeholder="Deposit Max" required value="<?php echo e($edit ? $bonus->deposit_max : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Match Win</label>
        <input type="text" class="form-control" id="match_win" name="match_win" placeholder="Match Win" required value="<?php echo e($edit ? $bonus->match_win : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Promotion Code</label>
        <input type="text" class="form-control" id="code" name="code" placeholder="Promotion Code" value="<?php echo e($edit ? $bonus->code : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Wagering</label>
        <input type="text" class="form-control" id="wagering" name="wagering" placeholder="Wagering" required value="<?php echo e($edit ? $bonus->wagering : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Active</label>
        <?php echo Form::select('active', [ 1 => 'Active', 0 => 'UnActive'], $edit ? $bonus->active : '', ['id' => 'active', 'class' => 'form-control']); ?>

    </div>
</div><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/bonus/base.blade.php ENDPATH**/ ?>