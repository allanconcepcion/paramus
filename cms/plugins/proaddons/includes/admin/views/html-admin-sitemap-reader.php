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

    <form class="pd-wizard js-sitemap-form">
      <div class="progressive-form__wrap">
        <img src="<?php echo esc_url( PA()->plugin_url() ); ?>/assets/images/proaddons_wizard.jpg">
        <h2>Upload Sitemap</h2>
        <p>Upload the sitemap provided by SEO to update the meta data and page slugs sitewide. </p>
        <div class="form-group">
          <button type="submit" class="btn  btn--large  btn--success  form__submit">Upload</button>
          <input type="file" name="sitemap" class="form__input  form__input--file  js-upload-sitemap">
        </div>
      </div>
    </form>
    <div class="pa-wizard  display-none">
      <div class="pa-success  display-none">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" class="checkmark">
            <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
            <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
          </svg>
      </div>
      <div class="pa-progress">
        <div class="pa-progress__bar">
          <span></span>
        </div>
        <span class=""><b>1</b> of <b></b></span>
      </div>
      <h2>Select Matching Page</h2>
      <div class="swiper-container">
        <div class="swiper-wrapper">

        </div>
        <div class="swiper-buttons">
          <div class="swiper-buttons__left">
            <div class="js-swiper-prev">

<svg width="23px" height="13px" viewBox="0 0 23 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Desktop-Copy" transform="translate(-203.000000, -644.000000)" fill="#000000" fill-rule="nonzero">
            <g id="long-arrow-left" transform="translate(203.000000, 644.000000)">
                <path d="M7.03192414,12.8214848 L7.39494464,12.4624612 C7.6355208,12.2245001 7.6355208,11.838664 7.39494464,11.6006521 L3.08613626,7.36325945 L22.3839279,7.36325945 C22.7241537,7.36325945 23,7.09041166 23,6.75388416 L23,6.24607141 C23,5.9095439 22.7241537,5.63669611 22.3839279,5.63669611 L3.08613626,5.63669611 L7.39494464,1.39930342 C7.6355208,1.16134236 7.6355208,0.775506238 7.39494464,0.537494403 L7.03192414,0.17847079 C6.79134798,-0.0594902634 6.40127165,-0.0594902634 6.16069549,0.17847079 L0.180432121,6.06909867 C-0.0601440403,6.30705972 -0.0601440403,6.69289585 0.180432121,6.93090768 L6.16069549,12.8215356 C6.40127165,13.0594966 6.79134798,13.0594966 7.03192414,12.8214848 Z" id="Shape"></path>
            </g>
        </g>
    </g>
</svg>Previous</div>
          </div>
          <div class="swiper-buttons__right">
            <button class="btn  btn--large  btn--success  js-swiper-next">NEXT</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script id="swiper-template" type="x-templ-mustache">
  <div class="pa-wizard__step  swiper-slide">
    <span class="pa-wizard__page-title" data-id="{{ id }}" data-parent="{{ parent }}">Sitemap Page: <span>{{ title }}</span></span>
    <div class="form">
      <div class="form__group">
        <label class="form__label">WP Page</label>
        <select class="form__input  js-select-wp-page" name="wp-page">
          <option value="">Select WP Page</option>
        </select>
      </div>
      <div class="form__group  form__group--left">
        <label>Create page from this template?</label>
        <input type="checkbox" value="yes" name="create_from_template" checked>
      </div>
      <div class="form__group  form__group--right">
        <label>Create blank page?</label>
        <input type="checkbox" value="yes" name="create_blank">
      </div>
      <div class="clearfix"></div>
      <div class="form__group">
        <label class="form__label">Metadata Page</label>
        <select class="form__input  js-select-metadata-page" name="meta-page">
          <option value="">Select Metadata Page</option>
        </select>
      </div>
    </div>
  </div>
</script>

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

<script id="option-template" type="x-tmpl-mustache">
  <option value"{{ 0 }}" data-post-id="{{ parent }}" data-slug="{{ 1 }}" data-title="{{ 2 }}" data-desc="{{ 3 }}">{{ 0 }}</option>
</script>

<script id="wp-option-template" type="x-tmpl-mustache">
  <option value"{{ ID }}" data-post-id="{{ ID }}">{{ post_title }}</option>
</script>

<script id="final-slide" type="x-tmpl-mustache">
  <div class="pa-wizard__step  swiper-slide">
    <button class="btn  btn--large  btn--success  js-swiper-final">Run Uploader</button>
  </div>
</script>