@extends('layouts.master')

@section('title') {{ $question->title }} - Community Website @stop

@section('content')

    @php
        $vote_type = 'no';
        if(Auth::check())
        {
            if($vote = $question->getVote(Auth::user()->id)->first())
                $vote_type = $vote->type;
        }
    @endphp
    <div class="row">
        <div class="col-sm-2 text-center">
            <button @guest disabled @endguest id="btn-question-up" class="btn btn-block btn-link">
                <i id="icon-question-up"
                   class="fa fa-caret-up @if($vote_type != 'up') text-muted @endif fa-2x"></i>
            </button>
            <h4 class="text-muted" id="question-pts">{{ $question->points }}</h4>
            <button @guest disabled @endguest id="btn-question-down" class="btn btn-block btn-link">
                <i id="icon-question-down"
                   class="fa fa-caret-down @if($vote_type != 'down') text-muted @endif fa-2x"></i>
            </button>
            <button @guest disabled @endguest id="btn-question-fav" class="btn btn-block  btn-link">
                <i id="icon-question-fav"
                   class="fa fa-star @if(!$question->isUserFavourite()) text-muted @endif fa-1x"></i>
            </button>
        </div>
        <div class="col-sm-10">
            <!-- Title -->
            <h3 class="mt-4">{{ $question->title }}</h3>

            <!-- Author -->
            <p class="lead">
                by
                <a href="{{ $question->User->getProfileUrl() }}">{{ $question->User->username }}</a>
            </p>

            <div class="row">
                <div class="col-6">
                    <span>Posted on {{ $question->created_at }}</span>
                </div>
                <div class="col-6 text-right">
                    <span>Viewed {{ $question->views }}</span>
                </div>
            </div>
            <hr>

            <!-- Post Content -->
            <p>
                {!! nl2br($question->body) !!}
            </p>
        </div>
    </div>
    @isset($question->best_answer)
        <div class="row">
            <div class="offset-2 col-sm-12">
                <hr>
                <p><i class="fa fa-check text-success"></i> Solved! <a href="#best-answer">Go to answer!</a></p>
            </div>
        </div>
    @endisset
    <div class="row my-4">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">{{ $question->Answers->count() }} Answers</h5>
                <div class="card-body">
                    @if($question->Answers->count() == 0) <p class="text-center">There is no answers!</p> @endif
                    @foreach($question->Answers as $answer)
                    <!-- Single Answer -->
                        <div @if($question->best_answer == $answer->id) id="best-answer"
                             @endif class="card p-4 my-2 @if($question->best_answer == $answer->id) border-success @endif">
                            <div class="row">
                                <div class="col-sm-2 text-center">
                                    <button class="btn btn-block btn-link">
                                        <i class="fa fa-caret-up text-muted fa-2x"></i>
                                    </button>
                                    <h4 class="text-muted">{{ $answer->points }}</h4>
                                    <button class="btn btn-block btn-link">
                                        <i class="fa fa-caret-down text-muted fa-2x"></i>
                                    </button>
                                    @if($question->best_answer == $answer->id)
                                        <i class="fa fa-check text-success fa-2x"></i>
                                    @endif
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="media mb-4">
                                            <div class="media-body">
                                                {{ $answer->body }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                @auth
                                    <div class="offset-2 col-sm-4 text-left">
                                        @if($answer->uid == Auth::user()->id)
                                            <a class="small" href="">Edit</a> &nbsp;
                                            <a class="small" href="">Delete</a> &nbsp;
                                        @endif
                                        @if($question->uid == Auth::user()->id)
                                            <form method="post" action="{{ route('question.bestAnswer') }}">
                                                @csrf

                                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                                                @if($answer->id != $question->best_answer)
                                                    <input name="set_best_answer" type="submit"
                                                           class="btn btn-sm btn-primary" value="Best answer"/>
                                                @else
                                                    <input name="unset_best_answer" type="submit"
                                                           class="btn btn-sm btn-primary" value="Cancel best answer"/>
                                                @endif
                                            </form>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                            <div class="row">
                                <div class="offset-6 col-sm-6 text-right">
                                    <p class="small text-muted">Answered {{ $answer->created_at->diffForHumans()}} by <a
                                                href="{{ $answer->User->getProfileUrl() }}">{{ $answer->User->username }}</a>.
                                    </p>
                                </div>
                            </div>

                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="row my-4">
        <div class="col-12">
        @if(Auth::check())
            <!-- Comments Form -->
                <div class="card">
                    <h5 class="card-header">Your Answer</h5>
                    <div class="card-body">
                        <form action="{{ route('answer.post') }}" method="post">
                            <div class="form-group">
                                @csrf

                                <input name="question_id" type="hidden" value="{{ $question->id }}">
                                <textarea name="answer_body" class="form-control" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            @else
                <p class="text-center">To answer please <a href="{{ route('register') }}">sign up</a>. Already a member?
                    Please
                    <a href="{{ route('login') }}">login</a>.</p>
            @endif
        </div>
    </div>

@stop

@section('js')
    <script>

        function questionVoteCallback(response) {
            var btn_up = $('#icon-question-up');
            var btn_down = $('#icon-question-down');
            var pts = $('#question-pts');
            $(btn_up).addClass('text-muted');
            $(btn_down).addClass('text-muted');
            if (response === 'up') {
                $(btn_up).removeClass('text-muted');
                $(pts).text(parseInt($(pts).text()) + 1);
            }
            else if (response === 'down') {
                $(btn_down).removeClass('text-muted');
                $(pts).text(parseInt($(pts).text()) - 1);
            }
            else if (response === 'cancel_up') {
                $(pts).text(parseInt($(pts).text()) - 1);
            } else if (response === 'cancel_down') {
                $(pts).text(parseInt($(pts).text()) + 1);
            }
        }

        $(document).ready(function () {
            $('#btn-question-fav').click(function () {
                $.post('{{ route('question.fav') }}', {
                    'question_id': '{{ $question->id }}',
                    '_token': $('meta[name=csrf-token]').attr('content')
                }, function (data) {
                    if (data === 'fav') {
                        $('#icon-question-fav').removeClass('text-muted');
                    } else {
                        $('#icon-question-fav').addClass('text-muted');
                    }
                });
            });

            $('#btn-question-up').click(function () {
                $.post('{{ route('question.vote') }}', {
                    'question_id': '{{ $question->id }}',
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    'type': 'up'
                }, function (data) {
                    questionVoteCallback(data);
                })
            });

            $('#btn-question-down').click(function () {
                $.post('{{ route('question.vote') }}', {
                        'question_id': '{{ $question->id }}',
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        'type': 'down'
                    }, function (data) {
                        questionVoteCallback(data);
                    }
                )
            });
        });
    </script>
@stop