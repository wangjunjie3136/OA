<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'veh1lcg2.zzcdb.dnstoo.com', // 服务器地址
    'DB_NAME'               =>  'junjie',          // 数据库名
    'DB_USER'               =>  'junjie_f',      // 用户名
    'DB_PWD'                =>  'junjie3136',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀

    //RBAC配置项
    'RBAC_ROLES'            =>  array(
                        1   =>  '高层领导',
                        2   =>  '中级领导',
                        3   =>  '普通职员',
    ),
    'RBAC_AUTHS'            =>  array(
                    'auth1' => array('*/*'),
                    'auth2' => array('email/*','doc/add','doc/showlist','knowledge/*','index/*'),
                    'auth3' => array('email/*','doc/showlist','knowledge/showlist','index/*'),
    ),
);