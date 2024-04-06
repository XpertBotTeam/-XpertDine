<nav>
    <a href="/"><img src="{{ asset('assets/images/default-restaurant-img.png')}}" alt=""></a>
    <li>
        <ul>
            <a href="/">Home</a>
        </ul>
        <ul>
            <a href="/restaurants">Restaurants</a>
        </ul>
        <ul>
            <input type="text" id="search">
        </ul>
        @auth
            <ul>
                <a href="">{{ auth()->user()->name }}</a>
            </ul>
            <ul>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </ul>
        @else
            <ul>
                <a href="/login">Log-in</a>
            </ul>
            <ul>
                <a href="/register">Sign-in</a>
            </ul>
        @endauth
    </li>
</nav>
