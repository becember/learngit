<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
//$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
//		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        $postStr = file_get_contents('php://input');
      	//extract post data
		if (!empty($postStr)) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            switch ($postObj->MsgType){
                case "event":
                    if ($postObj->MsgType == 'subscribe'){
                        $this->_doSubscribe($postObj);
                        break;
                    }
                    if ($postObj->MsgType == 'click'){
                        $this->_doClick($postObj);
                    }
            }
        }
    }
    private function doText($to,$form,$content){
        $res = sprintf($this->_msg_template['text'],$to,$form,time(),$content);
        die($res);
    }
    private function _doSubscribe($postObj){
	    $content = "欢迎关注本公众平台";
	    $this->doText($this->ToUserName,$this->FormUserName,$content);
    }
    private $_msg_template = "<xml>
                                <ToUserName>< ![CDATA[%s] ]></ToUserName>
                                <FromUserName>< ![CDATA[%s] ]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType>< ![CDATA[news] ]></MsgType>
                                <ArticleCount>1</ArticleCount>
                                <Articles>
                                    <item>
                                        <Title>< ![CDATA[title1] ]></Title>
                                        <Description>< ![CDATA[description1] ]></Description>
                                        <PicUrl>< ![CDATA[picurl] ]></PicUrl>
                                        <Url>< ![CDATA[url] ]></Url>
                                    </item>
                                </Articles>
                                </xml>";
    private function _doClick($postObj){

    }
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>