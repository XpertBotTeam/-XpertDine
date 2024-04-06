<x-layout>
    <div class="body">
    <div class="form-main-container">
        <div class="sectionform">
            <h1>Login up</h1>
            <p>To use all features <br>of the application</p>
        </div>
        <form action="/loginCheck" method="POST">
            @csrf
            <div class="input-box">
                <label for="username_or_email">Username or Email</label> <br>
                <input type="text" name="username_or_email" value="{{ old('username_or_email') }}">
                <div class="sep"></div>
                @error('username_or_email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="input-box">
                <label for="password">Password</label> <br>
                <input type="password" name="password" value="{{ old('password') }}">
                <div class="sep"></div>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        
            @if ($errors->has('loginError'))
                <p class="error">{{ $errors->first('loginError') }}</p>
            @endif
        
            <div class="button-box">
                <button type="submit">Login</button>
                <button type="reset">Reset</button>
            </div>
            <h3>Don't have an Account? <a href="/register">Signup!</a></h3>
        </form>        
        
    </div>
    </div>
</x-layout>