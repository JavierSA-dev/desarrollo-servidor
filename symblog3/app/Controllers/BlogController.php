<?php

namespace App\Controllers;
use App\Models\Blog;
use App\Models\Comment;

class BlogController extends BaseController
{
    public function addBlogAction($request){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $_POST;
            $blog = new Blog();
            $blog->title = $postData['title'];
            $blog->author = $postData['author'];
            $blog->blog = $postData['description'];
            $blog->tags = $postData['tag'];

            $files = $request->getUploadedFiles();
            $image = $files['image'];
            if ($image->getError() == UPLOAD_ERR_OK) {
                $fileName = $image->getClientFilename();
                $fileName = uniqid() . $fileName;
                $image->moveTo("img/$fileName");
                $blog->image = $fileName;
            }
            $blog->save();
            header('Location: /');
        }
        return $this->renderHTML('addBlog.twig');
    }
    public function getBlogAction($request){
        $blogId = $request->getUri()->getPath();
        $blogId = str_replace('/blog/', '', $blogId);
        $blog = Blog::find($blogId);
        $comments = Comment::where('blog_id', $blogId)->get();
        return $this->renderHTML('showBlog.twig', [
            'blog' => $blog,
            'comments' => $comments
        ]);
    }

}