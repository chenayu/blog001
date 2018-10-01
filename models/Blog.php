<?php
namespace models;
use PDO;

class Blog
{
    function index()
    {
        $where =1;
        $value =[];

        if(isset($_GET['keyword'])&&$_GET['keyword'])
        {
            $where .= " AND title LIKE ? OR content LIKE ?";
            $value[]='%'.$_GET['keyword'].'%';
            $value[]='%'.$_GET['keyword'].'%';
        }

        if(isset($_GET['start_at'])&&$_GET['start_at'])
        {
            $where .=" AND created_at >= ?";
            $value[]=$_GET['start_at'];
        }

        if(isset($_GET['end_at'])&&$_GET['end_at'])
        {
            $where .=" AND created_at <= ?";
            $value[]=$_GET['end_at'];
        }

        $perpage = 15;
        $page = isset($_GET['page']) ? max(1,(int)$_GET['page']) :1;
        $offset = ($page-1)*$perpage;

        $stmt  = \libs\DB::make()->prepare("SELECT COUNT(*) FROM blogs WHERE $where ");
        $stmt->execute($value);
        $count = $stmt->fetch(PDO::FETCH_COLUMN);

        $countpage = ceil($count/$perpage);

        $btns = '';
        for($i=1;$i<=$countpage;$i++)
        {
            $btns .="<a href='?page=$i'>$i</a>";
        }


        $stmt = \libs\Db::make()->prepare("SELECT * FROM blogs WHERE $where LIMIT $offset,$perpage");
        $stmt->execute($value);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return ['btns'=>$btns,'data'=>$data];
    }

    public function content_html()
    {
        $stmt = \libs\Db::make()->query('SELECT * FROM blogs');
       return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}
?>