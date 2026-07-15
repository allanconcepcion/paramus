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
<div class="pa-setup__content  pa-setup__content--large">
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
    <form class="js-search-replace-form">
      <input type="hidden" name="action" value="run_search_and_replace" />
      <div class="progressive-form__wrap">
        <!-- <img src="http://williamwang/wp-content/plugins/proaddons/assets/images/proaddons_moving.jpg" class=""> -->
        <h2>Search & Replace</h2>
        <p>This plugin will search the post content, image names and alt tags, SEO meta data and url structure and perform a search and replace.</p>
        <div class="form">
          <!-- <div class="form__group">
            <label class="form__label">Content has no variables</label>
            <input name="usebanda" type="checkbox" id="usebanda" aria-describedby="usebanda" value="true" class="regular-text code  form__input">
          </div> -->
          <div class="form__group  form__group--left">
            <label class="form__label">Practice Name</label>
            <input name="practicename" type="text" id="practicename" aria-describedby="practicename" value="" placeholder="Old Value" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <!-- <label class="form__label">New Practice Name</label> -->
            <input name="newpracticename" type="text" id="newpracticename" aria-describedby="newpracticename" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">Dentist Name</label>
            <input name="dentistname" type="text" id="dentistname" aria-describedby="dentistname" value="" placeholder="Old Value" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newdentistname" type="text" id="newdentistname" aria-describedby="newdentistname" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">City</label>
            <input name="city" type="text" id="city" aria-describedby="city" value="" placeholder="Old Value" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newcity" type="text" id="newcity" aria-describedby="newcity" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">State</label>
            <input name="state" type="text" id="state" aria-describedby="state" value="" placeholder="Old Value" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newstate" type="text" id="newstate" aria-describedby="newstate" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">Street</label>
            <input name="street" type="text" id="street" aria-describedby="street" value="" placeholder="Old Value" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newstreet" type="text" id="newstreet" aria-describedby="newstreet" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">Suite/Appt #</label>
            <input name="appt" type="text" id="appt" aria-describedby="appt" value="" placeholder="Old Value" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newappt" type="text" id="newappt" aria-describedby="newappt" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">Zip</label>
            <input name="zip" type="text" id="zip" aria-describedby="zip" value="" placeholder="Old Value" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newzip" type="text" id="newzip" aria-describedby="newzip" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">New Patient</label>
            <input name="npnumber" type="text" id="npnumber" aria-describedby="npnumber" value="Old Value" placeholder="" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newnpnumber" type="text" id="newnpnumber" aria-describedby="newnpnumber" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="form__label">Current Patient</label>
            <input name="cpnumber" type="text" id="cpnumber" aria-describedby="cpnumber" value="Old Value" placeholder="" class="form__input">
          </div>
          <div class="form__group  form__group--right">
            <input name="newcpnumber" type="text" id="newcpnumber" aria-describedby="newcpnumber" value="" placeholder="New Value" class="form__input">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="">Update SEO Data</label>
            <input name="updateseo" type="checkbox" id="updatealt" aria-describedby="updatealt" value="true" class="regular-text code">
          </div>
          <div class="form__group  form__group--right">
            <label class="">Update Page Slugs</label>
            <input name="updateslug" type="checkbox" id="updateslug" aria-describedby="updateslug" value="true" class="regular-text code">
          </div>

          <div class="clearfix"></div>

          <div class="form__group  form__group--left">
            <label class="">Update Alt Tags</label>
            <input name="updatealt" type="checkbox" id="updatealt" aria-describedby="updatealt" value="true" class="regular-text code">
          </div>
          <div class="form__group  form__group--right">
            <label class="">Update Page Content</label>
            <input name="updatecontent" type="checkbox" id="updatecontent" aria-describedby="updatecontent" value="true" class="regular-text code">
          </div>

          <div class="clearfix"></div>
            
          <div class="form__group">
            <button type="submit" class="btn  btn--success  btn--large  js-replace-content">Replace Content</button>
          </div>
        </div>
        <div class="form  form--success  display-none">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" class="checkmark">
            <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
            <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
          </svg>
        </div>
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
  <option value="{{ id }}">{{ title }}</option>
</script>
