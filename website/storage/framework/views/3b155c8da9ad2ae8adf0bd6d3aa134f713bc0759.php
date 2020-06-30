<?php $__env->startSection('title', "Membres ITS - ". $user->name); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="/users">Membres</a></li>
    <li class="breadcrumb-item active"><?php echo e($user->name); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <h1 class="title lg text-center">
        Profil - <?php echo e($user->name); ?>

    </h1>
    <hr class="line-under-title">
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/users/show.blade.php ENDPATH**/ ?>