<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/base.css" />
    <link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/info-mgt.css" />
    <link rel="stylesheet" href="/Thinkphp-1/Public/Admin/css/WdatePicker.css" />
    <title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
    <a href="javascript:;" class="add">添加</a>
    <a href="javascript:;" id="btndel" class="del">删除</a>
    <a href="javascript:;" id="btnedit" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
    <table>
        <thead>
        <tr>
            <th class="num">序号</th>
            <th class="name">部门</th>
            <th class="process">所属部门</th>
            <th class="node">排序</th>
            <th class="time">备注</th>
            <th class="operate">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                <td class="num"><?php echo ($vol["id"]); ?></td>
                <td class="name"><?php echo (str_repeat('&emsp;',$vol["level"]*2)); echo ($vol["name"]); ?></td>
                <?php if($vol['pid']==0): ?><td class="process">顶级部门</td>
                    <?php else: ?>
                    <td class="process"><?php echo ($vol["username"]); ?></td><?php endif; ?>
                <td class="node"><?php echo ($vol["sort"]); ?></td>
                <td class="time"><?php echo ($vol["remark"]); ?></td>
                <td class="operate">
                    <input type="checkbox" value="<?php echo ($vol["id"]); ?>"/>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear"></div>
</body>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Thinkphp-1/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
    $(".select-title").on("click",function(){
        $(".select-list").hide();
        $(this).siblings($(".select-list")).show();
        return false;
    })
    $(".select-list").on("click","li",function(){
        var txt = $(this).text();
        $(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
    })

    $('.pagination').pagination(100,{
        callback: function(page){
            alert(page);
        },
        display_msg: true,
        setPageNo: true
    });

    $("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

    showRemind('input[type=text], textarea','placeholder');

    $(function(){
        $('#btndel').on('click',function(){

            var id = $(':checkbox:checked');
            var ids = '';
            for(var i = 0;i < id.length;i++){
                ids = ids + id[i].value + ',';
            }
            ids = ids.substring(0,ids.length-1);
            if(ids){
                window.location.href = '/Thinkphp-1/index.php/Admin/Dept/del/ids/' + ids;
            }else{
                alert('请选择');
            }

        });
        //编辑
        $('#btnedit').on('click',function(){
            var id = $(':checkbox:checked').val();
            if(id){
                window.location.href = '/Thinkphp-1/index.php/Admin/Dept/edit/id/'+id;
            }else{
                alert('请选择');
            }

        });
    });

</script>
</html>