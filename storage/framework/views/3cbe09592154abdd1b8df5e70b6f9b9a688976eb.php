<tr>
	<td><?php echo e($item->id); ?></td>
	<td><a href="<?php echo e(route('backend.bonus.edit', $item->id)); ?>"><?php echo e($item->name); ?></a></td>
	<td><?php echo e($item->getType()); ?></td> 
	<td><?php echo e($item->valid_from); ?></td>
    <td><?php echo e($item->valid_until); ?></td>
	<td><?php echo e($item->getDays()); ?></td>
	<td><?php echo e($item->deposit_min); ?></td>
    <td><?php echo e($item->deposit_max); ?></td>
	<td><?php echo e($item->match_win); ?></td>
	<td><?php echo e($item->code); ?></td>
    <td><?php echo e($item->wagering); ?></td>
	<td>
		<?php if(!$item->active): ?>
			<small><i class="fa fa-circle text-red"></i></small>
		<?php else: ?>
			<small><i class="fa fa-circle text-green"></i></small>
		<?php endif; ?>
	</td>
</tr><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/bonus/item.blade.php ENDPATH**/ ?>