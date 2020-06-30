<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle <?php echo e(ucfirst($pole->title)); ?>

        </h1>
        <hr class="line-under-title">
        <div>
            <p><?php echo e($pole->desc); ?></p>
            <h4 class="title md text-left"><?php echo e($pole->title); ?></h4>

			<!-- Liste des projets -->
			<div class="container pt-5">
				<div class="row justify-content-center">

					<?php if(isset($pole->projets)): ?>

						<?php $__empty_1 = true; $__currentLoopData = $pole->projets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

							<div id="proj-card" class="col-md-auto sep-items">
								<div class="card text-center rounded">
									<img class="card-img-top" src="<?php echo e(asset('storage/'.json_decode($projet->images)[0])); ?>" alt="Card image cap">
									<div class="card-body d-flex flex-column">
										<h5 class="card-title text-center font-weight-bold">
											<?php echo e($projet->title); ?>

										</h5>
										<p class="card-text">
											<span><?php echo e(mb_strlen( $projet->desc ) > 200 ? mb_substr($projet->desc, 0, 200) . ' ...' : $projet->desc); ?>

			                                </span>
										</p>
										<a href="/projets/<?php echo e($projet->id); ?>" class="btn btn-rounded btn-primary" type="button">DÉCOUVRIR</a>
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

			<!-- Bouton "Voir-plus" -->
			<?php if(isset($pole->projets) && $pole->projets->count() > 8): ?>
		        <div id="line-btn-vp" class="d-flex justify-content-center">
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		          <div class="p-2 bd-highlight"><input id="voir-plus" class="btn btn-rounded btn-primary" type="button" value="Voir-plus"></div>
		          <div class="p-2 bd-highlight flex-grow-1"><hr class="line-voir-plus"></div>
		        </div>
			<?php endif; ?>



			<h4 class="title md text-left">Responsable <?php echo e($pole->title); ?></h4>
			<div class="text-left">
				<a href="#" class="link-member">
					<img src="<?php echo e(asset('storage/'.json_decode($pole->respo->profil_picture)[0])); ?>" class="profil-rounded mr-md-3"/>
					<?php echo e($pole->respo->name); ?>

				</a>
			</div>
			<?php if(auth()->guard()->check()): ?>
				<?php if( $pole->respo->id == Auth::user()->id): ?>
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-rounded" onclick="self.location.href='/poles/<?php echo e($pole->id); ?>/edit'">Edit</button>
					</div>
				<?php endif; ?>
			<?php endif; ?>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<!--
Bouton Edit si on est le respo
 -->

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/poles/show.blade.php ENDPATH**/ ?>