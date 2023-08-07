<?php 
    include("../../private/initialize.php");
    require_once(SHARED_PATH . '/public_header.php');
    $post_id = htmlspecialchars($_GET['id']) ?? '';
    $post = find_post_by_id($post_id);
    if(!$post){
        $_SESSION['message'] = "Post Not Found!";
        redirect_to(url_for("/"));
        exit;
    }
    $allowed_tags = '<div><img><h1><h2><h3><h4><h5><h6><p><br><strong><em><ul><li>';
?>
<main>
    <article>
        <figure>
            <img id="aritcle-image" src="<?php echo url_for("/post/uploads/{$post['post_thumbnail']}") ?>" alt="">
        </figure>
        <section class="article-details">
            <h1 class="article-title">
                <?php echo htmlspecialchars($post['post_title']); ?>
            </h1>
            <p class="article-excerpt">
                <?php echo strip_tags($post['post_excerpt'],$allowed_tags); ?>
            </p>
            <hr class="separator" size="2" color="black">
            <div class="article-description">
                <?php echo strip_tags($post["post_description"],$allowed_tags); ?>
            </div>
        </section>
    </article>
</main>



<?php require_once(SHARED_PATH . "/public_footer.php"); ?>