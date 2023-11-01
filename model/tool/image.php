<?php
namespace Opencart\Catalog\Model\Tool;
class Image extends \Opencart\System\Engine\Model {
	public function resize(string $filename, int $width, int $height, $max_width = 0, $max_height = 0): string {
		if (!is_file(DIR_IMAGE . $filename) || substr(str_replace('\\', '/', realpath(DIR_IMAGE . $filename)), 0, strlen(DIR_IMAGE)) != DIR_IMAGE) {
			return '';
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$image_old = $filename;
		$image_new = 'cache/' . oc_substr($filename, 0, oc_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $image_new) || (filemtime(DIR_IMAGE . $image_old) > filemtime(DIR_IMAGE . $image_new))) {
			list($width_orig, $height_orig, $image_type) = getimagesize(DIR_IMAGE . $image_old);
			
			///
			if($width == 0) {
				$width = round($width_orig * ($height / $height_orig));
				
				if($max_width && $width > $max_width) {
					$width = $max_width;
				}
			}
			
			if($height == 0) {
				$height = round($height_orig * ($width / $width_orig));
				
				if($max_height && $height > $max_height) {
					$height = $max_height;
				}
			}
			///
			
			if (!in_array($image_type, [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_WEBP])) {
				return HTTP_SERVER . 'image/' . $image_old;
			}

			$path = '';

			$directories = explode('/', dirname($image_new));

			foreach ($directories as $directory) {
				if (!$path) {
					$path = $directory;
				} else {
					$path = $path . '/' . $directory;
				}

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			if ($width_orig != $width || $height_orig != $height) {
				$image = new \Opencart\System\Library\Image(DIR_IMAGE . $image_old);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $image_new);
			} else {
				copy(DIR_IMAGE . $image_old, DIR_IMAGE . $image_new);
			}
		}

		return HTTP_SERVER . DIR_IMAGE_RELATIVE . $image_new;
	}
}