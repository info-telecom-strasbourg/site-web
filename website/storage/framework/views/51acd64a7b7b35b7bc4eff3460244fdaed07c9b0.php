<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="content-fluid">
        <h1 class="title lg text-center">
            Pôle <?php echo e($pole->title); ?>

        </h1>
        <hr class="line-under-title">
        <div>
            <h4 class="title md text-left">Edition</h4>
			<form action="/poles/<?php echo e($pole->id); ?>" method="POST">
				<?php echo csrf_field(); ?>
				<?php echo method_field('PUT'); ?>

				<!-- Titre -->
				<div class="form-group">
					<label class="label" for="title">Titre</label>
					<div class="control">
						<input class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" value="<?php echo e($pole->title); ?>" id="title" name="title" required>
					</div>
				</div>
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

				<!-- Decription -->
				<div class="form-group">
					<label class="label" for="desc">Decription</label>
					<div class="control">
						<textarea class="form-control desc <?php $__errorArgs = ['desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="desc" name="desc" rows="3" required><?php echo e($pole->desc); ?></textarea>
					</div>
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

				<!-- Bouton submit -->

				<div class="text-center" style="margin-top:25px; margin-bottom:25px">
					<button type="submit" class="btn btn-primary btn-rounded">Edit</button>
				</div>

			</form>
		</div/>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/poles/edit.blade.php ENDPATH**/ ?>