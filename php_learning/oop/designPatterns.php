<?php

/**
 * 单例模式
 * 一个类只能有一个对象
 * 应用场景：多次请求数据库值需要一个连接对象
 * 实现：三私一公
 * （1）私有的静态属性用来保存对象的单例
 * （2）私有的构造方法用来阻止在类的外部实例化
 * （3）私有的__clone阻止在类的外部clone对象
 * （4）公有的静态方法用来获取对象的单例
 * 
 * class DB {
 *      private static $instance;
 *      //私有的构造方法阻止在类的外部实例化
 *      private function __construct() {
 *      }
 *      
 *      //私有的__clone()阻止在类的外部clone对象
 *      private function __clone(){}
 * 
 *      public static function getInstance() { 
 *          //保存的值不属于DB类的类型就实例化
 *          if (!self::$instance instanceof self)
 *              self::$instance = new self();
 *          return self::$instance;
 *      }
 * 
 * }
 * 
 * $db = DB::getInstance;
 * $db2 = clone $db;
 * $db2 = DB::getInstance;
 * var_dump($db, $db2)
 * 
 */


/**
 * 
 * 工厂模式
 * 
 * 特点：传递不同的参数获取不同的对象
 * 
 * class ProductsA{
 * 
 * }
 * class ProductsB{
 * 
 * }
 * 
 * class ProductsFactory {
 *      public function create($num) {
 *          switch($num) {
 *              case 1:
 *                  return new ProductsA;
 *              case 2:
 *                  return new ProductsB;
 *              default:
 *                  return null;
 *          }
 *      }
 * 
 * }
 * $factory = new ProductsFactory();
 * 
 * $obj1 = $factory->create(1);
 * $obj2 = $factory->create(2);
 * 
 * var_dump($obj1, $obj2);
 * 
 */



/**
 * 策略模式
 * 特点：传递不同的参数调用不同的策略（方法）
 * 
 * class Walk{
 * 
 *  public function way() {
 *      echo '走者去<br>';
 *  }
 * 
 * }
 * 
 * class Bus{
 * 
 *      public function way() {
 *          echo '坐车去<br>';
 *      }
 * 
 * }
 * 
 * 
 * class Student {
 * 
 *  public function play($obj) {
 *      $obj->way();
 *  }
 * 
 * }
 * 
 * $stu = new Student();
 * 
 * $stu->play(new Walk());
 * 
 * $stu->play(new Bus());
 * 
 * 
 * 
 * 
 * 
 */


/**
 * 
 * 封装MySQL单例
 * 
 * class MySQLDB {
 *      private $host;      //主机地址
 *      private $port;      //端口号
 *      private $user;         //用户名
 *      private $pwd;           //密码
 *      private $charset;       //字符集
 *      private $dbname;        //数据库名
 *      private $link;          //连接对象
 *          
 *      private static $instance;
 * 
 *      private function __construct($param) {
 *          $this->initParam($param);
 *          $this->initConnect();
 *      }
 * 
 *      private function __clone() {}
 *          获取单例
 *      public static function getInstance($param = array()) {
 *          if (!self::$instance instanceof self)
 *              self::$instance = new self($param);
 *          retrun self::$instance;
 * 
 *      }
 * 
 *      初始化参数
 *      private function initParam($param) {
 *          $this->host = $param['host'] ?? '127.0.0.1';
 *          $this->user = $param['user'] ?? '';
 *          $this->port = $param['port'] ?? 3306;
 *          $this->pwd = $param['pwd'] ?? '';
 *          $this->dbname = $param['dbname'] ?? '';
 *          $this->charset = $param['charset'] ?? 'utf8';
 *          $link = mysqli_connect($this->host, $this->user, $this->pwd, $this->dbname, $this->port);
 * 
 *      }
 * 
 *      连接数据库
 *      private function initConnect() {
 *          $this->link =  new mysqli($this->host, $this->user, $this->pwd, $this->dbname, $this->port);
 *          if (mysqli_connect_error()) {
 *              echo '数据库连接失败<br>';
 *              echo '错误信息：'.mysqli_connect_error(),'<br>';
 *              echo '错误码：'.mysqli_connect_errno(),'<br>';
 *              exit;
 *          }
 *          $this->link->set_charset($this->charset);
 *       
 *      }
 * 
 *      执行数据库的增、删、改、查
 *      private function execute($sql) {
 *          if (!$rs = $this->link->query($sql)) {
 *            
 *              echo 'SQL语句执行失败';
 *              echo '错误码：'.mysqli_errno($this->link),'<br>';
 *              echo '错误信息：'.mysqli_error($this->link); 
 *              exit;
 *          }
 *          return $rs;
 *      }
 * 
 *      public function exec($sql) {
 *          $key = substr($sql, 0, 6);
 *          if (in_array($key, array('insert', 'update', 'delete'))) {
 *              return $this->execute($sql);
 *          } else {
 *              echo '非法访问<br>';
 *              exit;
 *          }
 * 
 *      }
 * 
 *      public function getLastInsertId() {
 *          return $this->link->insert_id;
 *      }
 * 
 *      返回对象
 *      public function query($sql) {
 *          if(substr($sql, 0, 6) == 'select' || ubstr($sql, 0, 4) == 'show' || ubstr($sql, 0, 4) == 'desc') {
 *              return $this->execute($sql);
 *          } else {
 *              echo '非法访问<br>';
 *              exit;
 *          }
 *      }
 * 
 *      返回二维数组
 *      public function fetchAll($sql, $type = 'assoc') {
 *          $rs = $this->query($sql);
 *          $type = $this->getType($type);
 *          retrun $rs->fetch_all($type);
 *      }
 * 
 *      匹配一维数组
 *      public function fetchRow($sql, $type = 'assoc') {
 *           $list = $this->fetchAll($sql, $type);
 *           if (!empty($list)) 
 *              return $list[0];
 *            return array();
 * 
 *       }
 *      
 *      返回一行一列
 *      public function fetchColumn($sql) {
 *          $list = $this->fetchRow($sql, 'num');
 *          if (!empty($list))
 *              return $list[0];
 *          return null;
 *      }
 *          
 * 
 *      public function getType($type) {
 *          switch($type) {
 *              case 'num':
 *                  return MYSQLI_NUM;
 *              case 'both':
 *                  return MYSQLI_BOTH;
 *              default:
 *                  return MYSQLI_ASSOC;
 *          }
 * 
 *      }
 * 
 * }
 * 
 * $param = array(  
 *      'host' => '127.0.0.1',
 *      'user' => 'root',
 *       'pwd' => 'root'
 *      'dbname' => 'data'x
 * )
 * 
 * $db = MySQLDB::getInstance($param);
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */




