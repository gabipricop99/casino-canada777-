
<?php $__env->startSection('content'); ?>
<div class="navigation-sibling">
    <div class="layout-column layout-column-1" data-column-id="column-1" id="column-1">
        <div class="portlet-dropzone portlet-column-content fn-portlet-container column-1">
            <div class="portlet portlet-wrapper fn-portlet-wrapper portlet-boundary portlet-56 portlet_type_no-border">
                <div class="fn-portlet portlet__content portlet__content_border_none portlet__content_type_56 ">
                    <article data-web-content-id="ACCOUNT_VERIFICATION">
                        <div class="generic-text-wrapper">
                            <h1>Account Verification</h1>
                            <div class="account-verification-wrapper">
                                <div class="account-verification-header">
                                    <p> <?php if($adminVerified == -1): ?>
                                            To verify your account and continue playing at canada777.com. Please upload the requested documents below. 
                                        <?php elseif($adminVerified == 0 && $idVerified && $addressVerified): ?> 
                                            You have already submit verify documents. Please wait until verify will be finished. 
                                        <?php elseif($adminVerified == 1): ?>  
                                            You have already verified.
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <?php if(!$idVerified || !$addressVerified): ?>
                                <div class="account-verification-body">
                                    <div class="box-wrapper">
                                        <div class="line">
                                            <div class="box-item" name="idArea">
                                                <a href="javascript:javascript:void(0);" target="_self">
                                                    <img class="box-content" id="idImage" src="/frontend/Page/image/account-verification-id.png" <?php if(!$idVerified): ?> onClick="uploadImg('id');"<?php endif; ?>>
                                                    <?php if(!$idVerified): ?>
                                                    <img class="plus-icon" id="addIdImage" src="/frontend/Page/image/account-verification-link.png" onClick="uploadImg('id');">
                                                    <?php else: ?>
                                                    <img class="plus-icon" id="addIdImage" src="/frontend/Page/image/account-verification-submit.png">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="box-item" name="addressArea">
                                                <a href="javascript:javascript:void(0);"> 
                                                    <img class="box-content" id="addressImage" src="/frontend/Page/image/account-verification-address.png" <?php if(!$addressVerified): ?>  onClick="uploadImg('address');"<?php endif; ?>>
                                                    <?php if(!$addressVerified): ?>
                                                    <img class="plus-icon" id="addAddressImage" src="/frontend/Page/image/account-verification-link.png" onClick="uploadImg('address');">
                                                    <?php else: ?>
                                                    <img class="plus-icon" id="addAddressImage" src="/frontend/Page/image/account-verification-submit.png">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <input type="file" id="imageFile" style="display:none" accept="image/*">
                                            <input type="text" id="imageType" style="display:none">
                                        </div>
                                    </div>
                                    <div class="line-item">
                                        <p>*Max Size 20MB.</p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.Default.user.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\00work\06casino\canada777\resources\views/frontend/Default/user/verify.blade.php ENDPATH**/ ?>