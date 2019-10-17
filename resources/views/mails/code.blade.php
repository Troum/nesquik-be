@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <p style="text-align: center">Рекламная игра «Мобильная мама»</p>
        @endcomponent
    @endslot
    {{-- Body --}}
    <div style="width: 600px; height: 921px; padding: 100px 50px 50px 50px; text-align: center; background-image: url({{ asset('/img/bg.png') }})">
        <p style="text-align: center">Добрый день, {{ $participant }}!</p>
        <br>
        <p style="text-align: center">Вы стали участником рекламной игры «Мобильная мама».</p>
        <br>
        <p style="text-align: center">Ваш Игровой код – {{ $code }}.</p>
        <p style="text-align: center">Данный Игровой код будет принимать участие
        в розыгрыше еженедельных призов и розыгрыше
        главного приза игры – RENAULT SANDERO STEPWAY.</p>
        <br>
        <p style="text-align: center">Напоминаем, что участвовать в рекламной игре
        можно неограниченное количество раз.</p>
        <p style="text-align: center">Чем больше у Вас Игровых кодов –
        тем больше шансов выиграть призы!</p>
        <br>
        <p style="text-align: center">Подробности по телефону <a href="tel:+375293224252">+375 (29) 322-42-52</a>
        и на сайте <a href="https://buslik.by">buslik.by</a>.</p>
    </div>
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <p style="text-align: center">© {{ date('Y') }}. Все права защищены</p>
        @endcomponent
    @endslot
@endcomponent
