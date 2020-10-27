@extends('layouts.app')

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Список доступных банков</h3>

    <div class="flex mt-4">

        <div class="w-2/3 mr-6">
            <banks token="{{ Auth()->user()->token }}" />
        </div>

        <div class="w-1/3">
            <bank-uploader token="{{ Auth()->user()->token }}" />
        </div>

    </div>
@endsection
