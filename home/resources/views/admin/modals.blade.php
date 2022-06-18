@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Модальное окно
    </h2>

    <div class="max-w-2xl px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <p class="mb-4 text-gray-600 dark:text-gray-400">
            Это, возможно,
            <strong>самая доступная модальное окно, которую может получить</strong>
            , используя JavaScript. При открытии он использует
            <code>assets/js/focus-trap.js</code>
            чтобы создать
            <em>ловушка фокуса</em>
            , что означает, что если вы используете клавиатуру для навигации,
            фокус не будет распространяться на элементы позади, оставаясь внутри
            модального окна в цикле, пока вы не предпримете каких-либо действий.
        </p>

        <p class="text-gray-600 dark:text-gray-400">
            Кроме того, на маленьких экранах он размещается в нижней части экрана,
            чтобы учитывать устройства большего размера и упростить нажатие
            больших кнопок.
        </p>
    </div>

    <div>
        <button @click="openModal" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Открыть окно
        </button>
    </div>
</div>
@endsection