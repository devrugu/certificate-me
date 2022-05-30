<?php
    require "header.php";
?>
 
<link rel="stylesheet" href="../../css/katilimciana.css?v=<?php echo time(); ?>">

    <main>
        <?php
            if (isset($_SESSION['ka_id'])) {
                echo '<div class="x">';
              echo '<img id="image">';
              echo  '</div>';
            } 
        ?>
        
      
    </main>

<script type="text/javascript">
    let image=document.getElementById('image');
    let images=['../../images/style_images/pp.png'];
    image.src=images[0];
    image.style.width='100%';
    image.style.height='150%';
</script>