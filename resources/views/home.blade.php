@extends('layouts.master')

@section('title') Home - Community Website @stop

@section('content')
    @guest
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <h2>Learn and Share</h2>
                    <p>Join our community to learn and share your knowledge.
                        Please <a class="btn-link" href="{{ route('register') }}">Sign up</a>
                    </p>
                    <p>Already a member? <a href="{{ route('login') }}" class="btn-link">Login</a></p>
                </div>
            </div>
        </div>
    @endguest
    <div class="row my-4">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Latest questions</h5>
                <div class="card-body p-0">
                    @include('layouts.partials.questions_table')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12 justify-content-center">
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop