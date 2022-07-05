<?php
return [
    //保存文件的根目录，存储到数据库的固定为/uploads，
    //为了后期独立文件服务器，设置为/assets，可以将文件服务器的根目录设置为assets文件夹
    'file_path_prefix'=>'/assets',

    //生成文件绝对地址的配置 域名
    'file_domain'=>'/assets',
];
