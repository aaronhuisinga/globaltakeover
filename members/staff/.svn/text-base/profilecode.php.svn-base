<?php	
require_once("config.php");
	function BBCode($Text) {
		$result = mysql_query("SELECT music FROM Players WHERE id='{$_COOKIE['id']}'");
		$row = mysql_fetch_array ($result);
		$music = $row[0];
		
		// Replace any html brackets with HTML Entities to prevent executing HTML or script
		// Don't use strip_tags here because it breaks [url] search by replacing & with amp
		$Text = str_replace("<", "&lt;", $Text);
		$Text = str_replace(">", "&gt;", $Text);
		
		// Convert new line chars to html <br /> tags
		$Text = nl2br($Text);
		
		// Set up the parameters for a URL search string
		$URLSearchString = " a-zA-Z0-9\:\/\-\?\&\.\=\_\~\#\'";
		// Set up the parameters for a MAIL search string
		$MAILSearchString = $URLSearchString . " a-zA-Z0-9\.@";
		
		// Perform URL Search
		$Text = preg_replace("/\[url\]([$URLSearchString]*)\[\/url\]/", '<a href="$1" target="_blank">$1</a>', $Text);
		$Text = preg_replace("(\[url\=([$URLSearchString]*)\](.+?)\[/url\])", '<a href="$1" target="_blank">$2</a>', $Text);
		
		// Perform MAIL Search
		$Text = preg_replace("(\[mail\]([$MAILSearchString]*)\[/mail\])", '<a href="mailto:$1">$1</a>', $Text);
		$Text = preg_replace("/\[mail\=([$MAILSearchString]*)\](.+?)\[\/mail\]/", '<a href="mailto:$1">$2</a>', $Text);
		
		// Check for bold text
		$Text = preg_replace("(\[b\](.+?)\[\/b])is",'<span class="bold">$1</span>',$Text);
		
		// Smilies!
		$Text = str_replace(":)", "<img src=\"/images/smile.png\" />", $Text);
		$Text = str_replace("(:", "<img src=\"/images/smile.png\" />", $Text);
		$Text = str_replace("[:", "<img src=\"/images/smile.png\" />", $Text);
		$Text = str_replace(":(", "<img src=\"/images/sad.png\" />", $Text);
		$Text = str_replace("):", "<img src=\"/images/sad.png\" />", $Text);
		$Text = str_replace("=[", "<img src=\"/images/sad.png\" />", $Text);
		$Text = str_replace(":c", "<img src=\"/images/sad.png\" />", $Text);
		$Text = str_replace(":C", "<img src=\"/images/sad.png\" />", $Text);
		$Text = str_replace(":D", "<img src=\"/images/big_smile.png\" />", $Text);
		$Text = str_replace(":d", "<img src=\"/images/big_smile.png\" />", $Text);
		$Text = str_replace("=d", "<img src=\"/images/big_smile.png\" />", $Text);
		$Text = str_replace("=D", "<img src=\"/images/big_smile.png\" />", $Text);
		$Text = str_replace(":G", "<img src=\"/images/big_smile.png\" />", $Text);
		$Text = str_replace(":cool:", "<img src=\"/images/cool.png\" />", $Text);
		$Text = str_replace("8)", "<img src=\"/images/cool.png\" />", $Text);
		$Text = str_replace(":8", "<img src=\"/images/cool.png\" />", $Text);
		$Text = str_replace(":\\", "<img src=\"/images/hmm.png\" />", $Text);
		$Text = str_replace(":lol:", "<img src=\"/images/lol.png\" />", $Text);
		$Text = str_replace(":mad:", "<img src=\"/images/mad.png\" />", $Text);
		$Text = str_replace(":@", "<img src=\"/images/mad.png\" />", $Text);
		$Text = str_replace("=@", "<img src=\"/images/mad.png\" />", $Text);
		$Text = str_replace(":#", "<img src=\"/images/mad.png\" />", $Text);
		$Text = str_replace(":|", "<img src=\"/images/neutral.png\" />", $Text);
		$Text = str_replace(":l", "<img src=\"/images/neutral.png\" />", $Text);
		$Text = str_replace(":L", "<img src=\"/images/neutral.png\" />", $Text);
		$Text = str_replace("-.-", "<img src=\"/images/neutral.png\" />", $Text);
		$Text = str_replace(":rolleyes:", "<img src=\"/images/roll.png\" />", $Text);
		$Text = str_replace(":-[", "<img src=\"/images/smile_blush.png\" />", $Text);
		$Text = str_replace(":'(", "<img src=\"/images/smile_cry.png\" />", $Text);
		$Text = str_replace("]':", "<img src=\"/images/smile_cry.png\" />", $Text);
		$Text = str_replace(":kiss:", "<img src=\"/images/smile_kiss.png\" />", $Text);
		$Text = str_replace(":*)", "<img src=\"/images/smile_kiss.png\" />", $Text);
		$Text = str_replace("(Y)", "<img src=\"/images/smile_thumbup.png\" />", $Text);
		$Text = str_replace("(y)", "<img src=\"/images/smile_thumbup.png\" />", $Text);
		$Text = str_replace(":thumbsup:", "<img src=\"/images/smile_thumbup.png\" />", $Text);
		$Text = str_replace(":worried:", "<img src=\"/images/smile_worried.png\" />", $Text);
		$Text = str_replace(":-!", "<img src=\"/images/smile_worried.png\" />", $Text);
		$Text = str_replace(":zipped:", "<img src=\"/images/smile_zipped.png\" />", $Text);
		$Text = str_replace(":-X", "<img src=\"/images/smile_zipped.png\" />", $Text);
		$Text = str_replace(":P", "<img src=\"/images/tongue.png\" />", $Text);
		$Text = str_replace(":p", "<img src=\"/images/tongue.png\" />", $Text);
		$Text = str_replace("=p", "<img src=\"/images/tongue.png\" />", $Text);
		$Text = str_replace("=P", "<img src=\"/images/tongue.png\" />", $Text);
		$Text = str_replace(";)", "<img src=\"/images/wink.png\" />", $Text);
		$Text = str_replace("[;", "<img src=\"/images/wink.png\" />", $Text);
		$Text = str_replace(":o", "<img src=\"/images/yikes.png\" />", $Text);
		$Text = str_replace(":O", "<img src=\"/images/yikes.png\" />", $Text);
		$Text = str_replace("=O", "<img src=\"/images/yikes.png\" />", $Text);
		$Text = str_replace("=o", "<img src=\"/images/yikes.png\" />", $Text);
		$Text = str_replace(":yikes:", "<img src=\"/images/yikes.png\" />", $Text);
		
		
		// Check for Italics text
		$Text = preg_replace("(\[i\](.+?)\[\/i\])is",'<span class="italics">$1</span>',$Text);
		
		// Check for Underline text
		$Text = preg_replace("(\[u\](.+?)\[\/u\])is",'<span class="underline">$1</span>',$Text);
		
		// Check for strike-through text
		$Text = preg_replace("(\[s\](.+?)\[\/s\])is",'<span class="strikethrough">$1</span>',$Text);
		
		// Check for over-line text
		$Text = preg_replace("(\[o\](.+?)\[\/o\])is",'<span class="overline">$1</span>',$Text);
		
		// Check for colored text
		$Text = preg_replace("(\[color=(.+?)\](.+?)\[\/color\])is","<span style=\"color: $1\">$2</span>",$Text);
		
		// Check for colored background
		$Text = preg_replace("(\[bgcolor\](.+?)\[\/bgcolor\])is","",$Text);
		
		// Check for sized text
		$Text = preg_replace("(\[size=(.+?)\](.+?)\[\/size\])is","<span style=\"font-size: $1px\">$2</span>",$Text);
		
		// Check for MUSIC!!
		if ($music == 1) {
		$Text = preg_replace("(\[music\](.+?)\[\/music\])is",'<embed name="music" src="$1" loop="false" hidden="true" autostart="true"></embed>',$Text);
		} else {
		$Text = preg_replace("(\[music\](.+?)\[\/music\])is",'',$Text);
		}
		
		// Check for list text
		$Text = preg_replace("/\[list\](.+?)\[\/list\]/is", '<ul class="listbullet">$1</ul>' ,$Text);
		$Text = preg_replace("/\[list=1\](.+?)\[\/list\]/is", '<ul class="listdecimal">$1</ul>' ,$Text);
		$Text = preg_replace("/\[list=i\](.+?)\[\/list\]/s", '<ul class="listlowerroman">$1</ul>' ,$Text);
		$Text = preg_replace("/\[list=I\](.+?)\[\/list\]/s", '<ul class="listupperroman">$1</ul>' ,$Text);
		$Text = preg_replace("/\[list=a\](.+?)\[\/list\]/s", '<ul class="listloweralpha">$1</ul>' ,$Text);
		$Text = preg_replace("/\[list=A\](.+?)\[\/list\]/s", '<ul class="listupperalpha">$1</ul>' ,$Text);
		$Text = str_replace("[*]", "<li>", $Text);
		
		// Check for font change text
		$Text = preg_replace("(\[font=(.+?)\](.+?)\[\/font\])","<span style=\"font-family: $1;\">$2</span>",$Text);
		
		// Declare the format for [code] layout
		$CodeLayout = '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="quotecodeheader"> Code:</td>
							</tr>
							<tr>
								<td class="codebody">$1</td>
							</tr>
					   </table>';
		// Check for [code] text
		$Text = preg_replace("/\[code\](.+?)\[\/code\]/is","$CodeLayout", $Text);
		
		// Declare the format for [quote] layout
		$QuoteLayout = '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="quotecodeheader"> Quote:</td>
							</tr>
							<tr>
								<td class="quotebody">$1</td>
							</tr>
					   </table>';
				 
		// Check for [code] text
		$Text = preg_replace("/\[quote\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);
		
		// Images
		// [img]pathtoimage[/img]
		$Text = preg_replace("/\[img\](.+?)\[\/img\]/", '<img src="$1">', $Text);
		
		// If image background is declared.
		$Text = preg_replace("/\[bgimg\](.+?)\[\/bgimg\]/", '', $Text);

		// [img=widthxheight]image source[/img]
		$Text = preg_replace("/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", '<img src="$3" height="$2" width="$1">', $Text);
		
		return $Text;
	}
	
	function ImageBackground($bgimage) {
		
		// [bgimage]pathtoimage[/bgimg]
		$bgimage = preg_replace("/\[bgimg\](.+?)\[\/bgimg\]/", 'background="$1"', $bgimage);
		
		// Set up the parameters for a URL search string
		$URLSearchString2 = " a-zA-Z0-9\:\/\-\?\&\.\=\_\~\#\'";
		// Set up the parameters for a MAIL search string
		$MAILSearchString2 = $URLSearchString2 . " a-zA-Z0-9\.@";
		
		//OTHERS
		// Perform URL Search
		$bgimage = preg_replace("/\[url\]([$URLSearchString2]*)\[\/url\]/", '', $bgimage);
		$bgimage = preg_replace("(\[url\=([$URLSearchString2]*)\](.+?)\[/url\])", ' ', $bgimage);
		
		// Perform MAIL Search
		$bgimage = preg_replace("(\[mail\]([$MAILSearchString2]*)\[/mail\])", ' ', $bgimage);
		$bgimage = preg_replace("/\[mail\=([$MAILSearchString2]*)\](.+?)\[\/mail\]/", '', $bgimage);
		
		// Check for bold text
		$bgimage = preg_replace("(\[b\](.+?)\[\/b])is",'',$bgimage);
		
		// Convert new line chars to html <br /> tags
		$bgimage = str_replace("n\\", "", $bgimage);
		
		// Smilies!
		$bgimage = str_replace(":)", "", $bgimage);
		$bgimage = str_replace("(:", "", $bgimage);
		$bgimage = str_replace("[:", "", $bgimage);
		$bgimage = str_replace(":(", "", $bgimage);
		$bgimage = str_replace("):", "", $bgimage);
		$bgimage = str_replace("=[", "", $bgimage);
		$bgimage = str_replace(":c", "", $bgimage);
		$bgimage = str_replace(":C", "", $bgimage);
		$bgimage = str_replace(":D", "", $bgimage);
		$bgimage = str_replace(":d", "", $bgimage);
		$bgimage = str_replace("=d", "", $bgimage);
		$bgimage = str_replace("=D", "", $bgimage);
		$bgimage = str_replace(":G", "", $bgimage);
		$bgimage = str_replace(":cool:", "", $bgimage);
		$bgimage = str_replace("8)", "", $bgimage);
		$bgimage = str_replace(":8", "", $bgimage);
		$bgimage = str_replace(":\\", "", $bgimage);
		$bgimage = str_replace(":lol:", "", $bgimage);
		$bgimage = str_replace(":mad:", "", $bgimage);
		$bgimage = str_replace(":@", "", $bgimage);
		$bgimage = str_replace("=@", "", $bgimage);
		$bgimage = str_replace(":#", "", $bgimage);
		$bgimage = str_replace(":|", "", $bgimage);
		$bgimage = str_replace(":l", "", $bgimage);
		$bgimage = str_replace(":L", "", $bgimage);
		$bgimage = str_replace("-.-", "", $bgimage);
		$bgimage = str_replace(":rolleyes:", "", $bgimage);
		$bgimage = str_replace(":-[", "", $bgimage);
		$bgimage = str_replace(":'(", "", $bgimage);
		$bgimage = str_replace("]':", "", $bgimage);
		$bgimage = str_replace(":kiss:", "", $bgimage);
		$bgimage = str_replace(":*)", "", $bgimage);
		$bgimage = str_replace("(Y)", "", $bgimage);
		$bgimage = str_replace("(y)", "", $bgimage);
		$bgimage = str_replace(":thumbsup:", "", $bgimage);
		$bgimage = str_replace(":worried:", "", $bgimage);
		$bgimage = str_replace(":-!", "", $bgimage);
		$bgimage = str_replace(":zipped:", "", $bgimage);
		$bgimage = str_replace(":-X", "", $bgimage);
		$bgimage = str_replace(":P", "", $bgimage);
		$bgimage = str_replace(":p", "", $bgimage);
		$bgimage = str_replace("=p", "", $bgimage);
		$bgimage = str_replace("=P", "", $bgimage);
		$bgimage = str_replace(";)", "", $bgimage);
		$bgimage = str_replace("[;", "", $bgimage);
		$bgimage = str_replace(":o", "", $bgimage);
		$bgimage = str_replace(":O", "", $bgimage);
		$bgimage = str_replace("=O", "", $bgimage);
		$bgimage = str_replace("=o", "", $bgimage);
		$bgimage = str_replace(":yikes:", "", $bgimage);
		
		
		// Check for Italics text
		$bgimage = preg_replace("(\[i\](.+?)\[\/i\])is",'',$bgimage);
		
		// Check for Underline text
		$bgimage = preg_replace("(\[u\](.+?)\[\/u\])is",'',$bgimage);
		
		// Check for strike-through text
		$bgimage = preg_replace("(\[s\](.+?)\[\/s\])is",'',$bgimage);
		
		// Check for over-line text
		$bgimage = preg_replace("(\[o\](.+?)\[\/o\])is",'',$bgimage);
		
		// Check for colored text
		$bgimage = preg_replace("(\[color=(.+?)\](.+?)\[\/color\])is","",$bgimage);
		
		// Check for colored background
		$bgimage = preg_replace("(\[bgcolor\](.+?)\[\/bgcolor\])is","",$bgimage);
		
		// Check for sized text
		$bgimage = preg_replace("(\[size=(.+?)\](.+?)\[\/size\])is","",$bgimage);
		
		// Check for MUSIC!!
		$bgimage = preg_replace("(\[music\](.+?)\[\/music\])is",'',$bgimage);
		
		// Check for list text
		$bgimage = preg_replace("/\[list\](.+?)\[\/list\]/is", '' ,$bgimage);
		$bgimage = preg_replace("/\[list=1\](.+?)\[\/list\]/is", '' ,$bgimage);
		$bgimage = preg_replace("/\[list=i\](.+?)\[\/list\]/s", '' ,$bgimage);
		$bgimage = preg_replace("/\[list=I\](.+?)\[\/list\]/s", '' ,$bgimage);
		$bgimage = preg_replace("/\[list=a\](.+?)\[\/list\]/s", '' ,$bgimage);
		$bgimage = preg_replace("/\[list=A\](.+?)\[\/list\]/s", '' ,$bgimage);
		$bgimage = str_replace("[*]", "", $bgimage);
		
		// Check for font change text
		$bgimage = preg_replace("(\[font=(.+?)\](.+?)\[\/font\])","",$bgimage);
		
		// Declare the format for [code] layout
		$CodeLayout = '';
		// Check for [code] text
		$bgimage = preg_replace("/\[code\](.+?)\[\/code\]/is","", $bgimage);
		
		// Declare the format for [quote] layout
		$QuoteLayout = '';
				 
		// Check for [code] text
		$bgimage = preg_replace("/\[quote\](.+?)\[\/quote\]/is","", $bgimage);
		
		// Images
		// [img]pathtoimage[/img]
		$bgimage = preg_replace("/\[img\](.+?)\[\/img\]/", '', $bgimage);

		// [img=widthxheight]image source[/img]
		$bgimage = preg_replace("/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", '', $bgimage);
		
		return $bgimage;
	}
	
	function ColorBackground($bgcolor) {
	
		// Check for colored background
		$bgcolor = preg_replace("(\[bgcolor\](.+?)\[\/bgcolor\])is","bgcolor=\"$1\"",$bgcolor);
		
		// Set up the parameters for a URL search string
		$URLSearchString2 = " a-zA-Z0-9\:\/\-\?\&\.\=\_\~\#\'";
		// Set up the parameters for a MAIL search string
		$MAILSearchString2 = $URLSearchString2 . " a-zA-Z0-9\.@";
		
		//OTHERS
		// Perform URL Search
		$bgcolor = preg_replace("/\[url\]([$URLSearchString2]*)\[\/url\]/", '', $bgcolor);
		$bgcolor = preg_replace("(\[url\=([$URLSearchString2]*)\](.+?)\[/url\])", ' ', $bgcolor);
		
		// Perform MAIL Search
		$bgcolor = preg_replace("(\[mail\]([$MAILSearchString2]*)\[/mail\])", ' ', $bgcolor);
		$bgcolor = preg_replace("/\[mail\=([$MAILSearchString2]*)\](.+?)\[\/mail\]/", '', $bgcolor);
		
		// Check for bold text
		$bgcolor = preg_replace("(\[b\](.+?)\[\/b])is",'',$bgcolor);
		
		// Convert new line chars to html <br /> tags
		$bgcolor = str_replace("n\\", "", $bgcolor);
		
		// Smilies!
		$bgcolor = str_replace(":)", "", $bgcolor);
		$bgcolor = str_replace("(:", "", $bgcolor);
		$bgcolor = str_replace("[:", "", $bgcolor);
		$bgcolor = str_replace(":(", "", $bgcolor);
		$bgcolor = str_replace("):", "", $bgcolor);
		$bgcolor = str_replace("=[", "", $bgcolor);
		$bgcolor = str_replace(":c", "", $bgcolor);
		$bgcolor = str_replace(":C", "", $bgcolor);
		$bgcolor = str_replace(":D", "", $bgcolor);
		$bgcolor = str_replace(":d", "", $bgcolor);
		$bgcolor = str_replace("=d", "", $bgcolor);
		$bgcolor = str_replace("=D", "", $bgcolor);
		$bgcolor = str_replace(":G", "", $bgcolor);
		$bgcolor = str_replace(":cool:", "", $bgcolor);
		$bgcolor = str_replace("8)", "", $bgcolor);
		$bgcolor = str_replace(":8", "", $bgcolor);
		$bgcolor = str_replace(":\\", "", $bgcolor);
		$bgcolor = str_replace(":lol:", "", $bgcolor);
		$bgcolor = str_replace(":mad:", "", $bgcolor);
		$bgcolor = str_replace(":@", "", $bgcolor);
		$bgcolor = str_replace("=@", "", $bgcolor);
		$bgcolor = str_replace(":#", "", $bgcolor);
		$bgcolor = str_replace(":|", "", $bgcolor);
		$bgcolor = str_replace(":l", "", $bgcolor);
		$bgcolor = str_replace(":L", "", $bgcolor);
		$bgcolor = str_replace("-.-", "", $bgcolor);
		$bgcolor = str_replace(":rolleyes:", "", $bgcolor);
		$bgcolor = str_replace(":-[", "", $bgcolor);
		$bgcolor = str_replace(":'(", "", $bgcolor);
		$bgcolor = str_replace("]':", "", $bgcolor);
		$bgcolor = str_replace(":kiss:", "", $bgcolor);
		$bgcolor = str_replace(":*)", "", $bgcolor);
		$bgcolor = str_replace("(Y)", "", $bgcolor);
		$bgcolor = str_replace("(y)", "", $bgcolor);
		$bgcolor = str_replace(":thumbsup:", "", $bgcolor);
		$bgcolor = str_replace(":worried:", "", $bgcolor);
		$bgcolor = str_replace(":-!", "", $bgcolor);
		$bgcolor = str_replace(":zipped:", "", $bgcolor);
		$bgcolor = str_replace(":-X", "", $bgcolor);
		$bgcolor = str_replace(":P", "", $bgcolor);
		$bgcolor = str_replace(":p", "", $bgcolor);
		$bgcolor = str_replace("=p", "", $bgcolor);
		$bgcolor = str_replace("=P", "", $bgcolor);
		$bgcolor = str_replace(";)", "", $bgcolor);
		$bgcolor = str_replace("[;", "", $bgcolor);
		$bgcolor = str_replace(":o", "", $bgcolor);
		$bgcolor = str_replace(":O", "", $bgcolor);
		$bgcolor = str_replace("=O", "", $bgcolor);
		$bgcolor = str_replace("=o", "", $bgcolor);
		$bgcolor = str_replace(":yikes:", "", $bgcolor);
		
		
		// Check for Italics text
		$bgcolor = preg_replace("(\[i\](.+?)\[\/i\])is",'',$bgcolor);
		
		// Check for Underline text
		$bgcolor = preg_replace("(\[u\](.+?)\[\/u\])is",'',$bgcolor);
		
		// Check for strike-through text
		$bgcolor = preg_replace("(\[s\](.+?)\[\/s\])is",'',$bgcolor);
		
		// Check for over-line text
		$bgcolor = preg_replace("(\[o\](.+?)\[\/o\])is",'',$bgcolor);
		
		// Check for colored text
		$bgcolor = preg_replace("(\[color=(.+?)\](.+?)\[\/color\])is","",$bgcolor);
		
		// Check for sized text
		$bgcolor = preg_replace("(\[size=(.+?)\](.+?)\[\/size\])is","",$bgcolor);
		
		// Check for MUSIC!!
		$bgcolor = preg_replace("(\[music\](.+?)\[\/music\])is",'',$bgcolor);
		
		// Check for list text
		$bgcolor = preg_replace("/\[list\](.+?)\[\/list\]/is", '' ,$bgcolor);
		$bgcolor = preg_replace("/\[list=1\](.+?)\[\/list\]/is", '' ,$bgcolor);
		$bgcolor = preg_replace("/\[list=i\](.+?)\[\/list\]/s", '' ,$bgcolor);
		$bgcolor = preg_replace("/\[list=I\](.+?)\[\/list\]/s", '' ,$bgcolor);
		$bgcolor = preg_replace("/\[list=a\](.+?)\[\/list\]/s", '' ,$bgcolor);
		$bgcolor = preg_replace("/\[list=A\](.+?)\[\/list\]/s", '' ,$bgcolor);
		$bgcolor = str_replace("[*]", "", $bgcolor);
		
		// Check for font change text
		$bgcolor = preg_replace("(\[font=(.+?)\](.+?)\[\/font\])","",$bgcolor);
		
		// Declare the format for [code] layout
		$CodeLayout = '';
		// Check for [code] text
		$bgcolor = preg_replace("/\[code\](.+?)\[\/code\]/is","", $bgcolor);
		
		// Declare the format for [quote] layout
		$QuoteLayout = '';
				 
		// Check for [code] text
		$bgcolor = preg_replace("/\[quote\](.+?)\[\/quote\]/is","", $bgcolor);
		
		// Images
		// [img]pathtoimage[/img]
		$bgcolor = preg_replace("/\[img\](.+?)\[\/img\]/", '', $bgcolor);
		
		// If image background is declared.
		$bgcolor = preg_replace("/\[bgimg\](.+?)\[\/bgimg\]/", '', $bgcolor);

		// [img=widthxheight]image source[/img]
		$bgcolor = preg_replace("/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", '', $bgcolor);
		
		return $bgcolor;
	}
?>