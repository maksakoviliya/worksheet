@extends('layouts.app')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Анкеты пользователей</h3>

    <div class="flex flex-col mt-4">

        <worksheets :can-delete="@can('delete worksheets') true @else false @endcan" token="{{ Auth()->user()->token }}"></worksheets>

    </div>
@endsection
