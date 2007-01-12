<?php
/** 
*
* help_faq [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: help_faq.php,v 1.6 2006/06/10 14:30:48 grahamje Exp $
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
		1 => '登入和注册问题'
	),
	array(
		0 => '为什么我不能登入?',
		1 => '您注册过了吗?您必须注册才可以登入。您是否在这个论坛被禁止了?（如果是，您会看到提示）如果是这样的话请您与系统管理员联系查明原因。 如果您确实注册过并且没有被禁止然而您仍然不能登录，那么请仔细检查您的帐号和密码,通常这是不能登入的原因。如果问题仍旧存在请及时通知系统管理员，他们有可能会错误配置论坛的设定。'
	),
	array(
		0 => '为什么我需要注册?',
		1 => '您可以不注册,是否注册后才可以发表文章是由系统管理员决定的. 无论如何,注册将给您提供不对访客提供的功能.例如：头像功能、私人讯息服务、发送电子邮件给朋友、加入团队等等… 注册仅仅花费您一点点的时间,我们推荐您这样做.'
	),
	array(
		0 => '为什么我会自动登出?',
		1 => '如果您登入时没有勾选[自动登入]的选项. 论坛将只在系统预设的时间内视您为在线.这是为了防止别人误用您的帐号.如果您希望长时间保持在线状态,请选取[自动登入]的选项.如果您正在使用一台公用的电脑,比如在图书馆,网咖,学校等地方,我们不推荐您选取这个选项.'
	),
	array(
		0 => '怎样使我的帐号不出现在在线用户列表上?',
		1 => '在您的个人资料里您会找到一个选项[隐藏您的在线状态],如果设定为是,您的在线状态将只有您自己和管理员看得到,您会被认为是一位隐身会员.'
	),
	array(
		0 => '我遗失密码了, 该怎么办!',
		1 => '不要担心! 当您无法找回您的密码时, 系统可以为您重设. 请到登入画面下, 并按下 <u>忘记密码</u>, 此功能将能让您尽快的回到论坛'
	),
	array(
		0 => '我已经注册了, 但是却不能登入!',
		1 => '首先, 先确认您输入的是正确的帐号和密码. 如果都没有问题的话, 或许是以下两种情形之一. 若 COPPA 的功能启动了, 而且您在注册时按下了 <u>我未满十三岁</u> 的连结, 您必须按照您所收到的程序说明启用您的帐号. 若是这样还没解决问题的话, 是否您的帐号需要启用呢? 有一些论坛在注册程序完成后需要启用帐号 (会员自行启用或由系统管理员为您启用)? 如果您已收到了确认信, 请按照您所收到的程序说明启用您的帐号. 如果您没有收到确认信, 请检查您的电子邮件信箱是否填写正确? 另一个没收到信的原因,可能是您所使用的电子邮件网域被系统封锁了, 这是为了防止论坛遭受滥用. 如果您确定电子邮件地址无误的话, 请向论坛管理人员联系以取得答案.'
	),
	array(
		0 => '我已经按照以上步骤注册, 但是还是无法登入?!',
		1 => '最有可能的原因是您输入的帐号和名称并不正确 (在注册后请至电子信箱收取确认信) 或是论坛管理人员因为某些原因删除了您的帐号. 如果为后者的话, 很有可能是因为您并未发表任何文章所导致? 通常论坛会定期删除一些没有发表任何文章的会员, 来降低资料库的使用量. 试着重新再注册一次, 并参与讨论吧!!'
	),
	array(
		0 => '--',
		1 => '用户的偏好设定'
	),
	array(
		0 => '我要如何更改我的设定呢?',
		1 => '您所有的设定(如果您已经注册成功的话)都已经被储存在资料库里. 如欲修改设定请点选 <u>个人资料</u> 的连结(在预设首页的上方但是您也可以不变更设定). 这样将会允许您改变您所有的设定值'
	),
	array(
		0 => '论坛显示的时间不正确!',
		1 => '论坛的时间可以确定是没有问题的, 然而若您来自于跟论坛不同时区的地方时, 就有可能发生时间显示错误. 假如您遇到这个问题的话请到您的个人资料里面更改符合您所在地时区的设定, 例如: London (伦敦), Paris (巴黎), New York (纽约), Sydney (雪梨)... 等等.  请注意只有注册会员可以变更时区设定, 假如您尚未注册的话, 请赶紧注册, 不然您就必须容许这个错误的存在!'
	),
	array(
		0 => '我已经更改时区了, 但是时间依然是错误的!',
		1 => '如果您确定您设定的时区正确, 然而版面时间仍然是错误的话, 最接近的答案是 "日光节约时间" (或 "夏日时间" 就如英国和其它地方的表示一样). 论坛不被设计来处理日光时间与正常时间之间的转换问题, 所以在夏天的月份时间与正确时间相比, 或许会有大约一个小时的差距.'
	),
	array(
		0 => '语系清单中没有我的语系!',
		1 => '最有可能的原因应该是, 论坛管理人员没有安装您的语系或在此论坛上并没有人翻译您的语系. 试着连系系统管理员是否能安装您需要的语系档, 如果这档案是不存在的, 请试着建立新的翻译语系. 更多的资讯会在 phpBB Group website 里被找到 (请按页面上的按钮连结)'
	),
	array(
		0 => '要如何在我的帐号下秀出个人图像?',
		1 => '在观看文章时可能有两个图像在帐号下. 首先的图像是关于您的 "群组&身分", 一般而言,这些会是版面上的星星或者是区块, 用来显示您已发表了多少篇文章, 或是您在版面上的某些 "状态". 在此之下, 或许是一个很大的个人图像, 一般而言这图像是独一无二的或可以代表个人的. 这将取决于系统管理员, 是否有启动这个图像功能, 而且他们具有选择图像限制的权利. 如果您无法使用个人图像, 这是系统管理员所决定的, 所以您可以询间他们原因为何? (我们相信他们会为您解释的!)'
	),
	array(
		0 => '要如何改变我的等级?',
		1 => '基本上您无法直接更改任何有关阶级身分的显示文字 (阶级身分将在您所发表的文章标题的帐号下显示出来, 并且您的个人资料将使用此身分风格). 许多论坛使用阶级身分功能去指出哪些文章是您所发表的, 并且鉴定您是否为可疑的用户, 例如: 版主跟论坛管理者都有个特别的身分. 请不要为了提升您的身分而胡乱张贴文章, 您将会因此而看到版主或论坛管理人员将您的文章标上警告标语.'
	),
	array(
		0 => '当我按下用户电子邮件连结时, 系统会要求要登入?',
		1 => '很抱歉, 只有注册的会员才能够经由内建的电子邮件发送功能, 发送电子邮件 (如果系统管理员有启动这个功能). 这是为了防止匿名访客恶意的使用电子邮件系统.'
	),
	array(
		0 => '--',
		1 => '张贴文章的问题'
	),
	array(
		0 => '我该如何在版面上发表一篇新的主题?',
		1 => '很简单, 只需按下论坛或主题版面内的发表文章按钮即可. 当您发表文章时, 必须要先注册成为会员, 您所能使用的论坛功能将列在画面下方 (这列表包含了 <i>您可以发表新的话题, 您可以发起投票...等等<i>.)'
	),
	array(
		0 => '我要如何编辑或是删除文章?',
		1 => '除非您为系统管理员或是论坛管理人员, 不然您只可以编辑或删除您所发表的文章. 您可以按下标题旁的 "编辑" 的按钮来编辑一篇文章 (有时候只能在文章发表后限制的时间内). 如果有人已经回覆您的文章时, 当您回到主题时, 您将会发现在您所发表的文章下方有一小块文字资讯出现, 那些资讯列出了您所编辑文章的那个时间.当没有人回覆您的文章时, 那些资讯将不会出现, 当版主或是系统管理员编辑您的文章时, 这些资讯也不会出现 (管理者将会给您一个讯息说明为何要修改您的文章). 请注意, 普通会员没有办法删除已经有人回覆的文章.'
	),
	array(
		0 => '我要如何建立个人的签名档?',
		1 => '若想要在您张贴的文章下显示您的签名档, 您必须先经由个人资料区建立一个签名档. 当建立好签名档后, 您可以在发表文章下的选项内, 勾选 <i>附上签名</i> 的选项来附加您的签名档. 您也可以在您的个人资料内选取 "发表文章时附加签名档" 的选项 (这样可以预防您在发表文章时, 忘了勾选 "附加签名" 的选项, 而没有显示个人的签名档)'
	),
	array(
		0 => '我要如何建立投票?',
		1 => '建立投票是很简单的, 当您发表一个新主题时 (或修改之前发表文章的主题, 如果您被允许的话), 您可以在主要发表栏里看到 "加入投票" 的选项 (如果您不能看到这项功能, 或许是因为您没有建立投票的权利). 您必须输入一个投票的标题并且至少要有两个选项 (要设定选项请在投票问题内输文并且按下 "增加选项" 的按钮. 您可以同时设定投票期限, 0 是代表无限期的投票. 而选项的数量也许会由论坛管理人员设定限制'
	),
	array(
		0 => '我如何修改或删除投票?',
		1 => '跟文章一样, 投票可以被文章发表者, 系统管理或是论坛管理人员所修改. 要修改投票请按下主题的第一篇发表文章 (这里通常与投票相连). 如果没有人放弃投票的话, 用户可以删除或修改投票的项目, 无论如何, 如果已经有人投票, 就只有系统管理员或是版面管理人员可以修改或删除. 这是为了预防在投票过程中途更改意见而产生错误的投票'
	),
	array(
		0 => '为什么我不能进入版面?',
		1 => '一些版面也许是有限制会员或是群组进入的. 要浏览, 读取, 发表...等等功能, 您必须要有特别的授权, 只有系统管理员和版面管理人员才能准许这个申请, 您必须联系他们试试.'
	),
	array(
		0 => '为什么我不能投票?',
		1 => '只有已注册的会员能够使用投票的功能 (一样是为了避免错误的结果出现). 如果您已经注册但是仍然无法投票的话, 您也许没有被允许使用这个功能.'
	),
	array(
		0 => '--',
		1 => '版面和主题形式'
	),
	array(
		0 => '什么是 BBCode?',
		1 => 'BBCode 是一种整合HTML的特别语法, 您可不可以使用 BBCode 取决于系统管理员的开放与否  (您也可以在每个版面的发表中取消这个功能). BBCode 的型式类似 HTML, Tags可以用 [ 及 ] 包含着而不需要使用 &lt; 及 &gt; 而且也提供了较佳的操作性方便用户控制版面的编排. 要找寻更多的 BBCode 资讯, 从发表的页面会提示您如何使用.'
	),
	array(
		0 => '我可以使用 HTML 吗?',
		1 => '...'
	),
	array(
		0 => '什么是表情符号?',
		1 => '表情符号, 或情绪符号是一个小的图形符号用以表现一种情绪, 例如: :)  表示快乐, :( 表示沮丧. 所有的表情符号可以在发表文章的版面找到. 试着不要过度使用这个表情符号, 他们可能会造成文章阅读的不便而使得版主必须修改或是移除掉这些符号'
	),
	array(
		0 => '我可以贴图吗?',
		1 => '我可以贴图吗?", "图像可以在您的发表的文章中出现, 您不一定要把图像上传到论坛上, 您只要指定图像的连结位置, 例如: http://www.some-unknown-place.net/my-picture.gif. 您不能将路径指向您的电脑中 (除非您的电脑是开放性的伺服器) 以及将图像存在需要确认的主机中, 例如: hotmail 或是 yahoo 的信箱, 以及需要确认密码的地方, 等等. 要显示图像必须使用 BBCode [img] 标示或使用 HTML (如果允许的话).'
	),
	array(
		0 => '什么是公告?',
		1 => '公告通常包含重要的讯息, 您必须尽可能的去阅读所有的公告. 公告可以在每个版面的最上方找到. 您要发布公告则视您的权限程度, 这也是取决于系统管理员.'
	),
	array(
		0 => '什么是置顶主题?',
		1 => '置顶主题可以在公告之下一般文章之上的位置找到. 他们通常是重要的, 所以您也必须尽可能的去阅读它. 就如同公告一般, 版面管理人员会决定什么是重要的文章, 来置于版面的顶端.'
	),
	array(
		0 => '什么是锁定的主题?',
		1 => '锁定的主题通常是由版主或是论坛管理人员所设定. 您不能在锁定的主题中回覆文章, 而且所有的投票都会终止. 主题可能由许多的原因而被锁定.'
	),
	array(
		0 => '--',
		1 => '会员等级及群组'
	),
	array(
		0 => '什么是系统管理员?',
		1 => '系统管理员被设定为拥有版面最高管理权限的人员. 系统管理人员可以控制论坛上的基本设定包括允许, 封锁帐号, 建立群组或选择版面管理者等等. 他们也拥有版面管理者的完全权力.'
	),
	array(
		0 => '什么是版面管理员?',
		1 => '版面管理员是一个独立的 (或是群组), 其工作是管理版面 . 版面管理员拥有权力去修改, 删除, 锁定, 开放, 移动或分割版面的文章. 一般来说, 版面管理人员是预防会员发表上的错误, 离题或是有争议性的文章.'
	),
	array(
		0 => '什么是会员群组?',
		1 => '会员群组是论坛管理员分组管理会员的一种方法 (这是和其它许多论坛不同的地方) 而且每个群组可以设定不同的权力. 这可以让系统管理员更容易的去建立数个类似版主功能的帐号管理者, 或是让限定群组进入限制版面等等.'
	),
	array(
		0 => '我该如何加入一个群组?',
		1 => '要加入一个群组请按页面上的会员群组连结 (由版面设计而决定), 您可以预览所有的群组. 但是不是所有的群组都是"开放性"的, 有些是封闭群组或隐藏群组. 如果论坛是开放的, 您可以按申请钮来要求加入. 而群组管理者将处理您的要求, 他们或许会问您为什么要加入这个群组. 如果不幸申请驳回, 请不要一直重覆申请, 因为群组管理者有其考量.'
	),
	array(
		0 => '我要如何成为一个群组管理者呢?',
		1 => '会员群组都是由论坛管理者所建立, 同样的版面管理者也是由其指派. 如果您对于建立一个群组很有兴趣您可以寄讯息联络系统管理员.'
	),
	array(
		0 => '--',
		1 => '私人讯息'
	),
	array(
		0 => '我无法寄出私人讯息!',
		1 => '有三个可能性; 您可能没有登入, 系统管理员关闭了寄送私人讯息功能或是版面管理员设定您无法寄出讯息. 请联络管理人员询问原因.'
	),
	array(
		0 => '我持续收到不想要的私人讯息!',
		1 => '在私人讯息系统中您可以将其加入黑名单. 如果您还是持续收到由某人发送的不受欢迎私人讯息请通知管理人员, 他们可以帮助您避免持续受到这种骚扰.'
	),
	array(
		0 => '我持续收到由论坛某人寄出的漫骂信件!',
		1 => '很抱歉听到这个消息. 这个论坛的电子信件包含安全防护用以查出发信者. 您可以转寄这封信给管理员, 这是一件很重大的事件 (寄出这封信的发信者清单). 他们会采取实际的行动.'
	),
	array(
		0 => '--',
		1 => 'phpBB 2 声明'
	),
	array(
		0 => '谁写了这个论坛?',
		1 => '这个程式 (未经修改的格式) 由 phpBB Group 所开发及释出, 著作版权归 <a href=http://www.phpbb.com/ target=_blank>phpBB Group</a> 所有. 依照“革奴大众公有版权”(GNU General Public License) 的声明, 这个程式可以自由的使用及散布, 如果您需要更多的资讯可以参考 <a href=http://www.gnu.org/ target=_blank>GNU General Public License</a>.'
	),
	array(
		0 => '为什么不能使用更多的功能?',
		1 => '这个软体是由 phpBB Group 所制作. 如果您认为需要加入更多功能请参观 phpbb.com website 的说明. 请不要发表进阶功能要求到 phpbb.com 的论坛, 这会使得开发小组分心无法致力新功能的开发. 请在版面浏览, 如果有任何我们已开发且经过测试的程式我们会放在版面上的.'
	),
	array(
		0 => '我该向谁联系有关这个论坛误用或法律上的相关事务?',
		1 => '您可以连络这个论坛的管理者. 如果您不能找到这个论坛的管理者以寻求更进一步的的联系. 如果您连络管理者之后仍然没有回应 (寻找 whois ) 或者其是属于一个执行中的免费服务 (例如: yahoo, free.fr, f2s.com...等等), 管理者或误用此服务的部门. 请记住 phpBB Group 是完全没有控制权而且完全不负任何责任的, 这个论坛位居何处以及何人拥有. 在相关法令下, 完全没有向 phpBB Group 指示 (cease and desist, liable, defamatory comment...等等). 也许不是直接由 phpbb.com 网站路径而得, 或者是只有 phpBB 此软体的部份而已. 如果您 email 到 phpBB Group 有关任何第三者使用软体上的问题, 您的答案将会非常简单或是根本不予回应.'
	)
);

?>