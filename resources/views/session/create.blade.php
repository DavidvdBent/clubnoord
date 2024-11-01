<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Noord</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
</head>
<body>
    <div class="hero-image">
        <div class="login-container">
            <h2>Voetbal Club Noord</h2>
            {{-- Log in formulier voor de user(admin) --}}
            <form method='post' action='/session/store'>
                @csrf
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="{{old('email')}}"><br>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="password">Wachtwoord</label><br>
                <input type="password" id="password" name="password"><br>
                <button type="submit" class="submit">Inloggen</button>
            </form>
        </div>
    </div>
</body>
</html>