<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>

    <title>Club Noord</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="container-1200 flex">
                <h1><a href="/">Club Noord</a></h1>
                <div class="logout">
                    <ul>
                        <form method="post" action="/logout">
                            @csrf
                            <button class="uitlog-button"><i class="fa-solid fa-arrow-right-from-bracket"></i> Uitloggen</button>
                        </form>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="main-container container-1200">
            <div class="menu-container">
                <ul>
                    <a href="/"><li>Families</li></a>
                    <a href="/members"><li>Leden</li></a>
                    <a href="/contributions"><li>Contributies</li></a>
                    <a href="/typemembers"><li>Soort Leden</li></a>
                    <a href="/member/create"><li>Nieuw Lid Aanmaken</li></a>
                </ul>
            </div>
            {{-- Hieronder word de content toegevoegd --}}
            <div class="content-container">
                @yield('content')
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <h2> Voetbal Club Noord </h2>
            <h2> Info@clubnoord.nl </h2>
        </div>
    </footer>
    {{-- Hieronder word de flashmessage toegevoegd (mits die is meegestuurd) --}}
    @if (session()->has('flash'))
        <div x-data="{ show:true }" 
            x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="flash">
            <h3>{{session('flash')}}</h3>
        </div>
    @endif
</body>
</html>