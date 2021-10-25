
<div id="signin-modal" class="signin-modal modal">
    <div class="sign-in-modal-content">
        <form id="sign-in-form" class="modal-form" action="<?php echo e(url('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h2 class="text-center mb-2">Log In</h2>
            <fieldset>
                <?php if(isset($login_result)): ?>
                <input type="hidden" id="loginresult" value="<?php echo e($login_result); ?>">
                    <?php if($error = $errors->first()): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" onclick="$(this).parent().hide();">&times;</button>
                        <strong>Wrong!</strong> <?php echo e($error); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- avoid user have different account to get bonus with fingerprintjs -->
                <input type="hidden" id="login_visitorId" name="login_visitorId" value="">
                <!--  -->
                <label for="username" class="mb-2">Enter Your Email or Username *</label>
                <input type="text" name="username" placeholder="Email or Username" required/>
                <label for="password" class="mb-2">Enter Your Password *</label>
                <input type="password" name="password" placeholder="Password" required/>
                <a href="#forgotpassword-modal" class="d-block text-center mb-2">Forgot your password?</a>
                <button type="submit" class="btn btn-success btn-lg btn-block mb-2">Login</button>
                <p><a href="#signup-modal" class="btn btn-outline-warning btn-lg btn-block">Sign Up</a></p>
            </fieldset>
        </form>
    </div>
</div>

<div id="signup-modal" class="signup-modal modal">
    <div class="sign-up-modal-content">
        <div class="modal-left-side modal-side">
            <div class="sign-up-header">
                <h2>Sign Up</h2>
                <p>Already have an account? <a href="#signin-modal">Sign In</a></p>
            </div>
            <div class="sign-up-banner">
                <img src="<?php echo e(asset('frontend/Page/image/sign-up-banner.png')); ?>" />
            </div>
        </div>
        <div class="modal-right-side modal-side">
            <form id="sign-up-form" class="modal-form" action="<?php echo e(url('register')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <h3 class="fs-subtitle">Login Detail</h3>

                <fieldset style="overflow-y: scroll; overflow-x: hidden;">
                    <?php if(isset($register_result)): ?>
                        <input type="hidden" id="registerresult" value="<?php echo e($register_result); ?>">
                        <?php if($error = $errors->first()): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Wrong!</strong> <?php echo e($error); ?>

                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- avoid user have different account to get bonus with fingerprintjs -->
                    <input type="hidden" id="visitorId" name="visitorId" value="">
                    <input type="hidden" id="freespinuser" name="freespinuser" value="">


                    <!--  -->
                    <div class="row">
                        <label for="username">Username *</label>
                        <input type="text" id="username" name="username" placeholder="Username" class="required" />
               <div id="uname_response2" ></div>
                    </div>
                    <div class="row">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" placeholder="Email" class="required" />
                          <div id="uname_response" ></div>
                    </div>


                    <div class="row">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="required" />
                    </div>
                    <div class="row">
                        <label for="currency">Currency</label>
                        <select id="currency" name="currency" placeholder="Currency">
                            <?php if(isset($currencys) && count($currencys)): ?>
                                <?php $__currentLoopData = $currencys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($currency->id); ?>"><?php echo e($currency->currency); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </fieldset>

                <h3 class="fs-subtitle">Personal Info</h3>
                <fieldset style="overflow-y: scroll; overflow-x: hidden;">
                    <div class="row">
                        <label for="firstName">First Name *</label>
                        <input type="text" id="firstName" name="first_name" placeholder="First Name" class="required" />
                    </div>
                    <div class="row">
                        <label for="lastName">Last Name *</label>
                        <input type="text" id="lastName" name="last_name" placeholder="Last Name" class="required" />
                    </div>
                    <div class="row">
                        <label for="birthday">Date of Birth (YYYY/MM/DD) *</label>
                        
                        <div class="birthday">
                            <select id="birthday_year" name="birthday_year" class="selectpicker" data-live-search="true">
                                <option value="" selected>YYYY</option>
                                <?php for($i = 1920; $i <= 2021; $i++): ?>
                                    <?php if($i == 1980): ?>
                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                            <select id="birthday_month" name="birthday_month" class="selectpicker" data-live-search="true">
                               <option value="" selected>MM</option>
                                <?php for($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <select id="birthday_day" name="birthday_day" class="selectpicker" data-live-search="true">
                                <option value="" selected>DD</option>
                                <?php for($i = 1; $i <= 31; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row phone-for-scroll">
                        <label for="phoneNumber">Mobile Phone *</label>
                        <!-- <input type="tel" id="phoneNumber" name="phone" placeholder="Mobile Phone" class="required" /> -->
                        <input id="phoneNumber" type="tel" name="phone" placeholder="(000) 000-0000" />
                        <div class="invalid-phone" role="alert" style="display: none"></div>
                    </div>
                </fieldset>

                <h3 class="fs-subtitle">Confirm Your Detail</h3>
                <fieldset style="overflow-y: scroll; overflow-x: hidden;">
                    <div class="row">
                        <label for="user_address">Address *</label>
                        <input
                            id="user_address"
                            name="user_address"
                            required
                            autocomplete="off"
                        />
                    </div>




                    <div class="row">
                        <label for="country">Country *</label>
                        <select id="country" name="country" class="selectpicker" data-live-search="true" onchange="onCountryChange()">
                            <?php if(isset($countrys) && count($countrys)): ?>
                                <?php $__currentLoopData = $countrys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($country->country == "Canada"): ?>
                                        <option value="<?php echo e($country->id); ?>" selected><?php echo e($country->country); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->country); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>








                    <div class="row">
                        <label for="user_address_city">City *</label>
                        <input id="user_address_city" name="user_address_city" required />
                    </div>




                    <div class="row" id="province-row">
                        <label for="user_address_state">State/Province *</label>
                        <input id="user_address_state" name="user_address_state" required />
                    </div>
























                    <div class="row">
                        <label for="user_address_postcode">Postal Code *</label>
                        <input id="user_address_postcode" name="user_address_postcode" required />
                    </div>




                    <div class="row">
                        <label class="checkbox-container">Receive promotions by email and SMS
                            <input type="checkbox" id="receiveEmailSMS" name="receiveEmailSMS" checked />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </fieldset>

                <h3 class="fs-subtitle">Welcome Package</h3>
                <fieldset style="overflow-y: scroll; overflow-x: hidden;">
                    <legend>Terms and Conditions</legend>
                    <!-- <legend>Terms and Conditions</legend>

                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label> -->

                    <label class="checkbox-container" for="acceptTerms-2">I agree with the Terms and Conditions.
                        <input type="checkbox" id="acceptTerms-2" name="acceptTerms"class="required" checked/>
                        <span class="checkmark"></span>
                    </label>
                    <br>
                    <br>
                    <label class="checkbox-container">I am 18 years old and I accept the Terms and Conditions and Privacy Policy
                        <input type="checkbox" id="acceptAge" name="acceptAge" checked/>
                        <span class="checkmark"></span>
                    </label>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<div id="forgotpassword-modal" class="forgotpassword-modal modal">
    <div class="forgot-password-modal-content">
        <form id="forgot-password-form" class="modal-form" action="<?php echo e(url('forgotpassword')); ?>" method="GET" onsubmit="return false">
            <?php echo csrf_field(); ?>
            <h2 class="text-center mb-2">Forgot your password?</h2>
            <fieldset style="overflow-y: scroll;">
                <div class="alert alert-danger alert-dismissible fade show" style="display:none">
                    <button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().hide();">&times;</button>
                    <strong>Wrong!</strong> <span></span>
                </div>
                <div class="alert alert-success alert-dismissible fade show" style="display:none">
                    <button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().hide();">&times;</button>
                    <span></span>
                </div>
                <label for="email" class="mb-2">Enter Your Email *</label>
                <input type="text" id="forget_email" name="email" placeholder="Email" class="required" />
                <button type="button" class="btn btn-success btn-lg btn-block mb-2" onClick="fn_forgetPassword();">Get New Password</button>
            </fieldset>
        </form>
    </div>
</div>

<div id="resetpassword-modal" class="resetpassword-modal modal">
    <div class="reset-password-modal-content">
        <form id="reset-password-form" class="modal-form" action="<?php echo e(url('password/reset')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h2 class="text-center mb-2">Reset your password</h2>
            <fieldset style="overflow-y: scroll;">
                <?php if(isset($resetpassword_result)): ?>
                <input type="hidden" id="resetpasswordresult" value="<?php echo e($resetpassword_result); ?>">
                    <?php if($error = $errors->first()): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Wrong!</strong> <?php echo e($error); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <input type="hidden" name="token" value="<?php echo e(session('token')); ?>">
                <label for="username" class="mb-2">Your Username *</label>
                <input type="text" name="username" placeholder="Username" class="required" value="<?php echo e(session('username')); ?>" readonly/>
                <label for="email" class="mb-2">Your Email *</label>
                <input type="text" name="email" placeholder="Email" class="required" value="<?php echo e(session('email')); ?>" readonly/>
                <label for="password">Password *</label>
                <input type="password" name="password" placeholder="Password" class="required" />
                <label for="password_confirmation">Password Confirmation *</label>
                <input type="password" name="password_confirmation" placeholder="Password Confirmation" class="required" />
                <button type="submit" class="btn btn-success btn-lg btn-block mb-2">Reset Your Password</button>
            </fieldset>
        </form>
    </div>
</div>

<div id="nobalance-modal" class="modal">
    <div class="nobalance-modal-content">
        <div>
            <center>
                <h4>TODAY’S  DEAL: 1ST DEPOSIT<br/>
100% BONUS UP TO 300$ + 200 FREE SPINS<br/>
DEPOSIT NOW TO GET IT!</h4></center>
<br/>
        </div>
        <div style="text-align: center;">
            <a href="javascript:fn_profile_load('deposit')">
                <span>CLAIM BONUS</span>
            </a>

        </div>
    </div>
</div>




<?php /**PATH D:\00work\06casino\canada777\resources\views/component/frontend/layout/auth.blade.php ENDPATH**/ ?>