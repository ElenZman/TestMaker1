Exception details: <b>{{ $exception->getMessage() }}</b>
{{-- Вернуться от сюда к test.blade. но с сохраненными даннымиы--}}

<div class="m-5">
    <a href="{{route('test.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Назад</a>
</div>
