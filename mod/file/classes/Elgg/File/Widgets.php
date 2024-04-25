<?php

namespace Elgg\File;

/**
 * Widget related functions
 */
class Widgets {
	
	/**
	 * Get the widget URL for the filerepo widget
	 *
	 * @param  \Elgg\Event $event 'entity:url', 'object:widget'
	 *
	 * @return null|string
	 */
	public static function filerepoWidgetURL(\Elgg\Event $event): ?string {
		if (!empty($event->getValue())) {
			// someone already set an url
			return null;
		}
		
		$widget = $event->getEntityParam();
		if (!$widget instanceof \ElggWidget || $widget->handler !== 'filerepo') {
			return null;
		}
		
		$owner = $widget->getOwnerEntity();
		if ($owner instanceof \ElggGroup) {
			return elgg_generate_url('collection:object:file:group', [
				'guid' => $owner->guid,
			]);
		} elseif ($owner instanceof \ElggUser) {
			return elgg_generate_url('collection:object:file:owner', [
				'username' => $owner->username,
			]);
		}
		
		return elgg_generate_url('collection:object:file:all');
	}
}
