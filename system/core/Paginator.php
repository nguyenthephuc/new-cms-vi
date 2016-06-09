<?php
class Paginator extends ActiveRecord\Model {

    public static function getPaginate($config)
    {
        if(!is_array($config)) return false;
        if(!isset($config['table'])) return false;
        if(!isset($config['limit']) || !is_numeric($config['limit'])) return false;
        if(!isset($config['page']) || !is_numeric($config['page'])) return false;
        $table = $config['table'];
        $conditions = isset($config['conditions']) ? $config['conditions'] : '';
        $total = $table::count(array('conditions' => $conditions));
        $turn = $config['limit'];
        $k = (($config['page']) - 1 == 0) ? $config['page'] - 1 :  $turn*($config['page'] - 1);
        $where = (isset($config['conditions']) && $config['conditions']) ? "WHERE ".$config['conditions'] : '';
        $order = (isset($config['order']) && $config['order']) ? "ORDER BY ".$config['order'] : '';
        $data = $table::find_by_sql("SELECT * FROM {$config['table']} $where $order LIMIT $k, $turn");
        $sum_page = ceil($total / $turn);
        $next = self::Next($total, $config['page'], $turn);
        $before = self::Back($config['page']);
        return array('current'=>$config['page'], 'before' =>$before, 'next'=>$next, 'total'=>$sum_page, 'sumRecord'=>$total, 'from'=>$k, 'turn'=>$turn, 'data'=>$data);
    }

    public static function Next( $total, $sk, $turn )
    {
        $sum_page = ($total / $turn > round($total / $turn)) ? round($total / $turn) + 1 : round($total / $turn);
        if(($sk) < $sum_page){
            $n = $sk + 1;
            return $n;
        }
        return null;
    }

    public static function Back( $sk )
    {
        if($sk > 0){
            return $sk - 1;
        }
        return null;
    }
}