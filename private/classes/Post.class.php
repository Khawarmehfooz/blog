<?php
    class Post{
        public $post_title,$post_excerpt,$post_description,$publish_date,$post_thumbnail;

        public function __construct($post_title,$post_excerpt,$post_description,$publish_date, $post_thumbnail=""){
            $this->post_title=$post_title;
            $this->post_excerpt = $post_excerpt;
            $this->post_description = $post_description;
            $this->publish_date = $publish_date;
            $this->post_thumbnail = $post_thumbnail; 
        }

        public function createPost(){
            $result = insert_post($this->post_title,$this->post_excerpt,$this->post_description,$this->publish_date,$this->post_thumbnail);
            return $result;
        }
        public function viewPost($id){
            $result = find_post_by_id($id);
            return $result;

        }
    }
?>