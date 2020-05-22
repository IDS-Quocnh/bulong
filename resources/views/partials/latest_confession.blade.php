<div class="d-flex bg-secondary py-2 mt-2">
    <div class="d-flex flex-column align-items-center justify-content-center mx-2">
        <img src="{{ asset($confession->category->image) }}" width="40" class="my-2">
        <small>Relationships</small>
    </div>

    <div class="d-flex flex-column justify-content-end my-1 ml-4">
        <h4 class="mb-4">
            {{ $confession->text }}
        </h4>
        <div class="d-flex justify-content-between">
            <div>
                By <a href="" class="">{{ $confession->user->username }}</a><br>
                <small class="text-muted">{{ \Carbon\Carbon::parse($confession->created_at)->diffForHumans() }}</small>
            </div>

            <div class="text-muted mx-2">
                <span class="mr-2"><i class="fa fa-heart"></i> {{ $confession->like_count }} feels</span>
                <span><i class="fa fa-comment"></i> {{ $confession->comment_count }} comments</span>
            </div>
        </div>
    </div>
</div>
