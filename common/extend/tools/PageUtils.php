<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\extend\tools;
/**
 * Class PageUtils
 */
class PageUtils
{
    /**
     * 开始索引
     * @var int
     */
    private int $offset;

    /**
     * 每页数量
     * @var int
     */
    private int $pageSize = 10;

    /**
     * 当前页数
     * @var int
     */
    private int $pageNum = 1;

    /**
     * 页码字段
     * @var string
     */
    public string $pageNumField = 'pageNum';

    /**
     * 数量字段
     * @var string
     */
    public string $pageSizeField = 'pageSize';

    /**
     * 构造函数
     * PageUtils constructor.
     * @param string $pageNumField
     * @param string $pageSizeField
     * @param int $defaultPageSize
     */
    public function __construct($pageNumField = '', $pageSizeField = '', $defaultPageSize = 10)
    {
        if ($pageNumField) $this->pageNumField = $pageNumField;
        if ($pageSizeField) $this->pageSizeField = $pageSizeField;

        $post = \Yii::$app->request->post();
        $pageNum = intval($post[$this->pageNumField] ?? 1);
        $pageSize = intval($post[$this->pageSizeField] ?? 0);

        if ($pageNum > 0) $this->pageNum = $pageNum;
        if ($pageSize > 0) {
            $this->pageSize = $pageSize;
        }else{
            $this->pageSize = $defaultPageSize;
        }
        $this->offset = ($this->pageNum - 1) * $this->pageSize;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return int
     */
    public function getPageNum(): int
    {
        return $this->pageNum;
    }


    /**
     * 格式化返回数据
     * @param array $list
     * @param array $extend
     * @return array
     */
    private function format(array $list = [], array $extend = []): array
    {
        $return = [
            'list' => $list,
            'hasMore' => count($list) >= $this->pageSize,
            $this->pageSizeField => $this->pageSize,
            $this->pageNumField => $this->pageNum
        ];
        return array_merge($return, $extend);
    }

    /**
     * 用于一般查询列表返回
     * @param array $list
     * @param int $total
     * @param array $extend
     * @param string $name
     * @return array
     */
    public function listFormat(array $list = [], $total = 0,$extend = [], $name = 'total'): array
    {
        $extend[$name] = intval($total);
        return $this->format($list, $extend);
    }
}