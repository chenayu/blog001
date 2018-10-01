<?php
namespace controllers;

use models\Blog;

class IndexController
{
    public function index()
    {
        $blog = new Blog;
        $data = $blog->index();

        ob_start();
        view('index.index', $data);
        $str = ob_get_contents();
        file_put_contents(ROOT . 'public/index.html', $str);
    }

    public function content_to_html()
    {
        $blog = new Blog;
        $data = $blog->content_html();
        ob_start();

        foreach ($data as $v) {
            view('blog.content', ['blog' => $v]);
            $str = ob_get_contents();
            file_put_contents(ROOT . 'public/contents/' . $v['id'] . '.html', $str);
            ob_clean();

        }

    }
}
?>