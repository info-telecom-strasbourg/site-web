<?php $__env->startSection('title', 'Projets'); ?>

<?php $__env->startSection('breadcrumb'); ?>
	<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
	<li class="breadcrumb-item active">Projets</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
	<h1 class="title lg text-center">
        Projets
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
    	<!-- Search bar -->
		<form>
			<div class="input-group md-form form-sm form-2 pl-0">
				<input class="form-control my-0 py-1 lime-border" type="search" name="search" id="search" placeholder="Rechercher" aria-label="Rechercher" value="<?php echo e($search); ?>">
				<button class="input-group-append input-group-text lime lighten-2 btn btn-search" type="submit">
					<i class="fas fa-search text-grey" aria-hidden="true"></i>
				</button>
			</div>
		</form>

    	<!-- Filter options -->
    	<form class="filter-options container">
    		<h2>Filtres</h2>
    		<div class="row">
    			<div class="col-md-3">
					<select class="form-control" name="pole" id="pole">
						<option readonly selected hidden value="">Pôle</option>

						<?php if(isset($poles)): ?>
							<?php $__currentLoopData = $poles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($key + 1); ?>" <?php if($filters[0] == ($key + 1)): ?> selected <?php endif; ?>><?php echo e($pole->title); ?> </option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<option value="" name="reset">Reset</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="membre" id="membre">
						<option readonly selected hidden value="">Membre</option>

						<?php if(isset($participants)): ?>
							<?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($key + 1); ?>" <?php if($filters[1] == ($key + 1)): ?> selected <?php endif; ?>><?php echo e($participant->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<option value="" name="reset">Reset</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="partner" id="partner">
						<option readonly selected hidden value="">Collaborateurs</option>

						<?php if(isset($partners)): ?>
							<?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($key + 1); ?>" <?php if($filters[2] == ($key + 1)): ?> selected <?php endif; ?>><?php echo e($partner->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<option value="" name="reset">Reset</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="trie" id="trie">
						<option readonly selected hidden value="">Trié par</option>

						<option value="1" <?php if($filters[3] == 1): ?> selected <?php endif; ?>>Ordre alphabétique</option>
	                    <option value="2" <?php if($filters[3] == 2): ?> selected <?php endif; ?>>Ordre alphabétique inverse</option>
	                    <option value="3" <?php if($filters[3] == 3): ?> selected <?php endif; ?>>Date de début</option>

	                    <option value="" name="reset">Reset</option>
					</select>
				</div>
				<div class="col-md-3 text-center">
					<button type="submit" class="btn btn-primary btn-primary btn-rounded">FILTRER</button>
				</div>
			</div>
		</form>

		<div class="container pt-5">
			<div class="row justify-content-center">

				<?php if(isset($projets)): ?>

					<?php $__empty_1 = true; $__currentLoopData = $projets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<div class="col-md sep-items" id="projets-container">
							<div class="card text-center rounded">
								<img class="card-img-top" src="/images/test.jpg" alt="Card image cap">
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
			<div class="row justify-content-center link-margin-top">
						<!-- Pagination links -->
						<?php echo e($projets->links()); ?>

					</div>
		</div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/projets/index.blade.php ENDPATH**/ ?>