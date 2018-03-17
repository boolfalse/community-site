<table class="table table-hover table-responsive-lg text-center">
    @if($questions->count() == 0)
        <tr class="text-center">
            <td>
                No questions!
            </td>
        </tr>
    @endif
    @foreach($questions as $question)
        <tr>
            <td width="10">
                <i class="fa fa-thumbs-up"></i>
                {{ $question->points }}
            </td>
            <td width="10">
                <i class="fa fa-comment-alt"></i>
                {{ $question->Answers->count() }}
            </td>
            <td width="10">
                <i class="fa fa-eye"></i>
                {{ $question->views }}
            </td>
            <td class="text-left">
                @isset($question->best_answer) <i title="Solved" class="fa fa-check text-success"></i> @endisset
                <a href="{{ $question->getUrl() }}">{{ $question->title }}</a>
                <p class="text-muted small">
                    Asked {{ $question->created_at->diffForHumans() }} By <a
                            href="{{ $question->User->getProfileUrl() }}">{{ $question->User->username }}</a>.
                </p>
                <div class="btn-group-sm">
                    @foreach($question->Categories as $category)
                        <a href="{{ $category->getUrl() }}"
                           class="btn btn-outline-secondary">{{ $category->name }}</a>
                    @endforeach
                </div>

            </td>
        </tr>
    @endforeach
</table>