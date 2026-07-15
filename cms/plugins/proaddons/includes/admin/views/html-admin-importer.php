<?php
/**
 * Admin View: ProAddons - Sitemap Reader
 *
 * @var string $view
 * @var object $addons
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
?>
<div class="pa-setup__content">
  <h1 class="pa-logo"><a href="https://progressivedental.com.com/"><img src="<?php echo esc_url( PA()->plugin_url() ); ?>/assets/images/proaddons_logo.png" alt="ProAddons" /></a></h1>
  <div class="pa-setup__box  animated pulse delay-5ms">
    <div class="loader">
      <div class="holder">
        <div class="box"></div>
      </div>
      <div class="holder">
        <div class="box"></div>
      </div>
      <div class="holder">
        <div class="box"></div>
      </div>
    </div>
    <form class="js-moving-form">
      <div class="progressive-form__wrap">
        <img src="<?php echo esc_url( PA()->plugin_url() ); ?>/images/proaddons_moving.jpg" class="">
        <h2>Page Import/Exporter</h2>
        <p>Enter the URL to the site you want to pull pages from.</p>
        <div class="form">
          <div class="form__group">
            <label class="form__label">WP Url</label>
            <input type="text" class="form__input  js-grab-posts-url" placeholder="Enter site url.">
          </div>
          
          <div class="form__group">
            <button type="submit" class="btn  btn--success  btn--large  js-grab-posts">Find Pages</button>
          </div>
        </div>
        <table class="table  table--create-page  display--none">
          <thead>
            <tr>
              <th>Page Title</th>
              <th>Import</th>
            </tr>
          </thead>
          <tbody class="js-posts-table">
            
          </tbody>
        </table>
        <!-- <div class="form  form--create-page  display--none">
          <div class="form__group">
            <label class="form__label">Select Pages</label>
            <select class="js-select-import-pages" name="pages[]" multiple="multiple">
              <option value="">Select Pages To Import</option>
            </select>
          </div>
          <div class="form__group">
            <button type="submit" class="btn  btn--success  btn--large  js-build-posts">Import Pages</button>
          </div>
        </div> -->
      </div>
    </form>

  </div>
</div>

<script id="test-template" type="x-tmpl-mustache">
  <tr class="iedit author-other level-0 type-page status-publish hentry">
    <td class="page column-page column-primary" data-colname="Page"><select class="js-select-page"><option value="">Select Page</option></select></td>
    <td class="title column-title has-row-actions" data-colname="Title">
      <strong>{{ 0 }}</strong>
    </td>
    <td class="slug column-slug" data-colname="Slug">{{ 1 }}</td>
    <td class="meta-title column-meta-title" data-colname="Meta Title">
      {{ 2 }}
    </td>
    <td class="desc column-desc" data-colname="Desc">{{ 3 }}</td>
  </tr>
</script>

<script id="page-import-template" type="x-tmpl-mustache">
  <tr>
    <td>{{ title }}</td>
    <td><button type="button" class="btn  btn--success  btn--med  js-build-posts" data-page-id="{{ id }}">Import Page</button></td>
  </tr>
</script>
