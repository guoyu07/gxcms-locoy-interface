<?php
/**
 * @name    火车头采集发布模块
 * @package GXCMS.Administrator
 * @link    http://lzw.me 志文工作室
 */
class LocoyModel extends Model {
	
    private $VdoDB;
    function __construct(){
		$this->VdoDB=D('video');	
    }	

	/**
	 * 采集影片入库
	 * @param array   $vod  新采集数据
	 * @param boolean $must 是否强制更新
	 */
    public function xml_insert($vod,$must){
		if(empty($vod['title']) 
			|| ( empty($vod['playurl']) && empty($vod['downurl']) ) 
		){
			return '影片名称或播放地址、下载地址为空，不做处理!';
		}
		//未入库标识
		if ( !$vod['cid'] ) {
			//$vod['cid'] = 999;
			return '未匹配到对应栏目分类，不做处理!';
		}
		//过滤常规重复字符
		$vod['title']    = str_replace(array('HD','BD','DVD','VCD','TS','【完结】','【】','[]','()'),'',$vod['title']);
		$vod['actor']    = str_replace(array(',','/','，','|','、'),' ',$vod['actor']);
		$vod['director'] = str_replace(array(',','/','，','|','、'),' ',$vod['director']);
		//入库开始
		unset($vod['id']);
		//来源网站检测
		//$array = $this->VdoDB->field('id,cid,title,inputer,playurl')->where('reurl="'.$vod['reurl'].'"')->find();
		//if($array){
			//有来源.检测影片地址是否发生变化
		//	return $this->xml_update($vod,$array,$must);
		//}else
		{
			//无来源.检测是否有相同影片(需防止同名的电影与电视冲突)
			$array = $this->VdoDB->field('id,cid,title,intro,actor,inputer,playurl')->where('title="'.$vod['title'].'"')->find();
			if($array){
				//无主演时直接更新该影片
				if(empty($vod['actor'])){
					return $this->xml_update($vod,$array,$must);
				}
				//演员完全相等时更新该影片
				if($array['actor'] == $vod['actor']){
					return $this->xml_update($vod,$array,$must);
				}
				//有相同演员时更新该影片
				$arr_actor_1 = explode(' ',$vod['actor']);
				$arr_actor_2 = explode(' ',str_replace(array(',','/','，','|','、'),' ',$array['actor']));
				if(array_intersect($arr_actor_1,$arr_actor_2)){
					return $this->xml_update($vod,$array,$must);
				}
			}
			//其它条件将新加影片，添加前做相似条件判断
			if(C('web_collect_num')){
				$length = ceil(strlen($vod['title'])/3)-intval(C('web_collect_num'));
				if($length >= 2){
					$where['title'] = array('like','%'.get_replace_html($vod['title'],0,$length).'%');
					$array = $this->VdoDB->field('id,title,inputer,actor,playurl')->where($where)->find();
					
					//主演完全相同则更新
					if(!empty($array['actor']) && !empty($vod['actor']) ){
					 //对比
					$arr_actor_1 = explode(' ',$vod['actor']);
				    $arr_actor_2 = explode(' ',str_replace(array(',','/','，','|','、'),' ',$array['actor']));
				    if(!array_diff($arr_actor_1,$arr_actor_2) && !array_diff($arr_actor_2,$arr_actor_1)){//若差集为空
					return $this->xml_update($vod,$array,$must);
				    }
				    //主演不完全相同则添加
					}
					
					if(!in_array($vod['inputer'],$array) && $array){//inputer不同则隐藏
					$vod['status'] = -1;
					}
				}
			}
			//添加影片开始
			if (C('upload_http')) {
				$down = D('Down');
				$vod['picurl'] = $down->down_img($vod['picurl']);
			}
			$this->VdoDB->data($vod)->add();
			return '视频添加成功！';
		}
    }

	/**
	 * 影片更新检测 
	 * 
	 * @param array   $vod    新采集数据
	 * @param array   $array  数据库查询获取数据
	 * @param boolean $must
	 */
	public function xml_update($vod,$array,$must=false){
		if('gxcms' == $array['inputer']){
			return '站长手动锁定，退出更新！';
		}
		if(!$must){//是否强制更新资料
			if ($array['playurl'] == $vod['playurl']  && $array['downurl'] == $vod['downurl']) {
			return '地址未变化，退出更新！';
			}

			$count_vod   = count(explode(chr(13),($vod['playurl'] . $vod['downurl'])));
			$count_array = count(explode(chr(13),trim($array['playurl'] . $array['downurl'])));
			if($count_vod < $count_array){
				return '小于数据库集数，退出更新！';
			}
		}else{
			if (C('upload_http')) {
				$down = D('Down');
				$edit['picurl'] = $down->down_img($vod['picurl']);
			}else{
				$edit['picurl'] = $vod['picurl'];
			}
			$edit['title']    = $vod['title'];
			$edit['actor']    = $vod['actor'];
			$edit['director'] = $vod['director'];
			$edit['area']     = $vod['area'];
			$edit['language'] = $vod['language'];
			$edit['reurl']    = $vod['reurl'];
		}
		$edit['intro']    = $vod['intro'];
		$edit['cid']     = $vod['cid'];
		$edit['serial']  = $vod['serial'];
		$edit['playurl'] = $vod['playurl'];
		$edit['downurl'] = $vod['downurl'];
		$edit['addtime'] = time();
		$edit['reurl']   = $vod['reurl'];
		$this->VdoDB->where('id='.$array['id'])->data($edit)->save();	
		return '播放地址更新成功！';
	}		
}
?>