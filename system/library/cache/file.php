<?php
namespace Opencart\System\Library\Cache;
class File {
	private int $expire;
	
	/**
	 * Constructor
	 *
	 * @param    int  $expire
	 */
	public function __construct(int $expire = 3600) {
		$this->expire = $expire;
	}
	
	/**
	 * Get
	 *
	 * @param    string  $key
	 *
	 * @return array|string|null
	 */
	public function get(string $key): array|string|null {
		$file = DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.csv';
		
		if (!file_exists($file)) {
			return false;
		}
		
		return json_decode(file_get_contents($file), true);
	}

	/**
	 * Set
	 *
	 * @param    string  $key
	 * @param    array|string|null  $value
	 *
	 * @return void
	 */
	public function set(string $key, array|string|null $value, int $expire = 0): void {
		$this->fdelete($key);

		if (!$expire) {
			$expire = $this->expire;
		}

		file_put_contents(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.csv', json_encode($value));
	}

	/**
	 * Delete
	 *
	 * @param    string  $key
	 *
	 * @return void
	 */
	public function fdelete(string $key): void {
		$file = DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.csv';
		
		if (!file_exists($file)) {
			clearstatcache(false, $file);
		} else {
			unlink($file);
		}
	}
	
	public function delete(string $key): void {
		$files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');

		if ($files) {
			foreach ($files as $file) {
				if (!@unlink($file)) {
					clearstatcache(false, $file);
				}
			}
		}
	}
	
	public function clear() {
		$files = glob(DIR_CACHE . 'cache.*');
		
		if(!$files) {
			return;
		}
		
		foreach ($files as $file) {
			if (file_exists($file)) {
				unlink($file);
			} else {
				clearstatcache(false, $file);
			}
		}
	}

	/**
	 * Destructor
	 */
	/*public function __destruct() {
		$files = glob(DIR_CACHE . 'cache.*');

		if ($files && rand(1, 100) == 1) {
			foreach ($files as $file) {
				$time = substr(strrchr($file, '.'), 1);

				if ($time < time()) {
					if (!@unlink($file)) {
						clearstatcache(false, $file);
					}
				}
			}
		}
	}*/
}
