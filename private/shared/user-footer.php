<footer class="mt-5 p-5 bg-secondary text-light">
  
  <p>&copy; <?= date('Y'); ?> Union Climbing</p>
</footer>

</body>
<?php if(isset($bird->error_array)) {echo error_css($bird->error_array);} ; ?>
<?php if(isset($user->error_array)) {echo error_css($user->error_array);} ; ?>

</html>

<?php
  db_disconnect($database);
?>
