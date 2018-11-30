<?php
/**
 * wechat php test
 */

//define your token
define("TOKEN", "may");
$wechatObj = new wechatCallbackapiTest();

//$wechatObj->valid();//接口验证
$wechatObj->responseMsg();//调用回复消息方法
class wechatCallbackapiTest
{
//    public function valid()
//    {
//        //valid signature , option
//        if($this->checkSignature()){
//            echo $_GET["echostr"];
//            exit;
//        }
//    }
//
//    private function checkSignature()
//    {
//        $signature = $_GET["signature"];
//        $timestamp = $_GET["timestamp"];
//        $nonce = $_GET["nonce"];
//        $token = TOKEN;
//        $tmpArr = array($token, $timestamp, $nonce);
//        sort($tmpArr);
//        $tmpStr = implode( $tmpArr );
//        $tmpStr = sha1( $tmpStr );
//        if( $tmpStr == $signature ){
//            return true;
//        }else{
//            return false;
//        }
//    }
    public function responseMsg()
    {
        //记得一行一行的去理解意思  !!!!!
        //php7.0只能用这种方式获取数据，之前的$GLOBALS['HTTP_RAW_POST_DATA']7.0版本不可用
        $postArr = file_get_contents("php://input");

        file_put_contents('./wx_log_obj.txt', $postArr, FILE_APPEND);
        if(empty($postArr)){
            die('');
        }
        if(!empty($postArr)){
            // 解析该xml字符串，利用simpleXML
            libxml_disable_entity_loader(true);
            //禁止xml实体解析，防止xml注入
            $postObj = simplexml_load_string($postArr, 'SimpleXMLElement', LIBXML_NOCDATA);
            //判断该消息的类型，通过元素MsgType
            switch ($postObj->MsgType){
                case 'event':
                    //判断具体的时间类型（关注、取消、点击）
                    $event = $postObj->Event;
                    if ($event=='subscribe') { // 关注事件
                        $this->_doSubscribe($postObj);
                    }elseif ($event=='click'){
                        $this->_doClick($postObj);
                    }
                    break;
                case 'text'://文本消息
                    $this->doText($postObj);
                    break;
                case 'image'://图片消息
                    $this->doImage($postObj);
                    break;
            }
        }
    }
    /**
     * 发送文本信息
     * @param  [type] $to      目标用户ID
     * @param  [type] $from    来源用户ID
     * @param  [type] $content 内容
     * @return [type]          [description]
     */
    private function _msgText($to, $from, $content) {
        $response = sprintf($this->_msg_template['text'], $to, $from, time(), $content);
        die($response);
    }
    private function _msgClick($to,$form,$content){
        $response = sprintf($this->_msg_template['click'],$to,$form,time(),$content);
        die($response);
    }
    /**
     * @param [type] $to              目标用户ID
     * @param [type] $from            来源用户ID
     * @param [type] $music_url       音乐网络地址链接
     * @param [type] $hq_music_url    音乐网络地址链接
     * @param [type] $thumb_media_id  一张图片的media_id
     * @param [type] string $title    音乐名称
     * @param [type] string $desc     音乐描述
     */
    private function _msgMusic($to, $from, $music_url, $hq_music_url, $thumb_media_id, $title='', $desc=''){
        $response = sprintf($this->_msg_template['music'], $to, $from, time(), $title, $desc, $music_url, $hq_music_url, $thumb_media_id);
        die($response);
    }
    //关注后做的事件
    private function _doSubscribe($postObj){
        //处理该关注事件，向用户发送关注信息
        $content = '欢迎光临本测试平台,您可以回复"新闻","个人信息",随便聊';
        $this->_msgText($postObj->FromUserName, $postObj->ToUserName, $content);
    }
    //普通点击处理
    private function _doClick($postObj){
        $content = "点击菜单拉取消息时的事件推送";
        $this->_msgClick($postObj->FormUserName,$postObj->ToUserName,$content);
    }

    /**
     * 发送文本信息
     * @param  [type] $to      目标用户ID
     * @param  [type] $from    来源用户ID
     * @param  [type] $content 内容
     * @return [type]          [description]
     */
    private function _doText($to,$form,$content){
        $response = sprintf($this->_msg_template['text'],$to,$form,time(),$content);
        die($response);
    }
    private function doNews($to,$form){
        $title = '重大事件';
        $description = '八维学院的大骗局!!';
        $PicUrl = "http://thirdwx.qlogo.cn/mmopen/DkXl1OHLLibwhOPjoZzjz9E6geics3y9VIicibtOVGR14LjlSe6XjtHuibQZo8zbWzZqcNoSHsoqBSRUyXcwrfL0CdVEV4mFUd3t8/132";
        $Url = "http://172.16.10.111/exam/login.do";
        $response = sprintf($this->_msg_template['news'],$to,$form,time(),$title,$description,$PicUrl,$Url);
        die($response);
    }
    private function _doMusic($to,$from){
        $id = "NEZTzvcMWXSBm_66rey84GQ4qGKLX5kxNLpsePcJO0kik8uZQzKew4NSQJlEPSsn";
        $response = sprintf($this->_msg_template['image'],$to,$from,time(),$id);
        die($response);
    }
    //文本处理
    private function doText($postObj){
        $content  = $postObj->Content;
        if ($content =='你好'){
            $content = "好个屁";
        }
        elseif ($content == '图片'){
            $this->_doMusic($postObj->FromUserName,$postObj->ToUserName);
        }
        elseif ($content=='个人信息'){
            $this->getusermsg($postObj->FromUserName,$postObj->ToUserName);
        }
        elseif ($content == '新闻'){
            $this->doNews($postObj->FromUserName,$postObj->ToUserName);
        }
        elseif ($content =='傻子'){
            $content = "我以为你只是个球?没想到?你真是个球";
        }
        elseif ($content == '滚'){
            $content = "我正在裸奔，已奔出服务区";
        }
        elseif ($content == '卧槽'){
            $content = "兄弟，我劝你善良";
        }
        elseif ($content == '李迪是傻子'){
            $content = "嗯，我赞同";
        }elseif ($content == '谁最可爱啊'){
            $content = "啦啦啦,当然是你身边的这个小猪啊!";
        }
        elseif ($content == '我好累'){
            $content = "看灯火辉煌，花红酒绿，演绎着一场场的繁华，或喜或悲。如果感觉累了就该歇歇了，给自己点时间，换上自己喜欢的衣服，打扮一下听着自己喜欢的音乐出去散散心，也可以去人比较多的地方走走转转。世界陪着你转,我陪着你老.";
        }
        elseif ($content == '我想你了'){
            $content = "很多时候，我都自以为自己是个更加理智的人，总是习惯冷眼旁观这个看似繁华的世界。当一个人开始习惯了对外界保持旁观，那么是否也意味着我将注定与这个世界脱轨？又是否保持一段距离，会让我感觉更安全？那些来自于不同的经过选择的距离，是一份经过取舍的安全感，给予我一片内心的宁静。我固执的认为那是件幸福的事，也是我始终不愿舍弃的，时间一天天的过，我却还是孤立着自己，逃避曾经熟悉的人，熟悉的班级，总是在不经意间，被一些莫名的情绪牵引着，悄悄的，慢慢的，竟是如此真切，让人想要看的更真，却又怕结果会令自己大失所望，我无从选择，于是向命运的妥协，成了最好的选择. 哈哈 我也想你啦  抱抱!";
        }
        elseif ($content == '音乐'){
            //音乐这个有问题  先不用看  我看完了再说吧
            $music_url='http://music.taihe.com/song/294305979';
            $ha_music_url='http://music.taihe.com/song/294305979';
            $thumb_media_id='';
            $title = '此生不换';
            $desc = '电视剧《仙剑奇侠传三》插曲';
            $this->_msgMusic($postObj->FromUserName, $postObj->ToUserName,$music_url,$ha_music_url,$thumb_media_id, $title,$desc);
        }
        else{
            //php mt_rand()返回随机整数。  他是一个类似与rand()的一个函数
            $mt = mt_rand(1,36);
            $content = array(
                1=>'人之初?性本善?玩心眼?都滚蛋。',
                2=>'今后的路?我希望你能自己好好走下去?而我 坐车',
                3=>'笑话是什么?就是我现在对你说的话。',4=>'人人都说我丑?其实我只是美得不明显。',5=>'A;猪是怎么死的?B;你还没死我怎么知道',6=>'
奥巴马已经干掉和他同姓的两个人?奥特曼你要小心了。 ',7=>'有的人活着?他已经死了?有的人活着?他早该死了。',8=>'"妹妹你坐船头?哥哥我岸上走"据说很傻逼的人看到都是唱出来的。',9=>'我这辈子只有两件事不会?这也不会?那也不会。',10=>'
过了这个村?没了这个店?那是因为有分店。',11=>'我以为你只是个球?没想到?你真是个球。',12=>'你终于来啦，我找你N年了，去火星干什么了？我现在去冥王星，回头跟你说个事，别走开啊',13=>'你有权保持沉默，你所说的一切都将被作为存盘记录。你可以请代理服务器，如果请不起网络会为你分配一个。',14=>'本人正在被国际刑警组织全球范围内通缉，如果您有此人的消息，请拨打当地报警电话',15=>'洗澡中~谢绝旁观！！^_^0',16=>'嘀，这里是移动秘书， 美眉请再发一次，我就与你联系；姐姐请再发两次，我就与你联系；哥哥、弟弟就不要再发了，因为发了也不和你联系！',17=>'
其实我在~就是不回你拿我怎么着？',18=>'你刚才说什么，我没看清楚，请再说一遍！',19=>'乖，不急。。。',20=>'自杀中，稍后再说...',21=>'有事找我请大叫！',22=>'我正在裸奔，已奔出服务区',23=>'我现在位置：WC； 姿势：下蹲； 脸部：抽搐； 状态：用力中。。。。',24=>'去吃饭了，如果你是帅哥，请一会联系我，如果你是美女...............就算你是美女，我也要先吃饱肚子啊',25=>'
洗澡中~谢绝旁观！！^_^0',26=>'有熊出?]，我去诱捕，尽快回来。',27=>'你好，我是500，请问你是250吗？',28=>'喂！乱码啊，再发',29=>'
不是我不理你，只是时间难以抗拒！',30=>'你刚才说什么，我没看清楚，请再说一遍！',31=>'发多几次啊~~~发多几次我就回你。',32=>'此人已死，有事烧纸！',33=>'乖，不急哦…',34=>'你好.我去杀几个人,很快回来.',35=>'本人已成仙?有事请发烟?佛说有烟没火成不了正果?有火没烟成不了仙。',36=>'
你要和我说话？你真的要和我说话？你确定自己想说吗？你一定非说不可吗？那你说吧，这是自动回复，反正我看不见其实我在~就是不回你拿我怎么着？');
            $this->_doText($postObj->FromUserName,$postObj->ToUserName,$content["$mt"]);
        }
        $this->_doText($postObj->FromUserName,$postObj->ToUserName,$content);
    }
    //图片消息
    private function doImage($postObj){

    }
    //直接把模板信息都封装在一个里面
    private $_msg_template = array(
        'text' => '<xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[text]]></MsgType>
                   <Content><![CDATA[%s]]></Content>
                   </xml>',//文本回复XML模板
        'image' => '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[image]]></MsgType>
                        <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                        </Image>
                    </xml>',//图片回复XML模板
        'music' => '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[music]]></MsgType>
                    <Music>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <MusicUrl><![CDATA[%s]]></MusicUrl>
                        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                        <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    </Music>
                    </xml>',//音乐模板
        'click' => '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Event><![CDATA[%s]]></Event>
                    <EventKey><![CDATA[click]]></EventKey>
                    </xml>',//点击菜单拉取消息时的事件推送
        'news' =>  '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>1</ArticleCount>
                    <Articles>
                        <item>
                            <Title><![CDATA[%s]]></Title>
                            <Description><![CDATA[%s]]></Description>
                            <PicUrl><![CDATA[%s]]></PicUrl>
                            <Url><![CDATA[%s]]></Url>
                        </item>
                    </Articles>
                    </xml>'
    );
    //Curl
    public function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $dom = curl_exec($ch);
        curl_close($ch);
        return $dom;
    }
    //获取access_token
    public function getaccesstoken(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx31321a44db1017ee&secret=5a00f7a2b20b03315070e8244517e83f";
        $token = json_decode($this->curl($url),true);
        return $token['access_token'];
    }
    //获取用户信息
    public function getusermsg($to,$form){
        $token = $this->getaccesstoken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$to&lang=zh_CN";
        $data = json_decode($this->curl($url),true);
        $nickname = $data['nickname'];
        $sex = $data['sex'];
        if ($sex=='1'){
            $sex = '男';
        }else{
            $sex = '女';
        }
        $city = $data['city'];
        $province = $data['province'];
        $pdo = new PDO('mysql:host=118.25.193.128;dbname=advanced','root','root');
        $sql = "insert into usermessage values(null,'$nickname','$city','$province','$sex')";
        $pdo->exec($sql);
        $content = "你好".$nickname."我猜你是".$province."".$city."的小".$sex."生";
        $response = sprintf($this->_msg_template['text'],$to,$form,time(),$content);
        die($response);
    }

}


?>