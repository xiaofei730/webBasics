<?php 

//获取表名
namespace Core;
class Model
{
    private $table;
    public function __construct($table = '')
    {
        if ($table != '') {
            $this->table = $table;
        } else {
            $this->table = substr(basename(get_class($this)), 0, -5);
        }

        echo $this->table,'<br>';
    }
}

namespace Model;
class ProductsModel extends \Core\Model
{

}

namespace Controller\Admin;

new \Core\Model('news');
new \Model\ProductsModel();

//insert语句

$table = 'products';    //表名
//插入的数据
$data['proid'] = '111';
$data['proname'] = '钢笔';
$data['proprice'] = 120;

//第一步：拼接字段名
$keys = array_keys($data);          //获取所有的字段名
$keys = array_map(function($key){       //在所有的字段名上添加反引号
    return "`{$key}`";
}, $keys);
$keys = implode(',', $keys);        //字段名用逗号连接起来

//第二步：拼接值
$values = array_values($data);
$values = array_map(function($value){
    return "'{$value}'";
}, $values);
$values = implode(',', $values);

//拼接SQL语句
echo $sql = "insert into `{$table}` {$keys} values {$values}";


//update语句
$table = 'products';    //表名
//插入的数据
$data['proID'] = '111';
$data['proname'] = '钢笔';
$data['proprice'] = 120;
//获取主键
function getPrimaryKey($table)
{
    $link = mysqli_connect('localhost', 'root', 'root', 'data');
    mysqli_set_charset($link, 'uft8');
    $rs = mysqli_query($link, "desc `{$table}`");
    while ($rows = mysqli_fetch_assoc($rs)) {
        if ($rows['Key'] == 'PRI') {
            return $rows['Field'];
        }
    }
}

echo getPrimaryKey($table);

//第一步：获取非主键
$keys = array_keys($data);      //获取所有键
$pk = getPrimaryKey($table);    //获取主键
$index = array_search($pk, $keys);      //返回主键在数组中的下标
unset($keys[$index]);   //删除主键

//第二步：拼接`键`='值'的形式
array_map(function($key) use ($data){
    return "`{$key}`='{$data[$key]}'";
}, $keys);
$keys = implode(',', $keys);

//第三步：拼接SQL语句
echo $sql = "update `{$table}` set $keys where $pk='{$data[$pk]}'";



//update products set proname='dd',proprice='120' where proid=11;


//select语句

/**
 * 
 * $table string 表名
 * $cond array 条件
 * 
 */
function select($table, $cond=array())
{
    $sql = "select * from `{$table}` where 1";
    if (!empty($cond)) {
        foreach($cond as $k=>$v) {
            if (is_array($v)) { //条件的值是数组类型
                switch ($v[0]) {        //$v[0]保存的是符号，$v[1]保存的是值
                    case 'eq':
                        $op = '=';
                        break;
                    case 'gt':
                        $op = '>';
                        break;
                    case 'lt':
                        $op = '<';
                        break;
                    case 'gte':
                    case 'egt':
                        $op = '>=';
                        break;
                    case 'gte':
                    case 'egt':
                        $op = '>=';
                        break;
                    case 'lte':
                    case 'elt':
                        $op = '<=';
                        break;
                    case 'neq':
                        $op = '<>';
                        break;
                    
                }
                $sql.=" and `$k` $op '{$v[1]}'";
            } else {
                $sql.=" and `$k`='$v'";
            }
           
        }
    }
    return $sql;
}

$table = 'products';
$cond = array(
    'proname' => '钢笔',
    'proprice' => '12',
    'pronum' => array('eq', '13')  //eq 相等   gt greater than 大于等于  lt 小于等于
);

echo select($table);
echo select($table, $cond);










