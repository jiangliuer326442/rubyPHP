<?php
/**
 * 0x3.me site API PHP SDK config class
 *
 * @package   ShortURL
 * @author    zhiping.yin <yzp@bz-inc.com>
 * @copyright 2016 0x3.me
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 1.0
 * @link      https://0x3.me/api
 */

namespace ShortURL;

interface ConfigInterface {

    /**
     * 设置请求接口用的api_key
     * @param string $api_key 请求接口用的api_key
     * @return void
     */
    public function setApiKey($api_key);

    /**
     * 设置请求接口用的secret_key
     * @param string $api_key 请求接口用的secret_key
     * @return void
     */
    public function setSecretKey($secret_key);

    /**
     * 获取api_key
     * @return string api_key
     * @throws Exception\Config\Exception
     */
    public function getApiKey();

    /**
     * 获取secret_key
     * @return string secret_key
     * @throws Exception\Config\Exception
     */
    public function getSecretKey();

    /**
     * 导入参数,支持object或者array
     * @param $config object|array
     * @throws Exception\Config\importException
     */
    public function import($config);

    /**
     * 导出配置
     * @return array
     * @throws Exception\Config\exportException
     */
    public function export();

    /**
     * 获取服务器地址
     * @return string
     */
    public function getServerAddress();
}

final class Config implements ConfigInterface {

    /**
     * 服务器地址
     * @var string
     */
    private static $server = 'https://0x3.me/';

    /**
     * 接口请求的api_key,可在后台查询到
     * @see https://0x3.me/uc/api
     * @var string
     */
    private $api_key;

    /**
     * 接口请求的密钥,可在后台查询到
     * @see https://0x3.me/uc/api
     * @var string
     */
    private $secret_key;

    /**
     * Config constructor.
     * @param string $api_key
     * @param string $secret_key
     */
    public function __construct($api_key = '', $secret_key = '') {
        if (!empty($api_key)) {
            $this->api_key = $api_key;
        }
        if (!empty($secret_key)) {
            $this->secret_key = $secret_key;
        }
    }

    /**
     * Config __destruct magic method
     */
    public function __destruct() {
        $this->api_key = null;
        $this->secret_key = null;
    }

    /**
     * Config Class __clone magic method
     */
    public function __clone() {
        throw new \ShortURL\Exception\Config\Exception('config magic method __clone not allowed');
    }

    /**
     * Config Class __get magic method
     */
    public function __get($name){
        throw new \ShortURL\Exception\Config\Exception('config magic method __get not allowed');
    }

    /**
     * Config Class __set magic method
     */
    public function __set($name, $value){
        throw new \ShortURL\Exception\Config\Exception('config magic method __set not allowed');
    }

    /**
     * 设置请求接口用的api_key
     * @param string $api_key 请求接口用的api_key
     * @return void
     */
    public function setApiKey($api_key) {
        $this->api_key = $api_key;
    }

    /**
     * 设置请求接口用的secret_key
     * @param string $api_key 请求接口用的secret_key
     * @return void
     */
    public function setSecretKey($secret_key) {
        $this->secret_key = $secret_key;
    }

    /**
     * 获取api_key
     * @return string api_key
     * @throws Exception\Config\Exception
     */
    public function getApiKey() {
        if (empty($this->api_key)) {
            throw new \ShortURL\Exception\Config\Exception('api_key not found');
        }
        return $this->api_key;
    }

    /**
     * 获取secret_key
     * @return string secret_key
     * @throws Exception\Config\Exception
     */
    public function getSecretKey() {
        if (empty($this->secret_key)) {
            throw new \ShortURL\Exception\Config\Exception('secret_key not found');
        }
        return $this->secret_key;
    }

    /**
     * 导入参数,支持object或者array
     * @param $config object|array
     * @throws Exception\Config\importException
     */
    public function import($config) {
        if (is_object($config) && !empty($config->api_key) && !empty($config->secret_key)) {
            $this->api_key = $config->api_key;
            $this->secret_key = $config->secret_key;
        } elseif (is_array($config) && !empty($config['api_key']) && !empty($config['secret_key'])) {
            $this->api_key = $config['api_key'];
            $this->secret_key = $config['secret_key'];
        } else {
            throw new \ShortURL\Exception\Config\importException('illegal config');
        }
    }

    /**
     * 导出配置
     * @return array
     * @throws Exception\Config\exportException
     */
    public function export() {
        if(empty($this->api_key) || empty($this->secret_key)){
            throw new \ShortURL\Exception\Config\exportException('config cannot export');
        }
        return get_object_vars($this);
    }

    /**
     * 获取服务器地址
     * @return string
     */
    public function getServerAddress(){
        return self::$server;
    }
}