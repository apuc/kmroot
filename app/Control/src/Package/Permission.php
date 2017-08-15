<?php
namespace Kinomania\Control\Package;

use Dspbee\Bundle\Common\Bag\PostBag;

/**
 * Class Permission
 * @package Kinomania\Control\System
 */
class Permission
{
    public function __construct()
    {
        $this->fileList = [];
    }

    /**
     * Get list of admin routes.
     * @return array
     */
    public function list()
    {
        $list = [];
        $titleList = [];

        $this->fileList = [];
        $this->getFileList(dirname(dirname(__DIR__)) . '/Route');
        foreach ($this->fileList as $path) {
            if (false === strpos($path, '.php')) {
                continue;
            }

            $fh = fopen($path, 'rb');
            $data = fread($fh, 4096);
            fclose($fh);

            if (false === strpos($data, 'AdminController')) {
                continue;
            }

            $title = explode('$this->setTitle(', $data);
            if (isset($title[1])) {
                $title = $title[1];
                $title = explode(')', $title);
                $title = $title[0];
                $title = str_replace('\'', '', $title);
            } else {
                $title = '';
            }

            $route = explode('Route_', $data);
            $route = explode(';', $route[1]);
            $route = str_replace('_', '/', $route[0]);

            $list[] = $route;
            if (false !== strpos($path, 'GET')) {
                $titleList[$route] = $title;
            }
        }

        $list = array_unique($list);

        $id = 0;
        $temp = [];
        foreach ($list as $item) {
            $permission = new Item();
            $permission->initFromArray([
                'id' => $id++,
                'route' => $item,
                'title' => $titleList[$item] ?? '',
            ]);
            $temp[] = $permission;
        }

        return $temp;
    }

    /**
     * @param \mysqli $db
     * @param $groupId
     * @return array
     */
    public function groupRights(\mysqli $db, $groupId)
    {
        $groupId = intval($groupId);

        $list = $this->list();

        $result = $db->query("SELECT `route`, `access` FROM `admin_access` WHERE `userId` = 0 AND `groupId` = {$groupId}");
        while ($row = $result->fetch_assoc()) {
            /**
             * @var Item $item
             */
            foreach ($list as $item) {
                if ($row['route'] == $item->route()) {
                    $item->setAccess($row['access']);
                }
            }
        }

        return $list;
    }

    /**
     * Deny access.
     * @param \mysqli $db
     * @return bool
     */
    public function blockGroupRights(\mysqli $db)
    {
        $post = new PostBag();
        $groupId = $post->fetchInt('groupId');
        $routeList = $post->fetch('routeList');
        if (is_array($routeList) && 0 < count($routeList)) {
            foreach ($routeList as $route) {
                $route = $db->real_escape_string($route);
                $result = $db->query("SELECT 1 FROM `admin_access` WHERE `userId` = 0 AND `groupId` = {$groupId} AND `route` = '{$route}' AND `method` = '*' LIMIT 1");
                if (0 < $result->num_rows) {
                    $db->query("UPDATE `admin_access` SET `access` = 'false' WHERE `userId` = 0 AND `groupId` = {$groupId} AND `route` = '{$route}' AND `method` = '*'");
                } else {
                    $db->query("INSERT INTO `admin_access` SET `userId` = 0, `groupId` = {$groupId}, `route` = '{$route}', `method` = '*', `access` = 'false'");
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Allow access.
     * @param \mysqli $db
     * @return bool
     */
    public function unblockGroupRights(\mysqli $db)
    {
        $post = new PostBag();
        $groupId = $post->fetchInt('groupId');
        $routeList = $post->fetch('routeList');
        if (is_array($routeList) && 0 < count($routeList)) {
            foreach ($routeList as $route) {
                $route = $db->real_escape_string($route);
                $result = $db->query("SELECT 1 FROM `admin_access` WHERE `userId` = 0 AND `groupId` = {$groupId} AND `route` = '{$route}' AND `method` = '*' LIMIT 1");
                if (0 < $result->num_rows) {
                    $db->query("UPDATE `admin_access` SET `access` = 'true' WHERE `userId` = 0 AND `groupId` = {$groupId} AND `route` = '{$route}' AND `method` = '*'");
                } else {
                    $db->query("INSERT INTO `admin_access` SET `userId` = 0, `groupId` = {$groupId}, `route` = '{$route}', `method` = '*', `access` = 'true'");
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete rights.
     * @param \mysqli $db
     * @return bool
     */
    public function clearGroupRights(\mysqli $db)
    {
        $post = new PostBag();
        $groupId = $post->fetchInt('groupId');
        $routeList = $post->fetch('routeList');
        if (is_array($routeList) && 0 < count($routeList)) {
            foreach ($routeList as $route) {
                $route = $db->real_escape_string($route);
                $db->query("DELETE FROM `admin_access` WHERE `userId` = 0 AND `groupId` = {$groupId} AND `route` = '{$route}' AND `method` = '*'");
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param \mysqli $db
     * @param $userId
     * @return array
     */
    public function adminRights(\mysqli $db, $userId)
    {
        $userId = intval($userId);

        $list = $this->list();

        $result = $db->query("SELECT `route`, `access` FROM `admin_access` WHERE `userId` = {$userId} AND `groupId` = 0");
        while ($row = $result->fetch_assoc()) {
            /**
             * @var Item $item
             */
            foreach ($list as $item) {
                if ($row['route'] == $item->route()) {
                    $item->setAccess($row['access']);
                }
            }
        }

        return $list;
    }

    /**
     * Deny access.
     * @param \mysqli $db
     * @return bool
     */
    public function blockAdminRights(\mysqli $db)
    {
        $post = new PostBag();
        $userId = $post->fetchInt('userId');
        $routeList = $post->fetch('routeList');
        if (is_array($routeList) && 0 < count($routeList)) {
            foreach ($routeList as $route) {
                $route = $db->real_escape_string($route);
                $result = $db->query("SELECT 1 FROM `admin_access` WHERE `userId` = {$userId} AND `groupId` = 0 AND `route` = '{$route}' AND `method` = '*' LIMIT 1");
                if (0 < $result->num_rows) {
                    $db->query("UPDATE `admin_access` SET `access` = 'false' WHERE `userId` = {$userId} AND `groupId` = 0 AND `route` = '{$route}' AND `method` = '*'");
                } else {
                    $db->query("INSERT INTO `admin_access` SET `userId` = {$userId}, `groupId` = 0, `route` = '{$route}', `method` = '*', `access` = 'false'");
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Allow access.
     * @param \mysqli $db
     * @return bool
     */
    public function unblockAdminRights(\mysqli $db)
    {
        $post = new PostBag();
        $userId = $post->fetchInt('userId');
        $routeList = $post->fetch('routeList');
        if (is_array($routeList) && 0 < count($routeList)) {
            foreach ($routeList as $route) {
                $route = $db->real_escape_string($route);
                $result = $db->query("SELECT 1 FROM `admin_access` WHERE `userId` = {$userId} AND `groupId` = 0 AND `route` = '{$route}' AND `method` = '*' LIMIT 1");
                if (0 < $result->num_rows) {
                    $db->query("UPDATE `admin_access` SET `access` = 'true' WHERE `userId` = {$userId} AND `groupId` = 0 AND `route` = '{$route}' AND `method` = '*'");
                } else {
                    $db->query("INSERT INTO `admin_access` SET `userId` = {$userId}, `groupId` = 0, `route` = '{$route}', `method` = '*', `access` = 'true'");
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete rights.
     * @param \mysqli $db
     * @return bool
     */
    public function clearAdminRights(\mysqli $db)
    {
        $post = new PostBag();
        $userId = $post->fetchInt('userId');
        $routeList = $post->fetch('routeList');
        if (is_array($routeList) && 0 < count($routeList)) {
            foreach ($routeList as $route) {
                $route = $db->real_escape_string($route);
                $db->query("DELETE FROM `admin_access` WHERE `userId` = {$userId} AND `groupId` = 0 AND `route` = '{$route}' AND `method` = '*'");
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get all files in directory.
     * @param $path
     */
    private function getFileList($path){
        if (is_dir($path)) {
            $objects = scandir($path);
            foreach ($objects as $object) {
                if ('.' != $object && '..' != $object) {
                    if ('dir' == filetype($path . '/' .$object)) {
                        $this->getFileList($path . '/' . $object);
                    } else {
                        $this->fileList[] = $path . '/' . $object;
                    }
                }
            }
        }
    }

    private $fileList;
}