<?php

namespace App\Bulong\Comments;

use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection
{
    public function threaded()
    {
        $comments = parent::groupBy('parent_id');

        return $comments;
    }
}
