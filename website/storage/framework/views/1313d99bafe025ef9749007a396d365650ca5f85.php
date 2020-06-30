<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Pôle <?php echo e(ucfirst($pole->title)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle <?php echo e(ucfirst($pole->title)); ?>

        </h1>
        <hr class="line-under-title">
        <div>
            <p><?php echo e($pole->desc); ?></p>
            <h4 class="title md text-left">Liste des cours</h4>
			<div class="container">
				<div class="container pt-5">
					<div class="row justify-content-center">

						<?php if(isset($cours)): ?>
							<?php $__empty_1 = true; $__currentLoopData = $cours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

								<div id="proj-card" class="col-md-auto sep-items">
									<div class="card text-center rounded">
										<img class="card-img-top" src="<?php echo e(asset('storage/'.json_decode($cour->image)[0])); ?>" alt="Card image cap">
										<div class="card-body d-flex flex-column">
											<h5 class="card-title text-center font-weight-bold">
												<?php echo e($cour->title); ?>

											</h5>
											<p class="card-text">
												<span><?php echo e(mb_strlen( $cour->desc ) > 200 ? mb_substr($cour->desc, 0, 200) . ' ...' : $cour->desc); ?>

				                                </span>
											</p>
											<a href="/poles/cours/<?php echo e($cour->id); ?>" class="btn btn-rounded btn-primary" type="button">DÉCOUVRIR</a>
										</div>
								  	</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

							<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
								Aucun projets n'a été trouvé
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    					<span aria-hidden="true">&times;</span>
			  					</button>
							</div>
							<?php endif; ?>

						<?php else: ?>
						<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
							Aucun projets n'a été trouvé
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		  					</button>
						</div>

						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if(isset($cours) && $cours->count() > 6): ?>
		        <div id="line-btn-vp" class="d-flex justify-content-center">
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		          <div class="p-2 bd-highlight"><input id="voir-plus" class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		        </div>
			<?php endif; ?>

			<?php if(auth()->guard()->check()): ?>
				<div class="text-center" style="margin-top:25px; margin-bottom:25px">
					<a class="btn btn-primary btn-rounded" href="/poles/cours/create">Créer un cours</a>
				</div>
			<?php endif; ?>


	    </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<!--
Bouton edit si on est le créateur du cours_id
Lien vers la page du cours
Mise en page
 -->

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/poles/cours/index.blade.php ENDPATH**/ ?>