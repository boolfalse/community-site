@extends('layouts.master-nosidebar')

@section('title') Chats @endsection

@section('content')
    <div class="card">
        <h5 class="card-header">All Chat Rooms</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 text-center">
                    @isset($user->avatar)
                    @else
                        <img class="rounded-circle w-75" src="{{ asset('imgs/user-avatar.png') }}" alt="">
                    @endisset
                </div>
                <div class="col-sm-9">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 text-center">
                    <ul class="list-group my-4">
                        <li class="list-group-item">123 points</li>
                        <li class="list-group-item">345 questions</li>
                        <li class="list-group-item">567 answers</li>
                    </ul>
                </div>

                <div class="col-sm-9">
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--<script>--}}
        {{--$(document).ready(function () {});--}}
    {{--</script>--}}
@endsection