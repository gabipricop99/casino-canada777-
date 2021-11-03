<tr>
	<td><?php echo e($item->id); ?></td>
	<td><a href="<?php echo e(route('backend.freespinround.edit', $item->id)); ?>"><?php echo e($item->title); ?></a></td>
	<td><?php echo e($item->free_rounds); ?></td>
	<td><?php echo e($item->bet_type); ?></td>
	<td><?php echo e($item->valid_from); ?></td>
    <td><?php echo e($item->valid_to); ?></td>
	<td>
		<?php if($item->active == 0): ?>
			<small><i class="fa fa-circle text-red"></i></small>
		<?php else: ?>
			<small><i class="fa fa-circle text-green"></i></small>
		<?php endif; ?>
	</td>
</tr><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/freespinround/item.blade.php ENDPATH**/ ?>