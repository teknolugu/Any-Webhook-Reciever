<?php

spl_autoload_extensions(".php");
spl_autoload_register();

/**
 * @param $class_name
 * @throws Exception
 */
function linux_namespaces_autoload($class_name)
{
    /* use if you need to lowercase first char *
    $class_name  =  implode( DIRECTORY_SEPARATOR , array_map( 'lcfirst' , explode( '\\' , $class_name ) ) );/* else just use the following : */
    $class_name = implode(DIRECTORY_SEPARATOR, explode('\\', $class_name));
    static $extensions = array();
    if (empty($extensions)) {
        $extensions = array_map('trim', explode(',', spl_autoload_extensions()));
    }
    static $include_paths = array();
    if (empty($include_paths)) {
        $include_paths = explode(PATH_SEPARATOR, get_include_path());
    }
    foreach ($include_paths as $path) {
        $path .= (DIRECTORY_SEPARATOR !== $path[strlen($path) - 1]) ? DIRECTORY_SEPARATOR : '';
        foreach ($extensions as $extension) {
            $file = $path . $class_name . $extension;
            if (file_exists($file) && is_readable($file)) {
                require $file;
                return;
            }
        }
    }
    throw new Exception(_('class ' . $class_name . ' could not be found.'));
}

spl_autoload_register('linux_namespaces_autoload', TRUE, FALSE);
