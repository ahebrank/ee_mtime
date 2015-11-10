<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 Get the file modification time as a Unix datestamp
 Useful for cachebusting

 @package       ee_mtime
 @subpackage    Plugins
 @category      Plugins
 @author        Andy Hebrank
 */

$plugin_info = array(
  'pi_name'     => 'ee_mtime',
  'pi_version'    => '0.1',
  'pi_author'     => 'Andy Hebrank',
  'pi_author_url'   => 'https://github.com/ahebrank',
  'pi_description'  => 'Ruturns a file modification time for use as a cache-buster',
  'pi_usage'      => ee_mtime::usage(),
);

// define the old-style EE object
if (!function_exists('ee')) {
    function ee() {
        static $EE;
        if (! $EE) {
          $EE = get_instance();
        }
        return $EE;
    }
}

class ee_mtime {

  public function __construct() {

    // use truncacted hash? default to yes
    $path = ee()->TMPL->fetch_param('path', null);
    if (is_null($path)) {
      $this->return_data = "nopath";
      return;
    }

    if (strpos($path, "/")!==0) {
      // relative path
      $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
    }

    if (!file_exists($path)) {
      $this->return_data = "notfound";
      return;
    }

    $this->return_data = filemtime($path);
  }

    
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.

  public static function usage() {
    ob_start(); ?>
Get the mtime of a file. File may be specified as absolute or relative to webroot. Returns 0 if something goes wrong.
  {exp:ee_mtime path="css/styles.css"}
<?php 
    return ob_get_clean();
  } // usage()

}?>