@auth
    <div class="row justify-content-center">
        <button data-toggle="modal" data-target="#ask-question-modal" class="btn btn-success float-right">Ask a
            question
        </button>
    </div>
@endauth
<!-- Search Widget -->
<div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
        <form method="post" action="{{ route('search') }}">
            @csrf

            <div class="input-group">
                <input name="search_text" type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn ml-1">
                  <button class="btn btn-secondary">Go!</button>
            </span>
            </div>
        </form>
    </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled mb-0 row">
                    @foreach(\App\Category::all() as $category)
                        <li class="col-6">
                            <a href="{{ $category->getUrl() }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>