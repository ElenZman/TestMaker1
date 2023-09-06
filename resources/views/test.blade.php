@extends('layouts.app')
@section('content')
    <div id="alerts">

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach


        <div id="alerts" class="m-4">
            @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('failure'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    @if (is_array(session('failure')))
                        @foreach (session('failure') as $error)
                            <div> {{ $error }}</div>
                        @endforeach
                    @endif
                    {{ session('failure') }}
                </div>
            @endif

        </div>
        <form class="w-full" method="POST" action="{{ route('test.save') }}">
            @csrf
            <div class="flex flex-wrap m-6 w-full md:w-1/2">
                <div class="mx-4 w-full">
                    <label for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название
                        теста</label>
                    <input type="text" id="title" name="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    @if ($errors->has('title'))
                        <p class="invisible peer-invalid:visible text-red-700 font-light">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap m-6 w-full md:w-1/2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="subject">
                        Выберете предмет
                    </label>
                    <div class="relative">
                        <select
                            class="block text-sm appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded
          leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="subject" name="subject">
                            <option value="0">------</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="test_type">
                        Выберете тип теста
                    </label>
                    <div class="relative">
                        <select
                            class="block text-sm appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight
          focus:outline-none focus:bg-white focus:border-gray-500"
                            id="test_type" name="test_type">
                            <option value="0">------</option>
                            @foreach ($test_types as $type)
                                <option value="{{ $type->id }}">{{ $type->test_type }}</option>
                            @endforeach
                        </select>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-6">
                @livewire('radio-question-editor')
            </div>
            <div class="m-6 flex items-center gap-x-6">
                <a href="{{ route('dashboard') }}" type="button"
                    class="w-56 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white text-center shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
         focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Выйти
                    и не сохранять</a>
                <input type="submit" value="Сохранить"
                    class="w-56 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white text-center shadow-sm hover:bg-indigo-500 focus-visible:outline
        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            </div>
        </form>
    @endsection
