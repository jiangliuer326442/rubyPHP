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

final class addtargetModel extends \ShortURL\Model\base {

    /**
     * 设置策略名称
     * @param $name string
     */
    public function setTargetName($name){
        $this->targetname = $name;
    }

    /**
     * 设置短网址
     * @param $url string
     */
    public function setShortUrl($url) {
        $this->shorturl = $url;
    }

    /**
     * 设置长网址
     * @param $longurl string
     */
    public function setLongurl($longurl) {
        $this->longurl = $longurl;
    }

    /**
     * 禁用设备匹配
     */
    public function disableDeviceFilter(){
        unset($this->params['device']);
    }

    /**
     * 匹配windows
     */
    public function enableDeviceFilterWindows(){
        $this->device = 'Windows';
    }

    /**
     * 匹配安卓
     */
    public function enableDeviceFilterAndroid(){
        $this->device = 'Android';
    }

    /**
     * 匹配iPhone
     */
    public function enableDeviceFilteriPhone(){
        $this->device = 'iPhone';
    }

    /**
     * 匹配iPad
     */
    public function enableDeviceFilteriPad(){
        $this->device = 'iPad';
    }

    /**
     * 匹配mac电脑
     */
    public function enableDeviceFilterMacintosh(){
        $this->device = 'Macintosh';
    }

    /**
     * 禁用app匹配
     */
    public function disableAppFilter(){
        unset($this->params['app']);
    }

    /**
     * 启用微信匹配
     */
    public function enableAppFilterWechat(){
        $this->app = 'wechat';
    }

    /**
     * 启用微博客户端匹配
     */
    public function enableAppFilterWeibo(){
        $this->weibo = 'weibo';
    }

    /**
     * 启用地理位置匹配
     * @param $region_name string
     */
    public function regionFilter($region_name){
        $this->region = $region_name;
    }

}
