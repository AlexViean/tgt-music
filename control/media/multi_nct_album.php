<?php
function loaibo($str) {
	$chars = array(""	=>	array("<![CDATA[","]]>"));  
	foreach ($chars as $key => $arr)
		foreach ($arr as $val)
			$str = str_replace($val,$key,$str);
	return $str;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Content</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../temp/js/jquery.js"></script>
<script type="text/javascript" src="../styles/admin.js"></script>
<style>
.left { float: left;}.right { float: right; }.clr { clear: both;}
</style>
</head>
<script language="JavaScript" type="text/JavaScript">
<!--
function onover(obj,cls){obj.className=cls;}
function onout(obj,cls){obj.className=cls;}
function ondown(obj,url,cls){obj.className=cls; window.location=url;}
//-->
</script>
<body topmargin="0" leftmargin="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="style_border" width="7" >&nbsp;</td>
    <td valign="top" class="style"><table width="100%" height="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td valign="top" class="style_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="title_c">Thêm Media từ Album NCT</td>
                  </tr>
                </table>               </td>
              </tr>
            </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			</table>
				
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="padding: 20px;">
<?php
if ((!$_POST['ok']) AND (!$_POST['submit'])) {
?>
<form method=post>
<table class=border cellpadding=2 cellspacing=0 width=30%>
<tr><td class=title align=center>Thêm Media từ Album NCT</td></tr>
<tr>
	<td class=fr width=10% align=center>
	<input name="total_songs" size=100 value="" style="text-align:center">
	<br><br>
+ Định dạng: http://www.nhaccuatui.com/nghe?L=O6Vuy6Tf2Yty<br>
</td>
</tr>
<tr><td class=fr align=center><input type="submit" name="ok" class="sutm" value="ĐỒNG Ý"></td></tr>
</table>
</form>
<?php

}
else
{
$total_links = $_POST['total_songs'];
if (!$_POST['submit']) {
    $url = xem_web($total_links);
	$source = explode('&file=',$url);
    $source = explode('"',$source[1]);
	$source = xem_web($source[0]);
	
	$url_song = explode('<track>', $source);
	$total_linksx = count($url_song);
    $total_links = $total_linksx-1;
	$album_z = explode('<h1>', $url);
	$album_z = explode('</h1><p>Trình bày:', $album_z[1]);
	$singer_z = explode('Trình bày: <strong><a title="Tìm các bài hát, playlist, mv do ca sĩ ', $url);
	$singer_z = explode(' trình bày"', $singer_z[1]);
    $album_z = $album_z[0];
    $singer_z = $singer_z[0];
	$album_info = explode('"ico_album" /></div>', $url);
	$album_info = explode('</div>', $album_info[1]);
	$album_info = str_replace('NhacCuaTui.Com',"Phumy.Us",$album_info[0]);
	$album_img  = explode('<span><img src="', $url);
	$album_img  = explode('"', $album_img[1]);
	$album_img	= $album_img[0];
?>

<script>
var total = <?=$total_links?>;
function check_local(status){
	for(i=1;i<=total;i++)
		document.getElementById("local_url_"+i).checked=status;
}
function new_stype(id){
    for(i=1;i<=total;i++)
   	    document.getElementById("singer_type_["+i+"]").value=id;
}
</script>
<form method=post enctype="multipart/form-data">
<table class=border cellpadding=2 cellspacing=2 width=100%>
<tr>
	<td class=fr width=30%>
		<b>Thêm Album</b>
		<br>Xin vui lòng điền các thông tin</td>
	<td class=fr_2>
    <table>
    <tr>
    <td><font color="red">Tên Album :</font></td><td><input name="new_album" value="<?=$album_z?>" size=50></td></tr>
    <tr><td><font color="blue">Chủ đề Album</font></td><td>
    	<select name="singer_type_a" onChange="new_stype(this.value)">
			<option value=1>Album VN</option>
			<option value=2>Album AM</option>
            <option value=3>Album CA</option>
		</select>
		 
		</td></tr>
   <tr> <td><font color="grenn">Ca sĩ (Album):</font></td><td><input name="new_singer_a" value="<?=$singer_z?>" size=50></td></tr>
   </table>
	</td>
</tr>

			<input name=album_img type="hidden" value="<? echo $album_img;?>" size=50>
<tr>
	<td class=fr width=30%>
		<b>Thông tin Album</b></td>
	<td class=fr_2>
						<?php
						$oFCKeditor = new FCKeditor('album_info') ;
						$oFCKeditor->ToolbarSet = 'Basic';
						$oFCKeditor->Height = '200' ; 
						$oFCKeditor->BasePath = '../fckeditor/' ;
						$oFCKeditor->Value = $album_info;
						$oFCKeditor->Create() ;
						?>
	</td>
</tr>

	<td class=fr width=30%><b>Thể loại</b></td>
	<td class=fr_2><?=acp_cat()?></td>
</tr>
<?

for ($i=1;$i<=$total_links;$i++) {
	$play_url = explode('<info>', $url_song[$i]);
	$play_url = explode('</info>', $play_url[1]);
    $play_url = loaibo($play_url[0]);
    $song = explode('<title>', $url_song[$i]);
    $song = explode('</title>', $song[1]);
    $song = loaibo($song[0]);
	$singer = explode('<creator>', $url_song[$i]);
    $singer = explode('</creator>', $singer[1]);
    $singer = loaibo($singer[0]);
?>
<tr>
<td class=fr width='30%' align="right">Tên Media <?=$i?></td>
<td class='fr_2'><input type=text name=title[<?=$i?>] size=50 value="<?=$song?>">
</td></tr>
<tr>
<td class=fr width='30%' align="right">Link Media <?=$i?></td>
<td class='fr_2'><input type=text name=url[<?=$i?>] size=50 value="<?=$play_url?>">
</td></tr>
<tr>

<td class=fr  align="right">Ca sĩ</td>
<td class=fr_2><input name="new_singer[<?=$i?>]" id="new_singer_[<?=$i?>]" value="<?=$singer?>" size="50"> &nbsp;
		<select name="singer_type[<?=$i?>]" id="singer_type_[<?=$i?>]">
       		<option value=1>Ca sĩ VN</option>
        	<option value=2>Ca sĩ AM</option>
       		<option value=3>Ca sĩ CA</option>
		</select>
</td>
</tr>

<?php
}
?>
<tr><td class=fr colspan=2 align=center><input type=hidden name=total_songs value=<?=$total_links?>><input type=hidden name=ok value="ĐỒNG Ý"><input type=submit name=submit class="sutm" value="ĐỒNG Ý"></td></tr>
</table>
</form>
<?php
}
else {
	$singer = them_moi_singer($_POST['new_singer_a'], $_POST['singer_type_a']);
	$cat = implode(',',$_POST['cat']);
	$cat		 = ",".$cat.",";
	$new_album = $_POST['new_album'];
	$t_cat = $cat;
	for ($i=0;$i<=$total_links;$i++) {
		$t_title = htmlchars(stripslashes($_POST['title'][$i]));
		$t_url = stripslashes($_POST['url'][$i]);
		//$t_type = acp_type($t_url);
		$t_title_ascii = strtolower(get_ascii($t_title));
		if ($t_url && $t_title) {
		$t_singer = them_moi_singer($_POST['new_singer'][$i], $_POST['singer_type'][$i]);
		mysql_query("INSERT INTO tgt_nhac_data (m_singer,m_cat,m_url,m_type,m_title,m_title_ascii,m_is_local,m_poster,m_img,m_time) VALUES ('".$t_singer."','".$t_cat."','".$t_url."','1','".$t_title."','".$t_title_ascii."','0','".$_SESSION['admin_id']."','".$img."','".NOW."')");
		}
	}
	// add album
	$arr = $tgtdb->databasetgt("m_id","data"," m_id ORDER BY m_id DESC LIMIT ".$total_links);

	for($x=0;$x<count($arr);$x++) {
	$list .=  $arr[$x][0].',';
	$album_song = substr($list,0,-1);
	} 
	$new_album = $_POST['new_album'];
	if ($new_album) {
			$album_info		= $_POST['album_info'];
			$album 			= them_moi_album($new_album,$singer,$_POST['album_img'],$cat,$album_song,$album_info,$album_song);
			}
	//mss ("Ok ! ","media.php?mode=multi_zing");
	echo "Thành công<meta http-equiv='refresh' content='0;url=media.php?mode=multi_nct_album'>";
}
}
?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
