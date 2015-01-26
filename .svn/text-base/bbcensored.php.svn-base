<?php	
	function BBCode($Text) {
		
		// Convert new line chars to html <br /> tags
		$Text = nl2br($Text);
		
		// Set up the parameters for a URL search string
		$URLSearchString = " a-zA-Z0-9\:\/\-\?\&\.\=\_\~\#\'";
		// Set up the parameters for a MAIL search string
		$MAILSearchString = $URLSearchString . " a-zA-Z0-9\.@";
		
		// Perform URL Search
		$Text = preg_replace("/\[url\]([$URLSearchString]*)\[\/url\]/", '<a href="$1" target="_blank">$1</a>', $Text);
		$Text = preg_replace("(\[url\=([$URLSearchString]*)\](.+?)\[/url\])", '<a href="$1" target="_blank">$2</a>', $Text);
		//Automatically link all www
		$Text = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $Text);
		//And all ftp
		$Text = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $Text);
		//And all emails are now mailto
		$Text = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $Text);
		
		// Perform MAIL Search
		$Text = preg_replace("(\[mail\]([$MAILSearchString]*)\[/mail\])", '<a href="mailto:$1">$1</a>', $Text);
		$Text = preg_replace("/\[mail\=([$MAILSearchString]*)\](.+?)\[\/mail\]/", '<a href="mailto:$1">$2</a>', $Text);
		
		// Check for bold text
		$Text = preg_replace("(\[b\](.+?)\[\/b])is",'<span class="bold">$1</span>',$Text);
		
		// Declare the format for [quote] layout
		$QuoteLayout = '<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="quotehead"><b>$1</b> wrote:</td>
							<tr>
								<td class="quotebody">$2</td>
							</tr>
						</table>';
				 
		// Check for [quote] text (a few times, for multiquotes)
		$Text = preg_replace("/\[quote=(.+?)\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);			 
		$Text = preg_replace("/\[quote=(.+?)\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);
		$Text = preg_replace("/\[quote=(.+?)\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);
		$Text = preg_replace("/\[quote=(.+?)\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);
		$Text = preg_replace("/\[quote=(.+?)\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);
		$Text = preg_replace("/\[quote=(.+?)\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);
		
		// Check for post edits
		$Text = preg_replace("(\[edit\](.+?)\[\/edit])is",'<span style="font-size: 10px" class="italics">$1</span>',$Text);
		
		// Smilies!
		$Text = str_replace(":)", "<img src=\"images/smilies/smile.png\" />", $Text);
		$Text = str_replace("(:", "<img src=\"images/smilies/smile.png\" />", $Text);
		$Text = str_replace("[:", "<img src=\"images/smilies/smile.png\" />", $Text);
		$Text = str_replace(":(", "<img src=\"images/smilies/sad.png\" />", $Text);
		$Text = str_replace("):", "<img src=\"images/smilies/sad.png\" />", $Text);
		$Text = str_replace("=[", "<img src=\"images/smilies/sad.png\" />", $Text);
		$Text = str_replace(":D", "<img src=\"images/smilies/big_smile.png\" />", $Text);
		$Text = str_replace(":d", "<img src=\"images/smilies/big_smile.png\" />", $Text);
		$Text = str_replace("=d", "<img src=\"images/smilies/big_smile.png\" />", $Text);
		$Text = str_replace("=D", "<img src=\"images/smilies/big_smile.png\" />", $Text);
		$Text = str_replace(":G", "<img src=\"images/smilies/big_smile.png\" />", $Text);
		$Text = str_replace(":cool:", "<img src=\"images/smilies/cool.png\" />", $Text);
		$Text = str_replace("8)", "<img src=\"images/smilies/cool.png\" />", $Text);
		$Text = str_replace(":8", "<img src=\"images/smilies/cool.png\" />", $Text);
		$Text = str_replace(":\\", "<img src=\"images/smilies/hmm.png\" />", $Text);
		$Text = str_replace(":lol:", "<img src=\"images/smilies/lol.png\" />", $Text);
		$Text = str_replace(":mad:", "<img src=\"images/smilies/mad.png\" />", $Text);
		$Text = str_replace(":@", "<img src=\"images/smilies/mad.png\" />", $Text);
		$Text = str_replace("=@", "<img src=\"images/smilies/mad.png\" />", $Text);
		$Text = str_replace(":#", "<img src=\"images/smilies/mad.png\" />", $Text);
		$Text = str_replace(":|", "<img src=\"images/smilies/neutral.png\" />", $Text);
		$Text = str_replace("-.-", "<img src=\"images/smilies/neutral.png\" />", $Text);
		$Text = str_replace(":rolleyes:", "<img src=\"images/smilies/roll.png\" />", $Text);
		$Text = str_replace(":-[", "<img src=\"images/smilies/smile_blush.png\" />", $Text);
		$Text = str_replace(":'(", "<img src=\"images/smilies/smile_cry.png\" />", $Text);
		$Text = str_replace("]':", "<img src=\"images/smilies/smile_cry.png\" />", $Text);
		$Text = str_replace(":kiss:", "<img src=\"images/smilies/smile_kiss.png\" />", $Text);
		$Text = str_replace(":*)", "<img src=\"images/smilies/smile_kiss.png\" />", $Text);
		$Text = str_replace("(Y)", "<img src=\"images/smilies/smile_thumbup.png\" />", $Text);
		$Text = str_replace("(y)", "<img src=\"images/smilies/smile_thumbup.png\" />", $Text);
		$Text = str_replace(":thumbsup:", "<img src=\"images/smilies/smile_thumbup.png\" />", $Text);
		$Text = str_replace(":worried:", "<img src=\"images/smilies/smile_worried.png\" />", $Text);
		$Text = str_replace(":-!", "<img src=\"images/smilies/smile_worried.png\" />", $Text);
		$Text = str_replace(":zipped:", "<img src=\"images/smilies/smile_zipped.png\" />", $Text);
		$Text = str_replace(":-X", "<img src=\"images/smilies/smile_zipped.png\" />", $Text);
		$Text = str_replace(":P", "<img src=\"images/smilies/tongue.png\" />", $Text);
		$Text = str_replace(":p", "<img src=\"images/smilies/tongue.png\" />", $Text);
		$Text = str_replace("=p", "<img src=\"images/smilies/tongue.png\" />", $Text);
		$Text = str_replace("=P", "<img src=\"images/smilies/tongue.png\" />", $Text);
		$Text = str_replace(";)", "<img src=\"images/smilies/wink.png\" />", $Text);
		$Text = str_replace("[;", "<img src=\"images/smilies/wink.png\" />", $Text);
		$Text = str_replace(":o", "<img src=\"images/smilies/yikes.png\" />", $Text);
		$Text = str_replace(":O", "<img src=\"images/smilies/yikes.png\" />", $Text);
		$Text = str_replace("=O", "<img src=\"images/smilies/yikes.png\" />", $Text);
		$Text = str_replace("=o", "<img src=\"images/smilies/yikes.png\" />", $Text);
		$Text = str_replace(":yikes:", "<img src=\"images/smilies/yikes.png\" />", $Text);
		
		// Swear Filter
		$Text = preg_replace("(fuck)is",'****',$Text);
		$Text = preg_replace("(ass)is",'***',$Text);
		$Text = preg_replace("(bitch)is",'*****',$Text);
		$Text = preg_replace("(arse)is",'****',$Text);
		$Text = preg_replace("(shit)is",'****',$Text);
		$Text = preg_replace("(damn)is",'****',$Text);
		$Text = preg_replace("(bastard)is",'*******',$Text);
		$Text = preg_replace("(cunt)is",'****',$Text);
		$Text = preg_replace("(cock)is",'****',$Text);
		$Text = preg_replace("(dick)is",'****',$Text);
		$Text = preg_replace("(nigger)is",'******',$Text);
		$Text = preg_replace("(pussy)is",'*****',$Text);
		$Text = preg_replace("(penis)is",'*****',$Text);
		$Text = preg_replace("(vagina)is",'******',$Text);
		$Text = preg_replace("(whore)is",'*****',$Text);
		$Text = preg_replace("(slut)is",'****',$Text);
		$Text = preg_replace("(retard)is",'******',$Text);
		$Text = preg_replace("(douche)is",'******',$Text);
		$Text = preg_replace("(boob)is",'****',$Text);
		$Text = preg_replace("(butt)is",'****',$Text);
		$Text = preg_replace("(fag)is",'***',$Text);
		$Text = preg_replace("(homo)is",'****',$Text);
		$Text = preg_replace("(rape)is",'****',$Text);
		$Text = preg_replace("(chink)is",'****',$Text);
		$Text = preg_replace("(nigga)is",'*****',$Text);
		$Text = preg_replace("(spic)is",'****',$Text);
		$Text = preg_replace("(blowjob)is",'*******',$Text);
		$Text = preg_replace("(clit)is",'****',$Text);
		$Text = preg_replace("(wigger)is",'******',$Text);
		$Text = preg_replace("(beaner)is",'******',$Text);
		$Text = preg_replace("(nazi)is",'****',$Text);
		
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
		
		// Check for sized text
		$Text = preg_replace("(\[size=(.+?)\](.+?)\[\/size\])is","<span style=\"font-size: $1px\">$2</span>",$Text);
		
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
		
		// Images
		// [img]pathtoimage[/img]
		$Text = preg_replace("/\[img\](.+?)\[\/img\]/", '<img src="$1">', $Text);
		
		// [img=widthxheight]image source[/img]
		$Text = preg_replace("/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", '<img src="$3" height="$2" width="$1">', $Text);
		
		return $Text;
	}
?>