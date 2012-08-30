<?php

namespace DN\Drupal;

/**
 * Global settings definitions.
 */
class Settings
{

    /**
     * Redirect local files to a online server. To enable this, set the source
     * and target keys of this variable to the desired values.
     */
    public $files_redirect = array(
      // The relative source path. e.g. sites/default/files
      'source' => '',
      // The absolute target domain (without the path). e.g. http://www.example.com
      'target' => '',
    );

    /**
     * Redirect a file to a fallback url.
     *
     * @TODO: Avoid redirect of image cache files when the original file exists.
     */
    private function filesRedirect($files_directory, $destination) {
        if (strpos($_SERVER['REQUEST_URI'], $files_directory) !== false) {
            header('Location: ' . $destination . $_SERVER['REQUEST_URI']);
            exit;
        }
    }

    /**
     * Apply all the global settings.
     */
    public function apply() {
        $files_redirect = $this->files_redirect;
        if ($files_redirect && $files_redirect['source'] && $files_redirect['target']) {
            $this->filesRedirect($files_redirect['source'], $files_redirect['target']);
        }
    }
}
