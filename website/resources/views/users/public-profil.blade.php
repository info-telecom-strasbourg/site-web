<div class="container pt-3">
    <div class="row justify-content-center">
        <!-- Edit profil information -->
        <div class="col-md-6">
            <div class="row justify-content-center align-items-center profil-card profil-edit">

                <!-- Profil image badge -->
                <img class="profil-rounded" src="{{ asset('storage/' . $user->profil_picture) }}" />

                <div id="form-profil-edit">
                    <!-- User's name -->
                    <div class="form-group row justify-content-center col-md-12">
                        <label for="name" class="col-sm-4 col-form-label"><strong>Nom</strong></label>
                        <div class="col-sm-8">
                            <input type="text" id="name" name="name" readonly
                                class="form-control-plaintext custom-form-control" value="{{ $user->name }}">
                        </div>
                    </div>

                    <!-- User's class -->
                    <div class="form-group row justify-content-center col-md-12">
                        <label for="class" class="col-sm-4 col-form-label"><strong>Fillière</strong></label>
                        <div class="col-sm-8">
                            <input type="text" id="class" name="class" readonly
                                class="form-control-plaintext custom-form-control" value="{{ $user->class }}">
                        </div>
                    </div>

                    <!-- User's year -->
                    <div class="form-group row justify-content-center col-md-12">
                        <label for="year" class="col-sm-4 col-form-label"><strong>Promotion</strong></label>
                        <div class="col-sm-8">
                            <input type="text" id="year" name="year" readonly
                                class="form-control-plaintext custom-form-control" value="Promo {{ $user->year }}">
                        </div>
                    </div>

                    <!-- User's Email address -->
                    <div class="form-group row justify-content-center col-md-12">
                        <label for="email" class="col-sm-4 col-form-label"><strong>Mail</strong></label>
                        <div class="col-sm-8">
                            <input type="text" id="email" name="email" readonly
                                class="form-control-plaintext custom-form-control" value="{{ $user->email }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>