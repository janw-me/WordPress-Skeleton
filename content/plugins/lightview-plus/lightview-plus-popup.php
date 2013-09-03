<?php
if (!defined('ABSPATH')) include_once(dirname(__FILE__).'/../../../wp-blog-header.php');
	require_once(ABSPATH . '/wp-admin/admin.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="lightview-plus.js"></script>
	<base target="_self" />
	<style type="text/css">
		#lightviewplus .panel_wrapper, #lightviewplus div.current {
			height: 265px;
			padding-top: 5px;
		}
		#portal_insert, #portal_cancel, #select_insert, #select_cancel, #upload_insert, #upload_cancel, #remote_insert, #remote_cancel {
					font: 14px Verdana, Arial, Helvetica, sans-serif;
					height: auto;
					width: auto;
					background-color: transparent;
					background-image: url(../../../../../wp-admin/images/fade-butt.png);
					background-repeat: repeat;
					border: 3px double;
					border-right-color: rgb(153, 153, 153);
					border-bottom-color: rgb(153, 153, 153);
					border-left-color: rgb(204, 204, 204);
					border-top-color: rgb(204, 204, 204);
					color: rgb(51, 51, 51);
					padding: 0.75em 1.00em;
		}
		#portal_insert:active, #portal_cancel:active, #select_insert:active, #select_cancel:active, #upload_insert:active, #upload_cancel:active, #remote_insert:active, #remote_cancel:active {
					background: #f4f4f4;
					border-left-color: #999;
					border-top-color: #999;
		}
	</style>
	<title><?php echo _e('Lightview Plus','lightviewplus'); ?></title>
</head>

<body id="lightviewplus" onload="<?php $tab = (isset($_GET['tab'])) ? $_GET['tab'] : $_POST['tab']; echo "mcTabs.displayTab('".$tab."_tab','".$tab."_panel');"; if ($_GET['tab']=='portal') echo "document.forms.portal_form.vid.style.backgroundColor = '#f30';" ?>tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none">

<div class="tabs"></div> 

<div class="panel_wrapper">
<div id="portal_panel" class="current">
	<form name="portal_form" action="#">
		<table border="0" cellpadding="4" cellspacing="0">
			<tr>
			<td nowrap="nowrap" style="text-align:right;"><?php echo _e('Select video portal:','lightviewplus'); ?></td>
			<td>
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><select name="portal" id="portal_portal" style="width: 350px" onChange="dailymotion(this, this.form.linktext, this.form.nolink);">
					<option value="youtube">YouTube</option>
					<option value="vimeo">vimeo</option>
					<option value="bliptv">Blip.TV</option>
                  </select>
                  </td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td nowrap="nowrap" style="text-align:right;"><?php echo _e('Insert video ID:','lightviewplus'); ?></td>
            <td>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><input name="vid" type="text" id="portal_vid" value="" style="width: 350px" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td nowrap="nowrap"></td>
            <td>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><input name="nolink" type="checkbox" id="portal_nolink" onClick="disable_enable(this, this.form.linktext);" /></td>
                  <td><?php echo _e('Show video without link','lightviewplus'); ?></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td nowrap="nowrap" style="text-align:right;"><?php echo _e('Link text:','lightviewplus'); ?></td>
            <td>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><input name="linktext" type="text" id="portal_linktext" value="<?php echo $_GET['linktext']; ?>" style="width: 350px" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>
	    <input type="submit" id="portal_insert" name="insert" value="<?php echo _e('Insert','lightviewplus'); ?>" onclick="lp_checkData(this.form);" />
            </td>
            <td align="right"><input type="button" id="portal_cancel" name="cancel" value="<?php echo _e('Cancel','lightviewplus'); ?>" onclick="tinyMCEPopup.close();" /></td>
          </tr>
        </table>
      <input type="hidden" name="tab" value="portal" />
    </form>
  </div>
</div>

</body>
</html>
