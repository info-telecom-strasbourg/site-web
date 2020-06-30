<?php $__env->startSection('title', "Projet ITS - ". $projet->title); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/projets?page=<?php echo e(intval($projet->id / 24) + 1); ?>">Projets</a></li>
<li class="breadcrumb-item active"><?php echo e($projet->title); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container" id="projet">
    <h1 class="title lg text-center">
        <?php echo e($projet->title); ?>

    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <p><?php echo e($projet->desc); ?></p>
        <div class="bordure"></div>
        <h4 class="title md text-center">Chef de projet</h4>
            <div class="card p-2 rounded chef-projet" style="max-width: 220px; cursor: pointer;">
				<a href="/users/<?php echo e($projet->chef->id); ?>" class="user-link">
	                <div class="row no-gutters align-items-center" style="flex-wrap: unset">
	                    <div class="col-md-4" style="max-width: 60px;">
	                        <img src="<?php echo e(asset('storage/'.json_decode($projet->chef->profil_picture)[0])); ?>" class="card-img">
	                    </div>
	                    <div class="col-md-8">
	                        <div class="card-body">
	                            <p class="card-title" style="margin-bottom: 0;"> <?php echo e($projet->chef->name); ?></p>
	                        </div>
	                    </div>
	                </div>
				</a>
            </div>

        <?php if(!$projet->participants->isEmpty()): ?>
        <div class="bordure"></div>
        <h4 class="title md text-center">Participants</h4>
        <?php $__currentLoopData = $projet->participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p><?php echo e($participant->name); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(!empty($projet->collaborateur)): ?>
        <div class="bordure"></div>
        <h4 class="title md text-center">Collaborateurs</h4>
        <p><?php echo e($projet->collaborateur->name); ?></p>
        <?php endif; ?>
        <div class="bordure"></div>
        <h4 class="title md text-center">Le projet en images</h4>
        <div style="display : flex; justify-content :center; margin-top: 40px; margin-bottom: 40px;">
            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo e(asset('storage/'.json_decode($projet->images)[0])); ?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="/images/illustrations/prog.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="/images/illustrations/prog.jpg" alt="Third slide">
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="background-color: #1b1b1b; width: 40px; height: 40px; border-radius: 50%; top: 50%; margin-left: 10px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="background-color: #1b1b1b; width: 40px; height: 40px; border-radius: 50%; top: 50%; margin-right: 10px;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="bordure"></div>
        <h4 class="title md text-center">Liens utiles</h4>
        <div class="social-buttons row align-item-center justify-content-center" id="projet-show">
            <a class="social-icons d-flex align-items-center" href="<?php echo e($projet->link_github); ?>">
                <i class="fab fa-github fa-3x fa-lg mr-3"></i>Github
            </a>
            <?php if(!empty($projet->link_download)): ?>
            <a class="social-icons d-flex align-items-center" href="<?php echo e($projet->link_download); ?>">
                <i class="fas fa-download fa-3x fa-lg mr-3"></i>Téléchargement
            </a>
            <?php endif; ?>
            <a class="social-icons d-flex align-items-center" href="<?php echo e($projet->link_doc); ?>">
                <i class="fas fa-envelope fa-3x fa-lg mr-3"></i>Documentation
            </a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/projets/show.blade.php ENDPATH**/ ?>