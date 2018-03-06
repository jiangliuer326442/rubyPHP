<?php
/**
 * 0x3.me site API PHP SDK 核心API class文件
 *
 * @package   ShortURL
 * @author    zhiping.yin <yzp@bz-inc.com>
 * @copyright 2016 0x3.me
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 1.0
 * @link      https://0x3.me/api
 */

namespace ShortURL;

final class API {

    /**
     * @var \ShortURL\Config
     */
    private $config;

    /**
     * @var string
     */
    private $access_token = '';

    public function __construct($config = null) {
        if (!is_null($config) && $config instanceof \ShortURL\Config) {
            $this->config = $config;
        }
    }

    /**
     * API magic method __destruct
     */
    public function __destruct() {

    }

    /**
     * API magic method __clone
     * @throws Exception\Exception
     */
    public function __clone() {
        throw new \ShortURL\Exception\Exception('API magic method __clone not allowed');
    }

    /**
     * API magic method __set
     * @param $name
     * @param $value
     * @throws Exception\Exception
     */
    public function __set($name, $value) {
        throw new \ShortURL\Exception\Exception('API magic method __set not allowed');
    }

    /**
     * API magic method __get
     * @param $name
     * @throws Exception\Exception
     */
    public function __get($name) {
        throw new \ShortURL\Exception\Exception('API magic method __get not allowed');
    }

    /**
     * API magic method __call
     * @param $function_name
     * @param $arguments
     * @return array
     */
    public function __call($function_name,$arguments) {
        return call_user_func(array($this,'requestAPI'),'api/'.$function_name,$arguments);
    }

    /**
     * 获取配置
     * @return null|Config
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * 设置配置
     * @param $config \ShortURL\Config
     */
    public function setConfig($config) {
        $this->config = $config;
    }

    /**
     * 设置access token
     * @param $access_token string
     */
    public function setAccessToken($access_token) {
        $this->access_token = $access_token;
    }

    /**
     * 请求API
     * @param $api_name string
     * @throws Exception\Config\Exception
     * @return array
     */
    public function requestAccessToken() {
        if(empty($this->config)){
            throw new \ShortURL\Exception\Config\Exception('config not found');
        }
        //step 1.get code
        $code = \ShortURL\Util::get($this->config->getServerAddress().'/apis/authorize/getCode');
        $code = json_decode($code,true);
        if($code['status']==1)
            $code = $code['data'];
        else
            throw new \ShortURL\Exception\resultException('get code failed');
        //step 2.get access token
        $params_model = new \ShortURL\Model\base();
        $params_model->setApiKey($this->config->getApiKey());
        $params_model->setSecretKey($this->config->getSecretKey());
        $params_model->code = $code;
        $params_model->request_time = date('Y-m-d H:i:s');

        $request_result = \ShortURL\Util::post($this->config->getServerAddress().'/apis/authorize/getAccessToken',$params_model->exportParamsWithSign());
        $result = json_decode($request_result,true);
        if(!$result)
            throw new \ShortURL\Exception\resultException('api request failed');
        if($result['status']!=1)
            throw new \ShortURL\Exception\resultException($result['info']);
        $this->access_token = $result['data']['access_token'];
        return $result['data']['access_token'];
    }

    /**
     * 请求API
     * @param $api_name string
     * @param $params_model \ShortURL\Model\base
     * @throws Exception\Config\Exception
     * @return array
     */
    public function requestAPI($api_name, $params_model) {
        if(empty($this->access_token)){
            $this->requestAccessToken();
        }
        $params_model->setAccessToken($this->access_token);
        $request_result = \ShortURL\Util::post($this->config->getServerAddress().$api_name,$params_model->exportParams());
        $result = json_decode($request_result,true);
        if(!$result){
            throw new \ShortURL\Exception\resultException('api request failed');
        }
        return $result;
    }

    /**
     * api/add接口
     * @param $params \ShortURL\Model\addModel|\ShortURL\Model\base
     * @return array
     * @throws Exception\Config\Exception
     * @throws Exception\Exception
     */
    public function add($params) {
        return $this->requestAPI('apis/urls/add',$params);
    }

    /**
     * api/statics接口
     * @param $params \ShortURL\Model\staticsModel|\ShortURL\Model\base
     * @return array
     * @throws Exception\Config\Exception
     * @throws Exception\Exception
     */
    public function statistics($params){
        return $this->requestAPI('apis/url/statistics',$params);
    }

    /**
     * api/addtarget接口
     * @param $params \ShortURL\Model\addtargetModel|\ShortURL\Model\base
     * @return array
     * @throws Exception\Config\Exception
     * @throws Exception\Exception
     */
    public function addtarget($params){
        return $this->requestAPI('apis/target/append',$params);
    }

    /**
     * api/modify接口
     * @param $params \ShortURL\Model\modifyModel|\ShortURL\Model\base
     * @return array
     * @throws Exception\Config\Exception
     * @throws Exception\Exception
     */
    public function modify($params){
        return $this->requestAPI('apis/url/modify',$params);
    }

    /**
     * api/delete接口
     * @param $params \ShortURL\Model\deleteModel|\ShortURL\Model\base
     * @return array
     * @throws Exception\Config\Exception
     * @throws Exception\Exception
     */
    public function delete($params){
        return $this->requestAPI('apis/url/delete',$params);
    }

    /**
     * api/export接口
     * @param $params \ShortURL\Model\exportModel|\ShortURL\Model\base
     * @return array
     * @throws Exception\Config\Exception
     * @throws Exception\Exception
     */
    public function export($params){
        return $this->requestAPI('apis/url/export',$params);
    }

}