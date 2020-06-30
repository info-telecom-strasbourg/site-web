<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/poles/cours">Pôle Cours</a></li>
<li class="breadcrumb-item active"><?php echo e($cours->title); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container" id="cours">

	<div class="content-fluid">
		<h1 class="title lg text-center">
			<?php echo e($cours->title); ?>

		</h1>
		<hr class="line-under-title">
		<div>
			<div class="container" id="description" style="margin-top: 50px;">
				<div class="row">
					<div class="col-3 disp">
						<img src="<?php echo e(asset('storage/'.json_decode($cours->image)[0])); ?>" alt="Decriptive image">
					</div>
					<div class="col-9 disp">
						<p><?php echo e($cours->desc); ?></p>
					</div>
				</div>
			</div>
			<div class="bordure"></div>
			<h4 class="title md text-center">Créateurs du cours</h4>
			<!-- Créateurs -->
			<div class="container pt-5" style="padding-top: 1rem !important; margin-bottom: -35px;">
				<div class="row align-items-center">
					<?php if(isset($cours)): ?>
					<?php $__empty_1 = true; $__currentLoopData = $cours->creators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<div class="col-md-auto sep-items">
						<a href="/users/<?php echo e($creator->id); ?>" class="user-link">
							<div class="card p-2 rounded" style="max-width: 220px; cursor: pointer;">
								<div class="row no-gutters align-items-center" style="flex-wrap: unset">
									<div class="col-md-4" style="max-width: 60px;">
										<img src="<?php echo e(asset('storage/'.json_decode($creator->profil_picture)[0])); ?>" class="card-img">
									</div>
									<div class="col-md-8">
										<div class="card-body">
											<h5 class="card-title" style="margin-bottom: 0;"> <?php echo e($creator->name); ?></h5>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<div>
						Ce cours a été créé par un anonyme
					</div>
					<?php endif; ?>
					<?php else: ?>
					<h4 class="title md text-center">Ce cours n'existe pas</h4>
					<?php endif; ?>
				</div>
			</div>

			<!-- Dates en présentiels -->
			<div class="bordure"></div>
			<h4 class="title md text-center">Dates en présentiels</h4>
			<div class="container" style="margin-top: 30px;">
				<?php if(isset($cours)): ?>
				<?php $__empty_1 = true; $__currentLoopData = $cours->dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<?php if($date->presentiel == 1): ?>
				<div class="row align-items-center">
					<div class="col-auto sep-chevr">
						<i id="chevron-date-supports" class="far fa-calendar-alt fa-2x">
						</i>
					</div>
					<div class="col sep-chevr">
						<?php echo e(\Carbon\Carbon::parse($date->date)->translatedFormat('l d F Y')); ?>

					</div>
				</div>
				<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				<?php endif; ?>

				<?php else: ?>
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				<?php endif; ?>
			</div>

			<!-- Dates en distanciels -->
			<div class="bordure"></div>
			<h4 class="title md text-center">Dates en distanciels (sur Discord)</h4>
			<div class="container" style="margin-top: 30px;">
				<?php if(isset($cours)): ?>
				<?php $__empty_1 = true; $__currentLoopData = $cours->dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<?php if($date->presentiel == 0): ?>
				<div class="row align-items-center">
					<div class="col-auto sep-chevr">
						<i id="chevron-date-supports" class="far fa-calendar-alt fa-2x">
						</i>
					</div>
					<div class="col sep-chevr">
						<?php echo e(\Carbon\Carbon::parse($date->date)->translatedFormat('l d F Y')); ?>

					</div>
				</div>
				<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				<?php endif; ?>

				<?php else: ?>
				<div>
					Aucune date n'est prévue pour ce cours
				</div>
				<?php endif; ?>
			</div>


			<!-- Références -->
			<?php if(isset($cours->links)): ?>
			<div class="bordure"></div>
			<h4 class="title md text-center">Références</h4>
			<?php $__currentLoopData = json_decode($cours->links, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="row align-items-center">
				<div class="col-auto sep-chevr">
					<i id="chevron-date-supports" class="fas fa-chevron-right fa-2x">
					</i>
				</div>
				<div class="col sep-chevr">
					<a href="<?php echo e($link); ?>" class="link-black" target="_blank"><?php echo e($link); ?></a>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>


			<!-- Supports -->
			<?php if(!empty($cours->supports[0])): ?>
			<div class="bordure"></div>
			<h4 class="title md text-center">Support</h4>
			<!-- Bouton pour DL le support -->
			<!-- TODO dans autres pages -->
			<div id="select-files" class="container">
				<?php $__currentLoopData = $cours->supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row align-items-center">
					<?php if($support->visibility == 1): ?>
					<?php if(auth()->guard()->check()): ?>
					<a class="link-black row align-items-center" href="/download/<?php echo e($support->id); ?>">
						<div class="col-auto sep-chevr">
							<i id="chevron-date-supports" class="fas fa-download fa-2x"></i>
						</div>
						<div class="bd-highlight col sep-chevr">
								<?php echo e($support->name); ?>

						</div>
					</a>
					<div class="w-100"></div>
					<?php endif; ?>
					<?php else: ?>
					<a class="link-black row align-items-center" href="/download/<?php echo e($support->id); ?>">
						<div class="col-auto sep-chevr">
							<i id="chevron-date-supports" class="fas fa-download fa-2x"></i>
						</div>
						<div class="bd-highlight col sep-chevr">
								<?php echo e($support->name); ?>

						</div>
					</a>
					<div class="w-100"></div>
					<?php endif; ?>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<?php endif; ?>

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $cours)): ?>
			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<a class="btn btn-primary btn-rounded" href="/poles/cours/<?php echo e($cours->id); ?>/edit">Editer</a>
			</div>
			<div class="text-center" style="margin-top:25px; margin-bottom:25px">
				<a class="btn btn-primary btn-rounded" href="/poles/cours/<?php echo e($cours->id); ?>/destroy">Supprimer</a>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<!--
Les dates
Les sources (links)
 -->

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/poles/cours/show.blade.php ENDPATH**/ ?>