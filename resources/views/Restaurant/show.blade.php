<x-layout>
    <div>
        <img src="{{$restaurant->logo ? asset('storage/'. $restaurant->logo) : asset('assets/images/default-restaurant-img.png')}}" alt="">
        <h1>{{ $restaurant->name }}</h1>
        <p>Location: {{ $restaurant->location }}</p>
        <p>Description: {{ $restaurant->description }}</p>
        <p>Phone Number: {{ $restaurant->phoneNumber }}</p>
    </div>
</x-layout>
