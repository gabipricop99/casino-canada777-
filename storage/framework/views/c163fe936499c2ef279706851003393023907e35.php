<header>
    <div id="menu-toggle">
        <div id="menu_button">
            <input type="checkbox" id="menu_checkbox">
            <label for="menu_checkbox" id="menu_label">
                <div id="menu_text_bar"></div>
            </label>
        </div>

        <ul id="header-menu">
            <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
            <?php if(Auth::check()): ?>
            <li><a href="javascript:fn_profile();">My Balance</a></li>
            <li><a href="javascript:fn_profile_load('verify');">Account Verification</a></li>
            <li><a href="javascript:fn_profile_load('deposit');">Deposit</a></li>
            <li><a href="javascript:fn_profile_load('withdraw');">Withdraw</a></li>
            <li><a href="javascript:fn_profile_load('password');">Change Password</a></li>
            <li><a href="javascript:fn_profile_load('detail');">Personal details</a></li>
            <li><a href="javascript:fn_profile_load('history/payment');">Transaction History</a></li>
            <li><a href="javascript:fn_profile_load('bonus');">Bonus History</a></li>
            <li><a href="javascript:fn_profile_load('freespin');">Free Spins History</a></li>
            <?php endif; ?>
            <li><a href="<?php echo e(url('bonus')); ?>">Bonus</a></li>
            <li><a href="<?php echo e(url('about')); ?>">About Us</a></li>
            <li><a href="<?php echo e(route('frontend.support.ticket')); ?>">Support</a></li>
            <?php if(Auth::check()): ?>
            <li><a href="<?php echo e(route('frontend.auth.logout')); ?>">Sign Out</a></li>
            <?php else: ?>
            <li class="d-md-block d-lg-none"><a href="#signin-modal">Sign In</a></li>
            <li class="d-md-block d-lg-none"><a href="#signup-modal">Sign Up</a></li>
            <?php endif; ?>
        </ul>
        <span class="d-md-flex d-none">Menu</span>
    </div>
    <div class="header-content">
        <div class="logo">
            <a href="<?php echo e(url('/')); ?>" class="d-md-flex d-none">
                <img src="https://static.canada777.com/frontend/Page/image/logo.png" />
            </a>
            <a href="<?php echo e(url('/')); ?>" class="d-md-none d-flex">
                <img src="https://static.canada777.com/frontend/Page/image/mobile-logo.png" />
            </a>
        </div>
        <div class="account-header-menu d-flex">
            <?php if(!Auth::check()): ?>
            <div class="account-header-menu-item">
                <a href="#signin-modal">
                    <img class="d-md-flex d-none" src="https://static.canada777.com/frontend/Page/image/signin-icon.png" />
                    <span>sign in</span>
                </a>
            </div>
            <div class="account-header-menu-item">
                <a href="#signup-modal">
                    <img class="d-md-flex d-none" src="https://static.canada777.com/frontend/Page/image/signup-icon.png" />
                    <span class="singup">sign up</span>
                </a>
            </div>
            <?php else: ?>
            <div class="account-header-menu-item d-lg-block">
                <a href="javascript:fn_profile_load('freespin');">
                    <span><img src="https://static.canada777.com/frontend/Page/image/notification.png" /></span>
                </a>
            </div>    
            <div class="account-header-menu-item d-lg-block">
                <!-- <a href="javascript:fn_deposit('<?php echo e(Auth::check()); ?>')"> -->
                
                <!-- redesign deposit with color like casino.com  -->
                <a href="javascript:fn_profile_load('deposit')">
                    <img src="https://static.canada777.com/frontend/Page/image/deposit-icon.png" />
                    <span>deposit</span>
                </a>
            </div>
            <div class="account-header-menu-item">
                <!-- <a href="<?php echo e(route('frontend.profile.balance')); ?>" data-ol-has-click-handler>
                    <img src="https://static.canada777.com/frontend/Page/image/signin-icon.png" />
                    <span>
                        <div><?php echo e(Auth::user()->username); ?></div>
                        <div style="line-height: 1">$ <b><?php echo e(Auth::user()->balance); ?></b></div>
                    </span>
                </a> -->
                <input type="hidden" id="user_balance_amount" value="<?php echo e(number_format((float)Auth::user()->balance, 2, '.', '')); ?>">
                <a href="javascript:fn_side_menu()" data-ol-has-click-handler>
                    <img src="https://static.canada777.com/frontend/Page/image/signin-icon.png" />
                    <span>

                        <div>balance</div>
                        <div style="line-height: 1">$ <b><?php echo e(number_format((float)Auth::user()->balance, 2, '.', '')); ?></b></div>
                    </span>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</header>
<?php /**PATH C:\khi\00work\06casino\canada777\resources\views/component/frontend/layout/header.blade.php ENDPATH**/ ?>