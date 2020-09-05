@php
/** Expected parameters when including

- items : collection of items you want to display as cards
- isCover : true if the cover (the image of the card) is to be retrieve with $item->cover, otherwise false
- errorMessage : error Message to display if there are no items
- routeNameShow : name of the route to show an item
- className : name of the class, element if only 6 items should be displayed, else nothing
*/
@endphp

	<div class="row justify-content-center">
        @if(isset($items))
            @forelse ($items as $item)
            @if (isset($isCover) && $isCover == 'true')
                @php $cover = $item->cover; @endphp
            @else
                @php $cover = json_decode($item->images)[0]; @endphp
            @endif
            <div class="col-md sep-items @if (!isset($className)) element @endif">
                <div class="card custom-card text-center rounded">
                    <img class="card-img-top" src="{{ asset('storage/' . $cover) }}" alt="Card image cap">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center font-weight-bold">
                            {{ $item->title }}
                        </h5>
                        <p class="card-text">
                            <span>{{ mb_strlen( $item->desc ) > 57 ? mb_substr($item->desc, 0, 54) . ' ...' : $item->desc }}
                            </span>
                        </p>
                        <a href="{{ route($routeNameShow, $item) }}" class="btn btn-rounded btn-primary">DÉCOUVRIR</a>
                    </div>
                </div>
            </div>
        @empty

            <div class="alert alert-secondary alert-dismissible fade show col" role="alert">
                {{ $errorMessage }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforelse

        @else
            <div class="alert alert-secondary alert-dismissible fade show col" role="alert">
                {{ $errorMessage }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        @endif
    </div>
