<?php
//$tk = $_GET['tk'];$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL,"https://app.cloakerly.com/v2/verifyToken");
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS,"cid=4218&tk=$tk");
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$r = curl_exec($ch); $d = json_decode($r, true); curl_close ($ch);
//if($d !== false)if(!$d['ss']==true)exit(header(sprintf("Location: %s", $d['s']))); ?>
<!DOCTYPE html>
<html lang="en" class="notranslate" translate="no">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title id="page_title" itemprop="name"><?php echo e(settings('app_name')); ?> ① Online casino in Canada ᐉ Best Canadian Online Casinos 2021</title>
    <meta name="description" content="Check out our full guide about Canadian Gambling sites ✔ Canada777 Be sure that you will be offered ONLY the Best Online Casino in Canada ✔ Reviews from Industry Experts!" />
    <meta property="og:title" content="① Online casino in Canada ᐉ Canada777 Best Canadian Online Casinos 2021" />
    <meta property="og:description" content="Check out our full guide about Canadian Gambling sites ✔ Be sure that you will be offered ONLY the Best Online Casino in Canada ✔ Reviews from Industry Experts!" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://canada777.com/" />
    <meta property="og:image" content="https://canada777.com/blog_images/book-of-dead-3-scatters.mp4" />
    <meta property="og:image:width" content="200" />
    <meta property="og:image:height" content="200" />
    <meta property="og:site_name" content="Casino Canada" />
	<meta name="google" content="notranslate" />
	<meta name="author" content="@donis" />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
	<meta name="keywords" content="Canada777+online+casino" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <link rel='shortcut icon' type='image/x-icon'  href="https://canada777.com/frontend/Page/image/favicon.ico"/>
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-185160427-1"></script>

    <script>

        window.dataLayer = window.dataLayer || [];

        function gtag(){dataLayer.push(arguments);}

        gtag('js', new Date());

        gtag('config', 'UA-185160427-1');

    </script>

    <?php echo $__env->make('component.frontend.layout.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('page_top'); ?>
</head>
<body id="main_body">
    <?php echo $__env->make('component.frontend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main>
    	<?php echo $__env->yieldContent('slider'); ?>
        <?php echo $__env->make('component.frontend.layout.category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('component.frontend.layout.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('component.frontend.layout.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('component.frontend.layout.playfun', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('component.frontend.layout.deposit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
    <?php echo $__env->make('component.frontend.layout.seocontent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('component.frontend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('component.frontend.layout.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('page_bottom'); ?>
</body>
</html>
<?php /**PATH D:\00work\06casino\canada777\resources\views/frontend/Default/layouts/app.blade.php ENDPATH**/ ?>