<?php
/**
 * 中文分词操作类 替换成PHPbone提供的PHPanalysis类
 * 2015-03-25 15:05:58 kevin
 * @author wangcanjia
 * @uses
 * //使用的开源分词工具：http://www.phpbone.com/phpanalysis/
    //中文分词
    $segment = bc_base::load_sys_class('segment');
    $fulltext_data1 = $segment->get_keyword($segment->split_result($text));
    
    //搜索关键词
    $segment = bc_base::load_sys_class('segment');
    //分词后的搜索关键词
    $keyword = $keyword.' '.$segment->get_keyword($segment->split_result($keyword));
 */
//常量定义
define('_SP_', chr(0xFF).chr(0xFE));
define('UCS2', 'ucs-2be');

class segment {
// 	segment
// 	public $rank_dic = array();
// 	public $one_name_dic = array();
// 	public $two_name_dic = array();
// 	public $new_word = array();
// 	public $source_string = '';
// 	public $result_string = '';
// 	public $split_char = ' '; //分隔符
// 	public $SplitLen = 4; //保留词长度
// 	public $especial_char = "和|的|是";
// 	public $new_word_limit = "在|的|与|或|就|你|我|他|她|有|了|是|其|能|对|地";
// 	public $common_unit = "年|月|日|时|分|秒|点|元|百|千|万|亿|位|辆";
// 	public $cn_number = "０|１|２|３|４|５|６|７|８|９|＋|－|％|．|ａ|ｂ|ｃ|ｄ|ｅ|ｆ|ｇ|ｈ|ｉ|ｊ|ｋ|ｌ|ｍ|ｎ|ｏ|ｐ|ｑ|ｒ|ｓ |ｔ|ｕ|ｖ|ｗ|ｘ|ｙ|ｚ|Ａ|Ｃ|Ｄ|Ｅ|Ｆ|Ｇ|Ｈ|Ｉ|Ｊ|Ｋ|Ｌ|Ｍ|Ｎ|Ｏ|Ｐ|Ｑ|Ｒ|Ｓ|Ｔ|Ｕ|Ｖ|Ｗ|Ｘ|Ｙ|Ｚ";
// 	public $cn_sg_num = "一|二|三|四|五|六|七|八|九|十|百|千|万|亿|数";
// 	public $max_len = 13; //词典最大 7 中文字，这里的数值为字节数组的最大索引
// 	public $min_len = 3;  //最小 2 中文字，这里的数值为字节数组的最大索引
// 	public $cn_two_name = "端木 南宫 谯笪 轩辕 令狐 钟离 闾丘 长孙 鲜于 宇文 司徒 司空 上官 欧阳 公孙 西门 东门 左丘 东郭 呼延 慕容 司马 夏侯 诸葛 东方 赫连 皇甫 尉迟 申屠";
// 	public $cn_one_name = "赵钱孙李周吴郑王冯陈褚卫蒋沈韩杨朱秦尤许何吕施张孔曹严华金魏陶姜戚谢邹喻柏水窦章云苏潘葛奚范彭郎鲁韦昌马苗凤花方俞任袁柳酆鲍史唐费廉岑薛雷贺倪汤滕殷罗毕郝邬安常乐于时傅皮卡齐康伍余元卜顾孟平黄穆萧尹姚邵堪汪祁毛禹狄米贝明臧计伏成戴谈宋茅庞熊纪舒屈项祝董粱杜阮蓝闵席季麻强贾路娄危江童颜郭梅盛林刁钟徐邱骆高夏蔡田樊胡凌霍虞万支柯咎管卢莫经房裘缪干解应宗宣丁贲邓郁单杭洪包诸左石崔吉钮龚程嵇邢滑裴陆荣翁荀羊於惠甄魏加封芮羿储靳汲邴糜松井段富巫乌焦巴弓牧隗谷车侯宓蓬全郗班仰秋仲伊宫宁仇栾暴甘钭厉戎祖武符刘姜詹束龙叶幸司韶郜黎蓟薄印宿白怀蒲台从鄂索咸籍赖卓蔺屠蒙池乔阴郁胥能苍双闻莘党翟谭贡劳逄姬申扶堵冉宰郦雍郤璩桑桂濮牛寿通边扈燕冀郏浦尚农温别庄晏柴翟阎充慕连茹习宦艾鱼容向古易慎戈廖庚终暨居衡步都耿满弘匡国文寇广禄阙东殴殳沃利蔚越夔隆师巩厍聂晁勾敖融冷訾辛阚那简饶空曾沙须丰巢关蒯相查后江游竺";
  
	
// 	PHPanalysis
	//hash算法选项
	public $mask_value = 0xFFFF;
	
	//输入和输出的字符编码（只允许 utf-8、gbk/gb2312/gb18030、big5 三种类型）
	public $sourceCharSet = 'utf-8';
	public $targetCharSet = 'utf-8';
	
	//生成的分词结果数据类型 1 为全部， 2为 词典词汇及单个中日韩简繁字符及英文， 3 为词典词汇及英文
	public $resultType = 1;
	
	//句子长度小于这个数值时不拆分，notSplitLen = n(个汉字) * 2 + 1
	public $notSplitLen = 5;
	
	//把英文单词全部转小写
	public $toLower = false;
	
	//使用最大切分模式对二元词进行消岐
	public $differMax = false;
	
	//尝试合并单字
	public $unitWord = true;
	
	//初始化类时直接加载词典
	public static $loadInit = true;
	
	//使用热门词优先模式进行消岐
	public $differFreq = false;
	
	//被转换为unicode的源字符串
	private $sourceString = '';
	
	//附加词典
	public $addonDic = array();
	public $addonDicFile = 'dict/words_addons.dic';
	
	//主词典
	public $dicStr = '';
	public $mainDic = array();
	public $mainDicHand = false;
	public $mainDicInfos = array();
	public $mainDicFile = 'dict/base_dic_full.dic';
	//是否直接载入词典（选是载入速度较慢，但解析较快；选否载入较快，但解析较慢，需要时才会载入特定的词条）
	private $isLoadAll = false;
	
	//主词典词语最大长度 x / 2
	private $dicWordMax = 14;
	//粗分后的数组（通常是截取句子等用途）
	private $simpleResult = array();
	//最终结果(用空格分开的词汇列表)
	private $finallyResult = '';
	
	//是否已经载入词典
	public $isLoadDic = false;
	//系统识别或合并的新词
	public $newWords = array();
	public $foundWordStr = '';
	//词库载入时间
	public $loadTime = 0;

  
  /**
   * 构造函数
   * @param $source_charset
   * @param $target_charset
   * @param $load_alldic
   * @param $source
   *
   * @return void
   */
  	public function __construct($source_charset='utf-8', $target_charset='utf-8', $load_all=true, $source='')
  	{
	  	$this->addonDicFile = dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$this->addonDicFile;
	  	$this->mainDicFile  = dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.$this->mainDicFile;
	  	$this->SetSource( $source, $source_charset, $target_charset );
	  	$this->isLoadAll = $load_all;
	  	if(self::$loadInit) $this->LoadDict();
  	}
  	
  	/**
  	 * 根据字符串计算key索引
  	 * @param $key
  	 * @return short int
  	 */
  	private function _get_index( $key )
  	{
  		$l = strlen($key);
  		$h = 0x238f13af;
  		while ($l--)
  		{
  		$h += ($h << 5);
  			$h ^= ord($key[$l]);
  			$h &= 0x7fffffff;
  		}
  		return ($h % $this->mask_value);
  	}

  	/**
  	 * 从文件获得词
  	 * @param $key
  	 * @param $type (类型 word 或 key_groups)
  	 * @return short int
  	 */
  	public function GetWordInfos( $key, $type='word' )
  	{
  		if( !$this->mainDicHand )
  		{
  			$this->mainDicHand = fopen($this->mainDicFile, 'r');
  		}
  		$p = 0;
  		$keynum = $this->_get_index( $key );
  		if( isset($this->mainDicInfos[ $keynum ]) )
  		{
  			$data = $this->mainDicInfos[ $keynum ];
  		}
  		else
  		{
  			//rewind( $this->mainDicHand );
  			$move_pos = $keynum * 8;
  			fseek($this->mainDicHand, $move_pos, SEEK_SET);
  			$dat = fread($this->mainDicHand, 8);
  			$arr = unpack('I1s/n1l/n1c', $dat);
  			if( $arr['l'] == 0 )
  			{
  				return false;
  			}
  			fseek($this->mainDicHand, $arr['s'], SEEK_SET);
  			$data = @unserialize(fread($this->mainDicHand, $arr['l']));
  			$this->mainDicInfos[ $keynum ] = $data;
  		}
  		if( !is_array($data) || !isset($data[$key]) )
  		{
  			return false;
  		}
  		return ($type=='word' ? $data[$key] : $data);
  	}
  	
  	/**
  	 * 设置源字符串
  	 * @param $source
  	 * @param $source_charset
  	 * @param $target_charset
  	 *
  	 * @return bool
  	 */
  	public function SetSource( $source, $source_charset='utf-8', $target_charset='utf-8' )
  	{
  		$this->sourceCharSet = strtolower($source_charset);
  		$this->targetCharSet = strtolower($target_charset);
  		$this->simpleResult = array();
  		$this->finallyResult = array();
  		$this->finallyIndex = array();
  		if( $source != '' )
  		{
  			$rs = true;
  			if( preg_match("/^utf/", $source_charset) ) {
  				$this->sourceString = iconv('utf-8', UCS2, $source);
  			}
  			else if( preg_match("/^gb/", $source_charset) ) {
  				$this->sourceString = iconv('utf-8', UCS2, iconv('gb18030', 'utf-8', $source));
  			}
  			else if( preg_match("/^big/", $source_charset) ) {
  				$this->sourceString = iconv('utf-8', UCS2, iconv('big5', 'utf-8', $source));
  			}
  			else {
  				$rs = false;
  			}
  		}
  		else
  		{
  			$rs = false;
  		}
  		return $rs;
  	}
  	
  	/**
  	 * 设置结果类型(只在获取finallyResult才有效)
  	 * @param $rstype 1 为全部， 2去除特殊符号
  	 *
  	 * @return void
  	 */
  	public function SetResultType( $rstype )
  	{
  		$this->resultType = $rstype;
  	}
  	
  	/**
  	 * 载入词典
  	 *
  	 * @return void
  	 */
  	public function LoadDict( $maindic='' )
  	{
  		$startt = microtime(true);
  		//正常读取文件
  		$dicAddon = $this->addonDicFile;
  		if($maindic=='' || !file_exists($maindic) )
  		{
  			$dicWords = $this->mainDicFile ;
  		}
  		else
  		{
  			$dicWords = $maindic;
  			$this->mainDicFile = $maindic;
  		}
  	
  		//加载主词典（只打开）
  		$this->mainDicHand = fopen($dicWords, 'r');
  	
  		//载入副词典
  		$hw = '';
  		$ds = file($dicAddon);
  		foreach($ds as $d)
  		{
  			$d = trim($d);
  			if($d=='') continue;
  			$estr = substr($d, 1, 1);
  			if( $estr==':' ) {
  				$hw = substr($d, 0, 1);
  			}
  			else
  			{
  				$spstr = _SP_;
  				$spstr = iconv(UCS2, 'utf-8', $spstr);
  				$ws = explode(',', $d);
  				$wall = iconv('utf-8', UCS2, join($spstr, $ws));
  				$ws = explode(_SP_, $wall);
  				foreach($ws as $estr)
  				{
  					$this->addonDic[$hw][$estr] = strlen($estr);
  				}
  			}
  		}
  		$this->loadTime = microtime(true) - $startt;
  		$this->isLoadDic = true;
  	}
  	
  	/**
  	 * 检测某个词是否存在
  	 */
  	public function IsWord( $word )
  	{
  		$winfos = $this->GetWordInfos( $word );
  		return ($winfos !== false);
  	}
  	
  	/**
  	 * 获得某个词的词性及词频信息
  	 * @parem $word unicode编码的词
  	 * @return void
  	 */
  	public function GetWordProperty($word)
  	{
  		if( strlen($word)<4 )
  		{
  			return '/s';
  		}
  		$infos = $this->GetWordInfos($word);
  		return isset($infos[1]) ? "/{$infos[1]}{$infos[0]}" : "/s";
  	}
  	
  	/**
  	 * 指定某词的词性信息（通常是新词）
  	 * @parem $word unicode编码的词
  	 * @parem $infos array('c' => 词频, 'm' => 词性);
  	 * @return void;
  	 */
  	public function SetWordInfos($word, $infos)
  	{
  		if( strlen($word)<4 )
  		{
  			return ;
  		}
  		if( isset($this->mainDicInfos[$word]) )
  		{
  			$this->newWords[$word]++;
  			$this->mainDicInfos[$word]['c']++;
  		}
  		else
  		{
  			$this->newWords[$word] = 1;
  			$this->mainDicInfos[$word] = $infos;
  		}
  	}
  	
  	/**
  	 * 开始执行分析
  	 * @parem bool optimize 是否对结果进行优化
  	 * @return bool
  	 */
  	public function StartAnalysis($optimize=true)
  	{
  		if( !$this->isLoadDic )
  		{
  			$this->LoadDict();
  		}
  		$this->simpleResult = $this->finallyResult = array();
  		$this->sourceString .= chr(0).chr(32);
  		$slen = strlen($this->sourceString);
  		$sbcArr = array();
  		$j = 0;
  		//全角与半角字符对照表
  		for($i=0xFF00; $i < 0xFF5F; $i++)
  		{
  			$scb = 0x20 + $j;
  			$j++;
  			$sbcArr[$i] = $scb;
  		}
	  	//对字符串进行粗分
	  	$onstr = '';
	  	$lastc = 1; //1 中/韩/日文, 2 英文/数字/符号('.', '@', '#', '+'), 3 ANSI符号 4 纯数字 5 非ANSI符号或不支持字符
	  	$s = 0;
	  	$ansiWordMatch = "[0-9a-z@#%\+\.-]";
	  	$notNumberMatch = "[a-z@#%\+]";
  		for($i=0; $i < $slen; $i++) {
  			$c = $this->sourceString[$i].$this->sourceString[++$i];
  			$cn = hexdec(bin2hex($c));
  			$cn = isset($sbcArr[$cn]) ? $sbcArr[$cn] : $cn;
	  		//ANSI字符
	  		if($cn < 0x80) {
		  		if( preg_match('/'.$ansiWordMatch.'/i', chr($cn)) ) {
			  		if( $lastc != 2 && $onstr != '') {
				  		$this->simpleResult[$s]['w'] = $onstr;
				  		$this->simpleResult[$s]['t'] = $lastc;
				  		$this->_deep_analysis($onstr, $lastc, $s, $optimize);
				  		$s++;
			  			$onstr = '';
			  		}
		  			$lastc = 2;
		  			$onstr .= chr(0).chr($cn);
		  		} else {
		  			if( $onstr != '' ) {
		  				$this->simpleResult[$s]['w'] = $onstr;
		  				if( $lastc==2 ) {
		  					if( !preg_match('/'.$notNumberMatch.'/i', iconv(UCS2, 'utf-8', $onstr)) ) $lastc = 4;
		  				}
		  				$this->simpleResult[$s]['t'] = $lastc;
		  				if( $lastc != 4 ) $this->_deep_analysis($onstr, $lastc, $s, $optimize);
		  				$s++;
		  			}
		  			$onstr = '';
		  			$lastc = 3;
		  			if($cn < 31) {
		  				continue;
		  			} else {
		  				$this->simpleResult[$s]['w'] = chr(0).chr($cn);
		  				$this->simpleResult[$s]['t'] = 3;
		  				$s++;
		  			}
		  		}
	  		}
  			//普通字符
  			else
	  		{
	  			//正常文字
	  			if( ($cn>0x3FFF && $cn < 0x9FA6) || ($cn>0xF8FF && $cn < 0xFA2D)
	  			|| ($cn>0xABFF && $cn < 0xD7A4) || ($cn>0x3040 && $cn < 0x312B) )
	  			{
		  			if( $lastc != 1 && $onstr != '') {
		  				$this->simpleResult[$s]['w'] = $onstr;
			  			if( $lastc==2 ) {
			  				if( !preg_match('/'.$notNumberMatch.'/i', iconv(UCS2, 'utf-8', $onstr)) ) $lastc = 4;
			  			}
			  			$this->simpleResult[$s]['t'] = $lastc;
			  			if( $lastc != 4 ) $this->_deep_analysis($onstr, $lastc, $s, $optimize);
			  			$s++;
			  			$onstr = '';
		  			}
		  			$lastc = 1;
		  			$onstr .= $c;
	  			}
	  			//特殊符号
	 			else
	  			{
	  				if( $onstr != '' ) {
		  				$this->simpleResult[$s]['w'] = $onstr;
		  				if( $lastc==2 ) {
		  					if( !preg_match('/'.$notNumberMatch.'/i', iconv(UCS2, 'utf-8', $onstr)) ) $lastc = 4;
		  				}
		  				$this->simpleResult[$s]['t'] = $lastc;
		  				if( $lastc != 4 ) $this->_deep_analysis($onstr, $lastc, $s, $optimize);
	  					$s++;
	  				}
	  	
	  				//检测书名
	  				if( $cn == 0x300A ) {
		  				$tmpw = '';
		  				$n = 1;
		  				$isok = false;
		  				$ew = chr(0x30).chr(0x0B);
		  				while(true) {
	  						if( !isset($this->sourceString[$i+$n+1]) )  break;
	  						$w = $this->sourceString[$i+$n].$this->sourceString[$i+$n+1];
	  						if( $w == $ew ) {
		  						$this->simpleResult[$s]['w'] = $c;
		  						$this->simpleResult[$s]['t'] = 5;
		  						$s++;
	  	
	  							$this->simpleResult[$s]['w'] = $tmpw;
	  							$this->newWords[$tmpw] = 1;
	  							if( !isset($this->newWords[$tmpw]) ) {
	  								$this->foundWordStr .= $this->_out_string_encoding($tmpw).'/nb, ';
	  								$this->SetWordInfos($tmpw, array('c'=>1, 'm'=>'nb'));
	  							}
	  							$this->simpleResult[$s]['t'] = 13;
	  	
	  							$s++;
	  	
	  							//最大切分模式对书名继续分词
	  							if( $this->differMax ) {
		  							$this->simpleResult[$s]['w'] = $tmpw;
		  							$this->simpleResult[$s]['t'] = 21;
		  							$this->_deep_analysis($tmpw, $lastc, $s, $optimize);
		  							$s++;
	  							}
	  	
	  							$this->simpleResult[$s]['w'] = $ew;
	  							$this->simpleResult[$s]['t'] =  5;
	  							$s++;
	  	
	  							$i = $i + $n + 1;
	  							$isok = true;
	  							$onstr = '';
	  							$lastc = 5;
	  							break;
	  						} else {
	  							$n = $n+2;
	  							$tmpw .= $w;
	  							if( strlen($tmpw) > 60 ) {
	  								break;
	  							}
	  						}
	  					}//while
	  					if( !$isok ) {
		  					$this->simpleResult[$s]['w'] = $c;
		  					$this->simpleResult[$s]['t'] = 5;
		  					$s++;
		  					$onstr = '';
		  					$lastc = 5;
	  					}
	  						continue;
	  				}
	  	
	  				$onstr = '';
	  				$lastc = 5;
	  				if( $cn==0x3000 ) {
	  					continue;
	  				} else {
		  				$this->simpleResult[$s]['w'] = $c;
		  				$this->simpleResult[$s]['t'] = 5;
		  				$s++;
	  				}
	  			}//2byte symbol
	  	
	  		}//end 2byte char
  	
  		}//end for
  	
  		//处理分词后的结果
  		$this->_sort_finally_result();
  	}
  	
  	/**
	* 深入分词
  	* @parem $str 
  	* @parem $ctype (2 英文类， 3 中/韩/日文类)
  	* @parem $spos   当前粗分结果游标
  	* @return bool
  	*/
  	private function _deep_analysis( &$str, $ctype, $spos, $optimize=true )
  	{
  	
  		//中文句子
  		if( $ctype==1 ) {
  			$slen = strlen($str);
  			//小于系统配置分词要求长度的句子
  			if( $slen < $this->notSplitLen ) {
  				$tmpstr = '';
  				$lastType = 0;
  				if( $spos > 0 ) $lastType = $this->simpleResult[$spos-1]['t'];
  				if($slen < 5) {
  					//echo iconv(UCS2, 'utf-8', $str).'<br/>';
  					if( $lastType==4 && ( isset($this->addonDic['u'][$str]) || isset($this->addonDic['u'][substr($str, 0, 2)]) ) )
  					{
  						$str2 = '';
  						if( !isset($this->addonDic['u'][$str]) && isset($this->addonDic['s'][substr($str, 2, 2)]) )
  						{
  							$str2 = substr($str, 2, 2);
  							$str  = substr($str, 0, 2);
  						}
  						$ww = $this->simpleResult[$spos - 1]['w'].$str;
  						$this->simpleResult[$spos - 1]['w'] = $ww;
  						$this->simpleResult[$spos - 1]['t'] = 4;
  						if( !isset($this->newWords[$this->simpleResult[$spos - 1]['w']]) ) {
  							$this->foundWordStr .= $this->_out_string_encoding( $ww ).'/mu, ';
  							$this->SetWordInfos($ww, array('c'=>1, 'm'=>'mu'));
  						}
  						$this->simpleResult[$spos]['w'] = '';
  						if( $str2 != '' ) {
  							$this->finallyResult[$spos-1][] = $ww;
  							$this->finallyResult[$spos-1][] = $str2;
  						}
  					} else {
  						$this->finallyResult[$spos][] = $str;
  					}
  				} else {
  					$this->_deep_analysis_cn( $str, $ctype, $spos, $slen, $optimize );
  				}
  			}
  			//正常长度的句子，循环进行分词处理
  			else
  			{
  				$this->_deep_analysis_cn( $str, $ctype, $spos, $slen, $optimize );
  			}
  		}
  		//英文句子，转为小写
  		else
  		{
  			if( $this->toLower ) {
  				$this->finallyResult[$spos][] = strtolower($str);
  			} else {
  				$this->finallyResult[$spos][] = $str;
  			}
  		}
  	}
  	
  	/**
  	* 中文的深入分词
  	* @parem $str
  	* @return void
  	*/
  	private function _deep_analysis_cn( &$str, $lastec, $spos, $slen, $optimize=true )
  	{
  		$quote1 = chr(0x20).chr(0x1C);
  		$tmparr = array();
  		$hasw = 0;
  		//如果前一个词为 “ ， 并且字符串小于3个字符当成一个词处理。
  		if( $spos > 0 && $slen < 11 && $this->simpleResult[$spos-1]['w']==$quote1 ) {
  			$tmparr[] = $str;
  			if( !isset($this->newWords[$str]) ) {
  				$this->foundWordStr .= $this->_out_string_encoding($str).'/nq, ';
  				$this->SetWordInfos($str, array('c'=>1, 'm'=>'nq'));
  			}
  			if( !$this->differMax ) {
  				$this->finallyResult[$spos][] = $str;
  				return ;
  			}
  		}
  		//进行切分
  		for($i=$slen-1; $i > 0; $i -= 2) {
  			//单个词
  			$nc = $str[$i-1].$str[$i];
  			//是否已经到最后两个字
  			if( $i <= 2 ) {
  				$tmparr[] = $nc;
  				$i = 0;
  				break;
  			}
  			$isok = false;
  			$i = $i + 1;
  			for($k=$this->dicWordMax; $k>1; $k=$k-2) {
  				if($i < $k) continue;
  				$w = substr($str, $i-$k, $k);
  				if( strlen($w) <= 2 ) {
  					$i = $i - 1;
  					break;
  				}
  				if( $this->IsWord( $w ) ) {
  					$tmparr[] = $w;
  					$i = $i - $k + 1;
  					$isok = true;
  					break;
  				}
  			}
  			//echo '<hr />';
  			//没适合词
  			if(!$isok) $tmparr[] = $nc;
  		}
  		$wcount = count($tmparr);
  		if( $wcount==0 ) return ;
  		$this->finallyResult[$spos] = array_reverse($tmparr);
  		//优化结果(岐义处理、新词、数词、人名识别等)
  		if( $optimize ) {
  			$this->_optimize_result( $this->finallyResult[$spos], $spos );
  		}
  	}
  	
  	/**
  	* 对最终分词结果进行优化（把simpleresult结果合并，并尝试新词识别、数词合并等）
  	* @parem $optimize 是否优化合并的结果
  	* @return bool
  	*/
  	//t = 1 中/韩/日文, 2 英文/数字/符号('.', '@', '#', '+'), 3 ANSI符号 4 纯数字 5 非ANSI符号或不支持字符
  	private function _optimize_result( &$smarr, $spos )
  	{
  		$newarr = array();
  		$prePos = $spos - 1;
  		$arlen = count($smarr);
  		$i = $j = 0;
  		//检测数量词
  		if( $prePos > -1 && !isset($this->finallyResult[$prePos]) ) {
  			$lastw = $this->simpleResult[$prePos]['w'];
  			$lastt = $this->simpleResult[$prePos]['t'];
  			if( ($lastt==4 || isset( $this->addonDic['c'][$lastw] )) && isset( $this->addonDic['u'][$smarr[0]] ) )
  			{
  				$this->simpleResult[$prePos]['w'] = $lastw.$smarr[0];
  				$this->simpleResult[$prePos]['t'] = 4;
  				if( !isset($this->newWords[ $this->simpleResult[$prePos]['w'] ]) ) {
  					$this->foundWordStr .= $this->_out_string_encoding( $this->simpleResult[$prePos]['w'] ).'/mu, ';
  					$this->SetWordInfos($this->simpleResult[$prePos]['w'], array('c'=>1, 'm'=>'mu'));
  				}
  				$smarr[0] = '';
  				$i++;
  			}
  		}
  		for(; $i < $arlen; $i++) {
  	
  			if( !isset( $smarr[$i+1] ) ) {
  				$newarr[$j] = $smarr[$i];
 				break;
  			}
  			$cw = $smarr[$i];
  			$nw = $smarr[$i+1];
  			$ischeck = false;
  			//检测数量词
 			if( isset( $this->addonDic['c'][$cw] ) && isset( $this->addonDic['u'][$nw] ) ) {
  				//最大切分时保留合并前的词
  				if($this->differMax) {
  					$newarr[$j] = chr(0).chr(0x28);
  					$j++;
  					$newarr[$j] = $cw;
  					$j++;
  					$newarr[$j] = $nw;
  					$j++;
  					$newarr[$j] = chr(0).chr(0x29);
  					$j++;
  				}
  				$newarr[$j] = $cw.$nw;
  				if( !isset($this->newWords[$newarr[$j]]) ) {
  					$this->foundWordStr .= $this->_out_string_encoding( $newarr[$j] ).'/mu, ';
  					$this->SetWordInfos($newarr[$j], array('c'=>1, 'm'=>'mu'));
  				}
  				$j++; $i++; $ischeck = true;
  			}
  			//检测前导词(通常是姓)
  			else if( isset( $this->addonDic['n'][ $smarr[$i] ] ) ) {
  				$is_rs = false;
  				//词语是副词或介词或频率很高的词不作为人名
  				if( strlen($nw)==4 ) {
  					$winfos = $this->GetWordInfos($nw);
  					if(isset($winfos['m']) && ($winfos['m']=='r' || $winfos['m']=='c' || $winfos['c']>500) )
  					{
 						$is_rs = true;
  					}
  				}
  				if( !isset($this->addonDic['s'][$nw]) && strlen($nw)<5 && !$is_rs ) {
 					$newarr[$j] = $cw.$nw;
  					//echo iconv(UCS2, 'utf-8', $newarr[$j])."<br />";
  					//尝试检测第三个词
  					if( strlen($nw)==2 && isset($smarr[$i+2]) && strlen($smarr[$i+2])==2 && !isset( $this->addonDic['s'][$smarr[$i+2]] ) )
  					{
  						$newarr[$j] .= $smarr[$i+2];
  						$i++;
  					}
  					if( !isset($this->newWords[$newarr[$j]]) ) {
  						$this->SetWordInfos($newarr[$j], array('c'=>1, 'm'=>'nr'));
  						$this->foundWordStr .= $this->_out_string_encoding($newarr[$j]).'/nr, ';
  					}
  					//为了防止错误，保留合并前的姓名
  					if(strlen($nw)==4) {
  						$j++;
  						$newarr[$j] = chr(0).chr(0x28);
  						$j++;
  						$newarr[$j] = $cw;
  						$j++;
  						$newarr[$j] = $nw;
  						$j++;
  						$newarr[$j] = chr(0).chr(0x29);
  					}
  	
  					$j++; $i++; $ischeck = true;
  				}
  			}
  			//检测后缀词(地名等)
  			else if( isset($this->addonDic['a'][$nw]) ) {
  				$is_rs = false;
  				//词语是副词或介词不作为前缀
  				if( strlen($cw)>2 ) {
 					$winfos = $this->GetWordInfos($cw);
  					if(isset($winfos['m']) && ($winfos['m']=='a' || $winfos['m']=='r' || $winfos['m']=='c' || $winfos['c']>500) )
  					{
  						$is_rs = true;
  					}
  				}
  				if( !isset($this->addonDic['s'][$cw]) && !$is_rs ) {
  					$newarr[$j] = $cw.$nw;
  					if( !isset($this->newWords[$newarr[$j]]) ) {
  						$this->foundWordStr .= $this->_out_string_encoding($newarr[$j]).'/na, ';
  						$this->SetWordInfos($newarr[$j], array('c'=>1, 'm'=>'na'));
  					}
  					$i++; $j++; $ischeck = true;
  				}
  			}
  			//新词识别（暂无规则）
  			else if($this->unitWord) {
  				if(strlen($cw)==2 && strlen($nw)==2
  				&& !isset($this->addonDic['s'][$cw]) && !isset($this->addonDic['t'][$cw]) && !isset($this->addonDic['a'][$cw])
  				&& !isset($this->addonDic['s'][$nw]) && !isset($this->addonDic['c'][$nw]))
  				{
  					$newarr[$j] = $cw.$nw;
  					//尝试检测第三个词
  					if( isset($smarr[$i+2]) && strlen($smarr[$i+2])==2 && (isset( $this->addonDic['a'][$smarr[$i+2]] ) || isset( $this->addonDic['u'][$smarr[$i+2]] )) )
  					{
  						$newarr[$j] .= $smarr[$i+2];
  						$i++;
  					}
  					if( !isset($this->newWords[$newarr[$j]]) ) {
  						$this->foundWordStr .= $this->_out_string_encoding($newarr[$j]).'/ms, ';
  						$this->SetWordInfos($newarr[$j], array('c'=>1, 'm'=>'ms'));
  					}
  					$i++; $j++; $ischeck = true;
  				}
  			}
  	
  			//不符合规则
  			if( !$ischeck ) {
  				$newarr[$j] = $cw;
  				//二元消岐处理——最大切分模式
  				if( $this->differMax && !isset($this->addonDic['s'][$cw]) && strlen($cw) < 5 && strlen($nw) < 7)
  				{
  					$slen = strlen($nw);
 					$hasDiff = false;
  					for($y=2; $y <= $slen-2; $y=$y+2) {
  						$nhead = substr($nw, $y-2, 2);
  						$nfont = $cw.substr($nw, 0, $y-2);
  						if( $this->IsWord( $nfont.$nhead ) ) {
  							if( strlen($cw) > 2 ) $j++;
  							$hasDiff = true;
  							$newarr[$j] = $nfont.$nhead;
  						}
  					}
  				}
  				$j++;
  			}
  	
  		}//end for
  		$smarr =  $newarr;
  	}
  	
  	/**
  	* 转换最终分词结果到 finallyResult 数组
  	* @return void
  	*/
  	private function _sort_finally_result()
  	{
  		$newarr = array();
  		$i = 0;
  		foreach($this->simpleResult as $k=>$v) {
  			if( empty($v['w']) ) continue;
  			if( isset($this->finallyResult[$k]) && count($this->finallyResult[$k]) > 0 )
  			{
  				foreach($this->finallyResult[$k] as $w) {
  					if(!empty($w)) {
  						$newarr[$i]['w'] = $w;
  						$newarr[$i]['t'] = 20;
  						$i++;
  					}
  				}
  			} else if($v['t'] != 21) {
  				$newarr[$i]['w'] = $v['w'];
  				$newarr[$i]['t'] = $v['t'];
  				$i++;
  			}
  		}
  		$this->finallyResult = $newarr;
  		$newarr = '';
  	}
  	
  	/**
  	* 把uncode字符串转换为输出字符串
  	* @parem str
  	* return string
  	*/
  	private function _out_string_encoding( &$str )
  	{
  		$rsc = $this->_source_result_charset();
  		if( $rsc==1 ) {
  			$rsstr = iconv(UCS2, 'utf-8', $str);
  		} else if( $rsc==2 ) {
  			$rsstr = iconv('utf-8', 'gb18030', iconv(UCS2, 'utf-8', $str) );
  		} else {
  			$rsstr = iconv('utf-8', 'big5', iconv(UCS2, 'utf-8', $str) );
  		}
  		return $rsstr;
  	}
  	
  	/**
  	* 获取最终结果字符串（用空格分开后的分词结果）
  	* @return string
  	*/
  	public function GetFinallyResult($spword=' ', $word_meanings=false)
  	{
  		$rsstr = '';
  		foreach($this->finallyResult as $v) {
  			if( $this->resultType==2 && ($v['t']==3 || $v['t']==5) ) {
  				continue;
  			}
  			$m = '';
  			if( $word_meanings ) {
  				$m = $this->GetWordProperty($v['w']);
  			}
  			$w = $this->_out_string_encoding($v['w']);
  			if( $w != ' ' ) {
  				if($word_meanings) {
  					$rsstr .= $spword.$w.$m;
  				} else {
  					$rsstr .= $spword.$w;
  				}
  			}
  		}
  		return $rsstr;
  	}
  															 
  	/**
  	* 获取粗分结果，不包含粗分属性
  	* @return array()
  	*/
  	public function GetSimpleResult()
  	{
  		$rearr = array();
  		foreach($this->simpleResult as $k=>$v) {
  			if( empty($v['w']) ) continue;
  			$w = $this->_out_string_encoding($v['w']);
  			if( $w != ' ' ) $rearr[] = $w;
  		}
  		return $rearr;
  	}
  																	 
  	/**
  	* 获取粗分结果，包含粗分属性（1中文词句、2 ANSI词汇（包括全角），3 ANSI标点符号（包括全角），4数字（包括全角），5 中文标点或无法识别字符）
  	* @return array()
  	*/
  	public function GetSimpleResultAll()
  	{
  		$rearr = array();
  		foreach($this->simpleResult as $k=>$v) {
  			$w = $this->_out_string_encoding($v['w']);
  			if( $w != ' ' ) {
  				$rearr[$k]['w'] = $w;
  				$rearr[$k]['t'] = $v['t'];
  			}
  		}
  		return $rearr;
  	}
   
  	/**
  	* 获取索引hash数组
  	* @return array('word'=>count,...)
  	*/
  	public function GetFinallyIndex()
  	{
  		$rearr = array();
  		foreach($this->finallyResult as $v) {
  			if( $this->resultType==2 && ($v['t']==3 || $v['t']==5) ) {
  				continue;
  			}
  			$w = $this->_out_string_encoding($v['w']);
  			if( $w == ' ' ) {
  				continue;
  			}
  			if( isset($rearr[$w]) ) {
  				$rearr[$w]++;
  			} else {
  				$rearr[$w] = 1;
  			}
  		}
  		arsort( $rearr );
  		return $rearr;
  	}
  																		 
  	/**
  	* 获取最终关键字(返回用 "," 间隔的关键字)
  	* @return string
  	*/
  	public function GetFinallyKeywords( $num = 100 )
  	{
  		$n = 0;
  		$arr = $this->GetFinallyIndex();
  		$okstr = '';
  		foreach( $arr as $k => $v ) {
  			//排除长度为1的词
  			if( strlen($k)==1 ) {
  				continue;
  			}
  			//排除长度为2的非英文词
  			elseif( strlen($k)==2 && preg_match('/[^0-9a-zA-Z]/', $k) ) {
  				continue;
  	
  			}
  			//排除单个中文字
  			elseif( strlen($k) < 4 && !preg_match('/[a-zA-Z]/', $k)) {
  				continue;
  			}
  			$okstr .= ($okstr=='' ? $k : ' '.$k);
  			$n++;
  			if( $n > $num ) break;
  		}
  		return $okstr;
  	}
  																		 
  	/**
  	* 获得保存目标编码
  	* @return int
  	*/
  	private function _source_result_charset()
  	{
  		if( preg_match("/^utf/", $this->targetCharSet) ) {
  			$rs = 1;
  		} else if( preg_match("/^gb/", $this->targetCharSet) ) {
  			$rs = 2;
  		} else if( preg_match("/^big/", $this->targetCharSet) ) {
  			$rs = 3;
  		} else {
  			$rs = 4;
  		}
  		return $rs;
  	}
  	 
  	/**
  	* 编译词典
  	* @parem $sourcefile utf-8编码的文本词典数据文件<参见范例dict/not-build/base_dic_full.txt>
  	* 注意, 需要PHP开放足够的内存才能完成操作
  	* @return void
  	*/
  	public function MakeDict( $source_file, $target_file='' )
  	{
  		$target_file = ($target_file=='' ? $this->mainDicFile : $target_file);
  		$allk = array();
  		$fp = fopen($source_file, 'r');
  		while( $line = fgets($fp, 512) ) {
  			if( $line[0]=='@' ) continue;
  			list($w, $r, $a) = explode(',', $line);
  			$a = trim( $a );
  			$w = iconv('utf-8', UCS2, $w);
  			$k = $this->_get_index( $w );
  			if( isset($allk[ $k ]) )
  				$allk[ $k ][ $w ] = array($r, $a);
  			else
  				$allk[ $k ][ $w ] = array($r, $a);
  		}
  		fclose( $fp );
  		$fp = fopen($target_file, 'w');
  		$heade_rarr = array();
  		$alldat = '';
  		$start_pos = $this->mask_value * 8;
  		foreach( $allk as $k => $v ) {
  			$dat  = serialize( $v );
  			$dlen = strlen($dat);
  			$alldat .= $dat;
  	
  			$heade_rarr[ $k ][0] = $start_pos;
  			$heade_rarr[ $k ][1] = $dlen;
  			$heade_rarr[ $k ][2] = count( $v );
  	
  			$start_pos += $dlen;
  		}
  		unset( $allk );
  		for($i=0; $i < $this->mask_value; $i++) {
  			if( !isset($heade_rarr[$i]) ) {
  				$heade_rarr[$i] = array(0, 0, 0);
  			}
  			fwrite($fp, pack("Inn", $heade_rarr[$i][0], $heade_rarr[$i][1], $heade_rarr[$i][2]));
  		}
  		fwrite( $fp, $alldat);
  		fclose( $fp );
  	}
  													 
  	/**
  	* 导出词典的词条
  	* @parem $targetfile 保存位置
  	* @return void
  	*/
  	public function ExportDict( $targetfile )
  	{
  		if( !$this->mainDicHand ) {
  			$this->mainDicHand = fopen($this->mainDicFile, 'r');
  		}
  		$fp = fopen($targetfile, 'w');
  		for($i=0; $i <= $this->mask_value; $i++) {
  			$move_pos = $i * 8;
  			fseek($this->mainDicHand, $move_pos, SEEK_SET);
  			$dat = fread($this->mainDicHand, 8);
  			$arr = unpack('I1s/n1l/n1c', $dat);
  			if( $arr['l'] == 0 ) {
  				continue;
  			}
  			fseek($this->mainDicHand, $arr['s'], SEEK_SET);
  			$data = @unserialize(fread($this->mainDicHand, $arr['l']));
  			if( !is_array($data) ) continue;
  			foreach($data as $k => $v) {
  				$w = iconv(UCS2, 'utf-8', $k);
  				fwrite($fp, "{$w},{$v[0]},{$v[1]}\n");
  			}
  		}
  		fclose( $fp );
  		return true;
  	}
//   	end of PHPanalysis
  	

// 	segment
// 	function __construct($loaddic=true) {
//   	if($loaddic) {
//   	  for($i=0;$i<strlen($this->cn_one_name);$i++){
//   		  $this->one_name_dic[$this->cn_one_name[$i].$this->cn_one_name[$i+1]] = 1;
//   		  $i++;
//   	  }
//   	  $twoname = explode(" ",$this->cn_two_name);
//   	  foreach($twoname as $n){ $this->two_name_dic[$n] = 1; }
//   	  unset($twoname);
//   	  unset($this->cn_two_name);
//   	  unset($this->cn_one_name);
//   	  $dicfile = BC_PATH.'libs'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'dict'.DIRECTORY_SEPARATOR.'dict.csv';
//   	  $fp = fopen($dicfile,'r');
//   	  while($line = fgets($fp,64)){
//   		  $ws = explode(' ',$line);
//   		  $this->rank_dic[strlen($ws[0])][$ws[0]] = $ws[1];
//   	  }
//   	  fclose($fp);
//     }
//   }

//   segment
  private function clear() {
  	unset($this->rank_dic);
  }
  private function get_source($str) {
  	if(CHARSET == 'utf-8') $str = iconv('utf-8','gbk',$str);
  	$this->source_string = $str;
  	$this->result_string = '';
  }
  private function simple_split($str) {
  	$this->source_string = $this->revise_string($str);
  	return $this->source_string;
  }
  /**
   * 重写bangcms的segment.class.php类的split_result()方法
   * 2015-03-26 10:29:33 kevin
   * 
   * @param string $str
   * @param string $try_num_name
   * @param string $try_diff
   * @return string
   */
  function split_result($str='',$try_num_name=true,$try_diff=true) {
  	//调用PHPanalysis类的GetFinallyResult方法
  	$this->SetSource($str);
  	$this->differMax = true;
  	$this->unitWord = true;
  	$this->StartAnalysis(true);
  	$okstr = $this->GetFinallyResult(' ', false);
  	return $okstr;
  }
  private function split_result_original($str='',$try_num_name=true,$try_diff=true) {
  	$str = trim($str);
  	if($str!='') $this->get_source($str);
  	else return '';
  	$this->source_string = preg_replace('/ {1,}/',' ',$this->revise_string($this->source_string));
  	$spwords = explode(' ',$this->source_string);
  	$spLen = count($spwords) - 1;
  	$spc = $this->split_char;
  	for($i=$spLen;$i>=0;$i--){
  		if(ord($spwords[$i][0])<33) continue;
  		else if(!isset($spwords[$i][$this->min_len])) $this->result_string = $spwords[$i].$spc.$this->result_string;
  		else if(ord($spwords[$i][0])<0x81){
  			$this->result_string = $spwords[$i].$spc.$this->result_string;
  		} else {
  		  $this->result_string = $this->split_mm($spwords[$i],$try_num_name,$try_diff).$spc.$this->result_string;
  	  }
  	}
  	if(CHARSET=='utf-8') $okstr = iconv('gbk','utf-8',$this->result_string);
  	else $okstr = $this->result_string;
  	return $okstr;
  }
  private function par_number($str) {
  	if($str == '') return '';
  	$ws = explode(' ',$str);
  	$wlen = count($ws);
  	$spc = $this->split_char;
  	$reStr = '';
  	for($i=0;$i<$wlen;$i++){
  		if($ws[$i]=='') continue;
  		if($i>=$wlen-1) $reStr .= $spc.$ws[$i];
  		else{ $reStr .= $spc.$ws[$i]; }
    }
    return $reStr;
  }
  private function par_other($word_array) {
  	$wlen = count($word_array)-1;
  	$rsStr = '';
  	$spc = $this->split_char;
  	for($i=$wlen;$i>=0;$i--) {
  		if(preg_match('/'.$this->cn_sg_num.'/',$word_array[$i])) {
  			$rsStr .= $spc.$word_array[$i];
  			if($i>0 && preg_match('/^'.$this->common_unit.'/',$word_array[$i-1]) ) {
				$rsStr .= $word_array[$i-1]; $i--;
			} else {
  				while($i>0 && preg_match("/".$this->cn_sg_num."/",$word_array[$i-1]) ){ $rsStr .= $word_array[$i-1]; $i--; }
  			}
  			continue;
  		}
  		if(strlen($word_array[$i])==4 && isset($this->two_name_dic[$word_array[$i]])) {
  			$rsStr .= $spc.$word_array[$i];
  			if($i>0&&strlen($word_array[$i-1])==2){
  				$rsStr .= $word_array[$i-1];$i--;
  				if($i>0&&strlen($word_array[$i-1])==2){ $rsStr .= $word_array[$i-1];$i--; }
  			}
  		} else if(strlen($word_array[$i])==2 && isset($this->one_name_dic[$word_array[$i]])) {
  			$rsStr .= $spc.$word_array[$i];
  			if($i>0&&strlen($word_array[$i-1])==2){
  				 if(preg_match("/".$this->especial_char."/",$word_array[$i-1])) continue;
  				 $rsStr .= $word_array[$i-1];$i--;
  				 if($i>0 && strlen($word_array[$i-1])==2 &&
  				  !preg_match("/".$this->especial_char."/",$word_array[$i-1]))
  				 { $rsStr .= $word_array[$i-1];$i--; }
  			}
  		} else {
  			$rsStr .= $spc.$word_array[$i];
  		}
  	}
  	$rsStr = preg_replace("/^".$spc."/","",$rsStr);
  	return $rsStr;
  }
  private function split_mm($str,$try_num_name=true,$try_diff=true) {
  	$spc = $this->split_char;
  	$spLen = strlen($str);
  	$rsStr = $okWord = $tmpWord = '';
  	$word_array = array();
  	for($i=($spLen-1);$i>=0;) {
  		if($i<=$this->min_len){
  			if($i==1){
  			  $word_array[] = substr($str,0,2);
  		  } else {
  			   $w = substr($str,0,$this->min_len+1);
  			   if($this->is_word($w)){
  			   	$word_array[] = $w;
  			   }else{
  				   $word_array[] = substr($str,2,2);
  				   $word_array[] = substr($str,0,2);
  			   }
  		  }
  			$i = -1; break;
  		}
  		if($i>=$this->max_len) $max_pos = $this->max_len;
  		else $max_pos = $i;
  		$isMatch = false;
  		for($j=$max_pos;$j>=0;$j=$j-2){
  			 $w = substr($str,$i-$j,$j+1);
  			 if($this->is_word($w)){
  			 	$word_array[] = $w;
  			 	$i = $i-$j-1;
  			 	$isMatch = true;
  			 	break;
  			 }
  		}
  		if(!$isMatch){
  			if($i>1) {
  				$word_array[] = $str[$i-1].$str[$i];
  				$i = $i-2;
  			}
  		}
  	}//End For

  	if($try_num_name) {
		$rsStr = $this->par_other($word_array);
	} else {
  		$wlen = count($word_array)-1;
  		for($i=$wlen;$i>=0;$i--){
  	  	$rsStr .= $spc.$word_array[$i];
  	  }
  	}
  	if($try_diff) $rsStr = $this->test_diff(trim($rsStr));
  	return $rsStr;
  }
  private function auto_description($str,$keyword,$strlen) {
  	$this->source_string = $this->revise_string($this->source_string);
  	$spwords = explode(" ",$this->source_string);
  	$keywords = explode(" ",$this->keywords);
  	$regstr = "";
  	foreach($keywords as $k=>$v) {
  		if($v=="") continue;
  		if(ord($v[0])>0x80 && strlen($v)<3) continue;
  		if($regstr=="") $regstr .= "($v)";
  		else $regstr .= "|($v)";
  	}
  }
  private function test_diff($str) {
  	$str = preg_replace("/ {1,}/"," ",$str);
  	if($str == ""||$str == " ") return "";
  	$ws = explode(' ',$str);
  	$wlen = count($ws);
  	$spc = $this->split_char;
  	$reStr = "";
  	for($i=0;$i<$wlen;$i++) {
  		if($i>=($wlen-1)) {
  			$reStr .= $spc.$ws[$i];
  		} else {
  			if($ws[$i]==$ws[$i+1]){
  				$reStr .= $spc.$ws[$i].$ws[$i+1];
  				$i++; continue;
  			}
  			if(strlen($ws[$i])==2 && strlen($ws[$i+1])<8 && strlen($ws[$i+1])>2) {
  				$addw = $ws[$i].$ws[$i+1];
  				$t = 6;
  				$testok = false;
  				while($t>=4) {
  				  $w = substr($addw,0,$t);
  				  if($this->is_word($w) && ($this->get_rank($w) > $this->get_rank($ws[$i+1])*2) ) {
  					   $limit_word = substr($ws[$i+1],strlen($ws[$i+1])-$t-2,strlen($ws[$i+1])-strlen($w)+2);
  					   if($limit_word!="") $reStr .= $spc.$w.$spc.$limit_word;
  					   else $reStr .= $spc.$w;
  					   $testok = true;
  					   break;
  				  }
  				  $t = $t-2;
  			  }
  			  if(!$testok) $reStr .= $spc.$ws[$i];
  			  else $i++;
  			} else if(strlen($ws[$i])>2 && strlen($ws[$i])<8 && strlen($ws[$i+1])>2 && strlen($ws[$i+1])<8) {
  				$t21 = substr($ws[$i+1],0,2);
  				$t22 = substr($ws[$i+1],0,4);
  				if($this->is_word($ws[$i].$t21)) {
  					if(strlen($ws[$i])==6||strlen($ws[$i+1])==6){
  						$reStr .= $spc.$ws[$i].$t21.$spc.substr($ws[$i+1],2,strlen($ws[$i+1])-2);
  						$i++;
  					} else {
  						$reStr .= $spc.$ws[$i];
  					}
  				} else if(strlen($ws[$i+1])==6) {
  					if($this->is_word($ws[$i].$t22)) {
  						$reStr .= $spc.$ws[$i].$t22.$spc.$ws[$i+1][4].$ws[$i+1][5];
  						$i++;
  					} else { $reStr .= $spc.$ws[$i]; }
  				} else if(strlen($ws[$i+1])==4) {
  					$addw = $ws[$i].$ws[$i+1];
  					$t = strlen($ws[$i+1])-2;
  					$testok = false;
  					while($t>0) {
  						$w = substr($addw,0,strlen($ws[$i])+$t);
  						if($this->is_word($w) && ($this->get_rank($w) > $this->get_rank($ws[$i+1])*2) ) {
  				       $limit_word = substr($ws[$i+1],$t,strlen($ws[$i+1])-$t);
  					     if($limit_word!="") $reStr .= $spc.$w.$spc.$limit_word;
  					     else $reStr .= $spc.$w;
  					     $testok = true;
  					     break;
  				    }
  				    $t = $t-2;
  					}
  					if(!$testok) $reStr .= $spc.$ws[$i];
  			    else $i++;
  				}else {
  					$reStr .= $spc.$ws[$i];
  				}
  			} else {
  				$reStr .= $spc.$ws[$i];
  			}
  		}
    }//End For
  	return $reStr;
  }
  private function is_word($okWord){
  	$slen = strlen($okWord);
  	if($slen > $this->max_len) return false;
  	else return isset($this->rank_dic[$slen][$okWord]);
  }
  private function revise_string($str) {
  	$spc = $this->split_char;
    $slen = strlen($str);
    if($slen==0) return '';
    $okstr = '';
    $prechar = 0; // 0-空白 1-英文 2-中文 3-符号
    for($i=0;$i<$slen;$i++){
      if(ord($str[$i]) < 0x81) {
        if(ord($str[$i]) < 33){
          //$str[$i]!="\r"&&$str[$i]!="\n"
          if($prechar!=0) $okstr .= $spc;
          $prechar=0;
          continue;
        } else if(preg_match("/[^0-9a-zA-Z@\.%#:\\/\\&_-]/",$str[$i])) {
          if($prechar==0) {
          	$okstr .= $str[$i]; $prechar=3;
          } else {
          	$okstr .= $spc.$str[$i]; $prechar=3;
          }
        } else {
        	if($prechar==2||$prechar==3) {
        		$okstr .= $spc.$str[$i]; $prechar=1;
        	} else {
        	  if(preg_match("/@#%:/",$str[$i])){ $okstr .= $str[$i]; $prechar=3; }
        	  else { $okstr .= $str[$i]; $prechar=1; }
        	}
        }
      } else{
        if($prechar!=0 && $prechar!=2) $okstr .= $spc;
        if(isset($str[$i+1])){
          $c = $str[$i].$str[$i+1];
          if(preg_match("/".$this->cn_number."/",$c)) {
          	$okstr .= $this->get_alab_num($c); $prechar = 2; $i++; continue;
          }
          $n = hexdec(bin2hex($c));
          if($n>0xA13F && $n < 0xAA40) {
            if($c=="《"){
            	if($prechar!=0) $okstr .= $spc." 《";
            	else $okstr .= " 《";
            	$prechar = 2;
            } else if($c=="》"){
            	$okstr .= "》 ";
            	$prechar = 3;
            } else{
            	if($prechar!=0) $okstr .= $spc.$c;
            	else $okstr .= $c;
            	$prechar = 3;
            }
          } else {
            $okstr .= $c;
            $prechar = 2;
          }
          $i++;
        }
      }//中文字符
    }//结束循环
    return $okstr;
  }
  private function find_new_word($str,$maxlen=6) {
    $okstr = "";
    return $str;
  }
  /**
   * 重写segment.class.php类的方法
   * 2015-03-26 10:38:01 kevin
   * 
   * @param string $str
   * @param integer $ilen
   */
  function get_keyword($str,$ilen=-1) {
  	//调用PHPanalysis类的GetFinallyKeyword方法，使用默认获取100条
  	$okstr = $this->GetFinallyKeywords();
  	return trim($okstr);
  }
  private function get_keyword_original($str,$ilen=-1) {
    if($str=='') return '';
    else $this->split_result($str,true,true);
    $okstr = $this->result_string;
    $ws = explode(' ',$okstr);
    $okstr = $wks = '';
    foreach($ws as $w) {
      $w = trim($w);
      if(strlen($w)<2) continue;
      if(!preg_match("/[^0-9:-]/",$w)) continue;
      if(strlen($w)==2&&ord($w[0])>0x80) continue;
      if(isset($wks[$w])) $wks[$w]++;
      else $wks[$w] = 1;
    }
    if(is_array($wks)) {
      arsort($wks);
      if($ilen==-1) {
		foreach($wks as $w=>$v) {
      		if($this->get_rank($w)>500) $okstr .= $w." ";
        }
      }  else {
        foreach($wks as $w=>$v){
          if((strlen($okstr)+strlen($w)+1)<$ilen) $okstr .= $w." ";
          else break;
        }
      }
    }
    if(CHARSET=='utf-8') $okstr = iconv('gbk','utf-8',$okstr);
    return trim($okstr);
  }
  private function get_rank($w){
  	if(isset($this->rank_dic[strlen($w)][$w])) return $this->rank_dic[strlen($w)][$w];
  	else return 0;
  }
  private function get_alab_num($fnum){
	  $nums = array("０","１","２","３","４","５","６",
	  "７","８","９","＋","－","％","．",
	  "ａ","ｂ","ｃ","ｄ","ｅ","ｆ","ｇ","ｈ","ｉ","ｊ","ｋ","ｌ","ｍ",
	  "ｎ","ｏ","ｐ","ｑ","ｒ","ｓ ","ｔ","ｕ","ｖ","ｗ","ｘ","ｙ","ｚ",
	  "Ａ","Ｂ","Ｃ","Ｄ","Ｅ","Ｆ","Ｇ","Ｈ","Ｉ","Ｊ","Ｋ","Ｌ","Ｍ",
	  "Ｎ","Ｏ","Ｐ","Ｑ","Ｒ","Ｓ","Ｔ","Ｕ","Ｖ","Ｗ","Ｘ","Ｙ","Ｚ");
	  $fnums = "0123456789+-%.abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	  $fnum = str_replace($nums,$fnums,$fnum);
	  return $fnum;
  }

  	/**
   	* 析构函数
   	*/
  	function __destruct()
  	{
	  	if( $this->mainDicHand !== false )
	  	{
	  		@fclose( $this->mainDicHand );
	  	}
  	}
}
?>