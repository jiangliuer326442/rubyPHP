<?php
/**
 * 0x3.me site API PHP SDK 核心model class文件
 *
 * @package   ShortURL
 * @author    zhiping.yin <yzp@bz-inc.com>
 * @copyright 2016 0x3.me
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 1.0
 * @link      https://0x3.me/api
 */

namespace ShortURL\Model;

class base {

    /**
     * api_key
     * @var string
     */
    protected $api_key;

    /**
     * secret_key
     * @var string
     */
    protected $secret_key;

    /**
     * 接口请求需要用到的参数
     * @var array
     */
    protected $params;

    /**
     * base Class __clone magic method
     */
    public function __clone() {
        throw new \ShortURL\Exception\Exception('base magic method __clone not allowed');
    }

    /**
     * base Class __get magic method
     */
    public function __get($name){
        return $this->params[$name];
    }

    /**
     * base Class __set magic method
     */
    public function __set($name, $value) {
        $this->params[$name] = $value;
    }

    /**
     * 设置api_key
     * @param $api_key string
     */
    public function setApiKey($api_key) {
        $this->api_key = $api_key;
    }

    /**
     * 设置secret_key
     * @param $secret_key string
     */
    public function setSecretKey($secret_key) {
        $this->secret_key = $secret_key;
    }

    /**
     * 设置access token
     * @param $access_token string
     */
    public function setAccessToken($access_token) {
        $this->params['access_token'] = $access_token;
    }

    /**
     * 导出参数
     * @return array
     * @throws \ShortURL\Exception\paramException
     */
    public function exportParamsWithSign() {
        if (empty($this->api_key) || empty($this->secret_key)) {
            throw new \ShortURL\Exception\paramException('no api_key or secret_key');
        }
        if(isset($this->params['sign'])){
            unset($this->params['sign']);
        }
        $this->params['api_key'] = $this->api_key;
        $sign = \ShortURL\Util::generateSign($this->params, $this->secret_key);
        $this->params['sign'] = $sign;
        return $this->params;
    }

    /**
     * 导出参数
     * @return array
     * @throws \ShortURL\Exception\paramException
     */
    public function exportParams() {
        return $this->params;
    }
}