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

final class addModel extends \ShortURL\Model\base {

    /**
     * 设置长网址
     * @param $longurl string
     */
    public function setLongurl($longurl) {
        $this->longurl = $longurl;
    }

    /**
     * 使用301方式跳转
     */
    public function setRedirectMethodUsing301() {
        $this->redirect_method = '301';
    }

    /**
     * 使用302方式跳转
     */
    public function setRedirectMethodUsing302() {
        $this->redirect_method = '302';
    }

    /**
     * 使用js方式跳转
     */
    public function setRedirectMethodUsingJs() {
        $this->redirect_method = 'js';
    }

    /**
     * 使用meta方式跳转
     */
    public function setRedirectMethodUsingMeta() {
        $this->redirect_method = 'meta';
    }

    /**
     * 使用直达方式跳转
     */
    public function setRedirectMethodUsingExpress() {
        $this->redirect_method = 'express';
    }

    /**
     * 设置客户/渠道号
     * @param $extra string
     */
    public function setExtra($extra) {
        $this->extra = $extra;
    }

    /**
     * 使用0x3.me域名前缀
     */
    public function setDomain0x3(){
        $this->domain = '0x3';
    }

    /**
     * 使用0x6.me域名前缀
     */
    public function setDomain0x6(){
        $this->domain = '0x6';
    }

    /**
     * 使用0x9.me域名前缀
     */
    public function setDomain0x9(){
        $this->domain = '0x9';
    }

    /**
     * 设置自定义短网址后缀
     */
    public function setBackfix($backfix){
        $this->backfix = $backfix;
    }

    /**
     * 设置密码
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     * 去除密码
     */
    public function removePassword(){
        unset($this->params['password']);
    }

    /**
     * 设置访问次数限制
     * @param $limit int
     */
    public function setVisitLimit($limit){
        $this->visitlimit = intval($limit);
    }

    /**
     * 设置tag
     * @param $tags string
     */
    public function setTags($tags){
        $this->tag = $tags;
    }
}