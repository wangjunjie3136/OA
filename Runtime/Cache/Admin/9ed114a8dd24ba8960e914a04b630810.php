<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/base.css"/>
    <link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/info-mgt.css"/>
    <link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/WdatePicker.css"/>
    <title>移动办公自动化系统</title>
    <style type='text/css'>
        table tr .id {
            width: 63px;
            text-align: center;
        }

        table tr .name {
            width: 118px;
            padding-left: 17px;
        }

        table tr .nickname {
            width: 63px;
            padding-left: 17px;
        }

        table tr .dept_id {
            width: 63px;
            padding-left: 13px;
        }

        table tr .sex {
            width: 63px;
            padding-left: 13px;
        }

        table tr .birthday {
            width: 80px;
            padding-left: 13px;
        }

        table tr .tel {
            width: 113px;
            padding-left: 13px;
        }

        table tr .email {
            width: 160px;
            padding-left: 13px;
        }

        table tr .addtime {
            width: 160px;
            padding-left: 13px;
        }

        table tr .operate {
            padding-left: 13px;
        }
    </style>
</head>

<body>
<div class="title"><h2>公文管理</h2></div>
<div class="table-operate ue-clear">
    <a href="/Thinkphp-1/index.php/Admin/Doc/add" class="add">添加</a>
    <a href="javascript:;" id="btndel" class="del">删除</a>
    <a href="javascript:;" id="btnedit" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
    <table>
        <thead>
        <tr>
            <th class="id">序号</th>
            <th class="name">标题</th>
            <th class="file">附件</th>
            <th class="content">内容</th>
            <th class="addtime">添加时间</th>
            <th class="operate">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td class="id"><?php echo ($vo["id"]); ?></td>
                <td class="name"><?php echo ($vo["title"]); ?></td>
                <td class="file"><?php echo ($vo["filename"]); ?></td>
                <td class="content"><?php echo (html_entity_decode($vo["content"])); ?></td>
                <td class="addtime"><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
                <td class="operate">
                    <input type="checkbox" value="<?php echo ($vo["id"]); ?>">
                    <a href='javascript:;'>查看</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear">
    <div class="pagin-list">
        <?php echo ($page); ?>
    </div>
    <div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
    <img src="MORKING_PATH<?php echo ($vo["filepath"]); ?>">
</div>
</body>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
    $(".select-title").on("click", function () {
        $(".select-list").hide();
        $(this).siblings($(".select-list")).show();
        return false;
    })
    $(".select-list").on("click", "li", function () {
        var txt = $(this).text();
        $(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
    })

    $("tbody").find("tr:odd").css("backgroundColor", "#eff6fa");

    showRemind('input[type=text], textarea', 'placeholder');
    $(function(){
        $('#btnedit').on('click',function(){
            var id = $(':checkbox:checked').val();
            if(id){
                window.location.href='/Thinkphp-1/index.php/Admin/Doc/edit/id/'+id;
            }else{
                alert('请选择');
            }
        });
        $('#btndel').on('click',function(){
            var id = $(':checkbox:checked');
            var ids = '';
            for(var i=0;i<id.length;i++){
                ids = ids+id[i].value+',';
            }
            ids = ids.substring(0,ids.length-1);
            if(ids){
                window.location.href='/Thinkphp-1/index.php/Admin/Doc/del/ids/'+ids;
            }else{
                alert('请选择');
            }
        });
    });
</script>
</html>