<?php 

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
echo $sql = "update `{$table}` set $keys";



//update products set proname='dd',proprice='120' where proid=11;







