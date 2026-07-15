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
    <form class="js-qc-form">
      <?php wp_nonce_field( Progressive_Dev_Qc::NONCE, Progressive_Dev_Qc::NONCE ); ?>
      <div class="progressive-form__wrap">
        <img src="<?php echo esc_url( PA()->plugin_url() ); ?>/assets/images/proaddons_wizard.jpg" class="">
        <h2>Dev & SEO QC</h2>
        <p>This plugin will perform a quick Dev & SEO QC on your site.</p>
        <div class="form">

          <div class="form__group  form__group--left">
            <label class="form__label">City</label>
            <input name="city" type="text" id="city" aria-describedby="city" value="" placeholder="City" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <label class="form__label">State</label>

            <input name="state" type="text" id="state" aria-describedby="state" value="" placeholder="State" class="form__input">
          </div>

          <div class="clearfix"></div>
            
          <div class="form__group">
            <button type="submit" class="btn  btn--success  btn--large  js-devqc">Run QC</button>
          </div>
        </div>
      </div>
    </form>
    <div class="form  form--success  display-none">
          
        </div>

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
  <option value="{{ id }}">{{ title }}</option>
</script>