<?php
/** 
*
* help_bbcode [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: help_bbcode.php,v 1.5 2006/05/30 16:50:06 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
*/

// DEVELOPERS PLEASE NOTE 
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$help = array(
	array(
		0 => '--',
		1 => '介绍'
	),
	array(
		0 => '什么是 BBCode 代码?',
		1 => 'BBCode 代码是一种整合 HTML 的特别语法, 您可不可以使用 BBCode 代码取决于系统管理员的开放与否, 另外您也可以在每个版面的发表中取消这个功能. BBCode代码的型式类似HTML语法, 但是标签是用 [ 及 ] 含括着而不需要使用 &lt; 及 &gt;, 而且提供了较佳的操作性方便用户控制版面的编排. 您可以在文章发表的表格上方发现一系列便捷的 BBCode 代码按钮 (置放位置会依不同的布景样式而有所不同). 以下还有更多更详细的介绍.'
	),
	array(
		0 => '--',
		1 => '文字格式'
	),
	array(
		0 => '如何使用粗体, 斜体及加底线的文字?',
		1 => 'BBCode 代码包含一些标签, 方便您快速的更改文字的基本形式. 分述如下: <ul><li>要制作一份粗体文字可使用 <b>[b][/b]</b>, 例如: <br /><br /><b>[b]</b>哈啰<b>[/b]</b><br /><br />会变成<b>哈啰</b><br /><br /></li><li>要使用底线时, 可使用<b>[u][/u]</b>, 例如:<br /><br /><b>[u]</b>早安<b>[/u]</b><br /><br />会变成<u>早安</u><br /><br /></li><li>要斜体显示时, 可使用 <b>[i][/i]</b>, 例如:<br /><br />这个真是 <b>[i]</b>棒呆了!<b>[/i]</b><br /><br />将会变成 这个真是 <i>棒呆了!</i></li></ul>'
	),
	array(
		0 => '如何修改文字的颜色以及大小?',
		1 => '要在您的文章中修改文字颜色及大小需要使用以下的标签. 请注意, 显示的效果视您的浏览器和系统而定: <ul><li>更改文字色彩时, 可使用 <b>[color=][/color]</b>. 您可以指定一个可被辨识的颜色名称(例如. red, blue, yellow, 等等.) 或是使用颜色编码, 例如: #FFFFFF, #000000. 举例来说, 要制作一份红色文字您必须使用:<br /><br /><b>[color=red]</b>哈啰!<b>[/color]</b><br /><br />或是<br /><br /><b>[color=#FF0000]</b>哈啰!<b>[/color]</b><br /><br />都将显示:<span style="color:red">哈啰!</span><br /><br /></li><li>改变文字的大小也是使用类似的设定, 标签为 <b>[size=][/size]</b>. 这个标签的功能除了推荐使用数值形式以像素来显示您的文字大小外, 其余的视您使用的样式而定, 起始值为 1 (但是可能会小到您无法看见) 到 29 为止 (巨大). 举例说明:<br /><br /><b>[size=9]</b>小不拉叽<b>[/size]</b><br /><br />将会产生 <span style="font-size:9px">小不拉叽</span><br /><br />当情形改变时:<br /><br /><b>[size=24]</b>有够大颗!<b>[/size]</b><br /><br />将会显示 <span style="font-size:24px">有够大颗!</span></li></ul>'
	),
	array(
		0 => '我可以结合不同的标签功能吗?',
		1 => '当然可以, 例如要吸引大家的注意时, 您可以使用:<br /><br /><b>[size=18][color=red][b]</b>看我这儿!<b>[/b][/color][/size]</b><br /><br /> 将会显示出 <span style="color:red;font-size:18px"><b>看我这儿!</b></span><br /><br />我们并不建议您显示太多这类的文字! 但是这些还是由您自行决定. 在使用 BBCode 代码时, 请记得要正确的关闭标签, 以下就是错误的使用方式:<br /><br /><b>[b][u]</b>这是错误的示范<b>[/b][/u]</b>'
	),
	array(
		0 => '--',
		1 => '引言, 显示程式代码或固定宽度的文字'
	),
	array(
		0 => '回覆时引用文字',
		1 => '有两种方式可让您引用文章内容, 显示引用来源及直接引用.<ul><li>当您在讨论版面使用引言回覆时, 您会注意到文章内容已被加入回覆内容视窗内  <b>[quote=""][/quote]</b> 的区段. 这个方法允许您引用某位发表者的文章内容并显示来源! 例如要引用 Mr. Blobby 的文章内容时, 您必须输入:<br /><br /><b>[quote=" Mr. Blobby "]</b> Mr. Blobby 的文章内容放置在这里<b>[/quote]</b><br /><br />这将会在显示时, 自动加上: <b> Mr. Blobby  写到:</b> 实际的内容. 请记得您<b>必须</b>在 "" 里指定引用者的名称.<br /><br /></li><li>第二种方法允许您直接引用. 要使用这个标签时, 您必须使用 <b>[quote][/quote]</b> 标签. 而这种使用方式将会只会显示简单的引用功能, 例如: <b>引用回覆: </b>您所指定的文章内容.</li></ul>'
	),
	array(
		0 => '显示程式代码或固定宽度的文字',
		1 => '如果您想要显示一段程式代码或是任何需要固定宽度的文字, 您必须使用 <b>[code][/code]</b> 标签来包含这些文字, 例如:<br /><br /><b>[code]</b>echo "这是代码";<b>[/code]</b><br /><br />当您浏览时, 所有被 <b>[code][/code]</b> 标签包含的文字格式都将保持不变.'
	),
	array(
		0 => '--',
		1 => '制作列表'
	),
	array(
		0 => '制作没有排序的列表',
		1 => 'BBCode 代码支援两种列表模式, 有排序的和无排序的. 无排序的列表以符号且有条列的显示每个项目, 您需使用 <b>[list][/list]</b> 并且使用 <b>[*]</b> 来定义每一个项目. 例如要条列出您最喜欢的颜色时, 您可以使用:<br /><br /><b>[list]</b><br /><b>[*]</b>红色<br /><b>[*]</b>蓝色<br /><b>[*]</b>黄色<br /><b>[/list]</b><br /><br />这将产生以下列表:<ul><li>红色</li><li>蓝色</li><li>黄色</li></ul>'
	),
	array(
		0 => '制作依序排列的列表',
		1 => '第二种列表模式, 有排序的列表让您控制每个项目显示的顺序, 您需使用 <b>[list=1][/list]</b> 来制作以数字排序的列表, 或是以 <b>[list=a][/list]</b> 来制作以字母排序的列表. 如同无排序列表的使用方式一般, 我们以 <b>[*]</b>来指定排序的条件. 例如:<br /><br /><b>[list=1]</b><br /><b>[*]</b>到商店去<br /><b>[*]</b>买一台新的电脑<br /><b>[*]</b>当电脑烂掉时大骂一顿<br /><b>[/list]</b><br /><br />将会产生以下列表:<ol type="1"><li>到商店去</li><li>买一台新的电脑</li><li>当电脑烂掉时大骂一顿</li></ol>如果要使用字母排列的话, 您必须使用:<br /><br /><b>[list=a]</b><br /><b>[*]</b>第一个可能的答案<br /><b>[*]</b>第二个可能的答案<br /><b>[*]</b>第三个可能的答案<br /><b>[/list]</b><br /><br />将会产生<ol type="a"><li>第一个可能的答案</li><li>第二个可能的答案</li><li>第三个可能的答案</li></ol>'
	),
	array(
		0 => '--',
		1 => '建立连结'
	),
	array(
		0 => '连结到其它网站',
		1 => 'phpBB BBCode 代码支援数种产生网址的方式, 一般来说, 最常用的就是 URLs 功能.<ul><li>使用这个方法必须先使用 <b>[url=][/url]</b> 标签, 在等号 ( = ) 之后, 无论您输入任何资料, 皆会使得此一标签连结到您指定的 URL. 举例说明, 要连结 phpBB.com 时, 您可以使用:<br /><br /><b>[url=http://www.phpbb.com/]</b>参观 phpBB!<b>[/url]</b><br /><br />这会产生以下连结, <a href="http://www.phpbb.com/" target="_blank">参观 phpBB!</a> 您必须注意的是, 点选连结将开启一个新的视窗, 这是为了方便浏览者能继续浏览版面内容而设的.<br /><br /></li><li>如果您想要 URL 自行显示成连结, 您可以使用简单的设定:<br /><br /><b>[url]</b>http://www.phpbb.com/<b>[/url]</b><br /><br />这将会产生以下连结, <a href="http://www.phpbb.com/" target="_blank">http://www.phpbb.com/</a><br /><br /></li><li>在附加的 phpBB 功能中, 有一个<b>神奇连结</b>的功能, 这个功能将转换所有正确的 URL 句型成为连结, 您无需指定任何标签也不需要在句首加上 http://. 例如您在文章中输入 www.phpbb.com, 当您浏览时, 将自动转换成 <a href="http://www.phpbb.com/" target="_blank">www.phpbb.com</a> 显示.<br /><br /></li><li>这个功能也支援电子邮件位址, 您可以指定一个特定位址, 例如:<br /><br /><b>[email]</b>no.one@domain.adr<b>[/email]</b><br /><br />将会显示为 <a href="emailto:no.one@domain.adr">no.one@domain.adr</a> 或是您只要输入 no.one@domain.adr 系统会自动转换为预设的电子邮件位址.<br /><br /></li></ul>当您使用 BBCode  URLs 的标签时也可以加入其它标签功能, 如 <b>[img][/img]</b> (可参考下一个说明), <b>[b][/b]</b>...等等, 您可以搭配使用任何的标签, 但切记需正确的开启及关闭标签, 例如:<br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/url][/img]</b><br /><br />就是个不正确的语法, 不当的使用将导致您的文章被删除, 所以请小心使用.'
	),
	array(
		0 => '--',
		1 => '在文章中插入图片'
	),
	array(
		0 => '在文章中插入图片',
		1 => 'phpBB BBCode 代码提供标签在您的文章中显示图像. 使用前, 请记住两件重要的事;  第一, 许多用户并不乐于见到文章中有太多的图片, 第二, 您的图片必须是能在网路上显示的 (例如: 不能是您电脑上的档案 (除非您的电脑是台网路伺服器). phpBB 目前没有提供储存图片的功能  (在下一版的 phpBB 或许会加入此项功能). 目前, 若要显示图像, 您必须使用 <b>[img][/img]</b> 标签并指定图像连结网址,  例如:<br /><br /><b>[img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img]</b><br /><br />如同在先前网址连结的说明一样, 您也可以使用图片网址超连结 <b>[url][/url]</b> 的标签, 例如:<br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img][/url]</b><br /><br />将产生:<br /><br /><a href="http://www.phpbb.com/" target="_blank"><img src="http://www.phpbb.com/images/phplogo.gif" border="0" alt="" /></a><br />'
	),
	array(
		0 => '--',
		1 => '其它事项'
	),
	array(
		0 => '我可以加入自行定义的标签吗?',
		1 => '目前 phpBB 2.0 中并没有这项功能,  不过我们希望可以在下一个版本中加入这项功能'
	)
);

?>