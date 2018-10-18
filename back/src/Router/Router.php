<?php
namespace Router;

class Router
{
	private static $GET = [];
	private static $POST = [];
	private static $DELETE = [];

	public static function get($pattern, $callback) {
        $pattern = str_replace('{}', '(\w+)', $pattern);
        $regex = '/^' . str_replace('/', '\/', $pattern) . '$/';
		self::$GET[$regex] = $callback;
    }

    public static function post($pattern, $callback) {
        $pattern = str_replace('{}', '(\w+)', $pattern);
        $regex = '/^' . str_replace('/', '\/', $pattern) . '$/';
		self::$POST[$regex] = $callback;
    }

    public static function delete($pattern, $callback) {
        $pattern = str_replace('{}', '(\w+)', $pattern);
        $regex = '/^' . str_replace('/', '\/', $pattern) . '$/';
		self::$DELETE[$regex] = $callback;
    }

	public static function execute() {
        $routes = [];

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $routes = self::$GET;
                break;
            case 'POST':
                $routes = self::$POST;
                break;
            case 'DELETE':
                $routes = self::$DELETE;
                break;
        }

        foreach ($routes as $pattern => $callback) {
            if (preg_match($pattern, $_SERVER['REQUEST_URI'], $params)) {
				array_shift($params);
				return call_user_func_array($callback, array_values($params));
			}
		}
	}
}
