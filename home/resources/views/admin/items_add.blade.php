@extends('layouts.admin')
@section('title', 'Добавить товар')
@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Добавление товара
        </h2>

        <form action="{{ route('admin.item.add.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Название</span>
                    <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Название" name="name"/>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Артикул</span>
                    <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Наш артикул" name="article"/>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Цена (Вход)</span>
                    <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Цена" name="price" type="number"/>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Цена (Розница)</span>
                    <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Цена" name="retail" type="number"/>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Кол-во на складе</span>
                    <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Количество" name="count" type="number"/>
                </label>
                <label class="block text-sm mt-3">
                    <span class="text-gray-700 dark:text-gray-400">Тип</span>
                    <select
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            name="type_id">
                        @foreach ($types as $type)
                            <option value="{{$type->id}}">{{$type->name}} - type_id: {{$type->id}}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-sm mt-3">
                    <span class="text-gray-700 dark:text-gray-400">Бренда</span>
                    <select
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            name="brand_id">
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}} - type_id: {{$brand->type_id}}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-sm mt-3">
                    <span class="text-gray-700 dark:text-gray-400">Склад</span>
                    <select
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            name="stock_id">
                        @foreach ($stocks as $stock)
                            <option value="{{$stock->id}}">{{$stock->name}} - type_id: {{$stock->type_id}}</option>
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
