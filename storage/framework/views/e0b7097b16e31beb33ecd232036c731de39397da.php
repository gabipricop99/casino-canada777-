<tr>
    <td>
        <a href="<?php echo e(route('backend.user.edit', $user->id)); ?>">
            <?php echo e($user->username ?: trans('app.n_a')); ?>

        </a>
    </td>
    <td>
        <a href="<?php echo e(route('backend.user.edit', $user->id)); ?>">
            <?php echo e($user->created_at); ?>

        </a>
    </td>
	<?php if (\Auth::user()->hasPermission('users.balance.manage')) : ?>
	<td><?php echo e($user->last_login ? $user->last_login : $user->created_at); ?></td>
	<td><?php echo e($user->balance); ?></td>
	<td><?php echo e($user->bonus); ?></td>
	<td><?php echo e($user->wager); ?></td>
	<td>
		<a class="editMoney" href="#" data-toggle="modal" data-target="#openEditModal" data-id="<?php echo e($user->id); ?>" data-username="<?php echo e($user->username); ?>" data-balance="<?php echo e($user->balance); ?>" data-bonus="<?php echo e($user->bonus); ?>" data-wager="<?php echo e($user->wager); ?>">
		<button type="button" class="btn btn-block btn-success btn-xs">Edit</button>
		</a>
	</td>
    <?php endif; ?>

	<?php if(isset($show_shop) && $show_shop): ?>
		<?php if($user->shop): ?>
			<td><a href="<?php echo e(route('backend.shop.edit', $user->shop->id)); ?>"><?php echo e($user->shop->name); ?></a></td>
			<?php else: ?>
			<td></td>
		<?php endif; ?>
	<?php endif; ?>
</tr><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/user/partials/row.blade.php ENDPATH**/ ?>