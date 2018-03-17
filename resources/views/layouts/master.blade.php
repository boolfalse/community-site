<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fastselect/fastselect.css') }}">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @yield('head')
</head>

<body>

@include('layouts.partials.navbar')

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">
            @include('flash::message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            @include('layouts.partials.sidebar')
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark mt-4">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Community Website 2018 by Mohamed Eddami</p>
    </div>
    <!-- /.container -->
</footer>

@auth
    <!-- Modal -->
    <div class="modal fade" id="ask-question-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ask a question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="question-form" method="post" action="{{ route('question.create') }}">
                    @csrf

                    <div class="modal-body p-4">
                        <div class="row">
                            <label for="question-title">Title</label>
                            <input name="question_title" id="question-title" class="form-control" type="text">
                        </div>
                        <div class="row">
                            <label for="question-body">Body</label>
                            <textarea name="question_body" id="question-body" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <label for="category-tags">Categories</label>
                            <select class="multipleSelect" multiple id="category-tags">
                                @foreach(\App\Category::all(['id', 'name']) as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input id="hidden-category-tags" name="question_categories" type="hidden">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endauth

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/fastselect/fastselect.js') }}"></script>
@yield('js')
<script>
    $(document).ready(function () {
        var $select = $('#category-tags');
        var $tags = $select.fastselect().data('fastselect');
        $('#question-form').submit(function (e) {
            e.preventDefault();
            $('#hidden-category-tags').val($tags.optionsCollection.getValues());
            $(this)[0].submit();
        });
    });
</script>
</body>

</html>
