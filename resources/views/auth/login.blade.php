<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/adminStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Giriş Yap</title>
</head>
<body>
    <div class="login">
        <div class="container">
            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="header">Oturum Aç</div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error )
                        <div class="errorShow">{{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="inputs">
                    <input placeholder="Email" class="input" type="text" name="email" id="signInEmail" 
                    value="{{ old('email') }}">
                    <input placeholder="Şifre" class="input" type="password" name="password" id="signInPassword">
                <div class="checkbox-container">
                    <label class="checkbox">
                    <input type="checkbox" id="remember" name="remember" value="1" {{ old("remember") ? "checked" : "" }}>
                    </label>
                    <label for="remember" class="checkbox-text">Beni hatırla</label>
                </div>
                <button class="sigin-btn" type="submit">Giriş Yap</button>
                <a class="forget" href="#">Şifremi Unuttum ?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>