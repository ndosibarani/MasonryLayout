<?php
/**
 * Masonry Grid Layout Helper
 *
 * @author Ando Sibarani - ando.sibarani@clozette.co
 * @version 1.0.1
 * @license MIT License
 */
class Masonry {

	// do we handle the whole page?
	public $awhole = false;

	private static $behavior = array('endless' => false, 
									 'isotope' => false);

	// instance
	private $layout;

	function __construct($behavior) {
		if (!is_null($behavior) || !empty($behavior)) {
			if (is_array($behavior)) {
				foreach ($behavior as $key => $value) {
					try {
						if (in_array($key, self::$behavior)) {
							self::$behavior[$key] = $value;
						} else {
							throw new MasonryException(MasonryException::ERROR_UNSUPPORTED_BEHAVIOR);
						}
					} catch (MasonryException $e) {
						print $e->getMessage;
					}
				}
			}
		}
	}


	/**
	 * Behavior
	 *
	 * Extending layout behavior
	 *
	 * @param array $behavior which overrtide {@see private static $behavior}
	 * @return mixed. set|unset supporing behavior
	 */
	public function behavior($behavior) {
		try {
			if (is_array($behavior)) {
				foreach ($behavior as $key => $value) {
					return self::$behavior[$key] = $value;
				}
			} else {
				throw new MasonryException(MasonryException::ERROR_SHOULD_BE_ARRAY);
			}
		} catch (MasonryException $e) {
			print $e->getMessage;
		}
	}
}

class MasonryException extends Exception {
	const ERROR_NO_OBJECT_MSG = 'You need to provide the object parameter.';
	const ERROR_SHOULD_BE_OBJECT = 'Layout parameter should be passed as object';
	const ERROR_SHOULD_BE_ARRAY = 'Behavior parameter need to be an array element.';
	const ERROR_UNSUPPORTED_BEHAVIOR = 'Behavior key is not supported.';
}


