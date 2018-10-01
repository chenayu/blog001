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
        view('blog.index', $data);
        $str = ob_get_contents();
        file_put_contents(ROOT . 'public/index.html', $str);
        ob_clean();
    }

    //生成静态内容页
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

    //生成首页静态页取出最新发表的公开日志20条
    public function index_html()
    {
        $blogs = new Blog;
       $blogs = $blogs->index_html();

       ob_start();
        view('index.index',['blogs'=>$blogs]);
        $str = ob_get_contents();
        file_put_contents(ROOT.'public/index.html',$str);
        ob_clean();
    }
}
?>