<?php
$detect = new \Detection\MobileDetect();
?>
<div class="popup-modal__inner popup-modal__no-title">
    <div class="my-account-icon">&nbsp;</div>
    <div class="cashier-popup-title"><?php if(!$detect->isMobile() && !$detect->isTablet()): ?> My Account <?php else: ?> My Balance <?php endif; ?></div>
    <span class="micon-close-btn popup-modal__button_type_close fn-close" onClick="<?php if(Request::is('profile/deposit')): ?> location.reload(); <?php else: ?> $('.close-modal').click(); <?php endif; ?>"></span>
    <div class="popup-modal__content fn-popup-content">
        <div class="popup-modal__content-inner fn-popup-loader fn-popup-content">
            <div class="page-content fn-page-content">
                <div class="fn-layout-wrapper layout-wrapper" id="main-content">
                    <div class="portlet-layout page-layout layout-100">
                        <?php if(!$detect->isMobile() && !$detect->isTablet()): ?>
                        <div class="navigation-bar-container fn-navigation-bar-container">
                            <?php echo $__env->make('frontend.Default.user.tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <?php endif; ?>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\00work\06casino\canada777\resources\views/frontend/Default/user/profile.blade.php ENDPATH**/ ?>