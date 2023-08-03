<?php
    class Post{
        public $post_title,$post_excerpt,$post_description,$post_thumbnail;

        public function __construct($post_title,$post_excerpt,$post_description,$post_thumbnail=""){
            $this->post_title=$post_title;
            $this->post_excerpt = $post_excerpt;
            $this->post_description = $post_description;
            $this->post_thumbnail = $post_thumbnail; 
        }

        public function createPost(){
            $result = insert_post($this->post_title,$this->post_excerpt,$this->post_description,$this->post_thumbnail);
            return $result;

        }
    }
?>