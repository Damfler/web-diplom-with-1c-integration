@extends('layouts.admin')
@section('title', 'Изменить товар')
@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Изменение товара
        </h2>
        @if ($errors->message->first())
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                {{ $errors->message->first() }}</div>
        @endif
        <form action="{{ route('admin.item.edit.complete') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="article" value="{{$trade_offer->article}}">
            <input type="hidden" name="name" value="{{$trade_offer->name}}">

            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Название (не редактируется)</span>
                    <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="{{$trade_offer->name}}" disabled value="{{$trade_offer->name}}"/>
                </label>
                <label class="block text-sm mt-3">
                    <span class="text-gray-700 dark:text-gray-400">Бренда</span>
                    <select
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            name="brand_id">
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block text-sm mt-3">
                    <span class="text-gray-700 dark:text-gray-400">Фотография</span>
                    <input type="file"
                           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           name="photo"/>
                </label>

                <div class="mt-6 text-center">
                    <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
