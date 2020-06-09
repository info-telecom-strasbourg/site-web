// Permet de faire évoluer la couleur de la barre de navigation (de transparent 
// à bleu) en scrollant

$(document).on('scroll', function(e) {
    var rgba = $(document).scrollTop() / 500;
    $('.fixed-top').css('background-color', 'rgba(92, 111, 163,' + rgba + ')');

})