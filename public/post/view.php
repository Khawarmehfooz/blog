<?php 
    include("../../private/initialize.php");
    require_once(SHARED_PATH . '/public_header.php');
    $post_id = $_GET['id'] ?? '';
    $post = find_post_by_id($post_id);
?>
<main>
    <article>
        <figure>
            <img id="aritcle-image" src="<?php echo url_for("/images/demo-image.png") ?>" alt="">
        </figure>
        <section class="article-details">
            <h1 class="article-title">
                <?php echo $post['post_title']; ?>
            </h1>
            <p class="article-excerpt">
                ?<?php echo $post['post_excerpt'] ?>
            </p>
            <hr class="separator" size="2" color="black">
            <div class="article-description">
                <?php echo $post["post_description"]; ?>
            </div>
        </section>
    </article>
</main>



<?php require_once(SHARED_PATH . "/public_footer.php"); ?>