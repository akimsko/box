<?php
namespace Box;

/**
 * This file was part of The Frood framework.
 *
 * @link https://github.com/Ibmurai/frood
 *
 * @copyright Copyright 2011 Jens Riisom Schultz
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
/**
 * Autoloader - The Frood autoloader... Raped.
 *
 * @category Frood
 * @package  Autoloader
 * @author   Jens Riisom Schultz <ibber_of_crew42@hotmail.com>
 * @author   Bo Thinggaard <akimsko@tnactas.dk>
 */
class Autoloader {
	/** @var string The path to use as the base of autoloading. */
	private $_classPath;

	/**
	 * Construct a new Box autoloader.
	 * It will automatically register itself.
	 */
	public function __construct() {
		$this->_classPath = __DIR__;

		$this->_register();
	}

	/**
	 * Converts a classpath to a valid filename.
	 *
	 * @param string $classPath The class path.
	 *
	 * @return string The classpath as a valid filename.
	 */
	private static function _classPathToFilename($classPath) {
		static $filenames = array();

		if (!isset($filenames[$classPath])) {
			$filenames[$classPath] = preg_replace('/[\/\\\: ]/', '_', $classPath);
		}

		return $filenames[$classPath];
	}

	/**
	 * Attempts to load the given class.
	 *
	 * @param string $name The name of the class to load.
	 */
	public function autoload($name) {
		if ($path = $this->_classNameToPath($name)) {
			require_once $path;

			return;
		}
	}

	/**
	 * Unregister the autoloader. Persist and clean memory cache.
	 *
	 * @throws \RuntimeException If the autoloader could not be unregistered.
	 */
	public function unregister() {
		if (!spl_autoload_unregister(array($this, 'autoload'))) {
			throw new \RuntimeException('Could not unregister.');
		}
	}

	/**
	 * Register the autoloader.
	 */
	private function _register() {
		if (false === spl_autoload_functions()) {
			if (function_exists('__autoload')) {
				spl_autoload_register('__autoload', false);
			}
		}

		spl_autoload_register(array($this, 'autoload'));
	}

	/**
	 * Convert a class name to a path to a file containing the class definition.
	 * Used by the autoloader.
	 *
	 * @param string $name The name of the class.
	 *
	 * @return null|string A full path or null if no suitable file could be found.
	 */
	private function _classNameToPath($name) {
		if (preg_match('/^((?:\\\\?[A-Z][a-z0-9]*)+)$/', $name)) {
			// Build a regular expression matching the end of the filepaths to accept...
			$regex = '/[\/\\\][a-z]+[A-Za-z_-]*[\/\\\]' . substr($name, 0, 1) . preg_replace('/\\\\?([A-Z])/', '[\/\\\\\\]?\\1', substr($name, 1)) . '\.php$/';

			if ($path = $this->_searchFiles($this->_classPath, $regex)) {
				return $path;
			}
		}

		return null;
	}

	/**
	 * Internally used method. Used by _classNameToPath.
	 *
	 * @param string $classPath The directory to search in.
	 * @param string $regex     The regular expression to match on the full path.
	 *
	 * @return null|string null if no match was found.
	 */
	private function _searchFiles($classPath, $regex) {
		foreach (self::_getFiles($classPath) as $filePath) {
			if (preg_match($regex, $filePath)) {
				return $filePath;
			}
		}
	}

	/**
	 * Internally used method. Used by addClassPath to cache all files in the newly added class path.
	 *
	 * @param string $classPath The directory to search in.
	 * @param array  &$files    The array to store filepaths in.
	 *
	 * @return array The file paths.
	 */
	private static function _getFiles($classPath, array &$files = array()) {
		if (!is_dir($classPath)) {
			return $files;
		}

		$iterator = new \DirectoryIterator($classPath);

		foreach ($iterator as $finfo) {
			if (substr($finfo->getBasename(), 0, 1) != '.') {
				if ($finfo->isFile()) {
					$files[] = $finfo->getPathname();
				} else {
					if ($finfo->isDir()) {
						self::_getFiles($finfo->getPathname(), $files);
					}
				}
			}
		}

		return $files;
	}
}
