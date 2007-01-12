<?php 
class MyObject{
	private $id		=	0;
	private $name	=	'';
	private $desc	=	'';
	private $weight	=	0;
	private $level	=	0;
	private $cost	=	0;
	private $type	=	0;
	private $unit	=	'';
	
	//构造函数
	function MyObject(){
              
   	}
   	/**
   	 * 获得物品的ID
   	 *
   	 * @return integer
   	 */
   	function getID(){
   		  return $this->id; 		
   	}
   	/**
   	 * 获得物品名称
   	 *
   	 * @return string
   	 */
   	function getName(){
   		  return $this->name; 		
   	}
   	/**
   	 * 获得物品的描述
   	 *
   	 * @return string
   	 */
   	function getDesc(){
   		return $this->desc;
   	}
	/**
	 * 获得物品的等级
	 *
	 * @return integer
	 */
	function getLevel(){
		return $this->level;
	}
	/**
	 * 获得物品的成本
	 *
	 * @return integer
	 */
	function getCost(){
		return $this->cost;
	}
	/**
	 * 获得物品的类型
	 *
	 * @return integer
	 */
	function getType(){
		return $this->type;
	}
	/**
	 * 获得物品的重量
	 *
	 * @return integer
	 */
	function getWeight(){
		return $this->weight;
	}
	/**
	 * 获得物品的单位
	 *
	 * @return unknown
	 */
	function getUnit(){
		return $this->unit;
	}
	/**
	 * 设定物品的ID
	 *
	 * @param integer $t_id
	 */
	function setID($t_id){
		$this->id = $t_id;
	}
	/**
	 * 设定物品的名称
	 *
	 * @param string $t_name
	 */
	function setName($t_name){
   		$this->name = $t_name;  		
   	}
	/**
	 * 设定物品的描述
	 *
	 * @param string $t_desc
	 */	
   	function setDesc($t_desc){
   		$this->desc = $t_desc;
   	}
	/**
	 * 设定物品的重量
	 *
	 * @param integer $t_weight
	 */	   	
   	function setWeight($t_weight){
   		$this->weight = $t_weight;
   	}
   	/**
   	 * 设定物品的等级
   	 *
   	 * @param integer $t_level
   	 */
   	function setLevel($t_level){
   		$this->level = $t_level;
   	}
   	/**
   	 * 设定物品的成本价
   	 *
   	 * @param integer $t_cost
   	 */
   	function setCost($t_cost){
   		$this->cost = $t_cost;
   	}
   	/**
   	 * 设定物品的类型
   	 *
   	 * @param integer $t_type
   	 */
   	function setType($t_type){
   		$this->type = $t_type;
   	}
   	/**
   	 * 设定物品的单位
   	 *
   	 * @param integer $t_unit
   	 */
   	function setUnit($t_unit){
   		$this->unit = $t_unit;
   	}
}
class Materials extends MyObject {
	
}

class Medicaments extends MyObject {
	/**
	 * 药品效果
	 * 影响字段--影响效果
	 * @var array
	 */
	private $effect = array();
	/**
	 * 创造者
	 * 
	 * @var string
	 */
	private $author = '';
	/**
	 * 创造者ID
	 *
	 * @var integer
	 */
	private $authorid = 0;
	
	function useMedicament(){
		
	}
}
?>