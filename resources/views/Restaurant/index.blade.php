<x-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/restaurant-card.css') }}">
    <div class="main">
        @unless($restaurants->isEmpty())
            @foreach($restaurants as $restaurant)
                <x-restaurant-card :restaurant="$restaurant"/>
            @endforeach
        @else 
            <p>No Items Found!</p>
        @endunless
    </div>
</x-layout>
