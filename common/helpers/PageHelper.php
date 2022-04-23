<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\helpers;

use Yii;
use yii\helpers\Url;

class PageHelper{
    public $firstRow = 0; // 起始行数
    public $listRows = 10; // 列表每页显示行数
    public $parameter = []; // 分页跳转时要带的参数
    public $totalRows = 0; // 总行数
    public $totalPages = 0; // 分页总页面数
    public $rollPage   = 11;// 分页栏每页显示的页数
	public $lastSuffix = true; // 最后一页是否显示总页数
    public $url = '';//控制前链接
    public $p = 'page'; //分页参数名
    private $nowPage = 1;

	// 分页显示定制
    private $config  = [
        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '上一页',
        'next'   => '下一页',
        'first'  => '首页',
        'last'   => '尾页',
        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
        'current'=>'current'
    ];

    /**
     * 架构函数
     * @param int $totalRows 总的记录数
     * @param int $listRows 每页显示记录数
     * @param array $parameter 分页跳转的参数
     * @param string $url
     */
    public function __construct(int $totalRows = 0, int $listRows = 10, array $parameter = [],string $url = '') {
        /* 基础设置 */
        $this->totalRows  = $totalRows; //设置总记录数
        $this->listRows   = $listRows;  //设置每页显示行数
        if($totalRows>0){
            $this->totalPages = intval(ceil($this->totalRows / $this->listRows)); //总页数
        }
        $this->url = $url;
        $this->parameter  = empty($parameter) ? Yii::$app->request->get() : $parameter;
        $nowPage          = intval(Yii::$app->request->get($this->p,0));
        $this->nowPage    = $nowPage<1?1:$nowPage;
        $this->firstRow   = $this->listRows * ($this->nowPage - 1);
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig(string $name,string $value) {
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    private function url(int $page): string
    {
        $params = $this->parameter;
        $params[$this->p] = $page;
        //最前面插入空字符串 当前的链接
        array_unshift($params,$this->url);
        return Url::toRoute($params);
    }

    /**
     * 组装分页链接
     * @return string
     */
    public function show(): string
    {
        if(0 == $this->totalRows) return '';

        /* 计算分页信息 */

        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }

        /* 计算分页零时变量 */
        $now_cool_page      = $this->rollPage/2;
		$now_cool_page_ceil = ceil($now_cool_page);
		//$this->lastSuffix && $this->config['last'] = $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
        $up_page = $up_row > 0 ? '<a class="prev" href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a>' : '';

        //下一页
        $down_row  = $this->nowPage + 1;

        $down_page = ($down_row <= $this->totalPages) ? '<a class="next" href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a>' : '';

        //第一页
        $the_first = '';
        if($this->totalPages>$this->listRows){
            if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
                $the_first = '<a class="first" href="' . $this->url(1) . '">' . $this->config['first'] . '</a>';
            }else{
                $the_first = '<a class="first" href="javascript:;">' . $this->config['first'] . '</a>';
            }
        }


        //最后一页
        $the_end = '';
        if($this->totalPages>$this->listRows) {
            if ($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages) {
                $the_end = '<a class="end" href="' . $this->url($this->totalPages) . '">' . $this->config['last'] . '</a>';
            } else {
                $the_end = '<a class="end" href="javascript:;">' . $this->config['last'] . '</a>';
            }
        }
        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
			if(($this->nowPage - $now_cool_page) <= 0 ){
				$page = $i;
			}elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
				$page = $this->totalPages - $this->rollPage + $i;
			}else{
				$page = $this->nowPage - $now_cool_page_ceil + $i;
			}
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                    $link_page .= '<a class="num" href="' . $this->url($page) . '">' . $page . '</a>';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
                    $link_page .= '<a href="javascript:;" class="'.$this->config['current'].'">' . $page . '</a>';
                }
            }
        }

        //替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
            $this->config['theme']);
        return "{$page_str}";
    }
}
