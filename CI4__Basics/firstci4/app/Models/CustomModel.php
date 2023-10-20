<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel{

    protected $db;

   
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db;
    }

    function all(){
        // "SELECT * FROM posts"
        return $this->db->table('posts')->get()->getResult();
    }

    function where(){
        return $this->db->table('posts')
                        ->where(['post_id >' => 90])
                        ->where(['post_id <=' => 95])
                        ->where(['post_id != ' => 91])
                        ->orderBy('post_id', 'ASC')
                        ->get()
                        ->getResult();

    }

    function join(){
        return $this->db->table('posts')
                        ->where(['post_id > '=> 50])
                        ->where(['post_id < '=> 60])
                        ->join('users ', 'posts.post_author_id = users.user_id', 'right')
                        ->get()
                        ->getResult();

    }

    function like(){
        return $this->db->table('posts')
                        ->like(['post_title ' => 'laudantium'])
                        ->join('users ', 'posts.post_author_id = users.user_id', 'right')
                        ->get()
                        ->getResult();

    }

    function grouping(){
        // SElECT * FROM posts where (post_id = 25 AND post_date < '1990-01-01 00:00:00') OR post_author = 10;
        return $this->db->table('posts')
                        ->groupStart()
                            ->where(['post_id >'=> '25', 'post_created_at <' => '1990-01-01 00:00:00'])
                        ->groupEnd()
                        ->orWhere('post_author_id', 25)
                        ->join('users ', 'posts.post_author_id = users.user_id', 'right')
                        ->get()
                        ->getResult();

    }

    function wherein(){
        # orWhereIn
        # 

        $emails = ['cronin.natasha@example.org', 'shirley.koelpin@example.com', 'taurean82@example.net'];
        return $this->db->table('posts')
                        ->groupStart()
                            ->where(['post_id >'=> '25', 'post_created_at <' => '1990-01-01 00:00:00'])
                        ->groupEnd()
                        ->orWhereIn('email', $emails)
                        ->join('users ', 'posts.post_author_id = users.user_id', 'right')
                        ->limit(5, 4)
                        ->get()
                        ->getResult();

    }

    # query builder
    function getPosts(){
        $builder = $this->db->table('posts');
        $builder->join('users', 'posts.post_author_id = users.user_id');
        $posts = $builder->get()->getResult();

        return $posts;
    }
}