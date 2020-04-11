<?php

class React
{

    //Save Reaction
    public function savePost($post_id, $user_id)
    {
        global $conn;

        $sql ="INSERT INTO `saves`
               (`post_id`, `user_id`, `is_saved`) 
                VALUES ('$post_id','$user_id', true)"; //is_saved = true
        
        $saveResult = $conn->query($sql);
        return $saveResult ; //boolean

    }
    
   
}

?>