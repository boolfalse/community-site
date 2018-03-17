@extends('layouts.master')

@section('title') {{ $category->name }} - Community Website @stop

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <h2>{{ $category->name }}</h2>
                <p>
                    {{ $category->description }}
                </p>
                <h6>{{ $category->questions->count() }} questions asked.</h6>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Latest questions</h5>
                <div class="card-body p-0">
                    @include('layouts.partials.questions_table')
                </div>
                <div class="card-footer">
                    <div class="col-10 offset-1">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop