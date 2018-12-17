<?php
function console_log( $data )
{
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>

<?php
function file_log( $data )
{
  $file = 'log.txt';
  $current = file_get_contents($file);
  $current .= "\n".$data."\n";
  file_put_contents($file, $current);
}
?>
