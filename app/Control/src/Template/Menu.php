<?php
namespace Kinomania\Control\Template;

use Dspbee\Core\Request;

/**
 * Class Menu
 * @package Kinomania\System\Common
 */
class Menu
{
    /**
     * Menu constructor.
     * Initialize menu structure.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->menu = [
            'news' => [
                'title' => 'Статьи',
                'icon' => 'fa fa-pencil'
            ],
            'film' => [
                'title' => 'Фильмы',
                'icon' => 'fa fa-film',
                'items' => [
                    'film' => 'Фильмы',
                    'film/release' => 'График релизов',
                ]
            ],
            'person' => [
                'title' => 'Персоны',
                'icon' => 'fa fa-users'
            ],
            'comment' => [
                'title' => 'Модерация',
                'icon' => 'fa fa-comments-o',
                'label' => 'comment',
                'items' => [
                    'moderation/review' => 'Рецензии',
                    'moderation/feedback' => 'Отзывы',
                    'moderation/comment' => 'Комментарии',
                    'moderation/fix' => 'Исправления',
                ]
            ],
            'award' => [
                'title' => 'Премии',
                'icon' => 'fa fa-trophy'
            ],
            'company' => [
                'title' => 'Компании',
                'icon' => 'fa fa-building-o'
            ],
            'boxoffice' => [
                'title' => 'Сборы',
                'icon' => 'icon-wallet'
            ],
            'tv' => [
                'title' => 'TV программа',
                'icon' => 'icon-screen-desktop'
            ],
            'extra' => [
                'title' => 'Дополнительно',
                'icon' => 'fa fa-puzzle-piece',
                'items' => [
                    'extra/design' => 'Редизайн',
                    'extra/popular' => 'Популярное',
                    'extra/novelty' => 'Новинки фильмов',
                    'extra/video' => 'Типы видео',
                ]
            ],
            'seo' => [
                'title' => 'SEO',
                'icon' => 'fa fa-code',
                'items' => [
                	'seo/list' => 'Основные',
                    'seo/genre/single' => 'Страницы жанров',
				],
            ],
            'sys' => [
                'title' => 'Система',
                'icon' => 'fa fa-gears',
                'items' => [
                    'sys/log' => 'Журнал',
                    'sys/admin' => 'Администраторы',
                    'sys/group' => 'Группы',
                    'sys/parser' => 'Парсер'
                ]
            ],
            'user' => [
                'title' => 'Пользователи',
                'icon' => 'icon-users'
            ]
        ];
    }

    /**
     * Create admin template menu.
     * @return string
     */
    public function print()
    {
        ob_start();
        foreach ($this->menu as $url => $item) {
            if (isset($item['items']) && 0 < count($item['items'])) {
                $url = rtrim($url, '/') . '/';
                $active = '';
                if (false !== strpos($this->request->route(), $url)) {
                    $active = 'active';
                }
                echo '
                    <li class="">
                        <a href="' . $this->request->makeUrl(key($item['items'])) . '" title="' . $item['title'] . '">';
                if (!empty($item['label'])) {
                    echo '           <div class="pull-right label label-warning" id="' . $item['label'] . 'Label" style="display: none; top: 1px; position: relative;"></div>';
                }
                echo '      <em class="' . $item['icon'] . '"></em>
                            <span>' . $item['title'] . '</span>
                        </a>
                        <ul id="menu_' . rtrim($url, '/') . '" class="nav sidebar-subnav collapse ' . $active . '">
                    ';
                foreach ($item['items'] as $href => $title) {
                    $active = '';
                    if ($href == $this->request->route()) {
                        $active = 'active';
                    }
                    echo '
                        <li class="' . $active . '">
                            <a href="' . $this->request->makeUrl($href) . '" title="' . $title . '">
                                <span>' . $title . '</span>
                            </a>
                        </li>
                    ';
                }
                echo '
                        </ul>
                    </li>
                ';
            } else {
                $active = '';
                if (false !== strpos($this->request->route(), $url)) {
                    $active = 'active';
                }
                echo '
                    <li class="' . $active . '">
                        <a href="' . $this->request->makeUrl($url) . '" title="' . $item['title'] . '">';
                if (!empty($item['label'])) {
                    echo '           <div class="pull-right label label-warning" id="' . $item['label'] . 'Label" style="display: none; top: 1px; position: relative;"></div>';
                }
                echo '      <em class="' . $item['icon'] . '"></em>
                            <span>' . $item['title'] . '</span>
                        </a>
                    </li>
                ';
            }
        }
        return ob_get_clean();
    }

    private $request;
    private $menu;
}