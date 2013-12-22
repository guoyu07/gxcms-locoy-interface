
gxcms光线CMS1.5火车头发布模块与免登陆接口
====================

本发布模块基于火车头 v8 版本设计制作。

接口使用说明：
----------------------------
1. 复制 core 文件夹覆盖至光线CMS安装根目录即可；
2. gxcms接口适用于gxcms 1.5版本，在内容发布上借鉴光线自带采集模块，对于重复数据会自动过滤/更新。

发布模块注意事项：
----------------------------
该发布模块基于火车头 V8 版本制作。对于发布模块使用，为安全考虑，应当注意如下几点：

1. 应修改“内容发布参数”中“内容发布地址后缀”的url中的验证密码'lzw.me'为你所设
/index.php?s=/Admin/Locoy/vodaddjiekou/pwd/lzw.me/
2. 应修改“获取栏目列表”中“刷新页面列表地址后缀”的url中的验证密码'lzw.me'为你所设
/index.php?s=Admin/Channel/getchannel/pwd/lzw.me/
3. 应修改文件 core/Lib/Action/Admin/LocoyAction.class.php 中的验证密码'lzw.me'为你所设

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


相关：
----------------------------

支持：http://lzw.me/a/gxcms-locoy-interface.html

作者：[@任侠](http://weibo.com/zhiwenweb) [@志文工作室](http://lzw.me)

网站：http://lzw.me

日期：2013-12-22
