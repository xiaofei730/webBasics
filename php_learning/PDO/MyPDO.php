<?PHP

class MyPDO 
{
    private $type;          //数据库类别
    private $host;          //主机地址
    private $port;          //端口号
    private $dbname;         //数据库名
    private $charset;       //字符集
    private $user;          //用户名
    private $pwd;           //密码
    private $pdo;           //保存pdo 对象

    private static $instance;

    private function __construct($param)
    {
        $this->initParam($param);
        $this->initPDO();
        $this->initException();
    }

    private function __clone()
    {

    }

    public static function getInstance($param = array()) 
    {
        if(!self::$instance instanceof self)
            self::$instance = new self();
        return self::$instance;

    }

    //初始化参数
    private function initParam($param) 
    {
        $this->type = $param['type'] ?? 'mysql';
        $this->host = $param['host'] ?? '127.0.0.1';
        $this->port = $param['port'] ?? '3306';
        $this->dbname = $param['dbname'] ?? 'data';
        $this->charset = $param['charset'] ?? 'utf8';
        $this->user = $param['user'] ?? 'root';
        $this->pwd = $param['pwd'] ?? 'root';
    }

    //初始化PDO
    private function initPDO()
    {
        try {
            $dsn = "{$this->type}:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->user, $this->pwd);
        } catch(PDOException $ex) {
            $this->showException($ex);
            exit;
        }


    }

    private function showException($ex, $sql='')
    {
        if($sql != '') {
            echo 'SQL语句执行失败<br>';
            echo '错误的SQL语句是：'.$sql,'<br>';
        } else {
            echo '错误编码'.$ex->getCode(),'<br>';
            echo '错误信息'.$ex->getMessge(),'<br>';
            echo '错误文件'.$ex->getFile(),'<br>';
            echo '错误行号'.$ex->getLine(),'<br>';
        }
    }

    //设置异常模式
    private function initException()
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    //执行增、删、该操作
    public function exec($sql) 
    {
        try{
            return $this->pdo->exec($sql);
        } catch(PDOException $ex) {
            $this->showException($ex, $sql);
            
            exit;
        }
    }

    //获取自动增长的编号
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}

$mypdo = new MyPDO();
var_dump($mypdo);










