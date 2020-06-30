<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="/poles/cours">Pôle Cours</a></li>
<li class="breadcrumb-item"><a href="/poles/cours/<?php echo e($cours->id); ?>"><?php echo e($cours->title); ?></a></li>
<li class="breadcrumb-item active">Édition</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Modification d'un cours
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
	<h1 class="title lg text-center">
		Modification du cours: <?php echo e($cours->title); ?>

	</h1>
	<hr class="line-under-title">
	<form class="" action="/poles/cours/<?php echo e($cours->id); ?>" method="POST" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		<?php echo method_field('PUT'); ?>

		<!-- Pour le titre -->
		<h4 class="title md text-left">Titre</h4>
		<div class="form-group">
			<input id="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title" value="<?php echo e($cours->title); ?>" required autocomplete="title" autofocus>

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

		<!-- Pour la description -->
		<h4 class="title md text-left">Description</h4>
		<div class="form-group">
			<div class="control">
				<textarea class="form-control desc <?php $__errorArgs = ['desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="desc" name="desc" rows="5" required><?php echo e($cours->desc); ?></textarea>
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
			Ajouter des créateurs
		</h4>
		<select class="form-control" name="creators[]" id="creators" multiple>
            <option readonly selected hidden value="">Créateurs</option>

            <?php if(isset($users)): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>

		<div class="form-group">
			<h4 class="title lg">
				Changement de la vignette du cours
			</h4>
			<input type="file" id="image_crs" name="image_crs">
		</div>

		<!-- Pour ajouter un/des fichiers -->
		<h4 class="title md text-left">Ajouter des fichiers</h4>
		<div class="form-group">
			<input type="file" id="link_support_mod" name="link_support[]" multiple>
		</div>

		<!-- Pour modifier des fichiers -->
		<h4 class="title md text-left">Choisir le status des fichiers des fichiers</h4>
		<div class="form-group <?php echo e(!empty($cours->supports[0]) ? 'to-hide' : ''); ?>" id="choose-new-statut">
		<?php $__empty_1 = true; $__currentLoopData = $cours->supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

			<div class="row justify-content-start">
				<div class="col-auto">
					<?php echo e($support->name); ?>

				</div>
				<div class="col-auto">
					<div class="form-group">
						<select class="form-control form-control-sm" name="visibility_change[<?php echo e($support->id); ?>]">
							<option value="0" <?php echo e($support->visibility == 0 ? 'selected' : ' '); ?>>Public</option>
							<option value="1" <?php echo e($support->visibility == 1 ? 'selected' : ' '); ?>>Privé</option>
							<option value="2">Supprimer</option>
						</select>
					</div>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

		<?php endif; ?>
		</div>


		<!-- Modifier les dates -->
		<div class="row justify-content-around dates-select">
			<div class="col-md-auto">
				<h4 class="title lg text-left">
					Dates en présentiels
				</h4>
				<div class="dates-pres">
					<div id="calendar-pres-upd">
			        	<div id="cal-pres-dates-upd">

			        	</div>
	    			</div>
				</div>
			</div>

			<div class="col-md-auto">
				<h4 class="title lg text-left">
					Dates en distanciels
				</h4>
				<div class="dates-dist">
					<div id="calendar-dist-upd">
			        	<div id="cal-dist-dates-upd">

			        	</div>
	    			</div>
				</div>
			</div>
		</div>

		<div id="dates-crs">

		</div>


		<div class="text-center" style="margin-top:25px; margin-bottom:25px">
			<button id="submit-btn-edt-crs" type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
		</div>
	</form>
</div>
<script>
	var elePresUpd = document.getElementById('calendar-pres-upd');
	if(elePresUpd)
	{
		elePresUpd.style.visibility = "visible";
	}

	var eleDistUpd = document.getElementById('calendar-dist-upd');
	if(eleDistUpd)
	{
		eleDistUpd.style.visibility = "visible";
	}

	var calendarPresUpd = new ej.calendars.Calendar({
		isMultiSelection: true,
		values:[]
	});

	var calendarDistUpd = new ej.calendars.Calendar({
		isMultiSelection: true,
		values:[]
	});

	// Search the dates and make them appear into the calendar
	var dateList = '<?php echo e($cours->dates); ?>'.split("},");
	$.each(dateList, function(key, value) {
		var splitedObj = value.split("&quot;");
		if (splitedObj[4] === ":1,")
		   calendarPresUpd.values.push(new Date(splitedObj[7]));
	   else if (splitedObj[4] === ":0,")
		   calendarDistUpd.values.push(new Date(splitedObj[7]));
	});

	calendarPresUpd.appendTo('#cal-pres-dates-upd');
	calendarDistUpd.appendTo('#cal-dist-dates-upd');

	$('#submit-btn-edt-crs').click(function() {
		parseDate(calendarDistUpd.values, 'dates_dist');
		parseDate(calendarPresUpd.values, 'dates_pres');
	});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/poles/cours/edit.blade.php ENDPATH**/ ?>