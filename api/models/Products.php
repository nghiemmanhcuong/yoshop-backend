<?php

class Products {
    private $conn;

    // connect database
    public function __construct($db) {
        $this->conn = $db;
    }

    // getAll products
    public function getAll($data=[]) {

        if(!empty($data['limit'])){
            $product_count = 1;
            $limit = $data['limit'];
            $curr_page = $data['page'];
            $offset = ($curr_page - 1) * $limit;

            if(!empty($data['sort'])){
                $sortArr = explode(':',$data['sort']);
                $sortArr = array_values($sortArr);
                $field = $sortArr[0];
                $sort = $sortArr[1];
                $sql_filter = '';

                if(!empty($data['colors']) && !empty($data['sizes'])){
                    $sql_filter_color = '';
                    $sql_filter_size = '';
                    foreach ($data['colors'] as $item) {
                        $sql_filter_color .= " color LIKE '%".$item."%' OR";
                    }

                    foreach ($data['sizes'] as $item) {
                        $sql_filter_size .= " sizes LIKE '%".$item."%' AND";
                    }

                    $sql_filter_color = rtrim($sql_filter_color,'OR');
                    $sql_filter_size = rtrim($sql_filter_size,'AND'); 

                    $sql_filter = $sql_filter_color.' AND '.$sql_filter_size;

                }else if(!empty($data['colors'])){
                    foreach ($data['colors'] as $item) {
                        $sql_filter .= " color LIKE '%".$item."%' OR";
                    }
                    $sql_filter = rtrim($sql_filter,'OR');

                }else if(!empty($data['sizes'])){
                    foreach ($data['sizes'] as $item) {
                        $sql_filter .= " sizes LIKE '%".$item."%' OR";
                    }
                    $sql_filter = rtrim($sql_filter,'OR');  
                }
                
                if(!empty($sql_filter)){
                    $sql = "SELECT * FROM products WHERE $sql_filter 
                    ORDER BY $field $sort LIMIT $limit OFFSET $offset";
                    $product_count = $this->conn->prepare("SELECT * FROM products WHERE $sql_filter");
                }else {
                    $sql = "SELECT * FROM products ORDER BY $field $sort LIMIT $limit OFFSET $offset";
                    $product_count = $this->conn->prepare("SELECT * FROM products");
                }

            }else {
                $sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
                $product_count = $this->conn->prepare("SELECT * FROM products");
            }

        }else {
            $sql = "SELECT * FROM products";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $product_count->execute();
        $product_count = $product_count->rowCount();
        $pages = ceil($product_count / $limit);
        return [
            'stmt' => $stmt,
            'pages' => $pages,
        ];
    }

    // get collection
    public function getCollections($data=[]) {

        if(!empty($data)){
            
            if(isset($data['category_slug'])){
                $sql = "SELECT id FROM categories WHERE slug=?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$data['category_slug']]);

                $category_id = $stmt->fetch(PDO::FETCH_ASSOC);
            }else {
                return false;
            }

            if(isset($category_id['id'])){
                $product_count = 1;
                $curr_page = $data['page'];

                if(isset($data['limit'])){
                    $limit = $data['limit'];
                    $offset = ($curr_page - 1) * $limit;

                    if(!empty($data['sort'])){
                        $sortArr = explode(':',$data['sort']);
                        $sortArr = array_values($sortArr);
                        $field = $sortArr[0];
                        $sort = $sortArr[1];
                        $sql_filter = '';
        
                        if(!empty($data['colors']) && !empty($data['sizes'])){
                            $sql_filter_color = '';
                            $sql_filter_size = '';
                            foreach ($data['colors'] as $item) {
                                $sql_filter_color .= " color LIKE '%".$item."%' OR";
                            }
        
                            foreach ($data['sizes'] as $item) {
                                $sql_filter_size .= " sizes LIKE '%".$item."%' AND";
                            }
        
                            $sql_filter_color = rtrim($sql_filter_color,'OR');
                            $sql_filter_size = rtrim($sql_filter_size,'AND'); 
        
                            $sql_filter = $sql_filter_color.' AND '.$sql_filter_size;
        
                        }else if(!empty($data['colors'])){
                            foreach ($data['colors'] as $item) {
                                $sql_filter .= " color LIKE '%".$item."%' OR";
                            }
                            $sql_filter = rtrim($sql_filter,'OR');
        
                        }else if(!empty($data['sizes'])){
                            foreach ($data['sizes'] as $item) {
                                $sql_filter .= " sizes LIKE '%".$item."%' OR";
                            }
                            $sql_filter = rtrim($sql_filter,'OR');  
                        }
                        
                        if(!empty($sql_filter)){
                            $sql = "SELECT * FROM products WHERE category_id=? AND ($sql_filter) 
                            ORDER BY $field $sort LIMIT $limit OFFSET $offset";
                            $product_count = $this->conn->prepare("SELECT * FROM products WHERE category_id=? AND $sql_filter");
                        }else {
                            $sql = "SELECT * FROM products WHERE category_id=? 
                            ORDER BY $field $sort LIMIT $limit OFFSET $offset";
                            $product_count = $this->conn->prepare("SELECT * FROM products WHERE category_id=?");
                        }
        
                    }else {
                        $sql = "SELECT * FROM products WHERE category_id=? LIMIT $limit OFFSET $offset";
                        $product_count = $this->conn->prepare("SELECT * FROM products WHERE category_id=?");
                    }

                }else {
                    $sql = "SELECT * FROM products WHERE category_id=?";
                }

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$category_id['id']]);
                $product_count->execute([$category_id['id']]);
                $product_count = $product_count->rowCount();
                $pages = ceil($product_count / $limit);
                return [
                    'stmt' => $stmt,
                    'pages' => $pages,
                ];

            }else {
                return false;
            }
        }else {
            return false;
        }
    }

    // get new products
    public function getNewProduct($data=null) {

        if(isset($data)){
            if(isset($data['limit'])){
                $limit = $data['limit'];
                $sql = "SELECT * FROM products WHERE is_new=? LIMIT $limit";
            }else {
                $sql = "SELECT * FROM products WHERE is_new=?";
            }
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([1]);
        return $stmt;
    }

    // get popular products
    public function getPopularProduct($data=null) {

        if(isset($data)){
            if(isset($data['limit'])){
                $limit = $data['limit'];
                $sql = "SELECT * FROM products WHERE is_popular=? LIMIT $limit";
            }else {
                $sql = "SELECT * FROM products WHERE is_popular=?";
            }
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([1]);
        return $stmt;
    }

    // get product detail
    public function getProductBySlug($slug='') {
        if(!empty($slug)){
            $sql = "SELECT p.id,p.category_id,p.name,p.oldPrice,p.newPrice,p.discount,p.description,p.color,p.sizes,p.images,p.quantity,p.status,
                    c.name as category_name,c.slug as category_slug
                    FROM products as p INNER JOIN categories as c
                    ON p.category_id = c.id 
                    AND p.slug=?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$slug]);

            if($stmt->rowCount() > 0) {
                return $stmt;
            }else {
                return false;
            }
        }else {
            return false;
        }
    }

    // get products related
    public function getProductsRelated($category_id=null) {
        if(isset($category_id)){
            $sql = "SELECT * FROM products WHERE category_id=? LIMIT 8";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$category_id]);

            if($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'stmt' =>$stmt
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm nào'
                ];  
            }

        }else {
            return [
                'success' => false,
                'message' => 'Có lỗi khi thực hiện lấy dữ liệu'
            ];  
        }
    }

    // search product
    public function searchProduct($keyword = '') {
        if(!empty($keyword)){
            $sql = "SELECT * FROM products WHERE name LIKE '%".$keyword."%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        }else {
            return false;
        }
    }

    // add comment
    public function addComment($data=null) {
        if(isset($data)){
            $sql = "INSERT INTO product_comments(user_id,product_id,title,content) VALUES(?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $data->userId,
                $data->productId,
                $data->title,
                $data->content,
            ]);

            if($stmt->rowCount() > 0){
                return [
                    'success' => true,
                    'message' => 'Bình luận sản phẩm thành công sẽ mất vài giây để upload bình luận của bạn vui lòng chờ',
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Bình luận sản phẩm không thành công',
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Bình luận sản phẩm không thành công',
            ]; 
        }
    }

    // get comments
    public function getProductComments($product_id=null){
        if(isset($product_id)){
            $sql = "SELECT U.name as user_name,PC.title,PC.content,PC.created_at 
                    FROM product_comments as PC INNER JOIN users as U ON PC.user_id = U.id
                    WHERE PC.product_id=? AND PC.status=1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$product_id]);

            if($stmt->rowCount() > 0){
                return [
                    'success' => true,
                    'stmt' => $stmt
                ];
            }else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy comemnt nào cho sản phẩm này'
                ];
            }

        }else {
            return [
                'success' => false,
                'message' => 'Có lỗi khi thực hiện lấy dữ liệu'
            ];
        }
    }
}