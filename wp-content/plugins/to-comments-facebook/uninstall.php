<?php
 
// Vamos garantir que щ o WordPress que chama este ficheiro
// e que realmente estс a desistalar o plugin.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
  die();
 
// Vamos remover as opчѕes que criсmos na instalaчуo
delete_option('tcf_config');
 
?>