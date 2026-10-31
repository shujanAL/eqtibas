@extends('layouts.app')

@section('title', 'اقتباس · اقتباسات عربية')

@section('content')
    <section class="hero">
        <p class="eyebrow">مساحة للكلمات الجميلة</p>
        <h1>اقتباسات تستحق <em>القراءة.</em></h1>
        <p>اقرأ اقتباسات المجتمع، وابحث عما يلامس فكرتك، أو أضف اقتباسك الخاص.</p>
    </section>

    <form class="search" method="GET" action="{{ route('quotes.index') }}">
        <label class="sr-only" for="q">البحث داخل الاقتباسات</label>
        <input id="q" name="q" value="{{ $term }}" maxlength="155" placeholder="اكتب كلمة للبحث…">
        <button>بحث</button>
        @if ($term)
            <a href="{{ route('quotes.index') }}">مسح البحث</a>
        @endif
    </form>

    @auth
        <section class="composer">
            <h2>أضف اقتباسًا</h2>
            <form method="POST" action="{{ route('quotes.store') }}">
                @csrf
                <textarea name="content" minlength="3" maxlength="155" required placeholder="اكتب اقتباسك هنا…">{{ old('content') }}</textarea>
                <div class="form-row">
                    <div>
                        <small>من 3 إلى 155 حرفًا.</small>
                        <x-field-error name="content" />
                    </div>
                    <button class="button">نشر</button>
                </div>
            </form>
        </section>
    @else
        <div class="guest-callout">
            <span>سجّل دخولك لتضيف اقتباسك إلى المجتمع.</span>
            <a class="button" href="{{ route('login') }}">تسجيل الدخول</a>
        </div>
    @endauth

    <div class="section-heading">
        <h2>{{ $term ? 'نتائج البحث' : 'أحدث الاقتباسات' }}</h2>
        <span>{{ $quotes->total() }} اقتباس</span>
    </div>

    <section class="quotes-grid">
        @forelse ($quotes as $quote)
            <x-quote-card :quote="$quote" />
        @empty
            <div class="empty">
                <h3>لا توجد اقتباسات</h3>
                <p>{{ $term ? 'جرّب كلمة بحث أخرى.' : 'كن أول من يضيف اقتباسًا.' }}</p>
            </div>
        @endforelse
    </section>

    {{ $quotes->links() }}
@endsection
