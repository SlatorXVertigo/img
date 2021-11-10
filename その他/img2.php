<?
/* 画像掲示板
詳細は Readme.txt を参照してください

******************************************！注意！***************************************
・img.logのファイル名はデフォルトから変えてご使用ください。
　define(LOGFILE, 'img.log'); // ログファイル名
・設置サーバによってはindex.htmが無いと画像掲示板設置フォルダ内が見えてしまう場合があります。
　空のindex.htmを置くか、スクリプトの入り口ファイル名指定をindex.htmに変更してください。
　define('PHP_SELF2', 'img.htm'); // 入り口ファイル名
*****************************************************************************************
*/

// エラーを全て表示するよう設定
//error_reporting(E_ALL);

extract($_POST);
extract($_GET);
extract($_COOKIE);
$upfile_name=$_FILES["upfile"]["name"];
$upfile=$_FILES["upfile"]["tmp_name"];

//掲示板設定-------------------------------------------------------------------

define('ADMIN_PASS', 'admin_pass');	// 管理者パス
define('LOGFILE', 'img.log');		// ログファイル名
define('TREEFILE', 'tree.log');		// ログファイル名
define('IMG_DIR', 'src/');			// 画像保存ディレクトリ。img.phpから見て
define('THUMB_DIR', 'thumb/');		// サムネイル保存ディレクトリ
define('TITLE', '画像掲示板');		// タイトル（<title>
define('TITLE2', '画像掲示板だよ');	// タイトル（TOP
define('HOME', '../');				// 「ホーム」へのリンク
define('MAX_KB', '500');			// 投稿容量制限 KB（phpの設定により2Mまで
define('MAX_W', '250');				// 投稿サイズ幅（これ以上はwidthを縮小
define('MAX_H', '250');				// 投稿サイズ高さ
define('MAX_W_RES', '200');			// レスの投稿サイズ幅（これ以上はwidthを縮小
define('MAX_H_RES', '200');			// レスの投稿サイズ高さ
define('PAGE_DEF', '10');			// 一ページに表示する記事
define('FOLL_ADD', '200');			// 以下省略（一ページに表示する記事×指定頁数＝設定数
define('LOG_MAX', '500');			// ログ最大行数
define('PHP_SELF', 'img.php');		// このスクリプト名
define('PHP_SELF2', 'img.htm');		// 入り口ファイル名
define('PHP_EXT', '.htm');			// 1ページ以降の拡張子
define('RENZOKU', '5');				// 連続投稿秒数
define('RENZOKU2', '3');			// 画像連続投稿秒数
define('MAX_RES', '30');			// 強制sageレス数
define('USE_THUMB', '1');			// サムネイルを作る  する:1 しない:0
define('PROXY_CHECK', '0');			// proxyの書込みを制限する  y:1 n:0
define('DISP_ID', '0');				// IDを表示する  強制:2 する:1 しない:0
define('BR_CHECK', '15');			// 改行を抑制する行数  しない:0
define('EN_AUTOLINK', '0');			// URL自動リンクを行う  する:1 しない:0
define('EN_SEC', '1');				// 時間表示に「秒」を含める  含める:1 含めない:0
define('RES_MARK', '…');			// レスの頭に付ける文字列
define('OMIT_RES', '10');			// 「レス省略」を表示するレスの数
define('OMIT_RES_IMG','5');			// 「レス省略」を表示するレスの数（画像付レスの場合
define('USE_GIF_THUMB', '0');		// GIF表示にサムネイルを使用する  する:1 しない:0
define('EN_SAGE_START', '1');		// スレ主強制sage機能を使用する  する:1 しない:0
define('MAX_PASSED_HOUR', '0');		// 強制sageまでの時間  0で強制sageなし

define('CHECK_ANI', '1');			// アニメーションGIFかどうかチェックする  する:1  しない:0
define('AD_INSERT', '1');			// 広告を挿入する  する:1  しない:0

//レス画像添付機能-------------------------------------------------------------
define('RES_IMG', '1');				// レスにも画像を添付できるようにする  添付可能:1 添付不可:0
define('RES_IMG_LIMIT', '20');		// レス画像上限枚数
define('RES_IMG_LIMIT_NOTICE','1');	// レス画像残り告知する  する:1  しない:0

//負荷軽減html経由関係---------------------------------------------------------
define('RES_FILE', '0');			// レスをhtml経由にする  する:1 しない:0
define('RES_DIR', 'res/');			// レスhtml格納ディレクトリ

//ツール避けhtml経由関係-------------------------------------------------------
define('IMG_REFER', '1');			// ツール避けに画像リンクをhtml経由にする  する:1 しない:0
define('IMG_REF_DIR', 'ref/');		// 経由先html格納ディレクトリ

//管理者制sage機能-------------------------------------------------------------
define('ADMIN_SAGE', '1');			// 管理者強制sage処理  する:1 しない:0
define('NOTICE_SAGE', '1');			// 強制sageを告知する  する:1 しない:0

//サムネイル管理者差換え機能---------------------------------------------------
define('REPLACE_EXT', '.replaced');	// 差し替えの際、元々のサムネイルファイルのお尻に付ける文字
define('NOTICE_THUMB', '1');		// サムネ差し替えを告知する  する:1 しない:0
// 項目を増やす場合は定数宣言したファイル名、タイトルを$rep_thumb配列に追加します。
// もちろん定数宣言しないで直接配列に追加してもOK
define('R_THUM1', 'replace_n.jpg');	// 差し替えサムネ(1) ファイル名
define('R_TITL1', 'ふつう');		// 差し替えサムネ(1) タイトル
define('R_THUM2', 'replace_g.jpg');	// 差し替えサムネ(2) ファイル名
define('R_TITL2', 'ぐろ');			// 差し替えサムネ(2) タイトル
define('R_THUM3', 'replace_l.jpg');	// 差し替えサムネ(3) ファイル名
define('R_TITL3', 'ろり');			// 差し替えサムネ(3) タイトル
define('R_THUM4', 'replace_3.jpg');	// 差し替えサムネ(4) ファイル名
define('R_TITL4', 'さんじ');		// 差し替えサムネ(4) タイトル
$rep_thumb = array(R_TITL1=>R_THUM1,R_TITL2=>R_THUM2,R_TITL3=>R_THUM3,R_TITL4=>R_THUM4);
$default_thumb = R_THUM1;			// デフォルトのサムネファイル名
// ファイルが無い場合は差し替え機能が無効になります。

define('NO_TITLE', '無題');			// タイトル省略時のタイトル
define('NO_COM', '本文なし');		// 本文省略時の本文
define('NO_NAME', '名無し');		// 名前省略時の名前

define('BG_COL', '#FFFFEE');		// 背景色
define('TXT_COL', '#800000');		// 文字色
define('LINK_COL', '#0000EE');		// リンク色
define('VLINK_COL', '#0000EE');		// 訪問済みリンク色
define('TIT_COL', '#800000');		// 掲示板タイトルカラー
define('RE_COL', '789922');			// ＞が付いた時の色
define('RE_BGCOL', '#F0E0D6');		// ＞レス記事の背景カラー
define('SUB_COL', '#cc1105');		// ＞タイトルカラー
define('NAME_COL', '#117743');		// ＞名前カラー

//(・∀・)ﾓｴｯカウント設定------------------------------------------------------

define('MOE_COUNT', '1');			// 萌えカウントを使用する  する:1 しない:0
define('MOE_COUNT_RES', '1');		// レスに萌えカウントを使用する  する:1 しない:0
define('MOE_LOG', 'moecount/');		// 萌えカウントログフォルダ
define('MOE_KAKU', '.log');			// カウントログ拡張子
define('MOE_DLOG', 'moeden.log');	// 殿堂ログ
define('MOE_IMG', 'src_d/');		// 殿堂画像保存フォルダ
define('MOE_IPC', '0');				// 連続投稿にIP規制をかけるか否か  y:1 n:0
define('MOE_DCNT', '10');			// 殿堂入りになるカウント数
define('MOE_DPG', '5');				// 殿堂ギャラリー１ページ表示数
define('MOE_BOT', '0');				// 萌えボタンに画像を使うか否か  y:1 n:0
define('MOE_BOTP', 'moeta.gif');	// 萌えボタンの画像
define('MOE_BOTT', '(・∀・)ﾓｴﾀ!!!');	// 萌えボタンの文字
define('MOE_BOTT2', '[ﾓｴ-!!!]');		// 萌えボタンの文字（画像付レスの場合
define('DEN_MSG', ':*:･｡,☆ﾟ･:*:･｡,殿堂入り,｡･:*:･ﾟ☆,｡･:*: ');// 殿堂入りメッセージ
define('DEN_MSG2', '殿堂入り.');	// 殿堂入りメッセージ（画像付レスの場合

define('MOE_TITLE', '殿堂ギャラリー');	// 殿堂ギャラリータイトル（<title>
define('MOE_TITLE2', '萌えカウント殿堂入り画像ギャラリー');// 殿堂ギャラリータイトル（TOP
define('MOE_TLINK', '萌えカウント殿堂ギャラリー');	// 殿堂ギャラリーリンクメッセージ

define('MOE_MSG0','ﾓｴﾀｰ');		// 萌え現在値表示文字(0カウント)
define('MOE_MSG1','ﾓｴﾀｰ');		// 萌え現在値表示文字(1カウント～MOE_DCNTの20%)
define('MOE_MSG2','ﾓｴﾀｰ');		// 萌え現在値表示文字(MOE_DCNTの20%～40%)
define('MOE_MSG3','ﾓｴﾀｰ');		// 萌え現在値表示文字(MOE_DCNTの40%～60%)
define('MOE_MSG4','ﾓｴﾀｰ');		// 萌え現在値表示文字(MOE_DCNTの60%～80%)
define('MOE_MSG5','ﾓｴﾀｰ');		// 萌え現在値表示文字(MOE_DCNTの80%～100%)

define('DEN_MAX_CNT','7');		// 殿堂ギャラリーに保管する画像の最大枚数

//-----------------------------------------------------------------------------

$path = realpath("./").'/'.IMG_DIR;
$badstring = array("dummy_string","dummy_string2","\.ws/","\.bbs\.ws/"); // 拒絶する文字列
$badfile = array("dummy","dummy2"); // 拒絶するファイルのmd5
$badip = array("addr.dummy.com","addr2.dummy.com"); // 拒絶するホスト
$addinfo='';

/* ヘッダ */
function head(&$dat,$resno=0){// 引数
  // レス時はPHP_SELFとHOMEを上位パスに
  if($resno && RES_FILE){
    $self_path = '../'.PHP_SELF;
    $home_path = '../'.HOME;
  }else{
    $self_path = PHP_SELF;
    $home_path = HOME;
  }
  $dat.='<html><head>'."\n".
        '<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=Shift_JIS">'."\n".
        '<META HTTP-EQUIV="Pragma" CONTENT="no-cache">'."\n".
        '<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">'."\n".
        '<meta name="Berry" content="no">'."\n".
        '<STYLE TYPE="text/css">'."\n".
        '<!--'."\n".
        'body,tr,td,th { font-size:12pt }'."\n".
        'a:hover { color:#DD0000; }'."\n".
        'span { font-size:20pt }'."\n".
        'small { font-size:10pt }'."\n\n".
        '.moetype  {background-color:#eeaa88;color:#800000;border:1px 1px 1px 1px solid #a56116;}'."\n".
        '.moetype2 {background-color:#F0E0D6;color:#800000;border:1px 1px 1px 1px solid #FFFFEE;}'."\n".
        '-->'."\n".
        '</STYLE>'."\n".
        '<title>'.TITLE.'</title>'."\n".
        '<script language="JavaScript"><!--'."\n".
        'function l(e){var P=getCookie("pwdc"),N=getCookie("namec"),i;'.
        'with(document){for(i=0;i<forms.length;i++){if(forms[i].pwd)with(forms[i]){pwd.value=P;}'.
        'if(forms[i].name)with(forms[i]){name.value=N;}}}};onload=l;'.
        'function getCookie(key, tmp1, tmp2, xx1, xx2, xx3) {tmp1 = " " + document.cookie + ";";xx1 = xx2 = 0;'.
        'len = tmp1.length;	while (xx1 < len) {xx2 = tmp1.indexOf(";", xx1);tmp2 = tmp1.substring(xx1 + 1, xx2);xx3 = tmp2.indexOf("=");'.
        'if (tmp2.substring(0, xx3) == key) {return(unescape(tmp2.substring(xx3 + 1, xx2 - xx1 - 1)));}xx1 = xx2 + 1;}return("");}'."\n".
        '//--></script>'."\n".
        '</head>'."\n".
        '<body bgcolor="'.BG_COL.'" text="'.TXT_COL.'" link="'.LINK_COL.'" vlink="'.VLINK_COL.'">'."\n".
        '<p align=right>'."\n".
        '[<a href="'.$self_path.'?denview=view"><font color="#cc1105"><B>'.MOE_TLINK.'</B></font></a>]'."\n".
        '[<a href="'.$home_path.'" target="_top">ホーム</a>]'."\n".
        '[<a href="'.$self_path.'?mode=admin">管理用</a>]'."\n".
        '<p align=center>'."\n".
        '<font color="'.TIT_COL.'" size=5><b><SPAN>'.TITLE2.'</SPAN></b></font>'."\n".
        '<hr width="90%" size=1>'."\n";
}
/* 投稿フォーム */
function form(&$dat,$resno,$admin="",$imageflag=FALSE){
  global $addinfo;
  $maxbyte = MAX_KB * 1024;
  $no=$resno;
  // レス時はPHP_SELFとPHP_SELF2を上位パスに
  if($resno && RES_FILE){
    $self_path = '../'.PHP_SELF;
    $self2_path = '../'.PHP_SELF2;
  }else{
    $self_path = PHP_SELF;
    $self2_path = PHP_SELF2;
  }
  if($resno){
    $msg .= "[<a href=\"".$self2_path."\">掲示板に戻る</a>]\n";
    $msg .= "<table width='100%'><tr><th bgcolor=#e04000>\n";
    $msg .= "<font color=#FFFFFF>レス送信モード</font>\n";
    $msg .= "</th></tr></table>\n";
  }
  if($admin){
    $hidden = "<input type=hidden name=admin value=\"".ADMIN_PASS."\">";
    $msg = "<h4>タグがつかえます</h4>\n";
  }
  $dat.=$msg.'<center>'."\n".
        '<form action="'.$self_path.'" method="POST" enctype="multipart/form-data">'."\n".
        '<input type=hidden name=mode value="regist">'.$hidden.
        '<input type=hidden name="MAX_FILE_SIZE" value="'.$maxbyte.'">';
  if($no){$dat.='<input type=hidden name=resto value="'.$no.'">';}
  $dat.="\n".'<table cellpadding=1 cellspacing=1>'."\n".
        '<tr><td bgcolor=#eeaa88><b>おなまえ</b></td><td><input type=text name=name size="28"></td></tr>'."\n".
        '<tr><td bgcolor=#eeaa88><b>E-mail</b></td><td><input type=text name=email size="28"></td></tr>'."\n".
        '<tr><td bgcolor=#eeaa88><b>題　　名</b></td><td><input type=text name=sub size="35">'.
        '<input type=submit value="送信する">';
  if(RES_IMG && $imageflag && $resno){
    $dat.='<font color="red"><b> 画像を添付しなくても送信できます。</b></font>';
  }
  $dat.='</td></tr>'."\n".'<tr><td bgcolor=#eeaa88><b>コメント</b></td>'.
        '<td><textarea name=com cols="48" rows="4" wrap=soft></textarea></td></tr>'."\n";
  if(!$resno || (RES_IMG && $imageflag)){
    $dat.='<tr><td bgcolor=#eeaa88><b>添付File</b></td>'.
          '<td><input type=file name=upfile size="35"></td></tr>'."\n".
          '<tr><td bgcolor=#eeaa88><b>オプション</b></td><td>';
    if(!USE_GIF_THUMB){
      $dat.=' [<label><input type=checkbox name=noanime value=on checked>GIFアニメ停止</label>] ';
    }
    if(!$resno){
      if(RES_IMG){
        $dat.=' [<label><input type=checkbox name=imageres value=on checked>レスに画像添付を許可する</label>] ';
      }
      $dat.=' [<label><input type=checkbox name=textonly value=on>画像なし</label>] ';
    }
    $dat.="</td></tr>\n";
  }
  $dat.='<tr><td bgcolor=#eeaa88><b>削除キー</b></td>'.
        '<td><input type=password name=pwd size=10 maxlength=8 value=""><small>(記事の削除用。英数字で8文字以内)</small></td></tr>'."\n".
        '<tr><td colspan=2>'."\n".
        '<small>'."\n".
        '<LI>添付可能FILE：GIF, JPG, PNG. 最大量 '.MAX_KB.' KB まで. sage機能付き.'."\n".
        '<LI> '.MAX_W.'px x '.MAX_H.'px 以上縮小.';
  if(RES_IMG){ $dat.='レス画像 '.MAX_W_RES.'px x '.MAX_H_RES.'px 以上縮小.'."\n"; }
  $dat.='<LI>投票'.MOE_DCNT.'カウントで殿堂入り. スレ主さんsageで強制sageスレ.'."\n".$addinfo.
        '</small></td></tr></table></form></center><hr>'."\n";
}

/* 記事部分 */
function updatelog($resno=0){
  global $path;
  // レス時は各パス名を上位パスに
  if($resno && RES_FILE){
    $self_path = '../'.PHP_SELF;
    $img_path = '../'.IMG_DIR;
    $ref_path = '../'.IMG_REF_DIR;
    $thumb_path = '../'.THUMB_DIR;
  }else{
    $self_path = PHP_SELF;
    $img_path = IMG_DIR;
    $ref_path = IMG_REF_DIR;
    $thumb_path = THUMB_DIR;
  }

  $tree = file(TREEFILE);
  $find = FALSE;
  $thread_time = '';
  $tline = array('dummy');
  $imageflag = FALSE;
  if($resno){
    $counttree=count($tree);
    for($i = 0;$i<$counttree;$i++){
      $tline = explode(",",rtrim($tree[$i]));
      if($resno == $tline[0] || array_search($resno,$tline)){ // レス先検索
        $resno = $tline[0];
        $st = $i;
        $find = TRUE;
        break;
      }
    }
    if(!$find){ error("該当記事がみつかりません　".$resno); }
  }
  // 元スレ時刻の取得のため(返信html作成用)
  $line = file(LOGFILE);
  $countline = count($line);
  $countimg = 0;
  for($i = 0; $i < $countline; $i++){
    list($no,,,,,,$url,,,$ext,,,$time,) = explode(",", $line[$i]); // 元スレの時刻を取得(返信html作成用)
    if($no == $resno){
      $thread_time = $time;
      if(RES_IMG && stristr($url,'_ires_')){ $imageflag = TRUE; }
    }elseif($resno){
     if(RES_IMG && array_search($no,$tline) && $ext && is_file($path.$time.$ext)){ $countimg++; }
    }
    $lineindex[$no]=$i + 1; // 逆変換テーブル作成
  }
  // レス画像数が上限になったらレス画像禁止
  if(RES_IMG && $resno && $countimg >= RES_IMG_LIMIT){ $imageflag = FALSE; }

  $counttree = count($tree);
  for($page=0;$page<$counttree;$page+=PAGE_DEF){
    $dat='';
    head($dat,$resno); // 呼び出し
    form($dat,$resno,FALSE,$imageflag);
    if(!$resno){ $st = $page; }
    if(!MOE_COUNT){ $dat.='<form action="'.$self_path.'" method=POST>'."\n"; }

    for($i = $st; $i < $st+PAGE_DEF; $i++){
      if($tree[$i]=="") continue;
      $treeline = explode(",", rtrim($tree[$i]));
      $disptree = $treeline[0];
      $j=$lineindex[$disptree] - 1; //該当記事を探して$jにセット
      if($line[$j]=="") continue;   //$jが範囲外なら次の行
      // スレ作成
      list($no,$now,$name,$email,$sub,$com,$url,
           $host,$pwd,$ext,$w,$h,$time,$chk) = explode(",", $line[$j]);
      // URLとメールにリンク
      if($email) $name = "<a href=\"mailto:$email\">$name</a>";
      $com = auto_link($com);
      $com = eregi_replace("(^|>)(&gt;[^<]*)", "\\1<font color=".RE_COL.">\\2</font>", $com);
      // 広告挿入機能
      if(AD_INSERT){
        $adarray[0]="<a href=\"www.ringo.com\">りんご</a>";
        $adarray[1]="<a href=\"www.banana.com\">ばなな</a>";
        $adarray[2]="<a href=\"www.ichigo.com\">いちご</a>";
        $adarray[3]="<a href=\"www.milk.com\">みるく</a>";
      }
      // 画像ファイル名
      $img = $path.$time.$ext;
      $src = $img_path.$time.$ext;
      // 画像経由先htmlファイル作成
      if (IMG_REFER && is_file($img) && !is_file(IMG_REF_DIR.$time.".htm")){
        $fp=fopen(IMG_REF_DIR.$time.".htm","w");
        flock($fp, 2);
        rewind($fp);
        fputs($fp, "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=../$src\">");
        fclose($fp);
      }
      //萌えカウントシステム---------------------------------------------------------
      if(MOE_COUNT){
      //少々ログ管理が汚くなりますが１スレッドに対し１ログを作成する方法を
      //利用します。配列検索等の処理が全く要らないので負荷がかからない上安全です。
      //最低限の処理の負荷及びログの安全性の面から、ログ整理の美しさを無視します。

      //変数初期化（オートリロード対策
      $moeta='none';
      $denview='none';

      $mcountlog = 'NONE';
      $logmoe    = MOE_LOG.$time.MOE_KAKU;

      // 萌えカウント空ファイル作成
      if(is_file($img) && !is_file($logmoe)){
        $mfp = fopen($logmoe, "w");
        flock($mfp,2); 
        fputs($mfp,"0,0.0.0.0\n");
        fclose($mfp);
        chmod($logmoe,0666);
      }

      if(is_file($logmoe)){
        $mp_data = file($logmoe);
        for($m=0; $m<count($mp_data); $m++){
          list($mcountlog) = split(",",$mp_data[$m]);
        }
        if($mcountlog == 'DEN'){
          // 殿堂入りフラグがセットされていたら画像コピー
          $dendat = file(MOE_DLOG);
          $denflag = 0;
          for($iden=0; $iden<count($dendat); $iden++){ // ファイル内ループ走査
            list($mno,$mnow,$mname,$mtime,$mext,$mw,$mh,$mchk) = explode(",", $dendat[$iden]);
            if($mno == $no){ // ログに存在したらフラグ加算してループを抜ける
              $denflag++;
              break;
            }
          }
          if(!$denflag){
            // ログ内に同じスレがなかったら追加
            copy($src,MOE_IMG.$time.$ext); // 画像ファイルコピー

            $delden = $dendat;
            while(count($delden)>=DEN_MAX_CNT){
              // ギャラリー内画像枚数が制限値を超えるときは削除
              list(,,,$dtime,$dext,,,) = explode(",",array_pop($delden)); // ログ削除
              $del_path = MOE_IMG.$dtime.$dext;
              if(is_file($del_path)){ unlink($del_path); } // 画像削除
            }

            $mnew = implode(",", array($no,$now,$name,$time,$ext,$w,$h,$chk));
            $fpd = fopen(MOE_DLOG, "w");
            flock($fpd,2); // ファイルアクセス排他ロック
            fputs($fpd, "$mnew,\n");

            for($di = 0; $di < count($dendat); $di++)fputs($fpd, $dendat[$di]);
            fclose ($fpd);

          }
        }

          // 萌えカウント部のメッセージを一時別の変数にセットして後から$datにくっつける
          $votext = "";
          $dentext = "";

        // 投票表示用
        if($mcountlog == 'DEN'){
          $dentext.="<b><font color=#ff0000 size=+2>".DEN_MSG."</font></b>";
        }else{
          $votext.="\n<center>".
                   "<form action=".$self_path." method=POST>".
                   "<input type=hidden name=moeno value=$no>".
                   "<input type=hidden name=moeta value=countup>".
                   "<input type=hidden name=mcount value=$time>\n";

          if(MOE_BOT){
            $votext.="<b><font color=#cc1105 size=+1>投票：</font></b><input type=image src=".MOE_BOTP."></form></center>";
          }else{
            $votext.="<b><font color=#cc1105 size=+1>投票：</font></b><input type=submit class=moetype value=".MOE_BOTT."></form></center>";
          }
          // カウント表示用
          if ($mcountlog >= MOE_DCNT*0.8){
            $dentext.="<b>現在:<font color=#cc1105 size=+5>$mcountlog</font>".MOE_MSG5."</b>";
          }elseif ($mcountlog >= MOE_DCNT*0.6){
            $dentext.="<b>現在:<font color=#cc1105 size=+4>$mcountlog</font>".MOE_MSG4."</b>";
          }elseif ($mcountlog >= MOE_DCNT*0.4){
            $dentext.="<b>現在:<font color=#cc1105 size=+3>$mcountlog</font>".MOE_MSG3."</b>";
          }elseif ($mcountlog >= MOE_DCNT*0.2){
            $dentext.="<b>現在:<font color=#cc1105 size=+2>$mcountlog</font>".MOE_MSG2."</b>";
          }elseif ($mcountlog >= 1){
            $dentext.="<b>現在:<font color=#cc1105 size=+1>$mcountlog</font>".MOE_MSG1."</b>";
          } else {
            $dentext.="<b>現在:<font color=#117783 size=+1>0</font>".MOE_MSG0."</b>";
          }
        }

      }
      }
      //萌えカウントシステム---------------------------------------------------------
      // <imgタグ作成
      $imgsrc = "";
      $dat_img= "";
      $ugoku="";
      if($ext && is_file($img)){
        $size = filesize($img); // altにサイズ表示
        if($w && $h){ // サイズが取得できる場合
          // こいつ動(ry 表示
          if(CHECK_ANI && stristr($url,'_ugo_')){
            $ugoku = "･･･こいつ動(ry.";
          }
          // スレ主アニメーション停止指示
          if(@is_file(THUMB_DIR.$time.'s.jpg') &&
            (USE_GIF_THUMB||$ext!='.gif'||stristr($url,'noanime')||@is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT))){
            // ツール避けhtml参照を追加
            $imgsrc = "<small>サムネイルを表示しています.クリックすると元のサイズを表示します.$ugoku</small>\n<br>";
            if (IMG_REFER) {
              $imgsrc .= "<a href=\"".$ref_path.$time.".htm\" target=_blank>";
            }else{
              $imgsrc .= "<a href=\"".$src."\" target=_blank>";
            }
            if (@is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)){
              $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg'.REPLACE_EXT;
            }else{
              $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg';
            }
            $imgsrc .= " border=0 align=left width=$w height=$h hspace=20 alt=\"".$size." B\"></a>";
          }else{
            if (IMG_REFER) {
              $imgsrc = "<a href=\"".$ref_path.$time.".htm\" target=_blank>";
            }else{
              $imgsrc = "<a href=\"".$src."\" target=_blank>";
            }
            $imgsrc_post = " border=0 align=left width=$w height=$h hspace=20 alt=\"".$size." B\"></a>";
//            if(@is_file(THUMB_DIR.$time.'s.jpg')){
//              $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg'.$imgsrc_post;
//            }else{
              $imgsrc .= "<img src=".$src.$imgsrc_post;
//            }
          }
        }else{ // サイズが取得できない場合
          if (IMG_REFER) {
            $imgsrc = "<a href=\"".$ref_path.$time.".htm\" target=_blank>";
          }else{
            $imgsrc = "<a href=\"".$src."\" target=_blank>";
          }
          $imgsrc_post = " border=0 align=left hspace=20 alt=\"".$size." B\"></a>";
//          if(@is_file(THUMB_DIR.$time.'s.jpg')){
//            $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg'.$imgsrc_post;
//          }else{
            $imgsrc .= "<img src=".$src.$imgsrc_post;
//          }
        }
        if (IMG_REFER) { // レスに画像をつける 画像関係タグを別変数に
          $dat_img="画像タイトル：<a href=\"".$ref_path.$time.".htm\" target=_blank>$time$ext</a>-($size B) $dentext<br>$imgsrc$votext";
        }else{
          $dat_img="画像タイトル：<a href=\"$src\" target=_blank>$time$ext</a>-($size B) $dentext<br>$imgsrc$votext";
        }
      }
      // メイン作成
      if(!$resno && AD_INSERT){ // 広告挿入機能
      $dat.="広告:::<b>".$adarray[rand(0,count($adarray)-1)]."</b><br>";
      }
      $dat.=$dat_img; // 画像関係文字列をここに移動
      if(!MOE_COUNT){
      $dat.="<input type=checkbox name=\"$no\" value=delete>";
      }
      $dat.="<font color=".SUB_COL." size=+1><b>$sub</b></font> \n";
      $dat.="Name <font color=".NAME_COL."><b>$name</b></font> $now No.$no &nbsp; ";
      if(RES_FILE){
        if(!$resno) $dat.="[<a href=\"".RES_DIR.$time.".htm\">返信</a>]";
      }else{
        if(!$resno) $dat.="[<a href=".$self_path."?res=$no>返信</a>]";
      }
      $dat.="<BR>\n";

      // そろそろ消える。
      if($lineindex[$no]-1 >= LOG_MAX*0.95){
        $dat.="<font color=\"#f00000\"><b>このスレは古いので、もうすぐ消えます。</b></font><br>\n";
      }
      // 管理者サムネ差し替え告知
      if(NOTICE_THUMB && @is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)){
        $dat.="<font color=\"#f00000\"><small><b>".
              "この記事の画像は管理者によりサムネイルが差し替えられています。理由はお察しください。<br>".
              "サムネイルをクリックすると元の画像を表示します。".
              "</b></small></font><br>\n";
      }
      // 管理者sage告知
      if(NOTICE_SAGE && stristr($url,'sage')){
        $dat.="<font color=\"#f00000\"><small><b>".
              "このスレは管理者によりsage指定されています。理由はお察しください。".
              "</b></small></font><br>\n";
      }
      // 画像レス数告知
      if(RES_IMG && RES_IMG_LIMIT_NOTICE && $resno && stristr($url,'_ires_')){
        if($countimg < RES_IMG_LIMIT){
          $dat.="<font color=\"#f00000\"><small><b>".
                "画像付レスの上限まであと･･･".(RES_IMG_LIMIT - $countimg)."枚".
                "</b></small></font><br>\n";
        }else{
          $dat.="<font color=\"#f00000\"><small><b>".
                "画像付レスおなかいっぱい･･･".
                "</b></small></font><br>\n";
        }
      }

      $dat.="<blockquote>$com</blockquote>";

      // レス作成
      if(!$resno){
        $omit_cnt = (RES_IMG && stristr($url,'_ires_')) ? OMIT_RES_IMG : OMIT_RES ;
        $s=count($treeline) - ($omit_cnt);
        if($s<1){ $s=1; }
        elseif($s>1){
          $dat.="<font color=\"#707070\">レス".
                ($s - 1)."件省略。全て読むには返信ボタンを押してください。</font><br>\n";
        }
      }else{$s=1;}
      for($k = $s; $k < count($treeline); $k++){
        $disptree = $treeline[$k];
        $j=$lineindex[$disptree] - 1;
        if($line[$j]=="") continue;
        list($no,$now,$name,$email,$sub,$com,$url,
             $host,$pwd,$ext,$w,$h,$time,$chk) = explode(",", $line[$j]);
        // URLとメールにリンク
        if($email) $name = "<a href=\"mailto:$email\">$name</a>";
        $com = auto_link($com);
        $com = eregi_replace("(^|>)(&gt;[^<]*)", "\\1<font color=".RE_COL.">\\2</font>", $com);
        // 画像ファイル名
        $img = $path.$time.$ext;
        $src = $img_path.$time.$ext;
        // 画像経由先htmlファイル作成
        if (IMG_REFER && is_file($img) && !is_file(IMG_REF_DIR.$time.".htm")){
          $fp=fopen(IMG_REF_DIR.$time.".htm","w");
          flock($fp, 2);
          rewind($fp);
          fputs($fp, "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=../$src\">");
          fclose($fp);
        }
        //萌えカウントシステム---------------------------------------------------------
        if(MOE_COUNT && MOE_COUNT_RES){
        //少々ログ管理が汚くなりますが１スレッドに対し１ログを作成する方法を
        //利用します。配列検索等の処理が全く要らないので負荷がかからない上安全です。
        //最低限の処理の負荷及びログの安全性の面から、ログ整理の美しさを無視します。

        //変数初期化（オートリロード対策
        $moeta='none';
        $denview='none';

        $mcountlog = 'NONE';
        $logmoe    = MOE_LOG.$time.MOE_KAKU;

        // 萌えカウント空ファイル作成
        if(is_file($img) && !is_file($logmoe)){
          $mfp = fopen($logmoe, "w");
          flock($mfp,2); 
          fputs($mfp,"0,0.0.0.0\n");
          fclose($mfp);
          chmod($logmoe,0666);
        }

        if(is_file($logmoe)){
          $mp_data = file($logmoe);
          for($m=0; $m<count($mp_data); $m++){
            list($mcountlog) = split(",",$mp_data[$m]);
          }
          if($mcountlog == 'DEN'){
            // 殿堂入りフラグがセットされていたら画像コピー
            $dendat = file(MOE_DLOG);
            $denflag = 0;
            for($iden=0; $iden<count($dendat); $iden++){ // ファイル内ループ走査
              list($mno,$mnow,$mname,$mtime,$mext,$mw,$mh,$mchk) = explode(",", $dendat[$iden]);
              if($mno == $no){ // ログに存在したらフラグ加算してループを抜ける
                $denflag++;
                break;
              }
            }
            if(!$denflag){
              // ログ内に同じスレがなかったら追加
              copy($src,MOE_IMG.$time.$ext); // 画像ファイルコピー

            $delden = $dendat;
            while(count($delden)>=DEN_MAX_CNT){
              // ギャラリー内画像枚数が制限値を超えるときは削除
              list(,,,$dtime,$dext,,,) = explode(",",array_pop($delden)); // ログ削除
              $del_path = MOE_IMG.$dtime.$dext;
              if(is_file($del_path)){ unlink($del_path); } // 画像削除
            }

              $mnew = implode(",", array($no,$now,$name,$time,$ext,$w,$h,$chk));
              $fpd = fopen(MOE_DLOG, "w");
              flock($fpd,2); // ファイルアクセス排他ロック
              fputs($fpd, "$mnew,\n");

              for($di = 0; $di < count($dendat); $di++)fputs($fpd, $dendat[$di]);
              fclose ($fpd);

            }
          }

          // 萌えカウント部のメッセージを一時別の変数にセットして後から$datにくっつける
          $votext = "";
          $dentext = "";

          // 投票表示用
          if($mcountlog == 'DEN'){
            $dentext.="<b><font color=#ff0000 size=+2>".DEN_MSG2."</font></b>";
          }else{
            $votext.="\n".
                     "<form action=".$self_path." method=POST>".
                     "<input type=hidden name=moeno value=$no>".
                     "<input type=hidden name=moeta value=countup>".
                     "<input type=hidden name=mcount value=$time>\n";

            if(MOE_BOT){
              $votext.="<input type=image src=".MOE_BOTP."></form>";
            }else{
              $votext.="<input type=submit class=moetype2 value=".MOE_BOTT2."></form>";
            }
            // 萌えカウント表示用
            if ($mcountlog >= MOE_DCNT*0.8){
              $dentext.="<b><font color=#cc1105 size=+5>$mcountlog</font>".MOE_MSG5."</b>";
            }elseif ($mcountlog >= MOE_DCNT*0.6){
              $dentext.="<b><font color=#cc1105 size=+4>$mcountlog</font>".MOE_MSG4."</b>";
            }elseif ($mcountlog >= MOE_DCNT*0.4){
              $dentext.="<b><font color=#cc1105 size=+3>$mcountlog</font>".MOE_MSG3."</b>";
            }elseif ($mcountlog >= MOE_DCNT*0.2){
              $dentext.="<b><font color=#cc1105 size=+2>$mcountlog</font>".MOE_MSG2."</b>";
            }elseif ($mcountlog >= 1){
              $dentext.="<b><font color=#cc1105 size=+1>$mcountlog</font>".MOE_MSG1."</b>";
            } else {
              $dentext.="<b><font color=#117783 size=+1>0</font>".MOE_MSG0."</b>";
            }
          }
          // $datに萌えテキストをくっつける
          // $dat .= $votext;
        }
        }
        if(!MOE_COUNT_RES){ $votext = ""; $dentext = ""; } //萌えカウント表示クリア
        //萌えカウントシステム---------------------------------------------------------
        // <imgタグ作成
        $imgsrc = "";
        $dat_img= "";
        $ugoku="";
        $thumb="";
        if($ext && is_file($img)){
          $size = filesize($img); // altにサイズ表示
          if($w && $h){ // サイズが取得できる場合
            // こいつ動(ry 表示
            if(CHECK_ANI && stristr($url,'_ugo_')){
              $ugoku = "･･･こいつ動(ry.";
            }
            // スレ主アニメーション停止指示
            if(@is_file(THUMB_DIR.$time.'s.jpg') &&
              (USE_GIF_THUMB||$ext!='.gif'||stristr($url,'noanime')||@is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT))){
              // ツール避けhtml参照を追加
              $thumb = " <small>サムネ表示.$ugoku</small>\n";
              if (IMG_REFER) {
                $imgsrc .= "<a href=\"".$ref_path.$time.".htm\" target=_blank>";
              }else{
                $imgsrc .= "<a href=\"".$src."\" target=_blank>";
              }
              if (@is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)){
                $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg'.REPLACE_EXT;
              }else{
                $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg';
              }
              $imgsrc .= " border=0 align=left width=$w height=$h hspace=20 alt=\"".$size." B\"></a>";
            }else{
              if (IMG_REFER) {
                $imgsrc = "<a href=\"".$ref_path.$time.".htm\" target=_blank>";
              }else{
                $imgsrc = "<a href=\"".$src."\" target=_blank>";
              }
              $imgsrc_post = " border=0 align=left width=$w height=$h hspace=20 alt=\"".$size." B\"></a>";
//              if(@is_file(THUMB_DIR.$time.'s.jpg')){
//                $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg'.$imgsrc_post;
//              }else{
                $imgsrc .= "<img src=".$src.$imgsrc_post;
//              }
            }
          }else{ // サイズが取得できない場合
            if (IMG_REFER) {
              $imgsrc = "<a href=\"".$ref_path.$time.".htm\" target=_blank>";
            }else{
              $imgsrc = "<a href=\"".$src."\" target=_blank>";
            }
            $imgsrc_post = " border=0 align=left hspace=20 alt=\"".$size." B\"></a>";
//            if(@is_file(THUMB_DIR.$time.'s.jpg')){
//              $imgsrc .= "<img src=".$thumb_path.$time.'s.jpg'.$imgsrc_post;
//            }else{
              $imgsrc .= "<img src=".$src.$imgsrc_post;
//            }
          }
          if (IMG_REFER) { // レスに画像をつける 画像関係タグを別変数に
            $dat_img="$dentext<br>画像ファイル名：<a href=\"".$ref_path.$time.".htm\" target=_blank>$time$ext</a>-($size B)$thumb<br>$imgsrc$votext\n";
          }else{
            $dat_img="$dentext<br>画像ファイル名：<a href=\"$src\" target=_blank>$time$ext</a>-($size B)$thumb<br>$imgsrc$votext\n";
          }
        }

        // 別変数に入れた画像用タグ文字列をテーブルの中に配置
        // メイン作成
        $dat.="\n<table border=0><tr><td nowrap align=right valign=top>".RES_MARK."</td><td bgcolor=".RE_BGCOL.">\n";
        if(!MOE_COUNT){
          $dat.="<input type=checkbox name=\"$no\" value=delete>";
        }
        $dat.="<font color=".SUB_COL." size=+1><b>$sub</b></font> \n";
        $dat.="Name <font color=".NAME_COL."><b>$name</b></font> $now No.$no \n";
        $dat.="$dat_img";
        // 管理者サムネ差し替え告知
        if(NOTICE_THUMB && @is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)){
          $dat.="<font color=\"#f00000\"><small><b>".
                "サムネイル差し替え中。".
                "</b></small></font><br>\n";
        }
        $dat.="<blockquote>$com</blockquote>";
        $dat.="</td></tr></table>";

      }
      $dat.="<br clear=left><hr>\n";
      clearstatcache(); // ファイルのstatをクリア
      $p++;
      if($resno){break;} // res時はtree1行だけ
    }

    if(!MOE_COUNT){
      $dat.='<table align=right><tr><td nowrap align=center>'."\n".
            '<input type=hidden name=mode value=usrdel>【記事削除】[<input type=checkbox name=onlyimgdel value=on>画像だけ消す]<br>'."\n".
            '削除キー<input type=password name=pwd size=10 maxlength=8 value="">'."\n".
            '<input type=submit value="削除"></form></td></tr></table>'."\n";
    }else{
      $dat.='<table align=right><tr><td nowrap align=center><form action="'.$self_path.'" method=POST>'."\n".
            '<input type=hidden name=mode value=usrdel>【記事削除】[<input type=checkbox name=onlyimgdel value=on>画像だけ消す]<br>'."\n".
            '記事No<input type=text name=no size=8 value="">削除キー<input type=password name=pwd size=5 maxlength=12 value="">'."\n".
            '<input type=submit value="削除"></form></td></tr></table>'."\n";
    }

    if(!$resno){ // res時は表示しない
      $prev = $st - PAGE_DEF;
      $next = $st + PAGE_DEF;
      // 改ページ処理
      $dat.="<table align=left border=1><tr>";
      if($prev >= 0){
        if($prev==0){
          $dat.="<form action=\"".PHP_SELF2."\" method=get><td>";
        }else{
          $dat.="<form action=\"".$prev/PAGE_DEF.PHP_EXT."\" method=get><td>";
        }
        $dat.="<input type=submit value=\"前のページ\">";
        $dat.="</td></form>";
      }else{$dat.="<td>最初のページ</td>";}

      $dat.="<td>";
      for($i = 0; $i < count($tree) ; $i+=PAGE_DEF){
        if($i>=FOLL_ADD){$dat.="[以下省略]";break;}
        if($st==$i){$dat.="[<b>".($i/PAGE_DEF)."</b>] ";
        }else{
          if($i==0){$dat.="[<a href=\"".PHP_SELF2."\">0</a>] ";}
          else{$dat.="[<a href=\"".($i/PAGE_DEF).PHP_EXT."\">".($i/PAGE_DEF)."</a>] ";}
        }
      }
      $dat.="</td>";

      if($p >= PAGE_DEF && count($tree) > $next && $next < FOLL_ADD){
        $dat.="<form action=\"".$next/PAGE_DEF.PHP_EXT."\" method=get><td>";
        $dat.="<input type=submit value=\"次のページ\">";
        $dat.="</td></form>";
      }else{$dat.="<td>最後のページ</td>";}
      $dat.="</tr></table><br clear=all>\n";
    }
    foot($dat);
    if($resno){
      if(RES_FILE){
        $resfilename = RES_DIR.$thread_time.".htm";
        $fp = fopen($resfilename, "w");
        flock($fp,2);
        set_file_buffer($fp, 0);
        rewind($fp);
        fputs($fp, $dat);
        fclose($fp);
        chmod($resfilename,0666);
      }else{
        echo $dat;
      }
      break;
    }
    if($page==0){$logfilename=PHP_SELF2;}
        else{$logfilename=$page/PAGE_DEF.PHP_EXT;}
    $fp = fopen($logfilename, "w");
    flock($fp,2);
    set_file_buffer($fp, 0);
    rewind($fp);
    fputs($fp, $dat);
    fclose($fp);
    chmod($logfilename,0666);
    if($page>=FOLL_ADD){break;}
  }
  if(!$resno&&is_file(($page/PAGE_DEF+1).PHP_EXT)){unlink(($page/PAGE_DEF+1).PHP_EXT);}
}
/* フッタ */
function foot(&$dat){
  $dat.="\n".'<center>'."\n".
        '<small><!-- GazouBBS v3.0 --><!-- ふたば改0.8 -->'."\n".
        '- <a href="http://php.s3.to" target=_top>GazouBBS</a> + <a href="http://www.2chan.net/" target=_top>futaba</a> -<BR>'."\n".
        '<!-- 萌え連2.06 --><!-- しおから改1.0.3 -->'."\n".
        '- <a href="http://moepic.dip.jp/gazo/" target=_top>moeren</a> + <a href="http://siokara.que.jp/" target=_top>siokara</a> -'."\n".
        '</small>'."\n".
        '</center>'."\n".
        '</body></html>'."\n";
}
/* オートリンク */
function auto_link($proto){
  if(EN_AUTOLINK){
    $proto = ereg_replace("(https?|ftp|news)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)","<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",$proto);
  }
  return $proto;
}
/* エラー画面 */
function error($mes,$dest=''){
  global $upfile_name,$path;
  if(is_file($dest)) unlink($dest);
  head($dat,FALSE);
  echo $dat;
  echo "<br><br><hr size=1><br><br>\n".
       "<center><font color=red size=5><b>$mes<br><br><a href=".PHP_SELF2.">リロード</a></b></font></center>\n".
       "<br><br><hr size=1>\n";
  die("</body></html>");
}
/* プロクシ接続チェック */
function  proxy_connect($port) {
  $fp = fsockopen ($_SERVER["REMOTE_ADDR"], $port,$a,$b,2);
  if(!$fp){return 0;}else{return 1;}
}
/* 記事書き込み */
function regist($name,$email,$sub,$com,$url,$pwd,$upfile,$upfile_name,$resto){
  global $path,$badstring,$badfile,$badip,$pwdc,$textonly,$noanime,$imageres;

  // 時間
  $time = time();
  $tim = $time.substr(microtime(),2,3);

  // アップロード処理
  if($upfile&&file_exists($upfile)){
    $dest = $path.$tim.'.tmp';
    move_uploaded_file($upfile, $dest);
    //↑でエラーなら↓に変更
    //copy($upfile, $dest);
    $upfile_name = CleanStr($upfile_name);
    if(!is_file($dest)) error("アップロードに失敗しました<br>サーバがサポートしていない可能性があります",$dest);
    $size = getimagesize($dest);
    if(!is_array($size)) error("アップロードに失敗しました<br>画像ファイル以外は受け付けません",$dest);
    $chk = md5_of_file($dest);
    foreach($badfile as $value){if(ereg("^$value",$chk)){
      error("アップロードに失敗しました<br>同じ画像がありました",$dest); // 拒絶画像
    }}
    chmod($dest,0666);
    $W = $size[0];
    $H = $size[1];

    switch ($size[2]) {
      case 1 : $ext=".gif";break;
      case 2 : $ext=".jpg";break;
      case 3 : $ext=".png";break;
      case 4 : $ext=".swf";break;
      case 5 : $ext=".psd";break;
      case 6 : $ext=".bmp";break;
      case 13 : $ext=".swf";break;
      default : $ext=".xxx";break;
    }

    // 画像最大サムネサイズ選択
    if(!$resto){
      $max_size_w = MAX_W;
      $max_size_h = MAX_H;
    }else{
      $max_size_w = MAX_W_RES;
      $max_size_h = MAX_H_RES;
    }
    // 画像表示縮小
    if($W > $max_size_w || $H > $max_size_h){
      $W2 = $max_size_w / $W;
      $H2 = $max_size_h / $H;
      ($W2 < $H2) ? $key = $W2 : $key = $H2;
      $W = ceil($W * $key);
      $H = ceil($H * $key);
    }
    $mes = "画像 $upfile_name のアップロードが成功しました<br><br>";
  }

  foreach($badstring as $value){if(ereg($value,$com)||ereg($value,$sub)||ereg($value,$name)||ereg($value,$email)){
  error("拒絶されました(str)",$dest);};}
  if($_SERVER["REQUEST_METHOD"] != "POST") error("不正な投稿をしないで下さい(post)",$dest);
  // フォーム内容をチェック
  if(!$name||ereg("^[ |　|]*$",$name)) $name="";
  if(!$com||ereg("^[ |　|\t]*$",$com)) $com="";
  if(!$sub||ereg("^[ |　|]*$",$sub))   $sub=""; 

  if(!$resto&&!$textonly&&!is_file($dest)) error("画像がありません",$dest);
  if(!$com&&!is_file($dest)) error("何か書いて下さい",$dest);

  $name=ereg_replace("管理","\"管理\"",$name);
  $name=ereg_replace("削除","\"削除\"",$name);

  if(strlen($com) > 1000) error("本文が長すぎますっ！",$dest);
  if(strlen($name) > 100) error("名前が長すぎますっ！",$dest);
  if(strlen($email) > 100) error("メール欄が長すぎますっ！",$dest);
  if(strlen($sub) > 100) error("題名が長すぎますっ！",$dest);
  if(strlen($resto) > 10) error("レス番号指定が異常です",$dest);
  if(strlen($url) > 10) error("URL指定が異常です",$dest);

  // ホスト取得
  $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);

  foreach($badip as $value){ // 拒絶host
   if(eregi("$value$",$host)){
    error("拒絶されました(host)",$dest);
  }}
  if(eregi("^mail",$host)
    || eregi("^ns",$host)
    || eregi("^dns",$host)
    || eregi("^ftp",$host)
    || eregi("^prox",$host)
    || eregi("^pc",$host)
    || eregi("^[^\.]\.[^\.]$",$host)){
    $pxck = "on";
  }
  if(eregi("ne\\.jp$",$host)||
    eregi("ad\\.jp$",$host)||
    eregi("bbtec\\.net$",$host)||
    eregi("aol\\.com$",$host)||
    eregi("uu\\.net$",$host)||
    eregi("asahi-net\\.or\\.jp$",$host)||
    eregi("rim\\.or\\.jp$",$host)
    ){$pxck = "off";}
  else{$pxck = "on";}

  if($pxck=="on" && PROXY_CHECK){
    if(proxy_connect('80') == 1){
      error("ＥＲＲＯＲ！　公開ＰＲＯＸＹ規制中！！(80)",$dest);
    } elseif(proxy_connect('8080') == 1){
      error("ＥＲＲＯＲ！　公開ＰＲＯＸＹ規制中！！(8080)",$dest);
    }
  }

  // No.とパスと時間とURLフォーマット
  srand((double)microtime()*1000000);
  if($pwd==""){
    if($pwdc==""){
      $pwd=rand();$pwd=substr($pwd,0,8);
    }else{
      $pwd=$pwdc;
    }
  }

  $c_pass = $pwd;
  $pass = ($pwd) ? substr(md5($pwd),2,8) : "*";
  $youbi = array('日','月','火','水','木','金','土');
  $yd = $youbi[gmdate("w", $time+9*60*60)] ;
  if(EN_SEC){
    $now = gmdate("y/m/d",$time+9*60*60)."(".(string)$yd.")".gmdate("H:i:s",$time+9*60*60);
  }else{
    $now = gmdate("y/m/d",$time+9*60*60)."(".(string)$yd.")".gmdate("H:i",$time+9*60*60);
  }
  if(DISP_ID){
    if($email&&DISP_ID==1){
      $now .= " ID:???";
    }else{
      $now .= " ID:".substr(crypt(md5($_SERVER["REMOTE_ADDR"].'idの種'.gmdate("Ymd", $time+9*60*60)),'id'),-8);
    }
  }
  // テキスト整形
  $email= CleanStr($email);  $email=ereg_replace("[\r\n]","",$email);
  $sub  = CleanStr($sub);    $sub  =ereg_replace("[\r\n]","",$sub);
  $url  = CleanStr($url);    $url  =ereg_replace("[\r\n]","",$url);
  $resto= CleanStr($resto);  $resto=ereg_replace("[\r\n]","",$resto);
  $com  = CleanStr($com);
  // 改行文字の統一。 
  $com = str_replace( "\r\n",  "\n", $com); 
  $com = str_replace( "\r",  "\n", $com);
  // 連続する空行を一行
  $com = ereg_replace("\n((　| )*\n){3,}","\n",$com);
  if(!BR_CHECK || substr_count($com,"\n")<BR_CHECK){
    $com = nl2br($com); // 改行文字の前に<br>を代入する
  }
  $com = str_replace("\n",  "", $com); // \nを文字列から消す。

  $name=ereg_replace("◆","◇",$name);
  $name=ereg_replace("[\r\n]","",$name);
  $names=$name;
  $name = CleanStr($name);
  if(ereg("(#|＃)(.*)",$names,$regs)){
    $cap = $regs[2];
    $cap=strtr($cap,"&amp;", "&");
    $cap=strtr($cap,"&#44;", ",");
    $name=ereg_replace("(#|＃)(.*)","",$name);
    $salt=substr($cap."H.",1,2);
    $salt=ereg_replace("[^\.-z]",".",$salt);
    $salt=strtr($salt,":;<=>?@[\\]^_`","ABCDEFGabcdef"); 
    $name.="</b>◆".substr(crypt($cap,$salt),-10)."<b>";
  }

  if(!$name) $name=NO_NAME;
  if(!$com) $com=NO_COM;
  if(!$sub) $sub=NO_TITLE; 

  // スレ主のアニメーション停止指示追加
  if ($ext=='.gif' && $noanime=='on'){ $url.='noanime';}

  // アニメーションGIFかどうか判断
  if( $ext==".gif" && CHECK_ANI ){
    // チェック用外部コマンド呼び出し
    if(stristr(PHP_OS,"WIN")){
      if(file_exists(realpath("./gif2png.exe"))){
        $a=array();
        $rtn=0;
        @exec(realpath("./gif2png.exe")." -c $dest",&$a,&$rtn);
      }
    }else{
      if(!is_executable(realpath("./gif2png"))){
        @exec(realpath("./gif2png")." -c $dest",&$a,&$rtn);
      }
    }
    // コマンド戻り値をチェックして2以上(2フレーム以上)のときは印をつける
    if($rtn > 1){ $url .= '_ugo_'; }
  }

  // 画像付レスの許可セット
  if(RES_IMG && $imageres == 'on'){ $url .= '_ires_'; }

  // ログ読み込み
  $fp=fopen(LOGFILE,"r+");
  flock($fp, 2);
  rewind($fp);
  $buf=fread($fp,1000000);
  if($buf==''){error("error load log",$dest);}
  $line = explode("\n",$buf);
  $countline=count($line);
  for($i = 0; $i < $countline; $i++){
    if($line[$i]!=""){
      list($artno,)=explode(",", rtrim($line[$i])); // 逆変換テーブル作成
      $lineindex[$artno]=$i+1;
      $line[$i].="\n";
  }}

  // sage判定(スレsageスタート、時間経過sage、管理者sage)
  $flgsage=FALSE;
  if($resto){
    list(,,,$chkemail,,,$chkurl,,,,,,$ltime,) = explode(",", rtrim($line[$lineindex[$resto]-1]));
    if(strlen($ltime) > 10) { $ltime=substr($ltime,0,-3); }
    if(EN_SAGE_START && stristr($chkemail,'sage')){$flgsage=TRUE;}
    if(MAX_PASSED_HOUR && (($time - $ltime) >= (MAX_PASSED_HOUR*60*60))) { $flgsage=TRUE; }
    if(ADMIN_SAGE && stristr($chkurl,'sage')){$flgsage=TRUE;}
  }

  // 二重投稿チェック
  for($i=0;$i<20;$i++){
   list($lastno,,$lname,,,$lcom,,$lhost,$lpwd,,,,$ltime,) = explode(",", $line[$i]);
   if(strlen($ltime)>10){$ltime=substr($ltime,0,-3);}
   if($host==$lhost||substr(md5($pwd),2,8)==$lpwd||substr(md5($pwdc),2,8)==$lpwd){$pchk=1;}else{$pchk=0;}
   if(RENZOKU && $pchk && $time - $ltime < RENZOKU)
    error("連続投稿はもうしばらく時間を置いてからお願い致します",$dest);
   if(RENZOKU && $pchk && $time - $ltime < RENZOKU2 && $upfile_name)
    error("画像連続投稿はもうしばらく時間を置いてからお願い致します",$dest);
   if(RENZOKU && $pchk && $com == $lcom && !$upfile_name)
    error("連続投稿はもうしばらく時間を置いてからお願い致します",$dest);
  }

  // ログ行数オーバー
  if(count($line) >= LOG_MAX){
    for($d = count($line)-1; $d >= LOG_MAX-1; $d--){
      list($dno,,,,,,,,,$dext,,,$dtime,) = explode(",", $line[$d]);
      if(is_file($path.$dtime.$dext)) unlink($path.$dtime.$dext);
      if(is_file(THUMB_DIR.$dtime.'s.jpg')) unlink(THUMB_DIR.$dtime.'s.jpg');
      if(is_file(IMG_REF_DIR.$dtime.'.htm')) unlink(IMG_REF_DIR.$dtime.'.htm');
      if(is_file(RES_DIR.$dtime.'.htm')) unlink(RES_DIR.$dtime.'.htm');
      if(is_file(THUMB_DIR.$dtime.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$dtime.'s.jpg'.REPLACE_EXT);
      // 萌えカウントログオーバー削除
      $delmoecount = MOE_LOG.$dtime.MOE_KAKU;
      if(is_file($delmoecount)) unlink($delmoecount);
      $line[$d] = "";
      treedel($dno,TRUE);
    }
  }
  // アップロード処理
  if($dest&&file_exists($dest)){
    for($i=0;$i<200;$i++){ // 画像重複チェック
     list(,,,,,,,,,$extp,,,$timep,$chkp,) = explode(",", $line[$i]);
     if($chkp==$chk&&file_exists($path.$timep.$extp)){
      error("アップロードに失敗しました<br>同じ画像があります",$dest);
    }}
  }
  list($lastno,) = explode(",", $line[0]);
  $no = $lastno + 1;

  $newline = "$no,$now,$name,$email,$sub,$com,$url,$host,$pass,$ext,$W,$H,$tim,$chk,\n";
  $newline.= implode('', $line);
  ftruncate($fp,0);
  set_file_buffer($fp, 0);
  rewind($fp);
  fputs($fp, $newline);

  // ツリー更新
  $find = FALSE;
  $newline = '';
  $tp=fopen(TREEFILE,"r+");
  set_file_buffer($tp, 0);
  rewind($tp);
  $buf=fread($tp,1000000);
  if($buf==''){error("error tree update",$dest);}
  $line = explode("\n",$buf);
  $countline=count($line);
  for($i = 0; $i < $countline; $i++){
    if($line[$i]!=""){
      $line[$i].="\n";
      $j=explode(",", rtrim($line[$i]));
      if($lineindex[$j[0]]==0){
        $line[$i]='';
  } } }
  if($resto){
    for($i = 0; $i < $countline; $i++){
      $rtno = explode(",", rtrim($line[$i]));
      if($rtno[0]==$resto){
        $find = TRUE;
        $line[$i]=rtrim($line[$i]).','.$no."\n";
        $j=explode(",", rtrim($line[$i]));
        if(count($j)>MAX_RES || ((EN_SAGE_START || MAX_PASSED_HOUR) && $flgsage)){$email='sage';}
        if(!stristr($email,'sage')){
          $newline=$line[$i];
          $line[$i]='';
        }
        break;
  } } }
  if(!$find){if(!$resto){$newline="$no\n";}else{error("スレッドがありません",$dest);}}
  $newline.=implode('', $line);
  ftruncate($tp,0);
  set_file_buffer($tp, 0);
  rewind($tp);
  fputs($tp, $newline);
  fclose($tp);
  fclose($fp);

  // クッキー保存
  setcookie ("pwdc", $c_pass,time()+7*24*3600);  /* 1週間で期限切れ */
  if(function_exists("mb_internal_encoding")&&function_exists("mb_convert_encoding")
      &&function_exists("mb_substr")){
    if(ereg("MSIE|Opera",$_SERVER["HTTP_USER_AGENT"])){
      $i=0;$c_name='';
      mb_internal_encoding("SJIS");
      while($j=mb_substr($names,$i,1)){
        $j = mb_convert_encoding($j, "UTF-16", "SJIS");
        $c_name.="%u".bin2hex($j);
        $i++;
      }
      header("Set-Cookie: namec=$c_name; expires=".gmdate("D, d-M-Y H:i:s",time()+7*24*3600)." GMT",FALSE);
    }else{
      $c_name=$names;
      setcookie ("namec", $c_name,time()+7*24*3600);  /* 1週間で期限切れ */
    }
  }

  if($dest&&file_exists($dest)){
    rename($dest,$path.$tim.$ext);
    if(USE_THUMB){thumb($path,$tim,$ext,$resto);}
  }
  updatelog();
  if(RES_FILE){
    if($resto){
      updatelog($resto);
    }else{
      updatelog($no);
    }
  }

  echo "<html><head><META HTTP-EQUIV=\"refresh\" CONTENT=\"1;URL=".PHP_SELF2."\"></head>";
  echo "<body>$mes 画面を切り替えます</body></html>";
}

/* サムネイル作成 */
function thumb($path,$tim,$ext,$resno=0){
  if(!function_exists("ImageCreate")||!function_exists("ImageCreateFromJPEG"))return;
  $fname=$path.$tim.$ext;
  $thumb_dir = THUMB_DIR;   // サムネイル保存ディレクトリ
  if(!$resno){
    $width     = MAX_W;     // 出力画像幅
    $height    = MAX_H;     // 出力画像高さ
  }else{
    $width     = MAX_W_RES; // 出力画像幅(レス用)
    $height    = MAX_H_RES; // 出力画像高さ(レス用)
  }

  // 画像の幅と高さとタイプを取得
  $size = GetImageSize($fname);
  switch ($size[2]) {
    case 1 :
      if(function_exists("ImageCreateFromGIF")){
        $im_in = @ImageCreateFromGIF($fname);
        if($im_in){break;}
      }
      if(!function_exists("ImageCreateFromPNG"))return;
      if(stristr(PHP_OS,"WIN")){
        if(!file_exists(realpath("./gif2png.exe")))return;
        @exec(realpath("./gif2png.exe")." -z $fname",$a);
      }else{
        if(!is_executable(realpath("./gif2png")))return;
        @exec(realpath("./gif2png")." $fname",$a);
      }
      if(!file_exists($path.$tim.'.png'))return;
      $im_in = @ImageCreateFromPNG($path.$tim.'.png');
      unlink($path.$tim.'.png');
      if(!$im_in)return;
      break;
    case 2 : $im_in = @ImageCreateFromJPEG($fname);
      if(!$im_in){return;}
       break;
    case 3 :
      if(!function_exists("ImageCreateFromPNG"))return;
      $im_in = @ImageCreateFromPNG($fname);
      if(!$im_in){return;}
      break;
    default : return;
  }
  // リサイズ
  if ($size[0] > $width || $size[1] >$height) {
    $key_w = $width / $size[0];
    $key_h = $height / $size[1];
    ($key_w < $key_h) ? $keys = $key_w : $keys = $key_h;
    $out_w = ceil($size[0] * $keys);
    $out_h = ceil($size[1] * $keys);
  } else {
    $out_w = $size[0];
    $out_h = $size[1];
  }
  // 出力画像（サムネイル）のイメージを作成
  if(function_exists("ImageCreateTrueColor")&&get_gd_ver()=="2"){
    $im_out = ImageCreateTrueColor($out_w, $out_h);
  }else{$im_out = ImageCreate($out_w, $out_h);}
  // 元画像を縦横とも コピーします。
  ImageCopyResampled($im_out, $im_in, 0, 0, 0, 0, $out_w, $out_h, $size[0], $size[1]);
  // サムネイル画像を保存
  ImageJPEG($im_out, $thumb_dir.$tim.'s.jpg',60);
  chmod($thumb_dir.$tim.'s.jpg',0666);
  // 作成したイメージを破棄
  ImageDestroy($im_in);
  ImageDestroy($im_out);
}
//gdのバージョンを調べる
function get_gd_ver(){
  if(function_exists("gd_info")){
    $gdver=gd_info();
    $phpinfo=$gdver["GD Version"];
  }else{ //php4.3.0未満用
    ob_start();
    phpinfo(8);
    $phpinfo=ob_get_contents();
    ob_end_clean();
    $phpinfo=strip_tags($phpinfo);
    $phpinfo=stristr($phpinfo,"gd version");
    $phpinfo=stristr($phpinfo,"version");
  }
  $end=strpos($phpinfo,".");
  $phpinfo=substr($phpinfo,0,$end);
  $length = strlen($phpinfo)-1;
  $phpinfo=substr($phpinfo,$length);
  return $phpinfo;
}
//ファイルmd5計算 php4.2.0未満用
function md5_of_file($inFile) {
  if(file_exists($inFile)){
  if(function_exists('md5_file')){
    return md5_file($inFile);
  }else{
    $fd = fopen($inFile, 'r');
    $fileContents = fread($fd, filesize($inFile));
    fclose ($fd);
    return md5($fileContents);
  }
 }else{
  return FALSE;
}}
/* ツリー削除 */
function treedel($delno,$delflag){
  $fp=fopen(TREEFILE,"r+");
  set_file_buffer($fp, 0);
  flock($fp, 2);
  rewind($fp);
  $buf=fread($fp,1000000);
  if($buf==''){error("error tree del");}
  $line = explode("\n",$buf);
  $countline=count($line);
  $tno = 0;
  if($countline>2){
    for($i = 0; $i < $countline; $i++){if($line[$i]!=""){$line[$i].="\n";};}
    for($i = 0; $i < $countline; $i++){
      $treeline = explode(",", rtrim($line[$i]));
      $counttreeline=count($treeline);
      for($j = 0; $j < $counttreeline; $j++){
        if($treeline[$j] == $delno){
          $treeline[$j]='';
          if($j==0){$line[$i]='';}
          else{$line[$i]=implode(',', $treeline);
            $line[$i]=ereg_replace(",,",",",$line[$i]);
            $line[$i]=ereg_replace(",$","",$line[$i]);
            $line[$i].="\n";
            $tno=$treeline[0];
          }
          break 2;
    } } }
    // 削除フラグを追加してホントに削除するかどうか選択できるように
    // 削除しない場合はスレ番号を取得するために使用
    if($delflag){
      ftruncate($fp,0);
      set_file_buffer($fp, 0);
      rewind($fp);
      fputs($fp, implode('', $line));
    }
  }
  fclose($fp);
  return $tno;
}
/* テキスト整形 */
function CleanStr($str){
  global $admin;
  $str = trim($str);//先頭と末尾の空白除去
  if (get_magic_quotes_gpc()) {//￥を削除
    $str = stripslashes($str);
  }
  if($admin!=ADMIN_PASS){//管理者はタグ可能
    $str = htmlspecialchars($str);//タグっ禁止
    $str = str_replace("&amp;", "&", $str);//特殊文字
  }
  return str_replace(",", "&#44;", $str);//カンマを変換
}
/* ユーザー削除 */
function usrdel($no,$pwd){
  global $path,$pwdc,$onlyimgdel;
  $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
  $delno = array('dummy');
  $delflag = FALSE;
  reset($_POST);
  while ($item = each($_POST)){
   if($item[1]=='delete'){array_push($delno,$item[0]);$delflag=TRUE;}
  }
  if($pwd==""&&$pwdc!="") $pwd=$pwdc;
  $fp=fopen(LOGFILE,"r+");
  set_file_buffer($fp, 0);
  flock($fp, 2);
  rewind($fp);
  $buf=fread($fp,1000000);
  fclose($fp);
  if($buf==''){error("error user del");}
  $line = explode("\n",$buf);
  $countline=count($line);
  for($i = 0; $i < $countline; $i++){if($line[$i]!=""){$line[$i].="\n";};}
  $flag = FALSE;
  for($i = 0; $i<count($line); $i++){
    list($dno,,,,,,,$dhost,$pass,$dext,,,$dtim,) = explode(",", $line[$i]);
    if((array_search($dno,$delno) || $dno==$no) && (substr(md5($pwd),2,8)==$pass || $dhost==$host || ADMIN_PASS==$pwd)){
      $flag = TRUE;
      $line[$i] = "";// パスワードがマッチした行は空に
      $delfile = $path.$dtim.$dext; // 削除ファイル
      if(!$onlyimgdel){
        $tno = treedel($dno,TRUE);  // 記事を削除して元スレ番号を取得
      }elseif(is_file($delfile)){
        $tno = treedel($dno,FALSE); // 記事を削除しないで元スレ番号だけ取得
      }
      if(is_file($delfile)) unlink($delfile);//削除
      if(is_file(THUMB_DIR.$dtim.'s.jpg')) unlink(THUMB_DIR.$dtim.'s.jpg');//削除
      if(is_file(IMG_REF_DIR.$dtim.'.htm')) unlink(IMG_REF_DIR.$dtim.'.htm');//削除
      if(is_file(RES_DIR.$dtim.'.htm')) unlink(RES_DIR.$dtim.'.htm');//削除
      if(is_file(THUMB_DIR.$dtim.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$dtim.'s.jpg'.REPLACE_EXT);//削除
      //萌えカウントログユーザー削除
      $delmoecount = MOE_LOG.$dtim.MOE_KAKU;
      if(is_file($delmoecount)) unlink($delmoecount);
      // レスファイル化の場合、削除した記事がレスの場合はレスファイル再作成
      updatelog();
      if($tno && RES_FILE){ updatelog($tno); }
    }
  }
  if(!$flag) error("該当記事が見つからないかパスワードが間違っています");
}
/* パス認証 */
function valid($pass){
  global $default_thumb;

  if($pass && $pass != ADMIN_PASS) error("パスワードが違います");

  $reflesh_path = PHP_SELF."?mode=reflesh";

  head($dat,FALSE);
  echo $dat;
  echo "[<a href=\"".PHP_SELF2."\">掲示板に戻る</a>]\n";
  echo "[<a href=\"".$reflesh_path."\">ログを更新する</a>]\n";
  echo "<table width='100%'><tr><th bgcolor=#E08000>\n";
  echo "<font color=#FFFFFF>管理モード</font>\n";
  echo "</th></tr></table>\n";
  echo "<p><form action=\"".PHP_SELF."\" method=POST>\n";
  // ログインフォーム
  if(!$pass){
    echo "<center><table border=0>\n<tr><td>";
    echo "<input type=radio name=admin value=del checked>記事削除</td><td>";
    echo "<input type=radio name=admin value=post>管理人投稿</td></tr>\n<tr><td>";
    echo "<input type=radio name=admin value=moecount>萌えカウント管理</td><td>";
    echo "<input type=radio name=admin value=moeden>殿堂ギャラリー管理</td></tr>\n<tr><td>";
    if (ADMIN_SAGE) echo "<input type=radio name=admin value=sage>強制sage処理</td><td>";
    if (is_file($default_thumb)) echo "<input type=radio name=admin value=thumb>サムネイル差し替え</td></tr>\n<tr><td>";
    echo "<input type=hidden name=mode value=admin>";
    echo "</td></tr>\n</TABLE>\n";
    echo "<input type=password name=pass size=8>";
    echo "<input type=submit value=\" 認証 \"></form></center>\n";
    die("</body></html>");
  }
}

/* 殿堂ギャラリー管理画面 */
function adminden($pass){
  global $path,$onlyimgdel;

  $dat = file(MOE_DLOG); // ログデータ読み込み
  $dendir = MOE_IMG;

  echo "<center><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>No</th><th>投稿日</th>";
  echo "<th>投稿者</th><th>画像</th><th>処理</th>";
  echo "</tr>\n";

  for($i = 0; $i < count($dat) ; $i++){
  	$img_flag = FALSE;
    list($no,$now,$name,$time,$ext,$w,$h,$chk)=explode(",", $dat[$i]);

    $aw= $w /3;
    $ah= $h /3;

    // 画像があるときはリンク
    if($ext && is_file($dendir.$time.$ext)){
      $img_flag = TRUE;
      $clip = "<a href=$dendir$time$ext target=_blank><img src=$dendir$time$ext border=0 width=$aw height=$ah></a>";
      $size = filesize($dendir.$time.$ext);
      $all += $size;			// 合計計算
    }else{
      $clip = "画像無し";
      $size = 0;
    }

    $bg = "f6f6f6"; $bg2 = "d6d6f6"; // 背景色

    if($i < count($dat) ){

      echo "<TR bgcolor=$bg>\n<TH bgcolor=$bg2>$no</TH><TD align=center>$now</TD>".
           "<TD align=center><B>$name</b></TD><TD align=center>$clip</TD>".
           "<TD align=center><form action=".PHP_SELF." method=POST>".
           "<input type=hidden NAME=edenadmin value=$time>".
           "<input type=submit name=dendel value=削除>".
           "</form>".
           "</TD>";
      echo "\n</TR>";
    }
  }
  echo "\n</table>\n<P>";
  $all = (int)($all / 1024);
  echo "【 画像データ合計 : <b>$all</b> KB 】</center>\n";
  echo "</body></html>";
}
//-----萌え殿堂編集------------------------------------------------------------
if($edenadmin){

  $dat = file(MOE_DLOG); // ログデータ読み込み
  $dendir = MOE_IMG;
  $ip = $_SERVER['REMOTE_ADDR']; 

  $ddfp = fopen(MOE_DLOG, "w");
  flock($ddfp,2); // ファイルアクセス排他ロック

  for($ddi = 0; $ddi < count($dat); $ddi++){
    list($no,$now,$name,$time,$ext,$w,$h,$chk)=explode(",", $dat[$ddi]);
    if($time != $edenadmin){
      fputs($ddfp, $dat[$ddi]);
    }
  }

  $ddel = $dendir.$edenadmin.$ext;
  if(is_file($ddel)) unlink($ddel);

  $logmoe = MOE_LOG.$edenadmin.MOE_KAKU;
  if(is_file($logmoe)) {
    $mp_data = file($logmoe);
    $newmcount = 0;
    $new = implode(",", array($newmcount,$ip));
    $fp = fopen($logmoe, "w");
    set_file_buffer($fp, 0);
    flock($fp,2);
    fputs($fp, "$new,\n");
    chmod($logmoe,0666);
    fclose ($fp);
  }

  updatelog();

  error ("殿堂から削除しました");
}
/* 萌えカウント管理画面 */
function adminmoe($pass){
  global $path,$onlyimgdel;

  echo "<center><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>No</th><th>投稿日</th><th>題名</th>";
  echo "<th>投稿者</th><th>コメント</th><th>ﾗｽﾄｶｳﾝﾄIP</th><th>添付<br>(Bytes)</th>";
  echo "<th>ﾒｰﾀｰ<BR><img src=".MOE_BOTP."></th><th>ｶｳﾝﾄ</th>";
  echo "</tr>\n";
  $line = file(LOGFILE);
  $bgcol = 0;

  for($j = 0; $j < count($line); $j++){
    $img_flag = FALSE;
    list($no,$now,$name,$email,$sub,$com,$url,
         $host,$pw,$ext,$w,$h,$time,$chk) = explode(",",$line[$j]);

    if($ext && is_file($path.$time.$ext)){
      $logmoe    = MOE_LOG.$time.MOE_KAKU;
      $mp_data = file($logmoe);
      for($m=0; $m<count($mp_data); $m++){
        list($mcountlog,$mcountip) = split(",",$mp_data[$m]);
      }
 
      // フォーマット
      $now=ereg_replace('.{2}/(.*)$','\1',$now);
      $now=ereg_replace('\(.*\)',' ',$now);
      if(strlen($name) > 10) $name = substr($name,0,9).".";
      if(strlen($sub) > 10) $sub = substr($sub,0,9).".";
      if($email) $name="<a href=\"mailto:$email\">$name</a>";
      $com = str_replace("<br />"," ",$com);
      $com = htmlspecialchars($com);
      if(strlen($com) > 20) $com = substr($com,0,18) . ".";
      // 画像があるときはリンク
      if($ext && is_file($path.$time.$ext)){
        $img_flag = TRUE;
        $clip = "<a href=\"".IMG_DIR.$time.$ext."\" target=_blank>".$time.$ext."</a><br>";
        $size = filesize($path.$time.$ext);
        $all += $size;			// 合計計算
      }else{
        $clip = "";
        $size = 0;
      }
      $bg = ($bgcol++ % 2) ? "d6d6f6" : "f6f6f6";// 背景色

      if($mcountlog == 'DEN'){
        $bar = 100;
      }else{
        $bar = 100 * $mcountlog / MOE_DCNT;
      }

      echo "<tr bgcolor=$bg>\n";
      echo "<th>$no</th><td><small>$now</small></td><td>$sub</td>";
      echo "<td><b>$name</b></td><td><small>$com</small></td>";
      echo "<td>$mcountip</td><td align=center>$clip($size)</td>".
           "<td><img src=".MOE_BOTP." width=$bar % height=20></td>".
           "<td><form action=".PHP_SELF." method=POST><input type=text NAME=newcount value=$mcountlog size=3>".
           "<input type=hidden name=countedit value=$time>".
           "<input type=submit name=ctedit value=更新><input type=submit name=ctedit value=リセット></form></td>\n";
      echo "</tr>";
    }
  }
  echo "\n</table>\n<p>";

  $all = (int)($all / 1024);
  echo "【 画像データ合計 : <b>$all</b> KB 】</center>\n";
  echo "</body></html>";
}

//-----萌えカウント編集--------------------------------------------------------

if ($countedit){
  $ip = $_SERVER['REMOTE_ADDR']; 

  $logmoe  = MOE_LOG.$countedit.MOE_KAKU;
  $mp_data = file($logmoe);
  for($m=0; $m<count($mp_data); $m++){
    list($mcountlog) = split(",",$mp_data[$m]);
  }

  if ($ctedit=='リセット'){
    $newmcount = 0;
    $new = implode(",", array($newmcount,$ip));
    $fp = fopen($logmoe, "w");
    set_file_buffer($fp, 0);
    flock($fp,2);
    fputs($fp, "$new,\n");
    chmod($logmoe,0666);
    fclose ($fp);
    updatelog();
    error ("!!CountReset!!<P>$logmoe <BR> $mcountlog count -> 0 count");
  }else{
    $newmcount = $newcount;
    if ($newmcount > MOE_DCNT){
      error ("カウント限界数を超えています");
    }else{
      if($newmcount >= MOE_DCNT){$newmcount = DEN;} // 殿堂イン
      $new = implode(",", array($newmcount,$ip));
      $fp = fopen($logmoe, "w");
      set_file_buffer($fp, 0);
      flock($fp,2);
      fputs($fp, "$new,\n");
      chmod($logmoe,0666);
      fclose ($fp);
      updatelog();
      error ("!!CountEdit!! <P>$logmoe <BR> $mcountlog count -> $newmcount count");
    }
  }
}

/* 管理者削除 */
function admindel($pass){
  global $path,$onlyimgdel;
  $delno = array('dummy');
  $delflag = FALSE;
  reset($_POST);
  while ($item = each($_POST)){
   if($item[1]=='delete'){array_push($delno,$item[0]);$delflag=TRUE;}
  }
  if($delflag){
  $fp=fopen(LOGFILE,"r+");
  set_file_buffer($fp, 0);
  flock($fp, 2);
  rewind($fp);
  $buf=fread($fp,1000000);
  if($buf==''){error("error admin del");}
  $line = explode("\n",$buf);
  $countline=count($line);
  for($i = 0; $i < $countline; $i++){if($line[$i]!=""){$line[$i].="\n";};}
    $find = FALSE;
    for($i = 0; $i < $countline; $i++){
      list($no,$now,$name,$email,$sub,$com,$url,$host,$pw,$ext,$w,$h,$tim,$chk) = explode(",",$line[$i]);
      if($onlyimgdel==on){
        if(array_search($no,$delno)){//画像だけ削除
          $delfile = $path.$tim.$ext; //削除ファイル
          if(is_file($delfile)) unlink($delfile);//削除
          if(is_file(THUMB_DIR.$tim.'s.jpg')) unlink(THUMB_DIR.$tim.'s.jpg');//削除
          if(is_file(IMG_REF_DIR.$tim.'.htm')) unlink(IMG_REF_DIR.$tim.'.htm');//削除
          if(is_file(RES_DIR.$tim.'.htm')) unlink(RES_DIR.$tim.'.htm');//削除
          if(is_file(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT);//削除
          //萌えカウント管理人削除
          $delmoecount = MOE_LOG.$tim.MOE_KAKU;
          if(is_file($delmoecount)) unlink($delmoecount);
          $tno = treedel($no,FALSE); // 記事を削除しないで元スレ番号だけ取得する
          // レスファイル化の場合はレスファイル再作成
          if($tno && RES_FILE){ updatelog($tno); }
        }
      }else{
        if(array_search($no,$delno)){//削除の時は空に
          $find = TRUE;
          $line[$i] = "";
          $delfile = $path.$tim.$ext; //削除ファイル
          if(is_file($delfile)) unlink($delfile);//削除
          if(is_file(THUMB_DIR.$tim.'s.jpg')) unlink(THUMB_DIR.$tim.'s.jpg');//削除
          if(is_file(IMG_REF_DIR.$tim.'.htm')) unlink(IMG_REF_DIR.$tim.'.htm');//削除
          if(is_file(RES_DIR.$tim.'.htm')) unlink(RES_DIR.$tim.'.htm');//削除
          if(is_file(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT);//削除
          //萌えカウント管理人削除
          $delmoecount = MOE_LOG.$tim.MOE_KAKU;
          if(is_file($delmoecount)) unlink($delmoecount);
          $tno = treedel($no,TRUE); // 記事を削除して元スレ番号を取得してレスファイル更新
          // レスファイル化の場合、削除した記事がレスの場合はレスファイル再作成
          if($tno && RES_FILE){ updatelog($tno); }
        }
      }
    }
    if($find){//ログ更新
      ftruncate($fp,0);
      set_file_buffer($fp, 0);
      rewind($fp);
      fputs($fp, implode('', $line));
    }
    fclose($fp);
    updateall(); // 全レスデータを再作成
  }
  // 削除画面を表示
  echo "<input type=hidden name=mode value=admin>\n";
  echo "<input type=hidden name=admin value=del>\n";
  echo "<input type=hidden name=pass value=\"$pass\">\n";
  echo "<center><P>削除したい記事のチェックボックスにチェックを入れ、削除ボタンを押して下さい。\n";
  echo "<p><input type=submit value=\"削除する\">";
  echo "<input type=reset value=\"リセット\">";
  echo "[<input type=checkbox name=onlyimgdel value=on checked>画像だけ消す]";
  echo "<P><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>削除</th><th>記事No</th><th>投稿日</th><th>題名</th>";
  echo "<th>投稿者</th><th>コメント</th><th>ホスト名</th><th>添付<br>(Bytes)</th><th>md5</th>";
  echo "</tr>\n";
  $line = file(LOGFILE);

  for($j = 0; $j < count($line); $j++){
    $img_flag = FALSE;
    list($no,$now,$name,$email,$sub,$com,$url,
         $host,$pw,$ext,$w,$h,$time,$chk) = explode(",",$line[$j]);
    // フォーマット
    $now=ereg_replace('.{2}/(.*)$','\1',$now);
    $now=ereg_replace('\(.*\)',' ',$now);
    if(strlen($name) > 10) $name = substr($name,0,9).".";
    if(strlen($sub) > 10) $sub = substr($sub,0,9).".";
    if($email) $name="<a href=\"mailto:$email\">$name</a>";
    $com = str_replace("<br />"," ",$com);
    $com = htmlspecialchars($com);
    if(strlen($com) > 20) $com = substr($com,0,18) . ".";
    // 画像があるときはリンク
    if($ext && is_file($path.$time.$ext)){
      $img_flag = TRUE;
      $clip = "<a href=\"".IMG_DIR.$time.$ext."\" target=_blank>".$time.$ext."</a><br>";
      $size = filesize($path.$time.$ext);
      $all += $size;			// 合計計算
      $chk= substr($chk,0,10);
    }else{
      $clip = "";
      $size = 0;
      $chk= "";
    }
    $bg = ($j % 2) ? "d6d6f6" : "f6f6f6";// 背景色

    echo "<tr bgcolor=$bg><th><input type=checkbox name=\"$no\" value=delete></th>";
    echo "<th>$no</th><td><small>$now</small></td><td>$sub</td>";
    echo "<td><b>$name</b></td><td><small>$com</small></td>";
    echo "<td>$host</td><td align=center>$clip($size)</td><td>$chk</td>\n";
    echo "</tr>\n";
  }

  echo "</table>\n<p><input type=submit value=\"削除する$msg\">";
  echo "<input type=reset value=\"リセット\"></form>";

  $all = (int)($all / 1024);
  echo "【 画像データ合計 : <b>$all</b> KB 】";
  die("</center></body></html>");
}

/* 管理者サムネ差し替え */
function admin_chgthumb($pass){
  global $path,$stillGIF;
  global $rep_thumb,$default_thumb;
  $thum_name = $default_humb;
  foreach($rep_thumb as $chkthumb){
    if (!is_file($chkthumb)){error("代替サムネイルファイル".$chkthumb."が見つかりません");}
  }

  $chgno = array('dummy');
  $chgflag = FALSE;
  reset($_POST);
  while ($item = each($_POST)){
    if($item[1]=='chgthumb'){array_push($chgno,$item[0]);$chgflag=TRUE;}
    // 差し替えサムネファイル名取得
    if($item[0]=='thumb'){$thumb_name=$item[1];}
  }
  if($chgflag){
  // スレ主の記事番号を取得
  $ttree = file(TREEFILE);
  $tno = array('dummy');
  foreach($ttree as $tline){
    list($tartno,)=explode(",",$tline);
    array_push($tno,$tartno);
  }
  // 指定のあった記事を全部変更
  copy(LOGFILE,LOGFILE.'.bak');// 追加
  $fp=fopen(LOGFILE,"r+");
  set_file_buffer($fp, 0);
  flock($fp, 2);
  rewind($fp);
  $buf=fread($fp,1000000);
  if($buf==''){error("error admin change thumbnail");}
  $line = explode("\n",$buf);
  $countline=count($line);
  for($i = 0; $i < $countline; $i++){if($line[$i]!=""){$line[$i].="\n";};}
    $find = FALSE;
    for($i = 0; $i < $countline; $i++){
      list($no,$now,$name,$email,$sub,$com,$url,$host,$pw,$ext,$w,$h,$tim,$chk) = explode(",",$line[$i]);
      if($no==$chgno[0] || array_search($no,$chgno)){
        $find = TRUE;
        // サムネイル差し替え
        $tpath = THUMB_DIR.$tim.'s.jpg';
        $tpathorg = $tpath.REPLACE_EXT;
        if (!is_file($tpathorg)){
          if(!is_file($tpath) && is_file($path.$tim.$ext)){ // サムネがなかったら新規作成
            if(array_search($no,$tno)){
              thumb($path,$tim,$ext,0);   // スレ主の場合は記事番号セットしない
            }else{
              thumb($path,$tim,$ext,$no); // レスの場合は記事番号セット
            }
          }
          if( is_file($thumb_name) && is_file($tpath)){
            if ((!USE_GIF_THUMB && $ext=='.gif' && $stillGIF=='on')) {copy($tpath,$tpathorg);}
            else {copy($thumb_name,$tpathorg);}
            // サムネサイズを差し替える画像のサイズにする
            $tsize = GetImageSize($tpathorg);
            $w = $tsize[0];
            $h = $tsize[1];
          }
        }
        else{
          unlink($tpathorg);
          $tsize = GetImageSize($tpath);
          $w = $tsize[0];
          $h = $tsize[1];
        }
        // サムネサイズを制限
        if(array_search($no,$tno)){
          $max_size_w = MAX_W;
          $max_size_h = MAX_H;
        }else{
          $max_size_w = MAX_W_RES;
          $max_size_h = MAX_H_RES;
        }
        
        if($w > $max_size_w || $h >$max_size_h){
          $key_w = $max_size_w / $w;
          $key_h = $max_size_h / $h;
          $keys = ($key_w < $key_h) ? $key_w : $key_h;
          $out_w = ceil($w * $keys);
          $out_h = ceil($h * $keys);
        } else {
          $out_w = $w;
          $out_h = $h;
        }
        $line[$i] = "$no,$now,$name,$email,$sub,$com,$url,$host,$pw,$ext,$out_w,$out_h,$tim,$chk,\n";
      }
    }
    if($find){//ログ更新
      ftruncate($fp,0);
      set_file_buffer($fp, 0);
      rewind($fp);
      fputs($fp, implode('', $line));
    }
    fclose($fp);

  updatelog();
  if(RES_IMG){
    foreach($chgno as $tmp){ if($tmp != 'dummy'){ updatelog(intval($tmp)); }}
  }

  }

  // 差し替え記事選択画面を表示
  echo "<input type=hidden name=mode value=admin>\n";
  echo "<input type=hidden name=admin value=thumb>\n";
  echo "<input type=hidden name=pass value=\"$pass\">\n";
  echo "<center><P>サムネイルを差し替えたい記事のチェックボックスにチェックを入れ、差し替えボタンを押して下さい。\n";
  echo "<center>「差替」と「差替解除」が切り替わります。\n";
  echo "<p><input type=submit value=\"差し替え\">";
  echo "<input type=reset value=\"リセット\">";
  if(!USE_GIF_THUMB){echo "[<input type=checkbox name=stillGIF value=on>GIFをサムネイル化するだけ]";}

  // メニューにサムネ種類を表示
  echo "<center><BR>";
  $i=0;
  foreach ($rep_thumb as $rtitl => $rname){
    echo "<input type=radio name=thumb value=$rname ";
    if (!$i++){ echo "checked"; }
    echo ">$rtitl";
  }

  echo "<P><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>選択</th><th>記事No</th><th>状態</th><th>投稿日</th><th>題名</th>";
  echo "<th>投稿者</th><th>コメント</th><th>ホスト名</th><th>添付<br>(Bytes)</th>";
  echo "</tr>\n";

  // ログファイル読み出し
  $line = file(LOGFILE);
  $bgcol = 0;
  for($j = 0; $j < count($line); $j++){
    $img_flag = FALSE;
    list($no,$now,$name,$email,$sub,$com,$url,
         $host,$pw,$ext,$w,$h,$time,$chk) = explode(",",$line[$j]);
    if($ext && is_file($path.$time.$ext)){
      // フォーマット
      $now=ereg_replace('.{2}/(.*)$','\1',$now);
      $now=ereg_replace('\(.*\)',' ',$now);
      if(strlen($name) > 10) $name = substr($name,0,9).".";
      if(strlen($sub) > 10) $sub = substr($sub,0,9).".";
      if($email) $name="<a href=\"mailto:$email\">$name</a>";
      $com = str_replace("<br />"," ",$com);
      $com = htmlspecialchars($com);
      if(strlen($com) > 20) $com = substr($com,0,18) . ".";
      $img_flag = TRUE;
      $clip = "<a href=\"".IMG_DIR.$time.$ext."\" target=_blank>".$time.$ext."</a><br>";
      $size = filesize($path.$time.$ext);
      $all += $size;			// 合計計算
      $chk= substr($chk,0,10);
      $bg = ($bgcol++ % 2) ? "d6d6f6" : "f6f6f6";// 背景色

      if (is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)) {$tstat = "差替";}
      else{
        $tstat = (stristr($url,'noanime')) ? "投稿者" : "　";
      }
      echo "<tr bgcolor=$bg><th><input type=checkbox name=\"$no\" value=chgthumb></th>";
      echo "<th>$no</th><th>$tstat</th><td><small>$now</small></td><td>$sub</td>";
      echo "<td><b>$name</b></td><td><small>$com</small></td>";
      echo "<td>$host</td><td align=center>$clip($size)</td>\n";
      echo "</tr>\n";
    }
  }
  echo "</table>\n<p><input type=submit value=\"差し替え$msg\">";
  echo "<input type=reset value=\"リセット\"></form>";

  $all = (int)($all / 1024);
  echo "【 画像データ合計 : <b>$all</b> KB 】";
  die("</center></body></html>");
}

/* 管理者sage処理 */
function admin_sage($pass){
  global $path;
  $chgno = array('dummy');
  $chgflag = FALSE;
  reset($_POST);
  while ($item = each($_POST)){
    if($item[1]=='sage'){array_push($chgno,$item[0]);$chgflag=TRUE;}
  }
  if($chgflag){
  copy(LOGFILE,LOGFILE.'.bak');// 追加
  $fp=fopen(LOGFILE,"r+");
  set_file_buffer($fp, 0);
  flock($fp, 2);
  rewind($fp);
  $buf=fread($fp,1000000);
  if($buf==''){error("error admin sage");}
  $line = explode("\n",$buf);
  $countline=count($line);
  for($i = 0; $i < $countline; $i++){if($line[$i]!=""){$line[$i].="\n";};}
    $find = FALSE;
    for($i = 0; $i < $countline; $i++){
      list($no,$now,$name,$email,$sub,$com,$url,$host,$pw,$ext,$w,$h,$tim,$chk) = explode(",",$line[$i]);
      if(array_search($no,$chgno)){
        $find = TRUE;
        // URI枠に'sage'文字切り替え
        if (stristr($url,'sage')) {$url=str_replace('sage','',$url);}
        else { $url .= 'sage'; }
        $line[$i] = "$no,$now,$name,$email,$sub,$com,$url,$host,$pw,$ext,$w,$h,$tim,$chk,\n";
      }
    }
    if($find){//ログ更新
      ftruncate($fp,0);
      set_file_buffer($fp, 0);
      rewind($fp);
      fputs($fp, implode('', $line));
    }
    fclose($fp);

  updatelog();
  if(RES_IMG){
    foreach($chgno as $tmp){ if($tmp != 'dummy'){ updatelog(intval($tmp)); }}
  }

  }

  // sage記事選択画面を表示
  echo "<input type=hidden name=mode value=admin>\n";
  echo "<input type=hidden name=admin value=sage>\n";
  echo "<input type=hidden name=pass value=\"$pass\">\n";
  echo "<center><P>sage状態を変更したい記事のチェックボックスにチェックを入れ、変更ボタンを押して下さい。\n";
  echo "<center>「sage」と「sage解除」が切り替わります。\n";
  echo "<center>「sageスタート」や「レス数sage」による「sage」は解除できません。\n";
  echo "<p><input type=submit value=\"変更\">";
  echo "<input type=reset value=\"リセット\">";
  echo "<P><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>選択</th><th>記事No</th><th>状態</th><th>投稿日</th><th>題名</th>";
  echo "<th>投稿者</th><th>コメント</th><th>ホスト名</th><th>添付<br>(Bytes)</th>";
  echo "</tr>\n";

  // ツリーファイルからスレ元の記事No.を取得
  $ttree = file(TREEFILE);
  $tno = array('dummy');
  $tfind = FALSE;
  $tcounttree=count($ttree);
  for($i = 0;$i<$tcounttree;$i++){
    list($tartno,)=explode(",",rtrim($ttree[$i]));
    array_push($tno,$tartno);
  }

  // ログファイル読み出し
  $line = file(LOGFILE);
  $bgcol = 0;
  for($j = 0; $j < count($line); $j++){
    $img_flag = FALSE;
    list($no,$now,$name,$email,$sub,$com,$url,
         $host,$pw,$ext,$w,$h,$time,$chk) = explode(",",$line[$j]);
    if(array_search($no,$tno)){
      // フォーマット
      $now=ereg_replace('.{2}/(.*)$','\1',$now);
      $now=ereg_replace('\(.*\)',' ',$now);
      if(strlen($name) > 10) $name = substr($name,0,9).".";
      if(strlen($sub) > 10) $sub = substr($sub,0,9).".";
      if($email) $name="<a href=\"mailto:$email\">$name</a>";
      $com = str_replace("<br />"," ",$com);
      $com = htmlspecialchars($com);
      if(strlen($com) > 20) $com = substr($com,0,18) . ".";
      $url = (stristr($url,'sage')) ? 'sage' : '　';
      // 画像があるときはリンク
      if($ext && is_file($path.$time.$ext)){
        $img_flag = TRUE;
        $clip = "<a href=\"".IMG_DIR.$time.$ext."\" target=_blank>".$time.$ext."</a><br>";
        $size = filesize($path.$time.$ext);
        $all += $size;			// 合計計算
        $chk= substr($chk,0,10);
      }else{
        $clip = "";
        $size = 0;
        $chk= "";
      }
      $bg = ($bgcol++ % 2) ? "d6d6f6" : "f6f6f6";// 背景色

      echo "<tr bgcolor=$bg><th><input type=checkbox name=\"$no\" value=sage></th>";
      echo "<th>$no</th><th>$url</th><td><small>$now</small></td><td>$sub</td>";
      echo "<td><b>$name</b></td><td><small>$com</small></td>";
      echo "<td>$host</td><td align=center>$clip($size)</td>\n";
      echo "</tr>\n";
    }
  }
  echo "</table>\n<p><input type=submit value=\"変更$msg\">";
  echo "<input type=reset value=\"リセット\"></form>";

  $all = (int)($all / 1024);
  echo "【 画像データ合計 : <b>$all</b> KB 】";
  die("</center></body></html>");
}

/* 初期設定 */
function init(){
  $chkfile=array(LOGFILE,TREEFILE,MOE_DLOG);
  if(!is_writable(realpath("./")))error("カレントディレクトリに書けません<br>");
  foreach($chkfile as $value){
    if(!file_exists(realpath($value))){
      $fp = fopen($value, "w");
      set_file_buffer($fp, 0);
      if($value==LOGFILE)fputs($fp,"1,2002/01/01(月) 00:00,名無し,,無題,本文なし,,,,,,,,,\n");
      if($value==TREEFILE)fputs($fp,"1\n");
      if($value==MOE_DLOG)fputs($fp,"");
      fclose($fp);
      if(file_exists(realpath($value)))@chmod($value,0666);
    }
    if(!is_writable(realpath($value)))$err.=$value."を書けません<br>";
    if(!is_readable(realpath($value)))$err.=$value."を読めません<br>";
  }
  @mkdir(IMG_DIR,0777);@chmod(IMG_DIR,0777);
  if(!is_dir(realpath(IMG_DIR)))$err.=IMG_DIR."がありません<br>";
  if(!is_writable(realpath(IMG_DIR)))$err.=IMG_DIR."を書けません<br>";
  if(!is_readable(realpath(IMG_DIR)))$err.=IMG_DIR."を読めません<br>";
  if(MOE_COUNT){
    @mkdir(MOE_LOG,0777);@chmod(MOE_LOG,0777);
    if(!is_dir(realpath(MOE_LOG)))$err.=MOE_LOG."がありません<br>";
    if(!is_writable(realpath(MOE_LOG)))$err.=MOE_LOG."を書けません<br>";
    if(!is_readable(realpath(MOE_LOG)))$err.=MOE_LOG."を読めません<br>";

    @mkdir(MOE_IMG,0777);@chmod(MOE_IMG,0777);
    if(!is_dir(realpath(MOE_IMG)))$err.=MOE_IMG."がありません<br>";
    if(!is_writable(realpath(MOE_IMG)))$err.=MOE_IMG."を書けません<br>";
    if(!is_readable(realpath(MOE_IMG)))$err.=MOE_IMG."を読めません<br>";
  }
  if(USE_THUMB){
    @mkdir(THUMB_DIR,0777);@chmod(THUMB_DIR,0777);
    if(!is_dir(realpath(IMG_DIR)))$err.=THUMB_DIR."がありません<br>";
    if(!is_writable(realpath(THUMB_DIR)))$err.=THUMB_DIR."を書けません<br>";
    if(!is_readable(realpath(THUMB_DIR)))$err.=THUMB_DIR."を読めません<br>";
  }
  if(IMG_REFER){
    @mkdir(IMG_REF_DIR,0777);@chmod(IMG_REF_DIR,0777);
    if(!is_dir(realpath(IMG_REF_DIR)))$err.=IMG_REF_DIR."がありません<br>";
    if(!is_writable(realpath(IMG_REF_DIR)))$err.=IMG_REF_DIR."を書けません<br>";
    if(!is_readable(realpath(IMG_REF_DIR)))$err.=IMG_REF_DIR."を読めません<br>";
  }
  if(RES_FILE){
    @mkdir(RES_DIR,0777);@chmod(RES_DIR,0777);
    if(!is_dir(realpath(RES_DIR)))$err.=RES_DIR."がありません<br>";
    if(!is_writable(realpath(RES_DIR)))$err.=RES_DIR."を書けません<br>";
    if(!is_readable(realpath(RES_DIR)))$err.=RES_DIR."を読めません<br>";
  }
  if($err)error($err);
}

/* ログの全体更新 */
function updateall(){

  // 画像板のhtmlを更新
  updatelog();

  // ツリーログを検索して各スレのhtmlファイルを作成
  if(RES_FILE){
    $ttree = file(TREEFILE);
    foreach ($ttree as $tval){
      list($no,) = explode(",",rtrim($tval));
      updatelog($no);
    }
  }
  echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=".PHP_SELF2."\">";
}


/* 萌えカウントカウントアップシステム（旧moecount.php） */
function moecount(){
  global $mcount,$moeno;

  echo '<body bgcolor="'.BG_COL.'" text="'.TXT_COL.'" link="'.LINK_COL.'" vlink="'.VLINK_COL.'">'."\n".
       '<p align="center"><BR>'."\n";

  $ip = $_SERVER['REMOTE_ADDR'];      
  $mlogfile= MOE_LOG.$mcount.MOE_KAKU;

  $logmoe = file($mlogfile);
  $ipflag = FALSE;

  for($m=0; $m<count($logmoe); $m++){
    list($vcountlog,$viplog) = split(",",$logmoe[$m]);

    if($viplog==$ip && MOE_IPC){$ipflag=TRUE;break;}
    if(!$ipflag){

      if($vcountlog != 'DEN'){
        $count = $vcountlog + 1;
      }else{
        $count = 'DEN';
      }
      if($count >= MOE_DCNT){$count = 'DEN';} // 殿堂イン
      $new = implode(",", array($count,$ip));
      $fp = fopen($mlogfile, "w");
      set_file_buffer($fp, 0);
      flock($fp,2);
      fputs($fp, "$new,\n");
      chmod($mlogfile,0666);
      fclose ($fp);
    }
  }

  if($ipflag){
    echo "<b><big>連続投票は出来ません。</big></b>";
  }else{
    echo "<b><big>萌えカウントに投票しました。</big></b>";
  }
  echo '<BR><BR>--- MoeCountSystem Ver 2.06 ---</P>';
  updatelog();
  if($moeno && RES_FILE){ updatelog($moeno); }
  echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL=".PHP_SELF."\">";
}

/* 萌えカウント殿堂ギャラリ（旧denview.php) */
function denview(){
  global $denpage,$st,$stn,$npage;

  echo '<HTML>'."\n".'<HEAD>'."\n".
       '<META HTTP-EQUIV="Content-Type" CONTENT="text/html;CHARSET=x-sjis">'."\n".
       '<STYLE TYPE="text/css">'."\n".
       '<!--'."\n".
       'a:hover { color:#DD0000; }'."\n\n".
       'table {border-color:#7b0000;border-style:solid;border-width:1px 1px 1px 1px;}'."\n\n".
       '.twelve { font-size:12pt }'."\n".
       '-->'."\n".
       '</STYLE>'."\n".
       '<TITLE>'.MOE_TITLE.'</TITLE>'."\n".
       '</HEAD>'."\n".
       '<body bgcolor="'.BG_COL.'" text="'.TXT_COL.'" link="'.LINK_COL.'" vlink="'.VLINK_COL.'">'."\n";
  echo '<div align=right class=twelve>[<a href='.PHP_SELF2.'>掲示板に戻る</a>] [<a href="'.PHP_SELF.'?mode=admin">管理用</a>]</div>'."\n".
       '<p align=center><font color="#800000"size=+2><b>'.MOE_TITLE2.'</b></font>'."\n".
       '<font color=#cc1105><center>画像は'.DEN_MAX_CNT.'枚を超えると削除されます。</center></font></p>'."\n".'<center>'."\n";
  $dat = file(MOE_DLOG); // ログデータ読み込み
  $dendir = MOE_IMG;
  $st=MOE_DPG;
  $all=0;
  $stn=0; // 初期ポインタ
  if($denpage == 'next'){
    $stn= $npage + MOE_DPG;
    $st = $stn + MOE_DPG;
  }
  if($denpage == 'back'){
    $st = $npage;
    $stn= $st - MOE_DPG;
  }

  for($i = $stn; $i < $st ; $i++){
  	$img_flag = FALSE;
    list($no,$now,$name,$time,$ext,$w,$h,$chk)=explode(",", $dat[$i]);
    // 画像があるときはリンク
    if($ext && is_file($dendir.$time.$ext)){
      $img_flag = TRUE;
      $clip = "<a href=$dendir$time$ext target=_blank><img src=$dendir$time$ext border=0 width=$w height=$h></a>";
    }else{
      $clip = "画像削除済み";
    }
    if($i < count($dat)){
      echo "<TABLE border=0 width=90%>\n<TR>";
      echo "<TD bgcolor=#FFFFFF align=center>$clip</TD></TR>\n<TR>";
      echo "<TD bgcolor=#F0E0D6 align=center><font color=#800000>投稿者：<b>$name</b><BR>投稿日：$now</center></TD></TR>\n</TABLE><BR>\n";
    }
  }

  echo "<BR>".
       "<form action=".PHP_SELF." method=POST>".
       "<input type=hidden name=npage value=$stn>".
       "<input type=hidden name=denview value=view>";
  if($st != MOE_DPG){ echo "<input type=submit name=denpage value=back>"; }
  echo " <B>現在 $stn ～ $st</B> ";
  if($stn < count($dat) - MOE_DPG){ echo "<input type=submit name=denpage value=next>"; }

  echo "</center>\n</body>\n</html>";
}

/*-----------Main-------------*/
// GET リクエスト時に '/' が含まれる場合は終了する
$reqcheck = substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME']));
if (FALSE !== strpos($reqcheck, '/')) {
die('');
}

$buf='';
init();		//←■■初期設定後は不要なので削除可■■

// 萌えカウントカウントアップ
if($moeta == "countup"){
  moecount();
  die();
}
// 萌えカウント殿堂ギャラリ
if($denview == 'view'){
  denview();
  die();
}
// モードチェック
switch($mode){
  case 'regist':
    regist($name,$email,$sub,$com,'',$pwd,$upfile,$upfile_name,$resto);
    break;
  case 'admin':
    valid($pass);
    if($admin=="del") admindel($pass);
    if($admin=="post"){
      echo "</form>";
      form($post,$res,TRUE,FALSE);
      echo $post;
      die("</body></html>");
    }
    if($admin=="moecount"){
      adminmoe($pass);
      die();
    }
    if($admin=="moeden"){
      adminden($pass);
      die();
    }
    if(is_file($default_thumb) && $admin=="thumb") admin_chgthumb($pass);
    if(ADMIN_SAGE && $admin=="sage") admin_sage($pass);
    break;
  case 'reflesh':
    updateall();
    break;
  case 'usrdel':
    usrdel($no,$pwd);
  default:
    if($res){
      updatelog($res);
    }else{
      updatelog();
      echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=".PHP_SELF2."\">";
    }
}
?>
