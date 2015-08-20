<div class="wrap">
    <h2>Dynamic Templates</h2>
    <div class="fieldset-wrapper">
        <form id="dynamic-templates" action="" method="post" accept-charset="UTF-8">
            <input type="hidden" name="drbase_templates" value="<?php echo $encoded_serialized_templates;?>">
            <a href="#" class="dexp-add-layout"><i class="fa fa-plus-circle"></i> Add Templates</a>
            <ul id="dexp_layouts">
            </ul>
            <ul id="dexp_sections" class="ui-sortable"></ul>
            <div id="drupalexp_add_section"><a href="#"><i class="fa fa-plus-circle"></i> Add section</a></div>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
        </form>
    </div>
</div>
<!-- Dialog Form -->
<!-- Add Section -->
<div id="drupalexp_add_section_dialog" title="Add section">Section: <input type="text" class="form-text" name="section_name"/></div>
<!-- Section Settings -->
<div id="edit-drupalexp-section-settings" title="Section settings">
    <div class="form-item form-type-textfield form-item-section-title">
    <label for="edit-section-title">Section </label>
    <input type="text" id="edit-section-title" name="section_title" value="" size="" maxlength="128" class="form-text">
    </div>
    <div class="form-item form-type-select form-item-section-fullwidth">
      <label for="edit-section-fullwidth">Full width </label>
     <select id="edit-section-fullwidth" name="section_fullwidth" class="form-select"><option value="no">No</option><option value="yes">Yes</option></select>
    </div>
    <div class="form-item form-type-checkboxes form-item-section-visible">
      <label for="edit-section-visible">Visible </label>
     <div id="edit-section-visible" class="form-checkboxes .row"><div class="form-item form-type-checkbox form-item-section-visible-vphone col-md-4">
     <input type="checkbox" id="edit-section-visible-vphone" name="section_visible[vphone]" value="vphone" class="form-checkbox">  <label class="option" for="edit-section-visible-vphone">Visible Phone </label>

    </div>
    <div class="form-item form-type-checkbox form-item-section-visible-vtablet col-md-4">
     <input type="checkbox" id="edit-section-visible-vtablet" name="section_visible[vtablet]" value="vtablet" class="form-checkbox">  <label class="option" for="edit-section-visible-vtablet">Visible Tablet </label>

    </div>
    <div class="form-item form-type-checkbox form-item-section-visible-vdesktop col-md-4">
     <input type="checkbox" id="edit-section-visible-vdesktop" name="section_visible[vdesktop]" value="vdesktop" class="form-checkbox">  <label class="option" for="edit-section-visible-vdesktop">Visible Desktop </label>

    </div>
    <div class="form-item form-type-checkbox form-item-section-visible-hphone col-md-4">
     <input type="checkbox" id="edit-section-visible-hphone" name="section_visible[hphone]" value="hphone" class="form-checkbox">  <label class="option" for="edit-section-visible-hphone">Hidden Phone </label>

    </div>
    <div class="form-item form-type-checkbox form-item-section-visible-htablet col-md-4">
     <input type="checkbox" id="edit-section-visible-htablet" name="section_visible[htablet]" value="htablet" class="form-checkbox">  <label class="option" for="edit-section-visible-htablet">Hidden Tablet </label>

    </div>
    <div class="form-item form-type-checkbox form-item-section-visible-hdesktop col-md-4">
     <input type="checkbox" id="edit-section-visible-hdesktop" name="section_visible[hdesktop]" value="hdesktop" class="form-checkbox">  <label class="option" for="edit-section-visible-hdesktop">Hiddeny Desktop </label>

    </div>
    </div>
    </div>
    <div class="form-item form-type-textfield form-item-section-background-color">
      <label for="edit-section-background-color">Background color </label>
     <input type="text" id="edit-section-background-color" name="section_background_color" value="" size="" maxlength="128" class="form-text">
    </div>
    <div class="form-item form-type-checkbox form-item-section-sticky">
     <input type="checkbox" id="edit-section-sticky" name="section_sticky" value="1" class="form-checkbox">  <label class="option" for="edit-section-sticky">Sticky on top </label>

    </div>
    <div class="form-item form-type-textfield form-item-section-custom-class">
      <label for="edit-section-custom-class">Custom class </label>
     <input type="text" id="edit-section-custom-class" name="section_custom_class" value="" size="" maxlength="128" class="form-text">
    </div>
    <div class="form-item form-type-textfield form-item-section-colpadding">
      <label for="edit-section-colpadding">Custom column padding </label>
     <input type="text" id="edit-section-colpadding" name="section_colpadding" value="" size="" maxlength="128" class="form-text"> <span class="field-suffix">px</span>
    <div class="description">Leave blank to use default bootstrap padding (15px)</div>
    </div>
</div>
<!-- Region Settings -->
<?php 
    function optionsToHtml() {
        $coloptions = array( 
            1=>'1 col',
            2=>'2 cols',
            3=>'3 cols',
            4=>'4 cols',
            5=>'5 cols',
            6=>'6 cols',
            7=>'7 cols',
            8=>'8 cols',
            9=>'9  cols',
            10=>'10 cols',
            11=>'11 cols',
            12=>'12 cols'
        );
        foreach ($coloptions as $key => $value) {
            echo "<option value='$key'>$value</option>";
        }
    }
?>
<div id="edit-drupalexp-region-settings" title="Region settings">
    <div class="form-item form-type-select form-item-region-col-lg col-md-3">
        <span class="field-prefix"><i class="fa fa-desktop"></i></span> 
        <select id="edit-region-col-lg" name="region_col_lg" class="form-select">
            <?php optionsToHtml();?>
        </select>
    </div>
    <div class="form-item form-type-select form-item-region-col-md col-md-3">
        <span class="field-prefix"><i class="fa fa-laptop"></i></span> 
        <select id="edit-region-col-md" name="region_col_md" class="form-select">
            <?php optionsToHtml();?>
        </select>
    </div>
    <div class="form-item form-type-select form-item-region-col-sm col-md-3">
        <span class="field-prefix"><i class="fa fa-tablet"></i></span>
        <select id="edit-region-col-sm" name="region_col_sm" class="form-select">
            <?php optionsToHtml();?>
        </select>
    </div>
    <div class="form-item form-type-select form-item-region-col-xs col-md-3">
        <span class="field-prefix"><i class="fa fa-mobile-phone"></i></span>
        <select id="edit-region-col-xs" name="region_col_xs" class="form-select">
            <?php optionsToHtml();?>
        </select>
    </div>
</div>