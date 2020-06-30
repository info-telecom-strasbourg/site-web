<?php $__env->startSection('title', "ITS"); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Besoin d'aide</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section id="besoin-aide">
    <h1 class="title lg text-center"> Besoin d'aide </h1>
    <hr class="line-under-title">
    <div class="formulaire-besoin-aide">
        <?php if(auth()->guard()->guest()): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 50px">
                Veuillez-vous <strong><a href="/login">connecter</a></strong> pour accéder à ce service.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php else: ?>
            <form class="contact-form d-flex flex-column align-items-center" action="https://formspree.io/youremail@mail.com" method="POST">
                <div class="form-group" style="width: 100%;">
                    <label for="exampleFormControlSelect1">Type de demande</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Connexion Wi-Fi Eduroam automatique</option>
                        <option>Synconisation boîte mail Unistra sur boîte mail perso</option>
                        <option>Besoin d'une machine virtuelle</option>
                        <option>Problème avec un logiciel</option>
                        <option>Fichiers supprimés par erreur</option>
                        <option>Problème avec le terminal</option>
                        <option>Utilisation git</option>
                        <option>Autre</option>
                    </select>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label for="exampleFormControlSelect1">Appareil</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Ordinateur</option>
                        <option>Téléphone</option>
                    </select>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label for="exampleFormControlSelect1">Système d'exploitation</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>Linux</option>
                        <option>Windows</option>
                        <option>Android</option>
                        <option>iOS</option>
                    </select>
                </div>
                <div class="form-group" style="width: 100%;">
                    <label for="exampleFormControlFile1">Images</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-group" style="width: 100%;">
                    <label for="exampleFormControlFile1">Description de la demande</label>
                    <textarea class="form-control" type="text" placeholder="Message" rows="9" name="name" style="resize: none;" required></textarea>
                </div>
                <button type="submit" class="btn btn-rounded btn-primary" style="width: 200px;">Envoyer</button>
            </form>
        <?php endif; ?>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/hugo/Documents/Info/Web/site-web/website/resources/views/besoin-aide.blade.php ENDPATH**/ ?>