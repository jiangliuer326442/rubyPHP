<?php
// Server                                                                                                                
class Server
{
    private $serv;

    public function __construct($port) {
        $this->serv = new Swoole\Http\Server("0.0.0.0", $port);

        $this->serv->set(array(
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 2,
            'debug_mode'=> 1
        )); 

        $this->serv->on('Request', array($this, 'onRequest'));
        $this->serv->on('Start', array($this, 'onStart'));
        $this->serv->on('Connect', array($this, 'onConnect'));
        $this->serv->on('Receive', array($this, 'onReceive'));
        $this->serv->on('Close', array($this, 'onClose'));

        $this->serv->start();
    }
                                                                                                                         
    public function onRequest($request, $response) {
        global $config;
        //根据url加载PHP模块（控制器）
        $request_url = substr($request->server['request_uri'], 1);
        $request_url = explode('.', str_replace_once( "/", "", $request_url))[0];
        if($request_url == "") $request_url = "default";
		$model_url = "";
        foreach($config['route'] as $url => $model){
            //完全匹配路由
            if(!strstr($url, ":")){
                if($url == $request_url){
                    $model_url = $model;
                    break;
                }   
            }else{  
                $url_arr = explode("/", $url);
                $request_url_arr = explode("/", $request_url);
                if(count($url_arr) == count($request_url_arr)){
                    foreach($url_arr as $key => $val){
                        if(!strstr($val, ":")){ 
                            if($val != $request_url_arr[$key]){
                                break; 
                            } 
                        }else{                                                                                           
                            $my_routes[substr($val, 1)] = $request_url_arr[$key];
                        }   
                        if($key+1 == count($url_arr)){
                            $model_url = $model;
                            break;
                        }   
                    }   
                }   
            }   
        } 
		dispatch($model_url, $request, $response);  
        
/**     
        var_dump($request->get);
        var_dump($request->post);
        var_dump($request->cookie);
        var_dump($request->files);
        var_dump($request->header);
        var_dump($request->server);
**/
    }                                                                                                                    
    
    public function onStart( $serv ) {
    }

    public function onConnect( $serv, $fd, $from_id ) {
        echo "connect";
    }   

    public function onReceive( swoole_server $serv, $fd, $from_id, $data ) {
        echo "Get Message From Client {$fd}:{$data}\n";
    }   

    public function onClose( $serv, $fd, $from_id ) {
        echo "Client {$fd} close connection\n";
    }   
}
