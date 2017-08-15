<?php
namespace Original;

use Dspbee\Core\BaseController;
use Dspbee\Core\IRoute;
use Dspbee\Core\Request;

/**
 * Class CustomRoute
 * @package Original
 */
class CustomRoute implements IRoute
{
    /**
     * @param string $packageRoot
     * @param Request $request
     * @return mixed
     */
    public function getResponse($packageRoot, Request $request)
    {
        /**
         * User login.
         */
        if (0 === strpos($request->route(), 'user') && preg_match('#^user/(.*?)([^/]+)(.*?)$#s', $request->route(), $matches)) {
            $packageRoot = rtrim($packageRoot, '/');
            $route = str_replace($matches[2], 'LOGIN', $request->route());
            $path = $packageRoot . '/Route/' . $route . '/' . $request->method() . '.php';
            if (file_exists($path)) {
                require $path;
                $controllerClass = $request->package() . '\\Route_' . str_replace('/', '_', $route) . '\\' . $request->method();
                /**
                 * @var BaseController $controller
                 */
                $controller = new $controllerClass($packageRoot, $request);

                /**
                 * Call handler.
                 */
                $handler = $_POST['handler'] ?? $_GET['handler'] ?? 'index';
                if (method_exists($controllerClass, $handler)) {
                    $controller->$handler();
                    return $controller->getResponse();
                }
            }
        }

        /**
         * Boxoffice date.
         */
        if (0 === strpos($request->route(), 'boxoffice/usa') && preg_match('#^boxoffice/usa/(.*?)([^/]+)(.*?)$#s', $request->route(), $matches)) {
            $packageRoot = rtrim($packageRoot, '/');
            $route = str_replace($matches[2], 'DATE', $request->route());
            $path = $packageRoot . '/Route/' . $route . '/' . $request->method() . '.php';
            if (file_exists($path)) {
                require $path;
                $controllerClass = $request->package() . '\\Route_' . str_replace('/', '_', $route) . '\\' . $request->method();
                /**
                 * @var BaseController $controller
                 */
                $controller = new $controllerClass($packageRoot, $request);

                /**
                 * Call handler.
                 */
                $handler = $_POST['handler'] ?? $_GET['handler'] ?? 'index';
                if (method_exists($controllerClass, $handler)) {
                    $controller->$handler();
                    return $controller->getResponse();
                }
            }
        }

        if (0 === strpos($request->route(), 'boxoffice/cis') && preg_match('#^boxoffice/cis/(.*?)([^/]+)(.*?)$#s', $request->route(), $matches)) {
            $packageRoot = rtrim($packageRoot, '/');
            $route = str_replace($matches[2], 'DATE', $request->route());
            $path = $packageRoot . '/Route/' . $route . '/' . $request->method() . '.php';
            if (file_exists($path)) {
                require $path;
                $controllerClass = $request->package() . '\\Route_' . str_replace('/', '_', $route) . '\\' . $request->method();
                /**
                 * @var BaseController $controller
                 */
                $controller = new $controllerClass($packageRoot, $request);

                /**
                 * Call handler.
                 */
                $handler = $_POST['handler'] ?? $_GET['handler'] ?? 'index';
                if (method_exists($controllerClass, $handler)) {
                    $controller->$handler();
                    return $controller->getResponse();
                }
            }
        }

        if (0 === strpos($request->route(), 'boxoffice/russia') && preg_match('#^boxoffice/russia/(.*?)([^/]+)(.*?)$#s', $request->route(), $matches)) {
            $packageRoot = rtrim($packageRoot, '/');
            $route = str_replace($matches[2], 'DATE', $request->route());
            $path = $packageRoot . '/Route/' . $route . '/' . $request->method() . '.php';
            if (file_exists($path)) {
                require $path;
                $controllerClass = $request->package() . '\\Route_' . str_replace('/', '_', $route) . '\\' . $request->method();
                /**
                 * @var BaseController $controller
                 */
                $controller = new $controllerClass($packageRoot, $request);

                /**
                 * Call handler.
                 */
                $handler = $_POST['handler'] ?? $_GET['handler'] ?? 'index';
                if (method_exists($controllerClass, $handler)) {
                    $controller->$handler();
                    return $controller->getResponse();
                }
            }
        }

        /**
         * Awards code and year.
         */
        if (0 === strpos($request->route(), 'awards/') && preg_match('#^awards/(.*?)([^/]+)(.*?)$#s', $request->route(), $matches)) {
            $packageRoot = rtrim($packageRoot, '/');
            $route = str_replace($matches[2], 'AWARD', $request->route());
            $year = trim($matches[3], '/');
            if (!empty($year)) {
                $route = str_replace($matches[3], '/YEAR', $route);
            }
            $path = $packageRoot . '/Route/' . $route . '/' . $request->method() . '.php';
            if (file_exists($path)) {
                require $path;
                $controllerClass = $request->package() . '\\Route_' . str_replace('/', '_', $route) . '\\' . $request->method();
                /**
                 * @var BaseController $controller
                 */
                $controller = new $controllerClass($packageRoot, $request);

                /**
                 * Call handler.
                 */
                $handler = $_POST['handler'] ?? $_GET['handler'] ?? 'index';
                if (method_exists($controllerClass, $handler)) {
                    $controller->$handler();
                    return $controller->getResponse();
                }
            }
        }

        return null;
    }
}