<?php

class Validator
{
    var $errors = [];

    public function userName($username)
    {
        if($username =="")
        {
            $error = "username can not be null";
        }
        elseif(!is_string($username))
        {
            $error = "username must be a string !";
        }
        elseif(strlen($username) < 4)
        {
            $error = "username must be greater than 4 characters";
        }
        elseif(strlen($username) > 100)
        {
            $error = "username must be less than 100 characters";
        }
        else
        {
            return $username ;
        };
        array_push( $this->errors , $error );
        return false;
    }

    public function userInfo($userinfo , $name_of_info)
    {
        if($userinfo == '')
        {
            $error = "$name_of_info can not be null";
        }
        elseif(!is_string($userinfo))
        {
            $error = "$name_of_info must be a string !";
        }
        elseif(strlen($userinfo) < 3)
        {
            $error = "$name_of_info must be greater than 3 characters";
        }
        elseif(strlen($userinfo) > 100)
        {
            $error = "$name_of_info must be less than 100 characters";
        }
        else
        {
            return $userinfo ;
        };
        array_push( $this->errors , $error );
        return false;
    }

    public function email($email)
    {
        if($email == '')
        {
            $error = "Email can not be null";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error = "Email must be valid !";
        }
        
        elseif(strlen($email) > 100)
        {
            $error = "Email must be less than 100 characters";
        }
        else
        {
            return $email ;
        };
        array_push( $this->errors , $error );
        return false;
    }

    public function password($password, $confirm_password = null) 
    //initial value of confirm_password equal null, 
    //this mean that's not necessary to pass it to this function 
    {
        if($password == '')
        {
            $error = "password can not be null";
        }
        elseif(!is_string($password))
        {
            $error = "password must be a string !";
        }
        elseif(strlen($password) < 4)
        {
            $error = "password must be greater than 4 characters";
        }
        elseif(strlen($password) > 50)
        {
            $error = "password must be less than 50 characters";
        }
        elseif($confirm_password != null && $password != $confirm_password)
        {
            $error = "password and confirm_password do not match";
        }
        else
        {
            return $password ;
        };
        array_push( $this->errors , $error );
        return false;

    }

    public function postTitle($postTitle)
    {
        if($postTitle =="")
        {
            $error = "Post Title can not be null";
        }
        elseif(!is_string($postTitle))
        {
            $error = "Post Title must be a string !";
        }
        elseif(strlen($postTitle) > 300)
        {
            $error = "Post Title must be less than 300 characters";
        }
        else
        {
            return $postTitle ;
        };
        array_push( $this->errors , $error );
        return false;
    }

    public function postDesc($postDesc)
    {
        if($postDesc =="")
        {
            $error = "Post Description can not be null";
        }
        elseif(!is_string($postDesc))
        {
            $error = "Post Description must be a string !";
        }
        elseif(strlen($postDesc) > 10000)
        {
            $error = "Post Description must be less than 10000 characters";
        }
        else
        {
            return $postDesc ;
        };
        array_push( $this->errors , $error );
        return false;
    }

    public function image($file_name, $file_error, $file_tmp_name)
    {
        //get image's path details
        $file_path_info = pathinfo($file_name);
        $ext = $file_path_info['extension'];

        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'tif'];

        if( $file_name == "")
        {
            $new_img_name = null;
            return $new_img_name;
        }
        elseif($file_error !== 0 && $file_error !== 4)
        {
            $error = "Error While Uploading Image";

        }
        elseif(!in_array($ext, $imageTypes))
        {
            $error = "This File Is Not An Image !";

        }
        else 
        {
            //prepare image fo upload:
            //make image name is uniq name
            $new_img_name = uniqid().$file_path_info['dirname'].$ext;
            //var_dump($new_img_name);

            //move uploaded image into server destination
            $destination = 'uploads/'.$new_img_name;
            move_uploaded_file($file_tmp_name, $destination);
            return $new_img_name ;
        }
        array_push($this->errors , $error);
        return false;
    }



    public function textField($text ,$textName)
    {
        if($text =="")
        {
            $error = "$textName field can not be null";
        }
        elseif(!is_string($text))
        {
            $error = "$textName field must be a string !";
        }
        elseif(strlen($text) > 300)
        {
            $error = "$textName field must be less than 300 characters";
        }
        else
        {
            return $text ;
        };
        array_push( $this->errors , $error );
        return false;
    }

}
?>