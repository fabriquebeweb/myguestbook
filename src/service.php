<?
/**
 * Envoie les données du form en bdd
 */
function send() {
  global $wpdb;     
  $table_name = $wpdb->prefix . 'myguestbook';   
  
  $wpdb->insert($table_name, array(
    'message' => $_POST['message'],
    'name' => $_POST['name'],
  ));
}

/**
 * Verifie le contenu de la requete
 */
function prepare() {  
  if (! isset($_POST['name']) && ! isset($_POST['message'])) return;
  if( $_POST['name'] === "" ) $_POST['name'] = 'Anonymous';
  send();  
}
prepare();







