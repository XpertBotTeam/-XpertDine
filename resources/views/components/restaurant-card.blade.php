{{-- Display card for each restaurant --}}
@props(['restaurant'])
<x-card>
    <a class="card-con" href="/restaurant/{{ $restaurant->id}}">
        <img src="{{$restaurant->logo ? asset('storage/'. $restaurant->logo) : asset('assets/images/default-restaurant-img.png')}}" alt="">
        <h2>{{$restaurant->name}}</h2>
        <p id="location">{{$restaurant->location}}</p>
        <p id="Category">{{$restaurant->category}}</p>
        <p id="reviews">{{$restaurant->reviews}}</p>
    </a>
</x-card>