<x-layout>
    <div class="body">
    <div class="form-main-container">
        <div class="sectionform">
            <h1>Sign up</h1>
            <p>To use all features <br>of the application</p>
        </div>
        <form action="/signup" method="POST">
            @csrf
            <div class="input-box">
                <label for="Username">Username</label> <br>
                <input type="text" name="Username" value="{{old('Username')}}">
                <div class="sep"></div>
                @error('Username')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label for="email">Email</label> <br>
                <input type="email" name="email" value="{{old('email')}}">
                <div class="sep"></div>
                @error('email')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label for="password">Password</label> <br>
                <input type="password" name="password" value="{{old('password')}}">
                <div class="sep"></div>
                @error('password')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label for="password_confirmation">Confirm Password</label> <br>
                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}">
                <div class="sep"></div>
                @error('password_confirmation')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label for="Phonenumber">PhoneNumber</label> <br>
                <input type="number" name="Phonenumber" value="{{old('nuPhonenumbermber')}}">
                <div class="sep"></div>
                @error('Phonenumber')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="button-box">
                <button type="submit">SignUp</button>
                <button type="reset">Reset</button>
            </div>
            <h3>Alreafy Have an Account? <a href="/login">Signin</a></h3>
        </form>
    </div>
    </div>
</x-layout>