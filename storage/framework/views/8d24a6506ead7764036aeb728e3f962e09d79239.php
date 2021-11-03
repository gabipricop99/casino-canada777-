<tr>
    <td>
		<?php if (\Auth::user()->hasPermission('games.edit')) : ?>
		<a href="<?php echo e(route('backend.game.apiedit', $apigame->game_id)); ?>">
		<?php endif; ?>

		<?php echo e($apigame->name); ?>

		<?php if (\Auth::user()->hasPermission('games.edit')) : ?>
		</a>
		<?php endif; ?>
	</td>
	<td>
		API GAME
	</td>
	<!-- Classified games order -->
	<td>
		<input type="number" class="game-order-input" value="<?php echo e($apigame->order); ?>" data-gameid="<?php echo e($apigame->game_id); ?>" data-gametype="apigame"/>
		<button type="button" class="btn btn-success btn-sm order-update">Update</button>
	</td>
	
    <td><?php echo e($apigame->credit_in); ?></td>
    <td><?php echo e($apigame->debit_out); ?></td>
    <td>
    <?php if(($apigame->credit_in - $apigame->debit_out) >= 0): ?>
        <span class="text-green">
    <?php else: ?>
        <span class="text-red">
    <?php endif; ?>	
    <?php echo e(number_format(abs($apigame->credit_in-$apigame->debit_out), 2, '.', '')); ?>

    </span>
    </td>
    <td></td>
    <td></td>
	
<td>

	<label class="checkbox-container">
		<input type="checkbox" name="checkbox[<?php echo e($apigame->id); ?>]" Disabled>
		<span class="checkmark"></span>
	</label>
		
</td>
</tr><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/games/partials/apigame_row.blade.php ENDPATH**/ ?>