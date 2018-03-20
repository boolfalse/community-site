@extends('layouts.master-nosidebar')

@section('title') Chats @endsection

@section('head')
    <style rel="stylesheet" href="{{ asset('css/app.css') }}"></style>
    <style>
        .list-group{
            overflow-y: scroll;
            height: 200px;
        }
    </style>
@endsection

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
                    <div class="row" id="app">
                        <ul class="list-group offset-1 col-10" v-chat-scroll>
                            <message v-for="value in chat.messages" :key="value.index">
                                @{{ value }}
                            </message>
                        </ul>

                        <input v-model="message" @keyup.enter="send" type="text" class="form-control offset-1 col-10" placeholder="Message Text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    {{--<script>--}}
        {{--$(document).ready(function () {});--}}
    {{--</script>--}}
@endsection