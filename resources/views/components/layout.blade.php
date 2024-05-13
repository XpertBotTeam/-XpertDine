<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/offers.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/signup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/user_agreement.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/privacy_policy.css')}}">
    <script src="https://kit.fontawesome.com/6043b21aa0.js" crossorigin="anonymous"></script>
    <title>XpertDine</title>
</head>
<body>
    <main>
        {{$slot}}
    </main>
</body>
</html>