<?php if (isset($design_background_mode) && $design_background_mode == 'none'): ?>
div#Contents {
  background: none;
}
<?php endif ?>

<?php if (!empty($design_background)): ?>
div#Contents {
  background-color: <?php echo $design_background ?>;
}
<?php endif ?>

<?php if (!empty($design_text)):?>
body {
  color: <?php echo $design_text ?>;
}
<?php endif ?>

<?php if (!empty($design_links)):?>
#Contents a {
  color: <?php echo $design_links ?>;
}
<?php endif ?>
