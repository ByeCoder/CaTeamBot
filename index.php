
<?php
ini_set('max_execution_time', 900);
set_time_limit(0);
ini_set("error_logs","off");
$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], 
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    
];
$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
$lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
$upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;
}
// file_put_contents("log.txt",$_SERVER['REMOTE_ADDR']);
if(!$ok) die("FUCK YOU :/");
include_once('Net/SSH2.php');
file_get_contents("php://input");
//error_reporting(0);
$admins = array(218722292,259080779);
$seclist = array(246212075,218722292,259080779);
define('CABOT','BOTTOKEN');
$realm = -1001218032533;
$tablighatigp = "-1001418733858";
$persiangp = "-1001275821745";
function jwt_request($token) {
      $url = "https://api.hetzner.cloud/v1/servers?page=1&per_page=50";
       $ch = curl_init(); // Initialise cURL
        curl_setopt($ch, CURLOPT_URL, $url);
       $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POST, 0); // Specify the request method as POST
       $result = curl_exec($ch); // Execute the cURL statement
       curl_close($ch); // Close the cURL connection
       return json_decode($result,true); // Return the received data
    }
function connectserver($spre,$userpre,$passpre,$chatc){
         $ssh = new Net_SSH2($spre);
     $ssh->setTimeout(60);
if (!$ssh->login($userpre, $passpre)) {
    sendinline($chatc, "🚫مشکلی در اتصال به سرور $spre پیش آمد\nاین مشکل به دلیل عدم اتصال میباشد\nمشکل میتواند از ایپی یا رمز یا یوزر یا حتی خاموشی سرور باشد", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$spre"]]]);
    exit('Login Failed');
}
return $ssh;
}
function jwt_request2($token,$page,$perpage) {
       $url = "https://api.hetzner.cloud/v1/servers?page=$page&per_page=$perpage";
       $ch = curl_init(); // Initialise cURL
        curl_setopt($ch, CURLOPT_URL, $url);
       $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POST, 0); // Specify the request method as POST
       $result = curl_exec($ch); // Execute the cURL statement
       curl_close($ch); // Close the cURL connection
       return json_decode($result,true); // Return the received data
    }
    
    function senddoc($method,$chatid,$caption){
$url = "https://api.telegram.org/bot".CABOT."/sendDocument";
$uploadfile = $method;
$document = new CURLFile($uploadfile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ["chat_id" => "$chatid", "document" => $document, "caption" => $caption]);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$out = curl_exec($ch);
curl_close($ch);
}
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".CABOT."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
  
    if(curl_error($ch)){var_dump(curl_error($ch));}else{ return json_decode($res);  }}
$update = json_decode(file_get_contents('php://input')); //ساختمان ربات
$message_id = $update->message->message_id;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$text = $update->message->text;
$message = $update->message;
if (isset($message->chat->id)) {
$chat_id = $message->chat->id;
}elseif(isset($update->callback_query->message->chat->id)) {
$chat_id = $update->callback_query->message->chat->id;
}
if (isset($message->chat->id)) {
$chatid = $message->chat->id;
}elseif(isset($update->callback_query->message->chat->id)) {
$chatid = $update->callback_query->message->chat->id;
}
$from_id = $chat_id;
$data = $update->callback_query->data;
$message_id2 = $update->callback_query->message->message_id;
    if(is_dir("data/$from_id")){
        if(file_exists("data/$from_id/step.txt")){
$step = file_get_contents("data/$from_id/step.txt");
}
$vip38 =  file_get_contents("data/vipg.txt");
    if(file_exists("data/$from_id/license.txt")){
$lic38 = file_get_contents("data/$from_id/license.txt");
}
    if(file_exists("data/$from_id/ippre.txt")){
$ippre = file_get_contents("data/$from_id/ippre.txt");
}
    if(file_exists("data/$from_id/serverpre.txt")){
$serverpre = file_get_contents("data/$from_id/serverpre.txt");
}
    if(file_exists("data/$from_id/verify.txt")){
$verify = file_get_contents("data/$from_id/verify.txt");
}
    if(file_exists("data/locallicense.txt")){
$localversions = file_get_contents("data/locallicense.txt");
}else{
    $localversions = "500";
}

    if(file_exists("data/$from_id/email.txt")){
$email = file_get_contents("data/$from_id/email.txt");
}
    if(file_exists("data/$from_id/phone.txt")){
$phone = file_get_contents("data/$from_id/phone.txt");
}
    if(file_exists("data/$from_id/money.txt")){
$money = file_get_contents("data/$from_id/money.txt");
}else{
 $money = 0;
}
    if(file_exists("list/license/$lic38/topay.txt")){
$topay = file_get_contents("list/license/$lic38/topay.txt");
$topaytime = file_get_contents("list/license/$lic38/topayt.txt");
$endversion = file_get_contents("list/license/$lic38/endversion.txt");
}else{
 $topay = 0;
 $topaytime = "0";
 $endversion = "500";
}
    if(file_exists("data/$from_id/limit.txt")){
$limit = file_get_contents("data/$from_id/limit.txt");
}else{
 $limit = 1;
}
}
$textmessage = isset($update->message->text)?$update->message->text:'';
$rpto = $update->message->reply_to_message->forward_from->id;
$stickerid = $update->message->reply_to_message->sticker->file_id;
$photo = $update->message->photo;
$video = $update->message->video;
$sticker = $update->message->sticker;
$files = $message->document;
$file_id = $message->document->file_id;
$music = $update->message->audio;
$voice = $update->message->voice;
$forward = $update->message->forward_from;
$inline = $update->inline_query;
$query = $inline->query;
$inlineid = $inline->id;
$callback = $update->callback_query->data;
$callbackid = $update->callback_query->inline_message_id;
$chatidq = $update->callback_query->from->id;
$inline_message_id2 = $update->callback_query->id;
$inline_message_id = $update->callback_query->message->message_id;
$chat_id_callback = $update->callback_query->from->id;
$file = $message->document;
$file_size = $message->document->file_size;
$dataq = $update->callback_query->data;
$vipkey = [[['text'=>"📤ارسال ایپی",'callback_data'=>"sendip"],['text'=>"📋مشاهده اطلاعات",'callback_data'=>"seeinformation"]],[['text'=>"🖥عملیات تبلیغاتی",'callback_data'=>"serverpro"],['text'=>"📲عملیات سورس",'callback_data'=>"sourcepro"]],[['text'=>"🌐هوش مصنوعی",'callback_data'=>"intelga"],['text'=>"📊مدیریت ایپی ها",'callback_data'=>"manageips"]],[['text'=>"💰افزایش موجودی",'callback_data'=>"paytop"]],[['text'=>"📚قوانین تیم",'callback_data'=>"rouls"],['text'=>"📨تماس با ما",'callback_data'=>"contactus"]]];
$keyserver = [[['text'=>"⚙️مدیریت و فعالیت ها",'callback_data'=>"specialserver"]],[['text'=>"➕افزودن سرور",'callback_data'=>"addserver"],['text'=>"➖حذف سرور",'callback_data'=>"remserver"]],[['text'=>"🔑تغییر رمز سرور(رمز وارد شده)",'callback_data'=>"changepass"]],[['text'=>"🎚مدیریت نشست فعال",'callback_data'=>"activesession"]],[['text'=>"↩️بازگشت",'callback_data'=>"home"]]];
$asessionkey = [[['text'=>"🛠تعیین پلتفرم",'callback_data'=>"platformch"]],[['text'=>"🖥مدل دستگاه",'callback_data'=>"devmodelch"],['text'=>"⚙️ورژن سیستم",'callback_data'=>"sysversionch"]],[['text'=>"🛬زبان سیستم",'callback_data'=>"syslangch"],['text'=>"📟ورژن اپلیکیشن",'callback_data'=>"appversionch"]],[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]],];
$advserver = [[['text'=>"📲نصب سورس",'callback_data'=>"installsource"],['text'=>"▶️اتولانچ",'callback_data'=>"autolaunch"],['text'=>"📤پاکسازی کش",'callback_data'=>"clearcache"]],[['text'=>"🤖ساخت ربات",'callback_data'=>"createbot"],['text'=>"🚫حذف ربات",'callback_data'=>"rembot"]],[['text'=>"♻️ریبوت",'callback_data'=>"reboot"],['text'=>"🔻توقف پردازش",'callback_data'=>"stopproce"],['text'=>"⛔️پاکسازی سرور",'callback_data'=>"cleaerserver"]],[['text'=>"👑افزودن سودو",'callback_data'=>"addsudo"],['text'=>"💾بکاپ فایل ها",'callback_data'=>"backupfiles"],['text'=>"🔄ریستور بکاپ",'callback_data'=>"restorebackup"]],[['text'=>"🤴افزودن سودو کلی",'callback_data'=>"addallsudo"],['text'=>"🗑حذف کل ربات ها",'callback_data'=>"clearbots"]],[['text'=>"📟اجرا دستورات از طریق SSH",'callback_data'=>"execcom"],['text'=>"🔎ربات های سرور",'callback_data'=>"botserver"]],[['text'=>"↗️بازگشت",'callback_data'=>"serverpro"]]];
$inetligance = [[['text'=>"🔍مشاهده متون تصادفی",'callback_data'=>"seerandomintel"],['text'=>"🧹پاکسازی متون تصادفی",'callback_data'=>"cleanrandomintel"]],[['text'=>"📑افزایش متون تصادفی",'callback_data'=>"addrandomintel"]],[['text'=>"📈افزایش دامنه لغات",'callback_data'=>"adddomainintel"]],[['text'=>"♾افزایش متون غیره",'callback_data'=>"addotherintel"]],[['text'=>"↩️بازگشت",'callback_data'=>"home"]]];
$ipmanagement = [[['text'=>"✅فعال سازی ایپی",'callback_data'=>"activeip"],['text'=>"🚫حذف ایپی",'callback_data'=>"remips"]],[['text'=>"↩️بازگشت",'callback_data'=>"home"]]];
$adminkeys = [[['text'=>"🥇افزودن کاربر"],['text'=>"🥉حذف کاربر"]],[['text'=>"📤افزودن ایپی"],['text'=>"📥حذف ایپی"]],[['text'=>"📈لایسنس جدید"],['text'=>"📉حذف لایسنس"]],[['text'=>"📝تعیین محدوده ایپی"],['text'=>"💵تعیین موجودی"]],[['text'=>"🗑حذف محدودیت کلی سرور"],['text'=>"🔖حذف محدودیت سرور"]],[['text'=>"⬅️فور همگانی"],['text'=>"⬆️ارسال همگانی"]],[['text'=>"♻️بررسی لایسنس"],['text'=>"💶تنظیم بدهکاری"]],[['text'=>"🚀تنظیم ورژن فعلی"]],[['text'=>"↩️بازگشت"]]];
if($from_id != "" and strpos($from_id,"-") === false and !isset($dataq) and !isset($data)){
$forchaneel = json_decode(file_get_contents("https://api.telegram.org/bot".CABOT."/getChatMember?chat_id=@the_CA&user_id=".$from_id));
$tch = $forchaneel->result->status;
}
$admin = 218722292;
function EditMsg($msgid, $text, $keyboard = null){
    bot('EditMessageText', [
    'inline_message_id'=>$msgid,
    'text'=>$text,
    'reply_markup'=>$keyboard
    ]);
}
function sendinline($chatid, $text, $keyboard = null){
 bot('sendMessage',[
  'chat_id'=>$chatid,
  'text'=>$text,
 'parse_mode'=>"html",
            'reply_markup' => json_encode([
'inline_keyboard' =>$keyboard])
        ]);
}
function editinline($chatid, $message_id2,$text, $keyboard = null){
     bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "درحال ارتباط با سرور",
            'show_alert' => false
        ]);
        bot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $message_id2,
            'text' => $text,
            'parse_mode' => "html",
            'reply_markup' => json_encode([
                'inline_keyboard' => $keyboard,
            ])
        ]);
}
function sendMessage($chat_id, $text){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'HTML',
'resize_keyboard'=>true
]);
}
function Forward($chat_id,$from_id,$massege_id){
bot('ForwardMessage',[
'chat_id'=>$chat_id,
'from_chat_id'=>$from_id,
'message_id'=>$massege_id
]);
}
function Send_Message($ChatId, $TextMsg)
{
 bot('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
function SendSticker($ChatId, $sticker_ID)
{
 bot('sendSticker',[
'chat_id'=>$ChatId,
'sticker'=>$sticker_ID
]);
}
function deleteMessage($chat_id,$message_id){
	bot('deleteMessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id
	]);
}
function save($filename,$TXTdata)
	{
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
if(($callback)){
	if($dataq == "fwdbch"){
	$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "✅راهنما فوروارد و ارسال پیام

⚠️ نکته : درهربار استفاده تا اتمام کار صبرنمایید و بعد از اتمام مجدد اقدام به زدن دستور نمایید.
〰️〰️〰️〰️〰️
🔶 دستورات (فوروارد)
🔰فوروارد به صورت دستی.
🔹با ریپلای روی بنر دلخواه،بنر به مقصد انتخاب شده با تاخیر تعیین شده بین هرچت فوروارد به تعداد مشخص چت میشود.

🔺En: fwd [all|sgpgp|sgp|gp|pv] [delay] [nums
🔻Fa: فوروارد {همه|سوپرگروه و گروه|سوپرگروه|گروه|خصوصی} {تاخیر} {تعداد

🔸خاموش کردن فوروارد دستی.
🔺En: fwd off
🔻Fa : فوروارد خاموش
〰️〰️〰️〰️〰️
🔰دستورات (فوروارد خوکار)
⚠️فعال سازی فورارد خودکار.
🔷روشن و خاموش کردن فوروارد خودکار و ارسال بنر.

🔺En: fwdauto [on|off]
🔻Fa: فوروارد خودکار روشن|خاموش
〰️〰️〰️〰️〰️
🔶تنظیم مقصد فوروارد خودکار به مقصد انتخابی برای ارسال بنر.

🔺En: fwdtype [all|sgpgp|sgp|gp|pv]
🔻Fa: نوع فوروارد {همه|سوپرگروه و گروه|سوپرگروه|گروه|خصوصی}
〰️〰️〰️〰️〰️

🔷تنظیم زمان فوروارد خودکار
⚠️تنظیم زمان فوروارد خودکار برای تاخیر بین هر سری فوروارد.
🔺En: fwdtime [time]
🔻Fa: زمان فوروارد خودکار  زمان
〰️〰️〰️〰️〰️
🔶حذف زمان تنظیم شده فوروارد خودکار.
⚠️حذف زمان فوروارد خودکار بین هر سری فوروارد و تنظیم زمان پیشفرض فوروارد.

🔺En: deltimefwd
🔻Fa: حذف زمان فوروارد خودکار
〰️〰️〰️〰️〰️

🔷تنظیم تعداد فوروارد.
⚠️تنظیم تعداد مقصد برای فوروارد خودکار.
🔺En: fwdnum [num]
🔻Fa : تعداد فوروارد تعداد
〰️〰️〰️〰️〰️

🔶تنظیم و اضافه کردن بنر به لیست.
⚠️با ریپلای روی بنر آن را به لیست فوروارد اضافه میکند.
🔺En: addfwd
🔻Fa: افزودن خودکار
〰️〰️〰️〰️〰️


🔷حذف بنر از لیست خودکار.
⚠️با ریپلای روی بنر آن را از لیست فوروارد حذف میکند.
🔺En: delfwd
🔻Fa: حذف خودکار
〰️〰️〰️〰️〰️

🔶مشاهده لیست فوروارد خودکار.
⚠️نمایش لیست بنرهای موجود در لیست فوروارد.
🔺En: fwdlist
🔻Fa: لیست فوروارد
〰️〰️〰️〰️〰️

🔷پاکسازی لیست فوروارد خودکار.
⚠️پاکسازی کل بنرهای موجود در لیست فوروارد.

🔺En: clean fwd
🔻Fa: پاکسازی لیست فوروارد
〰️〰️〰️〰️〰️
🔶تنظیم فوروارد و خروج.
⚠️روشن یا خاموش کردن فوروارد و خروج از گروه , این یک قابلیت جدا میباشد و همزمان با فوروارد خودکار روشن نشود.

🔺En: fwdleft [on|off]
🔻Fa: فوروارد و خروج روشن|خاموش
〰️〰️〰️〰️〰️
🔰ارسال پیام به صورت دستی.
⚠️با ریپلای روی بنر دلخواه،بنر به مقصد انتخاب شده با تاخیر تعیین شده بین هرچت با تعداد مشخص چت ارسال میشود.
🔺En: bc [all|sgpgp|sgp|gp|pv] [delay] [nums]
🔻Fa: ارسال {همه|سوپرگروه و گروه|سوپرگروه|گروه|خصوصی} {تاخیر} {تعداد
〰️〰️〰️〰️〰️
🔷ریپلای روی بنر .
⚠️ریپلای روی بنر ارسالی پس از فوروارد.
🔺En: replybanner [on|off]
🔻Fa: ریپلای بنر روشن|خاموش
〰️〰️〰️〰️〰️", $back);
		}elseif($dataq == "lefth"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "🔰راهنما دستورات خروج

🔶خروج از گروه ها .
⚠️خروج از گروه های محدود شده
🔺En: restricleft [on|off]
🔻Fa: خروج محدود روشن|خاموش
〰️〰️〰️〰️〰️
🔷خروج خودکار از گروه ها.
⚠️خروج خودکار با تاخیر از تمامی گروه ها
🔺En: autoleave [on|off]
🔻Fa: خروج خودکار روشن|خاموش
〰️〰️〰️〰️〰️
🔶خروج از تمامی گروه ها
⚠️خروج از کلیه گروه ها ربات با زمان پیشفرض ( عدد 150 نشان دهنده تعداد گروه ها است اگر میخواهید از تمامی گروه ها خارج شود عدد نگذارید).
🔺En: leftall 150
🔻Fa: خروج از همه 150
〰️〰️〰️〰️〰️
🔷خروج ربات
⚠️خروج ربات از گروه فعلی(ازگروه مادر خارج نمیشود)

🔺En: left
🔻Fa: خروج
〰️〰️〰️〰️〰️
🔶تنظیم زمان خروج از گروه .
⚠️زمان خروج پس از عضویت در گروه(برحسب ساعت)
🔺En: autotimer [num|off]
🔻Fa: تایمر خودکار عدد|خاموش
〰️〰️〰️〰️〰️
🔷خروج از گروه تکی.
⚠️خروج تکی گروه ها با تاخیر تعیین شده(برحسب دقیقه).
🔺En: sololeft [num|off]
🔻Fa: خروج تکی عدد|خاموش
〰️〰️〰️〰️〰️
🔶تنظیم متن خروج تکی.
⚠️تنظیم متن خروجی که قبل از خروج از گروه ارسال شود.

🔺En: sololefttext [TEXT]
🔻Fa: متن خروج تکی  متن
〰️〰️〰️〰️〰️
🔷خروج از گروه معمولی.
⚠️ خروج از گروه های معمولی به محض اد شدن.
🔺En: gpleft [on|off]
🔻Fa: خروج گروه روشن|خاموش
〰️〰️〰️〰️〰️", $back);
		}elseif($dataq == "adminateh"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "✅راهنما مدیریتی 

🔰برسی لینک ها دریافتی.
⚠️برسی لینک ها (اسم - سالم و خرابی لینک )
🔺En: oklink on/off
🔻Fa:  تاییدلینک روشن | خاموش
〰️〰️〰️〰️〰️
🔶 عضویت خودکار در گروه .
⚠️عضویت در لینک ها به صورت خودکار زمان عضویت پیشفرض
🔺En: join on|off
🔻Fa: عضویت روشن | خاموش
〰️〰️〰️〰️〰️
🔷همگام سازی لینک
⚠️همگام سازی لینک به صورت (یونیک)

🔺En: synclink [on|off]
🔻Fa: همگام سازی لینک روشن|خاموش
〰️〰️〰️〰️〰️
🔶دریافت لینک به صورت حرفه ای.
⚠️ دریافت لینک از همه(اینلاین-کپشن-عادی) یا سودو

🔺En: prolink [sudo|all|off]
🔻Fa: دریافت لینک حرفه ای سودو|همه|خاموش
〰️〰️〰️〰️〰️
🔶ذخیره شماره (مخاطب)
⚠️ ذخیره شماره افراد (پیوی - گروه).
🔺En: savenumber [on|off]
🔻Fa: ذخیره شماره روشن|خاموش
〰️〰️〰️〰️〰️
🔷اشتراک شماره با افراد
⚠️اشتراک شماره پس از ذخیره.
🔺En: sharenumber [on|off]
🔻Fa: اشتراک شماره روشن|خاموش
〰️〰️〰️〰️〰️
🔶 اعلانات تلگرام
⚠️دریافت اعلانات تلگرام(پایان نشست جدید در صورت ورود).
🔺En: telegramnot [on|off]
🔻Fa: علانات روشن|خاموش
〰️〰️〰️〰️〰️
🔷دریافت  اموجی
⚠️دریافت کد ایموجی بجای کدتلگرام.
🔺En: emojicode [on|off]
🔻Fa: ایموجی کد روشن|خاموش
〰️〰️〰️〰️〰️
🔶حالت تایپینگ
⚠️وضعیت نوشتن ربات.
🔺En: typing [on|off]
🔻Fa: نوشتن روشن|خاموش
〰️〰️〰️〰️〰️
🔰هوش مصنوعی گروه.
⚠️چت در گروه بدون محدودیت (ریپورتی).
🔺En: cleverchat on|off
🔻Fa: هوش گروه روشن|خاموش
〰️〰️〰️〰️〰️
🔷هوش مصنوعی پیوی.
⚠️چت درخصوصی بدون محدودیت (ریپورتی)
🔺En: cleverpv on|off
🔻Fa: هوش خصوصی روشن|خاموش
〰️〰️〰️〰️〰️
🔶هوش مصنوعی ممبر.
⚠️جمع آوری ممبر به صورت حرفه ای و دور زدن آنتی اسپم ها.
🔺En: clevermem on|off
🔻Fa: هوش ممبر روشن|خاموش
〰️〰️〰️〰️〰️
🔷عضویت در گروه مشابه.
⚠️عضویت در گروه های مشابه در یک سرور.
🔺En: samegp on|off
🔻Fa: گروه مشابه روشن|خاموش
〰️〰️〰️〰️〰️
🔶ذخیره خودکارمخاطب
⚠️ذخیره خودکار مخاطبین بدون شماره.
🔺En:  autosave on|off
🔻Fa: ذخیره خودکار روشن|خاموش
نیازمنده روشن بودن ذخیره شماره
〰️〰️〰️〰️〰️
🔷اولین پیام در خصوصی
⚠️تنظیم اولین پیام در خصوصی(روی پیام مورد نظر ریپلی کنید.)
🔺En: firstpm {reply}
🔻Fn: اولین پیام ریپلای
〰️〰️〰️〰️〰️
🔶بروزرسانی ربات به صورت خودکار
⚠️بروزرسانی خودکار آمار ربات هر 24 ساعت.

🔺En: autoupdate [on|off]
🔻Fa: بروزرسانی خودکار روشن|خاموش
〰️〰️〰️〰️〰️
🔷بروزرسانی سورس کد
⚠️بررسی و آپدیت سورس به آخرین نسخه در صورت موجود بودن آپدیت
🔺En: updatesource
🔻Fa: بروزرسانی سورس
〰️〰️〰️〰️〰️
🔶پروکسی
⚠️فعالسازی وضعیت اتصال به پروکسی.
🔺En: proxy [on|off]
🔻Fa: پروکسی روشن|خاموش
〰️〰️〰️〰️〰️
🔷پروکسی (ساکس 5)
⚠️افزودن یک پروکسی دلخواه و فعال سازی آن (توجه شود درصورت نداشتن پسورد و یوزرنیم بجای آنها 0 قرار دهید).
🔺En: addproxy [IP] [Port] [Username|0] [Password|0]
🔻Fa: پروکسی {ایپی} {پورت} {یوزرنیم|0} {پسورد|0
〰️〰️〰️〰️〰️
🔶تنظیمات خوشامدگویی.
⚠️بازشدن منوی تنظیم خوش امدگویی پس از عضویت در گروه(v1).

🔺En: hellosetup
🔻Fa: تنظیمات خوش امدگویی
〰️〰️〰️〰️〰️", $back);			
		}elseif($dataq == "specialh"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "🔰راهنما دستورات خاص
❌احتیاط لازم جهت زدن دستورات.

🔶پاکسازی کل سرور (خام شدن سرور)
⚠️پاکسازی کل دیتاها و دیتابیس محلی و افزودن آیدی سودو.
🔺En: resetnet
🔻Fa: نابودسازی
〰️〰️〰️〰️〰️
🔷پاکسازی sql
⚠️پاکسازی فایل دیتابیس و دیتای محلی ربات.
🔺En: clearsql
🔻Fa: پاکسازی اس کیو ال
〰️〰️〰️〰️〰️
🔶پاکسازی دیتابیس یک ربات.
⚠️پاکسازی کل دیتاها و دیتابیس محلی و افزودن ایدی سودو.
🔺En: cleardatabase [id]
🔻Fa: پاکسازی دیتابیس ایدی
〰️〰️〰️〰️〰️
🔷تنظیم زمان عضویت در گروه.
⚠️تنظیم زمان عضویت ربات(پیشفرض بهترین حالت است)
🔺En: setdelayjoin [num]
🔻Fa: تاخیر عضویت عدد
〰️〰️〰️〰️〰️
🔶اتولانچ کردن ربات ها.
⚠️جرای مجدد کل ربات های روی سرور.
🔺En: autolaunch
🔻Fn: اتولانچ
〰️〰️〰️〰️〰️", $back);			
		}elseif($dataq == "fjoinh"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "✅راهنما دستورات عضویت اجباری

🔰فعالسازیعضویت اجباری.
⚠️عضویت اجباری در کانال برای مخاطبین.
🔺En: fjoin [on|off]
🔻Fa: عضویت اجباری روشن|خاموش
〰️〰️〰️〰️〰️
🔷تنظیم کانال .
⚠️تنظیم کردن کانال خود جهت عضویت اجباری(حتما ربات را در کانال ادمین کنید).

🔺En: fjoinchat [@user]
🔻Fa: چت عضویت اجباری آیدی چنل
〰️〰️〰️〰️〰️
🔶پاکسازی کانال .
⚠️پاکسازی لیست کانال های تنظیم شده.
🔺En: clean fjoin
🔻Fa: پاکسازی لیست عضویت اجباری
〰️〰️〰️〰️〰️
🔶تنظیم متن .
⚠️تنظیم کردن متن عضویت اجباری.
🔺En: addfjoin [Text]
🔻Fa: افزودن عضویت اجباری متن
〰️〰️〰️〰️〰️
🔷حذف متن .
⚠️حذف کردن متن تنظیم شده عضویت اجباری.
🔺En: remfjoin [Text]
🔻Fa: حذف عضویت اجباری متن
〰️〰️〰️〰️〰️", $back);			
		}elseif($dataq == "displayh"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "🔰راهنما تنظیمات ظاهری ربات.

🔷تنظیم نام برای ربات.
🔺En: setname [TEXT]
🔻Fa: تنظیم نام متن
〰️〰️〰️〰️〰️


🔶تنظیم بیوگرافی ربات.
🔺En: setbio [TEXT]
🔻Fa: تنظیم بیو متن

〰️〰️〰️〰️〰️

🔷تنظیم یوزرنیم ربات.
🔺En: setusername [TEXT]
🔻Fa: تنظیم یوزرنیم متن
〰️〰️〰️〰️〰️
🔶تنظیم پروفایل (لینک سایت)
🔺En: setprofile [link]
🔻Fa: تنظیم پروفایل لینک

🔷تنظیم پروفایل (ارسال عکس)
🔺En: setprofile
🔻Fa: تنظیم پروفایل

🔶حذف پروفایل ربات.
🔺En: remprofile
🔻Fa: حذف پروفایل

〰️〰️〰️〰️〰️
🔷تنظیم وضعیت بازدید.
⚠️تعیین وضعیت بازدید ربات برای دیگران(نشان دادن آنلاین)
🔺En: setstatus [all|contacts|nobody]
🔻Fa: تنظیم وضعیت همه|مخاطبین|هیچکس

〰️〰️〰️〰️〰️
🔶تنظیم وضعیت افزودن .
⚠️تعیین حریم خصوصی افزودن ربات(افزودن به گروه ها)

🔺En: setadd [all|contacts|nobody]
🔻Fa: تنظیم افزودن همه|مخاطبین|هیچکس

〰️〰️〰️〰️〰️", $back);			
		}elseif($dataq == "karbodrih"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "🔰راهنما دستورات کاربردی

🔷مشاهده تنظیمات ربات
⚠️دریافت وضعیت تنظیمات ربات
🔺En: settings
🔻Fn: تنظیمات
〰️〰️〰️〰️〰️

🔶دریافت اطلاعات ربات.
⚠️دریافت اطلاعات(تعدادگروه - مخاطب-پیوی و...)
🔺En: info
🔻Fn: اطلاعات
〰️〰️〰️〰️〰️

🔷بروزکردن اطلاعات ربات
⚠️بروزرسانی پروفایل و مشخصات ربات (بروزرسانی وبازشماری مخاطبین ربات)
🔺En: updatebot
🔻Fn: بروزرسانی    
〰️〰️〰️〰️〰️

🔶برسی خصوصی ها
⚠️بررسی خصوصی های ربات و حذف بلاک شده ها.
🔺En: checkpv
🔻Fn: بررسی خصوصی
〰️〰️〰️〰️〰️

🔷بازنشانی تمامی چت ها.
⚠️بازگردانی تمام چت های قبلی ربات به لیست
🔺En: backchats
🔻Fn: بازگردانی چت ها
〰️〰️〰️〰️〰️

🔶بازنشانی به صورت کلی.
⚠️حذف لیست سوپرگروه و گروه و خصوصی ها.
🔺En: reset
🔻Fn: بازنشانی
〰️〰️〰️〰️〰️

🔷تنظیم حداقل اعضا.
⚠️تنظیم حداقل اعضای گروه هایی که ربات باید عضو شود.
🔺En: minmember [num]
🔻Fn: حداقل اعضا عدد

🗑 جهت پاکسازی حداقل اعضا.
🔺En: delminmember
🔻Fn: حذف حداقل اعضا
〰️〰️〰️〰️〰️
🔷تنظیم حداکثر گروه.
⚠️تنظیم حداکثر تعداد گروهی که ربات میتواند داشته باشد.

🔺En: maxgroup [num]
🔻Fn: حداکثر گروه عدد
🗑جهت پاکسازی حداکثر اعضا
🔺En: delmaxgroup
🔻Fn: حذف حداکثر گروه
〰️〰️〰️〰️〰️

🔶اضافه کردن ممبر به گروه.
⚠️افزودن کل مخاطبین و افراد خصوصی ربات به گروه.
🔺En: addmembers
🔻Fn: افزودن اعضا

❌جهت غیرفعالسازی.
🔺En: addmembers off
🔻Fn: افزودن اعضا خاموش

〰️〰️〰️〰️〰️

🔷ریلود کردن ربات ها.
⚠️اجرا مجدد فایل اصلی ربات.
🔺En: reload
🔻Fn: ریلود
〰️〰️〰️〰️〰️

🔶تنظیم گروه اصلی.
⚠️تنظیم گروه برای دریافت اعلانات و...
🔺En: setrealm
🔻Fn: تنظیم مادر
〰️〰️〰️〰️〰️

🔷عضو کردن ربات در کانال مورد نظر.
⚠️عضویت در کانال با یوزرنیم خاص.
🔺En: joinchannel @username
🔻Fn: عضویت در کانال آیدی کانال

〰️〰️〰️〰️〰️
🔶عضو کردن ربات در گروه موردن نظر.
⚠️عضویت در گروه با لینک خاص.
🔺En: joinchat [link]
🔻Fn: عضویت در گروه لینک
〰️〰️〰️〰️〰️

🔷اطلاع از مسدودی اکانت.
⚠️دریافت وضعیت کنونی از اسپم بات.

🔺En: spambot [Text]
🔻Fn: اسپم بات پیام 
〰️〰️〰️〰️〰️

🔶خاموش و روشن کردن ربات.
✅روشن کردن ربات.

🔺En: on
🔻Fn: روشن
❌خاموش کردن ربات به صورت کامل و دقیقه ای.

🔺En: off
🔻Fn: خاموش
⏱خاموش کردن ربات به صورت دقیقه ای.
🔺En: off [num]
🔻Fn: خاموش عدد
〰️〰️〰️〰️〰️
🔷اطلاع از محدودیت فوروارد.
⚠️درصورت فوروارد این پیام ربات در محدودیت فوروارد نیست.
🔺En: ping
🔻Fn: پینگ

🔶اطلاع از محدودیت ریپ چت بودن ربات.
🔺En: online
🔻Fn: انلاین
〰️〰️〰️〰️〰️

🔷استارت کردن یک ربات 
⚠️استارت کردن یک ربات با استفاده از یوزرنیم.
🔺En: start @username
🔻Fn:  استارت آیدی ربات
〰️〰️〰️〰️〰️", $back);			
		}elseif($dataq == "sudohelp"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "🔰راهنما سودو ربات.
🔶اضافه کردن سودو.
🔺En: addsudo [id]
🔻Fa: افزودن سودو آیدی عددی
〰️〰️〰️〰️〰️
🔹حذف کردن سودو.
🔺En: remsudo [id]
🔻Fa: حذف سودو آیدی عددی
〰️〰️〰️〰️〰️
🔶نمایش لیست سودو ها.
🔺En: sudolist
🔻Fa: لیست سودو
〰️〰️〰️〰️〰️", $back);			
		}elseif($dataq == "joinlinkdonih"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "🔰راهنما عضویت در لینکدونی .

🔶فعالسازی عضویت.
⚠️روشن یا خاموش کردن بررسی 500گروه اخر پیام لینکدونی ها.
🔺En: joinld [on|off]
🔻Fa: عضویت لینکدونی روشن|خاموش

〰️〰️〰️〰️〰️
🔷افزودن لینکدونی.
⚠️اضافه کردن لینکدونی جهت بررسی 24ساعته.
🔺En: addld @username
🔻Fa: افزودن لینکدونی یوزرنیم
〰️〰️〰️〰️〰️
🔶پاکسازی لینکدونی از لیست.
⚠️حذف لینکدونی از لیست بررسی.
🔺En: remld @username
🔻Fa: حذف لینکدونی یوزنیم

〰️〰️〰️〰️〰️", $back);			
			}elseif($dataq == "jointitleh"){
			$back = json_encode(['resize_keyboard' => true,
'inline_keyboard'=>[
[['text' => "👈🏻برگشت", 'callback_data' => "backh"]],
]]);
	EditMsg($callbackid, "🔰راهنما دستورات عضویت و عدم عضویت گروه با تایتل خاص.

🔷عدم ورود به گروه های خاص.
⚠️عدم عضویت در گروه با اسامی خاص.

🔺En: leftname [on|off]
🔻Fa: نام ممنوع روشن|خاموش
〰️〰️〰️〰️〰️
🔶افزودن اسم به لیست.
⚠️اضافه کردن یک اسم به لیست ممنوع جهت عدم عضویت.
🔺En: addlname [name]
🔻Fa: افزودن اسم خروج اسم
〰️〰️〰️〰️〰️
🔷حذف کردن اسم از لیست.
⚠️حذف کردن یک اسم از لیست ممنوع.
🔺En: remlname [name]
🔻Fa: حذف اسم خروج اسم
〰️〰️〰️〰️〰️
🔶مشاهده لیست .
⚠️مشاهده کل اسامی موجود در لیست.
🔺En: lnamelist
🔻Fa: لیست ممنوع
〰️〰️〰️〰️〰️
🔷پاکسازی لیست.
⚠️پاکسازی کل اسامی موجود در لیست ممنوع.
🔺En: clean lname
🔻Fa: پاکسازی لیست ممنوع

〰️〰️〰️〰️〰️
🔰دستورات مجاز کردن اسامی

🔷عضویت اسم ها خاص.
⚠️روشن و خاموش کردن وضعیت عضویت فقط در گروه بااسامی مجاز.

🔺En: whitename [on|off]
🔻Fa: نام مجاز روشن|خاموش
〰️〰️〰️〰️〰️
🔶افزودن نام مجاز.
⚠️اضافه کردن یک اسم به لیست مجاز جهت عضویت فقط در این اسامی.
🔺En: addwname [name]
🔻Fa: فزودن اسم مجاز اسم
〰️〰️〰️〰️〰️
🔷پاک کردن نام.
⚠️حذف کردن یک اسم از لیست مجاز.
 
🔺En: remwname [name]
🔻Fa: حذف اسم مجاز اسم
〰️〰️〰️〰️〰️
🔶مشاهده لیست.
⚠️مشاهده کل اسامی موجود در لیست.

🔺En: wnamelist
🔻Fa: لیست مجاز
〰️〰️〰️〰️〰️
🔷پاکسازی لیست مجاز.
⚠️پاکسازی کل اسامی موجود در لیست مجاز.
🔺En: clean wname
🔻Fa: پاکسازی لیست مجاز
〰️〰️〰️〰️〰️", $back);
		}elseif($dataq == "backh"){
		$back = json_encode(['resize_keyboard' => true,
 'inline_keyboard'=>[
									[['text'=>"راهنما فوروارد و ارسال پیام",'callback_data'=>"fwdbch"]],
														[['text'=>"راهنما دستورات خروج",'callback_data'=>"lefth"],['text'=>"راهنما مدیریتی",'callback_data'=>"adminateh"]],
										[['text'=>"راهنما دستورات خاص",'callback_data'=>"specialh"],['text'=>"راهنما دستورات عضویت اجباری",'callback_data'=>"fjoinh"]],
															[['text'=>"راهنما تنظیمات ظاهری",'callback_data'=>"displayh"],['text'=>"راهنما دستورات کاربردی",'callback_data'=>"karbodrih"]],
                    [['text'=>"راهنما سودو", 'callback_data'=>"sudohelp"],['text'=>"راهنما عضویت در لینکدونی", 'callback_data'=>"joinlinkdonih"]],
					[['text'=>"راهنما دستورات عضویت و عدم عضویت گروه با تایتل خاص",'callback_data'=>"jointitleh"]],
                    ]]);
	EditMsg($callbackid, '📲به راهنمای تبلیغاتی ورژن 3.9.8 ویرایش تایتان خوش آمدید
			⬅️لطفا یکی از دکمه های زیر را انتخاب نموده تا راهنمای همان ویژگی برای شما نمایش داده شود
			
			⚠️تیم فنون کدنویسی ', $back);	
	/*	}elseif($dataq == "nothing"){
		     bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⚠️دیتایی وجود ندارد",
            'show_alert' => false
        ]);
			}elseif($dataq == "quitpanel"){
		     bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️پنل بسته شد",
            'show_alert' => false
        ]);
  	EditMsg($callbackid,"⛔️پنل بسته شد");	
			}elseif(strpos($dataq ,"nextpageinfo&") !== false){
	    if (preg_match('/nextpageinfo&(.*?)&(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $pagenum = $match[1];
        $ipadd = $match[2];
        $idbb = $match[3];
      $dataopen = file_get_contents("http://$ipadd/index.php?data=info&id=$idbb&chatid=$chat_id_callback");
      if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      $dataopen = json_decode($dataopen);
      $arr = array();
       if($pagenum == 1){
          $countf = 0;
          $counts = 13;
      }elseif($pagenum == 2){
          $countf = 13;
          $counts = 26;
      }elseif($pagenum == 3){
          $countf = 26;
          $counts = 42;
      }
      $countp=0;
foreach($dataopen as $key => $val) {
    if($countp < $counts and $countp >= $countf){
$search  = array('gpsn', 'supergap', 'conts',
'pvsn', 'matual', 'wlinks',
'priwnks2', 'glinks', 'priginks2',
'slinks', 'links', 'priainks2',
'joleftgps', 'limitedgp', 'pubinks',
'idrobot', 'phone', 'name',
'admins', 'owners', 'maxgroups',
'minmember', 'scheck', 'ssjoin',
'infotofor', 'infotoleave', 'deletedgroup',
'ipserver', 'ram', 'cpu','hards');
$replace = array('🤵گروه ها', '👥سوپرگروه ها ', '🛂مخاطبین', 
'👤چت های خصوصی', '🔁مخاطبین دوطرفه', '👓لینک های در انتظار عمومی', '🕶لینک های در انتظار خصوصی',
'🌠لینک های عضویت عمومی','🎇لینک های عضویت خصوصی', '💾لینک های ذخیره شده',
'🖇کل لینک های عمومی', '⛓کل لینک های خصوصی', '🔀تعداد گپ ورودی و خروجی',
'⛔️تعداد گروه محدود شده', '🔭تعداد لینک گروه های عمومی', '🗒ایدی عددی ربات',
'☎️شماره ربات', '📛اسم ربات ', ' 👑مدیران ربات',
'🤴مالکین ربات', '🔝حداکثر تعداد گروه های ربات', '🔻حداقل اعضای یک گروه ربات',
'⏳زمان تا تایید لینک بعدی', '⏱زمان تا عضویت در لینک بعدی', '⏲زمان تا فوروارد خودکار بعدی',
'🕗زمان تا خروج از گروه بعدی', '🚫تعداد گروه ها برای خروج', '📟ادرس ایپی سرور ',
'🖱مصرف رم سرور', '🖥مصرف پردازنده سرور', '💽مصرف هارد سرور');
$text = str_replace($search,$replace,$key);
$keyt = $val;
    $arr[] = [['text'=>"$keyt",'callback_data'=>"nothing"],['text'=>"$text",'callback_data'=>"nothing"]];
}
$countp = $countp + 1;
}
$nextpage = $pagenum + 1;
    $backpage = $pagenum - 1;
if($pagenum == 2){
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpageinfo&$nextpage&$ipadd&$idbb&"],['text'=>"⬅️صفحه قبل",'callback_data'=>"backpageinfo&$backpage&$ipadd&$idbb&"]];
}elseif($pagenum == 1){
   $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpageinfo&$nextpage&$ipadd&$idbb&"]];
}elseif($pagenum == 3){
   $arr[] = [['text'=>"⬅️صفحه قبل",'callback_data'=>"nextpageinfo&$backpage&$ipadd&$idbb&"]];
}
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
$arary = json_encode(['resize_keyboard' => true,
 'inline_keyboard'=>$arr]);
 bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅به صفحه $pagenum رفتید",
            'show_alert' => false
        ]);
            	EditMsg($callbackid,"📝اطلاعات تبلیغاتی شماره ".$match[3]."
📲ایپی سرور: $ipadd
#️⃣صفحه اطلاعات: $pagenum
🎖تبلیغاتی ورژن: 4.0.0 K
⚠️برروی دکمه های اطلاعات نزنید هیچگونه دیتایی ندارند",$arary);	
}
		}elseif(strpos($dataq ,"backpageinfo&") !== false){
	    if (preg_match('/backpageinfo&(.*?)&(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $pagenum = $match[1];
        $ipadd = $match[2];
        $idbb = $match[3];
      $dataopen = file_get_contents("http://$ipadd/index.php?data=info&id=$idbb&chatid=$chat_id_callback");
      if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      $dataopen = json_decode($dataopen);
      $arr = array();
       if($pagenum == 1){
          $countf = 0;
          $counts = 13;
      }elseif($pagenum == 2){
          $countf = 13;
          $counts = 26;
      }elseif($pagenum == 3){
          $countf = 26;
          $counts = 42;
      }
      $countp=0;
foreach($dataopen as $key => $val) {
    if($countp < $counts and $countp >= $countf){
$search  = array('gpsn', 'supergap', 'conts',
'pvsn', 'matual', 'wlinks',
'priwnks2', 'glinks', 'priginks2',
'slinks', 'links', 'priainks2',
'joleftgps', 'limitedgp', 'pubinks',
'idrobot', 'phone', 'name',
'admins', 'owners', 'maxgroups',
'minmember', 'scheck', 'ssjoin',
'infotofor', 'infotoleave', 'deletedgroup',
'ipserver', 'ram', 'cpu','hards');
$replace = array('🤵گروه ها', '👥سوپرگروه ها ', '🛂مخاطبین', 
'👤چت های خصوصی', '🔁مخاطبین دوطرفه', '👓لینک های در انتظار عمومی', '🕶لینک های در انتظار خصوصی',
'🌠لینک های عضویت عمومی','🎇لینک های عضویت خصوصی', '💾لینک های ذخیره شده',
'🖇کل لینک های عمومی', '⛓کل لینک های خصوصی', '🔀تعداد گپ ورودی و خروجی',
'⛔️تعداد گروه محدود شده', '🔭تعداد لینک گروه های عمومی', '🗒ایدی عددی ربات',
'☎️شماره ربات', '📛اسم ربات ', ' 👑مدیران ربات',
'🤴مالکین ربات', '🔝حداکثر تعداد گروه های ربات', '🔻حداقل اعضای یک گروه ربات',
'⏳زمان تا تایید لینک بعدی', '⏱زمان تا عضویت در لینک بعدی', '⏲زمان تا فوروارد خودکار بعدی',
'🕗زمان تا خروج از گروه بعدی', '🚫تعداد گروه ها برای خروج', '📟ادرس ایپی سرور ',
'🖱مصرف رم سرور', '🖥مصرف پردازنده سرور', '💽مصرف هارد سرور');
$text = str_replace($search,$replace,$key);
$keyt = $val;
    $arr[] = [['text'=>"$keyt",'callback_data'=>"nothing"],['text'=>"$text",'callback_data'=>"nothing"]];
}
$countp = $countp + 1;
}
$nextpage = $pagenum + 1;
    $backpage = $pagenum - 1;
if($pagenum == 2){
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpageinfo&$nextpage&$ipadd&$idbb&"],['text'=>"⬅️صفحه قبل",'callback_data'=>"backpageinfo&$backpage&$ipadd&$idbb&"]];
}elseif($pagenum == 1){
   $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpageinfo&$nextpage&$ipadd&$idbb&"]];
}elseif($pagenum == 3){
   $arr[] = [['text'=>"⬅️صفحه قبل",'callback_data'=>"nextpageinfo&$backpage&$ipadd&$idbb&"]];
}
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
$arary = json_encode(['resize_keyboard' => true,
 'inline_keyboard'=>$arr]);
 bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅به صفحه $pagenum رفتید",
            'show_alert' => false
        ]);
            	EditMsg($callbackid,"📝اطلاعات تبلیغاتی شماره ".$match[3]."
📲ایپی سرور: $ipadd
#️⃣صفحه اطلاعات: $pagenum
🎖تبلیغاتی ورژن: 4.0.0 K
⚠️برروی دکمه های اطلاعات نزنید هیچگونه دیتایی ندارند",$arary);	
}
		}elseif(strpos($dataq ,"nextpage&") !== false){
	    if (preg_match('/nextpage&(.*?)&(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $pagenum = $match[1];
        $ipadd = $match[2];
        $idbb = $match[3];
      $dataopen = file_get_contents("http://$ipadd/index.php?data=settings&id=$idbb&chatid=$chat_id_callback");
      if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      $dataopen = json_decode($dataopen);
      $arr = array();
       if($pagenum == 1){
          $countf = 0;
          $counts = 13;
      }elseif($pagenum == 2){
          $countf = 13;
          $counts = 26;
      }elseif($pagenum == 3){
          $countf = 26;
          $counts = 42;
      }
      $countp=0;
foreach($dataopen as $key => $val) {
    if($countp < $counts and $countp >= $countf){
if(strpos($key,"addcontact") === false and strpos($key,"firstredis") === false and strpos($key,"jjoin") === false and strpos($key,"typing") === false and strpos($key,"welcome") === false and strpos($key,"offbot") === false){
$reponoff  = array('on', 'off');
$seaonoff  = array('☑️', '❌');
if("$key" == "bc"){$key == "bchandsend";}
if("$key" == "frand"){$key == "frandauto";}
$search  = array('limited', 'filtergp', 'getcode',
'tabchi_save', 'additext', 'sendcontact',
'autoleave', 'maxlink', 'secretarychat',
'autolefttime', 'leftgptime', 'maxjoin',
'synclinks', 'tabchi_autojoin', 'sudogetlink',
'addleft', 'secretary', 'fwdleft',
'frandhand', 'tabchi_markread', 'leftname', 'autoreset',
'autooff', 'whitename', 'channelget',
'fjoin', 'replyfor', 'hellojoin',
'sticker', 'proxy', 'addcontact', 'joinchannel',
'bc', 'frand');
$replace = array('🔇خروج از گپ محدودشده ', '🥇اولین پیام خصوصی ', '☎️دریافت اعلانات تلگرام ', 
'👥افزودن مخاطب ', '📝پیام افزودن مخاطب', '📤ارسال شماره', '👋🏻خروج خودکار زماندار عادی ',
'✔️تایید لینک ', '🧠هوش مصنوعی گروه ', '⏱خروج زماندار پس از عضویت  ',
'📭خروج تکی گروه', '📨عضویت خودکار  ', '📊همگام سازی لینک',
'🕵️شناسایی لینک ', '🔗دریافت لینک حرفه ای سودو', '⏬افزودن و خروج از گپ ',
'🎈هوش مصنوعی خصوصی ', '⏏️فوروارد و خروج از گپ  ', '▶️فوروارد دستی ',
'✅خواندن پیام ها',
'⛔️عدم عضویت در لیست سیاه گروه ', '♻️بروزرسانی خودکار 24ساعته ', '📉خروج از گروه معمولی ',
'🧾عضویت در لیست سفید', '🔗دریافت لینک حرفه ای همگانی  ', '⛓عضویت اجباری ',
'↩️ریپلای خودکار ارسال و فور ', '📻ارسال پیام پس از عضویت ', '🍀هوش مصنوعی ممبر ',
'🛡وضعیت اتصال به پروکسی ', '🕹افزودن اعضا ', '🖇خواندن لینک در لینکدونی ',
'📝ارسال دستی','⏩فوروارد خودکار حرفه ای');
$text = str_replace($search,$replace,$key);
$keyt = str_replace($reponoff,$seaonoff,$val);
if($keyt == "☑️"){
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"]];
}else{
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"]];
}
}
}
$countp = $countp + 1;
}
$nextpage = $pagenum + 1;
    $backpage = $pagenum - 1;
if($pagenum == 2){
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"],['text'=>"⬅️صفحه قبل",'callback_data'=>"backpage&$backpage&$ipadd&$idbb&"]];
}elseif($pagenum == 1){
   $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"]];
}elseif($pagenum == 3){
   $arr[] = [['text'=>"⬅️صفحه قبل",'callback_data'=>"nextpage&$backpage&$ipadd&$idbb&"]];
}
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
$arary = json_encode(['resize_keyboard' => true,
 'inline_keyboard'=>$arr]);
 bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅به صفحه $pagenum رفتید",
            'show_alert' => false
        ]);
            	EditMsg($callbackid,"⚙️تنظیمات تبلیغاتی شماره ".$match[3]."
📲ایپی سرور: $ipadd
#️⃣صفحه تنظیمات: $pagenum
🎖تبلیغاتی ورژن: 4.0.0 K
📝جهت روشن یا خاموش کردن تنظیمات کافی است بر روی دکمه آن بزنید تا آن خاموش یا روشن شود
شکلک ❌ نشان دهنده خاموش بودن و شکلک ☑️ نشان دهنده روشن بودن آن است", $arary);	
}
		}elseif(strpos($dataq ,"backpage&") !== false){
	    if (preg_match('/backpage&(.*?)&(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $pagenum = $match[1];
        $ipadd = $match[2];
        $idbb = $match[3];
      $dataopen = file_get_contents("http://$ipadd/index.php?data=settings&id=$idbb&chatid=$chat_id_callback");
      if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      $dataopen = json_decode($dataopen);
      $arr = array();
       if($pagenum == 1){
          $countf = 0;
          $counts = 13;
      }elseif($pagenum == 2){
          $countf = 13;
          $counts = 26;
      }elseif($pagenum == 3){
          $countf = 26;
          $counts = 42;
      }
      $countp=0;
foreach($dataopen as $key => $val) {
    if($countp < $counts and $countp >= $countf){
if(strpos($key,"addcontact") === false and strpos($key,"firstredis") === false and strpos($key,"jjoin") === false and strpos($key,"typing") === false and strpos($key,"welcome") === false and strpos($key,"offbot") === false){
$reponoff  = array('on', 'off');
$seaonoff  = array('☑️', '❌');
if("$key" == "bc"){$key == "bchandsend";}
if("$key" == "frand"){$key == "frandauto";}
$search  = array('limited', 'filtergp', 'getcode',
'tabchi_save', 'additext', 'sendcontact',
'autoleave', 'maxlink', 'secretarychat',
'autolefttime', 'leftgptime', 'maxjoin',
'synclinks', 'tabchi_autojoin', 'sudogetlink',
'addleft', 'secretary', 'fwdleft',
'frandhand', 'tabchi_markread', 'leftname', 'autoreset',
'autooff', 'whitename', 'channelget',
'fjoin', 'replyfor', 'hellojoin',
'sticker', 'proxy', 'addcontact', 'joinchannel',
'bc', 'frand');
$replace = array('🔇خروج از گپ محدودشده ', '🥇اولین پیام خصوصی ', '☎️دریافت اعلانات تلگرام ', 
'👥افزودن مخاطب ', '📝پیام افزودن مخاطب', '📤ارسال شماره', '👋🏻خروج خودکار زماندار عادی ',
'✔️تایید لینک ', '🧠هوش مصنوعی گروه ', '⏱خروج زماندار پس از عضویت  ',
'📭خروج تکی گروه', '📨عضویت خودکار  ', '📊همگام سازی لینک',
'🕵️شناسایی لینک ', '🔗دریافت لینک حرفه ای سودو', '⏬افزودن و خروج از گپ ',
'🎈هوش مصنوعی خصوصی ', '⏏️فوروارد و خروج از گپ  ', '▶️فوروارد دستی ',
'✅خواندن پیام ها',
'⛔️عدم عضویت در لیست سیاه گروه ', '♻️بروزرسانی خودکار 24ساعته ', '📉خروج از گروه معمولی ',
'🧾عضویت در لیست سفید', '🔗دریافت لینک حرفه ای همگانی  ', '⛓عضویت اجباری ',
'↩️ریپلای خودکار ارسال و فور ', '📻ارسال پیام پس از عضویت ', '🍀هوش مصنوعی ممبر ',
'🛡وضعیت اتصال به پروکسی ', '🕹افزودن اعضا ', '🖇خواندن لینک در لینکدونی ',
'📝ارسال دستی','⏩فوروارد خودکار حرفه ای');
$text = str_replace($search,$replace,$key);
$keyt = str_replace($reponoff,$seaonoff,$val);
if($keyt == "☑️"){
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"]];
}else{
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"]];
}
}
}
$countp = $countp + 1;
}
$nextpage = $pagenum + 1;
    $backpage = $pagenum - 1;
if($pagenum == 2){
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"],['text'=>"⬅️صفحه قبل",'callback_data'=>"backpage&$backpage&$ipadd&$idbb&"]];
}elseif($pagenum == 1){
   $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"]];
}elseif($pagenum == 3){
   $arr[] = [['text'=>"⬅️صفحه قبل",'callback_data'=>"nextpage&$backpage&$ipadd&$idbb&"]];
}
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
$arary = json_encode(['resize_keyboard' => true,
 'inline_keyboard'=>$arr]);
 bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅به صفحه $pagenum رفتید",
            'show_alert' => false
        ]);
            	EditMsg($callbackid,"⚙️تنظیمات تبلیغاتی شماره ".$match[3]."
📲ایپی سرور: $ipadd
#️⃣صفحه تنظیمات: $pagenum
🎖تبلیغاتی ورژن: 4.0.0 K
📝جهت روشن یا خاموش کردن تنظیمات کافی است بر روی دکمه آن بزنید تا آن خاموش یا روشن شود
شکلک ❌ نشان دهنده خاموش بودن و شکلک ☑️ نشان دهنده روشن بودن آن است", $arary);	
}
		}elseif(strpos($dataq ,"-turnoff&") !== false){
	    if (preg_match('/&(.*?)-turnoff&(.*?)&(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $key = $match[1];
        $ipadd = $match[2];
        $idbb = $match[3];
        $pagenum = $match[4];
      $dataopen = file_get_contents("http://$ipadd/index.php?data=turnoff&key=$key&id=$idbb&chatid=$chat_id_callback");
      if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      $dataopen = json_decode($dataopen);
      $arr = array();
       if($pagenum == 1){
          $countf = 0;
          $counts = 13;
      }elseif($pagenum == 2){
          $countf = 13;
          $counts = 26;
      }elseif($pagenum == 3){
          $countf = 26;
          $counts = 42;
      }
      $countp=0;
foreach($dataopen as $key => $val) {
    if($countp < $counts and $countp >= $countf){
if(strpos($key,"addcontact") === false and strpos($key,"firstredis") === false and strpos($key,"jjoin") === false and strpos($key,"typing") === false and strpos($key,"welcome") === false and strpos($key,"offbot") === false){
$reponoff  = array('on', 'off');
$seaonoff  = array('☑️', '❌');
if("$key" == "bc"){$key == "bchandsend";}
if("$key" == "frand"){$key == "frandauto";}
$search  = array('limited', 'filtergp', 'getcode',
'tabchi_save', 'additext', 'sendcontact',
'autoleave', 'maxlink', 'secretarychat',
'autolefttime', 'leftgptime', 'maxjoin',
'synclinks', 'tabchi_autojoin', 'sudogetlink',
'addleft', 'secretary', 'fwdleft',
'frandhand', 'tabchi_markread', 'leftname', 'autoreset',
'autooff', 'whitename', 'channelget',
'fjoin', 'replyfor', 'hellojoin',
'sticker', 'proxy', 'addcontact', 'joinchannel',
'bchandsend', 'frandauto');
$replace = array('🔇خروج از گپ محدودشده ', '🥇اولین پیام خصوصی ', '☎️دریافت اعلانات تلگرام ', 
'👥افزودن مخاطب ', '📝پیام افزودن مخاطب', '📤ارسال شماره', '👋🏻خروج خودکار زماندار عادی ',
'✔️تایید لینک ', '🧠هوش مصنوعی گروه ', '⏱خروج زماندار پس از عضویت  ',
'📭خروج تکی گروه', '📨عضویت خودکار  ', '📊همگام سازی لینک',
'🕵️شناسایی لینک ', '🔗دریافت لینک حرفه ای سودو', '⏬افزودن و خروج از گپ ',
'🎈هوش مصنوعی خصوصی ', '⏏️فوروارد و خروج از گپ  ', '▶️فوروارد دستی ',
'✅خواندن پیام ها',
'⛔️عدم عضویت در لیست سیاه گروه ', '♻️بروزرسانی خودکار 24ساعته ', '📉خروج از گروه معمولی ',
'🧾عضویت در لیست سفید', '🔗دریافت لینک حرفه ای همگانی  ', '⛓عضویت اجباری ',
'↩️ریپلای خودکار ارسال و فور ', '📻ارسال پیام پس از عضویت ', '🍀هوش مصنوعی ممبر ',
'🛡وضعیت اتصال به پروکسی ', '🕹افزودن اعضا ', '🖇خواندن لینک در لینکدونی ',
'📝ارسال دستی','⏩فوروارد خودکار حرفه ای');
$text = str_replace($search,$replace,$key);
$keyt = str_replace($reponoff,$seaonoff,$val);
if($keyt == "☑️"){
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"]];
}else{
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"]];
}
}
}
$countp = $countp + 1;
}
$nextpage = $pagenum + 1;
    $backpage = $pagenum - 1;
if($pagenum == 2){
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"],['text'=>"⬅️صفحه قبل",'callback_data'=>"backpage&$backpage&$ipadd&$idbb&"]];
}elseif($pagenum == 1){
   $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"]];
}elseif($pagenum == 3){
   $arr[] = [['text'=>"⬅️صفحه قبل",'callback_data'=>"nextpage&$backpage&$ipadd&$idbb&"]];
}
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
$arary = json_encode(['resize_keyboard' => true,
 'inline_keyboard'=>$arr]);
 bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅عملیات با موفقیت انجام شد",
            'show_alert' => false
        ]);
            	EditMsg($callbackid,"⚙️تنظیمات تبلیغاتی شماره ".$match[3]."
📲ایپی سرور: $ipadd
#️⃣صفحه تنظیمات: $pagenum
🎖تبلیغاتی ورژن: 4.0.0 K
📝جهت روشن یا خاموش کردن تنظیمات کافی است بر روی دکمه آن بزنید تا آن خاموش یا روشن شود
شکلک ❌ نشان دهنده خاموش بودن و شکلک ☑️ نشان دهنده روشن بودن آن است", $arary);	
}
		}elseif(strpos($dataq ,"-turnon&") !== false){
	    if (preg_match('/&(.*?)-turnon&(.*?)&(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $key = $match[1];
        $ipadd = $match[2];
        $idbb = $match[3];
         $pagenum = $match[4];
      $dataopen = file_get_contents("http://$ipadd/index.php?data=turnon&key=$key&id=$idbb&chatid=$chat_id_callback");
          if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      $dataopen = json_decode($dataopen);
      $arr = array();
       if($pagenum == 1){
          $countf = 0;
          $counts = 13;
      }elseif($pagenum == 2){
          $countf = 13;
          $counts = 26;
      }elseif($pagenum == 3){
          $countf = 26;
          $counts = 42;
      }
      $countp=0;
foreach($dataopen as $key => $val) {
        if($countp < $counts and $countp >= $countf){
if(strpos($key,"addcontact") === false and strpos($key,"firstredis") === false and strpos($key,"jjoin") === false and strpos($key,"typing") === false and strpos($key,"welcome") === false and strpos($key,"offbot") === false){
$reponoff  = array('on', 'off');
$seaonoff  = array('☑️', '❌');
if("$key" == "bc"){$key == "bchandsend";}
if("$key" == "frand"){$key == "frandauto";}
$search  = array('limited', 'filtergp', 'getcode',
'tabchi_save', 'additext', 'sendcontact',
'autoleave', 'maxlink', 'secretarychat',
'autolefttime', 'leftgptime', 'maxjoin',
'synclinks', 'tabchi_autojoin', 'sudogetlink',
'addleft', 'secretary', 'fwdleft',
'frandhand', 'tabchi_markread', 'leftname', 'autoreset',
'autooff', 'whitename', 'channelget',
'fjoin', 'replyfor', 'hellojoin',
'sticker', 'proxy', 'addcontact', 'joinchannel',
'bc', 'frand');
$replace = array('🔇خروج از گپ محدودشده ', '🥇اولین پیام خصوصی ', '☎️دریافت اعلانات تلگرام ', 
'👥افزودن مخاطب ', '📝پیام افزودن مخاطب', '📤ارسال شماره', '👋🏻خروج خودکار زماندار عادی ',
'✔️تایید لینک ', '🧠هوش مصنوعی گروه ', '⏱خروج زماندار پس از عضویت  ',
'📭خروج تکی گروه', '📨عضویت خودکار  ', '📊همگام سازی لینک',
'🕵️شناسایی لینک ', '🔗دریافت لینک حرفه ای سودو', '⏬افزودن و خروج از گپ ',
'🎈هوش مصنوعی خصوصی ', '⏏️فوروارد و خروج از گپ  ', '▶️فوروارد دستی ',
'✅خواندن پیام ها',
'⛔️عدم عضویت در لیست سیاه گروه ', '♻️بروزرسانی خودکار 24ساعته ', '📉خروج از گروه معمولی ',
'🧾عضویت در لیست سفید', '🔗دریافت لینک حرفه ای همگانی  ', '⛓عضویت اجباری ',
'↩️ریپلای خودکار ارسال و فور ', '📻ارسال پیام پس از عضویت ', '🍀هوش مصنوعی ممبر ',
'🛡وضعیت اتصال به پروکسی ', '🕹افزودن اعضا ', '🖇خواندن لینک در لینکدونی ',
'📝ارسال دستی','⏩فوروارد خودکار حرفه ای');
$text = str_replace($search,$replace,$key);
$keyt = str_replace($reponoff,$seaonoff,$val);
if($keyt == "☑️"){
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&$pagenum&"]];
}else{
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"],['text'=>"$text",'callback_data'=>"&$key-turnon&$ipadd&$idbb&$pagenum&"]];
}
}
}
$countp = $countp + 1;
}
$nextpage = $pagenum + 1;
    $backpage = $pagenum - 1;
if($pagenum == 2){
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"],['text'=>"⬅️صفحه قبل",'callback_data'=>"backpage&$backpage&$ipadd&$idbb&"]];
}elseif($pagenum == 1){
   $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&$nextpage&$ipadd&$idbb&"]];
}elseif($pagenum == 3){
   $arr[] = [['text'=>"⬅️صفحه قبل",'callback_data'=>"nextpage&$backpage&$ipadd&$idbb&"]];
}
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
$arary = json_encode(['resize_keyboard' => true,
 'inline_keyboard'=>$arr]);
  bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅عملیات با موفقیت انجام شد",
            'show_alert' => false
        ]);
            	EditMsg($callbackid,"⚙️تنظیمات تبلیغاتی شماره ".$match[3]."
📲ایپی سرور: $ipadd
#️⃣صفحه تنظیمات: $pagenum
🎖تبلیغاتی ورژن: 4.0.0 K
📝جهت روشن یا خاموش کردن تنظیمات کافی است بر روی دکمه آن بزنید تا آن خاموش یا روشن شود
شکلک ❌ نشان دهنده خاموش بودن و شکلک ☑️ نشان دهنده روشن بودن آن است", $arary);	
}
				}elseif(strpos($dataq ,"showamemdetail") !== false){
	    if (preg_match('/&(.*?)showamemdetail(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
        $chatidin = $match[3];
          bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅به محض آپدیت عملیات دیتا برای شما نمایش داده خواهد شد",
            'show_alert' => false
        ]);
       if (!is_dir("listedit/$ipadd")){
        mkdir("listedit/$ipadd");
       }
       file_put_contents("listedit/$ipadd/msgadd$idbb.txt","$callbackid");
	    }
		}elseif(strpos($dataq ,"saddmember") !== false){
	    if (preg_match('/&(.*?)saddmember(.*?)&/', $dataq, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
         $dataopen = "denied";//file_get_contents("http://$ipadd/index.php?data=saddmember&id=$idbb&chatid=$chat_id_callback");
          if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      if($dataopen == "ok"){
          bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅دستور توقف افزودن اعضا با موفقیت به سرور فرستاده شد",
            'show_alert' => false
        ]);
      }

	    }
		}elseif(strpos($dataq ,"showbcdetail") !== false){
	    if (preg_match('/&(.*?)showbcdetail(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
        $chatidin = $match[3];
          bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅به محض آپدیت عملیات دیتا برای شما نمایش داده خواهد شد",
            'show_alert' => false
        ]);
       if (!is_dir("listedit/$ipadd")){
        mkdir("listedit/$ipadd");
       }
       file_put_contents("listedit/$ipadd/msgbc$idbb.txt","$callbackid");
	    }
		}elseif(strpos($dataq ,"stopbcsend") !== false){
	    if (preg_match('/&(.*?)stopbcsend(.*?)&/', $dataq, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
         $dataopen = file_get_contents("http://$ipadd/index.php?data=stopbcsend&id=$idbb&chatid=$chat_id_callback");
          if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      if($dataopen == "ok"){
          bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅دستور توقف ارسال دستی با موفقیت به سرور فرستاده شد",
            'show_alert' => false
        ]);
      }

	    }
		}elseif(strpos($dataq ,"showfwddetail") !== false){
	    if (preg_match('/&(.*?)showfwddetail(.*?)&(.*?)&/', $dataq, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
        $chatidin = $match[3];
          bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅به محض آپدیت عملیات دیتا برای شما نمایش داده خواهد شد",
            'show_alert' => false
        ]);
       if (!is_dir("listedit/$ipadd")){
        mkdir("listedit/$ipadd");
       }
       file_put_contents("listedit/$ipadd/msgfwd$idbb.txt","$callbackid");
	    }
		}elseif(strpos($dataq ,"stopfwdsend") !== false){
	    if (preg_match('/&(.*?)stopfwdsend(.*?)&/', $dataq, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
         $dataopen = file_get_contents("http://$ipadd/index.php?data=stopfwdsend&id=$idbb&chatid=$chat_id_callback");
          if($dataopen == "denied"){
           bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⛔️شما دسترسی ندارید",
            'show_alert' => true
        ]);
        return;
      }
      if($dataopen == "ok"){
          bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "✅دستور توقف فوروارد دستی با موفقیت به سرور فرستاده شد",
            'show_alert' => false
        ]);
      }

	    }
		*/}
		
}
if (!is_null($query)) {
    /*if(strpos($query,"sendfwd") !== false){
     if (preg_match('/&(.*?)sendfwd(.*?)&(.*?)&/', $query, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
        $chatidin = $match[3];
     $results = [];
        $results[] = [
            'type' => 'article',
            'id' => base64_encode(rand()),
            'message_text' =>  "↩️تبلیغاتی شماره $idbb در حال فوروارد دستی است..
♻️درصورت تمایل برای دیدن جزئیات روی دکمه زیر بزنید",
            'parse_mode' => 'HTML',
            'title' => 'ADDMEMBER',
            'reply_markup'=>[
                'inline_keyboard'=>[
									[['text'=>"📲دیدن جزئیات فوروارد دستی",'callback_data'=>"&".$idbb."showfwddetail$ipadd&$chatidin&"]],
								[['text'=>"🔙توقف فوروارد دستی",'callback_data'=>"&".$idbb."stopfwdsend$ipadd&"]],
                    ]],
        ];
bot('answerInlineQuery', ['inline_query_id' => $inlineid,'results' => json_encode($results)]);    
}
}elseif(strpos($query,"sendbc") !== false){
     if (preg_match('/&(.*?)sendbc(.*?)&(.*?)&/', $query, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
        $chatidin = $match[3];
     $results = [];
        $results[] = [
            'type' => 'article',
            'id' => base64_encode(rand()),
            'message_text' =>  "⬅️تبلیغاتی شماره $idbb در حال ارسال دستی است..
♻️درصورت تمایل برای دیدن جزئیات روی دکمه زیر بزنید",
            'parse_mode' => 'HTML',
            'title' => 'ADDMEMBER',
            'reply_markup'=>[
                'inline_keyboard'=>[
									[['text'=>"📲دیدن جزئیات ارسال دستی",'callback_data'=>"&".$idbb."showbcdetail$ipadd&$chatidin&"]],
								[['text'=>"🔙توقف ارسال دستی",'callback_data'=>"&".$idbb."stopbcsend$ipadd&"]],
                    ]],
        ];
bot('answerInlineQuery', ['inline_query_id' => $inlineid,'results' => json_encode($results)]);    
}
}elseif(strpos($query,"addmembers") !== false){
     if (preg_match('/&(.*?)addmembers(.*?)&(.*?)&/', $query, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
        $chatidin = $match[3];
     $results = [];
        $results[] = [
            'type' => 'article',
            'id' => base64_encode(rand()),
            'message_text' =>  "👥تبلیغاتی شماره $idbb شروع به افزودن اعضا کرده است..
♻️درصورت تمایل برای دیدن جزئیات روی دکمه زیر بزنید",
            'parse_mode' => 'HTML',
            'title' => 'ADDMEMBER',
            'reply_markup'=>[
                'inline_keyboard'=>[
									[['text'=>"📲دیدن جزئیات افزودن ممبر",'callback_data'=>"&".$idbb."showamemdetail$ipadd&$chatidin&"]],
								[['text'=>"🔙توقف اد ممبر",'callback_data'=>"&".$idbb."saddmember$ipadd&"]],
                    ]],
        ];
bot('answerInlineQuery', ['inline_query_id' => $inlineid,'results' => json_encode($results)]);    
}
}else*/if($query == "ghelp"){
    $results = [];
        $results[] = [
            'type' => 'article',
            'id' => base64_encode(rand()),
            'message_text' =>  '📲به راهنمای تبلیغاتی ورژن 3.9.8 ویرایش تایتان خوش آمدید
			⬅️لطفا یکی از دکمه های زیر را انتخاب نموده تا راهنمای همان ویژگی برای شما نمایش داده شود
			
			⚠️تیم فنون کدنویسی ',
            'parse_mode' => 'HTML',
            'title' => 'HELP GENERAL',
             'reply_markup'=>[
                'inline_keyboard'=>[
									[['text'=>"راهنما فوروارد و ارسال پیام",'callback_data'=>"fwdbch"]],
														[['text'=>"راهنما دستورات خروج",'callback_data'=>"lefth"],['text'=>"راهنما مدیریتی",'callback_data'=>"adminateh"]],
										[['text'=>"راهنما دستورات خاص",'callback_data'=>"specialh"],['text'=>"راهنما دستورات عضویت اجباری",'callback_data'=>"fjoinh"]],
															[['text'=>"راهنما تنظیمات ظاهری",'callback_data'=>"displayh"],['text'=>"راهنما دستورات کاربردی",'callback_data'=>"karbodrih"]],
                    [['text'=>"راهنما سودو", 'callback_data'=>"sudohelp"],['text'=>"راهنما عضویت در لینکدونی", 'callback_data'=>"joinlinkdonih"]],
					[['text'=>"راهنما دستورات عضویت و عدم عضویت گروه با تایتل خاص",'callback_data'=>"jointitleh"]],
                    ]
                     ],
        ];
bot('answerInlineQuery', ['inline_query_id' => $inlineid,'results' => json_encode($results)]);    
}/*elseif(strpos($query,"sendtext_") !== false){
    
    $results = [];
            $text = str_replace("sendtext_",null,$query);
        $results[] = [
            'type' => 'article',
            'id' => base64_encode(rand()),
            'message_text' =>  "$text",
            'parse_mode' => 'HTML',
            'title' => 'TEXT BACK',
        ];
bot('answerInlineQuery', ['inline_query_id' => $inlineid,'results' => json_encode($results)]);    
}elseif(strpos($query,"settings") !== false){
    if (preg_match('/&(.*?)settings(.*?)&/', $query, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
      $dataopen = json_decode(file_get_contents("http://$ipadd/index.php?data=settings&id=$idbb&chatid=no"),true);
      $arr = array();
      $countp = 0;
foreach($dataopen as $key => $val) {
    if($countp == 12){break;}
if(strpos($key,"addcontact") === false and strpos($key,"firstredis") === false and strpos($key,"jjoin") === false and strpos($key,"typing") === false and strpos($key,"welcome") === false and strpos($key,"offbot") === false){
$reponoff  = array('on', 'off');
$seaonoff  = array('☑️', '❌');
if("$key" == "bc"){$key == "bchandsend";}
if("$key" == "frand"){$key == "frandauto";}
$search  = array('limited', 'filtergp', 'getcode',
'tabchi_save', 'additext', 'sendcontact',
'autoleave', 'maxlink', 'secretarychat',
'autolefttime', 'leftgptime', 'maxjoin',
'synclinks', 'tabchi_autojoin', 'sudogetlink',
'addleft', 'secretary', 'fwdleft',
'frandhand', 'tabchi_markread', 'leftname', 'autoreset',
'autooff', 'whitename', 'channelget',
'fjoin', 'replyfor', 'hellojoin',
'sticker', 'proxy', 'addcontact', 'joinchannel',
'bc', 'frand');
$replace = array('🔇خروج از گپ محدودشده ', '🥇اولین پیام خصوصی ', '☎️دریافت اعلانات تلگرام ', 
'👥افزودن مخاطب ', '📝پیام افزودن مخاطب', '📤ارسال شماره', '👋🏻خروج خودکار زماندار عادی ',
'✔️تایید لینک ', '🧠هوش مصنوعی گروه ', '⏱خروج زماندار پس از عضویت  ',
'📭خروج تکی گروه', '📨عضویت خودکار  ', '📊همگام سازی لینک',
'🕵️شناسایی لینک ', '🔗دریافت لینک حرفه ای سودو', '⏬افزودن و خروج از گپ ',
'🎈هوش مصنوعی خصوصی ', '⏏️فوروارد و خروج از گپ  ', '▶️فوروارد دستی ',
'✅خواندن پیام ها',
'⛔️عدم عضویت در لیست سیاه گروه ', '♻️بروزرسانی خودکار 24ساعته ', '📉خروج از گروه معمولی ',
'🧾عضویت در لیست سفید', '🔗دریافت لینک حرفه ای همگانی  ', '⛓عضویت اجباری ',
'↩️ریپلای خودکار ارسال و فور ', '📻ارسال پیام پس از عضویت ', '🍀هوش مصنوعی ممبر ',
'🛡وضعیت اتصال به پروکسی ', '🕹افزودن اعضا ', '🖇خواندن لینک در لینکدونی ',
'📝ارسال دستی','⏩فوروارد خودکار حرفه ای');
$text = str_replace($search,$replace,$key);
$keyt = str_replace($reponoff,$seaonoff,$val);
$countp = $countp + 1;
if($keyt == "☑️"){
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&1&"],['text'=>"$text",'callback_data'=>"&$key-turnoff&$ipadd&$idbb&1&"]];
}else{
    $arr[] = [['text'=>"$keyt",'callback_data'=>"&$key-turnon&$ipadd&$idbb&1&"],['text'=>"$text",'callback_data'=>"&$key-turnon&$ipadd&$idbb&1&"]];
}
}
}
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpage&2&$ipadd&$idbb&"]];
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
    $results = [];
        $results[] = [
            'type' => 'article',
            'id' => base64_encode(rand()),
            'message_text' =>  "⚙️تنظیمات تبلیغاتی شماره ".$match[1]."
📲ایپی سرور: $ipadd
🎖تبلیغاتی ورژن: 4.0.0 K
📝جهت روشن یا خاموش کردن تنظیمات کافی است بر روی دکمه آن بزنید تا آن خاموش یا روشن شود
شکلک ❌ نشان دهنده خاموش بودن و شکلک ☑️ نشان دهنده روشن بودن آن است",
            'parse_mode' => 'HTML',
            'title' => "Settings $idbb",
            'cache_time'=>1,
            'reply_markup'=>[
            'inline_keyboard'=>$arr
            ]
            ];
bot('answerInlineQuery', ['inline_query_id' => $inlineid,'results' => json_encode($results)]);  
}
}elseif(strpos($query,"info") !== false){
    if (preg_match('/&(.*?)info(.*?)&/', $query, $match) == 1) {
        $idbb = $match[1];
        $ipadd = $match[2];
      $dataopen = json_decode(file_get_contents("http://$ipadd/index.php?data=info&id=$idbb&chatid=no"),true);
      $arr = array();
      $countp = 0;
foreach($dataopen as $key => $val) {
    if($countp == 12){break;}
$search  = array('gpsn', 'supergap', 'conts',
'pvsn', 'matual', 'wlinks',
'priwnks2', 'glinks', 'priginks2',
'slinks', 'links', 'priainks2',
'joleftgps', 'limitedgp', 'pubinks',
'idrobot', 'phone', 'name',
'admins', 'owners', 'maxgroups',
'minmember', 'scheck', 'ssjoin',
'infotofor', 'infotoleave', 'deletedgroup',
'ipserver', 'ram', 'cpu','hards');
$replace = array('🤵گروه ها', '👥سوپرگروه ها ', '🛂مخاطبین', 
'👤چت های خصوصی', '🔁مخاطبین دوطرفه', '👓لینک های در انتظار عمومی', '🕶لینک های در انتظار خصوصی',
'🌠لینک های عضویت عمومی','🎇لینک های عضویت خصوصی', '💾لینک های ذخیره شده',
'🖇کل لینک های عمومی', '⛓کل لینک های خصوصی', '🔀تعداد گپ ورودی و خروجی',
'⛔️تعداد گروه محدود شده', '🔭تعداد لینک گروه های عمومی', '🗒ایدی عددی ربات',
'☎️شماره ربات', '📛اسم ربات ', ' 👑مدیران ربات',
'🤴مالکین ربات', '🔝حداکثر تعداد گروه های ربات', '🔻حداقل اعضای یک گروه ربات',
'⏳زمان تا تایید لینک بعدی', '⏱زمان تا عضویت در لینک بعدی', '⏲زمان تا فوروارد خودکار بعدی',
'🕗زمان تا خروج از گروه بعدی', '🚫تعداد گروه ها برای خروج', '📟ادرس ایپی سرور ',
'🖱مصرف رم سرور', '🖥مصرف پردازنده سرور', '💽مصرف هارد سرور');
$text = str_replace($search,$replace,$key);
$keyt = $val;
$countp = $countp + 1;
    $arr[] = [['text'=>"$keyt",'callback_data'=>"nothing"],['text'=>"$text",'callback_data'=>"nothing"]];
}
 $arr[] = [['text'=>"➡️صفحه بعد",'callback_data'=>"nextpageinfo&2&$ipadd&$idbb&"]];
 $arr[] = [['text'=>"⛔️بستن پنل",'callback_data'=>"quitpanel"]];
    $results = [];
        $results[] = [
            'type' => 'article',
            'id' => base64_encode(rand()),
            'message_text' =>  "📝اطلاعات تبلیغاتی شماره ".$match[1]."
📲ایپی سرور: $ipadd
⚠️برروی دکمه های اطلاعات نزنید هیچگونه دیتایی ندارند",
            'parse_mode' => 'HTML',
            'title' => "Info $idbb",
            'cache_time'=>1,
            'reply_markup'=>[
            'inline_keyboard'=>$arr
            ]
            ];
bot('answerInlineQuery', ['inline_query_id' => $inlineid,'results' => json_encode($results)]);  
}
}*/

}
if ((isset($text) && isset($chat_id))){
    if(strpos("218722292","$from_id") === false && strpos("458236744","$from_id") === false){
  //  if((strpos($persiangp,"$chat_id") !== false or strpos($tablighatigp,"$chat_id") !== false) && strpos($text,"#اطلاعیه") === false && strpos($text,"#جواب") === false && strpos($text,"#سوال") === false && strpos($text,"#مشکل") === false && strpos($text,"#پیشنهاد") === false){ return bot('deleteMessage',['chat_id'=>$chat_id,'message_id'=>$message_id,]);}
    if((strpos($persiangp,"$chat_id") !== false or strpos($tablighatigp,"$chat_id") !== false) && (strpos($text,"کسکش") !== false or strpos($text,"کون") !== false or strpos($text,"لاشی") !== false or strpos($text,"ننت") !== false or strpos($text,"جنده") !== false or strpos($text,"جاکش") !== false or strpos($text,"حروم") !== false or strpos($text,"مادر") !== false or strpos($text,"ننه") !== false)){ return bot('deleteMessage',['chat_id'=>$chat_id,'message_id'=>$message_id,]);}
    }
  if(strpos($tablighatigp,"$chat_id") !== false or strpos($realm,"$chat_id") !== false or strpos($persiangp,"$chat_id") !== false){return;}
    if(!is_dir("data/$from_id")){
mkdir("data/$from_id");
}
$myfile2 = file_get_contents("data/users.txt");
if(strpos($myfile2,"$from_id\n") === false){
file_put_contents("data/users.txt", $myfile2."$from_id\n");
}
}
if($text or $forward or (isset($data))){
 /* if("$from_id" != "218722292"){
if ($text){
sendinline($chat_id, "⚠️بزودی باز خواهیم گشت
حالت تعمیر برای ربات فعال شده است

✍🏻 @the_CA", [[['text'=>"تیم فنون کدنویسی",'url'=>"https://t.me/the_ca"]]]);
return;
}elseif($data){
                  editinline($chatid, $message_id2,"⚠️بزودی باز خواهیم گشت
حالت تعمیر برای ربات فعال شده است

✍🏻 @the_CA",[[['text'=>"تیم فنون کدنویسی",'url'=>"https://t.me/the_ca"]]]);
return;  
}
}*/
    //==============DATA INLINE
    if(isset($data)){
        if ($data == 'home'){
if(strpos($vip38,"$from_id") !== false){
    file_put_contents("data/$from_id/step.txt","no");
    editinline($chatid, $message_id2,"🌹سلام دوست گرامی

🚀به پنل مدیریتی تیم فنون کدنویسی خوش آمدید

[این ربات در حال تکمیل است]

✍🏻 @the_CA", $vipkey);
if(!file_exists("data/$from_id/index.html")){
    file_put_contents("data/$from_id/index.html","");
}
if (!file_exists("data/$from_id")){
mkdir("data/$from_id");
file_put_contents("data/$from_id/step.txt","no");
}
} 
}
elseif($data == 'remips'){
    file_put_contents("data/$from_id/step.txt","remips");
			$scan = scandir("list/ip/$lic38");
	 $keys = [];
foreach($scan as $file)
{
    if($file != "." && $file != ".." && strpos($file,"-ok") === false){
     $keys[] = [
                  ['text'=> $file,'callback_data'=>"rremips_$file"]
               ];
    }
}
$keys[] = [
                  ['text'=> "↩️بازگشت",'callback_data'=>"manageips"]
               ];
               editinline($chatid, $message_id2,"🚫لطفا یکی از ایپی های زیر را جهت حذف کردن انتخاب کنید:",$keys);
}
elseif(strpos($data,"rremips_") !== false){
    $text = $data;
        $text = str_replace("rremips_","",$text);
//$ippre = file_get_contents("data/$from_id/ippre.txt");
 $filecont = file_get_contents("list/ip/$lic38/$text");
        if($filecont == "vered"){
file_put_contents("data/$from_id/money.txt",$money + 3000);
        }
unlink("list/ip/$lic38/$text");
unlink("list/ip/$lic38/$text-ok");
    file_put_contents("data/$from_id/step.txt","");
    editinline($chatid, $message_id2,"✅ایپی $text با موفقیت از لیست حذف شد",$ipmanagement);
}
elseif($data == 'activeip'){
    file_put_contents("data/$from_id/step.txt","activeips");
			$scan = scandir("list/ip/$lic38");
	 $keys = [];
foreach($scan as $file)
{
    
    if($file != "." && $file != ".." && strpos($file,"-ok") === false){
         $filecont = file_get_contents("list/ip/$lic38/$file");
        if($filecont != "vered"){
     $keys[] = [
                  ['text'=> $file,'callback_data'=>"aactiveips_$file"]
               ];
    }
    }
}
$keys[] = [
                  ['text'=> "↩️بازگشت",'callback_data'=>"manageips"]
               ];
                editinline($chatid, $message_id2,"✅لطفا ایپی خود را جهت  فعال سازی انتخاب کنید", $keys);
}
elseif(strpos($data,"aactiveips_") !== false){
    $text = $data;
        $text = str_replace("aactiveips_","",$text);
        if(file_exists("data/$from_id/agrees.txt")){
        $agreemeshi = file_get_contents("data/$from_id/agrees.txt");
        }else{
            $agreemeshi = false;
        }
if($agreemeshi != true){
     $ippersian = file_get_contents("https://my.persiancloud.com/includes/hooks/cloudbot/ips.php");
     $ipcateam = file_get_contents("http://cateam.work/webservice/cloudbot/ips.php");
if(strpos($ippersian,"$text") === false and strpos($ipcateam,"$text") === false){
    if($money < 10000){
          editinline($chatid, $message_id2,"🚫شارژ شما در ربات کمتر از 10000 تومان میباشد.برای فعال سازی ایپی شما نیازمند حداقل شارژ 10000 تومان میباشید", [
    [['text'=>"💰افزایش موجودی",'callback_data'=>"paytop"]],
    [['text'=>"↩️بازگشت",'callback_data'=>"manageips"]],
    ]);
return;
}
file_put_contents("data/$from_id/money.txt",$money - 10000);
file_put_contents("list/ip/$lic38/$text", 'vered');
    file_put_contents("data/$from_id/step.txt","");
              editinline($chatid, $message_id2,"✅ایپی $text با موفقیت فعال سازی شد", $ipmanagement);
}else{
file_put_contents("list/ip/$lic38/$text", 'vered');
    file_put_contents("data/$from_id/step.txt","");
  editinline($chatid, $message_id2,"✅ایپی $text با موفقیت فعال سازی شد", $ipmanagement);
}
}else{
     $ippersian = file_get_contents("https://my.persiancloud.com/includes/hooks/cloudbot/ips.php");
     $ipcateam = file_get_contents("http://cateam.work/webservice/cloudbot/ips.php");
if(strpos($ippersian,"$text") !== false or strpos($ipcateam,"$text") !== false){
file_put_contents("list/ip/$lic38/$text", 'vered');
    file_put_contents("data/$from_id/step.txt","");
  editinline($chatid, $message_id2,"✅ایپی $text با موفقیت فعال سازی شد", $ipmanagement);
return;
}
                if (file_exists("data/$from_id/panels.txt")){
$all_member = fopen( "data/$from_id/panels.txt", 'r');
$count = 0;
while( !feof( $all_member)) {
$user = fgets( $all_member);
if($user != " " && $user != "\n" && $user != ""){
    $tokenx = str_replace("\n","",$user);
     $tokenx = str_replace(" ","",$tokenx);
$api = jwt_request($tokenx);
    $serverinfo = $api['servers'];
foreach ($serverinfo as &$serverinfos) {
   $serveripget = $serverinfos['public_net']['ipv4']['ip'];
if ($serveripget == $text){
    $count = $count + 1;
file_put_contents("list/ip/$lic38/$text", 'vered');
    file_put_contents("data/$from_id/step.txt","");
  editinline($chatid, $message_id2,"✅ایپی $text با موفقیت فعال سازی شد", $ipmanagement);
break;
}
}
if($count == 0){
 if ($api['meta']['pagination']['last_page'] > 1){
     for ($x = 2; $x <= $api['meta']['pagination']['last_page']; $x++) {
   $api2 = jwt_request2($tokenx,$x,50);
    $serverinfo2 = $api2['servers'];
foreach ($serverinfo2 as &$serverinfos2) {
   $serveripget2 = $serverinfos2['public_net']['ipv4']['ip'];
if ($serveripget2 == $text){
    $count = $count + 1;
file_put_contents("list/ip/$lic38/$text", 'vered');
    file_put_contents("data/$from_id/step.txt","");
  editinline($chatid, $message_id2,"✅ایپی $text با موفقیت فعال سازی شد", $ipmanagement);
break;
}
}  
 } 
 }
}
}
}
}else{
      editinline($chatid, $message_id2,"⛔️شما پنلی ندارید", $ipmanagement);
}
if($count == 0){
      if($money < 10000){
          editinline($chatid, $message_id2,"⛔️ایپی $text با پنل های شما مطابقت نداشت و شارژ شما در ربات کمتر از 10000 تومان میباشد.برای فعال سازی ایپی شما نیازمند حداقل شارژ 10000 تومان میباشید", $ipmanagement);
return;
}else{
file_put_contents("data/$from_id/money.txt",$money - 10000);
file_put_contents("list/ip/$lic38/$text", 'vered');
    file_put_contents("data/$from_id/step.txt","");
  editinline($chatid, $message_id2,"✅ایپی $text با موفقیت فعال سازی شد", $ipmanagement);
}
}
}
}
elseif($data == 'manageips'){
if(strpos($vip38,"$from_id") !== false){
$servers = file_get_contents("list/license/$lic38/servers.txt");
    			$scan = scandir("list/ip/$lic38");
    $countip = 0;
     $banips = 0;
      $activeip = 0;
      $sourcedip = 0;
foreach($scan as $file)
{
if($file != "." && $file != ".."){
    if(strpos($file,"-ok") !== false){
    $sourcedip = $sourcedip + 1;
    }
     if(strpos($servers,"$file⛔️") !== false){
    $banips = $banips + 1;
    }
        $filecont = file_get_contents("list/ip/$lic38/$file");
        if($filecont == "vered"){
   $activeip = $activeip + 1;
        }
            if(strpos($file,"-ok") === false){
    $countip = $countip + 1;
    }
        
    }
}
file_put_contents("data/$from_id/step.txt","no");
  editinline($chatid, $message_id2,"📊شما دارای $countip ایپی میباشید

✅ایپی های فعال سازی شده:  $activeip
📲ایپی های سورس نصب شده: $sourcedip
⛔️ایپی های رد شده: $banips

لطفا یکی از دکمه های زیر را انتخاب کنید" , $ipmanagement);

}
}
elseif($data == 'intelga'){
        file_put_contents("data/$from_id/step.txt","");
if(strpos($vip38,"$from_id") !== false){	
      editinline($chatid, $message_id2,"🌐به منوی هوش مصنوعی خوش آمدید.
شما در اینجا میتوانید مارا در امر بهبود هوش مصنوعی خصوصی ربات های تیم فنون کدنویسی یاری کنید
لطفا یکی از گزینه های زیر را انتخاب کنید" , $inetligance);
}
}
elseif($data == 'addotherintel'){
if(strpos($vip38,"$from_id") !== false){	
    file_put_contents("data/$from_id/step.txt","addothertext");
          editinline($chatid, $message_id2,"📑لطفا جمله غیره را وارد کنید.این جملات درصورتی که بات کلمه دریافتی در دایره لغات آن نباشد ارسال خواهد کرد
به عنوان مثال یک ربات متنی با عبارت 'برای کجا هستی؟' دریافت میکند و جوابی برای آن تعیین نشده است.ربات جمله ای که الان فرستاده اید را برای آن میفرستد" , [[['text'=>"↩️بازگشت",'callback_data'=>"intelga"]]]);
}
}
elseif($data == 'seerandomintel'){
if(strpos($vip38,"$from_id") !== false){
                if (file_exists("intel/random/$lic38/answers.txt")){
    $myfile2 = file_get_contents("intel/random/$lic38/answers.txt");
      editinline($chatid, $message_id2,"🔍فایل متون تصادفی برای شما ارسال خواهد شد" , [[['text'=>"↩️بازگشت",'callback_data'=>"intelga"]]]);
senddoc("./intel/random/$lic38/answers.txt",$chat_id,"🔍متون تصادفی");
                }else{
                    editinline($chatid, $message_id2,"🚫شما فایل متون تصادفی ندارید" , [[['text'=>"↩️بازگشت",'callback_data'=>"intelga"]]]);
                }
}
}
elseif($data == 'cleanrandomintel'){
if(strpos($vip38,"$from_id") !== false){
    file_put_contents("data/$from_id/step.txt","clearrandtext");
      editinline($chatid, $message_id2,"جمله ای که میخواهید از لیست پاک شود را دقیقا ارسال کنید🧹" , [[['text'=>"↩️بازگشت",'callback_data'=>"intelga"]]]);
}
}
elseif($data == 'addrandomintel'){
if(strpos($vip38,"$from_id") !== false){
    file_put_contents("data/$from_id/step.txt","addrandtext");
    editinline($chatid, $message_id2,"📑لطفا جمله تصادفی را وارد کنید.این جملات به صورت رندوم وتصادفی مورد استفاه قرار خواهند گرفت
به عنوان مثال یک ربات در گروهی عضو شده و جمله ای مانند : سلام من اومدم دوستان؛ را میفرستد" , [[['text'=>"↩️بازگشت",'callback_data'=>"intelga"]]]);
}
}
elseif($data == 'adddomainintel'){
if(strpos($vip38,"$from_id") !== false){	
    file_put_contents("data/$from_id/step.txt","adddomination");
     editinline($chatid, $message_id2,"📈لطفا کلمه را وارد کنید
توجه:این کلمه ورودی به ربات است.بعنوان مثال کسی به شما میگوید سلام" , [[['text'=>"↩️بازگشت",'callback_data'=>"intelga"]]]);
}
}
elseif($data == 'paytop'){
      editinline($chatid, $message_id2,"💳شما در اینجا میتوانید با انتخاب یکی از دکمه های شیشه ای زیر مقدار مورد نظر را در ربات شارژ کنید" , [
[['text'=>"افزایش مبلغ 3000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=3000"],['text'=>"افزایش مبلغ 6000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=6000"]],
[['text'=>"افزایش مبلغ 9000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=9000"],['text'=>"افزایش مبلغ 12000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=12000"]],
[['text'=>"افزایش مبلغ 15000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=15000"],['text'=>"افزایش مبلغ 30000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=30000"]],
[['text'=>"افزایش مبلغ 60000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=60000"],['text'=>"افزایش مبلغ 90000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=90000"]],
[['text'=>"افزایش مبلغ 150000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=150000"],['text'=>"افزایش مبلغ 300000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=300000"]],
[['text'=>"افزایش مبلغ 500000 تومان", 'url'=>"https://cateam.work/pay/order.php?email=$email&&phone=$phone&&userid=$from_id&&price=500000"]],
[['text'=>"↩️بازگشت",'callback_data'=>"home"]]
   ]);
 
}
elseif($data == "serverpro"){
    if($topay > 0 and $datenow >= $topaytime){
                editinline($chatid, $message_id2,"🚫متاسفانه شما به علت دیرکرد در پرداخت بدهکاری خود از این عملیات محروم شده اید\nنسبت به پرداخت مبلغ $topay از منوی مشاهده اطلاعات اقدام کنید" , 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"home"]]]);
return;
}
    if(strpos($vip38,"$from_id") !== false){
        if(!file_exists("data/$from_id/index.html")){
            file_put_contents("data/$from_id/index.html","");
        }
                        editinline($chatid, $message_id2,"🖥در این قسمت میتوانید سرور های خود را اضافه نموده و آنها را از طریق همین ربات مدیریت کنید
جهت ادامه یکی از دکمه های زیر را انتخاب کنید" , $keyserver);
}
}
elseif($data == "remserver"){
if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","remserver");
			$scan = scandir("data/$from_id/server");
	 $keys = [];
foreach($scan as $file)
{
    if($file != "." && $file != ".." && $file != "index.html"){
     $keys[] = [
                  ['text'=> $file,'callback_data'=>"remservers_$file"]
               ];
    }
}
$keys[] = [
                  ['text'=> "↩️بازگشت",'callback_data'=>"serverpro"]
               ];
                               editinline($chatid, $message_id2,"➖لطفا ایپی سرور را جهت حذف کردن انتخاب کنید" , 
$keys);

}
}
elseif(strpos($data,'remservers_') !== false){
    if(strpos($vip38,"$from_id") !== false){
        $text = $data;
        $text = str_replace("remservers_","",$text);
        $text = str_replace("http://","",$text);
     $text = str_replace(" ","",$text);
file_put_contents("data/$from_id/step.txt","");
        if(file_exists("data/$from_id/server/".$text."/port.txt")){
unlink("data/$from_id/server/".$text."/port.txt");
}
        if(file_exists("data/$from_id/server/".$text."/user.txt")){
unlink("data/$from_id/server/".$text."/user.txt");
}
        if(file_exists("data/$from_id/server/".$text."/index.html")){
unlink("data/$from_id/server/".$text."/index.html");
}
        if(file_exists("data/$from_id/server/".$text."/pass.txt")){
unlink("data/$from_id/server/".$text."/pass.txt");
}
rmdir("data/$from_id/server/".$text);
editinline($chatid, $message_id2,"✅ایپی $text از لیست سرورهای شما حذف شد.
به منوی عملیات سرور برگشتید" , $keyserver);
}
}
elseif($data == 'specialserver'){
if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","specdo");
			$scan = scandir("data/$from_id/server");
	 $keys = [];
foreach($scan as $file)
{
    if($file != "." && $file != ".." && $file != "index.html"){
     $keys[] = [
                  ['text'=> $file,'callback_data'=>"manageserver_$file"]
               ];
    }
}
$keys[] = [
                  ['text'=> "↩️بازگشت",'callback_data'=>"serverpro"]
               ];
                editinline($chatid, $message_id2,"⚙لطفا سرور مورد نظر را جهت عملیات های ویژه انتخاب کنید", 
$keys);
}
}
elseif(strpos($data,'manageserver_') !== false){
if(strpos($vip38,"$from_id") !== false){
    $isinlist = file_get_contents("data/isinlist.txt");
    if($isinlist == $from_id){
    file_put_contents("data/isinlist.txt",false);
    }
    $text = $data;
        $text = str_replace("manageserver_","",$text);
        file_put_contents("data/$from_id/serverpre.txt",$text);
editinline($chatid, $message_id2,"⚙سرور $text انتخاب شد
لطفا یکی از دکمه ها را انتخاب کنید", 
$advserver);
file_put_contents("data/$from_id/step.txt","");
}
}
elseif($data == 'cleaerserver'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","cleanserver");
editinline($chatid, $message_id2,"⛔️آیا اطمینان دارید که در سرور $serverpre دستور پاکسازی سرور ارسال شود؟", 
[[['text'=>"✅ادامه",'callback_data'=>"okclean"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}  
}
elseif($data == 'okclean'){
    if(strpos($vip38,"$from_id") !== false){
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);

    exit('Login Failed');
}
$ssh->exec("killall screen");
$ssh->exec("rm -rf *");
$installsource = $ssh->exec("redis-cli flushall && redis-cli flushdb");
$ssh->exec("history -c");
$ssh->disconnect();
	if(strpos($installsource,"OK") !== false){
	        editinline($chatid, $message_id2,"✅سرور $serverpre با موفقیت پاکسازی شد.",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
	}else{
	    	        editinline($chatid, $message_id2,"🚫مشکلی برای سرور $serverpre در هنگام پاکسازی سرور پیش آمد.
$installsource",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
}
elseif($data == 'reboot'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","sendreboot");
editinline($chatid, $message_id2,"♻️آیا اطمینان دارید که در سرور $serverpre دستور ریبوت ارسال شود؟", 
[[['text'=>"✅ادامه",'callback_data'=>"okreboot"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}  
}
elseif($data == 'okreboot'){
    if(strpos($vip38,"$from_id") !== false){
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$ssh->exec("killall screen");
$ssh->exec("sudo shutdown -r now");
$ssh->disconnect();
	        editinline($chatid, $message_id2,"✅سرور $serverpre با موفقیت ریبوت شد.",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'restorebackup'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","restoreserver");
	        editinline($chatid, $message_id2,"▶️لطفا بیس خود را با فرمت zip ارسال کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}  
}
elseif($data == 'addallsudo'){
        if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","addallsudo");
	        editinline($chatid, $message_id2,"🤴لطفا ایدی سودو را ارسال کنید(میتوانید ایدی را از @userinfobot دریافت کنید)",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($text == '🗑حذف کل ربات ها'){
        if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","cleanallbots");
editinline($chatid, $message_id2,"🚫آیا اطمینان دارید که کل ربات های سرور $serverpre حذف شود؟", 
[[['text'=>"✅ادامه",'callback_data'=>"okrcleanbots"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'okrcleanbots'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
  $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$ssh->exec("killall screen");
$scan = $ssh->exec("find 'glory' -type f");
file_put_contents("data/$from_id/bots.txt","$scan");
$line = fopen("data/$from_id/bots.txt", "r");
 while(!feof($line)) {
        $file = fgets($line);
   if(strpos($file,"glory/glory-") !== false){
       $count = $count + 1;
       $number = str_replace("glory/glory-","",$file);
              $number = str_replace(".sh","",$number);
               $number = str_replace("\n","",$number);
               $number = str_replace(" ","",$number);
               $ssh->exec("cd glory && screen -d -m -S bashauto ./glory clear2 $number y");
    }
}
$ssh->disconnect();
	        editinline($chatid, $message_id2,"✅درخواست برای حذف کل ربات های سرور $serverpre با موفقیت فرستاده شد.",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'addsudo'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","addsudo");
  editinline($chatid, $message_id2,"👑لطفا شماره باتی که میخواهید سودو به آن اضافه کنید راارسال کنید(بعنوان مثال ربات شماره 2)",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'installsource'){
if(strpos($vip38,"$from_id") !== false){
 /*   $isinlist = file_get_contents("data/isinlist.txt");
    if($isinlist != false){
          editinline($chatid, $message_id2,"🚫متاسفانه فرد دیگری در حال نصب سورس است تا زمان اتمام لطفا صبرکنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
return;
    }*/
file_put_contents("data/$from_id/step.txt","installsource");
editinline($chatid, $message_id2,"📲آیا اطمینان دارید که سورس روی سرور $serverpre نصب شود؟", 
[[['text'=>"✅ادامه",'callback_data'=>"okinstallsource"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'okinstallsource'){
    if(strpos($vip38,"$from_id") !== false){
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
$username2 = file_get_contents("list/license/$lic38/username.txt");
$password = file_get_contents("list/license/$lic38/password.txt");
file_put_contents("data/$from_id/step.txt","");
	        editinline($chatid, $message_id2,"♻️مراحل نصب سورس آغاز شد.لطفا تا اتمام عملیات صبر کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
$install = file_get_contents("http://process.cateam.work/ca2.php?data=installn&chatid=$chatid&msgid=$message_id2&serverpre=$serverpre&userserver=$userserver&passserver=$passserver&username2=$username2&password=$password");
if($install == "error"){
    	        editinline($chatid, $message_id2,"🚫مرحله 1 نصب سورس با مشکل مواجه شد
				رمز سرور یا روشنی سرور را بررسی کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
/*$isinlist = file_get_contents("data/isinlist.txt");
    if($isinlist == $from_id){
    file_put_contents("data/isinlist.txt",false);
    }*/
    return;
}else{
        	        editinline($chatid, $message_id2,"♻️سورس در حال نصب شدن است...
					لطفا تا اتمام نصب سورس صبرکنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
}
elseif($data == 'activesession'){
  if(strpos($vip38,"$from_id") !== false){
       file_put_contents("data/$from_id/step.txt","none");
editinline($chatid, $message_id2,"🎚لطفا تنظیمات مورد نظر خود راانتخاب کنید!
توجه کنید این تنظیمات اختصاصی ربات میباشد در صورت بلد نبودن و تغییر بی جهت آنها ربات هایی که خواهید ساخت دچار دیلیت خواهند شد", 
$asessionkey
);
}  
}
elseif($data == 'devmodelch'){
  if(strpos($vip38,"$from_id") !== false){
      file_put_contents("data/$from_id/step.txt","devmodelch");
editinline($chatid, $message_id2,"🖥لطفا مدل دستگاه را ارسال کنید:
    پیشفرض: LGE Nexus 5", 
[[['text'=>"🖥بازگشت به حالت پیشفرض",'callback_data'=>"devmodelchdef"]]
,[['text'=>"↘️بازگشت",'callback_data'=>"activesession"]]]
);
}  
}
elseif($data == 'devmodelchdef'){
     if(strpos($vip38,"$from_id") !== false){
                          file_put_contents("data/$from_id/devmodel.txt","no");
      editinline($chatid, $message_id2,"🖥مدل دستگاه شما تغییر کرد به حالت پیشفرض", $asessionkey);
               return;
}
}
elseif($data == 'sysversionch'){
  if(strpos($vip38,"$from_id") !== false){
            file_put_contents("data/$from_id/step.txt","sysversionch");
editinline($chatid, $message_id2,"⚙️لطفا ورژن سیستم را وارد کنید:
    پیشفرض: 9 P (28)", 
[[['text'=>"⚙️بازگشت به حالت پیشفرض",'callback_data'=>"sysversionchdef"]]
,[['text'=>"↘️بازگشت",'callback_data'=>"activesession"]]]
);
}  
}
elseif($data == 'sysversionchdef'){
     if(strpos($vip38,"$from_id") !== false){
                          file_put_contents("data/$from_id/sysversion.txt","no");
      editinline($chatid, $message_id2,"⚙️ورژن سیستم شما تغییر کرد به حالت پیشفرض", $asessionkey);
               return;
}
}
elseif($data == 'syslangch'){
  if(strpos($vip38,"$from_id") !== false){
      file_put_contents("data/$from_id/step.txt","syslangch");
editinline($chatid, $message_id2,"🛬لطفا زبان سیستم را وارد کنید:
    پیشفرض: en", 
[[['text'=>"🛬بازگشت به حالت پیشفرض",'callback_data'=>"syslangchdef"]]
,[['text'=>"↘️بازگشت",'callback_data'=>"activesession"]]]
);
}  
}
elseif($data == 'syslangchdef'){
     if(strpos($vip38,"$from_id") !== false){
                          file_put_contents("data/$from_id/syslang.txt","no");
      editinline($chatid, $message_id2,"🛬زبان سیستم شما تغییر کرد به حالت پیشفرض", $asessionkey);
               return;
}
}
elseif($data == 'appversionch'){
  if(strpos($vip38,"$from_id") !== false){
      file_put_contents("data/$from_id/step.txt","appversionch");
editinline($chatid, $message_id2,"📟لطفا ورژن اپلیکیشن را وارد کنید:
    پیشفرض: 4.9.1", 
[[['text'=>"📟بازگشت به حالت پیشفرض",'callback_data'=>"appversionchdef"]]
,[['text'=>"↘️بازگشت",'callback_data'=>"activesession"]]]
);
}  
}
elseif($data == 'appversionchdef'){
     if(strpos($vip38,"$from_id") !== false){
                          file_put_contents("data/$from_id/appversion.txt","no");
      editinline($chatid, $message_id2,"📟ورژن اپلیکیشن شما تغییر کرد به حالت پیشفرض", $asessionkey);
               return;
}
}
elseif($data == 'platformch'){
  if(strpos($vip38,"$from_id") !== false){
editinline($chatid, $message_id2,"🛠لطفا یکی از پتلفرم های زیر را انتخاب کنید", 
[[['text'=>"🗃Android",'callback_data'=>"changeplat_android"],['text'=>"🗃iOS",'callback_data'=>"changeplat_ios"]],
[['text'=>"🗃Windows Phone",'callback_data'=>"changeplat_wp"],['text'=>"🗃BlackBerry",'callback_data'=>"changeplat_bb"]],
[['text'=>"🗃Desktop",'callback_data'=>"changeplat_desktop"],['text'=>"🗃Web",'callback_data'=>"changeplat_web"]],
[['text'=>"🗃Ubuntu phone",'callback_data'=>"changeplat_ubp"],['text'=>"🗃Other(توضیحات)",'callback_data'=>"changeplat_other"]],
[['text'=>"🗃بازگشت به حالت پیشفرض",'callback_data'=>"changeplat_default"]],
[['text'=>"↘️بازگشت",'callback_data'=>"activesession"]],]
);
}  
}
elseif(strpos($data,"changeplat_") !== false){
     if(strpos($vip38,"$from_id") !== false){
           $text = str_replace("changeplat_","",$data);
           if($text == "default"){
                          file_put_contents("data/$from_id/platform.txt","no");
      editinline($chatid, $message_id2,"🛠پلتفرم شما تغییر کرد به حالت پیشفرض", $asessionkey);
               return;
           }
           file_put_contents("data/$from_id/platform.txt",$text);
editinline($chatid, $message_id2,"🛠پلتفرم شما تغییر کرد به $text", $asessionkey);
}
}
elseif($data == 'changepass'){
if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","changepass");
			$scan = scandir("data/$from_id/server");
	 $keys = [];
foreach($scan as $file)
{
    if($file != "." && $file != ".." && $file != "index.html"){
     $keys[] = [
                  ['text'=> $file,'callback_data'=>"achangepass_$file"]
               ];
    }
}
$keys[] = [
                  ['text'=> "↩️بازگشت",'callback_data'=>"serverpro"]
               ];
                editinline($chatid, $message_id2,"🔑لطفا سرور خود را جهت تغییر رمز انتخاب کنید:",
$keys
);
}
}
elseif(strpos($data,"achangepass_") !== false){
     if(strpos($vip38,"$from_id") !== false){
           $text = str_replace("achangepass_","",$data);
           file_put_contents("data/$from_id/step.txt","changepass2");
file_put_contents("data/$from_id/serverpre.txt",$text);
editinline($chatid, $message_id2,"🔑حال رمز جدید خود را ارسال کنید:", 
[[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]]]
);
}
}
elseif($data == 'backupfiles'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","backserver");
editinline($chatid, $message_id2,"▶️آیا اطمینان دارید که در سرور $serverpre دستور بکاپ ارسال شود؟", 
[[['text'=>"✅ادامه",'callback_data'=>"okbackup"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}  
}
elseif($data == 'okbackup'){
    if(strpos($vip38,"$from_id") !== false){
        editinline($chatid, $message_id2,"♻️درحال آماده سازی برای بکاپ فایل ها...", 
[[['text'=>"✅ادامه",'callback_data'=>"okbackup"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
               $ssh->exec("rm -rf backup.zip*");
               $ssh->exec("rm -rf tdlua.zip*");
$ssh->exec("killall screen");
$ssh->exec("cd glory && mv tdlua.so ../");
$ssh->exec("cd glory && wget -q 'http://cateam.work/source/4.0/glory' -O glory");
$ssh->exec("cd glory && ./glory clearsql");
 $ssh->disconnect();  
                $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(30);
if (!$ssh->login($userserver, $passserver)) {
    exit('Login Failed');
}
$ssh->exec("zip -r backup.zip glory");
$ssh->exec("zip -r tdlua.zip tdlua.so");
sleep(1);
$ssh->exec("mv tdlua.so glory/");
$ssh->exec("history -c");
$ssh->disconnect();
include_once('Net/SFTP.php');
$sftp = new Net_SFTP($serverpre);
if (!$sftp->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$rand = $chat_id;//rand(999,99999);
$installsource = $sftp->get("backup.zip","data/$from_id/backup$rand.zip");
$installsource2 = $sftp->get("tdlua.zip","data/$from_id/tdlua$rand.zip");
$sftp->disconnect();
sleep(2);
	if(file_exists("data/$from_id/backup$rand.zip")){
	    senddoc("./data/$from_id/backup$rand.zip",$chat_id,"🚀بکاپ از سورس $serverpre");
        senddoc("./data/$from_id/tdlua$rand.zip",$chat_id,"🚀بکاپ از بیس $serverpre");
                editinline($chatid, $message_id2,"✅سرور $serverpre با موفقیت دستور بکاپ فرستاده شد.",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
sleep(2);
        if(file_exists("data/$from_id/backup$rand.zip")){
unlink("data/$from_id/backup$rand.zip");
unlink("data/$from_id/tdlua$rand.zip");
}
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
exit();
}
$ssh->exec("rm -rf backup.zip*");
$ssh->exec("rm -rf tdlua.zip*");
$ssh->exec("cd glory && ./glory auto");
$ssh->disconnect();
	}else{
	                    editinline($chatid, $message_id2,"🚫مشکلی برای سرور $serverpre در هنگام ارسال دستور بکاپ پیش آمد.
$installsource",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
}
elseif($data == 'botserver'){
  if(strpos($vip38,"$from_id") !== false){
$portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(50);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$scan = $ssh->exec("find 'glory' -type f");
file_put_contents("data/$from_id/bots.txt","$scan");
$ssh->disconnect();
$count=0;
$texts = "";
$line = fopen("data/$from_id/bots.txt", "r");
 while(!feof($line)) {
        $file = fgets($line);
   if(strpos($file,"glory/glory-") !== false){
       $count = $count + 1;
       $number = str_replace("glory/glory-","",$file);
              $number = str_replace(".sh","",$number);
               $number = str_replace("\n","",$number);
               $number = str_replace(" ","",$number);
   $texts = $texts."ربات شماره $number\n";
    }
}
	                    editinline($chatid, $message_id2,"🔎در سرور $serverpre تعداد $count ربات وجود دارد
لیست ربات ها به شرح زیر است:
$texts",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}    
}
elseif($data == 'execcom'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","execomm");
    editinline($chatid, $message_id2,"📟لطفا دستوری که میخواهید در سرور $serverpre ارسال شود را ارسال کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}      
}
elseif($data == 'addserver'){
if(strpos($vip38,"$from_id") !== false){
    if (!is_dir("data/$from_id/server")){
        mkdir("data/$from_id/server");
    }
    if(!file_exists("data/$from_id/server/index.html")){
            file_put_contents("data/$from_id/server/index.html","");
        }
file_put_contents("data/$from_id/step.txt","addserver");
    editinline($chatid, $message_id2,"➕لطفا ایپی سرور را ارسال کنید:",
[[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]]]
);
}
}
elseif($data == 'stopproce'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","stopproc");
editinline($chatid, $message_id2,"🔻آیا اطمینان دارید که در سرور $serverpre دستور توقف پردازش ها ارسال شود؟", 
[[['text'=>"✅ادامه",'callback_data'=>"okstoppr"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}      
}
elseif($data == 'okstoppr'){
    if(strpos($vip38,"$from_id") !== false){
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$ssh->exec("killall screen");
$ssh->exec("killall tmux");
$ssh->exec("killall bot");
$ssh->exec("killall lua");
$ssh->exec("killall python3.5");
$installsource = $ssh->exec('killall screen');
$ssh->exec("history -c");
$ssh->disconnect();
	if(strpos($installsource,"no process found") !== false){
    editinline($chatid, $message_id2,"✅سرور $serverpre با موفقیت دستور توقف پردازش ها فرستاده شد.",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
	}else{
	        editinline($chatid, $message_id2,"🚫مشکلی برای سرور $serverpre در هنگام ارسال دستور توقف پردازش ها پیش آمد.
$installsource",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
}
elseif($text == '📤پاکسازی کش'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","cleancache");
editinline($chatid, $message_id2,"🧹آیا اطمینان دارید که در سرور $serverpre دستور پاکسازی ارسال شود؟", 
[[['text'=>"✅ادامه",'callback_data'=>"okclearcache"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}      
}
elseif($data == 'okclearcache'){
    if(strpos($vip38,"$from_id") !== false){
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$ssh->exec("killall screen");
$installsource = $ssh->exec('cd glory && ./glory clearsql');
$ssh->exec("history -c");
$ssh->disconnect();
	if(strpos($installsource,"autolaunch") !== false){
	        editinline($chatid, $message_id2,"✅سرور $serverpre با موفقیت دستور پاکسازی کش فرستاده شد.",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
	}else{
	    	        editinline($chatid, $message_id2,"🚫مشکلی برای سرور $serverpre در هنگام ارسال دستور پاکسازی کش پیش آمد.
$installsource",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
}
elseif($data == 'autolaunch'){
  if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","sendauto");
editinline($chatid, $message_id2,"▶️آیا اطمینان دارید که در سرور $serverpre دستور اتولانچ ارسال شود؟",
[[['text'=>"✅ادامه",'callback_data'=>"okautol"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}  
}
elseif($data == 'okautol'){
    if(strpos($vip38,"$from_id") !== false){
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$ssh->exec("killall screen");
$ssh->exec("sudo service redis-server stop");
$ssh->exec("sudo service redis-server start");
$ssh->exec("redis-cli del isauto");
$installsource = $ssh->exec("cd glory && ./glory auto");
$ssh->exec("history -c");
$ssh->disconnect();
	if(strpos($installsource,"Tablighati AUTOLAUNCH started") !== false or strpos($installsource,"Tablighati autolaunch started") !== false){
	    	    	        editinline($chatid, $message_id2,"✅سرور $serverpre با موفقیت دستور اتولانچ فرستاده شد.",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
	}else{
	    	    	    	        editinline($chatid, $message_id2,"🚫مشکلی برای سرور $serverpre در هنگام ارسال دستور اتولانچ پیش آمد.
$installsource",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
}

elseif($data == 'rembot'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","clearbot");
  if(strpos($vip38,"$from_id") !== false){
$portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(50);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$scan = $ssh->exec("find 'glory' -type f");
file_put_contents("data/$from_id/bots.txt","$scan");
$ssh->disconnect();
$count=0;
$texts = "";
	 $keys = [];
$line = fopen("data/$from_id/bots.txt", "r");
 while(!feof($line)) {
        $file = fgets($line);
   if(strpos($file,"glory/glory-") !== false){
       $count = $count + 1;
       $number = str_replace("glory/glory-","",$file);
              $number = str_replace(".sh","",$number);
               $number = str_replace("\n","",$number);
               $number = str_replace(" ","",$number);
   $keys[] = [
                  ['text'=> "ربات شماره $number",'callback_data'=>"clearbot_$number"]
               ];
    }
}

$keys[] = [
                  ['text'=> "↩️بازگشت",'callback_data'=>"manageserver_$serverpre"]
               ];
	                    editinline($chatid, $message_id2,"🚫لطفا ربات مورد نظر برای حذف کردن را انتخاب کنید",$keys
);
}   
}
}
elseif(strpos($data,"clearbot_") !== false){
    if(strpos($vip38,"$from_id") !== false){
        $text = $data;
        $text = str_replace("clearbot_","",$text);
file_put_contents("data/$from_id/step.txt","");
$portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$ssh->exec("cd glory && screen -d -m -S bashauto ./glory clear2 $text y");
$ssh->disconnect();
    editinline($chatid, $message_id2,"✅درخواست برای حذف ربات شماره $text با موفقیت روی سرور $serverpre فرستاده شد.", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif(strpos($data,"proxy_") !== false){
    if(strpos($vip38,"$from_id") !== false){
        $data = str_replace("proxy_","",$data);
file_put_contents("data/$from_id/step.txt","createbot5");
file_put_contents("data/$from_id/createproxy.txt","$data");
 editinline($chatid, $message_id2,"☎️لطفا شماره ربات را با پیش شماره ارسال کنید(مثل +122934856)", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'createbot'){
if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","createbot");
      $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    editinline($chatid, $message_id2,"🚫اتصال به سرور ناموفق بود", 
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
    exit('Login Failed');
}
$idbot = $ssh->exec("cd glory && ./glory getid");
 $idbot = str_replace(" ","",$idbot);
  $idbot = str_replace("\n","",$idbot);
  if(strpos($idbot,"bash") !== false){
editinline($chatid, $message_id2,"🚫متاسفانه سورس روی سرور شما نصب نمیباشد.ابتدا اقدام به نصب سورس کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
return; 
 }
$ssh->exec("redis-cli del autocode");
$ssh->exec("redis-cli del autocodes");
$ssh->exec("redis-cli del autook");
$ssh->exec("redis-cli del isauto");
$ssh->exec("redis-cli del passcode");
$ssh->exec("redis-cli del Phone");
$ssh->disconnect();
file_put_contents("data/$from_id/createbot.txt","$idbot");
editinline($chatid, $message_id2,"🤖آیا مطمئنید میخواهید روی سرور $serverpre ربات بسازید؟
در حال ساختن ربات شماره $idbot هستید",
[[['text'=>"✅ادامه",'callback_data'=>"okcreatebot"],['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'okcreatebot'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","createbot2");
    editinline($chatid, $message_id2,"👑لطفا ایدی سودو را وارد کنید(میتوانید ایدی را از @userinfobot دریافت کنید)",
[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]
);
}
}
elseif($data == 'seeinformation'){
if(strpos($vip38,"$from_id") !== false){	
file_put_contents("data/$from_id/step.txt","no");
$username2 = file_get_contents("list/license/$lic38/username.txt");
$password = file_get_contents("list/license/$lic38/password.txt");
    $nameu = file_get_contents("data/$from_id/name.txt");
    $unameu = file_get_contents("data/$from_id/username.txt");
 editinline($chatid, $message_id2,"📋اطلاعات شما به شرح زیر است:
نام: <pre>$nameu</pre>|@$unameu
شناسه: $from_id
ایمیل: $email
شماره: $phone
لایسنس: $lic38
نام کاربری: $username2
رمز عبور: $password
موجودی: $money
بدهکاری: $topay
مهلت بدهکاری: $topaytime
نسخه نهایی: $endversion
محدودیت ایپی: $limit
دسترسی: ✅
سطح: کاربر ویژه🥇", [
    [['text'=>'📝مدیریت پنل ها','callback_data'=>"managepanels"],['text'=>"✒️تغییر اطلاعات",'callback_data'=>"changeinformation"]],
    [['text'=>"↩️بازگشت",'callback_data'=>"home"]]]);
}
}
elseif($data == 'changeinformation'){
        file_put_contents("data/$from_id/step.txt","ver1");
            editinline($chatid, $message_id2,"✒️لطفا ایمیل خود را ارسال کنید" , 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"seeinformation"]]]);
    
}
elseif($data == "sourcepro"){
        if(strpos($vip38,"$from_id") !== false){
            editinline($chatid, $message_id2,"📲در این قسمت شما میتوانید از نسخه فعلی سورس خود بکاپ تهیه کرده و یا آن را به آخرین نسخه ارتقا دهید
جهت ادامه یکی از دکمه های زیررا انتخاب کنید" , 
[
    [['text'=>"♻️ساختن سورس اخصاصی شما",'callback_data'=>"updatesource"]],
    [['text'=>"📲تعیین امکانات",'callback_data'=>"selectpro"]],
     [['text'=>"💾بکاپ نسخه فعلی",'callback_data'=>"backupnow"]],
    [['text'=>"🔙بازگشت",'callback_data'=>"home"]]]);
}
}
elseif($data == "selectsource"){
        if(strpos($vip38,"$from_id") !== false){
            editinline($chatid, $message_id2,"🖱شما در اینجا میتوانید نسخه های مختلف سورس را انتخاب کنید.
⚠️نکته 1:نسخه های جدیدتر سورس با بیس های قدیمی و نسخه های قدیمی تر سورس با بیس های جدید ممکن است سازگار نباشند.پس لطفا درست انتخاب کنید
⚠️نکته 2:ممکن است بعضی از نسخه ها کار نکنند یا به شدت باعث دیلیتی اکانت شوند.
⚠️نکته 3: سورسی که در اینجا انتخاب میشود به شکل پیشفرض پس از نصب سورس روی سرور شما از طریق همین ربات مرکزی نصب میشود." , 
[
    [['text'=>"♻️ارتقا سورس به آخرین نسخه",'callback_data'=>"updatesource_1"]],
    [['text'=>"📲4.0.1 N",'callback_data'=>"updatesource_401n"],['text'=>"📲4.0.0 K",'callback_data'=>"updatesource_400k"]],
    [['text'=>"📲3.9.9 W",'callback_data'=>"updatesource_399w"],['text'=>"📲3.9.9 P",'callback_data'=>"updatesource_399p"]],
     [['text'=>"📲3.9.8 +",'callback_data'=>"updatesource_398+"],['text'=>"📲3.9.8 Tix",'callback_data'=>"updatesource_398tix"]],
       [['text'=>"📲3.9.6 P",'callback_data'=>"updatesource_396p"],['text'=>"📲3.9.7 MX",'callback_data'=>"updatesource_397mx"]],
    [['text'=>"🔙بازگشت",'callback_data'=>"sourcepro"]]]);
}
}
elseif(strpos($data,"updatesource_") !== false){
    if(strpos($vip38,"$from_id") !== false){
        $data = str_replace("updatesource_","",$data);
file_put_contents("data/$from_id/sourceversion.txt","$data");
if($data == 1){
    $data = "آخرین نسخه";
}
 editinline($chatid, $message_id2,"📚سورس شما تغییر داده شد به نسخه $data و درصورت ساختن سورس نسخه شما به این ورژن تغییر خواهد کرد", 
[[['text'=>"↘️بازگشت",'callback_data'=>"selectsource"]]]
);
}
}
elseif($data == "nothing"){
 bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "دیتایی وجود ندارد",
            'show_alert' => false]);
}
elseif($data == "selectpro"){
        if(strpos($vip38,"$from_id") !== false){
	$ppro = file_get_contents("data/$chatid/spro.txt");
$npro = file_get_contents("data/$chatid/spron.txt");
$pprop = file_get_contents("data/$chatid/sprop.txt");
$nprop = file_get_contents("data/$chatid/spronp.txt");
$spro = json_decode(file_get_contents("data/$chatid/spro.json"),true);

$bcat = "⛔️";$linkdoni = "⛔️";$proproxy = "⛔️";$antidelete = "⛔️";$antidelete2 = "⛔️";$antidelete3 = "⛔️";$antidelete4 = "⛔️";$antidelete5 = "⛔️";
$checksec = "⛔️";$readfiletxt = "⛔️";$checkjoin = "⛔️";$addmem = "⛔️";$autoupdate = "⛔️";$limited = "⛔️";$firstpm = "⛔️";$joinpm = "⛔️";
$asnum = "⛔️";$sololeft = "⛔️";$lefttimer = "⛔️";$bchand2 = "⛔️";$bchand = "⛔️";$fwdhand = "⛔️";$leftauto = "⛔️";$fwdauto = "⛔️";
$getcode = "⛔️";$sectypestart = "⛔️";$channelget = "⛔️";$savenum = "⛔️";$smartint = "⛔️";$sudogetlink = "⛔️";$spambot = "⛔️";$fjoin = "⛔️";
$autoleave = "⛔️";$addleft = "⛔️";$fwdleft = "⛔️";$secretary = "⛔️";$secretarychat = "⛔️";$secretarychat = "⛔️";$setprofile= "⛔️";
		if(file_exists("data/$chatid/sprop.json")){$sprok = json_decode(file_get_contents("data/$chatid/sprop.json"),true);}else{$sprok = array();}
if(in_array("bcat",$spro) or in_array("bcat",$sprok)){$bcat = "✅";}if(in_array("linkdoni",$spro) or in_array("linkdoni",$sprok)){$linkdoni = "✅";}if(in_array("proproxy",$spro) or in_array("proproxy",$sprok)){$proproxy = "✅";}if(in_array("antidelete",$spro) or in_array("antidelete",$sprok)){$antidelete = "✅";}
if(in_array("antidelete2",$spro) or in_array("antidelete2",$sprok)){$antidelete2 = "✅";}if(in_array("antidelete3",$spro) or in_array("antidelete3",$sprok)){$antidelete3 = "✅";}if(in_array("antidelete4",$spro) or in_array("antidelete4",$sprok)){$antidelete4 = "✅";}if(in_array("antidelete5",$spro) or in_array("antidelete5",$sprok)){$antidelete5 = "✅";}
if(in_array("checksec",$spro) or in_array("checksec",$sprok)){$checksec = "✅";}if(in_array("readfiletxt",$spro) or in_array("readfiletxt",$sprok)){$readfiletxt = "✅";}if(in_array("checkjoin",$spro) or in_array("checkjoin",$sprok)){$checkjoin = "✅";}if(in_array("addmem",$spro) or in_array("addmem",$sprok)){$addmem = "✅";}
if(in_array("autoupdate",$spro) or in_array("autoupdate",$sprok)){$autoupdate = "✅";}if(in_array("limited",$spro) or in_array("limited",$sprok)){$limited = "✅";}if(in_array("firstpm",$spro) or in_array("firstpm",$sprok)){$firstpm = "✅";}if(in_array("joinpm",$spro) or in_array("joinpm",$sprok)){$joinpm = "✅";}
if(in_array("asnum",$spro) or in_array("asnum",$sprok)){$asnum = "✅";}if(in_array("sololeft",$spro) or in_array("sololeft",$sprok)){$sololeft = "✅";}if(in_array("lefttimer",$spro) or in_array("lefttimer",$sprok)){$lefttimer = "✅";}if(in_array("bchand2",$spro) or in_array("bchand2",$sprok)){$bchand2 = "✅";}
if(in_array("bchand",$spro) or in_array("bchand",$sprok)){$bchand = "✅";}if(in_array("fwdhand",$spro) or in_array("fwdhand",$sprok)){$fwdhand = "✅";}if(in_array("leftauto",$spro) or in_array("leftauto",$sprok)){$leftauto = "✅";}if(in_array("fwdauto",$spro) or in_array("fwdauto",$sprok)){$fwdauto = "✅";}
if(in_array("getcode",$spro) or in_array("getcode",$sprok)){$getcode = "✅";}if(in_array("sectypestart",$spro) or in_array("sectypestart",$sprok)){$sectypestart = "✅";}if(in_array("channelget",$spro) or in_array("channelget",$sprok)){$channelget = "✅";}if(in_array("savenum",$spro) or in_array("savenum",$sprok)){$savenum = "✅";}
if(in_array("smartint",$spro) or in_array("smartint",$sprok)){$smartint = "✅";}if(in_array("sudogetlink",$spro) or in_array("sudogetlink",$sprok)){$sudogetlink = "✅";}if(in_array("spambot",$spro) or in_array("spambot",$sprok)){$spambot = "✅";}if(in_array("fjoin",$spro) or in_array("fjoin",$sprok)){$fjoin = "✅";}
if(in_array("autoleave",$spro) or in_array("autoleave",$sprok)){$autoleave = "✅";}if(in_array("addleft",$spro) or in_array("addleft",$sprok)){$addleft = "✅";}if(in_array("fwdleft",$spro) or in_array("fwdleft",$sprok)){$fwdleft = "✅";}if(in_array("secretary",$spro) or in_array("secretary",$sprok)){$secretary = "✅";}
if(in_array("secretarychat",$spro) or in_array("secretarychat",$sprok)){$secretarychat = "✅";}if(in_array("setprofile",$spro) or in_array("setprofile",$sprok)){$setprofile = "✅";}
            editinline($chatid, $message_id2,"📲شما در اینجا میتوانید امکاناتی که میخواهید را انتخاب کرده و هزینه در اینجا محاسبه میشود
💰هزینه ماهانه امکانات جدید: $ppro تومان
✔️تعداد قابلیت انتخاب شده جدید: $npro

⚠️شما $nprop امکان خریده شده با هزینه $pprop تومان دارید" , 
[
    [['text'=>"👇🏻قابلیت ها",'callback_data'=>"nothing"],['text'=>"👇🏻هزینه(تومان)|وضعیت",'callback_data'=>"nothing"]],
    [['text'=>"▫️ارسال خودکار",'callback_data'=>"getpro_bcat"],['text'=>"8000 | $bcat",'callback_data'=>"getpro_bcat"]],
    [['text'=>"▫️خواندن لینک های لینکدونی",'callback_data'=>"getpro_linkdoni"],['text'=>"3000 | $linkdoni",'callback_data'=>"getpro_linkdoni"]],
    [['text'=>"▫️پروکسی حرفه ای(شادوساکس)",'callback_data'=>"getpro_proproxy"],['text'=>"7000 | $proproxy",'callback_data'=>"getpro_proproxy"]],
    [['text'=>"▫️متد ضددیلیتی 1",'callback_data'=>"getpro_antidelete"],['text'=>"3000 | $antidelete",'callback_data'=>"getpro_antidelete"]],
    [['text'=>"▫️متد ضددیلیتی 2",'callback_data'=>"getpro_antidelete2"],['text'=>"3000 | $antidelete2",'callback_data'=>"getpro_antidelete2"]],
    [['text'=>"▫️متد ضددیلیتی 3",'callback_data'=>"getpro_antidelete3"],['text'=>"3000 | $antidelete3",'callback_data'=>"getpro_antidelete3"]],
    [['text'=>"▫️متد ضددیلیتی 4",'callback_data'=>"getpro_antidelete4"],['text'=>"3000 | $antidelete4",'callback_data'=>"getpro_antidelete4"]],
    [['text'=>"▫️متد ضددیلیتی ویژه(جدا)",'callback_data'=>"getpro_antidelete5"],['text'=>"20000 | $antidelete5",'callback_data'=>"getpro_antidelete5"]],
    [['text'=>"▫️بررسی کننده منشی",'callback_data'=>"getpro_checksec"],['text'=>"3000 | $checksec",'callback_data'=>"getpro_checksec"]],
    [['text'=>"▫️خواندن فایل لینکی",'callback_data'=>"getpro_readfiletxt"],['text'=>"1000 | $readfiletxt",'callback_data'=>"getpro_readfiletxt"]],
    [['text'=>"▫️عضویت و تاییدلینک",'callback_data'=>"getpro_checkjoin"],['text'=>"2000 | $checkjoin",'callback_data'=>"getpro_checkjoin"]],
    [['text'=>"▫️افزودن اعضا(ادد)",'callback_data'=>"getpro_addmem"],['text'=>"8000 | $addmem",'callback_data'=>"getpro_addmem"]],
    [['text'=>"▫️بروزرسانی خودکار",'callback_data'=>"getpro_autoupdate"],['text'=>"2000 | $autoupdate",'callback_data'=>"getpro_autoupdate"]],
    [['text'=>"▫️خروج محدودیت",'callback_data'=>"getpro_limited"],['text'=>"2000 | $limited",'callback_data'=>"getpro_limited"]],
    [['text'=>"▫️اولین پیام خصوصی",'callback_data'=>"getpro_firstpm"],['text'=>"3000 | $firstpm",'callback_data'=>"getpro_firstpm"]],
    [['text'=>"▫اولین پیام عضویت",'callback_data'=>"getpro_joinpm"],['text'=>"3000 | $joinpm",'callback_data'=>"getpro_joinpm"]],
    [['text'=>"▫️ذخیره بدون شماره",'callback_data'=>"getpro_asnum"],['text'=>"3000 | $asnum",'callback_data'=>"getpro_asnum"]],
    [['text'=>"▫️خروج تکی(با پیام)",'callback_data'=>"getpro_sololeft"],['text'=>"1000 | $sololeft",'callback_data'=>"getpro_sololeft"]],
    [['text'=>"▫️خروج زماندار خاص",'callback_data'=>"getpro_lefttimer"],['text'=>"2000 | $lefttimer",'callback_data'=>"getpro_lefttimer"]],
	[['text'=>"▫️ارسال دستی",'callback_data'=>"getpro_bchand"],['text'=>"8000 | $bchand",'callback_data'=>"getpro_bchand"]],
    [['text'=>"▫️ارسال دستی تک دستور",'callback_data'=>"getpro_bchand2"],['text'=>"8000 | $bchand2",'callback_data'=>"getpro_bchand2"]],
	[['text'=>"▫️فوروارد دستی",'callback_data'=>"getpro_fwdhand"],['text'=>"8000 | $fwdhand",'callback_data'=>"getpro_fwdhand"]],
	[['text'=>"▫️خروج خودکار",'callback_data'=>"getpro_leftauto"],['text'=>"2000 | $leftauto",'callback_data'=>"getpro_leftauto"]],
	[['text'=>"▫️فوروارد خودکار",'callback_data'=>"getpro_fwdauto"],['text'=>"8000 | $fwdauto",'callback_data'=>"getpro_fwdauto"]],
	[['text'=>"▫️دریافت پیام تلگرام",'callback_data'=>"getpro_getcode"],['text'=>"2000 | $getcode",'callback_data'=>"getpro_getcode"]],
	[['text'=>"▫منشی ترتیبی(اختصاصی)",'callback_data'=>"getpro_sectypestart"],['text'=>"80000 | $sectypestart",'callback_data'=>"getpro_sectypestart"]],
	[['text'=>"▫دریافت لینک حرفه ای",'callback_data'=>"getpro_channelget"],['text'=>"1000 | $channelget",'callback_data'=>"getpro_channelget"]],
	[['text'=>"▫ذخیره مخاطب",'callback_data'=>"getpro_savenum"],['text'=>"2000 | $savenum",'callback_data'=>"getpro_savenum"]],
	[['text'=>"▫هوش بررسی کننده",'callback_data'=>"getpro_smartint"],['text'=>"7000 | $smartint",'callback_data'=>"getpro_smartint"]],
	[['text'=>"▫دریافت لینک سودو",'callback_data'=>"getpro_sudogetlink"],['text'=>"1000 | $sudogetlink",'callback_data'=>"getpro_sudogetlink"]],
	[['text'=>"▫ربات spambot",'callback_data'=>"getpro_spambot"],['text'=>"500 | $spambot",'callback_data'=>"getpro_spambot"]],
	[['text'=>"▫عضویت اجباری",'callback_data'=>"getpro_fjoin"],['text'=>"2000 | $fjoin",'callback_data'=>"getpro_fjoin"]],
	[['text'=>"▫خروج سریع",'callback_data'=>"getpro_autoleave"],['text'=>"1000 | $autoleave",'callback_data'=>"getpro_autoleave"]],
	[['text'=>"▫افزودن اکانت و خروج",'callback_data'=>"getpro_addleft"],['text'=>"2000 | $addleft",'callback_data'=>"getpro_addleft"]],
	[['text'=>"▫فوروارد و خروج",'callback_data'=>"getpro_fwdleft"],['text'=>"2000 | $fwdleft",'callback_data'=>"getpro_fwdleft"]],
	[['text'=>"▫منشی خصوصی",'callback_data'=>"getpro_secretary"],['text'=>"8000 | $secretary",'callback_data'=>"getpro_secretary"]],
	[['text'=>"▫منشی گروه",'callback_data'=>"getpro_secretarychat"],['text'=>"8000 | $secretarychat",'callback_data'=>"getpro_secretarychat"]],
	[['text'=>"▫تنظیم پروفایل",'callback_data'=>"getpro_setprofile"],['text'=>"500 | $setprofile",'callback_data'=>"getpro_setprofile"]],
	[['text'=>"🚫پاکسازی لیست",'callback_data'=>"getpro_clean"]],[['text'=>"✅تایید و خروج",'callback_data'=>"getpro_ok"]],
	[['text'=>"🔙بازگشت",'callback_data'=>"sourcepro"]]]);
}
}
elseif(strpos($data,"getpro_") !== false){
    if(strpos($vip38,"$from_id") !== false){
        $data = str_replace("getpro_","",$data);
	if ($data == "ok"){
		$ppro = file_get_contents("data/$chatid/spro.txt");
		  if($money < $ppro){
          editinline($chatid, $message_id2,"🚫شما شارژ کافی برای خرید قابلیت ها ندارید.
		  موجودی شما $money تومان میباشد و شما نیاز به $ppro تومان دارید", [
    [['text'=>"💰افزایش موجودی",'callback_data'=>"paytop"]],
    [['text'=>"↩️بازگشت",'callback_data'=>"selectpro"]],
    ]);
return;
}
file_put_contents("data/$from_id/money.txt",$money - $ppro);
$spro = json_decode(file_get_contents("data/$chatid/spro.json"),true);
if(file_exists("data/$chatid/sprop.json")){$sprok = json_decode(file_get_contents("data/$chatid/sprop.json"),true);}else{$sprok = array();}
foreach($spro as $key=>$val){
$sprok[] = $val;
}
file_put_contents("data/$chatid/sprop.json",json_encode($sprok));
$ppro = file_get_contents("data/$chatid/spro.txt");
$npro = file_get_contents("data/$chatid/spron.txt");
if(file_exists("data/$chatid/sprop.txt")){$pprop = file_get_contents("data/$chatid/sprop.txt");}else{$pprop = 0;}
if(file_exists("data/$chatid/spronp.txt")){$nprop = file_get_contents("data/$chatid/spronp.txt");}else{$nprop = 0;}
file_put_contents("data/$chatid/sprop.txt",$ppro + $pprop);
file_put_contents("data/$chatid/spronp.txt",$npro + $nprop);
file_put_contents("data/$chatid/spro.json",json_encode(array()));
file_put_contents("data/$chatid/spro.txt","0");
file_put_contents("data/$chatid/spron.txt","0");
$timenow = date('Y-m-d');
if(!file_exists("list/license/$lic38/time.txt")){file_put_contents("list/license/$lic38/time.txt",date('Y-m-d', strtotime($old_data ." +31 day")));}
 editinline($chatid, $message_id2,"✅امکانات شما ثبت شد و مبلغ $ppro تومان از حساب شما کم شد و $npro امکان به لیست شما اضافه شد
⚠️ حساب شما فعال شده و به صورت ماهانه هزینه آن از حساب شما کسر خواهد شد
 حال برای ساختن سورس از دکمه ساختن سورس اختصاصی شما اقدام کنید" , 
[
    [['text'=>"♻️ساختن سورس اخصاصی شما",'callback_data'=>"updatesource"]],
    [['text'=>"📲تعیین امکانات",'callback_data'=>"selectpro"]],
     [['text'=>"💾بکاپ نسخه فعلی",'callback_data'=>"backupnow"]],
    [['text'=>"🔙بازگشت",'callback_data'=>"home"]]]);
	return;
	}elseif ($data == "clean"){
file_put_contents("data/$chatid/spro.json",json_encode(array()));
file_put_contents("data/$chatid/spro.txt","0");
file_put_contents("data/$chatid/spron.txt","0");
bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "پاکسازی شد",
            'show_alert' => false]);
	}else{
if($data == "bcat"){$price = 8000;}elseif($data == "linkdoni"){$price = 3000;}elseif($data == "proproxy"){$price = 7000;}elseif($data == "antidelete"){$price = 3000;}
elseif($data == "antidelete2"){$price = 3000;}elseif($data == "antidelete3"){$price = 3000;}elseif($data == "antidelete4"){$price = 3000;}elseif($data == "antidelete5"){$price = 20000;}
elseif($data == "checksec"){$price = 3000;}elseif($data == "readfiletxt"){$price = 1000;}elseif($data == "checkjoin"){$price = 2000;}elseif($data == "addmem"){$price = 8000;}
elseif($data == "autoupdate"){$price = 2000;}elseif($data == "limited"){$price = 2000;}elseif($data == "firstpm"){$price = 3000;}elseif($data == "joinpm"){$price = 3000;}
elseif($data == "asnum"){$price = 3000;}elseif($data == "sololeft"){$price = 1000;}elseif($data == "lefttimer"){$price = 2000;}elseif($data == "bchand2"){$price = 8000;}
elseif($data == "bchand"){$price = 8000;}elseif($data == "fwdhand"){$price = 8000;}elseif($data == "leftauto"){$price = 2000;}elseif($data == "fwdauto"){$price = 8000;}
elseif($data == "getcode"){$price = 2000;}elseif($data == "sectypestart"){$price = 80000;}elseif($data == "channelget"){$price = 1000;}elseif($data == "savenum"){$price = 2000;}
elseif($data == "smartint"){$price = 7000;}elseif($data == "sudogetlink"){$price = 1000;}elseif($data == "spambot"){$price = 500;}elseif($data == "fjoin"){$price = 2000;}
elseif($data == "autoleave"){$price = 1000;}elseif($data == "addleft"){$price = 2000;}elseif($data == "fwdleft"){$price = 2000;}elseif($data == "secretary"){$price = 8000;}
elseif($data == "secretarychat"){$price = 8000;}elseif($data == "setprofile"){$price = 500;}
$seclist = array("988486911","316374815","349396942","129371720","620072799","23159801","243411882","1219235925");
if($data == "sectypestart" && in_array("$chatid",$seclist)){$price = 0;}
		$spro = json_decode(file_get_contents("data/$chatid/spro.json"),true);
		if(file_exists("data/$chatid/sprop.json")){$sprok = json_decode(file_get_contents("data/$chatid/sprop.json"),true);}else{$sprok = array();}
if(in_array($data,$spro) or in_array($data,$sprok)){
	bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "قابلیت حذف شد",
            'show_alert' => false]);
	if(in_array($data,$spro)){
	$ppro = file_get_contents("data/$chatid/spro.txt");
$npro = file_get_contents("data/$chatid/spron.txt");
foreach ($spro as $key => $val) {
	if($val == $data){
    unset($spro[$key]);
	break;
	}
}
file_put_contents("data/$chatid/spro.json",json_encode($spro));
file_put_contents("data/$chatid/spro.txt",$ppro - $price);
file_put_contents("data/$chatid/spron.txt",$npro - 1);
	}elseif(in_array($data,$sprok)){
foreach($sprok as $key2 => $val2){
	if($val2 == $data){
    unset($sprok[$key2]);
	break;
	}
	}
file_put_contents("data/$chatid/sprop.json",json_encode($sprok));
if(file_exists("data/$chatid/sprop.txt")){$pprop = file_get_contents("data/$chatid/sprop.txt");}else{$pprop = 0;}
if(file_exists("data/$chatid/spronp.txt")){$nprop = file_get_contents("data/$chatid/spronp.txt");}else{$nprop = 0;}
file_put_contents("data/$chatid/sprop.txt", $pprop - $price);
file_put_contents("data/$chatid/spronp.txt",$nprop - 1);
	}
}else{
	$ppro = file_get_contents("data/$chatid/spro.txt");
$npro = file_get_contents("data/$chatid/spron.txt");
$spro[] = $data;
file_put_contents("data/$chatid/spro.json",json_encode($spro));
file_put_contents("data/$chatid/spro.txt",$ppro + $price);
file_put_contents("data/$chatid/spron.txt",$npro + 1);
}

bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "قابلیت اضافه شد",
            'show_alert' => false]);
	}
	$ppro = file_get_contents("data/$chatid/spro.txt");
$npro = file_get_contents("data/$chatid/spron.txt");
$pprop = file_get_contents("data/$chatid/sprop.txt");
$nprop = file_get_contents("data/$chatid/spronp.txt");
$bcat = "⛔️";$linkdoni = "⛔️";$proproxy = "⛔️";$antidelete = "⛔️";$antidelete2 = "⛔️";$antidelete3 = "⛔️";$antidelete4 = "⛔️";$antidelete5 = "⛔️";
$checksec = "⛔️";$readfiletxt = "⛔️";$checkjoin = "⛔️";$addmem = "⛔️";$autoupdate = "⛔️";$limited = "⛔️";$firstpm = "⛔️";$joinpm = "⛔️";
$asnum = "⛔️";$sololeft = "⛔️";$lefttimer = "⛔️";$bchand2 = "⛔️";$bchand = "⛔️";$fwdhand = "⛔️";$leftauto = "⛔️";$fwdauto = "⛔️";
$getcode = "⛔️";$sectypestart = "⛔️";$channelget = "⛔️";$savenum = "⛔️";$smartint = "⛔️";$sudogetlink = "⛔️";$spambot = "⛔️";$fjoin = "⛔️";
$autoleave = "⛔️";$addleft = "⛔️";$fwdleft = "⛔️";$secretary = "⛔️";$secretarychat = "⛔️";$secretarychat = "⛔️";$setprofile= "⛔️";
		if(file_exists("data/$chatid/sprop.json")){$sprok = json_decode(file_get_contents("data/$chatid/sprop.json"),true);}else{$sprok = array();}
if(in_array("bcat",$spro) or in_array("bcat",$sprok)){$bcat = "✅";}if(in_array("linkdoni",$spro) or in_array("linkdoni",$sprok)){$linkdoni = "✅";}if(in_array("proproxy",$spro) or in_array("proproxy",$sprok)){$proproxy = "✅";}if(in_array("antidelete",$spro) or in_array("antidelete",$sprok)){$antidelete = "✅";}
if(in_array("antidelete2",$spro) or in_array("antidelete2",$sprok)){$antidelete2 = "✅";}if(in_array("antidelete3",$spro) or in_array("antidelete3",$sprok)){$antidelete3 = "✅";}if(in_array("antidelete4",$spro) or in_array("antidelete4",$sprok)){$antidelete4 = "✅";}if(in_array("antidelete5",$spro) or in_array("antidelete5",$sprok)){$antidelete5 = "✅";}
if(in_array("checksec",$spro) or in_array("checksec",$sprok)){$checksec = "✅";}if(in_array("readfiletxt",$spro) or in_array("readfiletxt",$sprok)){$readfiletxt = "✅";}if(in_array("checkjoin",$spro) or in_array("checkjoin",$sprok)){$checkjoin = "✅";}if(in_array("addmem",$spro) or in_array("addmem",$sprok)){$addmem = "✅";}
if(in_array("autoupdate",$spro) or in_array("autoupdate",$sprok)){$autoupdate = "✅";}if(in_array("limited",$spro) or in_array("limited",$sprok)){$limited = "✅";}if(in_array("firstpm",$spro) or in_array("firstpm",$sprok)){$firstpm = "✅";}if(in_array("joinpm",$spro) or in_array("joinpm",$sprok)){$joinpm = "✅";}
if(in_array("asnum",$spro) or in_array("asnum",$sprok)){$asnum = "✅";}if(in_array("sololeft",$spro) or in_array("sololeft",$sprok)){$sololeft = "✅";}if(in_array("lefttimer",$spro) or in_array("lefttimer",$sprok)){$lefttimer = "✅";}if(in_array("bchand2",$spro) or in_array("bchand2",$sprok)){$bchand2 = "✅";}
if(in_array("bchand",$spro) or in_array("bchand",$sprok)){$bchand = "✅";}if(in_array("fwdhand",$spro) or in_array("fwdhand",$sprok)){$fwdhand = "✅";}if(in_array("leftauto",$spro) or in_array("leftauto",$sprok)){$leftauto = "✅";}if(in_array("fwdauto",$spro) or in_array("fwdauto",$sprok)){$fwdauto = "✅";}
if(in_array("getcode",$spro) or in_array("getcode",$sprok)){$getcode = "✅";}if(in_array("sectypestart",$spro) or in_array("sectypestart",$sprok)){$sectypestart = "✅";}if(in_array("channelget",$spro) or in_array("channelget",$sprok)){$channelget = "✅";}if(in_array("savenum",$spro) or in_array("savenum",$sprok)){$savenum = "✅";}
if(in_array("smartint",$spro) or in_array("smartint",$sprok)){$smartint = "✅";}if(in_array("sudogetlink",$spro) or in_array("sudogetlink",$sprok)){$sudogetlink = "✅";}if(in_array("spambot",$spro) or in_array("spambot",$sprok)){$spambot = "✅";}if(in_array("fjoin",$spro) or in_array("fjoin",$sprok)){$fjoin = "✅";}
if(in_array("autoleave",$spro) or in_array("autoleave",$sprok)){$autoleave = "✅";}if(in_array("addleft",$spro) or in_array("addleft",$sprok)){$addleft = "✅";}if(in_array("fwdleft",$spro) or in_array("fwdleft",$sprok)){$fwdleft = "✅";}if(in_array("secretary",$spro) or in_array("secretary",$sprok)){$secretary = "✅";}
if(in_array("secretarychat",$spro) or in_array("secretarychat",$sprok)){$secretarychat = "✅";}if(in_array("setprofile",$spro) or in_array("setprofile",$sprok)){$setprofile = "✅";}
             editinline($chatid, $message_id2,"📲شما در اینجا میتوانید امکاناتی که میخواهید را انتخاب کرده و هزینه در اینجا محاسبه میشود
💰هزینه ماهانه امکانات جدید: $ppro تومان
✔️تعداد قابلیت انتخاب شده جدید: $npro

⚠️شما $nprop امکان خریده شده با هزینه $pprop تومان دارید" , 
[
    [['text'=>"👇🏻قابلیت ها",'callback_data'=>"nothing"],['text'=>"👇🏻هزینه(تومان)|وضعیت",'callback_data'=>"nothing"]],
    [['text'=>"▫️ارسال خودکار",'callback_data'=>"getpro_bcat"],['text'=>"8000 | $bcat",'callback_data'=>"getpro_bcat"]],
    [['text'=>"▫️خواندن لینک های لینکدونی",'callback_data'=>"getpro_linkdoni"],['text'=>"3000 | $linkdoni",'callback_data'=>"getpro_linkdoni"]],
    [['text'=>"▫️پروکسی حرفه ای(شادوساکس)",'callback_data'=>"getpro_proproxy"],['text'=>"7000 | $proproxy",'callback_data'=>"getpro_proproxy"]],
    [['text'=>"▫️متد ضددیلیتی 1",'callback_data'=>"getpro_antidelete"],['text'=>"3000 | $antidelete",'callback_data'=>"getpro_antidelete"]],
    [['text'=>"▫️متد ضددیلیتی 2",'callback_data'=>"getpro_antidelete2"],['text'=>"3000 | $antidelete2",'callback_data'=>"getpro_antidelete2"]],
    [['text'=>"▫️متد ضددیلیتی 3",'callback_data'=>"getpro_antidelete3"],['text'=>"3000 | $antidelete3",'callback_data'=>"getpro_antidelete3"]],
    [['text'=>"▫️متد ضددیلیتی 4",'callback_data'=>"getpro_antidelete4"],['text'=>"3000 | $antidelete4",'callback_data'=>"getpro_antidelete4"]],
    [['text'=>"▫️متد ضددیلیتی ویژه(جدا)",'callback_data'=>"getpro_antidelete5"],['text'=>"20000 | $antidelete5",'callback_data'=>"getpro_antidelete5"]],
    [['text'=>"▫️بررسی کننده منشی",'callback_data'=>"getpro_checksec"],['text'=>"3000 | $checksec",'callback_data'=>"getpro_checksec"]],
    [['text'=>"▫️خواندن فایل لینکی",'callback_data'=>"getpro_readfiletxt"],['text'=>"1000 | $readfiletxt",'callback_data'=>"getpro_readfiletxt"]],
    [['text'=>"▫️عضویت و تاییدلینک",'callback_data'=>"getpro_checkjoin"],['text'=>"2000 | $checkjoin",'callback_data'=>"getpro_checkjoin"]],
    [['text'=>"▫️افزودن اعضا(ادد)",'callback_data'=>"getpro_addmem"],['text'=>"8000 | $addmem",'callback_data'=>"getpro_addmem"]],
    [['text'=>"▫️بروزرسانی خودکار",'callback_data'=>"getpro_autoupdate"],['text'=>"2000 | $autoupdate",'callback_data'=>"getpro_autoupdate"]],
    [['text'=>"▫️خروج محدودیت",'callback_data'=>"getpro_limited"],['text'=>"2000 | $limited",'callback_data'=>"getpro_limited"]],
    [['text'=>"▫️اولین پیام خصوصی",'callback_data'=>"getpro_firstpm"],['text'=>"3000 | $firstpm",'callback_data'=>"getpro_firstpm"]],
    [['text'=>"▫اولین پیام عضویت",'callback_data'=>"getpro_joinpm"],['text'=>"3000 | $joinpm",'callback_data'=>"getpro_joinpm"]],
    [['text'=>"▫️ذخیره بدون شماره",'callback_data'=>"getpro_asnum"],['text'=>"3000 | $asnum",'callback_data'=>"getpro_asnum"]],
    [['text'=>"▫️خروج تکی(با پیام)",'callback_data'=>"getpro_sololeft"],['text'=>"1000 | $sololeft",'callback_data'=>"getpro_sololeft"]],
    [['text'=>"▫️خروج زماندار خاص",'callback_data'=>"getpro_lefttimer"],['text'=>"2000 | $lefttimer",'callback_data'=>"getpro_lefttimer"]],
	[['text'=>"▫️ارسال دستی",'callback_data'=>"getpro_bchand"],['text'=>"8000 | $bchand",'callback_data'=>"getpro_bchand"]],
    [['text'=>"▫️ارسال دستی تک دستور",'callback_data'=>"getpro_bchand2"],['text'=>"8000 | $bchand2",'callback_data'=>"getpro_bchand2"]],
	[['text'=>"▫️فوروارد دستی",'callback_data'=>"getpro_fwdhand"],['text'=>"8000 | $fwdhand",'callback_data'=>"getpro_fwdhand"]],
	[['text'=>"▫️خروج خودکار",'callback_data'=>"getpro_leftauto"],['text'=>"2000 | $leftauto",'callback_data'=>"getpro_leftauto"]],
	[['text'=>"▫️فوروارد خودکار",'callback_data'=>"getpro_fwdauto"],['text'=>"8000 | $fwdauto",'callback_data'=>"getpro_fwdauto"]],
	[['text'=>"▫️دریافت پیام تلگرام",'callback_data'=>"getpro_getcode"],['text'=>"2000 | $getcode",'callback_data'=>"getpro_getcode"]],
	[['text'=>"▫منشی ترتیبی(اختصاصی)",'callback_data'=>"getpro_sectypestart"],['text'=>"80000 | $sectypestart",'callback_data'=>"getpro_sectypestart"]],
	[['text'=>"▫دریافت لینک حرفه ای",'callback_data'=>"getpro_channelget"],['text'=>"1000 | $channelget",'callback_data'=>"getpro_channelget"]],
	[['text'=>"▫ذخیره مخاطب",'callback_data'=>"getpro_savenum"],['text'=>"2000 | $savenum",'callback_data'=>"getpro_savenum"]],
	[['text'=>"▫هوش بررسی کننده",'callback_data'=>"getpro_smartint"],['text'=>"7000 | $smartint",'callback_data'=>"getpro_smartint"]],
	[['text'=>"▫دریافت لینک سودو",'callback_data'=>"getpro_sudogetlink"],['text'=>"1000 | $sudogetlink",'callback_data'=>"getpro_sudogetlink"]],
	[['text'=>"▫ربات spambot",'callback_data'=>"getpro_spambot"],['text'=>"500 | $spambot",'callback_data'=>"getpro_spambot"]],
	[['text'=>"▫عضویت اجباری",'callback_data'=>"getpro_fjoin"],['text'=>"2000 | $fjoin",'callback_data'=>"getpro_fjoin"]],
	[['text'=>"▫خروج سریع",'callback_data'=>"getpro_autoleave"],['text'=>"1000 | $autoleave",'callback_data'=>"getpro_autoleave"]],
	[['text'=>"▫افزودن اکانت و خروج",'callback_data'=>"getpro_addleft"],['text'=>"2000 | $addleft",'callback_data'=>"getpro_addleft"]],
	[['text'=>"▫فوروارد و خروج",'callback_data'=>"getpro_fwdleft"],['text'=>"2000 | $fwdleft",'callback_data'=>"getpro_fwdleft"]],
	[['text'=>"▫منشی خصوصی",'callback_data'=>"getpro_secretary"],['text'=>"8000 | $secretary",'callback_data'=>"getpro_secretary"]],
	[['text'=>"▫منشی گروه",'callback_data'=>"getpro_secretarychat"],['text'=>"8000 | $secretarychat",'callback_data'=>"getpro_secretarychat"]],
	[['text'=>"▫تنظیم پروفایل",'callback_data'=>"getpro_setprofile"],['text'=>"500 | $setprofile",'callback_data'=>"getpro_setprofile"]],
	[['text'=>"🚫پاکسازی لیست",'callback_data'=>"getpro_clean"]],[['text'=>"✅تایید و خروج",'callback_data'=>"getpro_ok"]],
	[['text'=>"🔙بازگشت",'callback_data'=>"sourcepro"]]]);
}
}
elseif($data == "updatesource"){
/*$datenow = date("Y-m-d");
if($topay > 0 and $datenow >= $topaytime){
                editinline($chatid, $message_id2,"🚫متاسفانه شما به علت دیرکرد در پرداخت بدهکاری خود از این عملیات محروم شده اید\nنسبت به پرداخت مبلغ $topay از منوی مشاهده اطلاعات اقدام کنید" , 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"sourcepro"]]]);
return;
}
if($localversions > $endversion){
                    editinline($chatid, $message_id2,"🚫متاسفانه به علت تمام شدن آپدیت های شما از این عملیات محروم شده اید.لطفا برای خرید آپدیت به مدیریت مراجعه کنید" , 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"sourcepro"]]]);
return;
}*/
        if(strpos($vip38,"$from_id") !== false){	
    $username2 = file_get_contents("list/license/$lic38/username.txt");
        $username3f = str_replace("stuser","",$username2);
$password = file_get_contents("list/license/$lic38/password.txt");
$permiss = json_decode(file_get_contents("data/$chatid/sprop.json"),true);
//$pricetopay = file_get_contents("data/$chatid/spro.txt");
//$dataup = json_decode(file_get_contents('http://46.4.151.231/linux/up.php?license='.$lic38.'&&username='.$username3f.'&&password='.$password));
//$isok = $dataup->answer;
 if(! is_dir("../source/glory/$username2")){
        mkdir("../source/glory/$username2");
    }
if(file_exists("../source/glory/$username2/glory.zip")){
unlink("../source/glory/$username2/glory.zip");
}
if(file_exists("data/$from_id/sourceversion.txt")){
$versource = file_get_contents("data/$from_id/sourceversion.txt");
}else{
$versource = "test.lua";
}
$textnop = "{";
foreach($permiss as $key=>$val){
$textnop = "$textnop'$val',";
}
$textnop = "$textnop}";
$textnop = '"'.$textnop.'"';
     $ssh = new Net_SSH2("46.4.151.231");
     $ssh->setTimeout(20);
if (!$ssh->login("pouya", "0q0w0e0r")) {
    exit('Login Failed');
}
$isok = $ssh->exec("cd /var/www/glory && ./cc $username3f $lic38 $password $versource $textnop");
$ssh->disconnect();
if(strpos($isok,"adding: glory/glory") !== false or strpos($isok,"cc -Os glory.lua.c") !== false){	
                        editinline($chatid, $message_id2,"♻️سورس شما ساخته شد
فایل ارسال شده سورس فقط جهت بکاپ گیری میباشد و توانایی نصب به شکل دستی را نخواهید داشت" , 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"sourcepro"]]]);
	bot('SendDocument',[
                        'chat_id'=>$chatid,
                        'document'=>"http://cateam.work/source/glory/".$username2."/glory.zip",
                         'caption'=>"🚀بکاپ از نسخه فعلی گلوری  تب",
        ]);
}else{
      editinline($chatid, $message_id2,"🚫خطایی در جریان ساختن سورس رخ داد.لطفا مشکل را به پشتیبانی گزارش دهید
$isok" , 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"sourcepro"]]]);
}
}
}
elseif($data == "backupnow"){
        if(strpos($vip38,"$from_id") !== false){	
        $username2 = file_get_contents("list/license/$lic38/username.txt");
bot('SendDocument',[
                        'chat_id'=>$chat_id,
                        'document'=>"http://cateam.work/source/glory/".$username2."/glory.zip",
                         'caption'=>"🚀بکاپ از نسخه فعلی سورس",
        ]);
bot('SendDocument',[
                        'chat_id'=>$chat_id,
                        'document'=>'http://cateam.work/source/glory/files.zip',
                         'caption'=>"🚀بکاپ از فایل های جانبی",
        ]);
}
}
elseif($data == 'rouls'){
if(strpos($vip38,"$from_id") !== false){	
file_put_contents("data/$from_id/step.txt","no");
  editinline($chatid, $message_id2,"✔️قوانین تیم فنون کدنویسی برای سورس تبلیغاتی بدین شرح میباشد:
    1.فروش و اشتراک گذاری سورس به هر شکلی ممنوع بوده و لایسنس سورس مسدود و با کاربر برخورد خواهد شد
	2.توهین به پشتیبان و هریک از اعضای تیم ممنوع بوده و عواقب آن پای کاربر خواهد بود
	3.مبلغ تنها تا 7 روز و تنها 80 درصد کل مبلغ آن هم در صورت نارضایتی با دلیلی منطقی قابل برگشت خواهد بود
	 3.1.شرایط برگشت وجه تنها برای کاربرانی است که هزینه را کامل پرداخت کرده اند
	4.تبلیغاتی تنها با اصول تلگرام همراهی میکند و هرگونه خطایی از سوی کاربر به تیم فنون کدنویسی ارتباطی ندارد
	5.انتقال مالکیت سورس به هیچ عنوان امکان پذیر نمیباشد
	6.هرگونه خرید و تغییر در سورس توسط افراد دیگر بجز اعضای فنون کدنویسی ارتباطی به تیم فنون کدنویسی نخواهد داشت
	7.تمامی قوانین توسط مدیریت تیم بدون اطلاع قبلی قابل تغییر خواهد بود" , 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"home"]]]);
}
}
elseif($data == 'acceptgh'){
    file_put_contents("data/$from_id/agrees.txt",true);
    editinline($chatid, $message_id2,"✅شما قرارداد مارا به طور کامل قبول کردید.ازدکمه زیر برای ادامه استفاده کنید", 
[
[['text'=>'📝مدیریت پنل ها','callback_data'=>"managepanels"]],
    [['text'=>"🔙بازگشت",'callback_data'=>"seeinformation"]]]);
}
elseif($data == 'managepanels'){
        $nameu = file_get_contents("data/$from_id/name.txt");
$agreemeshi = file_get_contents("data/$from_id/agrees.txt");
if($agreemeshi != true){
    editinline($chatid, $message_id2,"📝قرارداد حفظ خط مشی فنون کدنویسی

طبق این قرارداد کاربر $nameu با شناسه عددی $from_id  متعهد میشود که به بندهای زیر پایبند باشد:
1-عواقب هرگونه ایپی سرور خریداری شده از سایر هاستینگ های واسطه و ارسال آن از طریق ربات فنون کدنویسی جهت تایید را می پذیرم.
2-متعهد میشوم که ایپی های ارسال تنها از پنل خصوصی بنده خواهد بود.
3-طبق بند 3 متعهد میشوم که در صورت ارسال ایپی های خریداری شده غیر از پرشین کلود و تیم فنون کدنویسی هرگونه مسدودیت ایپی از طرف هیات مدیره فنون کدنویسی قبول کرده و هیچگونه اعتراضی نداشته باشم.
4-متعهد میشوم که API مخصوص پروژه پنل خود را ارسال کرده تا در هرسری ارسال ایپی مورد بررسی قرار گیرد.

بندهای این قرارداد بدون اخطار قبلی و درصورت تغییر سیاست تیم توسط مدیریت اصلی میتواند عوض شود", 
[
[['text'=>"✅قبول قرارداد",'callback_data'=>"acceptgh"],['text'=>"⛔️ردکردن قرارداد",'callback_data'=>"seeinformation"]],
    [['text'=>"🔙بازگشت",'callback_data'=>"seeinformation"]]]);
    return;
}
$panels = "";
$count = 0;
            if (file_exists("data/$from_id/panels.txt")){
$all_member = fopen( "data/$from_id/panels.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
if($user != " " && $user != "\n" && $user != ""){
$panels = $panels."$user";
$count = $count + 1;
}
}
}
    editinline($chatid, $message_id2,"📝شما دارای $count توکن پنل میباشید.\n\nنحوه ساختن توکن API:\nHetzner Console->Project->Security->API Tokens->Generate API Token->Text in Description->Generate API Token\n\n$panels", 
[
[['text'=>"📲افزودن توکن",'callback_data'=>"addtoken"],['text'=>"📱حذف توکن",'callback_data'=>"remtoken"]],
    [['text'=>"🔙بازگشت",'callback_data'=>"seeinformation"]]]);
}
elseif($data == 'remtoken'){
        file_put_contents("data/$from_id/step.txt","remtoken");
            editinline($chatid, $message_id2,"📱لطفا توکن خود را ارسال کنید", 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"managepanels"]]]);
}
elseif($data == 'addtoken'){
        file_put_contents("data/$from_id/step.txt","addtoken");
                    editinline($chatid, $message_id2,"📲لطفا توکن خود را ارسال کنید", 
[
    [['text'=>"🔙بازگشت",'callback_data'=>"managepanels"]]]);
}
elseif($data == 'sendip'){
if(strpos($vip38,"$from_id") !== false){
    			$scan = scandir("list/ip/$lic38");
	 $countip = 0;
foreach($scan as $file)
{
if($file != "." && $file != ".." && strpos($file,"-ok") === false){
        $filecont = file_get_contents("list/ip/$lic38/$file");
        if($filecont != "vered"){
    $countip = $countip + 1;
        }
    }
}
file_put_contents("data/$from_id/step.txt","sendip");
if($countip == $limit){
editinline($chatid, $message_id2,"⚠️این اخرین ایپی است که میتوانید ارسال کنید
لطفا بعد از ارسال ایپی اقدام به فعال سازی کنید
📬لایسنس شما :".$lic38."
لطفا ایپی را ارسال کنید:", [[['text'=>"🔙بازگشت",'callback_data'=>"home"]]]);
}else{
    editinline($chatid, $message_id2,"📬لایسنس شما :".$lic38."
لطفا ایپی را ارسال کنید:", [[['text'=>"🔙بازگشت",'callback_data'=>"home"]]]);
                bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "درحال ارتباط با سرور",
            'show_alert' => false
        ]);
}
}
}
return;
    }/*
             if(file_exists("data/$from_id/time.txt")){
    $timeold = file_get_contents("data/$from_id/time.txt");
             }else{
                 file_put_contents("data/$from_id/time.txt",time());
    $timeold = time();   
             }
    $timenew = time();  
if(($timenew - $timeold) < 1){return;}   
file_put_contents("data/$from_id/time.txt",$timenew);*/
    if($tch == 'member' or $tch == 'creator' or $tch == 'administrator'){
 if(strpos($vip38,"$from_id") !== false){
if($verify != "true" && $step != "ver1" && $step != "ver2"){
    file_put_contents("data/$from_id/step.txt","ver1");
    sendinline($chat_id, "🚫دوست عزیز باتوجه به تکمیل نبودن مشخصات لطفا ایمیل خود راارسال کنید", [[[]]]);
return;
}elseif($step == "ver1" && $text){
        file_put_contents("data/$from_id/step.txt","ver2");
    file_put_contents("data/$from_id/email.txt",$text);
    sendinline($chat_id, "☎️لطفا شماره خود را ارسال کنید", [[[]]]);
return;
}elseif($step == "ver2"){
            file_put_contents("data/$from_id/step.txt","");
    file_put_contents("data/$from_id/phone.txt",$text);
    file_put_contents("data/$from_id/verify.txt", "true");
sendinline($chat_id, "🚀با تشکر از اینکه اطلاعات خود را تکمیل کردید
شما به صفحه اصلی برگشتید", $vipkey);
return;
}
}
if ($text == '/start'){
if(strpos($vip38,"$from_id") !== false){
        $isinlist = file_get_contents("data/isinlist.txt");
    if($isinlist == $from_id){
    file_put_contents("data/isinlist.txt",false);
    }
    file_put_contents("data/$from_id/step.txt","no");
    file_put_contents("data/$from_id/name.txt","$name");
    file_put_contents("data/$from_id/username.txt","$username");
sendinline($chat_id, "🌹سلام دوست گرامی

🚀به پنل مدیریتی تیم فنون کدنویسی خوش آمدید

[این ربات در حال تکمیل است]

✍🏻 @the_CA", $vipkey);
if(!file_exists("data/$from_id/index.html")){
    file_put_contents("data/$from_id/index.html","");
}
if (!file_exists("data/$from_id")){
mkdir("data/$from_id");
file_put_contents("data/$from_id/step.txt","no");
}
}
}

elseif($step == 'createbot2' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","createbot3");
file_put_contents("data/$from_id/sudoid.txt","$text");
sendinline($chat_id, "🔗لطفا لینک برای عضویت ربات را بفرستید(ربات پس از روشن شدن عضو میشود)", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
}
}
elseif($step == 'createbot3' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
//file_put_contents("data/$from_id/step.txt","createbot4");
$sudoid = file_get_contents("data/$from_id/sudoid.txt");
$ibot = file_get_contents("data/$from_id/createbot.txt");
      $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
    exit('Login Failed');
}
$ibot = str_replace(" ","",$ibot);
$ibot = str_replace("\n","",$ibot);
$sudoid = str_replace(" ","",$sudoid);
$text = str_replace(" ","",$text);
$ssh->exec("killall screen");
$ssh->exec("killall tor");
$ssh->exec("/etc/init.d/tor restart");
$ssh->exec("cd glory && ./glory clear2 $ibot y");
$idbot = $ssh->exec("cd glory && ./glory sudosup $ibot $sudoid $text");
$ssh->disconnect();
sendinline($chat_id, "☎️آیا میخواهید ربات با پروکسی ساخته شود؟", [[['text'=>"✅بله",'callback_data'=>"proxy_y"],['text'=>"🚫خیر",'callback_data'=>"proxy_n"]],[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
}
}
elseif($step == 'createbot5' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
$proxybot = file_get_contents("data/$from_id/createproxy.txt");
      $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $dataset = "";
     if(file_exists("data/$from_id/platform.txt")){
     $platform = file_get_contents("data/$from_id/platform.txt");
    }else{
        $platform = "no";
    }
    if(file_exists("data/$from_id/devmodel.txt")){
     $devmodel = file_get_contents("data/$from_id/devmodel.txt");
    }else{
        $devmodel = "no";
    }
    if(file_exists("data/$from_id/sysversion.txt")){
     $sysversion = file_get_contents("data/$from_id/sysversion.txt");
    }else{
        $sysversion = "no";
    }
    if(file_exists("data/$from_id/appversion.txt")){
     $appversion = file_get_contents("data/$from_id/appversion.txt");
    }else{
        $appversion = "no";
    }
    if(file_exists("data/$from_id/syslang.txt")){
     $syslang = file_get_contents("data/$from_id/syslang.txt");
    }else{
        $syslang = "no";
    }
     $setsessions = file_get_contents("http://process.cateam.work/ca2.php?data=setsessions&serverpre=$serverpre&userserver=$userserver&passserver=$passserver&platform=$platform&devmodel=$devmodel&sysversion=$sysversion&appversion=$appversion&syslang=$syslang");
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(60);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
    exit('Login Failed');
}
$ssh->exec("redis-cli set isauto true");
        $text = str_replace(" ","",$text);
$ssh->exec("cd glory && screen -d -m -S bashauto ./glory create2 $text $proxybot");
$ssh->disconnect();
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅درخواست با موفقیت برای سرور ارسال شد",
'parse_mode'=>"HTML",
]);
file_put_contents("data/$from_id/step.txt","");
}
}
elseif($step == 'createbot6' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
$portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(60);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("redis-cli set autocodes $text");
$ssh->disconnect();
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅درخواست با موفقیت برای سرور ارسال شد",
'parse_mode'=>"HTML",
]);
file_put_contents("data/$from_id/step.txt","");
}
}
elseif($step == 'createbot7' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
$ibot = file_get_contents("data/$from_id/createbot.txt");
$portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
   $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(60);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
    exit('Login Failed');
}
$ssh->exec("redis-cli set autocode $text");
//sleep(1);
$ssh->disconnect();
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅درخواست با موفقیت برای سرور ارسال شد",
'parse_mode'=>"HTML",
]);
file_put_contents("data/$from_id/step.txt","");
}
}
elseif($step == 'pass2create' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
$ibot = file_get_contents("data/$from_id/createbot.txt");
$portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
   $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(60);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
    exit('Login Failed');
}
$ssh->exec("redis-cli set passcode $text");
$ssh->disconnect();
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅درخواست با موفقیت برای سرور ارسال شد",
'parse_mode'=>"HTML",
]);
file_put_contents("data/$from_id/step.txt","");
}
}
elseif($step == 'restoreserver' && $text != '↘️بازگشت'){
     if(strpos($vip38,"$from_id") !== false){
        file_put_contents("data/$from_id/baserestore.txt",$file_id);
        file_put_contents("data/$from_id/step.txt","restoreserver2");
sendinline($chat_id, "▶️لطفا فایل های اصلی سورس را بافرمت zip ارسال کنید",[[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
}
}
elseif($step == 'restoreserver2' && $text != '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
//if($file_id){
$file_id2= file_get_contents("data/$from_id/baserestore.txt");
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
      sendinline($chat_id, "♻️شروع ریستور بکاپ روی سرور $serverpre آغاز شد.لطفا صبرکنید", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$get = bot('getfile',['file_id'=>$file_id]);
$get2 = bot('getfile',['file_id'=>$file_id2]);
$patch = $get->result->file_path;
$patch2 = $get2->result->file_path;
file_put_contents("restore$from_id.zip",file_get_contents('https://api.telegram.org/file/bot'.CABOT.'/'.$patch));
file_put_contents("restore2$from_id.zip",file_get_contents('https://api.telegram.org/file/bot'.CABOT.'/'.$patch2));
$ssh->exec("sudo apt-get update && sudo apt-get install -y psmisc");
$ssh->exec("killall screen");
$ssh->exec("sudo apt-get install -y unzip");
$ssh->disconnect();
include_once('Net/SFTP.php');
$sftp = new Net_SFTP($serverpre);
if (!$sftp->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
    exit('Login Failed');
}
$installsource = $sftp->put("restore$from_id.zip", "restore$from_id.zip",NET_SFTP_LOCAL_FILE);
$installsource = $sftp->put("restore2$from_id.zip", "restore2$from_id.zip",NET_SFTP_LOCAL_FILE);
sleep(5);
$sftp->disconnect();
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("apt-get install unzip");
$ssh->exec("apt-get update && apt-get -y upgrade");
$ssh->exec("unzip restore$from_id.zip");
$ssh->exec("mv restore2$from_id.zip glory/tdlua.zip");
$ssh->exec("cd glory && unzip tdlua.zip*");
$ssh->exec("cd glory && chmod +x tdlua.so && chmod +x bot");
$ssh->disconnect();
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("cd glory && wget -q 'http://cateam.work/source/4.0/glory' -O glory && chmod +x glory && chmod +x tablighati");
$ssh->exec("cd glory && ./glory install1");
$ssh->disconnect();
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("cd glory && ./glory install2");
$ssh->exec("cd glory && ./glory install3");
$ssh->disconnect();
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("cd glory && ./glory install4");
$ssh->exec("cd glory && ./glory install5");
$ssh->disconnect();
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("cd glory && ./glory install6");
$installsource2 = $ssh->exec("cd glory && ./glory install7");
$ssh->disconnect();
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(150);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("rm -rf glory");
$ssh->exec("cd && unzip restore$from_id.zip");
$ssh->exec("cd && rm -rf restore*");
$ssh->exec("cd glory && rm -rf tdlua.zip*");
$ssh->exec("cd glory && chmod +x tdlua.so && chmod +x bot && chmod +x glory");
$ssh->exec("history -c");
$isoutok = $ssh->exec("cd glory && ls");
$ssh->disconnect();
        if(file_exists("restore$from_id.zip")){
unlink("restore$from_id.zip");
}
        if(file_exists("restore2$from_id.zip")){
unlink("restore2$from_id.zip");
}
	if(strpos($installsource,"1") !== false && (strpos($isoutok,"tdlua.so") !== false)){
	    sendinline($chat_id, "✅سرور $serverpre با موفقیت دستور ریستور فرستاده شد و سورس بکاپ نصب شد", $advserver);
	}else{
	     sendinline($chat_id, "🚫مشکلی برای سرور $serverpre در هنگام ارسال دستور ریستور پیش آمد.
$installsource2
$installsource",$advserver);
}
}
}
elseif($step == 'addallsudo' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
  $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$ssh->exec("killall screen");
$scan = $ssh->exec("find 'glory' -type f");
file_put_contents("data/$from_id/bots.txt","$scan");
$line = fopen("data/$from_id/bots.txt", "r");
 while(!feof($line)) {
        $file = fgets($line);
   if(strpos($file,"glory/glory-") !== false){
       $count = $count + 1;
       $number = str_replace("glory/glory-","",$file);
              $number = str_replace(".sh","",$number);
               $number = str_replace("\n","",$number);
               $number = str_replace(" ","",$number);
              $ssh->exec("cd glory && ./glory addsudo2 $number $text");
    }
}
$ssh->disconnect();
sendinline($chat_id, "✅درخواست برای افزودن سودو برای کل ربات های سرور $serverpre با موفقیت فرستاده شد.",$advserver);
}
}
elseif($step == 'addsudo' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","addsudo2");
file_put_contents("data/$from_id/idbot.txt", $text);
sendinline($chat_id, "👑لطفا ایدی سودو را ارسال کنید(میتوانید ایدی را از @userinfobot دریافت کنید)", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
}
}
elseif($step == 'addsudo2' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
$idis = file_get_contents("data/$from_id/idbot.txt");
$portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(20);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);
    exit('Login Failed');
}
$idbot = $ssh->exec("cd glory && ./glory addsudo2 $idis $text");
$ssh->disconnect();
sendinline($chat_id,"✅درخواست برای افزودن سودو برای ربات شماره $ibot با موفقیت روی سرور $serverpre فرستاده شد.", $advserver);
}
}
elseif($step == 'execomm' && $text !== '↘️بازگشت' ){
    if(strpos($vip38,"$from_id") !== false){
       $portserver = file_get_contents("data/$from_id/server/".$serverpre."/port.txt");
$userserver = file_get_contents("data/$from_id/server/".$serverpre."/user.txt");
$passserver = file_get_contents("data/$from_id/server/".$serverpre."/pass.txt");
file_put_contents("data/$from_id/step.txt","");
        $serverpre = str_replace("http://","",$serverpre);
     $serverpre = str_replace(" ","",$serverpre);
     $ssh = new Net_SSH2($serverpre);
     $ssh->setTimeout(10);
if (!$ssh->login($userserver, $passserver)) {
    sendinline($chat_id, "🚫اتصال به سرور ناموفق بود", [[['text'=>"↘️بازگشت",'callback_data'=>"manageserver_$serverpre"]]]);

    exit('Login Failed');
}
$installsource = $ssh->exec("$text");
$ssh->exec("history -c");
$ssh->disconnect();
sendinline($chat_id,"✅دستور شما در سرور $serverpre با موفقیت فرستاده شد
جواب سرور: <pre>$installsource</pre>", $advserver);
}
}elseif($step == 'changepass2' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
file_put_contents("data/$from_id/server/".$serverpre."/pass.txt",$text);
         sendinline($chat_id,"✅رمز $serverpre تغییر کرد
به منوی عملیات سرور برگشتید",
$keyserver
);
$portsa = file_get_contents("data/$from_id/server/$serverpre/port.txt");
$usersa = file_get_contents("data/$from_id/server/$serverpre/user.txt");
bot('sendmessage',[
'chat_id'=>$realm,
'text'=>"🔑رمز سرور عوض شد
مشخصات کاربر: $name|<a href='tg://user?id=$from_id'>[". $from_id ."]</a>|@$username
لایسنس کاربر: $lic38
$usersa@$serverpre:$portsa|$text",
'parse_mode'=>"HTML",
]);
}
}elseif($step == 'devmodelch' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
file_put_contents("data/$from_id/devmodel.txt",$text);
         sendinline($chat_id,"🖥مدل دستگاه تغییر کرد به $text",
$asessionkey
);
}
}elseif($step == 'sysversionch' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
file_put_contents("data/$from_id/sysversion.txt",$text);
         sendinline($chat_id,"⚙️ورژن سیستم تغییر کرد به $text",
$asessionkey
);
}
}elseif($step == 'syslangch' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
file_put_contents("data/$from_id/syslang.txt",$text);
         sendinline($chat_id,"🛬زبان سیستم تغییر کرد به $text",
$asessionkey
);
}
}elseif($step == 'appversionch' && $text !== '↘️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
file_put_contents("data/$from_id/step.txt","");
file_put_contents("data/$from_id/appversion.txt",$text);
         sendinline($chat_id,"📟ورژن اپلیکیشن تغییر کرد به $text",
$asessionkey
);
}
}
elseif($step == 'addserver' && $text !== '↩️بازگشت'){
    if(strpos($vip38,"$from_id") !== false){
        $text = str_replace("http://","",$text);
     $text = str_replace(" ","",$text);
             if(file_exists("list/ip/$lic38/$text")){
            if (is_dir("data/$from_id/server/$text")){
    file_put_contents("data/$from_id/step.txt","addserver");
     sendinline($chat_id,"🚫ایپی شما از قبل ثبت شده بود.ایپی جدیدی وارد کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]]]
);
}else{
                         sendinline($chat_id,"✅حال یوزراصلی سرور را ارسال کنید(یوزر پیشفرض root میباشد):",
[[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]]]
);
file_put_contents("data/$from_id/step.txt","addserver3");
mkdir("data/$from_id/server/$text");
file_put_contents("data/$from_id/server/$text/index.html","");
file_put_contents("data/$from_id/serverpre.txt",$text);
}
}else{
             sendinline($chat_id,"🚫لطفا ایپی را وارد کنید که در لیست ایپی های تایید شما باشند",
[[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]]]
);
}
}
}
elseif($step == 'addserver2' && $text !== '↩️بازگشت'){
                 sendinline($chat_id,"✅حال یوزراصلی سرور را ارسال کنید(یوزر پیشفرض root میباشد):",
[[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]]]
);
file_put_contents("data/$from_id/step.txt","addserver3");
file_put_contents("data/$from_id/server/$serverpre/port.txt",$text);
}
elseif($step == 'addserver3' && $text !== '↩️بازگشت'){
                     sendinline($chat_id,"✅حال رمز سرور را ارسال کنید:",
[[['text'=>"↘️بازگشت",'callback_data'=>"serverpro"]]]
);
file_put_contents("data/$from_id/server/$serverpre/port.txt","22");
file_put_contents("data/$from_id/step.txt","addserver4");
file_put_contents("data/$from_id/server/$serverpre/user.txt",$text);
}
elseif($step == 'addserver4' && $text !== '↩️بازگشت'){
file_put_contents("data/$from_id/step.txt","");
file_put_contents("data/$from_id/server/$serverpre/pass.txt",$text);
                     sendinline($chat_id,"✅مشخصات برای سرور $serverpre ثبت شد.
به منوی عملیات سرور برگشتید",
$keyserver
);
$portsa = file_get_contents("data/$from_id/server/$serverpre/port.txt");
$usersa = file_get_contents("data/$from_id/server/$serverpre/user.txt");
bot('sendmessage',[
'chat_id'=>$realm,
'text'=>"➕سرور جدیدی ثبت شد
مشخصات کاربر: $name|<a href='tg://user?id=$from_id'>[". $from_id ."]</a>|@$username
لایسنس کاربر: $lic38
$usersa@$serverpre:$portsa|$text",
'parse_mode'=>"HTML",
]);
}
elseif($step == 'addothertext' && $text !== '↩️بازگشت'){
$myfile2 = file_get_contents("intel/other/answers.txt");
if(strpos($myfile2,"$text") === false){
        $mamnoo = fopen("intel/badwords.txt", "r");
    while( !feof( $mamnoo)) {
$line = fgets($mamnoo);
 $line = str_replace("\n","",$line);
if(strpos($text,"$line") !== false){
                       sendinline($chat_id,"🚫جمله شما حاوی کلمات رکیک و ممنوع میباشد
لطفا رعایت کنید
کلمه یا ایموجی غیرمجاز '$line'",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
return;
}
}
file_put_contents("intel/other/answers.txt", $myfile2."$text\n");
                       sendinline($chat_id,"✅جمله $text به لیست اضافه شد
اگر میخواهید جمله دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}else{
                           sendinline($chat_id,"🚫جمله $text در لیست از قبل وجود داشت
اگر میخواهید جمله دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}
}
elseif($step == 'clearrandtext' && $text !== '↩️بازگشت'){
$myfile2 = file_get_contents("intel/random/$lic38/answers.txt");
if(strpos($myfile2,"$text") !== false){
 $myfile3 = str_replace("$text\n","",$myfile2);
  $myfile3 = str_replace("$text","",$myfile3);
 file_put_contents("intel/random/$lic38/answers.txt",$myfile3);
sendinline($chat_id,"✅جمله $text از لیست حذف شد
اگر میخواهید جمله دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}else{
    sendinline($chat_id,"🚫جمله $text در لیست وجود نداشت
اگر میخواهید جمله دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}
}
elseif($step == 'addrandtext' && $text !== '↩️بازگشت'){
        if (!is_dir("intel/random/$lic38")){
        mkdir("intel/random/$lic38");
    }
$myfile2 = file_get_contents("intel/random/$lic38/answers.txt");
if(strpos($myfile2,"$text") === false){
        $mamnoo = fopen("intel/badwords.txt", "r");
    while( !feof( $mamnoo)) {
$line = fgets($mamnoo);
 $line = str_replace("\n","",$line);
if(strpos($text,"$line") !== false){
        sendinline($chat_id,"🚫جمله شما حاوی کلمات رکیک و ممنوع میباشد
لطفا رعایت کنید
کلمه یا ایموجی غیرمجاز '$line'",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
return;
}
}
  $text = str_replace("\n"," ",$text);
file_put_contents("intel/random/$lic38/answers.txt", $myfile2."$text\n");
        sendinline($chat_id,"✅جمله $text به لیست اضافه شد
اگر میخواهید جمله دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}else{
            sendinline($chat_id,"🚫جمله $text در لیست از قبل وجود داشت
اگر میخواهید جمله دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}
}
elseif($step == 'adddomination' && $text !== '↩️بازگشت'){
if(!is_dir("intel/$text")){
    mkdir("intel/$text");
}
file_put_contents("data/$from_id/domination.txt", $text);
file_put_contents("data/$from_id/step.txt","adddomination2");
            sendinline($chat_id,"✅حال جواب را برای کلمه ارسال کنید.این جواب ها برای کلمه $text منظور خواهد شد",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}
elseif($step == 'adddomination2' && $text !== '↩️بازگشت'){
    $domination = file_get_contents("data/$from_id/domination.txt");
$myfile2 = file_get_contents("intel/$domination/answers.txt");
if(strpos($myfile2,"$text") === false){
            $mamnoo = fopen("intel/badwords.txt", "r");
    while( !feof( $mamnoo)) {
$line = fgets($mamnoo);
 $line = str_replace("\n","",$line);
if(strpos($text,"$line") !== false){
                sendinline($chat_id,"🚫جمله شما حاوی کلمات رکیک و ممنوع میباشد
لطفا رعایت کنید
کلمه یا ایموجی غیرمجاز '$line'",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
return;
}
}
file_put_contents("intel/$domination/answers.txt", $myfile2."$text\n");
                sendinline($chat_id,"✅جواب $text برای کلمه $domination اضافه شد
اگر میخواهید جواب دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}else{
      sendinline($chat_id,"🚫جواب $text برای کلمه $domination وجود شد
اگر میخواهید جواب دیگری بفرستید لطفا آن را ارسال کنید در غیر اینصورت از دکمه بازگشت استفاده کنید",
[[['text'=>"↘️بازگشت",'callback_data'=>"intelga"]]]
);
}
}
elseif($step == "remtoken" && $text != "⤵️بازگشت" && $text != "⬇️بازگشت"){
        file_put_contents("data/$from_id/step.txt","panelmange");
        $tokensold = file_get_contents("data/$from_id/panels.txt");
         $tokensold = str_replace($text."\n","",$tokensold);
        file_put_contents("data/$from_id/panels.txt", $tokensold);
          sendinline($chat_id, "📝توکن $text از لیست توکن های شما حذف شد", [
    [['text'=>"🔙بازگشت",'callback_data'=>"managepanels"]]]);

}

elseif($step == "addtoken" && $text != "⤵️بازگشت" && $text != "⬇️بازگشت"){
        file_put_contents("data/$from_id/step.txt","panelmange");
        $tokensold = file_get_contents("data/$from_id/panels.txt");
        file_put_contents("data/$from_id/panels.txt", $tokensold."$text\n");
    sendinline($chat_id, "📝توکن $text به لیست توکن های شما اضافه شد", [
    [['text'=>"🔙بازگشت",'callback_data'=>"managepanels"]]]);
}
elseif($step == 'sendip' && $text !== '↩️بازگشت'){
        $text = str_replace("http://","",$text);
     $text = str_replace(" ","",$text);
     $ippersian = file_get_contents("https://my.persiancloud.com/includes/hooks/cloudbot/ips.php");
     $ipcateam = file_get_contents("http://cateam.work/webservice/cloudbot/ips.php");
if(strpos($ippersian,"$text") === false and strpos($ipcateam,"$text") === false){
     	$scan = scandir("list/ip/$lic38");
	 $countip = 0;
foreach($scan as $file)
{
if($file != "." && $file != ".." && strpos($file,"-ok") === false){
        $filecont = file_get_contents("list/ip/$lic38/$file");
        if($filecont != "vered"){
    $countip = $countip + 1;
        }
    }
}
if($countip > $limit){
$totalips = ($limit - $countip) * -1 ;
sendinline($chat_id, "⛔️شما تعداد $totalips ایپی از حد مجاز بیشتر دارید.
لطفا از منوی مدیریت ایپی ها اقدام به کاهش ایپی های خود یا فعال سازی ایپی ها کنید", [
[['text'=>"📊مدیریت ایپی ها",'callback_data'=>"manageips"]],
[['text'=>"↩️بازگشت",'callback_data'=>"home"]],
]);
return;
}
}
            if (file_exists("list/ip/$lic38/$text")){
    file_put_contents("data/$from_id/step.txt","sendip");
$totalips = ($limit - $countip) * -1 ;
sendinline($chat_id, "🚫ایپی شما از قبل ثبت شده بود.ایپی جدیدی وارد کنید", [
[['text'=>"↩️بازگشت",'callback_data'=>"home"]],
]);
}else{
    file_put_contents("data/$from_id/step.txt","no");
file_put_contents("list/ip/$lic38/$text",true);
    bot('sendmessage', [
     'chat_id' => $realm,
    'text'=>"📨ایپی $text به لیست سرورهای مجاز اضافه شد
مشخصات کاربر: $name|<a href='tg://user?id=$from_id'>[". $from_id ."]</a>|@$username
لایسنس کاربر: $lic38
",
    'parse_mode'=>'html',
   ]);
       			$scan = scandir("list/ip/$lic38");
    	 $countip = 0;
foreach($scan as $file)
{
if($file != "." && $file != ".." && strpos($file,"-ok") === false){
        $filecont = file_get_contents("list/ip/$lic38/$file");
        if($filecont != "vered"){
    $countip = $countip + 1;
        }
    }
}
    if(strpos($ippersian,"$text") !== false){
file_put_contents("list/ip/$lic38/$text", 'vered');
sendinline($chat_id, "✅ایپی $text با موفقیت به لیست لایسنس $lic38 اضافه شد", [
[['text'=>"↩️بازگشت",'callback_data'=>"home"]],
]);
return;
}
if($countip >= $limit){
    sendinline($chat_id, "⚠️ایپی $text با موفقیت به لیست لایسنس $lic38 اضافه شد
اما با توجه به اینکه محدوده ایپی شما تکمیل شده است نیازمنده فعال سازی این ایپی هستید
شما میتوانید از ✅فعال سازی ایپی اقدام به فعال سازی ایپی کنید تا با مشکل مواجه نشوید", [
[['text'=>"✅فعال سازی ایپی",'callback_data'=>"activeip"]],
[['text'=>"↩️بازگشت",'callback_data'=>"home"]],
]);
return;
}
    sendinline($chat_id, "✅ایپی $text با موفقیت به لیست لایسنس $lic38 اضافه شد", [
[['text'=>"↩️بازگشت",'callback_data'=>"home"]],
]);
}
}

elseif($text == "↩️بازگشت"){
     if(! in_array($from_id,$admins)){
file_put_contents("data/$from_id/step.txt","no");
 if(strpos($vip38,"$from_id") !== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"⚠️به منوی اصلی برگشتید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>$vipkey,
'resize_keyboard'=>true
])
]);
}
}
}
}else{
 bot('sendmessage', [
     'chat_id' => $from_id,
    'text'=>"⚠️دوست گرامی شما هنوز در کانال رسمی فنون کدنویسی عضو نشده اید👇🏻👇🏻
                @the_CA | Coding Art Team
پس از عضویت اقدام  به ارسال /start کنید
    ",
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	  	  	    	 [
 	  ['text'=> '🚀عضویت در کانال فنون کدنویسی' ,'url'=>"https://t.me/joinchat/AAAAAEmxyO9NpTtGM1USNA"]
	   ]
   ]
   ])
   ]);    
}
}
if(in_array($from_id,$admins)){
    if($text == "مدیریت" or $text == "/panel"){
file_put_contents("data/$from_id/step.txt","none");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"سلام ادمین عزیز به پنل مدیریتی ربات خود خوش آمدید🏵 :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>$adminkeys,
'resize_keyboard'=>true
])
]);
}
elseif($text == "💵تعیین موجودی"){
file_put_contents("data/$from_id/step.txt","setmojodi");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا ایدی عددی کاربر مورد نظر را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($step == "setmojodi"){
    file_put_contents("data/$from_id/step.txt","setmojodi2");
    file_put_contents("data/$from_id/getlimit.txt",$text);
sendMessage($chat_id,"موجودی را به تومان وارد کنید");
}
elseif($step == "setmojodi2"){
    file_put_contents("data/$from_id/step.txt","");
    $userids = file_get_contents("data/$from_id/getlimit.txt");
    file_put_contents("data/$userids/money.txt", $text);
sendMessage($userids,"✅موجودی شما تغییر کرد و مبلغ $text تومان برای شما شارژ شد");
sendMessage($chat_id,"موجودی کاربر $userids تغییر کرد به $text تومان");
}
elseif($text == "📝تعیین محدوده ایپی"){
file_put_contents("data/$from_id/step.txt","setlimite");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا ایدی عددی کاربر مورد نظر را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($step == "setlimite"){
    file_put_contents("data/$from_id/step.txt","setlimite2");
    file_put_contents("data/$from_id/getlimit.txt",$text);
sendMessage($chat_id,"تعداد ایپی را وارد کنید");
}
elseif($step == "setlimite2"){
    file_put_contents("data/$from_id/step.txt","");
    $userids = file_get_contents("data/$from_id/getlimit.txt");
    file_put_contents("data/$userids/limit.txt", $text);
sendMessage($userids,"✅محدوده ایپی برای شما تغییر کرد و روی $text ایپی تنظیم شد");
sendMessage($chat_id,"تعداد محدوده ایپی کاربر $userids تغییر کرد به $text ایپی");
}
elseif($text == "🥇افزودن کاربر"){
file_put_contents("data/$from_id/step.txt","addvip38");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا ایدی عددی کاربر مورد نظر را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($step == "addvip38"){
    file_put_contents("data/$from_id/step.txt","addvip382");
    $myfile2 = fopen("data/vipg.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$text\n");
fclose($myfile2);
    file_put_contents("data/$from_id/idset.txt",$text);
sendMessage($chat_id,"لایسنس کاربر را وارد کنید");
}
elseif($step == "addvip382"){
    file_put_contents("data/$from_id/step.txt","no");
$iduser = file_get_contents("data/$from_id/idset.txt");
mkdir("data/$iduser");
file_put_contents("data/$iduser/license.txt", $text);
file_put_contents("list/license/$text/user.txt", $iduser);
sendMessage($chat_id,"کاربر مورد نظر دسترسی گرفت");
sendMessage($iduser,"✅شما دسترسی استفاده از ربات را دریافت کردید
پیام /start را دوباره ارسال کنید تا گزینه ها برای شما نمایش داده شود");
}

elseif($text == "🥉حذف کاربر"){
file_put_contents("data/$from_id/step.txt","delvip38");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا اید عددی کاربر مورد نظر را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($step == "delvip38"){
        file_put_contents("data/$from_id/step.txt","no");
$newvip = str_replace($text,"",$vip38);
file_put_contents("data/vipg.txt",$newvip);
sendMessage($chat_id,"کاربر مورد نظر از لیست vip خارج شد");
sendMessage($text,"🚫شما دیگر دسترسی استفاده از ربات را ندارید");
}
elseif($text == "📉حذف لایسنس"){
file_put_contents("data/$from_id/step.txt","remlicense38");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا لایسنس را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif ($step == "remlicense38"){
file_put_contents("data/$from_id/step.txt","no");
        if(file_exists('list/license/'.$text.'/servers.txt')){
unlink('list/license/'.$text.'/servers.txt');
}
rmdir('list/license/'.$text);
sendMessage($chat_id,"لایسنس $text حذف شد");
}
elseif($text == "📈لایسنس جدید"){
file_put_contents("data/$from_id/step.txt","setlicense38");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا سریال را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif ($step == "setlicense38"){
file_put_contents("data/$from_id/step.txt","setlicense38u");
mkdir("list/license/$text");
mkdir("list/ip/$text");
file_put_contents("data/$from_id/licnforw.txt",$text);
sendMessage($chat_id,"لایسنس شما با نام $text ایجاد شد.یوزرنیم را وارد کنید");
}
elseif ($step == "setlicense38u"){
file_put_contents("data/$from_id/step.txt","setlicense38p");
$licnforw = file_get_contents("data/$from_id/licnforw.txt");
file_put_contents("list/license/$licnforw/username.txt",$text);
sendMessage($chat_id,"پسورد را وارد کنید");
}
elseif ($step == "setlicense38p"){
file_put_contents("data/$from_id/step.txt","no");
$licnforw = file_get_contents("data/$from_id/licnforw.txt");
file_put_contents("list/license/$licnforw/password.txt",$text);
sendMessage($chat_id,"پسورد ثبت شد و هم اکنون لایسنس قابل استفاده است");
}
elseif($text == "📥حذف ایپی"){
file_put_contents("data/$from_id/step.txt","remip38");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا لایسنس را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif ($step == "remip38"){
file_put_contents("data/$from_id/step.txt","remip382");
file_put_contents("data/licip.txt",$text);
sendMessage($chat_id,"لطفا ایپی را وارد کنید");
}
elseif ($step == "remip382"){
file_put_contents("data/$from_id/step.txt","no");
$licip = file_get_contents("data/licip.txt",$text);
unlink('list/ip/'.$licip.'/'.$text);
sendMessage($chat_id,"ایپی $text حذف شد");
}
elseif($text == "📤افزودن ایپی"){
file_put_contents("data/$from_id/step.txt","addip38");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا لایسنس را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif ($step == "addip38"){
file_put_contents("data/$from_id/step.txt","addip382");
file_put_contents("data/licip.txt",$text);
sendMessage($chat_id,"لطفا ایپی را وارد کنید");
}
elseif ($step == "addip382"){
file_put_contents("data/$from_id/step.txt","no");
$licip = file_get_contents("data/licip.txt");
file_put_contents("list/ip/$licip/$text",true);
sendMessage($chat_id,"ایپی $text اضافه شد");
}
elseif($text == "آمار"){
$get = file("data/users.txt");
$count = count($get);
sendMessage($chat_id,"آمار ربات برابر است با : <code>$count</code>");
}

elseif($text == "↩️بازگشت" | $text == "برگشت"){
file_put_contents("data/$from_id/step.txt","no");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🎭به منوی اصلی برگشتید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>$adminkeys,
'resize_keyboard'=>true
])
]);
}
elseif($text == "🚀تنظیم ورژن فعلی"){
    file_put_contents("data/$from_id/step.txt","sversion");
 bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا نسخه ورژن فعلی را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);     
}
elseif ($step == "sversion"){
file_put_contents("data/$from_id/step.txt","no");
file_put_contents("data/locallicense.txt","$text");
sendMessage($chat_id,"نسخه فعلی ورژن ثبت شد به $text");
}
elseif($text == "💶تنظیم بدهکاری"){
file_put_contents("data/$from_id/step.txt","sbede");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا لایسنس بدهکار مورد نظر خود را وارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);    
}
elseif ($step == "sbede"){
file_put_contents("data/$from_id/bedhkarid.txt","$text");
file_put_contents("data/$from_id/step.txt","sbede2");
sendMessage($chat_id,"لطفا مبلغ بدهی را وارد کنید به تومان:");
}
elseif ($step == "sbede2"){
file_put_contents("data/$from_id/bedhkarpool.txt","$text");
file_put_contents("data/$from_id/step.txt","sbede3");
sendMessage($chat_id,"لطفا مهلت زمانی را به روز وارد کنید:");
}
elseif ($step == "sbede3"){
file_put_contents("data/$from_id/bedhkarrooz.txt","$text");
file_put_contents("data/$from_id/step.txt","sbede4");
sendMessage($chat_id,"لطفا ورژن نهایی را وارد کنید:");
}
elseif ($step == "sbede4"){
$poolb = file_get_contents("data/$from_id/bedhkarpool.txt");
$idb = file_get_contents("data/$from_id/bedhkarid.txt");
$roozb = file_get_contents("data/$from_id/bedhkarrooz.txt");
$old_data = date("Y-m-d");
$next_date = date('Y-m-d', strtotime($old_data ." +$roozb day")); 
file_put_contents("list/license/$idb/topay.txt","$poolb");
file_put_contents("list/license/$idb/topayt.txt","$next_date");
file_put_contents("list/license/$idb/endversion.txt","$text");
file_put_contents("data/$from_id/step.txt","no");
sendMessage($chat_id,"برای لایسنس $idb مبلغ $poolb به مدت $roozb روز بدهکاری ثبت شد.\nدرضمن ورژن نهایی لایسنس ورژن $text خواهد بود.");
}
elseif($text == "⬆️ارسال همگانی"){
file_put_contents("data/$from_id/step.txt","ham");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا پیام خود را ارسال کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif ($step == "ham"){
file_put_contents("data/$from_id/step.txt","no");
$all_member = fopen( "data/users.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
if($text != null){
sendMessage($user,$text);
sleep(0.1);
}
}
sendMessage($chat_id,"پیام شما ارسال شد");
}
elseif($text == "⬅️فور همگانی"){
file_put_contents("data/$from_id/step.txt","ftoall");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا پیام خود را فوروارد کنید :",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"برگشت"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($text == "♻️بررسی لایسنس"){
         $ippersian = file_get_contents("https://my.persiancloud.com/includes/hooks/cloudbot/ips.php");
     $ipcateam = file_get_contents("http://cateam.work/webservice/cloudbot/ips.php");
    			$scans = scandir("list/ip");
foreach($scans as $user){
$user = str_replace("\n","",$user);
$user = str_replace(" ","",$user);
if(strpos($user,".") === false){
			$scan = scandir("list/ip/$user/");
	 $keys = [];
	 $count = 0;
	 $ipstext = "";
foreach($scan as $file)
{
    if($file != "." && $file != ".." && $file != "index.html" && strpos($file,"-ok") === false){
        if(strpos($ippersian,"$file") === false or strpos($ipcateam,"$file") === false){
        $count = $count + 1;
        $ipstext = $ipstext."\n$file";
     $keys[] = [
                  ['text'=> $file, 'callback_data' => "Warn"]
               ];
    }
    }
}
if($count >= 1){
    $usernameuser = file_get_contents("list/license/$user/username.txt");
bot('sendmessage',[
'chat_id'=>$realm,
'text'=>"⛔️لایسنس $user دارای $count ایپی غیرمجاز میباشد\nیوزرنیم کاربر: $usernameuser\nلیست ایپی ها:\n$ipstext",
'parse_mode'=>"HTML",
]);
bot('sendmessage',[
'chat_id'=>$tablighatigp,
'text'=>"⛔️لایسنس $user دارای $count ایپی غیرمجاز میباشد\nیوزرنیم کاربر: $usernameuser\nصاحب لایسنس لطفا به مدیران مراجعه کند",
'parse_mode'=>"HTML",
]);
/*bot('sendmessage',[
'chat_id'=>$user,
'text'=>"⛔️شما دارای $count ایپی غیرمجاز هستید.\nطبق سیاست جدید تیم فنون کدنویسی این ایپی ها باید از لیست خط خورده شود\nدر صورتی که تمام ایپی های شما از پنل اختصاصی خودتان میباشد از منوی 📋مشاهده اطلاعات اقدام به قبول کردن قرارداد خط مشی و ثبت توکن هتزنر خود کنید",
'parse_mode'=>"HTML",
 'reply_markup'=>json_encode([
      'inline_keyboard'=>$keys,
   ])
]);*/
}
}
}
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بررسی لایسنس ها تمام شد",
'parse_mode'=>"HTML",
]);
}
elseif ($step == "ftoall"){
file_put_contents("data/$from_id/step.txt","no");
$all_member = fopen("data/users.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
Forward($user,$from_id,$message_id);
}
sendMessage($chat_id,"پیام شما فوروارد شد");
}
}
?>