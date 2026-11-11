<?php

if ( !defined( "bof_root" ) ) die;

$Config = array(

  "name" => "Shadyf0n",
  "detail" => "Shady, for the phone",
  "version" => 1060,
  "iconset" => "materialdesignicons",
  "supported_objects" => array(
    "user",
    "ugc_playlist",
    "m_album" => "_series",
    "m_artist" => "_creator",
    "m_track" => "_single",
    "m_genre" => "_cat",
    "m_tag" => "_cat",
    "m_mix" => "_single",
    "mb_beat" => "_single",
    "mb_pack" => "_series",
    "mb_producer" => "_creator",
    "mb_tag" => "_cat",
    "mb_genre" => "_cat",
    "mb_mood" => "_cat",
    "r_station" => "_single",
    "r_region" => "_cat",
    "r_country" => "_cat",
    "r_city" => "_cat",
    "r_language" => "_cat",
    "r_category" => "_cat",
    "p_podcaster" => "_creator",
    "p_show" => "_series",
    "p_episode" => "_single",
    "p_category" => "_cat",
    "p_tag" => "_cat",
    "a_book" => "_series",
    "a_writer" => "_creator",
    "a_narrator" => "_creator",
    "a_translator" => "_creator",
    "a_language" => "_cat",
    "a_genre" => "_cat",
    "a_tag" => "_cat",
    "b_tag" => "_cat",
    "b_category" => "_cat",
    "b_post" => "_post"
  ),
  "parts" => array(
    array(
      "parts/header",
      array(
        "base" => "__SELF__",
        "dir" => false,
      )
    ),
    array(
      "parts/footer",
      array(
        "base" => "__SELF__",
        "dir" => false,
        "target" => "body #main .loader"
      )
    ),
    array(
       "parts/navbar",
      array(
        "base" => "__SELF__",
        "dir" => false,
      )
    )
  ),
  "assets" => array(
    "css" => array(
      array(
        "name" => "style",
        "path" => "assets/css/minified/_s.css",
        "base" => "__SELF__",
        "dir" => false,
      ),
      array(
        "name" => "mobile",
        "path" => "assets/css/15_mobile.css",
        "base" => "__SELF__",
        "dir" => false,
        "mobileOnly" => true
      ),
      array(
        "name" => "upload",
        "path" => "assets/css/25_upload.css",
        "base" => "__SELF__",
        "dir" => false,
        "type" => "css",
        "uploadOnly" => true
      )
    ),
    "js" => array(
      array(
        "name" => "theme",
        "path" => "assets/js".(production?"/minified":"")."/theme.js",
        "base" => "__SELF__",
        "dir"  => false
      )
    ),
  ),
  "admin_assets" => array(
    "page_builder" => array(
      /*"js" => array(
        array(
          "name" => "shady_admin",
          "path" => "assets/js/shady_admin.js",
          "base" => "__SELF__",
          "dir" => false
        )
      ),
      "css" => array(
        array(
          "type" => "css",
          "name" => "shady_admin_css",
          "path" => "assets/css/shady_admin.css",
          "base" => "__SELF__",
          "dir" => false
        )
      )*/
    )
  ),
  /*"page_themes" => array(
    "user_auth" => array(
      "file" => "pages/login",
      "args" => array(
        "base" => "__SELF__"
      )
    )
  )*/

);

if (!function_exists("theme_load_menus")) {
  function theme_load_menus($BOF){

    $menus_ps = bof()->object->db_setting->get("menus_ps", array(
      "desk" => 1,
      "mob" => 2,
      "footer" => null
    ));

    $_menus = array(
      "sidebar" => bof()->request->is_mobile() ? null : bof()->object->menu->get($menus_ps["desk"]),
      "footer" => !empty($menus_ps["footer"]) ? bof()->object->menu->get($menus_ps["footer"]) : null,
      "sidebar_fl" => bof()->request->is_mobile() ? bof()->object->menu->get($menus_ps["mob"]) : null
    );

    return $_menus;
    
  }
}

if ( rawmean && !production ){
  $Config["assets"]["css"] = [];
  $css_dir = dirname(__FILE__) . "/assets/css";
  $css_dir_ents = scandir( $css_dir );
  foreach( $css_dir_ents as $css_dir_ent ){
    $css_dir_ent = realpath( "{$css_dir}/{$css_dir_ent}" );
    if ( pathinfo( $css_dir_ent, PATHINFO_EXTENSION ) == "css" ){
      $name = pathinfo( $css_dir_ent, PATHINFO_FILENAME );
      if ( $name == "shady_admin" || $name == "style" ) continue;
      array_unshift( $Config["assets"]["css"], array(
        "name" => "{$name}",
        "path" => "assets/css/{$name}.css",
        "base" => "__SELF__",
        "dir" => false,
      ) );
    }
  }
}

?>
