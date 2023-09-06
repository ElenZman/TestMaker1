@extends('layouts.app')

@section('content')
<div class="">
<div class="m-8">
    Здесь будет текст
</div>
<div class="m-5">
    <a href="{{route('test.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Создать тест</a>
</div>

</div>
@endsection

