<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="{{ asset('js/TweenMax.js') }}"></script>
    <script src="{{ asset('js/MorphSVGPlugin.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>

<form method="POST" action="{{ route('login') }}">
    <div class="svgContainer">
        <div>
            @include('auth.svg-avatar')
        </div>
    </div>

    <div class="inputGroup inputGroup1">
        <label for="loginEmail" id="loginEmailLabel">{{ __('E-Mail Address') }}</label>
        <input name="email" type="email" id="loginEmail" maxlength="254" />
        <p class="helper helper1">email@domain.com</p>

        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="inputGroup inputGroup2">
        <label for="loginPassword" id="loginPasswordLabel">Password</label>
        <input name="password" type="password" id="loginPassword" />
        <label id="showPasswordToggle" for="showPasswordCheck">Show
            <input id="showPasswordCheck" type="checkbox"/>
            <div class="indicator"></div>
        </label>

        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="inputGroup inputGroup3">
        <button type="submit" id="login">{{ __('Login') }}</button>
    </div>

    <div class="inputGroup">
        <a href="{{ route('via_passport') }}" class="btn btn-warning">
            Login with Passport
        </a>
    </div>

    {{ csrf_field() }}
</form>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>