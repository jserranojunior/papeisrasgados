<?
$reg = get_option('tcf_config');

if($reg['comments_link'] == 'permalink')
  $tmf_link = get_the_permalink();
else
  $tmf_link = get_option('home') . '/?p=' . get_the_ID();
?>
<!-- Script que adiciona Comentários do Facebook -->
<div id="fb-root">

</div>
<script>
  (function(d, s, id) {

    var js, fjs = d.getElementsByTagName(s)[0];

    if (d.getElementById(id))
      return;

    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }

    (document, 'script', 'facebook-jssdk')
  );

</script>

<?
if($reg['comments_insert'] == 'after')
  require_once($reg['comments_url_native']);
?>

<?= $reg['comments_beforeHTML']; ?>

<!-- Script de Comentários do Facebook -->
<div id="fb-root"></div>

<script  src="http://connect.facebook.net/en_BR/all.js#fml=1"></script>
<fb:comments href="<?= $tmf_link; ?>" width="100%">

</fb:comments>

<?= $reg['comments_afterHTML']; ?>

<?
if($reg['comments_insert'] == 'before')
  require_once($reg['comments_url_native']);
?>