<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\extend\tools;

use common\extend\exception\MyHttpException;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Class PageUtils
 */
class QueryUtils
{
    /**
     * 查询query
     * @var ActiveQuery|null
     */
    private ?ActiveQuery $query;

    /**
     * 参数
     * @var array
     */
    private array $params;

    /**
     * 表别名
     * @var string
     */
    private string $alias;

    /**
     * QueryUtils constructor.
     * @param ?ActiveQuery $query
     * @param array $params
     * @param string $alias
     * @throws MyHttpException
     */
    public function __construct(?ActiveQuery $query = null, $params = [], $alias = '')
    {
        if (!$query) {
            throw new MyHttpException(400, 'QueryUtils初始参数不是一个有效的ActiveQuery');
        }
        $this->query = $query;
        $this->params = $params;
        $this->alias = $alias;
    }

    /**
     * @return ActiveQuery
     */
    public function getQuery(): ActiveQuery
    {
        return $this->query;
    }

    /**
     * where处理
     * @return $this
     */
    public function whereParse(): QueryUtils
    {
        $params = $this->params;
        if (!$params) return $this;
        $query = $this->query;
        //表单的条件 where 的条件
        if (isset($params['where']) && is_array($params['where'])) {
            foreach ($params['where'] as $key => $value) {
                if ($this->checkFieldAndValue($key, $value)) $query = $query->andWhere([$this->joinAlias($key) => $value]);
            }
        }
        //常用比较符
        $compareTag = ['eq' => '=', 'neq' => '<>', 'gt' => '>', 'lt' => '<', 'egt' => '>=', 'elt' => '<='];
        foreach ($compareTag as $tag => $operate) {
            if (isset($params[$tag]) && is_array($params[$tag])) {
                foreach ($params[$tag] as $key => $value) {
                    if ($this->checkFieldAndValue($key, $value)) $query = $query->andWhere([$operate, $this->joinAlias($key), $value]);
                }
            }
        }

        //表单的条件 in 的条件
        if (isset($params['in']) && is_array($params['in'])) {
            foreach ($params['in'] as $key => $value) {
                if ($this->checkFieldAndValue($key, $value)) $query = $query->andWhere([$this->joinAlias($key) =>$value]);
            }
        }

        //表单的条件 like 的条件
        if (isset($params['like']) && is_array($params['like'])) {
            foreach ($params['like'] as $key => $value) {
                if ($this->checkFieldAndValue($key, $value)) $query = $query->andWhere(['like', $this->joinAlias($key), $value]);
            }
        }

        //表单的条件 find 的条件
        if (isset($params['find']) && is_array($params['find'])) {
            foreach ($params['find'] as $key => $value) {
                if ($this->checkFieldAndValue($key, $value)) $query = $query->andWhere(new Expression('FIND_IN_SET("' . trim($value) . '", ' . $this->joinAlias($key) . ')'));
            }
        }

        //表单的条件 time 时间戳，当数据库存储的是时间戳时
        if (isset($params['time']) && is_array($params['time'])) {
            foreach ($params['time'] as $key => $value) {
                if (trim($key) && is_array($value) && count($value) > 0) {
                    $start = trim($value[0]);
                    $end = trim($value[1] ?? '');
                    if ($start && strtotime($start) !== false) $query->andWhere(['>=', $this->joinAlias($key), strtotime($start)]);
                    if ($end && strtotime($end) !== false) {
                        $end = strtotime($end);
                        if ($end == $start) $end = $end + 24 * 3600 - 1;
                        $query->andWhere(['<=', $this->joinAlias($key), $end]);
                    }
                }
            }
        }

        //表单的条件 date 的条件 日期格式
        if (isset($params['date']) && is_array($params['date'])) {
            foreach ($params['date'] as $key => $value) {
                if (trim($key) && is_array($value) && count($value) > 0) {
                    $start = trim($value[0] ?? ($value['start'] ?? ''));
                    $end = trim($value[1] ?? ($value['end'] ?? ''));
                    if ($start) $start = strtotime($start);
                    if ($end) $end = strtotime($end);
                    if ($start || $end ) {
                        if ($start && $end ) {
                            $startDate = date('Y-m-d', $start);
                            $endDate = date('Y-m-d', $end);
                            if ($startDate === $endDate) {
                                $query = $query->andWhere([$this->joinAlias($key) => $startDate]);
                            } else {
                                $query = $query->andWhere(['between', $this->joinAlias($key), $startDate, $endDate]);
                            }
                        } elseif ($start) {
                            $query = $query->andWhere(['>=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key) . ')', $start]);
                        } elseif ($end) {
                            $query = $query->andWhere(['<=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key) . ')', $end]);
                        }
                    }
                }
            }
        }
        //表单的条件 datetime 的条件 日期时间格式
        if (isset($params['datetime']) && is_array($params['datetime'])) {
            foreach ($params['datetime'] as $key => $value) {
                if (trim($key) && is_array($value) && count($value) > 0) {
                    $start = trim($value[0] ?? ($value['start'] ?? ''));
                    $end = trim($value[1] ?? ($value['end'] ?? ''));
                    if ($start) $start = strtotime($start);
                    if ($end) $end = strtotime($end);
                    if ($start || $end) {
                        if ($start && $end) {
                            $startDate = date('Y-m-d H:i:s', $start);
                            $endDate = date('Y-m-d H:i:s', $end);
                            if ($startDate === $endDate) {
                                $query = $query->andWhere([$this->joinAlias($key) => $startDate]);
                            } else {
                                $query = $query->andWhere(['between', $this->joinAlias($key), $startDate, $endDate]);
                            }
                        } elseif ($start) {
                            $query = $query->andWhere(['>=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key) . ')', $start]);
                        } elseif ($end) {
                            $query = $query->andWhere(['<=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key) . ')', $end]);
                        }
                    }
                }
            }
        }

        // 兼容以前的between，新的使用date或dateime
        if (isset($params['between']) && is_array($params['between'])) {
            foreach ($params['between'] as $key => $value) {
                if (trim($key) && is_array($value) && count($value) > 0) {
                    $start = trim($value[0] ?? ($value['start'] ?? ''));
                    $end = trim($value[1] ?? ($value['end'] ?? ''));
                    if ($start) $start = strtotime($start);
                    if ($end) $end = strtotime($end);
                    if ($start || $end) {
                        if ($start && $end) {
                            $startDate = date('Y-m-d H:i:s', $start);
                            $endDate = date('Y-m-d H:i:s', $end);
                            if ($startDate === $endDate) {
                                $query = $query->andWhere([$this->joinAlias($key) => $startDate]);
                            } else {
                                $query = $query->andWhere(['between', $this->joinAlias($key), $startDate, $endDate]);
                            }
                        } elseif ($start) {
                            $query = $query->andWhere(['>=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key) . ')', $start]);
                        } elseif ($end) {
                            $query = $query->andWhere(['<=', 'UNIX_TIMESTAMP(' . $this->joinAlias($key) . ')', $end]);
                        }
                    }
                }
            }
        }
        $this->query = $query;
        return $this;
    }

    /**
     * 处理排序
     * @param array $default 最后添加默认的排序
     * @return $this
     */
    public function orderParse(array $default = ['id' => SORT_ASC]): QueryUtils
    {
        $params = $this->params;
        $orderBy = $params['orderBy'] ?? []; //自定义的排序
        $orderByColumn = trim($params['orderByColumn'] ?? '');
        $orderBySort = trim($params['orderBySort'] ?? 'asc');
        if ($orderBySort == 'ascending') $orderBySort = 'asc';
        if ($orderBySort != 'asc') $orderBySort = 'desc';
        $orderList = [];
        if ($orderByColumn) $orderList[$this->joinAlias($orderByColumn)] = strtolower($orderBySort) == 'asc' ? SORT_ASC : SORT_DESC;
        // 指定排序
        foreach ($orderBy as $key => $val) {
            $key = $this->joinAlias($key);
            if (!array_key_exists($key, $orderList)) $orderList[$key] = strtolower($val) == 'asc' ? SORT_ASC : SORT_DESC;
        }

        //默认
        if ($default) {
            foreach ($default as $key => $value) {
                if (!isset($orderList[$this->joinAlias($key)])) $orderList[$this->joinAlias($key)] = $value;
            }
        }

        $this->query = $this->query->orderBy($orderList);
        return $this;
    }

    /**
     * 处理字段
     * @return $this
     */
    public function fieldParse(): QueryUtils
    {
        $field = $this->params['field'] ?? '';
        if ($field) {
            if ($this->alias) {
                if (is_string($field)) $field = explode(",", trim($field));
                if (is_array($field)) {
                    foreach ($field as $key => $value) {
                        $field[$key] = $this->joinAlias($value);
                    }
                }
            }
            $this->query = $this->query->select($field);
        }
        return $this;
    }

    /**
     * 给字段拼接表名简称
     * @param $field
     * @return string
     */
    protected function joinAlias(string $field): string
    {
        $field = trim($field);
        if ($this->alias) {
            if (strpos($field, '.')) return $field;
            return $this->alias . '.' . $field;
        }
        return $field;
    }


    /**
     * 检测是否设置了某个键并且值可用
     * @param $key
     * @param $value
     * @return bool
     */
    protected function checkFieldAndValue($key, $value): bool
    {
        if (is_string($value)){
            return trim($key) && (trim($value) || trim($value) == '0');
        }else{
            return trim($key) && $value;
        }

    }
}