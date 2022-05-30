<?php
    require "header.php";
?>

<link rel="stylesheet" href="../../css/kurumanasayfa.css?v=<?php echo time(); ?>">

    <main>
        <?php
            if (isset($_SESSION['svb_id'])) {
               
                    echo '<div class="x">';
                  echo '<img src=" " id="image">';
                  echo  '</div>';
            }
        ?>
        
    </main>
    
    <script>
        let image=document.getElementById('image');
        let images=['../../images/style_images/s1s.jpg','../../images/style_images/s2s.jpg']
        setInterval(function() {
            let random=Math.floor(Math.random() *2); /* because of the two pictures*/
            image.src=images[random];
        }, 2000);
        image.style.width='100%';
        image.style.height='100%';
    </script>