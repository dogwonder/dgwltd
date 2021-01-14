<?php
// @codingStandardsIgnoreStart - this file will be removed before the release of Gravity Forms 2.5.

namespace {
	require_once GFCommon::get_base_path() . '/includes/class-translationspress-updater.php';
	require_once GFCommon::get_base_path() . '/includes/settings/class-fields.php';
}

namespace Gravity_Forms\Gravity_Forms {
	/**
	 * Trait Deprecation_Warning
	 *
	 * IMPORTANT: Do not use this trait. It will be removed in the Gravity Forms 2.5 release.
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @package    Gravity_Forms\Gravity_Forms
	 */
	trait Deprecation_Warning {
		function notify_of_deprecation() {
			trigger_error(
				self::class . ' has been deprecated in the Gravity Forms 2.5 beta and will be removed in the final 2.5 release.'
				. ' Please update your add-on to extend ' . parent::class . ' instead.',
				E_USER_NOTICE
			);
		}
	}
}

namespace Rocketgenius\Gravity_Forms {

	use Gravity_Forms\Gravity_Forms\Deprecation_Warning;

	/**
	 * Class TranslationsPress_Updater
	 *
	 * @deprecated 2.5-beta-3 Update references to \Gravity_Forms\Gravity_Forms\TranslationsPress_Updater.
	 * @see        \Gravity_Forms\Gravity_Forms\TranslationsPress_Updater
	 *
	 * @package    Rocketgenius\Gravity_Forms
	 */
	class TranslationsPress_Updater extends \Gravity_Forms\Gravity_Forms\TranslationsPress_Updater {
		use Deprecation_Warning;

		public function __construct( $slug, $language = '' ) {
			parent::__construct( $slug, $language );
			$this->notify_of_deprecation();
		}
	}

	/**
	 * Class Settings
	 *
	 * @deprecated 2.5-beta-3 Use \Gravity_Forms\Gravity_Forms\Settings\Settings.
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Settings
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings
	 */
	class Settings extends \Gravity_Forms\Gravity_Forms\Settings\Settings {
		use Deprecation_Warning;

		public function __construct( $args = array() ) {
			parent::__construct( $args );
			$this->notify_of_deprecation();
		}
	}
}

namespace Rocketgenius\Gravity_Forms\Settings {

	use Gravity_Forms\Gravity_Forms\Deprecation_Warning;

	/**
	 * Class Fields
	 *
	 * @deprecated 2.5-beta-3 Use \Gravity_Forms\Gravity_Forms\Settings\Fields.
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings
	 */
	class Fields extends \Gravity_Forms\Gravity_Forms\Settings\Fields {
		use Deprecation_Warning;

		public function __construct() {
			$this->notify_of_deprecation();
		}
	}
}

namespace Rocketgenius\Gravity_Forms\Settings\Fields {

	use Gravity_Forms\Gravity_Forms\Deprecation_Warning;

	/**
	 * Class Base
	 *
	 * @deprecated 2.5-beta-3 Update references to \Gravity_Forms\Gravity_Forms\Settings\Fields\Base
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Base
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Base extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Base {
		public function __construct( $props, $settings ) {
			parent::__construct( $props, $settings );
			$this->notify_of_deprecation();
		}
	}

	/**
	 * Class Button
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Button
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Button extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Button {
	}

	/**
	 * Class Checkbox
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Checkbox
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Checkbox extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Checkbox {
	}

	/**
	 * Class Checkbox_And_Select
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Checkbox_And_Select
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Checkbox_And_Select extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Checkbox_And_Select {
	}

	/**
	 * Class Conditional_Logic
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Conditional_Logic
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Conditional_Logic extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Conditional_Logic {
	}

	/**
	 * Class Date_Time
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Date_Time
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Date_Time extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Date_Time {
	}

	/**
	 * Class Dynamic_Field_Map
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Dynamic_Field_Map
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Dynamic_Field_Map extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Dynamic_Field_Map {
	}

	/**
	 * Class Field_Map
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Field_Map
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Field_Map extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Field_Map {
	}

	/**
	 * Class Field_Select
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Field_Select
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Field_Select extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Field_Select {
	}

	/**
	 * Class Generic_Map
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Generic_Map
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Generic_Map extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Generic_Map {
	}

	/**
	 * Class Hidden
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Hidden
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Hidden extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Hidden {
	}

	/**
	 * Class HTML
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\HTML
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class HTML extends \Gravity_Forms\Gravity_Forms\Settings\Fields\HTML {
	}

	/**
	 * Class Notification_Routing
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Notification_Routing
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Notification_Routing extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Notification_Routing {
	}

	/**
	 * Class Radio
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Radio
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Radio extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Radio {
	}

	/**
	 * Class Select
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Select
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Select extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Select {
	}

	/**
	 * Class Select_Custom
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Select_Custom
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Select_Custom extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Select_Custom {
	}

	/**
	 * Class Text
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Text
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Text extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Text {
	}

	/**
	 * Class Text_And_Select
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Text_And_Select
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Text_And_Select extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Text_And_Select {
	}

	/**
	 * Class Textarea
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Textarea
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Textarea extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Textarea {
	}

	/**
	 * Class Toggle
	 *
	 * @deprecated since 2.5-beta-3.
	 *
	 * @see        \Gravity_Forms\Gravity_Forms\Settings\Fields\Toggle
	 *
	 * @package    Rocketgenius\Gravity_Forms\Settings\Fields
	 */
	class Toggle extends \Gravity_Forms\Gravity_Forms\Settings\Fields\Toggle {
	}
}
