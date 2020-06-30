<?php $__env->startSection('title', 'Connexion'); ?>

<?php $__env->startSection('content'); ?>

<style>
    #content {
        padding-bottom: 0;    /* Footer height */
    }
</style>

<div class="login-container full-screen">
    <div class="container text-center">
        <div class="row justify-content-center min-vh-100">
            <div class="col">
                <div class="d-flex flex-column h-100">
                    <div class="row justify-content-center d-flex flex-column">
                        <h1 class="h1">Se connecter</h1>
                        <p>Heureux de vous revoir !</p>
                        <p>
                            <a href="/#contact" class="respo-support">Envoyez nous un message</a> pour devenir membre <br> et pouvoir vous connecter.
                        </p>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="form-container">
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                            <div class="form-group email-group">
                                <label for="email">E-MAIL</label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="Entrer l'email">
                                    <?php $__errorArgs = ['email'];
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

                            <div class="form-group password-group">
                                <label for="passowrd">MOT DE PASSE</label>
                                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Entrer votre mot de passe">

                                    <?php $__errorArgs = ['password'];
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

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <?php if(Route::has('password.request')): ?>
                                        <a href="<?php echo e(route('password.request')); ?>" class="password-forget">
                                            Mot de passe oublié ?
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                        <label class="form-check-label" for="remember">
                                            <?php echo e(__('Remember Me')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>

                            

                            <button type="submit" class="favorite styled">SE CONNECTER</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// permet de faire en sorte que le carousel fasse exactement la taille de l'écran
// de l'utilisateur

// $(window).on('resize', function() {
//     $wHeight = $(document).height();
//     $item.height($wHeight);
// });
</script>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/auth/login.blade.php ENDPATH**/ ?>