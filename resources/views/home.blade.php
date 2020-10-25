@extends('layouts.app')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Сотрудники</h3>

    <div class="mt-8">

    </div>

    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

            <users :is-admin="@can('manage heads') true @else false @endcan" :user-id="{{ Auth()->user()->id }}" token="{{ Auth()->user()->token }}"></users>

        </div>
    </div>
@endsection

