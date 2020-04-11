<?php

class Post
{

    //read all posts
    public function index()
    {

        global $conn;
    
        $sql ="SELECT posts.* , users.user_name, users.user_img
            FROM posts JOIN users 
            ON users.user_id = posts.user_id
            ORDER BY post_id DESC";
    
        $result = $conn->query($sql);
        $postsArray = [];
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result ->fetch_assoc()) {
                array_push($postsArray,$row);
            }
            return $postsArray;
        } 
        else 
        {
            return false;
        }
    
    }

    //read post details
    public function showPostDetails($post_id)
    {
        global $conn;
        
        $sql ="SELECT posts.* , users.*
            FROM posts JOIN users 
            ON users.user_id = posts.user_id
            WHERE post_id = '$post_id' ";
    
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) 
        {
            // output data of each row
            $postDetails = $result->fetch_assoc();
            return $postDetails;
        } 
        else 
        {
            return false;
        }
        
    }


    //read user posts
    public function showProfilePosts($user_id)
    {
        global $conn;
    
        $sql ="SELECT posts.* , users.*
            FROM posts JOIN users 
            ON users.user_id = posts.user_id
            where users.user_id = $user_id
            ORDER BY post_id DESC";
    
        $result = $conn->query($sql);
        $postsArray = [];
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result ->fetch_assoc()) {
                array_push($postsArray,$row);
            }
            return $postsArray;
        } 
        else 
        {
            return false;
        }
    

    }

    //add new post
    public function writePost($user_id, $postTitle ,$postBody, $postImg, $postTags, $readingTime)
    {
        
        global $conn;

        //avoid single quat errors
        $postTitle = $conn -> real_escape_string($postTitle) ;
        $postTags = $conn -> real_escape_string($postTags) ;
        $postBody = $conn -> real_escape_string($postBody) ;
        $postImg = $conn -> real_escape_string($postImg) ;

        $sql = "INSERT INTO `posts`
        (`user_id`, `post_title`, `post_desc`, `post_img`, `created_at`, `reading_time`) 
        VALUES 
        ('$user_id', '$postTitle', '$postBody', '$postImg', CURRENT_DATE, '$readingTime')";
        
        if ($conn->query($sql) == TRUE) {
            //get post id
            $last_id = $conn->insert_id;

            //secound Query
            $sql = "INSERT INTO `post_tags`
            (`post_id`, `post_tag`) 
            VALUES 
            ('$last_id', '$postTags')";
            
            if ($conn->query($sql) == TRUE) {
                //redirection
                header('location:profile.php');
            }else
            {
                return false;
            }
        } 
        else 
        {
        return false;
        }
    }

    //update post
    public function update($post_id, $postTitle, $postBody,$postTags)
    {
        global $conn;

        //avoid single quat errors
        $postTitle = $conn -> real_escape_string($postTitle) ;
        $postBody = $conn -> real_escape_string($postBody) ;
        $postTags = $conn -> real_escape_string($postTags) ;

        $sql = "UPDATE posts SET 
        post_title = '$postTitle',
        post_desc = '$postBody'
        WHERE
        post_id = '$post_id'
        ";

        if ($conn->query($sql) == TRUE) {

            $sql = "UPDATE `post_tags` 
            SET 
            `post_tag`= '$postTags' 
            WHERE 
            post_tags.post_id = $post_id";

            if ($conn->query($sql) == TRUE)
            {
                return true;
                //header('location:profile.php');
            }else
            {
                return false;
            }

        }
        else
        {
            return false;
        }


    }

    //delete post
    public function delete($post_id, $user_id)
    {
        global $conn ;

        $sql = " DELETE from posts
        where post_id = '$post_id'
        AND `user_id` = '$user_id' ";

        if ($conn->query($sql) == TRUE) 
        {
            return true;
        }else
        {
            return false;
        }
    }

    //calculate reading time
    //by depending on medium article, avg of reading time of adult peaple [200 - 225]words per minute
    public function calcReadingTime($desc)
    {
        $words_no = str_word_count($desc); //get words number
        $word_per_min = $words_no / 205;   //avg reading time
        $time = round($word_per_min);       //format number of minutes 
        return $time;
    }
    
    //get trend posts
    public function trend()
    {
        global $conn;
    
        $sql ="SELECT post_title , SUM(save_no+like_no)
        FROM `posts`
        GROUP BY post_title
        ORDER BY SUM(save_no+like_no) DESC
        LIMIT 5";
    
        $result = $conn->query($sql);
        $postsArray = [];
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result ->fetch_assoc()) {
                array_push($postsArray,$row);
            }
            return $postsArray;
        } 
        else 
        {
            return false;
        }
    

    }

}

?>