<?php $__env->startSection('title'); ?>
Création d'un cours
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
	<h1 class="title lg text-center">
		Création d'un cours
	</h1>
	<form id="creat-cours" action="<?php echo e(route('poles.cours.store')); ?>" method="post" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>

		<div class="form-group">
			<h4 class="title lg text-left">
				Titre
			</h4>

			<input id="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title" value="<?php echo e(old('title')); ?>" required autocomplete="title" autofocus>

			<?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
			<span class="invalid-feedback" role="alert">
				<strong><?php echo e($message); ?></strong>
			</span>
			<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
		</div>

		<div class="form-group">
			<h4 class="title lg text-left">
				Description
			</h4>

			<div class="control">
				<textarea class="form-control <?php $__errorArgs = ['desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> desc" id="desc" name="desc" rows="5" required><?php echo e(old('desc')); ?></textarea>
			</div>

			<?php $__errorArgs = ['desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				<span class="invalid-feedback" role="alert">
					<strong><?php echo e($message); ?></strong>
				</span>
			<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
		</div>

		<h4 class="title lg text-left">
			Créateurs
		</h4>
		<select class="custom-select" name="creators[]" id="creators" size="4" required multiple>
            <option readonly selected hidden value="">Créateurs</option>

            <?php if(isset($users)): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php echo e(auth()->user()->is($user) ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>


		<div class="form-group">
			<h4 class="title lg">
				Image pour la vignette du cours (optionnelle)
			</h4>
			<input type="file" id="image_crs" name="image_crs">
		</div>


		<div class="form-group">
			<h4 class="title lg text-left">
				Fichiers associés
			</h4>

			<input type="file" id="link_support" name="link_support[]" multiple>
		</div>

		<h4 class="title lg text-left" id="choose-visibility">
			Cochez les fichiers réservés aux membres
		</h4>
		<div class="form-group" id="choose-visibility">
		</div>

		<h4 class="title lg">
			Dates du cours
		</h4>
		<div class="row justify-content-around dates-select">
			<div class="col-md-auto">
				<h6 class="title text-center">
					Dates en présentiels
				</h6>
				<div class="dates-pres text-center">
					<div id="calendar-pres">
						<div id="cal-pres-dates">

						</div>
					</div>
				</div>
			</div>

			<div class="col-md-auto">
				<h6 class="title text-center">
					Dates en distanciels
				</h6>
				<div class="dates-dist">
					<div id="calendar-dist">
						<div id="cal-dist-dates">

						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="dates-crs">

		</div>


		<div class="text-center" style="margin-top:25px; margin-bottom:25px">
			<button id="submit-btn-crt-crs" type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
		</div>
	</form>
</div>
<script>
	var elePres = document.getElementById('calendar-pres');
	if(elePres)
	{
		elePres.style.visibility = "visible";
	}

	var eleDist = document.getElementById('calendar-dist');
 	if(eleDist)
	{
 		eleDist.style.visibility = "visible";
 	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/poles/cours/create.blade.php ENDPATH**/ ?>