<?php
namespace Kinomania\System\Data;

/**
 * Class Comment
 * @package Kinomania\System\Data
 */
class Comment
{
    static public function print(&$commentList, $level = 0)
    {
        foreach ($commentList as $comment) {
            if (isset($comment[\Kinomania\Original\Key\Comment\Comment::TEXT])) {
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = preg_replace('/\[spoiler(.*)\](.+?)\[\/spoiler\]/is', '<div class="spoiler-box">$2</div>', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = preg_replace('/\[quote(.*)\](.+?)\[\/quote\]/is', '<blockquote><p>$2</p></blockquote>', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = preg_replace('/\[b(.*)\](.+?)\[\/b\]/is', '<b>$2</b>', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = preg_replace('/\[i(.*)\](.+?)\[\/i\]/is', '<i>$2</i>', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = str_replace('&amp;quot;', '"', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = str_replace('&amp;laquo;', '«', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = str_replace('&amp;hellip;', '…', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);
                $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] = str_replace('&amp;raquo;', '»', $comment[\Kinomania\Original\Key\Comment\Comment::TEXT]);

                $count = count($comment[\Kinomania\Original\Key\Comment\Comment::CHILD]);
                if ($count) {
                    echo '<div class="parent-author-full-comments row-author-full-comments">';
                } else {
                    echo '<div class="parent-author-full-comments row-author-full-comments with-answer">';
                }
                echo '
                <div class="author-full-comments-image" id="comment_' . $comment[\Kinomania\Original\Key\Comment\Comment::ID] . '">';
                if (empty($comment[\Kinomania\Original\Key\Comment\Comment::LOGIN])) {
                    echo ' <a href="javascript:"><img src="' . $comment[\Kinomania\Original\Key\Comment\Comment::IMAGE] . '" alt=""></a>';
                } else {
                    echo ' <a href="/user/' . $comment[\Kinomania\Original\Key\Comment\Comment::LOGIN] . '"><img src="' . $comment[\Kinomania\Original\Key\Comment\Comment::IMAGE] . '" alt=""></a>';
                }
                echo '</div>
                <div class="author-full-comments-content">';
                if (empty($comment[\Kinomania\Original\Key\Comment\Comment::LOGIN])) {
                    echo '<div class="author-comments-name"><a href="javascript:">' . $comment[\Kinomania\Original\Key\Comment\Comment::NAME] . '</a></div>';
                } else {
                    echo '<div class="author-comments-name"><a href="/user/' . $comment[\Kinomania\Original\Key\Comment\Comment::LOGIN] . '">' . $comment[\Kinomania\Original\Key\Comment\Comment::NAME] . '</a></div>';
                }
                echo '<div class="author-comments-text" data-parent="' . $comment[\Kinomania\Original\Key\Comment\Comment::PARENT] . '" data-id="' . $comment[\Kinomania\Original\Key\Comment\Comment::ID] . '">' . $comment[\Kinomania\Original\Key\Comment\Comment::TEXT] . '</div>
                    <div class="author-comments-info clear">
                        <ul class="author-comment-info-list">
                            <li class="reply"><a href="#">Комментировать</a></li>
                            <li class="quote"><a href="#">Цитировать</a></li>
                            <li class="date">' . $comment[\Kinomania\Original\Key\Comment\Comment::DATE] . '</li>
                        </ul>
                        <div class="like-button clear">
                            <span class="like" data-id="' . $comment[\Kinomania\Original\Key\Comment\Comment::ID] . '"></span>
                            <span class="number" data-type="more">' . $comment[\Kinomania\Original\Key\Comment\Comment::LIKE] . '</span>
                            <!-- data-type="more & less & default" -->
                            <span class="dislike" data-id="' . $comment[\Kinomania\Original\Key\Comment\Comment::ID] . '"></span>
                            <span class="number" data-type="less">' . $comment[\Kinomania\Original\Key\Comment\Comment::DISLIKE] . '</span>
                        </div>
                    </div>
                ';
                if (2 < $level) {
                    echo '
                </div>
                </div>
                ';
                    if ($count) {
                        self::print($comment[\Kinomania\Original\Key\Comment\Comment::CHILD], $level + 1);
                    }
                } else {
                    if ($count) {
                        self::print($comment[\Kinomania\Original\Key\Comment\Comment::CHILD], $level + 1);
                    }
                    echo '
                </div>
                </div>
                ';
                }
            }
        }
    }
}