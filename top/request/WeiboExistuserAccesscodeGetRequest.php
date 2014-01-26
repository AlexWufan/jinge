<?php
/**
 * TOP API: taobao.weibo.existuser.accesscode.get request
 * 
 * @author auto create
 * @since 1.0, 2013-11-21 16:57:39
 */
class WeiboExistuserAccesscodeGetRequest
{
	/** 
	 * 微博ID
	 **/
	private $weiboid;
	
	private $apiParas = array();
	
	public function setWeiboid($weiboid)
	{
		$this->weiboid = $weiboid;
		$this->apiParas["weiboid"] = $weiboid;
	}

	public function getWeiboid()
	{
		return $this->weiboid;
	}

	public function getApiMethodName()
	{
		return "taobao.weibo.existuser.accesscode.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->weiboid,"weiboid");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
