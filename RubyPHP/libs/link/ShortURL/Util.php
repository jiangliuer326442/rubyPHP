<?php
/**
 * 0x3.me site API PHP SDK 核心工具文件
 *
 * @package   ShortURL
 * @author    zhiping.yin <yzp@bz-inc.com>
 * @copyright 2016 0x3.me
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 1.0
 * @link      https://0x3.me/api
 */

namespace ShortURL;

interface UtilInterface {
    /**
     * 向指定网址POST数据并返回原始值
     * @param string $url 要请求的网址
     * @param array $params 要post的数据
     * @return string
     * @throws Exception\Exception
     */
    public static function post($url,$params);

    /**
     * 生成签名
     * @param array $params
     * @param string $secret_key
     * @return string
     */
    public static function generateSign($params,$secret_key);
}

final class Util implements UtilInterface {

    /**
     * 向指定网址POST数据并返回原始值
     * @param string $url 要请求的网址
     * @param array $params 要post的数据
     * @return string
     * @throws Exception\Exception
     */
    public static function post($url,$params){
        $ch = curl_init();
        $options = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_USERAGENT => '0X3_ME_PHP_SDK/2.0',
            CURLOPT_URL => $url,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_TCP_NODELAY => 1,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $ret = curl_errno($ch);
        curl_close($ch);
        if ($ret !== 0) {
            throw new \ShortURL\Exception\Exception('curl network failed');
        } else {
            return $response;
        }
    }

    /**
     * 向指定网址GET数据并返回原始值
     * @param string $url 要请求的网址
     * @return string
     * @throws Exception\Exception
     */
    public static function get($url){
        $ch = curl_init();
        $options = array(
            CURLOPT_HEADER => 0,
            CURLOPT_USERAGENT => '0X3_ME_PHP_SDK/2.0',
            CURLOPT_URL => $url,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_TCP_NODELAY => 1,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $ret = curl_errno($ch);
        curl_close($ch);
        if ($ret !== 0) {
            throw new \ShortURL\Exception\Exception('curl network failed');
        } else {
            return $response;
        }
    }

    /**
     * 生成签名
     * @param array $params
     * @param string $secret_key
     * @return string
     */
    public static function generateSign($params,$secret_key){
        ksort($params);
        $sig = '';
        foreach ($params as $key => $value) {
            $sig .= sprintf('%s=%s', $key, $value);
        }
        $sig .= $secret_key;
        return md5($sig);
    }
}