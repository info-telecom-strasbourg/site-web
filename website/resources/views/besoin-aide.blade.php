@extends('layouts.layout')

@section('title', "ITS")

@section('breadcrumb')

@endsection

@section('content')

<section id="besoin-aide">
    <h1 class="title lg text-center"> Besoin d'aide </h1>
    <hr class="line-under-title">
    <div class="formulaire-besoin-aide">
        <form class="contact-form d-flex flex-column align-items-center" action="https://formspree.io/youremail@mail.com" method="POST">
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlSelect1">Type de problème</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlSelect1">Appareil</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlSelect1">Système d'exploitation</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group" style="width: 100%;">
                <label for="exampleFormControlFile1">Images</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group" style="width: 100%;">
            <label for="exampleFormControlFile1">Description du problème</label>
                <textarea class="form-control" type="text" placeholder="Message" rows="9" name="name" style="resize: none;" required></textarea>
            </div>
            <button type="submit" class="btn btn-rounded btn-primary" style="width: 200px;">Envoyer</button>
        </form>
    </div>
</section>


@endsection