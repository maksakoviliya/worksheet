@extends('layouts.app')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Анкеты</h3>

    <div class="mt-8">

    </div>

    <div class="flex flex-col mt-8 mb-20">
{{--        {{ Auth()->user()->filial }}--}}
{{--        {{ Auth()->user()->filial || 'empty' }}--}}
        <worksheet :user-id="{{ Auth()->user()->id }}" @if($worksheet ?? '')  :worksheet-data="{{ $worksheet }}" @endif filial="{{ Auth()->user()->filial['id'] }}" token="{{ Auth()->user()->token }}"></worksheet>

    </div>

@endsection

