{{-- Display card for each restaurant --}}
@props(['restaurant'])
<x-card>
    <a class="main1" href="/restaurant/{{ $restaurant->id }}">
        <img src="{{$restaurant->logo ? asset('storage/'. $restaurant->logo) : asset('assets/images/default-restaurant-img.png')}}" alt="">
        <div class="d1">
            <span class="name">{{$restaurant->name}}</span>
            <span class="rev"><span id="reviews">{{$restaurant->reviews}}</span><i class="fa-solid fa-star"></i></span>
        </div>
        <div class="d2">
            <span class="des">{{$restaurant->description}}</span>
            {{-- <span class="price">$5069 for two</span> --}}
        </div>
        <div class="d3">
            <span class="loc">{{$restaurant->location}}</span>
            {{-- <span class="km">1.2km</span> --}}
        </div>
    </a>
</x-card>
