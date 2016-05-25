<p><span style="white-space:pre"></span><span style="font-size:32px; color:#ff0000; background-color:rgb(255,204,102)">rubyPHP演示地址：<a target="_blank" href="http://121.41.21.58/">http://121.41.21.58/</a></span></p>
<p><span style="font-size:12px"><span style="white-space:pre"></span><em>使用过CI和thinkPHP，CI简单却过于原始，thinPHP功能强大却太过庞大，鉴于以上原因，花了几天时间写了一个比CI代码简单却并thinkPHP功能复杂的框架——rubyPHP。</em></span></p>
<p><span style="white-space:pre"></span><span style="font-size:18px">rubyPHP的高性能体现在以下几个方面：</span></p>
<p><span style="font-size:18px; white-space:pre"></span><span style="font-size:18px">1.</span><strong><span style="font-size:24px">页面缓存</span></strong><span style="font-size:18px">。<strong><span style="color:#ff0000; background-color:rgb(255,255,102)">页面缓存指之前加载过的页面以文件方式缓存在服务器中，在一段时间内再次加载相同页面时无需重新执行页面逻辑直接加载静态页面</span></strong>。rubyPHP的页面缓存是自动进行的，在config/tpl.php中可配置是否启用缓存以及缓存文件的有效期。当然这仅仅是全局设置，在调用视图时可重新指定是否启用缓存以及缓存有效期。</span></p>
<p><span style="font-size:18px; white-space:pre"></span><span style="font-size:18px">2.</span><strong><span style="font-size:24px">SQL缓存</span></strong><span style="font-size:18px">。<span style="background-color:rgb(255,255,102)"><span style="color:#ff0000">sql缓存指之前执行过的查询sql语句以及他的结果缓存在内存中，在一段时间内用相同的sql语句执行查询操作时不经过数据库直接返回内存中数据</span></span>。rubyPHP使用Redis以键值方式缓存sql语句以及他的对应结果。rubyPHP能够在php7上完美运行。（附：关于windows
 php7 redis 扩展的下载参照我的另一篇博客：<a target="_blank" href="http://blog.csdn.net/fanghailiang2016/article/details/51396649">http://blog.csdn.net/fanghailiang2016/article/details/51396649</a>）。rubyPHP重写了mysql_query以及mongo_query方法，在执行查询sql查询语句时会优先加载未过期的缓存数据。与页面缓存类似，sql缓存的全局配置路径为config/redis.php，在具体执行sql语句前可重新执行是否使用缓存以及缓存有效期。</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>3.</span><span style="font-size:24px"><strong>读写分离</strong></span><span style="font-size:18px">。<span style="color:#ff0000; background-color:rgb(255,204,102)"><strong>读写分离是建立在主从同步基础上为了减轻服务器压力，将查询语句转移到从服务器上执行的解决方案</strong></span>。rubyPHP重写了mysql_query，mongo_query函数，除了对查询语句进行内存级缓存的优化，同时也将查询语句放到了从服务器上执行。<a href="http://lib.csdn.net/base/14" class="replace_word" title="undefined" target="_blank" style="color:#df3434; font-weight:bold;">MySQL</a>的主从配置文件路径为config/mysql.php。</span></p>
<p><span style="font-size:18px; white-space:pre"></span><span style="font-size:18px">4.</span><strong><span style="font-size:24px">html压缩</span></strong><span style="font-size:18px">。html压缩配合页面缓存，前者降低了服务器端压力，后者减少了输出内容所占空间，将html文件中的空格换行等进行压缩，减少了输出文件的大小，在一定程度上保护了html的安全。</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>rubyPHP在代码结构上模仿CI，在功能上模仿thinkPHP。</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>rubyPHP的功能包含以下几方面：</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>1.</span><span style="font-size:24px"><strong>使用了thinkPHP的M方法操作数据库</strong></span><span style="font-size:18px">。对于一些简单的sql语句无需手工写，用熟悉的M()-&gt;where()-&gt;limit()-&gt;find()这样的语法即可完成。曾经面试有人问我为什么thinkPHP的M方法能够进行连续操作，现在终于明白是使用了<strong>单利模式</strong>。</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>2.</span><span style="font-size:24px"><strong>屏蔽了数据库的差异</strong></span><span style="font-size:18px">。M方法的另一个优点是用来组件sql语句，对高层屏蔽数据库差异。当然，对于复杂的查询，M方法是做不到的，此时可以使用已被重写过的mysql_query以及mongo_query执行你的sql语句。</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>3.</span><span style="font-size:24px"><strong>自定义路由</strong></span><span style="font-size:18px">。这一点模仿了CI的route.php，将url同控制器的映射关系写到一个配置文件里。</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>不足之处：</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>view文件1不支持变量循环输出。目前的解决方案是使用angularjs调用接口在页面输出内容。框架示例程序便是一个使用angularjs的和bootstrap的界面。</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>以下是界面截图</span></p>
<p><span style="font-size:18px"><img src="" alt=""><img src="http://img.blog.csdn.net/20160517094547333?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast" alt=""><br>
</span></p>
<p><span style="font-size:18px"><span style="white-space:pre"></span>并且他的html是压缩输出的</span></p>
<p><span style="font-size:18px"><img src="" alt=""><img src="http://img.blog.csdn.net/20160517094611427?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast" alt=""><br>
</span></p>
<p><span style="font-size:18px">查询时调用了缓存</span></p>
<p><span style="font-size:18px"><img src="" alt=""><br>
</span></p>
<p><span style="font-size:18px"><br>
</span></p>
<p><span style="font-size:18px"><br>
</span></p>
<p><span style="white-space:pre"></span></p>
