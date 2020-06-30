<?php $__env->startSection('title', 'Liste des membres'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Membres</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
	<h1 class="title lg text-center">
        Membres
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

		<p class="total-members">Membres : <?php echo e($nbUsers); ?></p>

		<div class="container pt-5">
			<div class="row">

				<?php if(isset($users)): ?>
					<?php 
						$bureaus = []; 
						$respos = []; 
						$membres = []; 
					?>
					<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<?php if($user->role->poste == 'Bureau'): ?>
							<?php $bureaus[] = $user; ?>
						<?php elseif($user->role->poste == 'Respo'): ?>
							<?php $respos[] = $user; ?>
						<?php elseif($user->role->poste == 'Membre'): ?>
							<?php $membres[] = $user; ?>
						<?php endif; ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

						<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
							Aucun membres n'a été trouvé
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		  					</button>
						</div>
						
					<?php endif; ?>
						
					<?php if($bureaus): ?>
						<h2 class="col-12 title-users">Bureau</h2>
						<?php $__currentLoopData = $bureaus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bureau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-md-3 text-center user">
								<a href="/users/<?php echo e($bureau->id); ?>" class="respo">
						            <img class="profil-rounded" src="images/defaut/profil.jpg">
						            <p id="nom"><?php echo e($bureau->name); ?></p>
						            <p id="fonction"><?php echo e($bureau->role->role); ?></p>
						        </a>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					
					<?php if($respos): ?>
						<h2 class="col-12 title-users">Responsables</h2>
						<?php $__currentLoopData = $respos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $respo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-md-3 text-center user">
								<a href="/users/<?php echo e($respo->id); ?>" class="respo">
						            <img class="profil-rounded" src="images/defaut/profil.jpg">
						            <p id="nom"><?php echo e($respo->name); ?></p>
						            <p id="fonction"><?php echo e($respo->role->role); ?></p>
						        </a>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

					<?php if($membres): ?>
						<h2 class="col-12 title-users">Membres</h2>
						<?php $__currentLoopData = $membres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-md-3 text-center user">
								<a href="/users/<?php echo e($membre->id); ?>" class="respo">
						            <img class="profil-rounded" src="images/defaut/profil.jpg">
						            <p id="nom"><?php echo e($membre->name); ?></p>
						            <p id="fonction"><?php echo e($membre->role->role); ?></p>
						        </a>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

				<?php else: ?>
					<div class="alert alert-secondary alert-dismissible fade show col" role="alert">
						Aucun membres n'a été trouvé
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    					<span aria-hidden="true">&times;</span>
	  					</button>
					</div>
				<?php endif; ?>
			</div>
		</div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/users/index.blade.php ENDPATH**/ ?>