<?php

namespace App\Controllers;
use App\Models\Blog;
use App\Models\Comment;

class IndexController extends BaseController
{
    public function index()
    {
        $blogs = Blog::all();
        return $this->renderHTML('index.twig', [
            'blogs' => $blogs,
            'latestComments' => $this->getAside()[0],
            'tags' => $this->getAside()[1],
        ]);
    }

    public function about(){
        return $this->renderHTML('Page/about.html.twig', [
            'latestComments' => $this->getAside()[0],
            'tags' => $this->getAside()[1],
        ]);
    }

    public function contact(){
        return $this->renderHTML('Page/contact.html.twig', [
            'latestComments' => $this->getAside()[0],
            'tags' => $this->getAside()[1],
        ]);
    }

    public function getAside(){
        $latestComments = Comment::orderBy('created_at', 'DESC')->limit(5)->get();
        $tags = Blog::all()->pluck('tags')->toArray();
        $tags = array_map('trim', $tags);
        $tags = array_map('strtolower', $tags);
        $tags = array_map('explode', array_fill(0, count($tags), ','), $tags);
        $tags = array_reduce($tags, function ($a, $b) {
            return array_merge($a, $b);
        }, []);
        $tags = array_count_values($tags);
        arsort($tags);
        $tags = array_slice($tags, 0, 10);
        $result = array($latestComments, $tags);
        return $result;
    }
}