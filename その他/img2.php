<?
/* �摜�f����
�ڍׂ� Readme.txt ���Q�Ƃ��Ă�������

******************************************�I���ӁI***************************************
�Eimg.log�̃t�@�C�����̓f�t�H���g����ς��Ă��g�p���������B
�@define(LOGFILE, 'img.log'); // ���O�t�@�C����
�E�ݒu�T�[�o�ɂ���Ă�index.htm�������Ɖ摜�f���ݒu�t�H���_���������Ă��܂��ꍇ������܂��B
�@���index.htm��u�����A�X�N���v�g�̓�����t�@�C�����w���index.htm�ɕύX���Ă��������B
�@define('PHP_SELF2', 'img.htm'); // ������t�@�C����
*****************************************************************************************
*/

// �G���[��S�ĕ\������悤�ݒ�
//error_reporting(E_ALL);

extract($_POST);
extract($_GET);
extract($_COOKIE);
$upfile_name=$_FILES["upfile"]["name"];
$upfile=$_FILES["upfile"]["tmp_name"];

//�f���ݒ�-------------------------------------------------------------------

define('ADMIN_PASS', 'admin_pass');	// �Ǘ��҃p�X
define('LOGFILE', 'img.log');		// ���O�t�@�C����
define('TREEFILE', 'tree.log');		// ���O�t�@�C����
define('IMG_DIR', 'src/');			// �摜�ۑ��f�B���N�g���Bimg.php���猩��
define('THUMB_DIR', 'thumb/');		// �T���l�C���ۑ��f�B���N�g��
define('TITLE', '�摜�f����');		// �^�C�g���i<title>
define('TITLE2', '�摜�f������');	// �^�C�g���iTOP
define('HOME', '../');				// �u�z�[���v�ւ̃����N
define('MAX_KB', '500');			// ���e�e�ʐ��� KB�iphp�̐ݒ�ɂ��2M�܂�
define('MAX_W', '250');				// ���e�T�C�Y���i����ȏ��width���k��
define('MAX_H', '250');				// ���e�T�C�Y����
define('MAX_W_RES', '200');			// ���X�̓��e�T�C�Y���i����ȏ��width���k��
define('MAX_H_RES', '200');			// ���X�̓��e�T�C�Y����
define('PAGE_DEF', '10');			// ��y�[�W�ɕ\������L��
define('FOLL_ADD', '200');			// �ȉ��ȗ��i��y�[�W�ɕ\������L���~�w��Ő����ݒ萔
define('LOG_MAX', '500');			// ���O�ő�s��
define('PHP_SELF', 'img.php');		// ���̃X�N���v�g��
define('PHP_SELF2', 'img.htm');		// ������t�@�C����
define('PHP_EXT', '.htm');			// 1�y�[�W�ȍ~�̊g���q
define('RENZOKU', '5');				// �A�����e�b��
define('RENZOKU2', '3');			// �摜�A�����e�b��
define('MAX_RES', '30');			// ����sage���X��
define('USE_THUMB', '1');			// �T���l�C�������  ����:1 ���Ȃ�:0
define('PROXY_CHECK', '0');			// proxy�̏����݂𐧌�����  y:1 n:0
define('DISP_ID', '0');				// ID��\������  ����:2 ����:1 ���Ȃ�:0
define('BR_CHECK', '15');			// ���s��}������s��  ���Ȃ�:0
define('EN_AUTOLINK', '0');			// URL���������N���s��  ����:1 ���Ȃ�:0
define('EN_SEC', '1');				// ���ԕ\���Ɂu�b�v���܂߂�  �܂߂�:1 �܂߂Ȃ�:0
define('RES_MARK', '�c');			// ���X�̓��ɕt���镶����
define('OMIT_RES', '10');			// �u���X�ȗ��v��\�����郌�X�̐�
define('OMIT_RES_IMG','5');			// �u���X�ȗ��v��\�����郌�X�̐��i�摜�t���X�̏ꍇ
define('USE_GIF_THUMB', '0');		// GIF�\���ɃT���l�C�����g�p����  ����:1 ���Ȃ�:0
define('EN_SAGE_START', '1');		// �X���勭��sage�@�\���g�p����  ����:1 ���Ȃ�:0
define('MAX_PASSED_HOUR', '0');		// ����sage�܂ł̎���  0�ŋ���sage�Ȃ�

define('CHECK_ANI', '1');			// �A�j���[�V����GIF���ǂ����`�F�b�N����  ����:1  ���Ȃ�:0
define('AD_INSERT', '1');			// �L����}������  ����:1  ���Ȃ�:0

//���X�摜�Y�t�@�\-------------------------------------------------------------
define('RES_IMG', '1');				// ���X�ɂ��摜��Y�t�ł���悤�ɂ���  �Y�t�\:1 �Y�t�s��:0
define('RES_IMG_LIMIT', '20');		// ���X�摜�������
define('RES_IMG_LIMIT_NOTICE','1');	// ���X�摜�c�荐�m����  ����:1  ���Ȃ�:0

//���׌y��html�o�R�֌W---------------------------------------------------------
define('RES_FILE', '0');			// ���X��html�o�R�ɂ���  ����:1 ���Ȃ�:0
define('RES_DIR', 'res/');			// ���Xhtml�i�[�f�B���N�g��

//�c�[������html�o�R�֌W-------------------------------------------------------
define('IMG_REFER', '1');			// �c�[�������ɉ摜�����N��html�o�R�ɂ���  ����:1 ���Ȃ�:0
define('IMG_REF_DIR', 'ref/');		// �o�R��html�i�[�f�B���N�g��

//�Ǘ��Ґ�sage�@�\-------------------------------------------------------------
define('ADMIN_SAGE', '1');			// �Ǘ��ҋ���sage����  ����:1 ���Ȃ�:0
define('NOTICE_SAGE', '1');			// ����sage�����m����  ����:1 ���Ȃ�:0

//�T���l�C���Ǘ��ҍ������@�\---------------------------------------------------
define('REPLACE_EXT', '.replaced');	// �����ւ��̍ہA���X�̃T���l�C���t�@�C���̂��K�ɕt���镶��
define('NOTICE_THUMB', '1');		// �T���l�����ւ������m����  ����:1 ���Ȃ�:0
// ���ڂ𑝂₷�ꍇ�͒萔�錾�����t�@�C�����A�^�C�g����$rep_thumb�z��ɒǉ����܂��B
// �������萔�錾���Ȃ��Œ��ڔz��ɒǉ����Ă�OK
define('R_THUM1', 'replace_n.jpg');	// �����ւ��T���l(1) �t�@�C����
define('R_TITL1', '�ӂ�');		// �����ւ��T���l(1) �^�C�g��
define('R_THUM2', 'replace_g.jpg');	// �����ւ��T���l(2) �t�@�C����
define('R_TITL2', '����');			// �����ւ��T���l(2) �^�C�g��
define('R_THUM3', 'replace_l.jpg');	// �����ւ��T���l(3) �t�@�C����
define('R_TITL3', '���');			// �����ւ��T���l(3) �^�C�g��
define('R_THUM4', 'replace_3.jpg');	// �����ւ��T���l(4) �t�@�C����
define('R_TITL4', '����');		// �����ւ��T���l(4) �^�C�g��
$rep_thumb = array(R_TITL1=>R_THUM1,R_TITL2=>R_THUM2,R_TITL3=>R_THUM3,R_TITL4=>R_THUM4);
$default_thumb = R_THUM1;			// �f�t�H���g�̃T���l�t�@�C����
// �t�@�C���������ꍇ�͍����ւ��@�\�������ɂȂ�܂��B

define('NO_TITLE', '����');			// �^�C�g���ȗ����̃^�C�g��
define('NO_COM', '�{���Ȃ�');		// �{���ȗ����̖{��
define('NO_NAME', '������');		// ���O�ȗ����̖��O

define('BG_COL', '#FFFFEE');		// �w�i�F
define('TXT_COL', '#800000');		// �����F
define('LINK_COL', '#0000EE');		// �����N�F
define('VLINK_COL', '#0000EE');		// �K��ς݃����N�F
define('TIT_COL', '#800000');		// �f���^�C�g���J���[
define('RE_COL', '789922');			// �����t�������̐F
define('RE_BGCOL', '#F0E0D6');		// �����X�L���̔w�i�J���[
define('SUB_COL', '#cc1105');		// ���^�C�g���J���[
define('NAME_COL', '#117743');		// �����O�J���[

//(�E�́E)Ӵ��J�E���g�ݒ�------------------------------------------------------

define('MOE_COUNT', '1');			// �G���J�E���g���g�p����  ����:1 ���Ȃ�:0
define('MOE_COUNT_RES', '1');		// ���X�ɖG���J�E���g���g�p����  ����:1 ���Ȃ�:0
define('MOE_LOG', 'moecount/');		// �G���J�E���g���O�t�H���_
define('MOE_KAKU', '.log');			// �J�E���g���O�g���q
define('MOE_DLOG', 'moeden.log');	// �a�����O
define('MOE_IMG', 'src_d/');		// �a���摜�ۑ��t�H���_
define('MOE_IPC', '0');				// �A�����e��IP�K���������邩�ۂ�  y:1 n:0
define('MOE_DCNT', '10');			// �a������ɂȂ�J�E���g��
define('MOE_DPG', '5');				// �a���M�������[�P�y�[�W�\����
define('MOE_BOT', '0');				// �G���{�^���ɉ摜���g�����ۂ�  y:1 n:0
define('MOE_BOTP', 'moeta.gif');	// �G���{�^���̉摜
define('MOE_BOTT', '(�E�́E)Ӵ�!!!');	// �G���{�^���̕���
define('MOE_BOTT2', '[Ӵ-!!!]');		// �G���{�^���̕����i�摜�t���X�̏ꍇ
define('DEN_MSG', ':*:��,��ߥ:*:��,�a������,��:*:�߁�,��:*: ');// �a�����胁�b�Z�[�W
define('DEN_MSG2', '�a������.');	// �a�����胁�b�Z�[�W�i�摜�t���X�̏ꍇ

define('MOE_TITLE', '�a���M�������[');	// �a���M�������[�^�C�g���i<title>
define('MOE_TITLE2', '�G���J�E���g�a������摜�M�������[');// �a���M�������[�^�C�g���iTOP
define('MOE_TLINK', '�G���J�E���g�a���M�������[');	// �a���M�������[�����N���b�Z�[�W

define('MOE_MSG0','Ӵ��');		// �G�����ݒl�\������(0�J�E���g)
define('MOE_MSG1','Ӵ��');		// �G�����ݒl�\������(1�J�E���g�`MOE_DCNT��20%)
define('MOE_MSG2','Ӵ��');		// �G�����ݒl�\������(MOE_DCNT��20%�`40%)
define('MOE_MSG3','Ӵ��');		// �G�����ݒl�\������(MOE_DCNT��40%�`60%)
define('MOE_MSG4','Ӵ��');		// �G�����ݒl�\������(MOE_DCNT��60%�`80%)
define('MOE_MSG5','Ӵ��');		// �G�����ݒl�\������(MOE_DCNT��80%�`100%)

define('DEN_MAX_CNT','7');		// �a���M�������[�ɕۊǂ���摜�̍ő喇��

//-----------------------------------------------------------------------------

$path = realpath("./").'/'.IMG_DIR;
$badstring = array("dummy_string","dummy_string2","\.ws/","\.bbs\.ws/"); // ���₷�镶����
$badfile = array("dummy","dummy2"); // ���₷��t�@�C����md5
$badip = array("addr.dummy.com","addr2.dummy.com"); // ���₷��z�X�g
$addinfo='';

/* �w�b�_ */
function head(&$dat,$resno=0){// ����
  // ���X����PHP_SELF��HOME����ʃp�X��
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
        '[<a href="'.$home_path.'" target="_top">�z�[��</a>]'."\n".
        '[<a href="'.$self_path.'?mode=admin">�Ǘ��p</a>]'."\n".
        '<p align=center>'."\n".
        '<font color="'.TIT_COL.'" size=5><b><SPAN>'.TITLE2.'</SPAN></b></font>'."\n".
        '<hr width="90%" size=1>'."\n";
}
/* ���e�t�H�[�� */
function form(&$dat,$resno,$admin="",$imageflag=FALSE){
  global $addinfo;
  $maxbyte = MAX_KB * 1024;
  $no=$resno;
  // ���X����PHP_SELF��PHP_SELF2����ʃp�X��
  if($resno && RES_FILE){
    $self_path = '../'.PHP_SELF;
    $self2_path = '../'.PHP_SELF2;
  }else{
    $self_path = PHP_SELF;
    $self2_path = PHP_SELF2;
  }
  if($resno){
    $msg .= "[<a href=\"".$self2_path."\">�f���ɖ߂�</a>]\n";
    $msg .= "<table width='100%'><tr><th bgcolor=#e04000>\n";
    $msg .= "<font color=#FFFFFF>���X���M���[�h</font>\n";
    $msg .= "</th></tr></table>\n";
  }
  if($admin){
    $hidden = "<input type=hidden name=admin value=\"".ADMIN_PASS."\">";
    $msg = "<h4>�^�O�������܂�</h4>\n";
  }
  $dat.=$msg.'<center>'."\n".
        '<form action="'.$self_path.'" method="POST" enctype="multipart/form-data">'."\n".
        '<input type=hidden name=mode value="regist">'.$hidden.
        '<input type=hidden name="MAX_FILE_SIZE" value="'.$maxbyte.'">';
  if($no){$dat.='<input type=hidden name=resto value="'.$no.'">';}
  $dat.="\n".'<table cellpadding=1 cellspacing=1>'."\n".
        '<tr><td bgcolor=#eeaa88><b>���Ȃ܂�</b></td><td><input type=text name=name size="28"></td></tr>'."\n".
        '<tr><td bgcolor=#eeaa88><b>E-mail</b></td><td><input type=text name=email size="28"></td></tr>'."\n".
        '<tr><td bgcolor=#eeaa88><b>��@�@��</b></td><td><input type=text name=sub size="35">'.
        '<input type=submit value="���M����">';
  if(RES_IMG && $imageflag && $resno){
    $dat.='<font color="red"><b> �摜��Y�t���Ȃ��Ă����M�ł��܂��B</b></font>';
  }
  $dat.='</td></tr>'."\n".'<tr><td bgcolor=#eeaa88><b>�R�����g</b></td>'.
        '<td><textarea name=com cols="48" rows="4" wrap=soft></textarea></td></tr>'."\n";
  if(!$resno || (RES_IMG && $imageflag)){
    $dat.='<tr><td bgcolor=#eeaa88><b>�Y�tFile</b></td>'.
          '<td><input type=file name=upfile size="35"></td></tr>'."\n".
          '<tr><td bgcolor=#eeaa88><b>�I�v�V����</b></td><td>';
    if(!USE_GIF_THUMB){
      $dat.=' [<label><input type=checkbox name=noanime value=on checked>GIF�A�j����~</label>] ';
    }
    if(!$resno){
      if(RES_IMG){
        $dat.=' [<label><input type=checkbox name=imageres value=on checked>���X�ɉ摜�Y�t��������</label>] ';
      }
      $dat.=' [<label><input type=checkbox name=textonly value=on>�摜�Ȃ�</label>] ';
    }
    $dat.="</td></tr>\n";
  }
  $dat.='<tr><td bgcolor=#eeaa88><b>�폜�L�[</b></td>'.
        '<td><input type=password name=pwd size=10 maxlength=8 value=""><small>(�L���̍폜�p�B�p������8�����ȓ�)</small></td></tr>'."\n".
        '<tr><td colspan=2>'."\n".
        '<small>'."\n".
        '<LI>�Y�t�\FILE�FGIF, JPG, PNG. �ő�� '.MAX_KB.' KB �܂�. sage�@�\�t��.'."\n".
        '<LI> '.MAX_W.'px x '.MAX_H.'px �ȏ�k��.';
  if(RES_IMG){ $dat.='���X�摜 '.MAX_W_RES.'px x '.MAX_H_RES.'px �ȏ�k��.'."\n"; }
  $dat.='<LI>���['.MOE_DCNT.'�J�E���g�œa������. �X���傳��sage�ŋ���sage�X��.'."\n".$addinfo.
        '</small></td></tr></table></form></center><hr>'."\n";
}

/* �L������ */
function updatelog($resno=0){
  global $path;
  // ���X���͊e�p�X������ʃp�X��
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
      if($resno == $tline[0] || array_search($resno,$tline)){ // ���X�挟��
        $resno = $tline[0];
        $st = $i;
        $find = TRUE;
        break;
      }
    }
    if(!$find){ error("�Y���L�����݂���܂���@".$resno); }
  }
  // ���X�������̎擾�̂���(�ԐMhtml�쐬�p)
  $line = file(LOGFILE);
  $countline = count($line);
  $countimg = 0;
  for($i = 0; $i < $countline; $i++){
    list($no,,,,,,$url,,,$ext,,,$time,) = explode(",", $line[$i]); // ���X���̎������擾(�ԐMhtml�쐬�p)
    if($no == $resno){
      $thread_time = $time;
      if(RES_IMG && stristr($url,'_ires_')){ $imageflag = TRUE; }
    }elseif($resno){
     if(RES_IMG && array_search($no,$tline) && $ext && is_file($path.$time.$ext)){ $countimg++; }
    }
    $lineindex[$no]=$i + 1; // �t�ϊ��e�[�u���쐬
  }
  // ���X�摜��������ɂȂ����烌�X�摜�֎~
  if(RES_IMG && $resno && $countimg >= RES_IMG_LIMIT){ $imageflag = FALSE; }

  $counttree = count($tree);
  for($page=0;$page<$counttree;$page+=PAGE_DEF){
    $dat='';
    head($dat,$resno); // �Ăяo��
    form($dat,$resno,FALSE,$imageflag);
    if(!$resno){ $st = $page; }
    if(!MOE_COUNT){ $dat.='<form action="'.$self_path.'" method=POST>'."\n"; }

    for($i = $st; $i < $st+PAGE_DEF; $i++){
      if($tree[$i]=="") continue;
      $treeline = explode(",", rtrim($tree[$i]));
      $disptree = $treeline[0];
      $j=$lineindex[$disptree] - 1; //�Y���L����T����$j�ɃZ�b�g
      if($line[$j]=="") continue;   //$j���͈͊O�Ȃ玟�̍s
      // �X���쐬
      list($no,$now,$name,$email,$sub,$com,$url,
           $host,$pwd,$ext,$w,$h,$time,$chk) = explode(",", $line[$j]);
      // URL�ƃ��[���Ƀ����N
      if($email) $name = "<a href=\"mailto:$email\">$name</a>";
      $com = auto_link($com);
      $com = eregi_replace("(^|>)(&gt;[^<]*)", "\\1<font color=".RE_COL.">\\2</font>", $com);
      // �L���}���@�\
      if(AD_INSERT){
        $adarray[0]="<a href=\"www.ringo.com\">���</a>";
        $adarray[1]="<a href=\"www.banana.com\">�΂Ȃ�</a>";
        $adarray[2]="<a href=\"www.ichigo.com\">������</a>";
        $adarray[3]="<a href=\"www.milk.com\">�݂邭</a>";
      }
      // �摜�t�@�C����
      $img = $path.$time.$ext;
      $src = $img_path.$time.$ext;
      // �摜�o�R��html�t�@�C���쐬
      if (IMG_REFER && is_file($img) && !is_file(IMG_REF_DIR.$time.".htm")){
        $fp=fopen(IMG_REF_DIR.$time.".htm","w");
        flock($fp, 2);
        rewind($fp);
        fputs($fp, "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=../$src\">");
        fclose($fp);
      }
      //�G���J�E���g�V�X�e��---------------------------------------------------------
      if(MOE_COUNT){
      //���X���O�Ǘ��������Ȃ�܂����P�X���b�h�ɑ΂��P���O���쐬������@��
      //���p���܂��B�z�񌟍����̏������S���v��Ȃ��̂ŕ��ׂ�������Ȃ�����S�ł��B
      //�Œ���̏����̕��׋y�у��O�̈��S���̖ʂ���A���O�����̔������𖳎����܂��B

      //�ϐ��������i�I�[�g�����[�h�΍�
      $moeta='none';
      $denview='none';

      $mcountlog = 'NONE';
      $logmoe    = MOE_LOG.$time.MOE_KAKU;

      // �G���J�E���g��t�@�C���쐬
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
          // �a������t���O���Z�b�g����Ă�����摜�R�s�[
          $dendat = file(MOE_DLOG);
          $denflag = 0;
          for($iden=0; $iden<count($dendat); $iden++){ // �t�@�C�������[�v����
            list($mno,$mnow,$mname,$mtime,$mext,$mw,$mh,$mchk) = explode(",", $dendat[$iden]);
            if($mno == $no){ // ���O�ɑ��݂�����t���O���Z���ă��[�v�𔲂���
              $denflag++;
              break;
            }
          }
          if(!$denflag){
            // ���O���ɓ����X�����Ȃ�������ǉ�
            copy($src,MOE_IMG.$time.$ext); // �摜�t�@�C���R�s�[

            $delden = $dendat;
            while(count($delden)>=DEN_MAX_CNT){
              // �M�������[���摜�����������l�𒴂���Ƃ��͍폜
              list(,,,$dtime,$dext,,,) = explode(",",array_pop($delden)); // ���O�폜
              $del_path = MOE_IMG.$dtime.$dext;
              if(is_file($del_path)){ unlink($del_path); } // �摜�폜
            }

            $mnew = implode(",", array($no,$now,$name,$time,$ext,$w,$h,$chk));
            $fpd = fopen(MOE_DLOG, "w");
            flock($fpd,2); // �t�@�C���A�N�Z�X�r�����b�N
            fputs($fpd, "$mnew,\n");

            for($di = 0; $di < count($dendat); $di++)fputs($fpd, $dendat[$di]);
            fclose ($fpd);

          }
        }

          // �G���J�E���g���̃��b�Z�[�W���ꎞ�ʂ̕ϐ��ɃZ�b�g���Čォ��$dat�ɂ�������
          $votext = "";
          $dentext = "";

        // ���[�\���p
        if($mcountlog == 'DEN'){
          $dentext.="<b><font color=#ff0000 size=+2>".DEN_MSG."</font></b>";
        }else{
          $votext.="\n<center>".
                   "<form action=".$self_path." method=POST>".
                   "<input type=hidden name=moeno value=$no>".
                   "<input type=hidden name=moeta value=countup>".
                   "<input type=hidden name=mcount value=$time>\n";

          if(MOE_BOT){
            $votext.="<b><font color=#cc1105 size=+1>���[�F</font></b><input type=image src=".MOE_BOTP."></form></center>";
          }else{
            $votext.="<b><font color=#cc1105 size=+1>���[�F</font></b><input type=submit class=moetype value=".MOE_BOTT."></form></center>";
          }
          // �J�E���g�\���p
          if ($mcountlog >= MOE_DCNT*0.8){
            $dentext.="<b>����:<font color=#cc1105 size=+5>$mcountlog</font>".MOE_MSG5."</b>";
          }elseif ($mcountlog >= MOE_DCNT*0.6){
            $dentext.="<b>����:<font color=#cc1105 size=+4>$mcountlog</font>".MOE_MSG4."</b>";
          }elseif ($mcountlog >= MOE_DCNT*0.4){
            $dentext.="<b>����:<font color=#cc1105 size=+3>$mcountlog</font>".MOE_MSG3."</b>";
          }elseif ($mcountlog >= MOE_DCNT*0.2){
            $dentext.="<b>����:<font color=#cc1105 size=+2>$mcountlog</font>".MOE_MSG2."</b>";
          }elseif ($mcountlog >= 1){
            $dentext.="<b>����:<font color=#cc1105 size=+1>$mcountlog</font>".MOE_MSG1."</b>";
          } else {
            $dentext.="<b>����:<font color=#117783 size=+1>0</font>".MOE_MSG0."</b>";
          }
        }

      }
      }
      //�G���J�E���g�V�X�e��---------------------------------------------------------
      // <img�^�O�쐬
      $imgsrc = "";
      $dat_img= "";
      $ugoku="";
      if($ext && is_file($img)){
        $size = filesize($img); // alt�ɃT�C�Y�\��
        if($w && $h){ // �T�C�Y���擾�ł���ꍇ
          // ������(ry �\��
          if(CHECK_ANI && stristr($url,'_ugo_')){
            $ugoku = "���������(ry.";
          }
          // �X����A�j���[�V������~�w��
          if(@is_file(THUMB_DIR.$time.'s.jpg') &&
            (USE_GIF_THUMB||$ext!='.gif'||stristr($url,'noanime')||@is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT))){
            // �c�[������html�Q�Ƃ�ǉ�
            $imgsrc = "<small>�T���l�C����\�����Ă��܂�.�N���b�N����ƌ��̃T�C�Y��\�����܂�.$ugoku</small>\n<br>";
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
        }else{ // �T�C�Y���擾�ł��Ȃ��ꍇ
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
        if (IMG_REFER) { // ���X�ɉ摜������ �摜�֌W�^�O��ʕϐ���
          $dat_img="�摜�^�C�g���F<a href=\"".$ref_path.$time.".htm\" target=_blank>$time$ext</a>-($size B) $dentext<br>$imgsrc$votext";
        }else{
          $dat_img="�摜�^�C�g���F<a href=\"$src\" target=_blank>$time$ext</a>-($size B) $dentext<br>$imgsrc$votext";
        }
      }
      // ���C���쐬
      if(!$resno && AD_INSERT){ // �L���}���@�\
      $dat.="�L��:::<b>".$adarray[rand(0,count($adarray)-1)]."</b><br>";
      }
      $dat.=$dat_img; // �摜�֌W������������Ɉړ�
      if(!MOE_COUNT){
      $dat.="<input type=checkbox name=\"$no\" value=delete>";
      }
      $dat.="<font color=".SUB_COL." size=+1><b>$sub</b></font> \n";
      $dat.="Name <font color=".NAME_COL."><b>$name</b></font> $now No.$no &nbsp; ";
      if(RES_FILE){
        if(!$resno) $dat.="[<a href=\"".RES_DIR.$time.".htm\">�ԐM</a>]";
      }else{
        if(!$resno) $dat.="[<a href=".$self_path."?res=$no>�ԐM</a>]";
      }
      $dat.="<BR>\n";

      // ���낻�������B
      if($lineindex[$no]-1 >= LOG_MAX*0.95){
        $dat.="<font color=\"#f00000\"><b>���̃X���͌Â��̂ŁA�������������܂��B</b></font><br>\n";
      }
      // �Ǘ��҃T���l�����ւ����m
      if(NOTICE_THUMB && @is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)){
        $dat.="<font color=\"#f00000\"><small><b>".
              "���̋L���̉摜�͊Ǘ��҂ɂ��T���l�C���������ւ����Ă��܂��B���R�͂��@�����������B<br>".
              "�T���l�C�����N���b�N����ƌ��̉摜��\�����܂��B".
              "</b></small></font><br>\n";
      }
      // �Ǘ���sage���m
      if(NOTICE_SAGE && stristr($url,'sage')){
        $dat.="<font color=\"#f00000\"><small><b>".
              "���̃X���͊Ǘ��҂ɂ��sage�w�肳��Ă��܂��B���R�͂��@�����������B".
              "</b></small></font><br>\n";
      }
      // �摜���X�����m
      if(RES_IMG && RES_IMG_LIMIT_NOTICE && $resno && stristr($url,'_ires_')){
        if($countimg < RES_IMG_LIMIT){
          $dat.="<font color=\"#f00000\"><small><b>".
                "�摜�t���X�̏���܂ł��ƥ��".(RES_IMG_LIMIT - $countimg)."��".
                "</b></small></font><br>\n";
        }else{
          $dat.="<font color=\"#f00000\"><small><b>".
                "�摜�t���X���Ȃ������ς����".
                "</b></small></font><br>\n";
        }
      }

      $dat.="<blockquote>$com</blockquote>";

      // ���X�쐬
      if(!$resno){
        $omit_cnt = (RES_IMG && stristr($url,'_ires_')) ? OMIT_RES_IMG : OMIT_RES ;
        $s=count($treeline) - ($omit_cnt);
        if($s<1){ $s=1; }
        elseif($s>1){
          $dat.="<font color=\"#707070\">���X".
                ($s - 1)."���ȗ��B�S�ēǂނɂ͕ԐM�{�^���������Ă��������B</font><br>\n";
        }
      }else{$s=1;}
      for($k = $s; $k < count($treeline); $k++){
        $disptree = $treeline[$k];
        $j=$lineindex[$disptree] - 1;
        if($line[$j]=="") continue;
        list($no,$now,$name,$email,$sub,$com,$url,
             $host,$pwd,$ext,$w,$h,$time,$chk) = explode(",", $line[$j]);
        // URL�ƃ��[���Ƀ����N
        if($email) $name = "<a href=\"mailto:$email\">$name</a>";
        $com = auto_link($com);
        $com = eregi_replace("(^|>)(&gt;[^<]*)", "\\1<font color=".RE_COL.">\\2</font>", $com);
        // �摜�t�@�C����
        $img = $path.$time.$ext;
        $src = $img_path.$time.$ext;
        // �摜�o�R��html�t�@�C���쐬
        if (IMG_REFER && is_file($img) && !is_file(IMG_REF_DIR.$time.".htm")){
          $fp=fopen(IMG_REF_DIR.$time.".htm","w");
          flock($fp, 2);
          rewind($fp);
          fputs($fp, "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=../$src\">");
          fclose($fp);
        }
        //�G���J�E���g�V�X�e��---------------------------------------------------------
        if(MOE_COUNT && MOE_COUNT_RES){
        //���X���O�Ǘ��������Ȃ�܂����P�X���b�h�ɑ΂��P���O���쐬������@��
        //���p���܂��B�z�񌟍����̏������S���v��Ȃ��̂ŕ��ׂ�������Ȃ�����S�ł��B
        //�Œ���̏����̕��׋y�у��O�̈��S���̖ʂ���A���O�����̔������𖳎����܂��B

        //�ϐ��������i�I�[�g�����[�h�΍�
        $moeta='none';
        $denview='none';

        $mcountlog = 'NONE';
        $logmoe    = MOE_LOG.$time.MOE_KAKU;

        // �G���J�E���g��t�@�C���쐬
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
            // �a������t���O���Z�b�g����Ă�����摜�R�s�[
            $dendat = file(MOE_DLOG);
            $denflag = 0;
            for($iden=0; $iden<count($dendat); $iden++){ // �t�@�C�������[�v����
              list($mno,$mnow,$mname,$mtime,$mext,$mw,$mh,$mchk) = explode(",", $dendat[$iden]);
              if($mno == $no){ // ���O�ɑ��݂�����t���O���Z���ă��[�v�𔲂���
                $denflag++;
                break;
              }
            }
            if(!$denflag){
              // ���O���ɓ����X�����Ȃ�������ǉ�
              copy($src,MOE_IMG.$time.$ext); // �摜�t�@�C���R�s�[

            $delden = $dendat;
            while(count($delden)>=DEN_MAX_CNT){
              // �M�������[���摜�����������l�𒴂���Ƃ��͍폜
              list(,,,$dtime,$dext,,,) = explode(",",array_pop($delden)); // ���O�폜
              $del_path = MOE_IMG.$dtime.$dext;
              if(is_file($del_path)){ unlink($del_path); } // �摜�폜
            }

              $mnew = implode(",", array($no,$now,$name,$time,$ext,$w,$h,$chk));
              $fpd = fopen(MOE_DLOG, "w");
              flock($fpd,2); // �t�@�C���A�N�Z�X�r�����b�N
              fputs($fpd, "$mnew,\n");

              for($di = 0; $di < count($dendat); $di++)fputs($fpd, $dendat[$di]);
              fclose ($fpd);

            }
          }

          // �G���J�E���g���̃��b�Z�[�W���ꎞ�ʂ̕ϐ��ɃZ�b�g���Čォ��$dat�ɂ�������
          $votext = "";
          $dentext = "";

          // ���[�\���p
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
            // �G���J�E���g�\���p
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
          // $dat�ɖG���e�L�X�g����������
          // $dat .= $votext;
        }
        }
        if(!MOE_COUNT_RES){ $votext = ""; $dentext = ""; } //�G���J�E���g�\���N���A
        //�G���J�E���g�V�X�e��---------------------------------------------------------
        // <img�^�O�쐬
        $imgsrc = "";
        $dat_img= "";
        $ugoku="";
        $thumb="";
        if($ext && is_file($img)){
          $size = filesize($img); // alt�ɃT�C�Y�\��
          if($w && $h){ // �T�C�Y���擾�ł���ꍇ
            // ������(ry �\��
            if(CHECK_ANI && stristr($url,'_ugo_')){
              $ugoku = "���������(ry.";
            }
            // �X����A�j���[�V������~�w��
            if(@is_file(THUMB_DIR.$time.'s.jpg') &&
              (USE_GIF_THUMB||$ext!='.gif'||stristr($url,'noanime')||@is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT))){
              // �c�[������html�Q�Ƃ�ǉ�
              $thumb = " <small>�T���l�\��.$ugoku</small>\n";
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
          }else{ // �T�C�Y���擾�ł��Ȃ��ꍇ
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
          if (IMG_REFER) { // ���X�ɉ摜������ �摜�֌W�^�O��ʕϐ���
            $dat_img="$dentext<br>�摜�t�@�C�����F<a href=\"".$ref_path.$time.".htm\" target=_blank>$time$ext</a>-($size B)$thumb<br>$imgsrc$votext\n";
          }else{
            $dat_img="$dentext<br>�摜�t�@�C�����F<a href=\"$src\" target=_blank>$time$ext</a>-($size B)$thumb<br>$imgsrc$votext\n";
          }
        }

        // �ʕϐ��ɓ��ꂽ�摜�p�^�O��������e�[�u���̒��ɔz�u
        // ���C���쐬
        $dat.="\n<table border=0><tr><td nowrap align=right valign=top>".RES_MARK."</td><td bgcolor=".RE_BGCOL.">\n";
        if(!MOE_COUNT){
          $dat.="<input type=checkbox name=\"$no\" value=delete>";
        }
        $dat.="<font color=".SUB_COL." size=+1><b>$sub</b></font> \n";
        $dat.="Name <font color=".NAME_COL."><b>$name</b></font> $now No.$no \n";
        $dat.="$dat_img";
        // �Ǘ��҃T���l�����ւ����m
        if(NOTICE_THUMB && @is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)){
          $dat.="<font color=\"#f00000\"><small><b>".
                "�T���l�C�������ւ����B".
                "</b></small></font><br>\n";
        }
        $dat.="<blockquote>$com</blockquote>";
        $dat.="</td></tr></table>";

      }
      $dat.="<br clear=left><hr>\n";
      clearstatcache(); // �t�@�C����stat���N���A
      $p++;
      if($resno){break;} // res����tree1�s����
    }

    if(!MOE_COUNT){
      $dat.='<table align=right><tr><td nowrap align=center>'."\n".
            '<input type=hidden name=mode value=usrdel>�y�L���폜�z[<input type=checkbox name=onlyimgdel value=on>�摜��������]<br>'."\n".
            '�폜�L�[<input type=password name=pwd size=10 maxlength=8 value="">'."\n".
            '<input type=submit value="�폜"></form></td></tr></table>'."\n";
    }else{
      $dat.='<table align=right><tr><td nowrap align=center><form action="'.$self_path.'" method=POST>'."\n".
            '<input type=hidden name=mode value=usrdel>�y�L���폜�z[<input type=checkbox name=onlyimgdel value=on>�摜��������]<br>'."\n".
            '�L��No<input type=text name=no size=8 value="">�폜�L�[<input type=password name=pwd size=5 maxlength=12 value="">'."\n".
            '<input type=submit value="�폜"></form></td></tr></table>'."\n";
    }

    if(!$resno){ // res���͕\�����Ȃ�
      $prev = $st - PAGE_DEF;
      $next = $st + PAGE_DEF;
      // ���y�[�W����
      $dat.="<table align=left border=1><tr>";
      if($prev >= 0){
        if($prev==0){
          $dat.="<form action=\"".PHP_SELF2."\" method=get><td>";
        }else{
          $dat.="<form action=\"".$prev/PAGE_DEF.PHP_EXT."\" method=get><td>";
        }
        $dat.="<input type=submit value=\"�O�̃y�[�W\">";
        $dat.="</td></form>";
      }else{$dat.="<td>�ŏ��̃y�[�W</td>";}

      $dat.="<td>";
      for($i = 0; $i < count($tree) ; $i+=PAGE_DEF){
        if($i>=FOLL_ADD){$dat.="[�ȉ��ȗ�]";break;}
        if($st==$i){$dat.="[<b>".($i/PAGE_DEF)."</b>] ";
        }else{
          if($i==0){$dat.="[<a href=\"".PHP_SELF2."\">0</a>] ";}
          else{$dat.="[<a href=\"".($i/PAGE_DEF).PHP_EXT."\">".($i/PAGE_DEF)."</a>] ";}
        }
      }
      $dat.="</td>";

      if($p >= PAGE_DEF && count($tree) > $next && $next < FOLL_ADD){
        $dat.="<form action=\"".$next/PAGE_DEF.PHP_EXT."\" method=get><td>";
        $dat.="<input type=submit value=\"���̃y�[�W\">";
        $dat.="</td></form>";
      }else{$dat.="<td>�Ō�̃y�[�W</td>";}
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
/* �t�b�^ */
function foot(&$dat){
  $dat.="\n".'<center>'."\n".
        '<small><!-- GazouBBS v3.0 --><!-- �ӂ��Ή�0.8 -->'."\n".
        '- <a href="http://php.s3.to" target=_top>GazouBBS</a> + <a href="http://www.2chan.net/" target=_top>futaba</a> -<BR>'."\n".
        '<!-- �G���A2.06 --><!-- ���������1.0.3 -->'."\n".
        '- <a href="http://moepic.dip.jp/gazo/" target=_top>moeren</a> + <a href="http://siokara.que.jp/" target=_top>siokara</a> -'."\n".
        '</small>'."\n".
        '</center>'."\n".
        '</body></html>'."\n";
}
/* �I�[�g�����N */
function auto_link($proto){
  if(EN_AUTOLINK){
    $proto = ereg_replace("(https?|ftp|news)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)","<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",$proto);
  }
  return $proto;
}
/* �G���[��� */
function error($mes,$dest=''){
  global $upfile_name,$path;
  if(is_file($dest)) unlink($dest);
  head($dat,FALSE);
  echo $dat;
  echo "<br><br><hr size=1><br><br>\n".
       "<center><font color=red size=5><b>$mes<br><br><a href=".PHP_SELF2.">�����[�h</a></b></font></center>\n".
       "<br><br><hr size=1>\n";
  die("</body></html>");
}
/* �v���N�V�ڑ��`�F�b�N */
function  proxy_connect($port) {
  $fp = fsockopen ($_SERVER["REMOTE_ADDR"], $port,$a,$b,2);
  if(!$fp){return 0;}else{return 1;}
}
/* �L���������� */
function regist($name,$email,$sub,$com,$url,$pwd,$upfile,$upfile_name,$resto){
  global $path,$badstring,$badfile,$badip,$pwdc,$textonly,$noanime,$imageres;

  // ����
  $time = time();
  $tim = $time.substr(microtime(),2,3);

  // �A�b�v���[�h����
  if($upfile&&file_exists($upfile)){
    $dest = $path.$tim.'.tmp';
    move_uploaded_file($upfile, $dest);
    //���ŃG���[�Ȃ火�ɕύX
    //copy($upfile, $dest);
    $upfile_name = CleanStr($upfile_name);
    if(!is_file($dest)) error("�A�b�v���[�h�Ɏ��s���܂���<br>�T�[�o���T�|�[�g���Ă��Ȃ��\��������܂�",$dest);
    $size = getimagesize($dest);
    if(!is_array($size)) error("�A�b�v���[�h�Ɏ��s���܂���<br>�摜�t�@�C���ȊO�͎󂯕t���܂���",$dest);
    $chk = md5_of_file($dest);
    foreach($badfile as $value){if(ereg("^$value",$chk)){
      error("�A�b�v���[�h�Ɏ��s���܂���<br>�����摜������܂���",$dest); // ����摜
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

    // �摜�ő�T���l�T�C�Y�I��
    if(!$resto){
      $max_size_w = MAX_W;
      $max_size_h = MAX_H;
    }else{
      $max_size_w = MAX_W_RES;
      $max_size_h = MAX_H_RES;
    }
    // �摜�\���k��
    if($W > $max_size_w || $H > $max_size_h){
      $W2 = $max_size_w / $W;
      $H2 = $max_size_h / $H;
      ($W2 < $H2) ? $key = $W2 : $key = $H2;
      $W = ceil($W * $key);
      $H = ceil($H * $key);
    }
    $mes = "�摜 $upfile_name �̃A�b�v���[�h���������܂���<br><br>";
  }

  foreach($badstring as $value){if(ereg($value,$com)||ereg($value,$sub)||ereg($value,$name)||ereg($value,$email)){
  error("���₳��܂���(str)",$dest);};}
  if($_SERVER["REQUEST_METHOD"] != "POST") error("�s���ȓ��e�����Ȃ��ŉ�����(post)",$dest);
  // �t�H�[�����e���`�F�b�N
  if(!$name||ereg("^[ |�@|]*$",$name)) $name="";
  if(!$com||ereg("^[ |�@|\t]*$",$com)) $com="";
  if(!$sub||ereg("^[ |�@|]*$",$sub))   $sub=""; 

  if(!$resto&&!$textonly&&!is_file($dest)) error("�摜������܂���",$dest);
  if(!$com&&!is_file($dest)) error("���������ĉ�����",$dest);

  $name=ereg_replace("�Ǘ�","\"�Ǘ�\"",$name);
  $name=ereg_replace("�폜","\"�폜\"",$name);

  if(strlen($com) > 1000) error("�{�����������܂����I",$dest);
  if(strlen($name) > 100) error("���O���������܂����I",$dest);
  if(strlen($email) > 100) error("���[�������������܂����I",$dest);
  if(strlen($sub) > 100) error("�薼���������܂����I",$dest);
  if(strlen($resto) > 10) error("���X�ԍ��w�肪�ُ�ł�",$dest);
  if(strlen($url) > 10) error("URL�w�肪�ُ�ł�",$dest);

  // �z�X�g�擾
  $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);

  foreach($badip as $value){ // ����host
   if(eregi("$value$",$host)){
    error("���₳��܂���(host)",$dest);
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
      error("�d�q�q�n�q�I�@���J�o�q�n�w�x�K�����I�I(80)",$dest);
    } elseif(proxy_connect('8080') == 1){
      error("�d�q�q�n�q�I�@���J�o�q�n�w�x�K�����I�I(8080)",$dest);
    }
  }

  // No.�ƃp�X�Ǝ��Ԃ�URL�t�H�[�}�b�g
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
  $youbi = array('��','��','��','��','��','��','�y');
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
      $now .= " ID:".substr(crypt(md5($_SERVER["REMOTE_ADDR"].'id�̎�'.gmdate("Ymd", $time+9*60*60)),'id'),-8);
    }
  }
  // �e�L�X�g���`
  $email= CleanStr($email);  $email=ereg_replace("[\r\n]","",$email);
  $sub  = CleanStr($sub);    $sub  =ereg_replace("[\r\n]","",$sub);
  $url  = CleanStr($url);    $url  =ereg_replace("[\r\n]","",$url);
  $resto= CleanStr($resto);  $resto=ereg_replace("[\r\n]","",$resto);
  $com  = CleanStr($com);
  // ���s�����̓���B 
  $com = str_replace( "\r\n",  "\n", $com); 
  $com = str_replace( "\r",  "\n", $com);
  // �A�������s����s
  $com = ereg_replace("\n((�@| )*\n){3,}","\n",$com);
  if(!BR_CHECK || substr_count($com,"\n")<BR_CHECK){
    $com = nl2br($com); // ���s�����̑O��<br>��������
  }
  $com = str_replace("\n",  "", $com); // \n�𕶎��񂩂�����B

  $name=ereg_replace("��","��",$name);
  $name=ereg_replace("[\r\n]","",$name);
  $names=$name;
  $name = CleanStr($name);
  if(ereg("(#|��)(.*)",$names,$regs)){
    $cap = $regs[2];
    $cap=strtr($cap,"&amp;", "&");
    $cap=strtr($cap,"&#44;", ",");
    $name=ereg_replace("(#|��)(.*)","",$name);
    $salt=substr($cap."H.",1,2);
    $salt=ereg_replace("[^\.-z]",".",$salt);
    $salt=strtr($salt,":;<=>?@[\\]^_`","ABCDEFGabcdef"); 
    $name.="</b>��".substr(crypt($cap,$salt),-10)."<b>";
  }

  if(!$name) $name=NO_NAME;
  if(!$com) $com=NO_COM;
  if(!$sub) $sub=NO_TITLE; 

  // �X����̃A�j���[�V������~�w���ǉ�
  if ($ext=='.gif' && $noanime=='on'){ $url.='noanime';}

  // �A�j���[�V����GIF���ǂ������f
  if( $ext==".gif" && CHECK_ANI ){
    // �`�F�b�N�p�O���R�}���h�Ăяo��
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
    // �R�}���h�߂�l���`�F�b�N����2�ȏ�(2�t���[���ȏ�)�̂Ƃ��͈������
    if($rtn > 1){ $url .= '_ugo_'; }
  }

  // �摜�t���X�̋��Z�b�g
  if(RES_IMG && $imageres == 'on'){ $url .= '_ires_'; }

  // ���O�ǂݍ���
  $fp=fopen(LOGFILE,"r+");
  flock($fp, 2);
  rewind($fp);
  $buf=fread($fp,1000000);
  if($buf==''){error("error load log",$dest);}
  $line = explode("\n",$buf);
  $countline=count($line);
  for($i = 0; $i < $countline; $i++){
    if($line[$i]!=""){
      list($artno,)=explode(",", rtrim($line[$i])); // �t�ϊ��e�[�u���쐬
      $lineindex[$artno]=$i+1;
      $line[$i].="\n";
  }}

  // sage����(�X��sage�X�^�[�g�A���Ԍo��sage�A�Ǘ���sage)
  $flgsage=FALSE;
  if($resto){
    list(,,,$chkemail,,,$chkurl,,,,,,$ltime,) = explode(",", rtrim($line[$lineindex[$resto]-1]));
    if(strlen($ltime) > 10) { $ltime=substr($ltime,0,-3); }
    if(EN_SAGE_START && stristr($chkemail,'sage')){$flgsage=TRUE;}
    if(MAX_PASSED_HOUR && (($time - $ltime) >= (MAX_PASSED_HOUR*60*60))) { $flgsage=TRUE; }
    if(ADMIN_SAGE && stristr($chkurl,'sage')){$flgsage=TRUE;}
  }

  // ��d���e�`�F�b�N
  for($i=0;$i<20;$i++){
   list($lastno,,$lname,,,$lcom,,$lhost,$lpwd,,,,$ltime,) = explode(",", $line[$i]);
   if(strlen($ltime)>10){$ltime=substr($ltime,0,-3);}
   if($host==$lhost||substr(md5($pwd),2,8)==$lpwd||substr(md5($pwdc),2,8)==$lpwd){$pchk=1;}else{$pchk=0;}
   if(RENZOKU && $pchk && $time - $ltime < RENZOKU)
    error("�A�����e�͂������΂炭���Ԃ�u���Ă��炨�肢�v���܂�",$dest);
   if(RENZOKU && $pchk && $time - $ltime < RENZOKU2 && $upfile_name)
    error("�摜�A�����e�͂������΂炭���Ԃ�u���Ă��炨�肢�v���܂�",$dest);
   if(RENZOKU && $pchk && $com == $lcom && !$upfile_name)
    error("�A�����e�͂������΂炭���Ԃ�u���Ă��炨�肢�v���܂�",$dest);
  }

  // ���O�s���I�[�o�[
  if(count($line) >= LOG_MAX){
    for($d = count($line)-1; $d >= LOG_MAX-1; $d--){
      list($dno,,,,,,,,,$dext,,,$dtime,) = explode(",", $line[$d]);
      if(is_file($path.$dtime.$dext)) unlink($path.$dtime.$dext);
      if(is_file(THUMB_DIR.$dtime.'s.jpg')) unlink(THUMB_DIR.$dtime.'s.jpg');
      if(is_file(IMG_REF_DIR.$dtime.'.htm')) unlink(IMG_REF_DIR.$dtime.'.htm');
      if(is_file(RES_DIR.$dtime.'.htm')) unlink(RES_DIR.$dtime.'.htm');
      if(is_file(THUMB_DIR.$dtime.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$dtime.'s.jpg'.REPLACE_EXT);
      // �G���J�E���g���O�I�[�o�[�폜
      $delmoecount = MOE_LOG.$dtime.MOE_KAKU;
      if(is_file($delmoecount)) unlink($delmoecount);
      $line[$d] = "";
      treedel($dno,TRUE);
    }
  }
  // �A�b�v���[�h����
  if($dest&&file_exists($dest)){
    for($i=0;$i<200;$i++){ // �摜�d���`�F�b�N
     list(,,,,,,,,,$extp,,,$timep,$chkp,) = explode(",", $line[$i]);
     if($chkp==$chk&&file_exists($path.$timep.$extp)){
      error("�A�b�v���[�h�Ɏ��s���܂���<br>�����摜������܂�",$dest);
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

  // �c���[�X�V
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
  if(!$find){if(!$resto){$newline="$no\n";}else{error("�X���b�h������܂���",$dest);}}
  $newline.=implode('', $line);
  ftruncate($tp,0);
  set_file_buffer($tp, 0);
  rewind($tp);
  fputs($tp, $newline);
  fclose($tp);
  fclose($fp);

  // �N�b�L�[�ۑ�
  setcookie ("pwdc", $c_pass,time()+7*24*3600);  /* 1�T�ԂŊ����؂� */
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
      setcookie ("namec", $c_name,time()+7*24*3600);  /* 1�T�ԂŊ����؂� */
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
  echo "<body>$mes ��ʂ�؂�ւ��܂�</body></html>";
}

/* �T���l�C���쐬 */
function thumb($path,$tim,$ext,$resno=0){
  if(!function_exists("ImageCreate")||!function_exists("ImageCreateFromJPEG"))return;
  $fname=$path.$tim.$ext;
  $thumb_dir = THUMB_DIR;   // �T���l�C���ۑ��f�B���N�g��
  if(!$resno){
    $width     = MAX_W;     // �o�͉摜��
    $height    = MAX_H;     // �o�͉摜����
  }else{
    $width     = MAX_W_RES; // �o�͉摜��(���X�p)
    $height    = MAX_H_RES; // �o�͉摜����(���X�p)
  }

  // �摜�̕��ƍ����ƃ^�C�v���擾
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
  // ���T�C�Y
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
  // �o�͉摜�i�T���l�C���j�̃C���[�W���쐬
  if(function_exists("ImageCreateTrueColor")&&get_gd_ver()=="2"){
    $im_out = ImageCreateTrueColor($out_w, $out_h);
  }else{$im_out = ImageCreate($out_w, $out_h);}
  // ���摜���c���Ƃ� �R�s�[���܂��B
  ImageCopyResampled($im_out, $im_in, 0, 0, 0, 0, $out_w, $out_h, $size[0], $size[1]);
  // �T���l�C���摜��ۑ�
  ImageJPEG($im_out, $thumb_dir.$tim.'s.jpg',60);
  chmod($thumb_dir.$tim.'s.jpg',0666);
  // �쐬�����C���[�W��j��
  ImageDestroy($im_in);
  ImageDestroy($im_out);
}
//gd�̃o�[�W�����𒲂ׂ�
function get_gd_ver(){
  if(function_exists("gd_info")){
    $gdver=gd_info();
    $phpinfo=$gdver["GD Version"];
  }else{ //php4.3.0�����p
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
//�t�@�C��md5�v�Z php4.2.0�����p
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
/* �c���[�폜 */
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
    // �폜�t���O��ǉ����ăz���g�ɍ폜���邩�ǂ����I���ł���悤��
    // �폜���Ȃ��ꍇ�̓X���ԍ����擾���邽�߂Ɏg�p
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
/* �e�L�X�g���` */
function CleanStr($str){
  global $admin;
  $str = trim($str);//�擪�Ɩ����̋󔒏���
  if (get_magic_quotes_gpc()) {//�����폜
    $str = stripslashes($str);
  }
  if($admin!=ADMIN_PASS){//�Ǘ��҂̓^�O�\
    $str = htmlspecialchars($str);//�^�O���֎~
    $str = str_replace("&amp;", "&", $str);//���ꕶ��
  }
  return str_replace(",", "&#44;", $str);//�J���}��ϊ�
}
/* ���[�U�[�폜 */
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
      $line[$i] = "";// �p�X���[�h���}�b�`�����s�͋��
      $delfile = $path.$dtim.$dext; // �폜�t�@�C��
      if(!$onlyimgdel){
        $tno = treedel($dno,TRUE);  // �L�����폜���Č��X���ԍ����擾
      }elseif(is_file($delfile)){
        $tno = treedel($dno,FALSE); // �L�����폜���Ȃ��Ō��X���ԍ������擾
      }
      if(is_file($delfile)) unlink($delfile);//�폜
      if(is_file(THUMB_DIR.$dtim.'s.jpg')) unlink(THUMB_DIR.$dtim.'s.jpg');//�폜
      if(is_file(IMG_REF_DIR.$dtim.'.htm')) unlink(IMG_REF_DIR.$dtim.'.htm');//�폜
      if(is_file(RES_DIR.$dtim.'.htm')) unlink(RES_DIR.$dtim.'.htm');//�폜
      if(is_file(THUMB_DIR.$dtim.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$dtim.'s.jpg'.REPLACE_EXT);//�폜
      //�G���J�E���g���O���[�U�[�폜
      $delmoecount = MOE_LOG.$dtim.MOE_KAKU;
      if(is_file($delmoecount)) unlink($delmoecount);
      // ���X�t�@�C�����̏ꍇ�A�폜�����L�������X�̏ꍇ�̓��X�t�@�C���č쐬
      updatelog();
      if($tno && RES_FILE){ updatelog($tno); }
    }
  }
  if(!$flag) error("�Y���L����������Ȃ����p�X���[�h���Ԉ���Ă��܂�");
}
/* �p�X�F�� */
function valid($pass){
  global $default_thumb;

  if($pass && $pass != ADMIN_PASS) error("�p�X���[�h���Ⴂ�܂�");

  $reflesh_path = PHP_SELF."?mode=reflesh";

  head($dat,FALSE);
  echo $dat;
  echo "[<a href=\"".PHP_SELF2."\">�f���ɖ߂�</a>]\n";
  echo "[<a href=\"".$reflesh_path."\">���O���X�V����</a>]\n";
  echo "<table width='100%'><tr><th bgcolor=#E08000>\n";
  echo "<font color=#FFFFFF>�Ǘ����[�h</font>\n";
  echo "</th></tr></table>\n";
  echo "<p><form action=\"".PHP_SELF."\" method=POST>\n";
  // ���O�C���t�H�[��
  if(!$pass){
    echo "<center><table border=0>\n<tr><td>";
    echo "<input type=radio name=admin value=del checked>�L���폜</td><td>";
    echo "<input type=radio name=admin value=post>�Ǘ��l���e</td></tr>\n<tr><td>";
    echo "<input type=radio name=admin value=moecount>�G���J�E���g�Ǘ�</td><td>";
    echo "<input type=radio name=admin value=moeden>�a���M�������[�Ǘ�</td></tr>\n<tr><td>";
    if (ADMIN_SAGE) echo "<input type=radio name=admin value=sage>����sage����</td><td>";
    if (is_file($default_thumb)) echo "<input type=radio name=admin value=thumb>�T���l�C�������ւ�</td></tr>\n<tr><td>";
    echo "<input type=hidden name=mode value=admin>";
    echo "</td></tr>\n</TABLE>\n";
    echo "<input type=password name=pass size=8>";
    echo "<input type=submit value=\" �F�� \"></form></center>\n";
    die("</body></html>");
  }
}

/* �a���M�������[�Ǘ���� */
function adminden($pass){
  global $path,$onlyimgdel;

  $dat = file(MOE_DLOG); // ���O�f�[�^�ǂݍ���
  $dendir = MOE_IMG;

  echo "<center><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>No</th><th>���e��</th>";
  echo "<th>���e��</th><th>�摜</th><th>����</th>";
  echo "</tr>\n";

  for($i = 0; $i < count($dat) ; $i++){
  	$img_flag = FALSE;
    list($no,$now,$name,$time,$ext,$w,$h,$chk)=explode(",", $dat[$i]);

    $aw= $w /3;
    $ah= $h /3;

    // �摜������Ƃ��̓����N
    if($ext && is_file($dendir.$time.$ext)){
      $img_flag = TRUE;
      $clip = "<a href=$dendir$time$ext target=_blank><img src=$dendir$time$ext border=0 width=$aw height=$ah></a>";
      $size = filesize($dendir.$time.$ext);
      $all += $size;			// ���v�v�Z
    }else{
      $clip = "�摜����";
      $size = 0;
    }

    $bg = "f6f6f6"; $bg2 = "d6d6f6"; // �w�i�F

    if($i < count($dat) ){

      echo "<TR bgcolor=$bg>\n<TH bgcolor=$bg2>$no</TH><TD align=center>$now</TD>".
           "<TD align=center><B>$name</b></TD><TD align=center>$clip</TD>".
           "<TD align=center><form action=".PHP_SELF." method=POST>".
           "<input type=hidden NAME=edenadmin value=$time>".
           "<input type=submit name=dendel value=�폜>".
           "</form>".
           "</TD>";
      echo "\n</TR>";
    }
  }
  echo "\n</table>\n<P>";
  $all = (int)($all / 1024);
  echo "�y �摜�f�[�^���v : <b>$all</b> KB �z</center>\n";
  echo "</body></html>";
}
//-----�G���a���ҏW------------------------------------------------------------
if($edenadmin){

  $dat = file(MOE_DLOG); // ���O�f�[�^�ǂݍ���
  $dendir = MOE_IMG;
  $ip = $_SERVER['REMOTE_ADDR']; 

  $ddfp = fopen(MOE_DLOG, "w");
  flock($ddfp,2); // �t�@�C���A�N�Z�X�r�����b�N

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

  error ("�a������폜���܂���");
}
/* �G���J�E���g�Ǘ���� */
function adminmoe($pass){
  global $path,$onlyimgdel;

  echo "<center><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>No</th><th>���e��</th><th>�薼</th>";
  echo "<th>���e��</th><th>�R�����g</th><th>׽Ķ���IP</th><th>�Y�t<br>(Bytes)</th>";
  echo "<th>Ұ��<BR><img src=".MOE_BOTP."></th><th>����</th>";
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
 
      // �t�H�[�}�b�g
      $now=ereg_replace('.{2}/(.*)$','\1',$now);
      $now=ereg_replace('\(.*\)',' ',$now);
      if(strlen($name) > 10) $name = substr($name,0,9).".";
      if(strlen($sub) > 10) $sub = substr($sub,0,9).".";
      if($email) $name="<a href=\"mailto:$email\">$name</a>";
      $com = str_replace("<br />"," ",$com);
      $com = htmlspecialchars($com);
      if(strlen($com) > 20) $com = substr($com,0,18) . ".";
      // �摜������Ƃ��̓����N
      if($ext && is_file($path.$time.$ext)){
        $img_flag = TRUE;
        $clip = "<a href=\"".IMG_DIR.$time.$ext."\" target=_blank>".$time.$ext."</a><br>";
        $size = filesize($path.$time.$ext);
        $all += $size;			// ���v�v�Z
      }else{
        $clip = "";
        $size = 0;
      }
      $bg = ($bgcol++ % 2) ? "d6d6f6" : "f6f6f6";// �w�i�F

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
           "<input type=submit name=ctedit value=�X�V><input type=submit name=ctedit value=���Z�b�g></form></td>\n";
      echo "</tr>";
    }
  }
  echo "\n</table>\n<p>";

  $all = (int)($all / 1024);
  echo "�y �摜�f�[�^���v : <b>$all</b> KB �z</center>\n";
  echo "</body></html>";
}

//-----�G���J�E���g�ҏW--------------------------------------------------------

if ($countedit){
  $ip = $_SERVER['REMOTE_ADDR']; 

  $logmoe  = MOE_LOG.$countedit.MOE_KAKU;
  $mp_data = file($logmoe);
  for($m=0; $m<count($mp_data); $m++){
    list($mcountlog) = split(",",$mp_data[$m]);
  }

  if ($ctedit=='���Z�b�g'){
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
      error ("�J�E���g���E���𒴂��Ă��܂�");
    }else{
      if($newmcount >= MOE_DCNT){$newmcount = DEN;} // �a���C��
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

/* �Ǘ��ҍ폜 */
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
        if(array_search($no,$delno)){//�摜�����폜
          $delfile = $path.$tim.$ext; //�폜�t�@�C��
          if(is_file($delfile)) unlink($delfile);//�폜
          if(is_file(THUMB_DIR.$tim.'s.jpg')) unlink(THUMB_DIR.$tim.'s.jpg');//�폜
          if(is_file(IMG_REF_DIR.$tim.'.htm')) unlink(IMG_REF_DIR.$tim.'.htm');//�폜
          if(is_file(RES_DIR.$tim.'.htm')) unlink(RES_DIR.$tim.'.htm');//�폜
          if(is_file(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT);//�폜
          //�G���J�E���g�Ǘ��l�폜
          $delmoecount = MOE_LOG.$tim.MOE_KAKU;
          if(is_file($delmoecount)) unlink($delmoecount);
          $tno = treedel($no,FALSE); // �L�����폜���Ȃ��Ō��X���ԍ������擾����
          // ���X�t�@�C�����̏ꍇ�̓��X�t�@�C���č쐬
          if($tno && RES_FILE){ updatelog($tno); }
        }
      }else{
        if(array_search($no,$delno)){//�폜�̎��͋��
          $find = TRUE;
          $line[$i] = "";
          $delfile = $path.$tim.$ext; //�폜�t�@�C��
          if(is_file($delfile)) unlink($delfile);//�폜
          if(is_file(THUMB_DIR.$tim.'s.jpg')) unlink(THUMB_DIR.$tim.'s.jpg');//�폜
          if(is_file(IMG_REF_DIR.$tim.'.htm')) unlink(IMG_REF_DIR.$tim.'.htm');//�폜
          if(is_file(RES_DIR.$tim.'.htm')) unlink(RES_DIR.$tim.'.htm');//�폜
          if(is_file(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT)) unlink(THUMB_DIR.$tim.'s.jpg'.REPLACE_EXT);//�폜
          //�G���J�E���g�Ǘ��l�폜
          $delmoecount = MOE_LOG.$tim.MOE_KAKU;
          if(is_file($delmoecount)) unlink($delmoecount);
          $tno = treedel($no,TRUE); // �L�����폜���Č��X���ԍ����擾���ă��X�t�@�C���X�V
          // ���X�t�@�C�����̏ꍇ�A�폜�����L�������X�̏ꍇ�̓��X�t�@�C���č쐬
          if($tno && RES_FILE){ updatelog($tno); }
        }
      }
    }
    if($find){//���O�X�V
      ftruncate($fp,0);
      set_file_buffer($fp, 0);
      rewind($fp);
      fputs($fp, implode('', $line));
    }
    fclose($fp);
    updateall(); // �S���X�f�[�^���č쐬
  }
  // �폜��ʂ�\��
  echo "<input type=hidden name=mode value=admin>\n";
  echo "<input type=hidden name=admin value=del>\n";
  echo "<input type=hidden name=pass value=\"$pass\">\n";
  echo "<center><P>�폜�������L���̃`�F�b�N�{�b�N�X�Ƀ`�F�b�N�����A�폜�{�^���������ĉ������B\n";
  echo "<p><input type=submit value=\"�폜����\">";
  echo "<input type=reset value=\"���Z�b�g\">";
  echo "[<input type=checkbox name=onlyimgdel value=on checked>�摜��������]";
  echo "<P><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>�폜</th><th>�L��No</th><th>���e��</th><th>�薼</th>";
  echo "<th>���e��</th><th>�R�����g</th><th>�z�X�g��</th><th>�Y�t<br>(Bytes)</th><th>md5</th>";
  echo "</tr>\n";
  $line = file(LOGFILE);

  for($j = 0; $j < count($line); $j++){
    $img_flag = FALSE;
    list($no,$now,$name,$email,$sub,$com,$url,
         $host,$pw,$ext,$w,$h,$time,$chk) = explode(",",$line[$j]);
    // �t�H�[�}�b�g
    $now=ereg_replace('.{2}/(.*)$','\1',$now);
    $now=ereg_replace('\(.*\)',' ',$now);
    if(strlen($name) > 10) $name = substr($name,0,9).".";
    if(strlen($sub) > 10) $sub = substr($sub,0,9).".";
    if($email) $name="<a href=\"mailto:$email\">$name</a>";
    $com = str_replace("<br />"," ",$com);
    $com = htmlspecialchars($com);
    if(strlen($com) > 20) $com = substr($com,0,18) . ".";
    // �摜������Ƃ��̓����N
    if($ext && is_file($path.$time.$ext)){
      $img_flag = TRUE;
      $clip = "<a href=\"".IMG_DIR.$time.$ext."\" target=_blank>".$time.$ext."</a><br>";
      $size = filesize($path.$time.$ext);
      $all += $size;			// ���v�v�Z
      $chk= substr($chk,0,10);
    }else{
      $clip = "";
      $size = 0;
      $chk= "";
    }
    $bg = ($j % 2) ? "d6d6f6" : "f6f6f6";// �w�i�F

    echo "<tr bgcolor=$bg><th><input type=checkbox name=\"$no\" value=delete></th>";
    echo "<th>$no</th><td><small>$now</small></td><td>$sub</td>";
    echo "<td><b>$name</b></td><td><small>$com</small></td>";
    echo "<td>$host</td><td align=center>$clip($size)</td><td>$chk</td>\n";
    echo "</tr>\n";
  }

  echo "</table>\n<p><input type=submit value=\"�폜����$msg\">";
  echo "<input type=reset value=\"���Z�b�g\"></form>";

  $all = (int)($all / 1024);
  echo "�y �摜�f�[�^���v : <b>$all</b> KB �z";
  die("</center></body></html>");
}

/* �Ǘ��҃T���l�����ւ� */
function admin_chgthumb($pass){
  global $path,$stillGIF;
  global $rep_thumb,$default_thumb;
  $thum_name = $default_humb;
  foreach($rep_thumb as $chkthumb){
    if (!is_file($chkthumb)){error("��փT���l�C���t�@�C��".$chkthumb."��������܂���");}
  }

  $chgno = array('dummy');
  $chgflag = FALSE;
  reset($_POST);
  while ($item = each($_POST)){
    if($item[1]=='chgthumb'){array_push($chgno,$item[0]);$chgflag=TRUE;}
    // �����ւ��T���l�t�@�C�����擾
    if($item[0]=='thumb'){$thumb_name=$item[1];}
  }
  if($chgflag){
  // �X����̋L���ԍ����擾
  $ttree = file(TREEFILE);
  $tno = array('dummy');
  foreach($ttree as $tline){
    list($tartno,)=explode(",",$tline);
    array_push($tno,$tartno);
  }
  // �w��̂������L����S���ύX
  copy(LOGFILE,LOGFILE.'.bak');// �ǉ�
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
        // �T���l�C�������ւ�
        $tpath = THUMB_DIR.$tim.'s.jpg';
        $tpathorg = $tpath.REPLACE_EXT;
        if (!is_file($tpathorg)){
          if(!is_file($tpath) && is_file($path.$tim.$ext)){ // �T���l���Ȃ�������V�K�쐬
            if(array_search($no,$tno)){
              thumb($path,$tim,$ext,0);   // �X����̏ꍇ�͋L���ԍ��Z�b�g���Ȃ�
            }else{
              thumb($path,$tim,$ext,$no); // ���X�̏ꍇ�͋L���ԍ��Z�b�g
            }
          }
          if( is_file($thumb_name) && is_file($tpath)){
            if ((!USE_GIF_THUMB && $ext=='.gif' && $stillGIF=='on')) {copy($tpath,$tpathorg);}
            else {copy($thumb_name,$tpathorg);}
            // �T���l�T�C�Y�������ւ���摜�̃T�C�Y�ɂ���
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
        // �T���l�T�C�Y�𐧌�
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
    if($find){//���O�X�V
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

  // �����ւ��L���I����ʂ�\��
  echo "<input type=hidden name=mode value=admin>\n";
  echo "<input type=hidden name=admin value=thumb>\n";
  echo "<input type=hidden name=pass value=\"$pass\">\n";
  echo "<center><P>�T���l�C���������ւ������L���̃`�F�b�N�{�b�N�X�Ƀ`�F�b�N�����A�����ւ��{�^���������ĉ������B\n";
  echo "<center>�u���ցv�Ɓu���։����v���؂�ւ��܂��B\n";
  echo "<p><input type=submit value=\"�����ւ�\">";
  echo "<input type=reset value=\"���Z�b�g\">";
  if(!USE_GIF_THUMB){echo "[<input type=checkbox name=stillGIF value=on>GIF���T���l�C�������邾��]";}

  // ���j���[�ɃT���l��ނ�\��
  echo "<center><BR>";
  $i=0;
  foreach ($rep_thumb as $rtitl => $rname){
    echo "<input type=radio name=thumb value=$rname ";
    if (!$i++){ echo "checked"; }
    echo ">$rtitl";
  }

  echo "<P><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>�I��</th><th>�L��No</th><th>���</th><th>���e��</th><th>�薼</th>";
  echo "<th>���e��</th><th>�R�����g</th><th>�z�X�g��</th><th>�Y�t<br>(Bytes)</th>";
  echo "</tr>\n";

  // ���O�t�@�C���ǂݏo��
  $line = file(LOGFILE);
  $bgcol = 0;
  for($j = 0; $j < count($line); $j++){
    $img_flag = FALSE;
    list($no,$now,$name,$email,$sub,$com,$url,
         $host,$pw,$ext,$w,$h,$time,$chk) = explode(",",$line[$j]);
    if($ext && is_file($path.$time.$ext)){
      // �t�H�[�}�b�g
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
      $all += $size;			// ���v�v�Z
      $chk= substr($chk,0,10);
      $bg = ($bgcol++ % 2) ? "d6d6f6" : "f6f6f6";// �w�i�F

      if (is_file(THUMB_DIR.$time.'s.jpg'.REPLACE_EXT)) {$tstat = "����";}
      else{
        $tstat = (stristr($url,'noanime')) ? "���e��" : "�@";
      }
      echo "<tr bgcolor=$bg><th><input type=checkbox name=\"$no\" value=chgthumb></th>";
      echo "<th>$no</th><th>$tstat</th><td><small>$now</small></td><td>$sub</td>";
      echo "<td><b>$name</b></td><td><small>$com</small></td>";
      echo "<td>$host</td><td align=center>$clip($size)</td>\n";
      echo "</tr>\n";
    }
  }
  echo "</table>\n<p><input type=submit value=\"�����ւ�$msg\">";
  echo "<input type=reset value=\"���Z�b�g\"></form>";

  $all = (int)($all / 1024);
  echo "�y �摜�f�[�^���v : <b>$all</b> KB �z";
  die("</center></body></html>");
}

/* �Ǘ���sage���� */
function admin_sage($pass){
  global $path;
  $chgno = array('dummy');
  $chgflag = FALSE;
  reset($_POST);
  while ($item = each($_POST)){
    if($item[1]=='sage'){array_push($chgno,$item[0]);$chgflag=TRUE;}
  }
  if($chgflag){
  copy(LOGFILE,LOGFILE.'.bak');// �ǉ�
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
        // URI�g��'sage'�����؂�ւ�
        if (stristr($url,'sage')) {$url=str_replace('sage','',$url);}
        else { $url .= 'sage'; }
        $line[$i] = "$no,$now,$name,$email,$sub,$com,$url,$host,$pw,$ext,$w,$h,$tim,$chk,\n";
      }
    }
    if($find){//���O�X�V
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

  // sage�L���I����ʂ�\��
  echo "<input type=hidden name=mode value=admin>\n";
  echo "<input type=hidden name=admin value=sage>\n";
  echo "<input type=hidden name=pass value=\"$pass\">\n";
  echo "<center><P>sage��Ԃ�ύX�������L���̃`�F�b�N�{�b�N�X�Ƀ`�F�b�N�����A�ύX�{�^���������ĉ������B\n";
  echo "<center>�usage�v�Ɓusage�����v���؂�ւ��܂��B\n";
  echo "<center>�usage�X�^�[�g�v��u���X��sage�v�ɂ��usage�v�͉����ł��܂���B\n";
  echo "<p><input type=submit value=\"�ύX\">";
  echo "<input type=reset value=\"���Z�b�g\">";
  echo "<P><table border=1 cellspacing=0>\n";
  echo "<tr bgcolor=6080f6><th>�I��</th><th>�L��No</th><th>���</th><th>���e��</th><th>�薼</th>";
  echo "<th>���e��</th><th>�R�����g</th><th>�z�X�g��</th><th>�Y�t<br>(Bytes)</th>";
  echo "</tr>\n";

  // �c���[�t�@�C������X�����̋L��No.���擾
  $ttree = file(TREEFILE);
  $tno = array('dummy');
  $tfind = FALSE;
  $tcounttree=count($ttree);
  for($i = 0;$i<$tcounttree;$i++){
    list($tartno,)=explode(",",rtrim($ttree[$i]));
    array_push($tno,$tartno);
  }

  // ���O�t�@�C���ǂݏo��
  $line = file(LOGFILE);
  $bgcol = 0;
  for($j = 0; $j < count($line); $j++){
    $img_flag = FALSE;
    list($no,$now,$name,$email,$sub,$com,$url,
         $host,$pw,$ext,$w,$h,$time,$chk) = explode(",",$line[$j]);
    if(array_search($no,$tno)){
      // �t�H�[�}�b�g
      $now=ereg_replace('.{2}/(.*)$','\1',$now);
      $now=ereg_replace('\(.*\)',' ',$now);
      if(strlen($name) > 10) $name = substr($name,0,9).".";
      if(strlen($sub) > 10) $sub = substr($sub,0,9).".";
      if($email) $name="<a href=\"mailto:$email\">$name</a>";
      $com = str_replace("<br />"," ",$com);
      $com = htmlspecialchars($com);
      if(strlen($com) > 20) $com = substr($com,0,18) . ".";
      $url = (stristr($url,'sage')) ? 'sage' : '�@';
      // �摜������Ƃ��̓����N
      if($ext && is_file($path.$time.$ext)){
        $img_flag = TRUE;
        $clip = "<a href=\"".IMG_DIR.$time.$ext."\" target=_blank>".$time.$ext."</a><br>";
        $size = filesize($path.$time.$ext);
        $all += $size;			// ���v�v�Z
        $chk= substr($chk,0,10);
      }else{
        $clip = "";
        $size = 0;
        $chk= "";
      }
      $bg = ($bgcol++ % 2) ? "d6d6f6" : "f6f6f6";// �w�i�F

      echo "<tr bgcolor=$bg><th><input type=checkbox name=\"$no\" value=sage></th>";
      echo "<th>$no</th><th>$url</th><td><small>$now</small></td><td>$sub</td>";
      echo "<td><b>$name</b></td><td><small>$com</small></td>";
      echo "<td>$host</td><td align=center>$clip($size)</td>\n";
      echo "</tr>\n";
    }
  }
  echo "</table>\n<p><input type=submit value=\"�ύX$msg\">";
  echo "<input type=reset value=\"���Z�b�g\"></form>";

  $all = (int)($all / 1024);
  echo "�y �摜�f�[�^���v : <b>$all</b> KB �z";
  die("</center></body></html>");
}

/* �����ݒ� */
function init(){
  $chkfile=array(LOGFILE,TREEFILE,MOE_DLOG);
  if(!is_writable(realpath("./")))error("�J�����g�f�B���N�g���ɏ����܂���<br>");
  foreach($chkfile as $value){
    if(!file_exists(realpath($value))){
      $fp = fopen($value, "w");
      set_file_buffer($fp, 0);
      if($value==LOGFILE)fputs($fp,"1,2002/01/01(��) 00:00,������,,����,�{���Ȃ�,,,,,,,,,\n");
      if($value==TREEFILE)fputs($fp,"1\n");
      if($value==MOE_DLOG)fputs($fp,"");
      fclose($fp);
      if(file_exists(realpath($value)))@chmod($value,0666);
    }
    if(!is_writable(realpath($value)))$err.=$value."�������܂���<br>";
    if(!is_readable(realpath($value)))$err.=$value."��ǂ߂܂���<br>";
  }
  @mkdir(IMG_DIR,0777);@chmod(IMG_DIR,0777);
  if(!is_dir(realpath(IMG_DIR)))$err.=IMG_DIR."������܂���<br>";
  if(!is_writable(realpath(IMG_DIR)))$err.=IMG_DIR."�������܂���<br>";
  if(!is_readable(realpath(IMG_DIR)))$err.=IMG_DIR."��ǂ߂܂���<br>";
  if(MOE_COUNT){
    @mkdir(MOE_LOG,0777);@chmod(MOE_LOG,0777);
    if(!is_dir(realpath(MOE_LOG)))$err.=MOE_LOG."������܂���<br>";
    if(!is_writable(realpath(MOE_LOG)))$err.=MOE_LOG."�������܂���<br>";
    if(!is_readable(realpath(MOE_LOG)))$err.=MOE_LOG."��ǂ߂܂���<br>";

    @mkdir(MOE_IMG,0777);@chmod(MOE_IMG,0777);
    if(!is_dir(realpath(MOE_IMG)))$err.=MOE_IMG."������܂���<br>";
    if(!is_writable(realpath(MOE_IMG)))$err.=MOE_IMG."�������܂���<br>";
    if(!is_readable(realpath(MOE_IMG)))$err.=MOE_IMG."��ǂ߂܂���<br>";
  }
  if(USE_THUMB){
    @mkdir(THUMB_DIR,0777);@chmod(THUMB_DIR,0777);
    if(!is_dir(realpath(IMG_DIR)))$err.=THUMB_DIR."������܂���<br>";
    if(!is_writable(realpath(THUMB_DIR)))$err.=THUMB_DIR."�������܂���<br>";
    if(!is_readable(realpath(THUMB_DIR)))$err.=THUMB_DIR."��ǂ߂܂���<br>";
  }
  if(IMG_REFER){
    @mkdir(IMG_REF_DIR,0777);@chmod(IMG_REF_DIR,0777);
    if(!is_dir(realpath(IMG_REF_DIR)))$err.=IMG_REF_DIR."������܂���<br>";
    if(!is_writable(realpath(IMG_REF_DIR)))$err.=IMG_REF_DIR."�������܂���<br>";
    if(!is_readable(realpath(IMG_REF_DIR)))$err.=IMG_REF_DIR."��ǂ߂܂���<br>";
  }
  if(RES_FILE){
    @mkdir(RES_DIR,0777);@chmod(RES_DIR,0777);
    if(!is_dir(realpath(RES_DIR)))$err.=RES_DIR."������܂���<br>";
    if(!is_writable(realpath(RES_DIR)))$err.=RES_DIR."�������܂���<br>";
    if(!is_readable(realpath(RES_DIR)))$err.=RES_DIR."��ǂ߂܂���<br>";
  }
  if($err)error($err);
}

/* ���O�̑S�̍X�V */
function updateall(){

  // �摜��html���X�V
  updatelog();

  // �c���[���O���������Ċe�X����html�t�@�C�����쐬
  if(RES_FILE){
    $ttree = file(TREEFILE);
    foreach ($ttree as $tval){
      list($no,) = explode(",",rtrim($tval));
      updatelog($no);
    }
  }
  echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=".PHP_SELF2."\">";
}


/* �G���J�E���g�J�E���g�A�b�v�V�X�e���i��moecount.php�j */
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
      if($count >= MOE_DCNT){$count = 'DEN';} // �a���C��
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
    echo "<b><big>�A�����[�͏o���܂���B</big></b>";
  }else{
    echo "<b><big>�G���J�E���g�ɓ��[���܂����B</big></b>";
  }
  echo '<BR><BR>--- MoeCountSystem Ver 2.06 ---</P>';
  updatelog();
  if($moeno && RES_FILE){ updatelog($moeno); }
  echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL=".PHP_SELF."\">";
}

/* �G���J�E���g�a���M�������i��denview.php) */
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
  echo '<div align=right class=twelve>[<a href='.PHP_SELF2.'>�f���ɖ߂�</a>] [<a href="'.PHP_SELF.'?mode=admin">�Ǘ��p</a>]</div>'."\n".
       '<p align=center><font color="#800000"size=+2><b>'.MOE_TITLE2.'</b></font>'."\n".
       '<font color=#cc1105><center>�摜��'.DEN_MAX_CNT.'���𒴂���ƍ폜����܂��B</center></font></p>'."\n".'<center>'."\n";
  $dat = file(MOE_DLOG); // ���O�f�[�^�ǂݍ���
  $dendir = MOE_IMG;
  $st=MOE_DPG;
  $all=0;
  $stn=0; // �����|�C���^
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
    // �摜������Ƃ��̓����N
    if($ext && is_file($dendir.$time.$ext)){
      $img_flag = TRUE;
      $clip = "<a href=$dendir$time$ext target=_blank><img src=$dendir$time$ext border=0 width=$w height=$h></a>";
    }else{
      $clip = "�摜�폜�ς�";
    }
    if($i < count($dat)){
      echo "<TABLE border=0 width=90%>\n<TR>";
      echo "<TD bgcolor=#FFFFFF align=center>$clip</TD></TR>\n<TR>";
      echo "<TD bgcolor=#F0E0D6 align=center><font color=#800000>���e�ҁF<b>$name</b><BR>���e���F$now</center></TD></TR>\n</TABLE><BR>\n";
    }
  }

  echo "<BR>".
       "<form action=".PHP_SELF." method=POST>".
       "<input type=hidden name=npage value=$stn>".
       "<input type=hidden name=denview value=view>";
  if($st != MOE_DPG){ echo "<input type=submit name=denpage value=back>"; }
  echo " <B>���� $stn �` $st</B> ";
  if($stn < count($dat) - MOE_DPG){ echo "<input type=submit name=denpage value=next>"; }

  echo "</center>\n</body>\n</html>";
}

/*-----------Main-------------*/
// GET ���N�G�X�g���� '/' ���܂܂��ꍇ�͏I������
$reqcheck = substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME']));
if (FALSE !== strpos($reqcheck, '/')) {
die('');
}

$buf='';
init();		//�����������ݒ��͕s�v�Ȃ̂ō폜����

// �G���J�E���g�J�E���g�A�b�v
if($moeta == "countup"){
  moecount();
  die();
}
// �G���J�E���g�a���M������
if($denview == 'view'){
  denview();
  die();
}
// ���[�h�`�F�b�N
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
