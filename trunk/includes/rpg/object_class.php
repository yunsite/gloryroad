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
	
	//���캯��
	function MyObject(){
              
   	}
   	/**
   	 * �����Ʒ��ID
   	 *
   	 * @return integer
   	 */
   	function getID(){
   		  return $this->id; 		
   	}
   	/**
   	 * �����Ʒ����
   	 *
   	 * @return string
   	 */
   	function getName(){
   		  return $this->name; 		
   	}
   	/**
   	 * �����Ʒ������
   	 *
   	 * @return string
   	 */
   	function getDesc(){
   		return $this->desc;
   	}
	/**
	 * �����Ʒ�ĵȼ�
	 *
	 * @return integer
	 */
	function getLevel(){
		return $this->level;
	}
	/**
	 * �����Ʒ�ĳɱ�
	 *
	 * @return integer
	 */
	function getCost(){
		return $this->cost;
	}
	/**
	 * �����Ʒ������
	 *
	 * @return integer
	 */
	function getType(){
		return $this->type;
	}
	/**
	 * �����Ʒ������
	 *
	 * @return integer
	 */
	function getWeight(){
		return $this->weight;
	}
	/**
	 * �����Ʒ�ĵ�λ
	 *
	 * @return unknown
	 */
	function getUnit(){
		return $this->unit;
	}
	/**
	 * �趨��Ʒ��ID
	 *
	 * @param integer $t_id
	 */
	function setID($t_id){
		$this->id = $t_id;
	}
	/**
	 * �趨��Ʒ������
	 *
	 * @param string $t_name
	 */
	function setName($t_name){
   		$this->name = $t_name;  		
   	}
	/**
	 * �趨��Ʒ������
	 *
	 * @param string $t_desc
	 */	
   	function setDesc($t_desc){
   		$this->desc = $t_desc;
   	}
	/**
	 * �趨��Ʒ������
	 *
	 * @param integer $t_weight
	 */	   	
   	function setWeight($t_weight){
   		$this->weight = $t_weight;
   	}
   	/**
   	 * �趨��Ʒ�ĵȼ�
   	 *
   	 * @param integer $t_level
   	 */
   	function setLevel($t_level){
   		$this->level = $t_level;
   	}
   	/**
   	 * �趨��Ʒ�ĳɱ���
   	 *
   	 * @param integer $t_cost
   	 */
   	function setCost($t_cost){
   		$this->cost = $t_cost;
   	}
   	/**
   	 * �趨��Ʒ������
   	 *
   	 * @param integer $t_type
   	 */
   	function setType($t_type){
   		$this->type = $t_type;
   	}
   	/**
   	 * �趨��Ʒ�ĵ�λ
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
	 * ҩƷЧ��
	 * Ӱ���ֶ�--Ӱ��Ч��
	 * @var array
	 */
	private $effect = array();
	/**
	 * ������
	 * 
	 * @var string
	 */
	private $author = '';
	/**
	 * ������ID
	 *
	 * @var integer
	 */
	private $authorid = 0;
	
	function useMedicament(){
		
	}
}
?>