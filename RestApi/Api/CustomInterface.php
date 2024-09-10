<?php
namespace Kitchen\RestApi\Api; 
interface CustomInterface
{
   /**
	 * GET for Post api
	 * @return string
	 */
	
	// public function getPost();
	/**
     * POST for Post api
     * @param string[] $data
     * @return string
     */
    public function saveData($data);

    /**
     * @return string
     */
    public function getUserData();

    /**
     * @param int $k_id
     * @return bool true on success
     */
    public function getDelete($k_id);


   /**
    * GET for Post api
    * @param string $id
    * @param string $name
    * @param string $description
    * @param string $rating
    * @param string $aid
    * @param string $isactive
    * @return string
    */
   public function updatedata($id,$name,$description,$rating,$aid,$isactive);


}
