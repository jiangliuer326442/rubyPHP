<?php
/**
 * 0x3.me site API PHP SDK model class文件
 *
 * @package   ShortURL
 * @author    zhiping.yin <yzp@bz-inc.com>
 * @copyright 2016 0x3.me
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 1.0
 * @link      https://0x3.me/api
 */

namespace ShortURL\Model;

final class modifyModel extends \ShortURL\Model\base {

    /**
     * 设置短网址
     * @param $url string
     */
    public function setShorturl($url) {
        $this->shorturl = $url;
    }

    /**
     * 设置新的网址
     * @param $url string
     */
    public function setNewUrl($url){
        $this->newurl = $url;
    }

}
