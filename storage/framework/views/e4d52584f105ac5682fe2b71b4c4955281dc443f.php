<tr>
	<td><?php echo e($item->id); ?></td>
	<td><a href="<?php echo e(route('backend.notifications.edit', $item->id)); ?>"><?php echo e($item->message); ?></a></td>
	<td><img style="width:100px; height:100px; object-fit:cover" src="/notify/<?php echo e($item->image); ?>" alt=""/></td>
	<td>
		<?php if($item->campaign == 0): ?>
			<small><i class="fa fa-close text-red"></i></small>
		<?php else: ?>
			<small><i class="fa fa-check text-green"></i></small>
		<?php endif; ?>
	</td>
	<td><?php echo e($frequency_type[$item->frequency]); ?></td>
    <td><?php echo e($item->notify_date.' '.$item->notify_time); ?></td>
	<td>
		<?php if($item->active == 0): ?>
			<small><i class="fa fa-circle text-red"></i></small>
		<?php else: ?>
			<small><i class="fa fa-circle text-green"></i></small>
		<?php endif; ?>
	</td>
</tr><?php /**PATH D:\00work\06casino\canada777\resources\views/backend/notifications/item.blade.php ENDPATH**/ ?>