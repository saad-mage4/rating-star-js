<?php
// $star_rating = 2.5;
$con = mysqli_connect('localhost', 'root', 'admin123', 'testo');
$data = $con->query("SELECT * FROM `rating` WHERE `id`='1'");
$rating = mysqli_fetch_object($data);
$rating = $rating->rating;
?>
<!DOCTYPE html>
  <html>

  <head>
    <title>starRating, star rating jquery plugin</title>
    <link rel="stylesheet" type="text/css" href="../src/css/star-rating-svg.css">
    <link rel="stylesheet" type="text/css" href="css/demo.css">

  </head>

  <body>
  <div class="progress"></div>
    <!-- example using callback -->
    <span class="my-rating-9"></span>
    <span class="live-rating"></span>


    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto exercitationem commodi non quis vel hic, earum quam suscipit sapiente ut, ab iusto ipsum, provident facilis reiciendis odio rerum deleniti quaerat!</p>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda magnam, et tenetur, iste, quam tempora quaerat perspiciatis repellat in hic excepturi ipsam dolorem quia fugit accusamus amet placeat reiciendis atque sit rerum temporibus provident iure! Asperiores corrupti perferendis totam quisquam praesentium labore aliquid aspernatur tempore, enim, quibusdam, impedit obcaecati adipisci.</p>

    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga, ea, nam at architecto in reiciendis dolorum aperiam officiis aliquam quia odio non velit deleniti perspiciatis ut. Officia, veniam alias accusamus iusto aliquid sunt magni ullam ratione facilis maiores! Nihil inventore esse nulla odit repellendus et maiores ratione sequi commodi reiciendis. Ut ipsa recusandae optio perferendis totam. Perspiciatis rem ullam quasi totam sapiente accusamus illum officia veniam doloribus accusantium nihil voluptatem cum, quam ab molestias dolore libero atque distinctio sunt nesciunt reprehenderit! Minima rerum tempore distinctio, cum culpa sint magni fuga. Reiciendis eos incidunt nostrum quasi similique nihil iusto laudantium eum.</p>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../src/jquery.star-rating-svg.js"></script>
    <script>
      $(document).ready(function() {

        $(document).on("scroll", function(){
          var pixels = $(document).scrollTop();
          var pageHeight = $(document).height() - $(window).height();
          var progress = 100 * pixels / pageHeight;
          
          $("div.progress").css("width", progress + "%");
        })

        $('.live-rating').text(<?= $rating ?>);
        $(".my-rating-9").starRating({
          initialRating: <?= $rating ?>,
          starShape: 'rounded',
          disableAfterRate: true,
          onHover: function(currentIndex, currentRating, $el) {
            // do something on mouseover
            $('.live-rating').text(currentIndex);
          },
          callback: function(currentRating, $el) {
            $.ajax({
              url: 'update.php',
              method: 'post',
              data: {
                rating: currentRating
              },
              success: function(res) {
                $(".my-rating-9").starRating('setRating', res);
                $('.live-rating').text('Thank you for rating.');
                setTimeout(() => {
                  window.location.reload();
                }, 1500);
              }
            })
          }
        });
      });
    </script>
  </body>

  </html>