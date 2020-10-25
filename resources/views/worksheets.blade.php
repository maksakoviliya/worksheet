@extends('layouts.app')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Анкеты пользователей</h3>

    <div class="flex flex-col mt-4">

        <worksheets :can-delete="@can('delete worksheets') true @else false @endcan" token="{{ Auth()->user()->token }}"></worksheets>

    </div>

    <h3 class="text-gray-700 text-3xl font-medium mt-8">Анализ оспоримых сделок</h3>

    <div class="flex flex-col mt-4">

        <voidable-worksheets :can-delete="@can('delete worksheets') true @else false @endcan" token="{{ Auth()->user()->token }}"></voidable-worksheets>

    </div>
@endsection
