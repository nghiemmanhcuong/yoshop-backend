<?php
class Blogs {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // get all blogs
    public function getBlogs($data=null) {
        if(isset($data)) {
            $limit = $data['limit'];
            $curr_page = $data['page'];
            $offset = ($curr_page - 1) * $limit;

            $sql = "SELECT * FROM blogs LIMIT $limit OFFSET $offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $blog_count_sql = "SELECT * FROM blogs";
                $blog_count_stmt = $this->conn->prepare($blog_count_sql);
                $blog_count_stmt->execute();
                $blog_count = $blog_count_stmt->rowCount();

                $pages = ceil($blog_count / $limit);

                return [
                    'stmt' => $stmt,
                    'pages' => $pages,
                    'success' => true
                ];

            }else {
                return [
                    'success' => false,
                    'message' => 'Có lỗi khi lấy dữ liệu'
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Có lỗi khi lấy dữ liệu'
            ];
        }
    }

    // get all blogs
    public function getNewBlogs($limit=null) {
        if(isset($limit)) {

            $sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT $limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'stmt' => $stmt
                ];

            }else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy bào viết nào phù hợp',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Có lỗi khi lấy dữ liệu',
            ];
        }
    }

    // get Blog By Slug
    public function getBlogBySlug($slug=''){
        if(!empty($slug)){
            $sql = "SELECT * FROM blogs WHERE slug=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$slug]);

            if($stmt->rowCount() > 0){
                $blog = $stmt->fetch(PDO::FETCH_ASSOC);
                return [
                    'success' => true,
                    'data'=>$blog
                ];

            }else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy bào viết nào phù hợp',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Không tìm thấy bào viết nào phù hợp',
            ];
        }
    }
}