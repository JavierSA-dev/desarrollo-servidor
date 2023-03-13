<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController extends BaseController
{
    public function saveCommentAction($request)
    {
        $postData = $request->getParsedBody();
        $comment = new Comment();
        $comment->blog_id = $postData['blog_id'];
        $comment->comment = $postData['comment'];
        $comment->approved = 1;
        $comment->user = $_SESSION['user'];
        $comment->save();
        header('Location: /blog/' . $postData['blog_id']);
    }
}
