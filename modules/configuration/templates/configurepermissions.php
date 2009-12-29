<?php

	$bugs_response->setTitle(__('Configure permissions'));
	$bugs_response->addJavascript('config/permissions.js');

?>
<table style="table-layout: fixed; width: 100%" cellpadding=0 cellspacing=0>
	<tr>
		<?php include_component('configleftmenu', array('selected_section' => 5)); ?>
		<td valign="top">
			<div style="width: 750px;" id="config_permissions">
				<div class="configheader"><?php echo __('Configure permissions'); ?></div>
				<div class="rounded_box borderless" style="margin: 5px 0px 10px 0px; width: 750px;">
					<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
					<div class="xboxcontent" style="text-align: left; min-height: 85px;">
						<div class="header_div smaller" style="margin: 0 0 5px 0;"><?php echo __('Icon legend:'); ?></div>
						<div style="clear: both;">
							<?php echo image_tag('permission_unset_ok.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Not set (permissive system setting)'); ?></span>
							<?php echo image_tag('permission_unset_denied.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Not set (restrictive system setting)'); ?></span>
							<?php echo image_tag('permission_set_unset.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Not set (uses global permission)'); ?></span>
						</div>
						<div style="clear: both;">
							<?php echo image_tag('permission_set_ok.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Allowed'); ?></span>
							<?php echo image_tag('permission_set_denied.png', array('style' => 'float: left; margin: 0 5px 0 10px;')); ?><span style="float: left;"><?php echo __('Denied'); ?></span>
						</div>
						<div style="clear: both; padding: 10px 0 5px 5px;">
							<?php echo tbg_parse_text(__("Edit all global, group and team permissions from this page - user-specific permissions are handled from the user configuration page. The Bug Genie permissions are thoroughly explained in [[ConfigurePermissions]] in the wiki - look it up if you're ever stuck.")); ?>
						</div>
					</div>
					<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
				</div>
				<div class="header_div" style="margin-top: 15px;"><?php echo __('General permissions'); ?></div>
				<ul style="width: 750px;">
					<?php include_template('configuration/permissionsblock', array('base_id' => 'general_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('general'), 'mode' => 'general', 'target_id' => 0, 'module' => 'core', 'access_level' => $access_level)); ?>
					<?php include_template('configuration/permissionsblock', array('base_id' => 'general_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('issues'), 'mode' => 'general', 'target_id' => 0, 'module' => 'core', 'access_level' => $access_level)); ?>
				</ul>
				<div class="header_div" style="margin-top: 15px;"><?php echo __('Project-specific permissions'); ?></div>
				<?php if (count(BUGSproject::getAll()) > 0): ?>
					<ul>
						<?php foreach (BUGSproject::getAll() as $project): ?>
							<li>
								<a href="javascript:void(0);" onclick="$('project_permission_details_<?php echo $project->getID(); ?>').toggle();"><?php echo image_tag('icon_project_permissions.png', array('style' => 'float: right;')); ?><?php echo $project->getName(); ?> <span class="faded_medium smaller"><?php echo $project->getKey(); ?></span></a>
								<ul style="display: none;" id="project_permission_details_<?php echo $project->getID(); ?>">
									<?php include_component('configuration/permissionsblock', array('base_id' => 'project_' . $project->getID() . '_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('project'), 'mode' => 'general', 'target_id' => $project->getID(), 'module' => 'core', 'access_level' => $access_level)); ?>
									<?php include_component('configuration/permissionsblock', array('base_id' => 'project_' . $project->getID() . '_permissions', 'permissions_list' => BUGScontext::getAvailablePermissions('issues'), 'mode' => 'general', 'target_id' => $project->getID(), 'module' => 'core', 'access_level' => $access_level)); ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<div class="faded_medium" style="padding: 2px;"><?php echo __('There are no projects'); ?></div>
				<?php endif; ?>
			</div>
		</td>
	</tr>
</table>