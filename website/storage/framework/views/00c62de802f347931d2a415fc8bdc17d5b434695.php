<!DOCTYPE html>
<html lang="fr" local="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel = "icon" href = "<?php echo e(asset('images/logo/logo.png')); ?>" type = "image/x-icon">

    <link rel = "icon" href = "<?php echo e(asset('images/logo/logo.png')); ?>" type = "image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Font awesome icons -->
    <link href="<?php echo e(URL::asset('lib/fontawesome/css/all.css')); ?>" rel="stylesheet">

    <!-- CSS -->
	<!-- ####################################"" -->
	<link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css" rel="stylesheet">
	<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>
	<!-- ####################################"" -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/fonts.css')); ?>">

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>


    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='https://cdn.rawgit.com/JacobLett/IfBreakpoint/e9fcd4fd/if-b4-breakpoint.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title><?php echo $__env->yieldContent('title'); ?></title>

</head>

<body>
    <!-- Navbar -->
    
    <?php if(!Request::is('page-admin') && !Request::is('login') && !Request::is('password/*')): ?>
        <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if(Request::is('page-admin')): ?>
        <style>
            body {
                background-color: #131722;
            }

            .page-footer {
                background-color: #20242e;
            }
        </style>
    <?php endif; ?>

    
    <?php if(!Request::is('/')): ?>
        <style>
            .navbar {
                background-color: rgb(92, 111, 163);
            }
        </style>
    <?php endif; ?>

    <div class="page">

        <!-- Main content -->
        <div id="content">
            <!-- Breadcrumbs -->
            <?php if(!Request::is('/') && !Request::is('page-admin') && !Request::is('login') && !Request::is('password/*')): ?>
            <div class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                </ol>
            </div>
            <?php endif; ?>

            <div class="main-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

        </div>

        <!-- Footer -->
        <?php if(!Request::is('login') && !Request::is('password/*')): ?>
        <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <script src="<?php echo e(asset('js/website.js')); ?>"></script>
</body>

</html>
<?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/layouts/layout.blade.php ENDPATH**/ ?>