<div class="col-md-10">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.title'); ?></label>
        <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo app('translator')->get('app.title'); ?>" required value="<?php echo e($edit ? $freespinround->title : ''); ?>">
    </div>
</div>
<div class="col-md-10">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.players'); ?></label>
        <select class="form-control select2" name="players[]" id="players" multiple="multiple" style="width: 100%;" data-placeholder="">
            <?php if($savedPlayer == 'all'): ?>
                <option value="all" selected='selected'>ALL</option>
                <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" ><?php echo e($player); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            <?php else: ?>
                <option value="all" >ALL</option>
                <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php echo e((count($savedPlayer) && in_array($key, $savedPlayer))? 'selected="selected"' : ''); ?>><?php echo e($player); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Original Games</label>
        <select class="form-control select2" name="games[]" id="games" multiple="multiple" style="width: 100%;" data-placeholder="">
            <?php if($savedGame == 'all'): ?>
                <option value="all" selected='selected'>ALL</option>
                <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" ><?php echo e($game); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            <?php else: ?>
                <option value="all" >ALL</option>
                <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php echo e((count($savedGame) && in_array($key, $savedGame))? 'selected="selected"' : ''); ?>><?php echo e($game); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Api Games</label>
        <select class="form-control select2" name="apigames[]" id="apigames" multiple="multiple" style="width: 100%;" data-placeholder="">
            <?php if($savedApiGame == 'all'): ?>
                <option value="all" selected='selected'>ALL</option>
                <?php $__currentLoopData = $apigames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apigame=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($apigame); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <option value="all" >ALL</option>
                <?php $__currentLoopData = $apigames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apigame=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php echo e((count($savedApiGame) && in_array($key, $savedApiGame))? 'selected="selected"' : ''); ?>><?php echo e($apigame); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>    
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Valid From</label>
        <input type="text" class="form-control" id="valid_from" name="valid_from" placeholder="Valid From Date" required value="<?php echo e($edit ? $freespinround->valid_from : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Valid To</label>
        <input type="text" class="form-control" id="valid_to" name="valid_to" placeholder="Valid To Date" required value="<?php echo e($edit ? $freespinround->valid_to : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Bet</label>
        <?php echo Form::select('bet_type', [ 'min' => 'Min', 'mid' => 'Mid', 'max' => 'Max'], $edit ? $freespinround->bet_type : '', ['id' => 'bet_type', 'class' => 'form-control']); ?>

    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Free Rounds</label>
        <input type="number" class="form-control" id="free_rounds" name="free_rounds" placeholder="Free Rounds" required value="<?php echo e($edit ? $freespinround->free_rounds : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Freerounds_added_notify</label>
        <!-- <input type="checkbox" class="form-control" id="notify" name="notify" value="<?php echo e($edit ? $freespinround->notify : ''); ?>"> -->
        <?php if($edit == true): ?>
            <?php if($freespinround->notify == 0): ?>
                <input type="checkbox" id="notify" name="notify" }}>
            <?php else: ?>
                <input type="checkbox" id="notify" name="notify" checked="checked" }}>
            <?php endif; ?>
        <?php else: ?>
            <input type="checkbox" id="notify" name="notify">
        <?php endif; ?>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Active</label>
        <?php echo Form::select('active', [ 1 => 'Active', 0 => 'UnActive'], $edit ? $freespinround->active : '', ['id' => 'active', 'class' => 'form-control']); ?>

    </div>
</div><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/freespinround/base.blade.php ENDPATH**/ ?>