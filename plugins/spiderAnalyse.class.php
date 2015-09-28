<?php

/**
 * 蜘蛛日志分析功能
 */
class spiderAnalyse{

	/**
	 * 初始化菜单
	 */
	public function __construct(){
		
		add_action('admin_menu', array(&$this,'addMenu') );

	}

	/**
	 * 添加菜单
	 */
	public function addMenu(){
		add_menu_page('spideranalyse', '蜘蛛日志分析', 'manage_options', __FILE__, array(&$this,'spideranalysePage') );
	}


	/**
	 * 获取蜘蛛的抓取的数量
	 * @param  $date 日志日期，月份 2015-09
	 *
	 * 组合之后的数据为一个大数组，键为蜘蛛名称，值为数量和日期
	 */
	public function getcount($date){
		$loginfo = array();
		$log = ABSPATH.'/wp-content/log/spiderlog-'.date("Y-m").'.php';
		$fp = fopen($log,'r');
		$i = 0;

		while( !feof($fp) ){
			$line = fgets($fp);
			$i+=1;
			if( $i < 2 ) continue;
			if( empty($line) ) continue;
			$data = json_decode($line,true);
			//print_r($data);
			//转化为y-m-d格式的日期，丢弃时间
			$date = date("Y-m-d",strtotime($data['time']));
			!isset($loginfo[$data['robot']][$date]) && $loginfo[$data['robot']][$date] = 0;
			$loginfo[$data['robot']][$date] += 1;
		}

		fclose($fp);
		//print_r($loginfo);
		return $loginfo;
	}

	/**
	 * 日志分析菜单所展示页面
	 * @return none
	 */
	public function spideranalysePage(){
		$loginfo = $this->getcount('2015-09');
		include( dirname(__FILE__).'/analyse/index.php' );
	}


}

new spiderAnalyse();