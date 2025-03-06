<?php
/*
		Template Name: Page no header no footer
*/

get_header();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<div class="page page-default">
  <div class="page-content">
    <?php the_content(); ?>
  </div>

</div>
<style>
  #header,
  .footer {
    display: none;
  }

  .page-content {
    padding: 0 !important;
  }
</style>


<script>
  AOS.init({
    duration: 1200,
  });

  $(window).on('load', function() {
    AOS.refresh();
  });
</script>

<?php get_footer(); ?>