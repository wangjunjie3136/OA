<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/base.css" />
<link rel="stylesheet" type="text/css" href="/Thinkphp-1/Public/Admin/css/jquery.dialog.css" />
<link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/index.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div id="container">
  <div id="hd">
    <div class="hd-wrap ue-clear">
      <div class="top-light"></div>
      <h1 class="logo"></h1>
      <div class="login-info ue-clear">
        <div class="welcome ue-clear"><span>欢迎您,</span><a href="javascript:;" class="user-name"><?php echo session('user_name');?></a></div>
        <div class="login-msg ue-clear">
          <a href="<?php echo U('Email/recbox');?>" target="iframe" class="msg-txt">消息</a>
          <a href="<?php echo U('Email/recbox');?>" target="iframe" class="msg-num">0</a>
        </div>
      </div>
      <div class="toolbar ue-clear"> <a href="javascript:;" class="home-btn">首页</a> <a href="javascript:;" class="quit-btn exit"></a> </div>
    </div>
  </div>
  <div id="bd">
    <div class="wrap ue-clear">
      <div class="sidebar">
        <h2 class="sidebar-header">
          <p>功能导航</p>
        </h2>
        <ul class="nav">
          <li class="office current">
            <div class="nav-header"><a href="javascript:;" date-src="home.html" class="ue-clear"><span>日常办公</span><i class="icon"></i></a></div>
          </li>
          <li class="gongwen">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>公文起草</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Doc/showList">公文列表</a></li>
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Doc/add">添加公文</a></li>
            </ul>
          </li>
          <li class="nav-info">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>职员信息</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/User/showList">职员列表</a></li>
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/User/add">职员添加</a></li>
            </ul>
          </li>
          <li class="konwledge">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>知识管理</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Knowledge/showList">知识列表</a></li>
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/knowledge/add">添加知识</a></li>
            </ul>
          </li>
          <li class="agency">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>组织结构</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Dept/showList">部门列表</a></li>
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Dept/add">添加部门</a></li>
            </ul>
          </li>
          <li class="email">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>邮件管理</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Email/send">发送信件</a></li>
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Email/sendbox">发件箱</a></li>
              <li><a href="javascript:;" date-src="/Thinkphp-1/index.php/Admin/Email/recbox">收件箱</a></li>
            </ul>
          </li>
          <li class="system">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>系统管理</span><i class="icon"></i></a></div>
          </li>
        </ul>
      </div>
      <div class="content">
        <iframe src="home.html" name="iframe" id="iframe" width="100%" height="100%" frameborder="0"></iframe>
      </div>
    </div>
  </div>
  <div id="ft" class="ue-clear">
    <div class="ft-left"> <span>中国移动</span> <em>Office&nbsp;System</em> </div>
    <div class="ft-right"> <span>Automation</span> <em>V2.0&nbsp;2014</em> </div>
  </div>
</div>
<div class="exitDialog">
  <div class="dialog-content">
    <div class="ui-dialog-icon"></div>
    <div class="ui-dialog-text">
      <p class="dialog-content">你确定要退出系统？</p>
      <p class="tips">如果是请点击“确定”，否则点“取消”</p>
      <div class="buttons">
        <input type="button" class="button long2 ok" value="确定" />
        <input type="button" class="button long2 normal" value="取消" />
      </div>
    </div>
  </div>
</div>
</body>

<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/jquery.dialog.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/index.js"></script>
<script type="text/javascript">
  function getMsgCount(){
    $.get("<?php echo U('Email/getMsgCount');?>",function(data){
          $('.msg-num').html(data);
    });
  }

$(function(){
  setInterval('getMsgCount()',5000)
});
</script>
</html>