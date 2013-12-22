
gxcms光线CMS1.5火车头发布模块与免登陆接口
====================



接口使用说明：
----------------------------
1. 修改 \core\Lib\Action\Admin\LocoyAction.class.php 中的验证密码'lzw.me'为你所设
2. 火车头导入发布模块，修改发布模块中对应的验证密码

注意事项：
----------------------------
该发布模块基于火车头 V8 版本制作。对于发布模块使用，应当注意如下几点：

1. 应修改“内容发布参数”中“内容发布地址后缀”的url中的验证密码 lzw.me
/index.php?s=/Admin/Locoy/vodaddjiekou/pwd/lzw.me/
2. 应修改“获取栏目列表”中“刷新页面列表地址后缀”的url中的验证密码 lzw.me
/index.php?s=Admin/Channel/getchannel/pwd/lzw.me/
3. 应修改文件 core/Lib/Action/Admin/LocoyAction.class.php 中的验证密码

发布参数与标签参考：
----------------------------

title=[标签:标题]
cid=[分类ID]
serial=[标签:连载]
intro=[标签:备注]
color=
actor=[标签:主演]
stars=3
director=[标签:导演]
language=[标签:语言]
year=[标签:上映日期]
keywords=[标签:关键词]
area=[标签:地区]
inputer=admin
picurl=[标签:缩略图]
playurl=[标签:播放地址]
downurl=[标签:下载地址]
content=[标签:内容]
status=1
monthhits=
weekhits=
dayhits=
addtime=[系统时间转化:yyyy-MM-dd HH:mm:ss]
checktime=1
reurl=[采集页网址]
submit=+%E6%8F%90+%E4%BA%A4+
__hash__=[网页随机值2]

帮助支持
----------------------------
设计制作：志文工作室
网站支持：http://lzw.me


安装方法：
----------------------------

解压缩下载的压缩包，复制到根目录进行替换即可。

访问：http://网址/wap.php

注意事项：
----------------------------
1. 基于dedecms 织梦的 wap 进行了少许的二次开发，替换前请备份如下文件：
        templets/wap/ 目录
        wap.php 文件
2. 关于界面，效果很赞，具体可看演示或截图；
3. 关于性能，很多人提到的问题，PC 上无压力，移动设备上可明显感到反应延迟，如您对此有相关经验，还请不吝赐教！

第一次独立使用 jquery mobile 开发，不足之处请多指点！

相关：
----------------------------
站点：http://w.lzw.me        http://lzw.me

演示：http://w.lzw.me/wap

支持：http://lzw.me/a/dedecms-wap-templet-jquery-mobile.html

作者：@任侠 @志文工作室

日期：2013-10-25 20:40
