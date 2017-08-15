<?php
namespace Kinomania\Control\Person\Casting;

use Dspbee\Bundle\Common\Bag\PostBag;
use Kinomania\Control\Person\Stat;
use Kinomania\System\Base\DB;

/**
 * Class Casting
 * @package Kinomania\Control\Person\Casting
 */
class Casting extends DB
{
    /**
     * @return bool
     */
    public function edit()
    {
        $this->error = '';

        $post = new PostBag();
        $id = $post->fetchInt('id');

        if (0 < $id) {
            $result = $this->db->query("SELECT 1 FROM `person` WHERE `id` = {$id} LIMIT 1");
            if (0 < $result->num_rows) {
                $height = $post->fetchInt('height');
                $weight = $post->fetchInt('weight');
                $color_hair = $post->fetchEscape('color_hair', $this->db);
                $color_eyes = $post->fetchEscape('color_eyes', $this->db);
                $sex = $post->fetchEscape('sex', $this->db);
                $castingId = $post->fetchInt('castingId');

                $birthday = $post->fetch('birthday');
                if (empty($birthday)) {
                    $birthday = 'null';
                } else {
                    $birthday = explode('.', $birthday);
                    $birthday[2] = $birthday[2] ?? '';
                    $birthday[1] = $birthday[1] ?? '';
                    $birthday[0] = $birthday[0] ?? '';
                    $birthday  = $birthday[2] . '-' . $birthday[1] . '-' . $birthday[0];
                    $birthday = '\'' . $birthday . '\'';
                }

                /**
                 * Casting data.
                 */
                $result = $this->db->query("SELECT `id` FROM `person_casting` WHERE `personId` = {$id} LIMIT 1");
                if ($row = $result->fetch_assoc()) {
                    $this->db->query("UPDATE `person_casting` SET
                                      `sex` = '{$sex}',
                                      `birthday` = {$birthday},
                                      `height` = {$height},
                                      `weight` = {$weight},
                                      `color_hair` = '{$color_hair}',
                                      `color_eyes` = '{$color_eyes}',
                                      `castingId` = {$castingId}
                                      WHERE `id` = {$row['id']} LIMIT 1
                    ");
                } else {
                    $this->db->query("INSERT INTO `person_casting` SET
                                      `personId` = {$id},
                                      `sex` = '{$sex}',
                                      `birthday` = {$birthday},
                                      `height` = {$height},
                                      `weight` = {$weight},
                                      `color_hair` = '{$color_hair}',
                                      `color_eyes` = '{$color_eyes}',
                                      `castingId` = {$castingId},
                                      `personWeight` = 0
                    ");
                }
                if (!empty($this->db->error)) {
                    $this->error = $this->db->error;
                    return false;
                }

                /**
                 * Eav data.
                 */
                $idList = [];
                $ethnic = explode(',', $post->fetch('ethnic'));
                foreach ($ethnic as $value) {
                    $value = trim($value);
                    $value = $this->db->real_escape_string($value);
                    if (!empty($value)) {
                        $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'ethnic' AND `value` = '{$value}' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `eav_storage` SET `key` = 'ethnic', `value` = '{$value}'");
                            $keyId = $this->db->insert_id;
                        } else {
                            $keyId = $row['id'];
                        }

                        $idList[] = $keyId;
                        $result = $this->db->query("SELECT 1 FROM `person_casting_ethnic` WHERE `personId` = {$id} AND `keyId` = {$keyId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `person_casting_ethnic` SET `personId` = {$id}, `keyId` = {$keyId}");
                        }
                    }
                }
                if ([] != $idList) {
                    $idList = implode(',', $idList);
                    $this->db->query("DELETE FROM `person_casting_ethnic` WHERE `personId` = {$id} AND `keyId` NOT IN ({$idList})");
                }
                $idList = [];

                $dance = explode(',', $post->fetch('dance'));
                foreach ($dance as $value) {
                    $value = trim($value);
                    $value = $this->db->real_escape_string($value);
                    if (!empty($value)) {
                        $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'dance' AND `value` = '{$value}' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `eav_storage` SET `key` = 'dance', `value` = '{$value}'");
                            $keyId = $this->db->insert_id;
                        } else {
                            $keyId = $row['id'];
                        }

                        $idList[] = $keyId;
                        $result = $this->db->query("SELECT 1 FROM `person_casting_dance` WHERE `personId` = {$id} AND `keyId` = {$keyId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `person_casting_dance` SET `personId` = {$id}, `keyId` = {$keyId}");
                        }
                    }
                }
                if ([] != $idList) {
                    $idList = implode(',', $idList);
                    $this->db->query("DELETE FROM `person_casting_dance` WHERE `personId` = {$id} AND `keyId` NOT IN ({$idList})");
                }
                $idList = [];

                $language = explode(',', $post->fetch('language'));
                foreach ($language as $value) {
                    $value = trim($value);
                    $value = $this->db->real_escape_string($value);
                    if (!empty($value)) {
                        $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'language' AND `value` = '{$value}' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `eav_storage` SET `key` = 'language', `value` = '{$value}'");
                            $keyId = $this->db->insert_id;
                        } else {
                            $keyId = $row['id'];
                        }

                        $idList[] = $keyId;
                        $result = $this->db->query("SELECT 1 FROM `person_casting_language` WHERE `personId` = {$id} AND `keyId` = {$keyId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `person_casting_language` SET `personId` = {$id}, `keyId` = {$keyId}");
                        }
                    }
                }
                if ([] != $idList) {
                    $idList = implode(',', $idList);
                    $this->db->query("DELETE FROM `person_casting_language` WHERE `personId` = {$id} AND `keyId` NOT IN ({$idList})");
                }
                $idList = [];

                $music_instrument = explode(',', $post->fetch('music_instrument'));
                foreach ($music_instrument as $value) {
                    $value = trim($value);
                    $value = $this->db->real_escape_string($value);
                    if (!empty($value)) {
                        $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'music_instrument' AND `value` = '{$value}' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `eav_storage` SET `key` = 'music_instrument', `value` = '{$value}'");
                            $keyId = $this->db->insert_id;
                        } else {
                            $keyId = $row['id'];
                        }

                        $idList[] = $keyId;
                        $result = $this->db->query("SELECT 1 FROM `person_casting_music_instrument` WHERE `personId` = {$id} AND `keyId` = {$keyId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `person_casting_music_instrument` SET `personId` = {$id}, `keyId` = {$keyId}");
                        }
                    }
                }
                if ([] != $idList) {
                    $idList = implode(',', $idList);
                    $this->db->query("DELETE FROM `person_casting_music_instrument` WHERE `personId` = {$id} AND `keyId` NOT IN ({$idList})");
                }
                $idList = [];

                $sing = explode(',', $post->fetch('sing'));
                foreach ($sing as $value) {
                    $value = trim($value);
                    $value = $this->db->real_escape_string($value);
                    if (!empty($value)) {
                        $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'sing' AND `value` = '{$value}' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `eav_storage` SET `key` = 'sing', `value` = '{$value}'");
                            $keyId = $this->db->insert_id;
                        } else {
                            $keyId = $row['id'];
                        }

                        $idList[] = $keyId;
                        $result = $this->db->query("SELECT 1 FROM `person_casting_sing` WHERE `personId` = {$id} AND `keyId` = {$keyId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `person_casting_sing` SET `personId` = {$id}, `keyId` = {$keyId}");
                        }
                    }
                }
                if ([] != $idList) {
                    $idList = implode(',', $idList);
                    $this->db->query("DELETE FROM `person_casting_sing` WHERE `personId` = {$id} AND `keyId` NOT IN ({$idList})");
                }
                $idList = [];

                $sport = explode(',', $post->fetch('sport'));
                foreach ($sport as $value) {
                    $value = trim($value);
                    $value = $this->db->real_escape_string($value);
                    if (!empty($value)) {
                        $result = $this->db->query("SELECT `id` FROM `eav_storage` WHERE `key` = 'sport' AND `value` = '{$value}' LIMIT 1");
                        if (!$row = $result->fetch_assoc()) {
                            $this->db->query("INSERT INTO `eav_storage` SET `key` = 'sport', `value` = '{$value}'");
                            $keyId = $this->db->insert_id;
                        } else {
                            $keyId = $row['id'];
                        }

                        $idList[] = $keyId;
                        $result = $this->db->query("SELECT 1 FROM `person_casting_sport` WHERE `personId` = {$id} AND `keyId` = {$keyId} LIMIT 1");
                        if (0 == $result->num_rows) {
                            $this->db->query("INSERT INTO `person_casting_sport` SET `personId` = {$id}, `keyId` = {$keyId}");
                        }
                    }
                }
                if ([] != $idList) {
                    $idList = implode(',', $idList);
                    $this->db->query("DELETE FROM `person_casting_sport` WHERE `personId` = {$id} AND `keyId` NOT IN ({$idList})");
                }

                /**
                 * Main data.
                 */
                $this->db->query("UPDATE `person` SET `sex` = '{$sex}', `birthday` = {$birthday}, `height` = {$height} WHERE `id` = {$id} LIMIT 1");
                if (!empty($this->db->error)) {
                    $this->error = $this->db->error;
                    return false;
                }
                
                $stat = new Stat($this->db);
                $stat->update($id);

                $redis = new \Redis();
                $redisStatus = $redis->connect('127.0.0.1');
                if ($redisStatus && $redis->exists('person:' . $id)) {
                    $redis->delete('person:' . $id);
                    if ($redis->exists('person:' . $id . ':min')) {
                        $redis->delete('person:' . $id . ':min');
                    }
                }
                
                return true;
            }
        }

        return false;
    }

    /**
     * Casting companies list.
     * @return array
     */
    public function companyList()
    {
        $list = [];

        $result = $this->db->query("SELECT `id`, `name` FROM `company` WHERE `type` = 'Кастинг-агентство'");
        while ($row = $result->fetch_assoc()) {
            $list[$row['id']] = $row['name'];
        }

        return $list;
    }
}