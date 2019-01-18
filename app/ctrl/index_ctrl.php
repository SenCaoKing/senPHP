<?php
namespace app\ctrl;
include CORE.'/render.php';
use QL\QueryList;
use think\mongo\Query;

class index_ctrl extends \core\render{
    public function index(){
        /* 采集列表页 */
        // 待采集的页面地址
        $url = 'https://www.cnbeta.com/';

        // 采集规则
        $rules = [
            // 文章标题
            'title' => ['a:eq(0)', 'text'],
            // 文章链接地址
            'link' => ['a:eq(0)', 'href'],
            // 文章缩略图
            'img' => ['img:eq(0)', 'src'],
            // 文章简介
            'summary' => ['p:eq(0)', 'text']
        ];

        // 切片选择器
        $range = '.items-area>.item';

        $data = QueryList::Query($url, $rules, $range)->data;
        p($data);

        $this->display('index/index.html');
    }

    public function data(){
        $db = new \core\db();
        $sql = 'select * from sk_user';
        $result = $db->query($sql);
        dump($result);
        dump($result->fetchAll());
    }

    public function render(){
        $this->assign('username','senking');
        $this->display('index/render.html');
    }

    public function render2(){
        $this->smarty->assign('username','senking');
        $this->smarty->display('index/render2.html');
    }

    public function conf(){
        // include CORE.'/conf.php';
        $value = \core\conf::get('ACTION','route_config');
        echo $value;
    }

    public function log(){
        $log = new \core\log();
        $log->log('this is log','log_test');
        echo '成功写入日志';
    }

    public function medoo(){
        $medoo = new \core\medoo();
        // dump($medoo);

        /**
         * 增、删、改、插
         */
        // 查找
        $ret = $medoo->select('user','*',['username'=>'Sen']);
        dump($ret);

        // 插入
        $data = array(
            'username'=>'Sen01',
            'password'=>'Sen01'
        );
        $res = $medoo->insert('user',$data);
        dump($medoo->id());

        // 删除
        $ret = $medoo->delete('user',['username'=>'Sen02']);
        dump($ret->rowCount());

        // 修改
        $ret = $medoo->update('user',['username'=>'Sen02'],['username'=>'Sen01']);
        dump($ret->rowCount());
    }

    public function model(){
        $user = new \app\model\user();
        dump($user->list_all());
        dump($user->find_by_id(1));
        dump($user->find_by_condition(['username'=>'Sen']));
        dump($user->add(['username'=>'Sen03','password'=>'Sen02']));
        dump($user->edit(['username'=>'Sen02'],['username'=>'Sen01']));
        dump($user->del(['username'=>'Sen02']));
    }
}