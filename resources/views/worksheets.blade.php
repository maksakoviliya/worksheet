@extends('layouts.app')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Анкеты</h3>

    <div class="mt-8">

    </div>

    <div class="flex flex-col mt-8">

        <worksheets :is-admin="@can('manage heads') true @else false @endcan" token="{{ Auth()->user()->token }}"></worksheets>

    </div>
@endsection
