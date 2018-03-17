@extends('layouts.master-nosidebar')

@section('title') {{ $user->username }}'s Profile @stop

@section('content')
    <div class="card">
        <h5 class="card-header">About <strong>{{ $user->username }}</strong></h5>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 text-center">
                    @isset($user->avatar)

                    @else
                        <img class="rounded-circle w-75" src="{{ asset('imgs/user-avatar.png') }}"
                             alt="">
                    @endisset
                </div>
                <div class="col-sm-9">
                    <p>{{ $user->description }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 text-center">
                    <ul class="list-group my-4">
                        <li class="list-group-item">{{ $user->getpoints() }} points</li>
                        <li class="list-group-item">{{ $user->Questions()->count() }} questions</li>
                        <li class="list-group-item">{{ $user->Answers()->count() }} answers</li>
                    </ul>
                </div>

                <div class="col-sm-9">
                    <div class="card my-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#recent-questions-tab"
                                   role="tab" aria-controls="recent-questions-tab" aria-selected="true">
                                    <i class="fa fa-list"></i> Recent questions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#fav-questions-tab"
                                   role="tab" aria-controls="fav-questions-tab" aria-selected="false">
                                    <i class="fa fa-star"></i> Favourite questions
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="recent-questions-tab" role="tabpanel"
                                 aria-labelledby="recent-questions-tab-tab">
                                @php
                                    $questions = $user->Questions()->orderByDesc('created_at')->paginate(20);
                                @endphp
                                <div class="card-body p-0">
                                    @include('layouts.partials.questions_table')
                                </div>
                                <div class="card-footer">
                                    {{ $questions->links() }}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="fav-questions-tab" role="tabpanel"
                                 aria-labelledby="fav-questions-tab-tab">
                                @php
                                    $questions = $user->FavouriteQuestions()->orderByDesc('created_at')->paginate(20);
                                @endphp
                                <div class="card-body p-0">
                                    @include('layouts.partials.questions_table')
                                </div>
                                <div class="card-footer">
                                    {{ $questions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop