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
                <?php echo htmlspecialchars($post['post_excerpt']); ?>
            </p>
            <hr class="separator" size="2" color="black">
            <div class="article-description">
                <?php echo htmlspecialchars($post["post_description"]); ?>
            </div>
        </section>
    </article>
</main>



<?php require_once(SHARED_PATH . "/public_footer.php"); ?>