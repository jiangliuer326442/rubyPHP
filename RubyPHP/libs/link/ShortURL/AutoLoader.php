<?php
/**
 * 0x3.me site API PHP SDK 自动加载器,此文件非必需,你可以使用其它自动加载器
 *
 * @package   ShortURL
 * @author    zhiping.yin <yzp@bz-inc.com>
 * @copyright 2016 0x3.me
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 1.0
 * @link      https://0x3.me/api
 */

function autoLoader($class) {
    $try_file = dirname(dirname(__FILE__)) . '/' . str_replace('\\', '/', $class) . '.php';
    if(file_exists($try_file))
      require($try_file);
}
spl_autoload_register('autoLoader');
