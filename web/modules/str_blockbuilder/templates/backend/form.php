<div id="stregtui-blockbuilder-setting">

   <script src="<?php echo base_path() . drupal_get_path('module', 'stregtui_blockbuilder') . '/vendor/tinymce/tinymce.min.js' ?>"></script>

    <?php  print stregtui_blockbuilder_admin($bid); ?>
    <input type="hidden" value="<?php print $bid ?>" id="stregtui_blockbuilder_id" name="stregtui_blockbuilder_id" />
    <input type="button" id="save" class="button button-action button--primary button--small" value="Save"/>
  </fieldset>
</div>  
