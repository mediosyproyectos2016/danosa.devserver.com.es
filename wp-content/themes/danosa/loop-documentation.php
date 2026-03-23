<?php
$image = get_field('image');
$file = get_field('file');
$video = get_field('video');

if(!empty($file)){
    $link = $file;
    $textLink = __("Download","danosa");
}elseif(!empty($video)){
    $link = $video;
    $textLink = __("View video","danosa");
}

if(empty($image)){
    $image = "/wp-content/uploads/2021/09/DANOSA_LOGO_blue.svg";
}                    
?>
<div class="wp-block-column content-list fade-top">
    <?php if(empty($video)){ ?>
    <a href="<?php echo $link; ?>" target="_blank">
        <figure class="wp-block-image size-large content-list-image">
            <img width="180" height="122" src="<?php echo $image; ?>" class="attachment-danosa-content-list size-danosa-content-list wp-post-image" alt="" loading="lazy">
        </figure>
    </a>
    <?php }else{
    $ytcode = getYoutubeCode($video);
   
    //echo "<iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";
    echo '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/'.$ytcode.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    ?>

    <?php } ?>
    <div class="wp-block-group">
        <div class="wp-block-group__inner-container">
            <h2><a href="<?php echo $link; ?>" target="_blank"><?php the_title(); ?></a></h2>
            <?php the_content(); ?>
        </div>
    </div>
    <?php if(empty($video)){ ?>
    <div class="wp-block-columns">
        <div class="wp-block-column" style="flex-basis:50%">
            <a href="<?php echo $link; ?>" target="_blank"><?php echo $textLink; ?> <i class="danosa-arrow-go"></i></a>
        </div>
    </div>
    <?php } ?>
</div>