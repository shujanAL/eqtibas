<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'اقتبس')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{{ route('quotes.index') }}">اقتبـا<span>س</span></a>
        <nav>
            @auth
                <span class="hello">مرحبًا، {{ auth()->user()->name }}</span>
                <form class="inline" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="link-button">تسجيل الخروج</button>
                </form>
            @else
                <a href="{{ route('login') }}">تسجيل الدخول</a>
                <a class="button small" href="{{ route('register') }}">إنشاء حساب</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert success" role="status">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error" role="alert">يرجى تصحيح الحقول الموضحة أدناه.</div>
        @endif

        @yield('content')
    </main>

    <footer>اقتبس · شارك فكرة، وألهم شعورًا.</footer>
</body>
</html>
