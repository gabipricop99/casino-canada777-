<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <div class="user-panel">
            <div class="pull-left image">
                <img src="/back/img/<?php echo e(auth()->user()->present()->role_id); ?>.png" class="img-circle">
            </div>
            <div class="pull-left info">
			<p>Balance:

                    <?php if( Auth::user()->hasRole(['cashier', 'manager']) ): ?>
                        <?php
                            $shop = \VanguardLTE\Shop::find( auth()->user()->present()->shop_id );
                            echo $shop?number_format($shop->balance,2,".",""):0;
                        ?>
                    <?php if( auth()->user()->present()->shop ): ?>
                        <?php echo e(auth()->user()->present()->shop->currency); ?>

                    <?php endif; ?>
                    <?php else: ?>
                        <?php echo e(number_format(auth()->user()->present()->balance,2,".","")); ?>

                        <?php if( auth()->user()->present()->shop ): ?>
                            <?php echo e(auth()->user()->present()->shop->currency); ?>

                        <?php endif; ?>
                    <?php endif; ?>

			</p>

			<a href="javascript:;" data-toggle="modal" data-target="#openChangeModal">
				<i class="fa fa-circle text-success"></i>
				<?php if(Auth::user()->shop): ?> <?php echo e(Auth::user()->shop->name); ?> <?php else: ?> <?php echo app('translator')->get('app.no_shop'); ?> <?php endif; ?>
			</a>

            </div>
        </div>
        <!-- search form -->

        <?php if (\Auth::user()->hasPermission('full.search')) : ?>
        <form action="<?php echo e(route('backend.search')); ?>" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?php echo app('translator')->get('app.search'); ?>">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <?php endif; ?>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header"><?php echo app('translator')->get('app.main_navigation'); ?></li>

            <?php if (\Auth::user()->hasPermission('dashboard')) : ?>
            <li class="<?php echo e(Request::is('backend') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.dashboard')); ?>">
                    <i class="fa fa-home"></i>
                    <span><?php echo app('translator')->get('app.dashboard'); ?></span>
                </a>
            </li>
            <?php endif; ?>


            <?php if (\Auth::user()->hasPermission('users.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/user*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.user.list')); ?>">
                    <i class="fa fa-users"></i>
                    <span><?php echo app('translator')->get('app.users'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('notifications.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/notifications*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.notifications.list')); ?>">
                    <i class="fa fa-bell"></i>
                    <span><?php echo app('translator')->get('app.notifications'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('country.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/country*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.country')); ?>">
                    <i class="fa fa-globe"></i>
                    <span><?php echo app('translator')->get('app.country'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('currency.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/currency*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.currency')); ?>">
                    <i class="fa fa-exchange"></i>
                    <span><?php echo app('translator')->get('app.currency'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('returns.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e(Request::is('backend/withdraw*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.withdraw.list')); ?>">
                    <i class="fa fa-gg"></i>
                    <span><?php echo app('translator')->get('app.withdraw'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('categories.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e(Request::is('backend/category*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.category.list')); ?>">
                    <i class="fa fa-server"></i>
                    <span><?php echo app('translator')->get('app.categories'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <!-- <?php if (\Auth::user()->hasPermission('withdraw.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <div>sdfsdfs</div>
            <li class="<?php echo e(Request::is('backend/withdraw*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.withdraw.list')); ?>">
                    <i class="fa fa-gg"></i>
                    <span><?php echo app('translator')->get('app.withdraw'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?> -->



            <?php if (\Auth::user()->hasPermission('returns.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e(Request::is('backend/returns*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.returns.list')); ?>">
                    <i class="fa fa-server"></i>
                    <span><?php echo app('translator')->get('app.returns'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('happyhours.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e(Request::is('backend/happyhours*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.happyhour.list')); ?>">
                    <i class="fa fa-server"></i>
                    <span><?php echo app('translator')->get('app.happyhours'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>


            <?php if (\Auth::user()->hasPermission('jpgame.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e(Request::is('backend/jpgame*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.jpgame.list')); ?>">
                    <i class="fa  fa-money"></i>
                    <span><?php echo app('translator')->get('app.jpg'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('pincodes.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/pincodes*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.pincode.list')); ?>">
                    <i class="fa fa-server"></i>
                    <span><?php echo app('translator')->get('app.pincodes'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('games.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e((Request::is('backend/game') || Request::is('backend/game/*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.game.list')); ?>">
                    <i class="fa fa-gamepad"></i>
                    <span><?php echo app('translator')->get('app.games'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('bonus.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e((Request::is('backend/bonus') || Request::is('backend/bonus/*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.bonus.list')); ?>">
                    <i class="fa fa-rocket"></i>
                    <span><?php echo app('translator')->get('app.bonus'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('freespinround.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e((Request::is('backend/freespinround') || Request::is('backend/freespinround/*')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.freespinround.list')); ?>">
                    <i class="fa fa-gift"></i>
                    <span><?php echo app('translator')->get('app.freespinround'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(
                Auth::user()->hasPermission('stats.live') ||
                Auth::user()->hasPermission('stats.pay') ||
                Auth::user()->hasPermission('stats.game') ||
                Auth::user()->hasPermission('stats.bank') ||
                Auth::user()->hasPermission('stats.shift')
            ): ?>

            <li class="treeview <?php echo e(Request::is('backend/live*') || Request::is('backend/statistics*') || Request::is('backend/game_stat*') || Request::is('backend/shop_stat') || Request::is('backend/shift_stat') || Request::is('backend/bank_stat') ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span>Stats</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class=" treeview-menu" id="stats-dropdown">

                    <?php if (\Auth::user()->hasPermission('stats.live')) : ?>
                    <li class="<?php echo e(Request::is('backend/live') ? 'active' : ''); ?>">
                        <a  href="<?php echo e(route('backend.live_stat')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <?php echo app('translator')->get('app.live_stats'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (\Auth::user()->hasPermission('stats.pay')) : ?>
                    <li class="<?php echo e(Request::is('backend/statistics*') ? 'active' : ''); ?>">
                        <a  href="<?php echo e(route('backend.statistics')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <?php echo app('translator')->get('app.statistics'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (\Auth::user()->hasPermission('stats.game')) : ?>
                    <li class="<?php echo e(Request::is('backend/game_stat') ? 'active' : ''); ?>">
                        <a  href="<?php echo e(route('backend.game_stat')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <?php echo app('translator')->get('app.game_stats'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (\Auth::user()->hasPermission('stats.bank')) : ?>
                    <li class="<?php echo e(Request::is('backend/bank_stat') ? 'active' : ''); ?>">
                        <a  href="<?php echo e(route('backend.bank_stat')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <?php echo app('translator')->get('app.bank_stats'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (\Auth::user()->hasPermission('stats.shift')) : ?>
                    <li class="<?php echo e(Request::is('backend/shift_stat') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('backend.shift_stat')); ?>">
                            <i class="fa fa-circle-o"></i>
                            <?php echo app('translator')->get('app.shift_stats'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>

            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('users.activity')) : ?>
            <li class="<?php echo e(Request::is('backend/activity*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.activity.index')); ?>">
                    <i class="fa fa-server"></i>
                    <span><?php echo app('translator')->get('app.activity_log'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('permissions.manage')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li  class="<?php echo e(Request::is('backend/permission*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.permission.index')); ?>">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo app('translator')->get('app.permissions'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('settings.generator')) : ?>
            <li class="<?php echo e(Request::is('backend/generator*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.settings.generator')); ?>">
                    <i class="fa fa-server"></i>
                    <span><?php echo app('translator')->get('app.api_generator'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('api.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/api*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.api.list')); ?>">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo app('translator')->get('app.api_keys'); ?></span>
                </a>
            </li>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('settings.general')) : ?>
            <?php if( !(auth()->check() && auth()->user()->shop_id == 0 && auth()->user()->role_id < 6) ): ?>
            <li class="<?php echo e(Request::is('backend/settings') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.settings.general')); ?>">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo app('translator')->get('app.settings'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (\Auth::user()->hasPermission('helpers.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/info*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.info.list')); ?>">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo app('translator')->get('app.info'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (\Auth::user()->hasPermission('automizy.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/automizy*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.automizy.list')); ?>">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo app('translator')->get('app.automizy'); ?></span>
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Auth::user()->hasPermission('freespinround.manage')) : ?>
            <li class="<?php echo e(Request::is('backend/freeplay*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('backend.freeplay.list')); ?>">
                    <i class="fa fa-circle-o"></i>
                    <span><?php echo app('translator')->get('app.free_play'); ?></span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </section>
</aside>

<div class="modal fade" id="openChangeModal"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<form action="<?php echo e(route('backend.profile.setshop')); ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo app('translator')->get('app.shops'); ?></h4>
                </div>
				<div class="modal-body">
					<div class="form-group">
						<?php echo Form::select('shop_id',
                            (Auth::user()->hasRole(['admin','agent']) ? [0 => __('app.no_shop')] : [])
                            +
                            Auth::user()->shops_array(), Auth::user()->shop_id, ['class' => 'form-control select2', 'style' => 'width: 100%;']); ?>

						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('app.close'); ?></button>
					<button type="submit" class="btn btn-primary"><?php echo app('translator')->get('app.change'); ?></button>
				</div>
			</form>
        </div>
    </div>
</div>

<?php /**PATH D:\00work\06casino\canada777\resources\views/backend/partials/sidebar.blade.php ENDPATH**/ ?>