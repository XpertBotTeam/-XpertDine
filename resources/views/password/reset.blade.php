<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
 
    <form method="Post" action="{{ route('password.update', ['token' => $token]) }}">
        <h1>Reset Your Password</h1>
        @csrf
        <input type="hidden" name="token" value="{{ request('token') }}">

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit">resetpassword</button>
    </form>
</body>

</html>

<style>
    body {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        height: 100vh;
        background-color: rgb(0, 126, 236);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        overflow: hidden;
    }

    form {
        background-color: white;
        width: 70%;
        height: 50vh;
        border-radius: 20px;
        box-shadow: 5px 5px 10px black;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    form h1 {
        position: relative;
        top: 0;
    }
</style>
