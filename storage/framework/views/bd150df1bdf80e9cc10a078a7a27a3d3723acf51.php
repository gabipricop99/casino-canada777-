<tr>
    <td>
		<?php if (\Auth::user()->hasPermission('games.edit')) : ?>
		<a href="<?php echo e(route('backend.game.edit', $game->id)); ?>">
		<?php endif; ?>

		<?php echo e($game->title); ?>


		<?php if (\Auth::user()->hasPermission('games.edit')) : ?>
		</a>
		<?php endif; ?>
	</td>
	<td>
		Original GAME
	</td>
	<!-- Classified games order -->
	<td>
		<input type="number" class="game-order-input" value="<?php echo e($game->order); ?>" data-gameid="<?php echo e($game->original_id); ?>" data-gametype="original"/>
		<button type="button" class="btn btn-success btn-sm order-update">Update</button>
	</td>
	
	<?php if( count($savedCategory) ): ?>
		<?php $__currentLoopData = $savedCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($game_category == 1): ?>
				<td>
					<input type="number" class="game-order-input" value="<?php echo e($game->hot_order); ?>" data-gameid="<?php echo e($game->original_id); ?>" />
					<button type="button" class="btn btn-success btn-sm hot-order-update">Update</button>
				</td>
			<?php endif; ?>
			<?php if($game_category == 2): ?>
				<td>
					<input type="number" class="game-order-input" value="<?php echo e($game->new_order); ?>" data-gameid="<?php echo e($game->original_id); ?>" />
					<button type="button" class="btn btn-success btn-sm new-order-update">Update</button>
				</td>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	<!-- --- -->
	<?php if (\Auth::user()->hasPermission('games.in_out')) : ?>
	<td><?php echo e($game->stat_in); ?></td>
	<td><?php echo e($game->stat_out); ?></td>
	<td>
		<?php if(($game->stat_in - $game->stat_out) >= 0): ?>
			<span class="text-green">
		<?php else: ?>
			<span class="text-red">
		<?php endif; ?>	
		<?php echo e(number_format(abs($game->stat_in-$game->stat_out), 2, '.', '')); ?>

		</span>
	</td>
	<?php endif; ?>
	<td><?php echo e($game->bids); ?></td>
	<td><?php echo e($game->denomination); ?></td>
<td>

	<label class="checkbox-container">
		<input type="checkbox" name="checkbox[<?php echo e($game->id); ?>]">
		<span class="checkmark"></span>
	</label>
			<!--
        <input class="custom-control-input minimal" id="cb-[<?php echo e($game->id); ?>]" name="checkbox[<?php echo e($game->id); ?>]" type="checkbox">

			-->
</td>
</tr><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/games/partials/row.blade.php ENDPATH**/ ?>