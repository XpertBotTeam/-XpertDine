{{-- Display card for each restaurant --}}
@props(['restaurant'])
<x-card>
    <a class="card-con" href="/restaurant/{{ $restaurant->id}}">
        <img src="{{$restaurant->logo ? asset('storage/'. $restaurant->logo) : asset('assets/images/default-restaurant-img.png')}}" alt="">
        <h2>{{$restaurant->name}}</h2>
        <p id="location">{{$restaurant->location}}</p>
        <p id="description">{{$restaurant->description}}</p>
        <p id="category">{{$restaurant->category}}</p>
        <p id="phoneNumber">{{$restaurant->phoneNumber}}</p>
        <p id="logo">{{$restaurant->logo}}</p>
        <p id="openTime">{{$restaurant->openTime}}</p>
        <p id="closeTime">{{$restaurant->closeTime}}</p>
        <p id="rating">{{$restaurant->rating}}</p>
        <p id="reviews">{{$restaurant->reviews}}</p>
    </a>
</x-card>
