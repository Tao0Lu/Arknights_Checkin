<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>Arknights CheckIn - Console</title>
    <meta name="keywords" content="Arknights">
    <meta name="description" content="Arknights Simulator" />
    <style>
        body{
            background-image:url('/bg.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            margin: 0px;
            padding: 0px;
        }
        .ak-dialog-layer {
            color: #333333;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            clip-path: polygon(0 0, 95% 0, 100% 5%, 100% 100%, 5% 100%, 0 95%);
        }
        .ak-dialog-layer-title {
            display: flex;
            align-items: center;
            height: 5em;
            background-color: #333333;
            color: #eeeeee;
            font-family: "HgSDKGeometos";
            font-weight: bold;
            letter-spacing: 0.1em;
            line-height: 1.2;
            padding: 0 2em;
            border-bottom: 3px solid #37b2ff;
            white-space: nowrap;
            overflow: hidden;
        }
        .ak-dialog-layer-body {
            flex: auto;
            min-width: 0;
            height: 100%;
            box-sizing: border-box;
            outline: none !important;
            border-radius: 0;
            border: none;
            border-bottom: 1px solid currentColor;
            transition: border-bottom-color 0.3s;
        }
        div{ display:inline}
        console {
            background: #000;
            border: 3px groove #ccc;
            color: #ccc;
            display: block;
            padding: 10px;
            width: 99%;
            overflow:auto;
            height: 92%;
        }
    </style>
    <script>
        function getCookie(name)
        {
            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
            if(arr=document.cookie.match(reg))
                return unescape(arr[2]);
            else
                return null;
        }
        function delCookie(name)
        {
            var exp = new Date();
            exp.setTime(exp.getTime() - 1);
            var cval=getCookie(name);
            if(cval!=null)
                document.cookie= name + "="+cval+";expires="+exp.toGMTString();
        }
        function checkAK(){
            if (document.getElementById('console').innerText.includes('错误或失效的Access Token')){
                delCookie("LAST_LOGIN_NAME");
                delCookie("LAST_LOGIN_ACCESS_TOKEN");
                delCookie("LAST_LOGIN_YOSTAR_LOGIN_TOKEN");
                delCookie("LAST_LOGIN_SERVER");
            }
        }
    </script>
</head>

<body onload="checkAK()">
<div>
    <div class="ak-dialog-layer">
        <div class="ak-dialog-layer-title">
            <div id="return_btn" onclick="window.location.href='./index.html'"><svg class="icon" viewBox="0 0 1024 1024" version="1.1" width="32" height="32"><path d="M874.666667 480H224L514.133333 170.666667c12.8-12.8 10.666667-34.133333-2.133333-44.8s-32-10.666667-44.8 2.133333l-341.333333 362.666667c-2.133333 2.133333-4.266667 6.4-6.4 8.533333-2.133333 4.266667-2.133333 6.4-2.133334 10.666667s0 8.533333 2.133334 10.666666c2.133333 4.266667 4.266667 6.4 6.4 8.533334l341.333333 362.666666c6.4 6.4 14.933333 10.666667 23.466667 10.666667 8.533333 0 14.933333-2.133333 21.333333-8.533333 12.8-12.8 12.8-32 2.133333-44.8L224 544H874.666667c17.066667 0 32-14.933333 32-32s-14.933333-32-32-32z" p-id="2931" fill="#cdcdcd"></path></svg></div>
            <h1 style="margin-left:1em">控制台</h1>
        </div>
        <div class="ak-dialog-layer-body">
            <console id="console">
                <?php
                $HMAC_KEY = '91240f70c09a08a6bc72af1a5c8d4670';

                $COMMON_HEADER = array(
                    'Content-Type: application/json',
                    'X-Unity-Version: 2017.4.39f1',
                    'User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; X Build/V417IR)',
                    'Connection: Keep-Alive'
                );
                $PASSPORT_HEADER = array(
                    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
                    'User-Agent: Dalvik/2.1.0 (Linux; U; Android 6.0.1; X Build/V417IR)',
                    'Connection: Keep-Alive'
                );
                $RES_VERSION = '';
                $CLIENT_VERSION = '';
                $NETWORK_VERSION = '';

                $MODULES = 1631;
                $CHECKIN_ACTIVITY_ID = '';
                $CHECKIN_ACTIVITY_ON = false;

                $APP_ID = '1';
                $PLATFORM_ID = 'Android';//'IOS'
                $PLATFORM = 1;

                // 国服
                $HOST_AUTH_SERVER = 'https://as.hypergryph.com';
                $HOST_GAME_SERVER = 'https://ak-gs-gf.hypergryph.com';
                $HOST_CONFIG_SERVER = 'https://ak-conf.hypergryph.com';
                $HOST_VERSION_ADDR = "https://ak-conf.hypergryph.com/config/prod/official/{$GLOBALS['PLATFORM_ID']}/version";
                // 日服
                $HOST_PASSPORT_SERVER_JP = 'https://passport.arknights.jp';
                $HOST_AUTH_SERVER_JP = 'https://as.arknights.jp';
                $HOST_GAME_SERVER_JP = 'https://gs.arknights.jp:8443';
                $HOST_CONFIG_SERVER_JP = 'https://ak-conf.arknights.jp';
                $HOST_VERSION_ADDR_JP = 'https://ark-jp-static-online.yo-star.com/assetbundle/official/Android/version';
                $SERVER_ID_JP = '3';
                // 美服|全球服
                $HOST_PASSPORT_SERVER_US = 'https://passport.arknights.global';
                $HOST_AUTH_SERVER_US = 'https://as.arknights.global';
                $HOST_GAME_SERVER_US = 'https://gs.arknights.global:8443';
                $HOST_CONFIG_SERVER_US = 'https://ak-conf.arknights.global';
                $HOST_VERSION_ADDR_US = 'https://ark-us-static-online.yo-star.com/assetbundle/official/Android/version';
                $SERVER_ID_US = '3';

                class Player {
                    var $device_id = ''; // 登录设备指纹, 注册账号时使用的唯一标识
                    var $device_id2 = ''; // imei
                    var $device_id3 = ''; // 登录设备指纹, 可为空
                    var $account = ''; // 账号
                    var $password = ''; // 密码
                    var $uid = 0; // 当前账号唯一标识
                    var $channel_uid = 0; // 渠道uid
                    var $access_token = ''; // 游客登录凭据, 用来获取channel_uid
                    var $token = ''; // 使用channel_uid和access_token换取的一次性登录凭据
                    var $secret = ''; // http session_id, 标志客户端登录状态

                    var $is_yostar = false; // 是否为国际服
                    var $yostar_account = ''; // 国际服_账号
                    var $yostar_uid = ''; // 国际服_uid
                    var $yostar_channel_token = ''; // 国际服_渠道token
                    var $yostar_token = ''; // 国际服_换取的一次性登录凭据
                    var $yostar_login_token = ''; // token&uid

                    var $seqnum = 0; // 封包编号, 服务器会返回下一次请求使用的编号, 通常每次请求自增1
                    var $login_time = 0; // syncData返回的服务器时间, 副本战斗日志加密时使用
                    var $time_diff = 0; // 服务器与本地时间差
                    var $can_checkin = true; // 是否可以签到
                    var $social_point = 0; // 信用数
                    var $can_receive_social_point = true; // 是否领取信用
                    var $building_on = true; // 基建是否解锁
                    var $activity_checkin_history = array(); // 活动签到历史
                    var $manufacture_room_slot = array(); // 制造站
                    var $trade_room_slot = array(); // 贸易站
                    var $control_room_slot = array(); // 控制中心
                    var $dormitory_room_slot = array(); // 宿舍
                    var $power_room_slot = array(); // 发电站
                    var $meeting_room_slot = array(); // 会客室
                    var $hire_room_slot = array(); // 办公室
                    var $free_chars_list=array(); // 空闲干员
                    var $lowAp_chars_list=array(); // 低理智干员

                    function get_device_id(){return $this->device_id;}
                    function get_device_id2(){return $this->device_id2;}
                    function get_device_id3(){return $this->device_id3;}
                    function get_account(){return $this->account;}
                    function set_account($account){$this->account = $account;}
                    function get_password(){return $this->password;}
                    function set_password($password){$this->password = $password;}
                    function get_uid(){return $this->uid;}
                    function set_uid($uid){$this->uid = $uid;}
                    function get_channel_uid(){return $this->channel_uid;}
                    function set_channel_uid($channel_uid){$this->channel_uid = $channel_uid;}
                    function get_access_token(){return $this->access_token;}
                    function set_access_token($access_token){$this->access_token = $access_token;}
                    function get_token(){return $this->token;}
                    function set_token($token){$this->token = $token;}
                    function get_secret(){return $this->secret;}
                    function set_secret($secret){$this->secret = $secret;}

                    function get_is_yostar(){return $this->is_yostar;}
                    function set_is_yostar($is_yostar){$this->is_yostar=$is_yostar;}
                    function get_yostar_account(){return $this->yostar_account;}
                    function set_yostar_account($account){$this->yostar_account=$account;}
                    function get_yostar_uid(){return $this->yostar_uid;}
                    function set_yostar_uid($uid){$this->yostar_uid=$uid;}
                    function get_yostar_channel_token(){return $this->yostar_channel_token;}
                    function set_yostar_channel_token($channel_token){$this->yostar_channel_token=$channel_token;}
                    function get_yostar_token(){return $this->yostar_token;}
                    function set_yostar_token($token){$this->yostar_token=$token;}
                    function get_yostar_login_token(){return $this->yostar_login_token;}
                    function set_yostar_login_token($yostar_login_token){$this->yostar_login_token =$yostar_login_token;}

                    function get_seq(){return $this->seqnum;}
                    function set_seq($seq){$this->seqnum=$seq;}
                    function get_login_time(){return $this->login_time;}
                    function set_login_time($login_time){$this->login_time=$login_time;}
                    // 获取本地时间
                    function get_local_time(){return time()+$this->time_diff;}
                    // 本地时间校正
                    function set_time_diff($server_time){$this->time_diff=$server_time-time();}
                    function get_can_checkin(){return $this->can_checkin;}
                    function set_can_checkin($can_checkin){$this->can_checkin=$can_checkin;}
                    function get_social_point(){return $this->social_point;}
                    function set_social_point($social_point){$this->social_point=$social_point;}
                    function get_can_receive_social_point(){return $this->can_receive_social_point;}
                    function set_can_receive_social_point($can_receive_social_point){$this->can_receive_social_point=$can_receive_social_point;}
                    function get_building_on(){return $this->building_on;}
                    function set_building_on($building_on){$this->building_on=$building_on;}
                    function get_activity_checkin_history(){return $this->activity_checkin_history;}
                    function set_activity_checkin_history($history){$this->activity_checkin_history=$history;}
                    function get_manufacture_room_slot(){return $this->manufacture_room_slot;}
                    function set_manufacture_room_slot($room_slot){$this->manufacture_room_slot=$room_slot;}
                    function get_trade_room_slot(){return $this->trade_room_slot;}
                    function set_trade_room_slot($room_slot){$this->trade_room_slot=$room_slot;}
                    function get_control_room_slot(){return $this->control_room_slot;}
                    function set_control_room_slot($room_slot){$this->control_room_slot=$room_slot;}
                    function get_dormitory_room_slot(){return $this->dormitory_room_slot;}
                    function set_dormitory_room_slot($room_slot){$this->dormitory_room_slot=$room_slot;}
                    function get_power_room_slot(){return $this->power_room_slot;}
                    function set_power_room_slot($room_slot){$this->power_room_slot=$room_slot;}
                    function get_meeting_room_slot(){return $this->meeting_room_slot;}
                    function set_meeting_room_slot($room_slot){$this->meeting_room_slot=$room_slot;}
                    function get_hire_room_slot(){return $this->hire_room_slot;}
                    function set_hire_room_slot($room_slot){$this->hire_room_slot=$room_slot;}
                    function get_free_chars_list(){return $this->free_chars_list;}
                    function set_free_chars_list($free_chars_list){$this->free_chars_list=$free_chars_list;}
                    function get_lowAp_chars_list(){return $this->lowAp_chars_list;}
                    function set_lowAp_chars_list($lowAp_chars_list){$this->lowAp_chars_list=$lowAp_chars_list;}


                    function init($device_id, $device_id2 = '', $device_id3 = '', $access_token = ''){
                        $this->device_id=$device_id;
                        if ($device_id2) $this->device_id2=$device_id2;
                        else $this->device_id2=get_random_device_id2();
                        if ($device_id3) $this->device_id3=$device_id3;
                        else $this->device_id3=get_random_device_id3();
                        $this->access_token=$access_token;
                    }
                }
                // 服务器设置
                $server='';
                if (!empty($_COOKIE['LAST_LOGIN_SERVER'])){
                    $server=$_COOKIE['LAST_LOGIN_SERVER'];
                } elseif (!empty($_POST['server'])) {
                    $server=$_POST['server'];
                }
                if ($server!='CN'){
                    $GLOBALS['HOST_PASSPORT_SERVER'] = $GLOBALS['HOST_PASSPORT_SERVER_'.$server];
                    $GLOBALS['HOST_AUTH_SERVER'] = $GLOBALS['HOST_AUTH_SERVER_'.$server];
                    $GLOBALS['HOST_GAME_SERVER'] = $GLOBALS['HOST_GAME_SERVER_'.$server];
                    $GLOBALS['HOST_CONFIG_SERVER'] = $GLOBALS['HOST_CONFIG_SERVER_'.$server];
                    $GLOBALS['HOST_VERSION_ADDR'] = $GLOBALS['HOST_VERSION_ADDR_'.$server];
                    $SERVER_ID = $GLOBALS['SERVER_ID_'.$server];
                }
                // main
                ob_start();
                if (!empty($_POST['ex'])){
                    if ($_POST['ex']='sendSMSCode' and !empty($_POST['account'])){
                        send_sms_code($_POST['account']);
                        exit();
                    }
                    if ($_POST['ex']='sendMailCode' and !empty($_POST['yostarAccount'])){
                        yostar_auth_request($_POST['yostarAccount']);
                        exit();
                    }
                }

                if (empty($_COOKIE['LAST_LOGIN_YOSTAR_LOGIN_TOKEN'])) {
                    if (empty($_COOKIE['LAST_LOGIN_ACCESS_TOKEN'])) {
                        if (empty($_POST['accessToken'])) {
                            if (empty($_POST['yostarLoginToken'])) {
                                if (empty($_POST['mailCode']) or empty($_POST['yostarAccount'])) {
                                    if (empty($_POST['smsCode']) or empty($_POST['account'])) {
                                        if (empty($_POST['account']) or empty($_POST['password'])) {
                                            report_error('登录失败: 账号或密码不能为空');
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                updata_config();
                $player=new Player();
                $player->init(get_random_device_id());
                if (!empty($_COOKIE['LAST_LOGIN_YOSTAR_LOGIN_TOKEN'])) {
                    $player->set_yostar_login_token($_COOKIE['LAST_LOGIN_YOSTAR_LOGIN_TOKEN']);
                    $player->set_is_yostar(true);
                } elseif (!empty($_COOKIE['LAST_LOGIN_ACCESS_TOKEN'])) {
                    $player->set_access_token($_COOKIE['LAST_LOGIN_ACCESS_TOKEN']);
                } else {
                    if (!empty($_POST['accessToken'])) {
                        $player->set_access_token($_POST['accessToken']);
                    } elseif (!empty($_POST['yostarLoginToken'])) {
                        $player->set_yostar_login_token($_POST['yostarLoginToken']);
                        $player->set_is_yostar(true);
                    } elseif (!empty($_POST['smsCode']) and !empty($_POST['account'])) {
                        $player->set_account($_POST['account']);
                        sms_code_login($player, $_POST['smsCode']);
                    } elseif (!empty($_POST['mailCode']) and !empty($_POST['yostarAccount'])) {
                        $player->set_is_yostar(true);
                        yostar_auth_submit($player,$_POST['yostarAccount'],$_POST['mailCode']);
                        yostar_createlogin($player);
                        yostar_login($player);
                    } else {
                        $player->set_account($_POST['account']);
                        $player->set_password($_POST['password']);
                    }
                }
                if (!empty($_POST['keepCookies'])) {
                    if ($_POST['server']!=''){
                        setcookie('LAST_LOGIN_SERVER', $_POST['server'], time() + 3600 * 24 * 30 * 12);
                    }
                }
                play_login($player);


                function play_login($player)
                {
                    if ($player->get_is_yostar()) {
                        if ($player->get_yostar_login_token()) {
                            // 获取access_token
                            $yostar_login_token=base64_decode($player->get_yostar_login_token());
                            $res = urlencode($yostar_login_token);
                            $re = urldecode($res);
                            parse_str($re,$arr);
                            $player->set_yostar_token($arr['token']);
                            $player->set_channel_uid($arr['uid']);
                            yostar_login($player);
                        }
                        if (!empty($_POST['keepCookies'])) {
                            if ($_POST['keepCookies'] == 'true') {
                                setcookie('LAST_LOGIN_YOSTAR_LOGIN_TOKEN', $player->get_yostar_login_token(), time() + 3600 * 24 * 30 * 12);
                            }
                        }
                        // 获取token
                        get_token($player,$GLOBALS['SERVER_ID'],$GLOBALS['SERVER_ID'],$GLOBALS['SERVER_ID'],'token');
                    } else {
                        if ($player->get_access_token()) {
                            // auth登录
                            auth_login($player);
                        } else {
                            // 账号密码登录
                            user_login($player);
                        }
                        if (!empty($_POST['keepCookies'])) {
                            if ($_POST['keepCookies'] == 'true') {
                                setcookie('LAST_LOGIN_ACCESS_TOKEN', $player->get_access_token(), time() + 3600 * 24 * 30 * 12);
                            }
                        }
                        sleep(1);
                        // 获取token
                        get_token($player);
                    }
                    usleep(10000);
                    // 登录游戏服务器
                    game_login($player);
                    usleep(10000);
                    // 同步账号数据
                    sync_data($player);
                    ob_end_flush();
                    ob_implicit_flush(true);
                    ob_end_flush();
                    usleep(10000);
                    // 更新在线状态
                    sync_status($player, $GLOBALS['MODULES']);
                    usleep(10000);
                    // 获取未完成订单
                    get_unconfirmed_orderid_list($player);
                    usleep(50000);

                    // 每日签到
                    if ($player->get_can_checkin()) checkin($player);
                    usleep(100000);
                    // 活动签到
                    if ($GLOBALS['CHECKIN_ACTIVITY_ON']) {
                        $flag = false;
                        $history = $player->get_activity_checkin_history();
                        for ($i = 0; $i < count($history); $i++) {
                            if ($history[$i]) {
                                activity_checkin($player, $GLOBALS['CHECKIN_ACTIVITY_ID'], $i);
                                $flag = true;
                            }
                        }
                        if (!$flag) report_normal("<font color=\"#FFA500\">今日活动已签到</font>");
                    }
                    usleep(100000);
                    // 领取邮件|维护补偿
                    $mail_list = get_meta_info_list($player);
                    foreach ($mail_list as $mail) {
                        recieve_mail($player, $mail['mailId'], $mail['type']);
                        usleep(300000);
                    }

                    // 获取商店信用
                    if ($player->get_can_receive_social_point()) receive_social_point($player);
                    usleep(100000);
                    // 同步基建数据
                    sync_building($player);
                    usleep(100000);
                    if ($player->get_building_on()) {
                        // 获取制造站产物
                        settle_manufacture($player);
                        usleep(100000);
                        // 递交贸易站订单
                        delivery_batch_order($player);
                        usleep(100000);
                        // 获取基建干员信赖
                        gain_all_intimacy($player);
                        // 同步信用
                        sync_social_point($player);
                        // 自动兑换信用
                        auto_buy_social_good($player);
                        // 自动按照理智设置基建助理干员
                        auto_set_assign_char($player);
                        auto_get_mission_rewards($player);
                    } else {
                        report_normal("<font color=\"#FFA500\">基建、任务、活动签到未解锁</font>");
                    }
                    report_normal("<font color=\"#90EE90\">完成</font>");
                }

                // 功能函数声明:

                // 获取客户端最新版本号
                function updata_config()
                {
                    $res = get_from_conf($GLOBALS['HOST_CONFIG_SERVER'].'/config/prod/official/network_config');
                    if ($res == 'error') {
                        report_error("获取客户端最新版本号: 连接错误");
                    }
                    preg_match('/(?<=")\d+/', $res, $network_version);
                    $GLOBALS['NETWORK_VERSION'] = $network_version[0];

                    $res = get_from_conf($GLOBALS['HOST_VERSION_ADDR']);
                    if ($res == 'error') {
                        report_error("获取客户端最新版本号: 连接错误");
                    }
                    $config = json_decode($res);
                    $GLOBALS['RES_VERSION'] = $config->resVersion;
                    $GLOBALS['CLIENT_VERSION'] = $config->clientVersion;
                }

                // 同步账号数据
                function sync_data($player)
                {
                    $data = json_encode(array('platform' => $GLOBALS['PLATFORM']));
                    $res = post_to_gs('/account/syncData', $data, $player);
                    if ($res == 'error') {
                        report_error("活动签到错误: 连接错误");
                    } else {
                        $j = json_decode($res);
                        $show_name = urlencode($j->user->status->nickName) . '#' . $j->user->status->nickNumber;
                        if (!empty($_POST['keepCookies'])) {
                            if ($_POST['keepCookies'] == 'true') {
                                setcookie('LAST_LOGIN_NAME', $show_name, time() + 3600 * 24 * 30 * 12);
                            }
                        }
                        $player->set_can_checkin($j->user->checkIn->canCheckIn ? true : false);
                        $player->set_can_receive_social_point($j->user->social->yesterdayReward->canReceive ? true : false);
                        if (count((array)$j->user->activity->CHECKIN_ONLY)) {
                            $activity_array = array();
                            foreach ($j->user->activity->CHECKIN_ONLY as $id => $item) {
                                array_push($activity_array, $id);
                            }
                            report_normal("<font color=\"#FFA500\">发现存在活动签到:</font> 当前活动签到可用id:" . $activity_array[0]);
                            $GLOBALS['CHECKIN_ACTIVITY_ON'] = true;
                            $GLOBALS['CHECKIN_ACTIVITY_ID'] = $activity_array[0];
                            $player->set_activity_checkin_history($j->user->activity->CHECKIN_ONLY->{$activity_array[0]}->history);
                        }
                        // 本地时间校正
                        $player->set_time_diff($j->ts);
                        // 记录玩家上线时间
                        //$player->set_login_time($j->user->event->status);
                        report_normal("<font color=\"#90EE90\">数据同步成功:</font> uid:{$player->get_uid()}, 服务器时间:{$j->ts}");
                        //report_normal("<font color=\"#90EE90\">登陆时间戳已保存:</font> uid:{$player->get_uid()}, login_time:{$player->get_login_time()}");
                    }
                }
                // 更新在线状态
                function sync_status($player, $modules)
                {
                    $data = "{\"modules\":{$modules},\"params\":{\"16\":{\"goodIdMap\":{\"CASH\":[],\"ES\":[],\"GP\":[\"GP_Once_1\"],\"HS\":[],\"LS\":[],\"SOCIAL\":[]}}}}";
                    $res = post_to_gs('/account/syncStatus', $data, $player);
                    if ($res == 'error') {
                        report_error("状态同步失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        report_normal("<font color=\"#90EE90\">状态同步成功:</font> uid:{$player->get_uid()}, 更新账号上线时间:{$j->ts}");
                    }
                }
                // 同步基建数据
                function sync_building($player)
                {
                    $res = post_to_gs('/building/sync', "{}", $player);
                    if ($res == 'error') {
                        report_error("基建数据同步失败: 连接错误");
                    } else {
                        $manufacture_room_slot_list = array();
                        $trade_room_slot_list = array();
                        $control_room_slot_list = array();
                        $dormitory_room_slot_list = array();
                        $power_room_slot_list = array();
                        $hire_room_slot_list = array();
                        $meeting_room_slot_list = array();
                        $j = json_decode($res);
                        $j_rooms = $j->playerDataDelta->modified->building->rooms;
                        $j_room_slots = $j->playerDataDelta->modified->building->roomSlots;
                        if (array_key_exists('MANUFACTURE', $j_rooms) and array_key_exists('TRADING', $j_rooms) and array_key_exists('CONTROL', $j_rooms) and array_key_exists('DORMITORY', $j_rooms) and array_key_exists('HIRE', $j_rooms) and array_key_exists('POWER', $j_rooms)) {
                            foreach ($j_room_slots as $slot_id => $room) {
                                if ($room->roomId == 'MANUFACTURE') {
                                    array_push($manufacture_room_slot_list, array('count' => count($room->charInstIds), 'slot_id' => $slot_id));
                                } else if ($room->roomId == 'TRADING') {
                                    array_push($trade_room_slot_list, array('count' => count($room->charInstIds), 'slot_id' => $slot_id));
                                } else if ($room->roomId == 'CONTROL') {
                                    array_push($control_room_slot_list, array('count' => count($room->charInstIds), 'slot_id' => $slot_id));
                                } else if ($room->roomId == 'DORMITORY') {
                                    array_push($dormitory_room_slot_list, array('count' => count($room->charInstIds), 'slot_id' => $slot_id));
                                } else if ($room->roomId == 'POWER') {
                                    array_push($power_room_slot_list, array('count' => count($room->charInstIds), 'slot_id' => $slot_id));
                                } else if ($room->roomId == 'HIRE') {
                                    array_push($hire_room_slot_list, array('count' => count($room->charInstIds), 'slot_id' => $slot_id));
                                } else if ($room->roomId == 'MEETING') {
                                    array_push($meeting_room_slot_list, array('count' => count($room->charInstIds), 'slot_id' => $slot_id));
                                }
                            }
                            $free_chars_list = array();
                            $lowAp_chars_list = array();
                            foreach ($j->playerDataDelta->modified->building->chars as $index => $char) {
                                array_push($free_chars_list, array('index' => (int)$index, 'ap' => $char->ap));
                                array_push($lowAp_chars_list, array('index' => (int)$index, 'ap' => $char->ap));
                            }
                            array_multisort(array_column($free_chars_list, 'ap'), SORT_DESC, $free_chars_list);
                            array_multisort(array_column($lowAp_chars_list, 'ap'), SORT_ASC, $lowAp_chars_list);
                            $player->set_free_chars_list($free_chars_list);
                            $player->set_lowAp_chars_list($lowAp_chars_list);
                        } else {
                            $player->set_building_on(false);
                        }
                        $player->set_manufacture_room_slot($manufacture_room_slot_list);
                        $player->set_trade_room_slot($trade_room_slot_list);
                        $player->set_control_room_slot($control_room_slot_list);
                        $player->set_dormitory_room_slot($dormitory_room_slot_list);
                        $player->set_power_room_slot($power_room_slot_list);
                        $player->set_hire_room_slot($hire_room_slot_list);
                        $player->set_meeting_room_slot($meeting_room_slot_list);
                        report_normal("<font color=\"#90EE90\">基建数据同步成功:</font> uid:{$player->get_uid()}");
                    }
                }

                // 账号密码登录
                function user_login($player)
                {
                    $account = $player->get_account();
                    $deviceId = $player->get_device_id();
                    $password = $player->get_password();
                    $sign_data = "account={$account}&deviceId={$deviceId}&password={$password}&platform={$GLOBALS['PLATFORM']}";
                    $sign = u8_sign($sign_data);
                    $data = json_encode(array('account' => $account, 'password' => $password, 'deviceId' => $deviceId, 'platform' => $GLOBALS['PLATFORM'], 'sign' => $sign));
                    $res = post_to_as('/user/login', json_encode($data));
                    if ($res == 'error') {
                        report_error("账号密码登录失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if ($j->result or array_key_exists('error', $j)) {
                            report_error("账号密码登录失败: data={$data}, err_data={$res}");
                            return;
                        }
                        $player->set_channel_uid($j->uid);
                        $player->set_access_token($j->token);
                        report_normal("<font color=\"#90EE90\">账号密码登录成功:</font> 账号:{$player->get_account()}, deviceId:{$player->get_device_id()}, channel_uid:{$j->uid}, access_token:{$j->token}");
                    }
                }
                // 短信验证码登录
                function sms_code_login($player,$sms_code)
                {
                    $account = $player->get_account();
                    $deviceId = $player->get_device_id();
                    $sign_data = "account={$account}&deviceId={$deviceId}&platform={$GLOBALS['PLATFORM']}&smsCode={$sms_code}";
                    $sign = u8_sign($sign_data);
                    $data = json_encode(array('account' => $account, 'smsCode' => $sms_code, 'deviceId' => $deviceId, 'platform' => $GLOBALS['PLATFORM'], 'sign' => $sign));
                    $res = post_to_as('/user/loginBySmsCode', json_encode($data));
                    if ($res == 'error') {
                        report_error("短信验证码登录失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if ($j->result or $j->error!='') {
                            report_error("短信验证码登录失败: data={$data}, err_data={$res}");
                            return;
                        }
                        $player->set_channel_uid($j->uid);
                        $player->set_access_token($j->token);
                        report_normal("<font color=\"#90EE90\">短信验证码登录成功:</font> 账号:{$player->get_account()}, 短信验证码:{$sms_code}, deviceId:{$player->get_device_id()}, channel_uid:{$j->uid}, access_token:{$j->token}");
                    }
                }
                // auth登录
                function auth_login($player)
                {
                    $sign = u8_sign("token={$player->get_access_token()}");
                    $data = json_encode(array('token' => $player->get_access_token(), 'sign' => $sign));
                    $res = post_to_as('/user/auth', $data);
                    if ($res == 'error') {
                        report_error("auth登录失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if (array_key_exists('error', $j)) {
                            if ($j->message == "invalid token") {
                                report_error("登录失败: 错误或失效的Access Token, data={$data}, err_data={$res}");
                            } else {
                                report_error("auth登录失败: data={$data}, err_data={$res}");
                            }
                            return;
                        }
                        $player->set_channel_uid($j->uid);
                        report_normal("<font color=\"#90EE90\">Auth登录成功:</font>, access_token:{$player->get_access_token()}, channel_uid:{$j->uid}");
                    }
                }
                // 获取token
                function get_token($player,$channel_id = '1',$sub_channel = '1',$world_id = '1',$akdiff='access_token')
                {
                    $deviceId = $player->get_device_id();
                    $deviceId2 = $player->get_device_id2();
                    $deviceId3 = $player->get_device_id3();
                    $uid = $player->get_channel_uid();
                    $access_token = $player->get_access_token();
                    $sign_data = "appId={$GLOBALS['APP_ID']}&channelId={$channel_id}&deviceId={$deviceId}&deviceId2={$deviceId2}&deviceId3={$deviceId3}&extension={\"uid\":\"{$uid}\",\"{$akdiff}\":\"{$access_token}\"}&platform={$GLOBALS['PLATFORM']}&subChannel={$sub_channel}&worldId={$world_id}";
                    $sign = u8_sign($sign_data);
                    $data = json_encode(array('appId' => $GLOBALS['APP_ID'],
                        'channelId' => $channel_id,
                        'deviceId' => $deviceId,
                        'deviceId2' => $deviceId2,
                        'deviceId3' => $deviceId3,
                        'extension' => "{\"uid\":\"{$uid}\",\"{$akdiff}\":\"{$access_token}\"}",
                        'platform' => $GLOBALS['PLATFORM'],
                        'subChannel' => $sub_channel,
                        'worldId' => $world_id,
                        'sign' => $sign
                    ));
                    $res = post_to_as('/u8/user/getToken', $data);
                    if ($res == 'error') {
                        report_error("获取token失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if ($j->result or $j->error!='') {
                            report_error("获取token失败: data={$data}, err_data={$res}");
                            return;
                        }
                        $player->set_uid($j->uid);
                        $player->set_token($j->token);
                        report_normal("<font color=\"#90EE90\">获取Token成功:</font> uid:{$j->uid}, channel_uid:{$j->channelUid}, token:{$j->token}");
                    }
                }
                // 登录游戏服务器
                function game_login($player)
                {
                    if (!$GLOBALS['RES_VERSION'] or !$GLOBALS['CLIENT_VERSION']) {
                        report_error('登录失败: 获取客户端版本号失败');
                        return;
                    }
                    $deviceId = $player->get_device_id();
                    $deviceId2 = $player->get_device_id2();
                    $deviceId3 = $player->get_device_id3();
                    $uid = $player->get_uid();
                    $token = $player->get_token();
                    $data = json_encode(array('networkVersion' => $GLOBALS['NETWORK_VERSION'],
                        'uid' => $uid,
                        'token' => $token,
                        'assetsVersion' => $GLOBALS['RES_VERSION'],
                        'clientVersion' => $GLOBALS['CLIENT_VERSION'],
                        'platform' => $GLOBALS['PLATFORM'],
                        'deviceId' => $deviceId,
                        'deviceId2' => $deviceId2,
                        'deviceId3' => $deviceId3
                    ));
                    $res = post_to_gs('/account/login', $data, $player);
                    if ($res == 'error') {
                        report_error("登录失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if ($j->result or array_key_exists('error',$j)) {
                            report_error("登录失败: data={$data}, err_data={$res}");
                            return;
                        }
                        $player->set_secret($j->secret);
                        report_normal("<font color=\"#90EE90\">登录成功:</font> uid:{$player->get_uid()}, secret:{$j->secret}");
                    }
                }


                // 获取未完成订单
                function get_unconfirmed_orderid_list($player)
                {
                    $res = post_to_gs('/pay/getUnconfirmedOrderIdList', "{}", $player);
                    if ($res == 'error') {
                        report_error("获取未完成订单失败: 连接错误");
                    } else {
                        report_normal("<font color=\"#90EE90\">获取未完成订单成功:</font> uid:{$player->get_uid()}");
                    }
                }
                // 查询邮件(返回未读邮件id/type列表)
                function get_meta_info_list($player)
                {
                    $res = post_to_gs('/mail/getMetaInfoList', json_encode(array('from' => $player->get_local_time())), $player);
                    $unread_mail_list = array();
                    if ($res == 'error') {
                        report_error("获取邮件列表失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        $has_item = false;
                        foreach ($j->result as $mail) {
                            if ($mail->state == 0) {
                                array_push($unread_mail_list, array("mailId" => $mail->mailId, "type" => $mail->type));
                                if ($mail->hasItem) $has_item = true;
                            }
                        }
                        $length = (string)count($unread_mail_list);
                        $has_item_string = $has_item ? '是' : '否';
                        report_normal("<font color=\"#90EE90\">获取邮件列表成功:</font> uid:{$player->get_uid()}, 未读邮件数:{$length}, 是否有物品:{$has_item_string}");
                    }
                    return $unread_mail_list;
                }
                // 收邮件
                function recieve_mail($player, $mail_id, $mail_type)
                {
                    $data = json_encode(array('type' => $mail_type, 'mailId' => $mail_id));
                    $res = post_to_gs('/mail/receiveMail', $data, $player);
                    if ($res == 'error') {
                        report_error("邮件收取失败: 连接错误");
                    } else {
                        report_normal("<font color=\"#90EE90\">邮件收取成功:</font> uid:{$player->get_uid()}, 邮件id:{$mail_id}");
                    }
                }
                // 每日签到
                function checkin($player)
                {
                    $res = post_to_gs('/user/checkIn', "{}", $player);
                    if ($res == 'error') {
                        report_error("每日签到失败: 连接错误");
                    } else {
                        report_normal("<font color=\"#90EE90\">每日签到完成:</font> uid:{$player->get_uid()}");
                    }
                }
                // 活动签到
                function activity_checkin($player, $activity_id, $index)
                {
                    $data = json_encode(array('index' => $index, 'activityId' => $activity_id));
                    $res = post_to_gs('/activity/getActivityCheckInReward', $data, $player);
                    if ($res == 'error') {
                        report_error("活动签到失败: 连接错误");
                    } else {
                        report_normal("<font color=\"#90EE90\">活动签到完成:</font> uid:{$player->get_uid()}, 活动id:{$activity_id}, 当前签到次数:{$index}");
                    }
                }
                // 收取制造站产物
                function settle_manufacture($player)
                {
                    $room_slot_id_list = array();
                    foreach ($player->get_manufacture_room_slot() as $room) {
                        array_push($room_slot_id_list, $room['slot_id']);
                    }
                    $data = json_encode(array('roomSlotIdList' => $room_slot_id_list, 'supplement' => 1));
                    $res = post_to_gs('/building/settleManufacture', $data, $player);
                    if ($res == 'error') {
                        report_error("收取制造站产物失败: 连接错误");
                    } else {
                        report_normal("<font color=\"#90EE90\">收取制造站产物完成:</font> uid:{$player->get_uid()}");
                    }
                }
                // 结算贸易站订单
                function delivery_batch_order($player)
                {
                    $room_slot_id_list = array();
                    foreach ($player->get_trade_room_slot() as $room) {
                        array_push($room_slot_id_list, $room['slot_id']);
                    }
                    $data = json_encode(array('slotList' => $room_slot_id_list));
                    $res = post_to_gs('/building/deliveryBatchOrder', $data, $player);
                    if ($res == 'error') {
                        report_error("结算贸易站订单失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        $item_string = '';
                        $item_number = 0;
                        foreach ($j->delivered as $room) {
                            foreach ($room as $item) {
                                $item_number++;
                                $item_string .= "{$item->type}共{$item->count}个";
                            }
                        }
                        report_normal("<font color=\"#90EE90\">结算贸易站订单完成:</font> uid:{$player->get_uid()}, 获得物品数: {$item_number}, 获得物品数据: {$item_string}");
                    }
                }
                // 收取基建干员信赖
                function gain_all_intimacy($player)
                {
                    $res = post_to_gs('/building/gainAllIntimacy', "{}", $player);
                    if ($res == 'error') {
                        report_error("收取基建干员信赖失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        report_normal("<font color=\"#90EE90\">收取基建干员信赖完成:</font> uid:{$player->get_uid()}, 共计干员数: {$j->assist}, 共计信赖数: {$j->normal}");
                    }
                }
                // 领取信用
                function receive_social_point($player)
                {
                    $res = post_to_gs('/social/receiveSocialPoint', "{}", $player);
                    if ($res == 'error') {
                        report_error("领取信用失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        $social_number = 0;
                        foreach ($j->reward as $reward) {
                            if ($reward->id == "SOCIAL_PT") {
                                $social_number = $reward->count;
                            }
                        }
                        report_normal("<font color=\"#90EE90\">领取信用完成:</font> uid:{$player->get_uid()}, 获得信用数: {$social_number}");
                    }
                }
                // 同步信用
                function sync_social_point($player)
                {
                    $data = json_encode(array('platform' => $GLOBALS['PLATFORM']));
                    $res = post_to_gs('/account/syncData', $data, $player);
                    if ($res == 'error') {
                        report_error("同步信用错误: 连接错误");
                    } else {
                        $j = json_decode($res);
                        $player->set_social_point($j->user->status->socialPoint);
                        report_normal("<font color=\"#90EE90\">同步信用成功:</font> uid:{$player->get_uid()}, 信用数:{$j->user->status->socialPoint}");
                    }
                }
                // 自动兑换信用
                function auto_buy_social_good($player)
                {
                    $res = post_to_gs('/shop/getSocialGoodList', "{}", $player);
                    if ($res == 'error') {
                        report_error("自动消耗多余信用失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        $good_list = array();
                        $social_point = $player->get_social_point();
                        $inform = "";
                        foreach ($j->goodList as $good) {
                            array_push($good_list, array('name' => $good->displayName, 'price' => $good->price, 'count' => $good->item->count, 'goodId' => $good->goodId));
                        }
                        foreach ($good_list as $good) {
                            if ($social_point <= 300) break;
                            if (buy_social_good($player, $good['goodId']) == 'error') continue;
                            $social_point -= $good['price'];
                            $inform .= " {$good['name']}共{$good['count']}个 ";
                            usleep(300000);
                        }
                        report_normal("<font color=\"#90EE90\">自动消耗多余信用完成:</font> uid:{$player->get_uid()}, 获得物品: {$inform}");
                    }
                }
                // 购买信用商品
                function buy_social_good($player,$goodId)
                {
                    $res = post_to_gs('/shop/buySocialGood', "{\"goodId\":\"{$goodId}\",\"count\":1}", $player);
                    if ($res == 'error') {
                        report_error("自动消耗多余信用失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if (array_key_exists('error', $j) and array_key_exists('code', $j)) {
                            report_normal("<font color=\"red\">购买信用商品失败:</font> goodId={$goodId}, err_data={$res}");
                            return 'error';
                        }
                    }
                }

                // 自动按照理智设置基建助理干员
                function auto_set_assign_char($player)
                {
                    report_normal("<font color=\"#FFA500\">正在自动设置基建干员...</font>");
                    $lowAp_chars_list = array();
                    $free_chars_list = array();
                    foreach ($player->get_lowAp_chars_list() as $list) {
                        array_push($lowAp_chars_list, $list['index']);
                    }
                    foreach ($player->get_free_chars_list() as $list) {
                        array_push($free_chars_list, $list['index']);
                    }
                    $lowAp_chars_list = fill_room_with_chars($player, $player->get_dormitory_room_slot(), $lowAp_chars_list);
                    $free_chars_list = fill_room_with_chars($player, $player->get_manufacture_room_slot(), $free_chars_list);
                    $free_chars_list = fill_room_with_chars($player, $player->get_trade_room_slot(), $free_chars_list);
                    $free_chars_list = fill_room_with_chars($player, $player->get_control_room_slot(), $free_chars_list);
                    $free_chars_list = fill_room_with_chars($player, $player->get_power_room_slot(), $free_chars_list);
                    $free_chars_list = fill_room_with_chars($player, $player->get_hire_room_slot(), $free_chars_list);
                    $free_chars_list = fill_room_with_chars($player, $player->get_meeting_room_slot(), $free_chars_list);
                }
                function fill_room_with_chars($player,$room_list,$chars_list)
                {
                    foreach ($room_list as $room) {
                        if (count($chars_list) == 0) return $chars_list;
                        if (count($chars_list) < $room['count']) {
                            $list = $chars_list;
                            for ($i = 1; $i <= $room['count'] - count($chars_list); $i++) {
                                array_push($list, -1);
                            }
                            set_assign_char($player, $list, $room['slot_id']);
                        } else {
                            $count = $room['count'];
                            set_assign_char($player, array_slice($chars_list, 0, $count), $room['slot_id']);
                            array_splice($chars_list, 0, $count);
                        }
                        usleep(300000);
                    }
                    return $chars_list;
                }
                // 设置基建助理干员
                function set_assign_char($player,$char_list,$room_slot)
                {
                    $data = json_encode(array('charInstIdList' => $char_list, 'roomSlotId' => $room_slot));
                    $res = post_to_gs('/building/assignChar', $data, $player);
                    if ($res == 'error') {
                        report_error("设置基建助理干员失败: 连接错误");
                    }
                }
                // 自动领取可领取的任务
                function auto_get_mission_rewards($player)
                {
                    report_normal("<font color=\"#FFA500\">正在自动领取任务奖励...</font>");
                    confirm_mission($player, "daily_4312");
                    usleep(100000);
                    confirm_mission($player, "daily_4313");
                    usleep(100000);
                    confirm_mission($player, "daily_4316");
                    usleep(100000);
                    exchange_mission_rewards($player, "reward_daily_397");
                    usleep(100000);
                    confirm_mission($player, "daily_4317");
                    usleep(100000);
                    confirm_mission($player, "daily_4318");
                    usleep(100000);
                    exchange_mission_rewards($player, "reward_daily_398");
                    usleep(100000);
                    confirm_mission($player, "daily_4319");
                }
                // 提交任务完成
                function confirm_mission($player,$mission_id)
                {
                    $res = post_to_gs('/mission/confirmMission', json_encode(array('missionId' => $mission_id)), $player);
                    if ($res == 'error') {
                        report_error("提交任务完成失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if (array_key_exists('code',$j)){
                            if ($j->code == 5657) {
                                report_normal("<font color=\"#FFA500\">任务完成已经提交:</font> mission_id:{$mission_id}");
                            }
                        }
                    }
                }
                // 获取任务奖励
                function exchange_mission_rewards($player,$target_rewards_id)
                {
                    $res = post_to_gs('/mission/exchangeMissionRewards', json_encode(array('targetRewardsId' => $target_rewards_id)), $player);
                    if ($res == 'error') {
                        report_error("获取任务奖励失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if (array_key_exists('code',$j)) {
                            if ($j->code == 5536) {
                                report_normal("<font color=\"#FFA500\">任务奖励已经领取:</font> target_rewards_id:{$target_rewards_id}");
                                return;
                            }
                        }
                        if (array_key_exists('items',$j)) {
                            if (count($j->items) == 0) {
                                return;
                            }
                            $inform = "";
                            foreach ($j->items as $item) {
                                $inform .= "{$item->type}共{$item->count}个";
                            }
                            report_normal("<font color=\"#90EE90\">获取任务奖励完成:</font> uid:{$player->get_uid()}, 获得物品: {$inform}");
                        }
                    }
                }

                function get_from_conf($addr,$retry=3, $sleep = 1)
                {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $addr,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_HTTPHEADER => $GLOBALS['COMMON_HEADER'],
                    ));
                    $output = false;
                    while (($output === false) && ($retry--)) {
                        sleep($sleep);
                        $output = curl_exec($curl);
                    }
                    if ($output === false) $output = 'error';
                    curl_close($curl);
                    return $output;
                }
                function post_to_as($cgi, $data,$retry=3, $sleep = 1)
                {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $GLOBALS['HOST_AUTH_SERVER'] . $cgi,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_HTTPHEADER => $GLOBALS['COMMON_HEADER'],
                    ));
                    $output = curl_exec($curl);
                    while (($output === false) && ($retry--)) {
                        sleep($sleep);
                        $output = curl_exec($curl);
                    }
                    curl_close($curl);
                    if ($output === false) $output = 'error';
                    return $output;
                }
                function post_to_gs($cgi, $data,$player,$retry=3, $sleep = 1)
                {
                    $curl = curl_init();

                    $headder_ex = array('uid: ' . $player->get_uid(), 'secret: ' . $player->get_secret(), 'seqnum: ' . $player->get_seq());

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $GLOBALS['HOST_GAME_SERVER'] . $cgi,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HEADER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_HTTPHEADER => array_merge($GLOBALS['COMMON_HEADER'], $headder_ex),
                    ));
                    $output = curl_exec($curl);
                    while (($output === false) && ($retry--)) {
                        sleep($sleep);
                        $output = curl_exec($curl);
                    }
                    curl_close($curl);
                    if ($output === false) {
                        return 'error';
                    }
                    list($hederStr, $contentStr) = explode("\r\n\r\n", $output, 2);
                    // 更新封包编号
                    if (preg_match('/(?<=Seqnum:.)\d+/', $hederStr, $seqnum)) {
                        $player->set_seq((int)$seqnum[0]);
                    } else {
                        $player->set_seq($player->get_seq() + 1);
                    }
                    return $contentStr;
                }
                function post_to_passport($cgi, $data,$retry=3, $sleep = 1)
                {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $GLOBALS['HOST_PASSPORT_SERVER'] . $cgi,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_HTTPHEADER => $GLOBALS['PASSPORT_HEADER'],
                    ));
                    $output = curl_exec($curl);
                    while (($output === false) && ($retry--)) {
                        sleep($sleep);
                        $output = curl_exec($curl);
                    }
                    curl_close($curl);
                    if ($output === false) $output = 'error';
                    return $output;
                }
                // 国际服_发送邮箱验证码
                function yostar_auth_request($email){
                    $res = post_to_passport('/account/yostar_auth_request', http_build_query(array('platform' => 'android','account' => $email)));
                    if ($res == 'error') {
                        report_error("发送邮箱验证码失败: 连接错误");
                    }
                }
                // 国际服_提交邮箱验证码
                function yostar_auth_submit($player,$email,$code){
                    $res = post_to_passport('/account/yostar_auth_submit', http_build_query(array('account' => $email,'code' => $code)));
                    if ($res == 'error') {
                        report_error("提交邮箱验证码失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if ($j->result) {
                            if ($j->result=50016){report_error("邮箱验证码登录失败: 验证码错误");}
                            report_error("邮箱验证码登录失败: err_data={$res}");
                            return;
                        } else {
                            $player->set_yostar_account($j->yostar_account);
                            $player->set_yostar_channel_token($j->yostar_token);
                            $player->set_yostar_uid($j->yostar_uid);
                            report_normal("<font color=\"#90EE90\">邮箱验证码登录成功:</font> yostar_uid:{$j->yostar_uid}");
                        }
                    }
                }
                // 国际服_创建邮箱验证码登录
                function yostar_createlogin($player){
                    $res = post_to_passport('/user/yostar_createlogin', "yostar_token={$player->get_yostar_channel_token()}&deviceId={$player->get_device_id()}&channelId=googleplay&yostar_uid={$player->get_yostar_uid()}&createNew=0&yostar_username={$player->get_yostar_account()}");
                    if ($res == 'error') {
                        report_error("创建邮箱验证码登录失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if ($j->result) {
                            report_error("创建邮箱验证码登录失败: err_data={$res}");
                            return;
                        } else {
                            $player->set_yostar_login_token(base64_encode("uid={$j->uid}&token={$j->token}"));
                            if (!empty($_POST['keepCookies'])) {
                                if ($_POST['keepCookies'] == 'true') {
                                    setcookie('LAST_LOGIN_YOSTAR_LOGIN_TOKEN', base64_encode("uid={$j->token}&token={$j->token}"), time() + 3600 * 24 * 30 * 12);
                                    setcookie('LAST_LOGIN_SERVER',$_POST['server'],time() + 3600 * 24 * 30 * 12);
                                }
                            }
                            $player->set_yostar_token($j->token);
                            $player->set_channel_uid($j->uid);
                            report_normal("<font color=\"#90EE90\">邮箱验证码登录成功:</font> uid:{$j->uid}");
                        }
                    }
                }
                // 国际服_邮箱验证码登录
                function yostar_login($player){
                    $res = post_to_passport('/user/login', http_build_query(array(
                        'platform' => 'android',
                        'uid' => $player->get_channel_uid(),
                        'token' => $player->get_yostar_token(),
                        'deviceId' => $player->get_device_id()
                    )));
                    if ($res == 'error') {
                        report_error("邮箱验证码登录失败: 连接错误");
                    } else {
                        $j = json_decode($res);
                        if ($j->result) {
                            report_error("邮箱验证码登录失败: err_data={$res}");
                            return;
                        } else {
                            $player->set_access_token($j->accessToken);
                            if (!empty($_COOKIE['LAST_LOGIN_YOSTAR_LOGIN_TOKEN']) or !empty($_POST['yostarLoginToken'])) {
                                report_normal("<font color=\"#90EE90\">Yostar Login Token登录成功:</font> deviceId:{$player->get_device_id()}, channel_uid:{$j->yostar_uid}, yostar_login_token:{$player->get_yostar_login_token()}");
                            } else {
                                report_normal("<font color=\"#90EE90\">账号密码登录成功:</font> 账号:{$player->get_yostar_account()}, deviceId:{$player->get_device_id()}, channel_uid:{$j->yostar_uid}, yostar_login_token:{$player->get_yostar_login_token()}");
                            }
                        }
                    }
                }
                // 发送短信验证码
                function send_sms_code($account)
                {
                    $sign = u8_sign("account={$account}&type=1");
                    $data = json_encode(array('account' => $account, 'type' => 1, 'sign' => $sign));
                    $res = post_to_as('/user/sendSmsCode', $data);
                    if ($res == 'error') {
                        report_error("发送短信验证码失败: 连接错误");
                    }
                }

                // u8登录签名: 登录json参数按key从小到大排序;使用&连接;使用HMAC-SHA1算法
                function u8_sign($data){return hash_hmac("sha1", $data,$GLOBALS['HMAC_KEY']);}
                // 生成随机device_id
                function get_random_device_id(){return md5(get_random_string(12));}
                // 生成随机device_id2
                function get_random_device_id2(){return '86'.get_random_digits(13);}
                // 生成随机device_id3
                function get_random_device_id3(){return md5(get_random_string(12));}
                function report_normal($str)
                {
                    echo "[".time()."] ".$str ."<br>";
                }
                function report_error($str)
                {
                    echo "[".time()."] <font color=\"#FF0000\">".$str."<br></font>";
                    exit("<br>" . "中止程序");
                }
                function get_random_string($length)
                {
                    $str = array_merge(range(0, 9), range('a', 'f'));
                    shuffle($str);
                    $str = implode('', array_slice($str, 0, $length));
                    return $str;
                }
                function get_random_digits($length)
                {
                    $str = '';
                    for ($i = 1; $i < $length; $i++) {
                        $randcode = mt_rand(0, 9);
                        $str .= $randcode;
                    }
                    return $str;
                }
                ?>
            </console>
        </div>
    </div>
</div>
</body>
</html>