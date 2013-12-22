<?php
/**
 * @name    火车头发布模块
 * @package Cms
 * @link    http://lzw.me 志文工作室
 * @author [任侠] <[webmaster#lzw.me]>
 */
class LocoyAction extends CmsAction{
	/**
	 * 密码验证
	 * @return [boolean]      [description]
	 */
	private function _validpwd(){
    	if(!isset($_REQUEST['pwd']) || $_REQUEST['pwd'] != 'lzw.me'){
    		return false;
    	}
    	return true;
	}
	//show
    public function show(){
		echo "nothing";
    }
    /**
     * 获取频道列表
     * @return [type] [description]
     */
    public function getchannel(){
    	//权限验证
    	if(!$this->_validpwd()){
    		die('deny!');
    	}

		$cid = intval($_GET['id']);
		if ($cid) {
			$where['id'] = get_channel_sqlin($cid);
		}

		$rs   = M("Channel");
		$list = $rs->field('id,pid,mid,cname')->order('id asc')->select();
		//$list = $rs->where($where)->order('oid asc')->select();
		//print_r(list_to_tree($list,'id','pid','son',0));die();
		if ($list){
			echo "<pre>";
			$this->_cteate_channel(list_to_tree($list,'id','pid','son',0));
		}else{
			echo('暂无栏目分类,请先添加！');
		}
	}
	private function _cteate_channel($list, $t){
		if(empty($list)) return false;
		//print_r($list);
		foreach ($list as $key => $value) {
			echo "<li cid='".$value['id']."'>",$t,$value['cname'],"</li>";
			if(isset($value['son'])){
				$t .= "&nbsp;&nbsp;";
				$this->_cteate_channel($value['son'], $t);
				$t = '';
			}
		}
	}

	/**
	 * 火车头视频发布接口
	 * @return [type] [description]
	 */
    public function vodaddjiekou(){
    	//权限验证
    	if(!$this->_validpwd()){
    		die('deny!');
    	}

		$vod = $_REQUEST;
		//接收数据
		$vod['addtime'] = time();
		$vod['stars']   = mt_rand(1,4);
		$vod['letter']  = get_letter($vod['title']);
		$vod['hits']    = mt_rand(0,C('web_admin_hits'));
		$vod['score']   = mt_rand(1,C('web_admin_score'));
		$vod['scoreer'] = mt_rand(1,C('web_admin_score'));
		$vod['up']      = mt_rand(1,C('web_admin_updown'));
		$vod['down']    = mt_rand(1,C('web_admin_updown'));
		$vod['inputer'] = 'collect_'.$vod['inputer'];
		
		//数据再次处理
    	$host_addto_playurl = '[www.dy810.com]';
		$vod['playurl'] = strtr($vod['playurl'], array('.rmvb'=>$host_addto_playurl.'.rmvb','.avi'=>$host_addto_playurl.'.avi','.mp4'=>$host_addto_playurl . '.mp4','.mkv'=>$host_addto_playurl . '.mkv'));
		if($vod['hits']<1000){
			$vod['hits'] = mt_rand(100,1000);
			$vod['monthhits'] = mt_rand(50, $vod['hits']);
			$vod['weekhits'] = mt_rand(50, $vod['monthhits']);
			$vod['dayhits'] = mt_rand(1, $vod['weekhits']);
		}

		//print_r($vod);die();
		$locoy = D('Admin.Locoy');
		
		$res = $locoy->xml_insert($vod,0);
		if ($res) {
			echo $res;
		}else{
			$this->error("视频添加失败!");
		}
    }	
}
?>