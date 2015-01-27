<?php
/**
 * @file
 * template.php
 */

/**
 * Returns HTML for an image using a specific Colorbox image style.
 *
 * @param $variables
 *   An associative array containing:
 *   - image: image item as array.
 *   - path: The path of the image that should be displayed in the Colorbox.
 *   - title: The title text that will be used as a caption in the Colorbox.
 *   - gid: Gallery id for Colorbox image grouping.
 *
 * @ingroup themeable
 */
function azori_colorbox_imagefield($variables) {
  $class = array('colorbox');

  if ($variables['image']['style_name'] == 'hide') {
    $image = '';
    $class[] = 'js-hide';
  }
  elseif (!empty($variables['image']['style_name'])) {
    $image = theme('image_style', $variables['image']);
  }
  else {
    $image = theme('image', $variables['image']);
  }

  $options = drupal_parse_url($variables['path']);
  $options += array(
    'html' => TRUE,
    'attributes' => array(
      'title' => $variables['title'],
      'class' => $class,
      'rel' => $variables['gid'],
    ),
    'language' => array('language' => NULL),
  );

// original colorbox markup ends here
  $colorboxlink = l($image, $options['path'], $options);

  $options = drupal_parse_url($variables['path']);
  $options += array(
    'html' => TRUE,
    'attributes' => array(
      'title' => $variables['title'],
      'class' => 'colorbox-download',
			'target' => '_new',
    ),
    'language' => array('language' => NULL),
  );
  $imagelink = l("Download", $options['path'], $options);

  return '<div class="colorbox-wrapper">'.$colorboxlink.$imagelink.'<span class="colorbox-magnifier">+</span></div>';
}