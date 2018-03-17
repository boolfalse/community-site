@extends('layouts.master')

@section('title') Search results for {{ $search_text }} @stop

@section('content')
    <div class="card">
        <h5 class="card-header">Search results for {{ $search_text }}</h5>
        @include('layouts.partials.questions_table')
        <div class="card-footer">
            {{ $questions->links() }}
        </div>
    </div>
@stop