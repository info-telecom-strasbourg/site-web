<div id="line-btn-vp-{{ $id }}" class="d-flex justify-content-center">
    <div class="p-2 bd-highlight flex-grow-1">
        <hr class="line-voir-plus">
    </div>
    <div class="p-2 bd-highlight">
        <input id="voir-plus" class="btn btn-rounded btn-primary" type="button"
            value="Voir plus" onclick="seeMore('{{ $element }}', 'div#line-btn-vp-{{ $id }}')">
    </div>
    <div class="p-2 bd-highlight flex-grow-1">
        <hr class="line-voir-plus">
    </div>
</div>